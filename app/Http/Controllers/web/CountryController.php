<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('dashboard.country.index', compact('countries'));
    }

    public function store(Request $request)
    {
        $validationData = $request->validate(['name' => 'nullable|string']);
        Country::create($validationData);


    }

    public function update(Request $request, Country $country)
    {
        $validationData = $request->validate(['name' => 'nullable|string']);
        $country->update($validationData);

    }

    public function destroy(Country $country)
    {
        $country->delete();

    }
}
