<?php

use App\Http\Controllers\Admin\LoanCrudController;
use Illuminate\Support\Facades\Route;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array)config('backpack.base.web_middleware', 'web'),
        (array)config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('loan', 'LoanCrudController');
    Route::get('loan/{id}/approve', [LoanCrudController::class, 'approve', 'id']);
    Route::crud('profile', 'ProfileCrudController');
    Route::crud('staff', 'StaffCrudController');
    Route::crud('notification', 'NotificationCrudController');
    Route::crud('wallet', 'WalletCrudController');
    Route::crud('config', 'ConfigCrudController');
    Route::crud('admin', 'AdminCrudController');
    Route::crud('department', 'DepartmentCrudController');
    Route::crud('recharge', 'RechargeCrudController');
    Route::crud('user-staff', 'UserStaffCrudController');
}); // this should be the absolute last line of this file