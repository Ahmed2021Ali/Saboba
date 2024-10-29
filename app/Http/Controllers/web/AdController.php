<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdField;
use App\Models\AdTranslation;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::with('translatedAttributes')->get();
        dd($ads);
       // $adTranslations = AdTranslation::where('ad_id', $ad->id)->get();
      //  $adFields = AdField::where('ad_id', $ad->id)->get();
    }
}
