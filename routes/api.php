<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\Auth\JWTAuthController;
use App\Http\Controllers\BasicInformationController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SkillsController;
use App\Http\Middleware\CheckPersonalMiddleware;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [JWTAuthController::class, 'login'])->name('login');
Route::post('/register', [JWTAuthController::class, 'register']);


Route::middleware([JwtMiddleware::class])->group(function () {
    Route::get('get-auth-user', [JWTAuthController::class, 'getAuthUser']);
    Route::PUT('update-user-profile', [JWTAuthController::class, 'updateUserProfile']);
    Route::Post('company-identify-verification', [JWTAuthController::class, 'companyIdentifyVerification']);
    Route::post('logout', [JWTAuthController::class, 'logout']);
});


Route::middleware([JwtMiddleware::class, CheckPersonalMiddleware::class])->prefix('jobProfile')->group(function () {
    Route::resource('basicInformation', BasicInformationController::class);
    Route::resource('eduction', EducationController::class);
    Route::resource('experience', ExperienceController::class);
    Route::resource('language', LanguageController::class);
    Route::resource('skills', SkillsController::class);
});


Route::middleware([JwtMiddleware::class])->group(function () {
    Route::resource('ads', AdsController::class);
    Route::get('get-main-category-of-ad', [AdsController::class, 'getMainCategoryOfAd']);
    Route::get('get-all-categories-with-sub', [AdsController::class, 'getAllCategoriesWithSub']);
    Route::post('create-new-ad', [AdsController::class, 'createNewAd']);
    Route::get('get-ad-by-id', [AdsController::class, 'getAdById']);
    Route::get('get-all-ads', [AdsController::class, 'getAllAds']);
});


Route::get('/accepted-languages', function (Request $request) {
    $acceptedLanguages = $request->getLanguages();
    return response()->json($acceptedLanguages);
});


Route::middleware([JwtMiddleware::class])->controller(FollowController::class)->group(function () {
    Route::get('add-follow/{user_id}', 'addFollow');
    Route::get('cancel-follow/{user_id}', 'cancelFollow');
    Route::get('show-follower', 'showFollower');
    Route::get('count-follower', 'countFollower');
    Route::get('show-following', 'showFollowing');
    Route::get('count-following', 'countFollowing');
});


Route::controller(HomepageController::class)->group(function () {
    Route::get('show-all-languages', 'showAllLanguages');
    Route::get('show-all-skills', 'showAllSkills');
    Route::get('show-all-countries', 'showAllCountries');
    Route::get('show-all-cities', 'showAllCities');
});


Route::resource('comment', \App\Http\Controllers\api\CommentController::class);


Route::middleware([JwtMiddleware::class])->controller(\App\Http\Controllers\api\ChatController::class)->group(function () {
    Route::get('show-chats', 'showChats');
    Route::get('show-messages/{id}', 'showMessages');
    Route::post('send-message', 'send_message');
});

