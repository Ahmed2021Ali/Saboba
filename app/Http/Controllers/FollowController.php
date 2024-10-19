<?php

namespace App\Http\Controllers;

use App\Http\Resources\FolloweringResource;
use App\Http\Resources\FollowerResource;
use App\Http\Resources\FollowResource;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // following_id => انا من اترسل ليا طلب المتابعه
    // follower_id  => انا من قومت بارسال طلب المتابعه

    // ارسال طلب متابعه

    public function addFollow($user_id)
    {
        $user = User::findOrFail($user_id);
        if ($user->id === Auth::id()) {
            return response()->json(['message' => 'You cannot send a follow request to yourself.'], 404);
        }
        $followError1 = Follow::where('follower_id', Auth::id())->where('following_id', $user_id)->where('status', 'pending')->first();
        if ($followError1) {
            return response()->json(['message' => 'You cannot send a follow request more than once.'], 404);
        }
        $followError2 = Follow::where('follower_id', $user_id)->where('following_id', Auth::id())->where('status', 'pending')->first();
        if ($followError2) {
            return response()->json(['message' => 'You cannot send a follow request to this person because he has already sent you a follow request. Please accept it or'], 404);
        }
        $follow = Follow::create(['follower_id' => Auth::id(), 'following_id' => $user->id, 'status' => 'pending']);
        return response()->json(['message' => 'Follow-up request has been sent successfully', 'follow' => new FollowResource($follow)], 201);
    }

    // الغاء طلب المتابعه

    public function cancelFollow($user_id)
    {
        $follow = Follow::where('follower_id', Auth::id())->Orwhere('following_id', $user_id)->first();
        if (!$follow) {
            return response()->json(['message' => 'Your follow request has already been cancelled.']);
        }
        $follow->delete();
        return response()->json(['message' => 'The follow request was successfully cancelled.'], 201);
    }

// قبول طلب المتابعه  المرسل

    public function acceptFollow($user_id)
    {
        $follow = Follow::where('following_id', Auth::id())->where('follower_id', $user_id)->where('status', 'pending')->first();
        if ($follow) {
            $follow->status = 'accept';
            $follow->save();
            return response()->json(['message' => 'Follow-up request has been successfully accepted.', 'follow' => $follow], 201);
        }
        /*        if ($follow->status === 'accept' && $follow->following_id === Auth::id()) {
                    return response()->json(['message' => 'The request has already been accepted.', 'follow' => $follow], 201);
                }*/
        return response()->json(['error' => ' An error occurred. '], 404);
    }

// رفض طلب المتابعه  المرسل

    public function rejectFollow($user_id)
    {
        $follow = Follow::where('following_id', Auth::id())->where('follower_id', $user_id)->where('status', 'pending')->first();
        if ($follow) {
            $follow->status = 'reject';
            $follow->save();
            return response()->json(['message' => 'Your follow request has been successfully declined.', 'follow' => $follow], 201);
        }
        return response()->json(['error' => ' An error occurred. ',], 404);
    }



    public function showFollower()
    {
        return response()->json(FollowerResource::collection(Auth()->user()->followers()), 201);
    }



    public function countFollower()
    {
        return response()->json(['followers' => Auth()->user()->followers()->count()], 201);
    }



    public function showFollowing()
    {
        return response()->json(FolloweringResource::collection(Auth()->user()->followings()));
    }

    public function countFollowing()
    {
        return response()->json(['followings' => Auth()->user()->followings()->count()], 201);
    }


}
