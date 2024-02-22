<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/login', [\App\Http\Controllers\ClientAuthController::class, 'index']);
Route::get('/register', [\App\Http\Controllers\ClientAuthController::class, 'registerView']);
Route::post('/login', [\App\Http\Controllers\ClientAuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\ClientAuthController::class, 'register']);


Route::middleware(['client'])->group(function () {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/vay', [LoanController::class, 'index']);
    Route::get('/vay/calculate/amount/{amount}/months/{months}', [LoanController::class, 'calculateLoan', 'amount', 'months']);
    Route::get('/verify', [LoanController::class, 'verifyView']);
    Route::post('/vay', [LoanController::class, 'store']);
    Route::post('/verify', [LoanController::class, 'verify']);

    Route::get('/contact', [ContactController::class, 'contactCSKH']);

    Route::get('/wallet', [WalletController::class, 'index']);
});
