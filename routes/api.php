<?php

use App\Http\Controllers\Auth\JWTAuthController;
use App\Http\Controllers\BasicInformationController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SkillsController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [JWTAuthController::class, 'login'])->name('login');
Route::post('/register', [JWTAuthController::class, 'register']);

Route::get('/get-users', function (Request $request) {
    $token = $request->header('Ahmed');
    return response()->json(['token' => $token]);
});
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


Route::controller(FollowController::class)->middleware([JwtMiddleware::class])->group(function () {
    Route::get('add-follow/{user_id}', 'addFollow');
    Route::get('accept-follow/{follow_id}', 'acceptFollow');
    Route::get('reject-follow/{follow_id}', 'rejectFollow');

    Route::get('cancel-follow/{follow_id}', 'cancelFollow');

    Route::get('show-follower', 'showFollower');
    Route::get('count-follower', 'countFollower');

    Route::get('show-following', 'showFollowing');
    Route::get('count-following', 'countFollowing');
});
