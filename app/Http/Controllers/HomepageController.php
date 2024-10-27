<?php

namespace App\Http\Controllers;

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
        return response()->json($languages);
    }

    public function showAllSkills(Request $request)
    {
        $skills = Skills::select('id')->with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->get();
        return response()->json($skills);
    }

    public function showAllCountries(Request $request)
    {
        $countries = Skills::select('id')->with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->get();
        return response()->json($countries);
    }

    public function showAllCities(Request $request)
    {
        $cities = Skills::select('id')->with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->get();
        return response()->json($cities);
    }


}
