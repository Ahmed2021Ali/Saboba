<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Country;
use App\Models\Language;
use App\Models\Skills;

class HomepageController extends Controller
{
    public function showAllLanguages()
    {
        $languages = Language::select('id', 'name')->get();
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
