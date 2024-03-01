<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Bank;
use App\Http\Requests\ProfileRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProfileCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProfileCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Profile::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/profile');
        CRUD::setEntityNameStrings('Hồ sơ', 'Hồ sơ');
        $this->crud->denyAccess(['create', 'show']);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.
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
        CRUD::setValidation(ProfileRequest::class);
        CRUD::field('name')->label('Họ và tên');
        CRUD::field('uuid')->label('CMT/CCCD');
//        CRUD::field('avatar')->label('Họ và tên');
        CRUD::field('birthday')->label('Ngày tháng năm sinh')->type('date');
        CRUD::field('gender')->type('select_from_array')->label('Giới tính')->options([
            0 => 'Nam',
            1 => 'Nữ'
        ]);
        CRUD::field('job')->label('Công việc');
        CRUD::field('salary')->label('Thu nhập hàng tháng');
        CRUD::field('in_order_to')->label('Mục đích vay');
        CRUD::field('address')->label('Địa chỉ');
        CRUD::field('alt_phone')->label('SĐT Người thân');
        CRUD::field('alt_relation')->label('Mối quan hệ với người vay');
        CRUD::field('bank_account')->label('Số tài khoản');
        CRUD::field('account_name')->label('Chủ tài khoản');
        CRUD::field('bank_name')->label('Ngân hàng')->type('select_from_array')->options(bankOptions());
        CRUD::field('front-card')->label('CCCD Mặt trước')->type('image')->prefix('/uploads/');
        CRUD::field('back-card')->label('CCCD Mặt sau')->type('image')->prefix('/uploads/');
        CRUD::field('verify-photo')->label('Ảnh xác minh')->type('image')->prefix('/uploads/');
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

    public function update()
    {
        $this->traitUpdate();

        return redirect('/admin/loan');
    }
}
