<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdField;
use App\Models\AdTranslation;
use App\Models\Category;
use Illuminate\Http\Request;

class AdController extends Controller
{

    public function index()
    {
        $ads = Ad::all();
        return view('dashboard.ads.index', [
            'ads' => $ads,
            'categories' => Category::with(['translations'])->where('parent_id', null)->get(),
        ]);
        //dd($ads);
        // $adTranslations = AdTranslation::where('ad_id', $ad->id)->get();
        //  $adFields = AdField::where('ad_id', $ad->id)->get();
    }

    public function create(Request $request)
    {
        $validationData = $request->validate(['category_id' => 'required|exists:categories,id',]);
        if ($validationData['category_id'] == 1) {
            return view('dashboard.ads.create');

        } elseif ($validationData['category_id'] == 2) {
            return view('dashboard.ads.create');

        } elseif ($validationData['category_id'] == 3) {
            return view('dashboard.ads.create');

        } elseif ($validationData['category_id'] == 4) {
            return view('dashboard.ads.create');

        } elseif ($validationData['category_id'] == 5) {
            return view('dashboard.ads.create');

        } elseif ($validationData['category_id'] == 6) {
            return view('dashboard.ads.create');

        } else {
            flash()->success(' هذا القسم لا يوجد له اي اعلانات  ');
            return redirect()->back();
        }
    }

    public function show(Ad $ad)
    {
        return view('dashboard.ads.details_ads', ['ad' => $ad]);
    }

    public function notify_edit(Request $request, $ad)
    {
        dd($ad);
    }
}
