<?php

use App\Http\Controllers\Auth\JWTAuthController;
use App\Http\Controllers\BasicInformationController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SkillsController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;


Route::post('/login', [JWTAuthController::class, 'login'])->name('login');
Route::post('/register', [JWTAuthController::class, 'register']);

Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post('logout', [JWTAuthController::class, 'logout']);
});


Route::middleware([JwtMiddleware::class])->prefix('jobProfile')->group(function () {
    Route::resource('basicInformation', BasicInformationController::class);
    Route::resource('eduction', EducationController::class);
    Route::resource('experience', ExperienceController::class);
    Route::resource('language', LanguageController::class);

    Route::resource('skills', SkillsController::class);
});




