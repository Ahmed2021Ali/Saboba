<?php

use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\web\RoleController;
use App\Http\Controllers\web\SubCategoryController;
use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\web\CountryController;
use App\Http\Controllers\web\CityController;

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {


// Redirect guest users to login page
    Route::group(['middleware' => ['guest']], function () {
        // Admin Auth
        Route::redirect('/', '/view-login');

        Route::controller(AuthController::class)->group(function () {
            Route::get('view-login', 'loginForm')->name('login.form');
            Route::post('submit-login', 'login')->name('login.confirm');
        });

    });

// Roles Management Routes
    Route::group(['middleware' => ['auth']], function () {

        Route::controller(AuthController::class)->group(function () {
            Route::get('home', 'home')->name('home');
            Route::post('logout', 'logout')->name('logout');
        });

        // categories  Routes
        Route::resource('categories', CategoryController::class);

        // sub_categories Routes
        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('sub_categories/{category}', 'index')->name('sub_categories.index');
            Route::post('sub_categories/{category}', 'store')->name('sub_categories.store');
            Route::put('sub_categories/{category}', 'update')->name('sub_categories.update');
            Route::delete('sub_categories/{category}', 'destroy')->name('sub_categories.destroy');
        });

        // User Management Routes
        Route::resource('users', UserController::class);

        // Country Routes
        Route::resource('country', CountryController::class);
        // City Routes
        Route::resource('city', CityController::class);


        Route::get('roles', [RoleController::class, 'index'])->name('roles.index')
            ->middleware('permission:عرض الأدوار');

        Route::get('roles', [RoleController::class, 'index'])->name('roles.index')
            ->middleware('permission:عرض الأدوار');

        Route::middleware('permission:إضافة دور')->group(function () {
            Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
            Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
        });


        Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show')
            ->middleware('permission:عرض دور');

        Route::middleware('permission:تعديل دور')->group(function () {
            Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        });

        Route::middleware('permission:حذف دور')->group(function () {
            Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
        });

        // User Management Routes
        Route::middleware('permission:تعديل دور')->group(function () {
            Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
            Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        });

        Route::middleware('permission:حذف دور')->group(function () {
            Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
        });


    });
});
