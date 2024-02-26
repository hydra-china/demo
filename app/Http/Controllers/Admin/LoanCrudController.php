<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoanRequest;
use App\Models\Loan;
use App\Models\Notification;
use App\Models\Profile;
use App\Models\Staff;
use App\Models\User;
use App\Models\Wallet;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

/**
 * Class LoanCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LoanCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Loan::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/loan');
        CRUD::setEntityNameStrings('Khoản vay', 'Danh sách khoản vay');
        $this->crud->denyAccess(['create', 'show']);

        $this->crud->setOperationSetting('detailsRow', true);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation(): void
    {
        $this->crud->addFilter([
            'name' => 'status',
            'label' => 'Trạng thái',
            'type' => 'select2'
        ], [
            0 => 'Chờ duyệt',
            1 => 'Đã duyệt',
            2 => 'Đã từ chối'
        ]);

        $this->crud->addFilter([
            'name' => 'staff_id',
            'label' => 'CSKH',
            'type' => 'select2'
        ], Staff::query()->get()->mapWithKeys(function ($staff) {
            return [$staff['id'] => $staff['name']];
        })->toArray());

        $this->crud->addFilter([
            'name' => 'code',
            'label' => 'Mã khoản vay',
            'type' => 'text'
        ], false, function ($value) {
            $this->crud->query->where('created_at', '=', Carbon::createFromTimestamp($value));
        });

        CRUD::addColumn([
            'name' => 'timestamp',
            'label' => 'Mã khoản vay',
        ]);

        CRUD::addColumn([
            'name' => 'profile_name',
            'label' => 'Họ và tên',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'user_id',
            'label' => 'SĐT',
            'type' => 'select',
            'model' => 'App\Models\User',
            'entity' => 'User',
            'attribute' => 'username'
        ]);

        CRUD::addColumn([
            'name' => 'amount',
            'label' => 'Số tiền',
            'type' => 'number',
            'suffix' => 'đ',
        ]);
        CRUD::addColumn([
            'name' => 'months',
            'label' => 'Thời gian',
            'type' => 'number',
            'suffix' => ' tháng'
        ]);

        CRUD::addColumn([
            'name' => 'status',
            'label' => 'Trạng thái',
            'type' => 'select_from_array',
            'options' => Loan::loanStatusOption()
        ]);

        CRUD::addColumn([
            'name' => 'signature',
            'label' => 'Chữ ký',
            'type' => 'image',
            'prefix' => 'uploads/'
        ]);

        CRUD::addColumn([
            'name' => 'staff_id',
            'label' => 'NV CSKH',
            'type' => 'select',
            'model' => 'App\Models\Staff',
            'attribute' => 'name',
            'entity' => 'Staff'
        ]);

        $this->crud->query->where('valid', 1);
        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
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
        CRUD::setValidation(LoanRequest::class);
        CRUD::setFromDb(); // set fields from db columns.
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
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

    public function showDetailsRow($id)
    {
        $loan = Loan::query()->find($id);

        $profile = Profile::query()->where('user_id', $loan->user_id)->first();

        return view('admin.loan.show', [
            'loan' => $loan,
            'profile' => $profile
        ]);
    }

    public function approve($id): Application|Redirector|RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $loan = Loan::query()->find($id);
        $loan->status = 1;
        $loan->save();

        $profile = Profile::query()->where('user_id', $loan['user_id'])->first();

        Wallet::query()->updateOrCreate([
            'user_id' => $loan['user_id']
        ],[
            'user_id' => $loan['user_id'],
            'amount' => $loan['amount'],
            'account_bank' => $profile['bank_account'],
            'account_name' => $profile['account_name'],
            'bank_name' => $profile['bank_name']
        ]);

        Notification::query()->create([
            'user_id' => $loan['user_id'],
            'type' => Notification::PLUS,
            'amount' => $loan['amount'],
            'title' => 'Khoản vay đã được giải ngân',
            'content' => 'Khoản vay đã được duyệt, hãy nhanh chóng rút tiền.'
        ]);

        return redirect('admin/loan');
    }
}
