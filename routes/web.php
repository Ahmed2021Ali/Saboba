<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

// Redirect guest users to login page
    Route::redirect('/', '/login')->middleware('guest');


// Admin Auth
    Route::controller(\App\Http\Controllers\web\AuthController::class)->group(function () {
        Route::get('view-login', 'loginForm')->name('login.form');
        Route::post('submit-login', 'login')->name('login.confirm');
        Route::get('home', 'home')->name('home')->middleware(['auth']);
        Route::post('logout', 'logout')->name('logout');
    });


// Roles Management Routes
    Route::group(['middleware' => ['auth']], function () {


        Route::get('roles', [\App\Http\Controllers\web\RoleController::class, 'index'])->name('roles.index')
            ->middleware('permission:عرض الأدوار');

        Route::get('roles', [\App\Http\Controllers\web\RoleController::class, 'index'])->name('roles.index')
            ->middleware('permission:عرض الأدوار');

        Route::middleware('permission:إضافة دور')->group(function () {
            Route::get('roles/create', [\App\Http\Controllers\web\RoleController::class, 'create'])->name('roles.create');
            Route::post('roles', [\App\Http\Controllers\web\RoleController::class, 'store'])->name('roles.store');
        });


        Route::get('roles/{role}', [\App\Http\Controllers\web\RoleController::class, 'show'])->name('roles.show')
            ->middleware('permission:عرض دور');

        Route::middleware('permission:تعديل دور')->group(function () {
            Route::get('roles/{role}/edit', [\App\Http\Controllers\web\RoleController::class, 'edit'])->name('roles.edit');
            Route::put('roles/{role}', [\App\Http\Controllers\web\RoleController::class, 'update'])->name('roles.update');
        });

        Route::middleware('permission:حذف دور')->group(function () {
            Route::delete('roles/{role}', [\App\Http\Controllers\web\RoleController::class, 'destroy'])->name('roles.destroy');
        });

// User Management Routes
        Route::resource('users', \App\Http\Controllers\web\UserController::class);

// User Management Routes


        Route::middleware('permission:تعديل دور')->group(function () {
            Route::get('roles/{role}/edit', [\App\Http\Controllers\web\RoleController::class, 'edit'])->name('roles.edit');
            Route::put('roles/{role}', [\App\Http\Controllers\web\RoleController::class, 'update'])->name('roles.update');
        });

        Route::middleware('permission:حذف دور')->group(function () {
            Route::delete('roles/{role}', [\App\Http\Controllers\web\RoleController::class, 'destroy'])->name('roles.destroy');
        });

        // User Management Routes
        Route::resource('users', \App\Http\Controllers\web\UserController::class);

        // categories  Routes
        Route::resource('categories', \App\Http\Controllers\web\CategoryController::class);

        // sub_categories Routes
        Route::controller(\App\Http\Controllers\web\SubCategoryController::class)->group(function () {
            Route::get('sub_categories/{category}', 'index')->name('sub_categories.index');
            Route::post('sub_categories/{category}', 'store')->name('sub_categories.store');
            Route::put('sub_categories/{category}', 'update')->name('sub_categories.update');
            Route::delete('sub_categories/{category}', 'destroy')->name('sub_categories.destroy');

        });
        Route::resource('categories', \App\Http\Controllers\web\CategoryController::class);
        Route::resource('users', \App\Http\Controllers\web\UserController::class);

    });
});
