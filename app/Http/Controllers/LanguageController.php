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
        return $this->successResponse(LanguageResource::collection(Auth::User()->userLanguages), 200);
    }

    public function store(StoreLanguagesRequest $request)
    {
        foreach ($request->languages_id as $language_id) {
            $language = Auth::User()->userLanguages()->where('language_id', $language_id)->first();
            if ($language) {
                return response()->json([$language,'success'=>'your Language already exists']);
            } else {
                Auth::User()->userLanguages()->attach($language_id);
                return response()->json([$language,'success'=>'your Language created successfully']);
            }
        }
    }

    public function destroy($id)
    {
        $language = Language::where('id', $id)->first();
        if ($language) {
            if (auth()->user()->id === $language->user_id) {
                $language->delete();
                return response()->json(['success'=>'Delete Successfully']);
            }
        }
        return response()->json(['error'=>'An error occurred']);
    }

}
