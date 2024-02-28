<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RechargeRequest;
use App\Models\Config;
use App\Models\Profile;
use App\Models\Recharge;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\CRUD\app\Library\Widget;
use Illuminate\Database\Eloquent\Builder;
use Prologue\Alerts\Facades\Alert;

/**
 * Class RechargeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RechargeCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Recharge::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/recharge');
        CRUD::setEntityNameStrings('TB Nạp tiền', '');
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
            $this->crud->query->whereHas('User', function (Builder $builder) use ($value) {
                $builder->where('username', 'like', "%$value%");
            });
        });
        Widget::add(
            [
                'type' => 'view',
                'view' => 'admin.loan.dashboard-head',
                'tab' => 'loan',
            ]
        );
//        $this->crud->query->where('reason', '!=', 'Sai thông tin liên kết ví');

        CRUD::column('reason')->label('Nội dung')->limit(100);
        CRUD::column('user_id')->type('select')->model('App\Models\User')->attribute('username')->entity('User')->label('SĐT');
        CRUD::column('created_at')->label('Thời gian');
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
    protected function setupCreateOperation($default = null)
    {
        CRUD::setValidation(RechargeRequest::class);

        CRUD::field('reason')->label('Nội dung')->type('select2_from_array')
            ->options(Recharge::reasonOptions());

        $options = User::query()->where('role', 'customer')->get()->mapWithKeys(function ($user) {
            return [$user['id'] => $user['username']];
        })->toArray();

        $options['all'] = 'Tất cả';

        if ($this->crud->getCurrentOperation() == 'create') {
            CRUD::addField([
                'name' => 'alt_phone',
                'type' => 'select2_from_array',
                'label' => 'Số điện thoại',
                'allows_multiple' => true,
                'allow_null' => false,
                'options' => $options,
                'default' => [0 => $default]
            ]);
        }
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
        $current = $this->crud->getCurrentEntry();

        $this->setupCreateOperation($current->user_id);
    }

    public function store()
    {
        $input = $this->crud->getRequest()->input();

        $altPhone = $input['alt_phone'];

        if (in_array('all', $altPhone)) {
            Config::query()->updateOrCreate([
                'key' => 'default_message'
            ], [
                'key' => 'default_message',
                'type' => 'text',
                'value' => $input['reason'],
                'label' => 'Thông báo mặc định'
            ]);
            $altPhone = array_diff($altPhone, ['all']);
        }

        Recharge::query()->whereIn('user_id', $altPhone)->update([
            'reason' => $input['reason']
        ]);

        Alert::success('OK');

        return redirect()->to('/admin/recharge');
    }
}
