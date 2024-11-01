<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index()
    {
        $comment = Comment::where('user_id', Auth::id())->get();
        return response()->json(['Data' => $comment, 'message' => 'comment added successfully'], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(['ad_id' => 'required|exists:ads,id', 'content' => 'required|string']);
        $ad = Ad::where('id', $validatedData['ad_id'])->first();
        if (Auth::id() === $ad->user_id) {
            return response()->json(['message' => 'Your ad cannot be commented on.'], 500);
        }
        $comment = Comment::where('user_id', Auth::id())->where('ad_id', $validatedData['ad_id'])->first();
        if ($comment) {
            return response()->json(['message' => 'You cannot comment twice on the same ad.'], 500);
        }
        $comment = Comment::create([...$validatedData, 'user_id' => Auth::id()]);
        return response()->json(['Data' => $comment, 'message' => 'comment added successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::where('id', $id)->where('user_id', Auth::id())->first();
        if ($comment) {
            $validatedData = $request->validate(['content' => 'required|string']);
            $comment->update($validatedData);
            return response()->json(['Data' => $comment, 'message' => 'comment Updated successfully'], 200);
        }
        return response()->json(['message' => 'comment Not Found'], 404);
    }

    public function destroy($id)
    {
        $comment = Comment::where('id', $id)->where('user_id', Auth::id())->first();
        if ($comment) {
            $comment->delete();
            return response()->json(['Data' => $comment, 'message' => 'comment Deleted successfully'], 200);
        }
        return response()->json(['message' => 'comment Not Found'], 404);
    }
}
