<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguagesRequest;

use App\Http\Resources\LanguageResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        return $this->successResponse(LanguageResource::collection(Auth::User()->userLanguages), 'User Languages.', 200);
    }

    public function store(StoreLanguagesRequest $request)
    {
        foreach ($request->languages_id as $language_id) {
            $language = Auth::User()->userLanguages()->where('language_id', $language_id)->first();
            if ($language) {
                return $this->successResponse($language, 'your Language already exists', 200);
            } else {
                Auth::User()->userLanguages()->attach($language_id);
                return $this->successResponse($language, 'your Language created successfully', 201);

            }
        }
    }

    public function destroy($id)
    {
        $language = Language::findOrFail($id);
        if (auth()->user()->id === $language->user_id) {
            $language->delete();
            return $this->successResponse(null, 'Delete Successfully', 200);
        }
        return $this->errorResponse('An error occurred', null);
    }

}
