<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguagesRequest;

use App\Http\Resources\LanguageResource;
use App\Http\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        return response()->json(['data' => LanguageResource::collection(Auth::User()->userLanguages),200]);
    }

    public function store(StoreLanguagesRequest $request)
    {
        foreach ($request->languages_id as $language_id) {
            $language = Auth::User()->userLanguages()->where('language_id', $language_id)->first();
            if ($language) {
                return $this->successResponse(null, 'your Language already exists', 200);
            } else {
                Auth::User()->userLanguages()->attach($language_id);
                return $this->successResponse(null, 'your Language created successfully', 201);

            }
        }
    }

    public function destroy($id)
    {
        return $this->successResponse(Auth::User()->userLanguages()->detach($id), null, 200);
    }

}
