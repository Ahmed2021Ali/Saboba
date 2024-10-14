<?php

use App\Http\Controllers\Auth\JWTAuthController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\JobProfileController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;


Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login'])->name('login');
Route::get('get-user', [JWTAuthController::class, 'getUser']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post('logout', [JWTAuthController::class, 'logout']);
});
Route::resource('job_profile', JobProfileController::class);
Route::resource('eduction', EducationController::class);



