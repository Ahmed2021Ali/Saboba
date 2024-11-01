<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportAdsController extends Controller
{

    public function index()
    {
        $reportAds = Report::where('ad_id', '!=', null)->get();
        return view('dashboard.report_ads.index', compact('reportAds'));
    }

    public function notify(Request $request,$id)
    {
        dd($request->reason,$id);
    }


}
