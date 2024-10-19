<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // following => انا من اترسل ليا طلب المتابعه
    // follower  => انا من قومت بارسال طلب المتابعه

    // ارسال طلب متابعه
    public function addFollow($user_id)
    {
        $user = User::findOrFail($user_id);
        if ($user->id === Auth::id()) {
            return response()->json([
                'message' => 'You cannot send a follow request to yourself.',
            ], 404);
        }
        $follower = Follow::create(['follower' => Auth::id(), 'following' => $user->id, 'status' => 'pending']);
        return response()->json([
            'message' => 'Follow-up request has been sent successfully',
            'follow' => $follower
        ], 201);
    }

// قبول طلب المتابعه  المرسل
    public function acceptFollow($follow_id)
    {
        $follow = Follow::findOrFail($follow_id);
        if ($follow->status === 'pending' && $follow->following === Auth::id()) {
            $follow->status = 'accept';
            $follow->save();
            return response()->json(['message' => 'Follow-up request has been successfully accepted.', 'follow' => $follow], 201);
        }
        return response()->json(['error' => ' An error occurred. ', 'follow' => $follow, 'Your' => Auth()->user()], 404);
    }

// رفض طلب المتابعه  المرسل
    public function rejectFollow($follow_id)
    {
        $follow = Follow::findOrFail($follow_id);
        if ($follow->status === 'pending' && $follow->following === Auth::id()) {
            $follow->status = 'reject';
            $follow->save();
            return response()->json(['message' => 'Your follow request has been successfully declined.', 'follow' => $follow], 201);
        }
        return response()->json(['error' => ' An error occurred. ', 'follow' => $follow, 'Your' => Auth()->user()], 404);
    }

    // الغاء طلب المتابعه بعد عملية القبول
    public function cancelFollow($follow_id)
    {
        $follow = Follow::findOrFail($follow_id);
        if ($follow->status === 'accept' && ($follow->following === Auth::id() || $follow->follower === Auth::id())) {
            $follow->delete();
            return response()->json(['message' => 'The follow request was successfully cancelled.', 'follow' => $follow], 201);
        }
        return response()->json(['error' => ' An error occurred. ', 'follow' => $follow, 'Your' => Auth()->user()], 404);

    }

    public function showFollower()
    {
        $follower = Follow::where('follower', Auth::id())->get();

    }

    public function countFollower()
    {
        $follower = Follow::where('follower', Auth::id())->count();
        return response()->json(['follower' => $follower], 201);

    }

    public function showFollowing()
    {
        $follower = Follow::where('following', Auth::id())->get();

    }

    public function countFollowing()
    {
        $following = Follow::where('following', Auth::id())->count();
        return response()->json(['follower' => $following], 201);
    }
}
