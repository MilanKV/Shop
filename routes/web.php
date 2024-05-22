<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\subCategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Middleware\CheckRole;
use App\Enums\RoleType;



Auth::routes(['verify' => true]);

Route::redirect('/', '/login');
// Frontend
// Route::get('/', function () {
//     return view('frontend/app');
// });


// Admin Routes
Route::group(['middleware' => ['auth', 'verified', CheckRole::class . ':' . RoleType::SUPERADMIN->value . ',' . RoleType::ADMIN->value], 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Category Management
    Route::group(['prefix' => 'category'], function () {
        // Route::resource('category', CategoryController::class)->except(['show']);
        Route::get('/index', [CategoryController::class, 'index'])->name('category.index');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/destroy/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
        Route::get('/deactivated', [CategoryController::class, 'deactivated'])->name('category.deactivated');
        Route::get('/{id}/restore', [CategoryController::class, 'restore'])->name('category.restore');
        Route::delete('/{id}/delete-permanent', [CategoryController::class, 'permanentDelete'])->name('category.delete-permanent');
    });

    // subCategory Management
    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/index', [subCategoryController::class, 'index'])->name('subcategory.index');
        Route::get('/create', [subCategoryController::class, 'create'])->name('subcategory.create');
        Route::get('/{category}/edit', [subCategoryController::class, 'edit'])->name('subcategory.edit');
        Route::post('/store', [subCategoryController::class, 'store'])->name('subcategory.store');
        Route::put('/update/{category}', [subCategoryController::class, 'update'])->name('subcategory.update');
        Route::delete('/destroy/{category}', [subCategoryController::class, 'destroy'])->name('subcategory.destroy');
        Route::get('/deactivated', [subCategoryController::class, 'deactivated'])->name('subcategory.deactivated');
        Route::get('/{id}/restore', [subCategoryController::class, 'restore'])->name('subcategory.restore');
        Route::delete('/{id}/delete-permanent', [subCategoryController::class, 'permanentDelete'])->name('subcategory.delete-permanent');
    });

    // Brand Management
    Route::group(['prefix' => 'brand'], function () {
        // Route::resource('brand', BrandController::class)->except(['show']);
        Route::get('/index', [BrandController::class, 'index'])->name('brand.index');
        Route::get('/create', [BrandController::class, 'create'])->name('brand.create');
        Route::get('/{brand}/edit', [BrandController::class, 'edit'])->name('brand.edit');
        Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
        Route::put('/update/{brand}', [BrandController::class, 'update'])->name('brand.update');
        Route::delete('/destroy/{brand}', [BrandController::class, 'destroy'])->name('brand.destroy');
        Route::get('/deactivated', [BrandController::class, 'deactivated'])->name('brand.deactivated');
        Route::get('/{id}/restore', [BrandController::class, 'restore'])->name('brand.restore');
        Route::delete('/{id}/delete-permanent', [BrandController::class, 'permanentDelete'])->name('brand.delete-permanent');
    });

    // Product Management
    Route::group(['prefix' => 'product'], function () {
        // Route::resource('product', ProductController::class)->except(['show']);
        Route::get('/index', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/update/{product}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('/destroy/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('/deactivated', [ProductController::class, 'deactivated'])->name('product.deactivated');
        Route::get('/{id}/restore', [ProductController::class, 'restore'])->name('product.restore');
        Route::delete('/{id}/delete-permanent', [ProductController::class, 'permanentDelete'])->name('product.delete-permanent');
    });

    Route::group(['middleware' => CheckRole::class . ':' . RoleType::SUPERADMIN->value], function () {

        // Users Management
        Route::group(['prefix' => 'user'], function () {
            // Route::resource('user', UsersController::class);
            Route::get('/index', [UsersController::class, 'index'])->name('user.index');
            Route::get('/create', [UsersController::class, 'create'])->name('user.create');
            Route::post('/store', [UsersController::class, 'store'])->name('user.store');
            Route::delete('/destroy/{user}', [UsersController::class, 'destroy'])->name('user.destroy');
            Route::get('/deactivated', [UsersController::class, 'deactivated'])->name('user.deactivated');
            Route::get('/{id}/restore', [UsersController::class, 'restore'])->name('user.restore');
            Route::delete('/{id}/delete-permanent', [UsersController::class, 'permanentDelete'])->name('user.delete-permanent');
            Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('user.edit');
            Route::put('/update/{user}', [UsersController::class, 'update'])->name('user.update');
        });
    });
});
