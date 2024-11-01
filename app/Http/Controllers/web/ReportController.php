<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportController extends Controller
{
    public function adsReport()
    {
        $reportAds = Report::where('ad_id', '!=', null)->get();
        return view('dashboard.report_ads.index', compact('reportAds'));
    }

    public function commentsReport()
    {
        $reportComments = Report::where('comment_id', '!=', null)->get();
        return view('dashboard.report_comments.index', compact('reportComments'));
    }

    public function commentUser()
    {
        //$reportComments = Report::where('receiver_id', '!=', null)->get();
      //  return view('dashboard.report_comments.index', compact('reportComments'));
    }
}
