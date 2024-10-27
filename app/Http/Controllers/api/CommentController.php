<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index()
    {
        $comment = Comment::where('user_id', Auth::id())->get();
        return response()->json(['Data' => $comment, 'success' => 'comment added successfully'], 201);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(['ad_id' => 'required|exists:ads,id', 'content' => 'required|string']);
        $comment = Comment::create([...$validatedData, 'user_id' => Auth::id()]);
        return response()->json(['Data' => $comment, 'success' => 'comment added successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::where('id', $id)->where('user_id', Auth::id())->first();
        if ($comment) {
            $validatedData = $request->validate(['content' => 'required|string']);
            $comment->update($validatedData);
            return response()->json(['Data' => $comment, 'success' => 'comment Updated successfully'], 201);
        }
        return response()->json(['error' => 'comment Not Found'], 404);
    }

    public function destroy($id)
    {
        $comment = Comment::where('id', $id)->where('user_id', Auth::id())->first();
        if ($comment) {
            $comment->delete();
            return response()->json(['Data' => $comment, 'success' => 'comment Deleted successfully'], 201);
        }
        return response()->json(['error' => 'comment Not Found'], 404);
    }
}
