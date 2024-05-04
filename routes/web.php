<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Middleware\CheckRole;
use App\Enums\RoleType;



Auth::routes(['verify' => true]);

// Frontend
Route::get('/', function () {
    return view('frontend/app');
});
Route::group(['middleware' => ['auth', 'verified', CheckRole::class . ':' . RoleType::SUPERADMIN->value . ',' . RoleType::ADMIN->value], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/products', [ProductController::class, 'index'])->name('products');

    Route::group(['prefix' => 'category'], function() {
        // Route::resource('category', CategoryController::class)->except(['show']);
        Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });
    Route::group(['prefix' => 'brand'], function() {
        // Route::resource('brand', BrandController::class)->except(['show']);
        Route::get('/index', [BrandController::class, 'index'])->name('brand.index');
        Route::delete('/destroy/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');
    });
});