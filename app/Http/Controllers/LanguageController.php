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
        if (Auth::User()->userLanguages->isNotEmpty()) {
            return response()->json([
                'message' => 'Your Languages ',
                'Data' => LanguageResource::collection(Auth::User()->userLanguages)], 200);
        }
        return response()->json(['message' => 'No Languages  for You'],404);

    }

    public function store(StoreLanguagesRequest $request)
    {
        $lang = Language::where('id', $request->language_id)->first();
        if ($lang) {
            $language = Auth::User()->userLanguages()->where('language_id', $lang->id)->first();
            if ($language) {
                return response()->json(['message' => 'your Language already exists', 'Date' => $language], 500);
            } else {
                Auth::User()->userLanguages()->attach($lang->id);
                return response()->json(['message' => 'your Language created successfully', 'Date' => $language], 201);
            }
        }
        return response()->json(['message' => 'your Language Not Found', 404]);

    }

    public function destroy($id)
    {
        $language = Language::where('id', $id)->first();
        if ($language) {
            if (auth()->user()->id === $language->user_id) {
                $language->delete();
                return response()->json(['message' => 'Delete Successfully'], 200);
            }
        }
        return response()->json(['message' => 'An error occurred'], 404);
    }

}
