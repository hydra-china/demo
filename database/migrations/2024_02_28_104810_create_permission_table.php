<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePermissionTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            [
                'group' => 'Chăm sóc khách hàng',
                'name' => 'Danh sách CSKH',
                'key' => 'customer_staff'
            ],
            [
                'group' => 'Chăm sóc khách hàng',
                'name' => 'Danh sách nhân viên',
                'key' => 'staff'
            ],
            [
                'group' => 'Tài khoản',
                'name' => 'Quản lý tài khoản',
                'key' => 'wallet'
            ],
            [
                'group' => 'Tài khoản',
                'name' => 'Khoản vay',
                'key' => 'loan'
            ],
            [
                'group' => 'Tài khoản',
                'name' => 'Nạp tiền',
                'key' => 'notification'
            ],
            [
                'group' => 'Tài khoản',
                'name' => 'Thông báo nạp tiền',
                'key' => 'recharge'
            ],
            [
                'group' => 'Phân quyền',
                'name' => 'Quản lý phân quyền',
                'key' => 'department'
            ],
            [
                'group' => 'Phân quyền',
                'name' => 'Quản lý quyền hạn',
                'key' => 'permission_department'
            ],
            [
                'group' => 'Cấu hình',
                'name' => 'Quản lý cấu hình website',
                'key' => 'config'
            ]
        ];

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('key');
            $table->string('group');
            $table->timestamps();
        });

        DB::table('permissions')->truncate();

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert($permission);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
