<?php

use App\Http\Controllers\Auth\JWTAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('views.welcome');
});
