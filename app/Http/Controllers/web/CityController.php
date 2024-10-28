<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
    }

    public function store(Request $request)
    {
        $validationData = $request->validate(['name' => 'nullable|string', 'country_id' => 'required|exists:countries,id']);
        City::create($validationData);

    }

    public function update(Request $request, City $city)
    {
        $validationData = $request->validate(['name' => 'nullable|string', 'country_id' => 'required|exists:countries,id']);
        City::create($validationData);

    }

    public function destroy(City $city)
    {
        $city->delete();

    }

}
