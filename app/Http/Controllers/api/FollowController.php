<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FolloweringResource;
use App\Http\Resources\FollowerResource;
use App\Http\Resources\FollowResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // following_id => انا من اترسل ليا طلب المتابعه
    // follower_id  => انا من قومت بارسال طلب المتابعه

    // ارسال طلب متابعه

    use ApiResponseTrait;

    public function addFollow($user_id)
    {
        $user = User::where('id', $user_id)->first();

        if (!$user) {
            return response()->json(['message' => 'The user you want to send a follow request to does not exist.'], 404);
        }

        if ($user->id === Auth::id()) {
            return response()->json(['message' => 'You cannot send a follow request to yourself'], 500);
        }

        $followError1 = Follow::where('follower_id', Auth::id())->where('following_id', $user_id)->first();
        if ($followError1) {
            return response()->json(['message' => 'You cannot send a follow request more than once'], 500);
        }

        $followError2 = Follow::where('follower_id', $user_id)->where('following_id', Auth::id())->first();
        if ($followError2) {
            return response()->json(['message' => 'You cannot send a follow request to this person because he has already sent you a follow request. Please accept it o'], 500);
        }

        $follow = Follow::create(['follower_id' => Auth::id(), 'following_id' => $user->id]);
        return response()->json(['Data' => new FollowResource($follow), 'message' => 'You Send Follow Request successfully'], 201);
    }

    // الغاء طلب المتابعه

    public function cancelFollow($user_id)
    {
        $follow = Follow::where('follower_id', Auth::id())->Orwhere('following_id', $user_id)->first();
        if (!$follow) {
            return response()->json(['message' => ' Your follow request has already been cancelled'], 404);
        }
        $follow->delete();
        return response()->json(['message' => ' The follow request was successfully cancelled'], 200);
    }


    public function showFollower()
    {
        return response()->json(['message' => 'Your Follower', 'Data' => FollowerResource::collection(Auth()->user()->followers())], 200);
    }


    public function countFollower()
    {
        return response()->json(['message' => 'Count Your Follower', 'Data' => Auth()->user()->followers()->count()], 200);
    }


    public function showFollowing()
    {
        return response()->json(['message' => ' Your Following', 'Data' => FolloweringResource::collection(Auth()->user()->followings())], 200);
    }

    public function countFollowing()
    {
        return response()->json(['message' => 'Count Your Following', 'Data' => Auth()->user()->followings()->count()], 200);
    }


}
