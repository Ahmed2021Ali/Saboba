<?php

use App\Http\Controllers\web\AdController;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\BlockUserController;
use App\Http\Controllers\web\CategoryController;
use App\Http\Controllers\web\CityController;
use App\Http\Controllers\web\CountryController;
use App\Http\Controllers\web\IdentityVerificationController;
use App\Http\Controllers\web\NotifyController;
use App\Http\Controllers\web\RoleController;
use App\Http\Controllers\web\SubCategoryController;
use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use \App\Http\Controllers\web\ReportController;

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
        // Block  Routes
        Route::resource('blocked_user', BlockUserController::class);

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
        // identity-verification Routes
        Route::resource('verifications', IdentityVerificationController::class);
        // ads Routes  -> Not Completed
        Route::resource('ads', AdController::class);
        Route::controller(AdController::class)->group(function () {
            Route::get('notify_edit/{ad}', 'notify_edit')->name('notify_edit');
            Route::post('ad-create', 'create')->name('ad.create');
        });

        /* Report*/
        Route::controller(ReportController::class)->group(function () {
            Route::get('report-ads', 'adsReport')->name('adsReport');
            Route::get('report-comments', 'commentsReport')->name('commentsReport');
            Route::get('report-user', 'commentUser')->name('commentUser');
        });
        Route::post('notify{user_id}', [NotifyController::class,'notify'])->name('notify');


        /*  Role and permission */
        Route::controller(RoleController::class)->group(function () {

            Route::get('roles', 'index')->name('roles.index')
                ->middleware('permission:عرض الأدوار');

            Route::middleware('permission:إضافة دور')->group(function () {
                Route::get('roles/create', 'create')->name('roles.create');
                Route::post('roles', 'store')->name('roles.store');
            });

            Route::get('roles/{role}', 'show')->name('roles.show')
                ->middleware('permission:عرض دور');

            Route::middleware('permission:تعديل دور')->group(function () {
                Route::get('roles/{role}/edit', 'edit')->name('roles.edit');
                Route::put('roles/{role}', 'update')->name('roles.update');
            });

            Route::delete('roles/{role}', 'destroy')->name('roles.destroy')
                ->middleware('permission:حذف دور');

            Route::middleware('permission:تعديل دور')->group(function () {
                Route::get('roles/{role}/edit', 'edit')->name('roles.edit');
                Route::put('roles/{role}', 'update')->name('roles.update');
            });

            Route::delete('roles/{role}', 'destroy')->name('roles.destroy')
                ->middleware('permission:حذف دور');
        });

    });
});
