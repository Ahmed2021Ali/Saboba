<?php

use Illuminate\Support\Facades\Route;


// Redirect guest users to login page
Route::redirect('/', '/login')->middleware('guest');


// Admin Auth
Route::controller(\App\Http\Controllers\web\AuthController::class)->group(function () {
    Route::post('logout', 'logout')->name('logout');
    Route::get('login', 'loginForm')->name('login.form');
    Route::post('login', 'login')->name('login.confirm');
    Route::get('home', 'home')->name('home')->middleware(['auth']);
});



// Roles Management Routes
Route::group(['middleware' => ['auth']], function () {


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
Route::resource('category', Ca::class);


});
