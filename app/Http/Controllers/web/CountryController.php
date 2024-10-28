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
        $validationData = $request->validate(['name' => 'required|string', 'image' => 'required|image|max:10000']);
        $country = Country::create(['name' => $validationData['name']]);
        if (isset($validationData['image'])) {
            $country->addMedia($validationData['image'])->toMediaCollection('countryImages');
        }
        flash()->success('تم اضافة الدولة  بنجاح');
        return redirect()->route('country.index');
    }

    public function show(Country $country)
    {
        return view('dashboard.city.index', ['cities' => $country->cities , 'country' => $country]);
    }

    public function update(Request $request, Country $country)
    {
        $validationData = $request->validate(['name' => 'nullable|string', 'image' => 'nullable|image|max:10000']);
        $country->update($validationData);
        if (isset($validationData['image'])) {
            $country->addMedia($validationData['image'])->toMediaCollection('countryImages');
        }
        flash()->success('تم تحديث الدولة  بنجاح');
        return redirect()->route('country.index');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        flash()->success('تم حذف الدولة  بنجاح');
        return redirect()->route('country.index');
    }
}
