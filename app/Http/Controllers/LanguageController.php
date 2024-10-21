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
        return response()->json([
            'success' => 'Your Languages ',
            'data' => LanguageResource::collection(Auth::User()->userLanguages)
        ], 200);
    }

    public function store(StoreLanguagesRequest $request)
    {
        $lang = Language::where('id', $request->language_id)->first();
        if ($lang) {
            $language = Auth::User()->userLanguages()->where('language_id', $lang->id)->first();
            if ($language) {
                return response()->json(['success' => 'your Language already exists', 'date' => $language]);
            } else {
                Auth::User()->userLanguages()->attach($lang->id);
                return response()->json(['success' => 'your Language created successfully', 'date' => $language],201);
            }
        }
        return response()->json(['error' => 'your Language Not Found', 404]);

    }

    public function destroy($id)
    {
        $language = Language::where('id', $id)->first();
        if ($language) {
            if (auth()->user()->id === $language->user_id) {
                $language->delete();
                return response()->json(['success' => 'Delete Successfully']);
            }
        }
        return response()->json(['error' => 'An error occurred']);
    }

}
