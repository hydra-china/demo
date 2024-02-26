<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Models\Wallet;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class NotificationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class NotificationCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
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
        CRUD::setModel(\App\Models\Notification::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/notification');
        CRUD::setEntityNameStrings('Thông báo nạp tiền', 'Thông báo nạp tiền');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('title')->type('text')->label('Tiêu đề');
        CRUD::column('content')->type('text')->label('Nội dung');
        CRUD::column('amount')->type('number')->label('Số tiền')->suffix(' đ');
        CRUD::column('type')->type('select_from_array')->options(Notification::typeOptions());
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
        CRUD::setValidation(NotificationRequest::class);

        CRUD::addField([
            'name' => 'title',
            'label' => 'Tiêu đề thông báo',
        ]);

        CRUD::addField([
            'name' => 'content',
            'label' => 'Nội dung thông báo',
        ]);

        CRUD::addField([
            'name' => 'user_id',
            'type' => 'select',
            'entity' => 'User',
            'label' => 'Người dùng',
            'model' => 'App\Models\User',
            'attribute' => 'username'
        ]);

        CRUD::addField([
            'name' => 'amount',
            'type' => 'number',
            'label' => 'Số tiền'
        ]);

        CRUD::addField([
            'name' => 'type',
            'label' => 'Loại',
            'type' => 'select_from_array',
            'options' => [
                1 => 'Cộng tiền',
                2 => 'Trừ tiền'
            ]
        ]);
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

    public function store()
    {
        $this->traitStore();

        $notification = $this->crud->getCurrentEntry();

        $wallet = Wallet::query()->where('user_id', $notification['user_id'])->first();

        if (! $wallet) {
            return redirect('/admin/notification');
        }

        if ($notification['type'] == Notification::PLUS) {
            $wallet->update([
                'amount' => $wallet['amount'] + $notification['amount']
            ]);
        } else {
            $wallet->update([
                'amount' => $wallet['amount'] - $notification['amount']
            ]);
        }

        return redirect('/admin/notification');
    }
}
