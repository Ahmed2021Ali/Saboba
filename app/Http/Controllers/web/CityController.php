<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
    }

    public function store(Request $request)
    {
        $validationData = $request->validate(['name' => 'required|string', 'country_id' => 'required|exists:countries,id']);
        City::create($validationData);
        $country = Country::find($validationData['country_id']);
        return view('dashboard.city.index', ['cities' => $country->cities, 'country' => $country]);
    }

    public function update(Request $request, City $city)
    {
        $validationData = $request->validate(['name' => 'nullable|string', 'country_id' => 'nullable|exists:countries,id']);
        $city->update(['name' => $validationData['name'] ?? $city->name]);
        $country = Country::find($validationData['country_id']);
        return view('dashboard.city.index', ['cities' => $country->cities, 'country' => $country]);
    }

    public function destroy(Request $request, City $city)
    {
        $validationData = $request->validate(['country_id' => 'nullable|exists:countries,id']);
        $city->delete();
        $country = Country::find($validationData['country_id']);
        return view('dashboard.city.index', ['cities' => $country->cities, 'country' => $country]);
    }

}
