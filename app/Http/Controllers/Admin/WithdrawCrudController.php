<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\WithdrawRequest;
use App\Models\Notification;
use App\Models\Wallet;
use App\Models\Withdraw;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\RedirectResponse;

/**
 * Class WithdrawCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class WithdrawCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Withdraw::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/withdraw');
        CRUD::setEntityNameStrings('Khoản vay chờ giải ngân', 'Khoản vay chờ giải ngân');
        $this->crud->denyAccess([
            'create',
            'show',
            'update'
        ]);

        $this->crud->addButtonFromModelFunction('line', 'approve', 'approveBtn', 'line');
//        $this->crud->addButtonFromModelFunction('line', 'refuse', 'refuseBtn', 'line');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('phone')->label('Số điện thoại');
        CRUD::column('amount')->label('Số tiền rút')->type('number')->suffix('đ');
        CRUD::column('wallet_amount')->label('Số dư ví')->type('number')->suffix('đ');
        CRUD::column('status')->label('Trạng thái')->type('select_from_array')->options(Withdraw::statusOptions());

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(WithdrawRequest::class);

        CRUD::field('wallet_id');
        CRUD::field('phone');
        CRUD::field('status');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function refuse(int $id)
    {
        Withdraw::query()->where('id', $id)->update([
            'status' => 2
        ]);

        return redirect()->back();
    }


    public function approve(int $id): RedirectResponse
    {
        $withdraw = Withdraw::query()->where('id', $id)->firstOrFail();

        $withdraw->update([
            'status' => 1
        ]);

        $wallet = Wallet::query()->where('id', $withdraw['wallet_id'])->firstOrFail();

        $wallet->update([
            'amount' => $wallet['amount'] - $withdraw['amount']
        ]);

        Notification::query()->create([
            'user_id' => $wallet['user_id'],
            'type' => Notification::MINUS,
            'amount' => $withdraw['amount'],
            'title' => 'Rút tiền về tài khoản được chấp nhận',
            'content' => 'Rút tiền về tài khoản được chấp nhận'
        ]);

        return redirect()->back();
    }
}
