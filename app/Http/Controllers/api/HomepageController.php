<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Skills;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function showAllLanguages(Request $request)
    {
        $languages = Language::select('id')->with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->get();
        if ($languages->isEmpty()) {
            return response()->json(['message' => 'No languages found.'], 404);
        }
        return response()->json(['message' => 'Languages are Available', 'Data' => $languages], 200);
    }

    public function showAllSkills(Request $request)
    {
        $skills = Skills::select('id')->with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->get();
        if ($skills->isEmpty()) {
            return response()->json(['message' => 'No Skills found.'], 404);
        }
        return response()->json(['message' => 'Skills are Available', 'Data' => $skills], 200);
    }

    public function showAllCountries(Request $request)
    {
        $countries = Skills::select('id')->with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->get();
        if ($countries->isEmpty()) {
            return response()->json(['message' => 'No Countries found.'], 404);
        }
        return response()->json(['message' => 'Countries are Available', 'Data' => $countries], 200);
    }

    public function showAllCities(Request $request)
    {
        $cities = Skills::select('id')->with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->get();
        if ($cities->isEmpty()) {
            return response()->json(['message' => 'No Cities found.'], 404);
        }
        return response()->json(['message' => 'Cities are Available', 'Data' => $cities], 200);
    }


}
