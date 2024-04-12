<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Middleware\CheckRole;
use App\Enums\RoleType;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes(['verify' => true]);

// Frontend
Route::get('/', function () {
    return view('frontend/app');
});
Route::group(['middleware' => ['auth', 'verified', CheckRole::class . ':' . RoleType::SUPERADMIN->value . ',' . RoleType::ADMIN->value], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('products');
});