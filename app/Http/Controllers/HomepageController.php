<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use App\Models\Skills;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function showAllLanguages(Request $request)
    {
       // $languages = Language::select('id', 'name')->get();
        $languages = Language::select('id')->with(['translations' => function ($query) use ($request) {
            $query->select('name')->where('locale', $request->getLanguages());
        }])->get();
        return response()->json($languages);
    }

    public function showAllSkills()
    {
        $skills = Skills::select('id', 'name')->get();
        return response()->json($skills);
    }

    public function showAllCountries()
    {
        $countries = Country::select('id', 'name')->get();
        return response()->json($countries);
    }

    public function showAllCities()
    {
        $cities = City::select('id', 'name')->get();
        return response()->json($cities);
    }


}
