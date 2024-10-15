<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguagesRequest;
use App\Http\Requests\UpdateLanguagesRequest;
use App\Http\Resources\LanguageResource;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    public function index()
    {
       dd(Auth::User()->userLanguages()) ;
     //   return response()->json(Auth::User()->userLanguages);
    }

    public function store(StoreLanguagesRequest $request)
    {
        dd(Auth::User()->userLanguages) ;

        foreach ($request->languages_id as $language_id) {
            $language = Auth::User()->userLanguages()->where('language_id', $language_id)->first();
            if ($language) {
                return response()->json([
                    'message' => 'your Language already exists',
                ], 201);
            } else {
                Auth::User()->userLanguages()->attach($language_id);
                return response()->json([
                    'message' => 'your Language created successfully',
                ], 201);
            }
        }
    }

    public function destroy(Language $language)
    {
        Auth::User()->userLanguages()->detach($language->id);
    }

}
