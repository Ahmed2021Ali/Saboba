<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\Auth\JWTAuthController;
use App\Http\Controllers\BasicInformationController;
use App\Http\Controllers\CompanyIdentityVerificationController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SkillsController;
use App\Http\Middleware\CheckPersonalMiddleware;
use App\Http\Middleware\CheckCompanyMiddleware;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ChatController;
use \App\Http\Controllers\api\CommentController;


Route::controller(JWTAuthController::class)->middleware('guest')->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/register', 'register');
});

Route::middleware([JwtMiddleware::class])->group(function () {

    Route::controller(JWTAuthController::class)->group(function () {
        Route::get('get-auth-user', 'getAuthUser');
        Route::PUT('update-user-profile', 'updateUserProfile');
        Route::post('logout', 'logout');
    });

    Route::middleware([CheckCompanyMiddleware::class])->controller(CompanyIdentityVerificationController::class)->group(function () {
        Route::get('status-company-identify-verification', 'statusCompanyIdentifyVerification');
        Route::Post('send-company-identify-verification', 'sendCompanyIdentifyVerification');
    });

    Route::middleware([CheckPersonalMiddleware::class])->prefix('jobProfile')->group(function () {
        Route::resource('basicInformation', BasicInformationController::class);
        Route::resource('eduction', EducationController::class);
        Route::resource('experience', ExperienceController::class);
        Route::resource('language', LanguageController::class);
        Route::resource('skills', SkillsController::class);
    });

    Route::resource('ads', AdsController::class);
    Route::get('get-main-category-of-ad', [AdsController::class, 'getMainCategoryOfAd']);
    Route::get('get-all-categories-with-sub', [AdsController::class, 'getAllCategoriesWithSub']);
    Route::post('create-new-ad', [AdsController::class, 'createNewAd']);
    Route::get('get-ad-by-id', [AdsController::class, 'getAdById']);
    Route::get('get-all-ads', [AdsController::class, 'getAllAds']);

    Route::controller(FollowController::class)->group(function () {
        Route::get('add-follow/{user_id}', 'addFollow');
        Route::get('cancel-follow/{user_id}', 'cancelFollow');
        Route::get('show-follower', 'showFollower');
        Route::get('count-follower', 'countFollower');
        Route::get('show-following', 'showFollowing');
        Route::get('count-following', 'countFollowing');
    });

    Route::controller(ChatController::class)->group(function () {
        Route::get('show-chats', 'showChats');
        Route::get('show-messages/{id}', 'showMessages');
        Route::post('send-message', 'send_message');
    });

    Route::resource('comment', CommentController::class);

});


Route::controller(HomepageController::class)->group(function () {
    Route::get('show-all-languages', 'showAllLanguages');
    Route::get('show-all-skills', 'showAllSkills');
    Route::get('show-all-countries', 'showAllCountries');
    Route::get('show-all-cities', 'showAllCities');
});






