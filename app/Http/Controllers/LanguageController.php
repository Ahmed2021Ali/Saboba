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
        $languages = Auth::User()->userLanguages();
        return response()->json(LanguageResource::collection($languages));
    }

    public function store(StoreLanguagesRequest $request)
    {
        foreach ($request->languages_id as $language_id) {
            Auth::User()->userLanguages()->attach($language_id);
        }
        return response()->json(LanguageResource::collection(Auth::User()->userLanguages()));
    }

    public function update(UpdateLanguagesRequest $request)
    {
        //  Auth::User()->userLanguages()->detach();
        foreach ($request->languages_id as $language_id) {
            Auth::User()->userLanguages()->attach($language_id);
        }
        return response()->json(LanguageResource::collection(Auth::User()->userLanguages()));
    }

    public function destroy(Language $language)
    {
        Auth::User()->userLanguages()->detach($language->id);
    }

}
