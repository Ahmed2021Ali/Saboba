<?php

use App\Http\Controllers\api\AdsController;
use App\Http\Controllers\api\Auth\JWTAuthController;
use App\Http\Controllers\api\BasicInformationController;
use App\Http\Controllers\api\ChatController;
use App\Http\Controllers\api\CommentController;
use App\Http\Controllers\api\CompanyIdentityVerificationController;
use App\Http\Controllers\api\EducationController;
use App\Http\Controllers\api\ExperienceController;
use App\Http\Controllers\api\FollowController;
use App\Http\Controllers\api\HomepageController;
use App\Http\Controllers\api\LanguageController;
use App\Http\Controllers\api\SkillsController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Middleware\CheckCompanyMiddleware;
use App\Http\Middleware\CheckPersonalMiddleware;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\api\ReportController;

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
    Route::post('create-new-ad', [AdsController::class, 'createNewAd']);
    Route::get('get-ad-by-id', [AdsController::class, 'getAdById']);
    Route::get('get-all-ads', [AdsController::class, 'getAllAds']);
    Route::get('ads/main-category/{categoryId}', [AdsController::class, 'getAdsByMainCategory']);
    Route::get('ads/{ad_id}/main-category', [AdsController::class, 'getMainCategoryByAdId']);
    Route::delete('delete-ad/{ad_id}', [AdsController::class, 'deleteAdById']);

    Route::get('main-categories-with-subcategories', [CategoryController::class, 'getAllMainCategoriesWithSubcategories']);
    Route::get('categories/{categoryId}/subcategories', [CategoryController::class, 'getSubCategories']);


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

    Route::post('send-report-Ad', [ReportController::class, 'sendReportAd']);
    Route::post('send-report-user', [ReportController::class, 'sendReportUser']);

});


Route::controller(HomepageController::class)->group(function () {
    Route::get('show-all-languages', 'showAllLanguages');
    Route::get('show-all-skills', 'showAllSkills');
    Route::get('show-all-countries', 'showAllCountries');
    Route::get('show-all-cities', 'showAllCities');
});






