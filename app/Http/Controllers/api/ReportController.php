<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Comment;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{

    public function sendReportAd(Request $request)
    {
        $validationData = $request->validate([
            'content' => 'required|string', 'ad_id' => 'required|exists:ads,id',
        ]);
        $ad = ad::find($validationData['ad_id']);
        if (Auth::id() === $ad->user_id) {
            return response()->json(['message' => 'You cannot report your ad'], 500);
        }
        $checkReport = Report::where('ad_id', $validationData['ad_id'])->where('sender_id', Auth::id())->first();
        if ($checkReport) {
            $checkReport->content = $validationData['content'];
            $checkReport->save();
            return response()->json(['Data' => $checkReport, 'message' => 'Report Update successfully'], 200);
        }

        $report = Report::create(['content' => $validationData['content'],
            'ad_id' => $validationData['ad_id'], 'sender_id' => Auth::id()
        ]);
        return response()->json(['Data' => $report, 'message' => 'Report added successfully'], 201);
    }

    public function sendReportUser(Request $request)
    {
        $validationData = $request->validate([
            'content' => 'required|string', 'receiver_id' => 'required|exists:users,id',
        ]);
        $receiver = User::find($validationData['receiver_id']);
        if (Auth::id() === $receiver->id) {
            return response()->json(['message' => 'You cannot report your yourself'], 500);
        }
        if ($validationData['receiver_id'] == Auth::id()) {
            return response()->json(['message' => 'You cannot send a report_ads to yourself.'], 500);
        }

        $checkReport = Report::where('receiver_id', $validationData['receiver_id'])->where('sender_id', Auth::id())->first();
        if ($checkReport) {
            $checkReport->content = $validationData['content'];
            $checkReport->save();
            return response()->json(['Data' => $checkReport, 'message' => 'Report Update successfully'], 200);
        }

        $report = Report::create(['content' => $validationData['content'],
            'receiver_id' => $validationData['receiver_id'], 'sender_id' => Auth::id()
        ]);
        return response()->json(['Data' => $report, 'message' => 'Report added successfully'], 201);
    }

    public function sendReportComment(Request $request)
    {

        $validationData = $request->validate([
            'content' => 'required|string',
            'comment_id' => 'required|exists:comments,id'
        ]);
        $comment = Comment::find($validationData['comment_id']);
        if (Auth::id() === $comment->user_id) {
            return response()->json(['message' => 'You cannot report your Comment'], 500);
        }
        $checkReport = Report::where('comment_id', $validationData['comment_id'])->where('sender_id', Auth::id())->first();
        if ($checkReport) {
            $checkReport->content = $validationData['content'];
            $checkReport->save();
            return response()->json(['Data' => $checkReport, 'message' => 'Report Update successfully'], 200);
        }

        $report = Report::create(['content' => $validationData['content'],
            'comment_id' => $validationData['comment_id'], 'sender_id' => Auth::id()
        ]);
        return response()->json(['Data' => $report, 'message' => 'Report added successfully'], 201);
    }
}
