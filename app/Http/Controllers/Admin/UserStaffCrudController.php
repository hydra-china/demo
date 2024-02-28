<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserStaffRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class UserStaffCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserStaffCrudController extends CrudController
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
        CRUD::setModel(\App\Models\UserStaff::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user-staff');
        CRUD::setEntityNameStrings('Danh sách CSKH', 'Danh sách CSKH');
        $this->crud->denyAccess(['create', 'delete', 'update', 'show']);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addFilter([
            'name' => 'phone',
            'label' => 'Số điện thoại',
            'type' => 'text',
        ], false, function ($value) {
            $this->crud->query->whereHas('user', function (Builder $builder) use ($value) {
                $this->crud->query->where('username', 'like', "%$value%");
            });
        });
        CRUD::addColumn([
            'name' => 'user_id',
            'label' => 'SĐT',
            'type' => 'select',
            'model' => 'App\Models\User',
            'entity' => 'User',
            'attribute' => 'username',
        ]);

        CRUD::addColumn([
            'name' => 'staff_id',
            'label' => 'CSKH',
            'type' => 'select',
            'model' => 'App\Models\Staff',
            'entity' => 'Staff',
            'attribute' => 'name',
        ]);
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
        CRUD::setValidation(UserStaffRequest::class);
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
}
