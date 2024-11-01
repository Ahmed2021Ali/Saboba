<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Report;

class ReportCommentController extends Controller
{

    public function index()
    {
        $reportComments = Report::where('comment_id', '!=', null)->get();
        return view('dashboard.report_comments.index', compact('reportComments'));
    }



}
