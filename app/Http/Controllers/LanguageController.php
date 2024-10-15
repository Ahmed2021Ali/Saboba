<?php

namespace App\Http\Controllers;

use App\Http\Resources\LanguageResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function index()
    {
        $languages = Auth::User()->userLanguages();
        return response()->json(LanguageResource::collection($languages));
    }

}
