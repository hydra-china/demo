<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Operations\FetchOperation;
use App\Http\Requests\NotificationRequest;
use App\Models\Notification;
use App\Models\User;
use App\Models\Wallet;
use Backpack\CRUD\app\Http\Controllers\CrudController;

use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
    use FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        $type = $this->crud->getRequest()->get('type') ?? 'add';
        CRUD::setModel(\App\Models\Notification::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/notification');
        if ($type == 'add') {
            CRUD::setEntityNameStrings('Nạp tiền', 'Nạp tiền');
        }else{
            CRUD::setEntityNameStrings('Trừ tiền', 'Trừ tiền');
        }

    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        Widget::add(
            [
                'type' => 'view',
                'view' => 'admin.loan.dashboard-head',
                'tab' => 'notification',
            ]
        );
        $this->crud->removeButton('create');
        $this->crud->addButtonFromModelFunction('top', 'addMoney', 'addMoneyButton');
        $this->crud->addButtonFromModelFunction('top', 'minusMoney', 'minusMoneyButton');
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

    public function fetchUser()
    {
        return $this->fetch([
            'model' => User::class,
            'query' => function (Model $model) {
                $search = request()->input('q') ?? false;

                if ($search) {
                    return $model->newQuery()->where('username', 'like', "%$search%")->where('email', '=', null);
                }

                return $model;
            }
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $type = $this->crud->getRequest()->get('type') ?? 'add';

        CRUD::setValidation(NotificationRequest::class);

        CRUD::addField([
            'name' => 'amount',
            'type' => 'number',
            'label' => 'Số tiền'
        ]);

        CRUD::addField([
            'name' => 'title',
            'label' => 'Tiêu đề thông báo',
            'type' => 'hidden',
            'value' => ''
        ]);

        CRUD::addField([
            'name' => 'title',
            'type' => 'textarea',
            'label' => 'Lý do từ chối',
        ]);

        CRUD::addField([
            'name' => 'content',
            'type' =>'hidden',
            'value' => '...'
        ]);

        CRUD::addField([
            'name' => 'user_id',
            'type' => 'relationship',
            'entity' => 'User',
            'label' => 'Người dùng (Số điện thoại)',
            'model' => 'App\Models\User',
            'attribute' => 'username',
            'ajax' => true
        ]);

        CRUD::addField([
            'name' => 'type',
            'label' => 'Loại',
            'value' => $type == 'add' ? 1 : 2,
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
