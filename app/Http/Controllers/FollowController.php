<?php

namespace App\Http\Controllers;

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
        $user = User::findOrFail($user_id);
        if ($user->id === Auth::id()) {
            return response()->json(['message' => 'You cannot send a follow request to yourself']);
        }
        $followError1 = Follow::where('follower_id', Auth::id())->where('following_id', $user_id)->where('status', 'pending')->first();
        if ($followError1) {
            return response()->json(['message' => 'You cannot send a follow request more than once']);
        }
        $followError2 = Follow::where('follower_id', $user_id)->where('following_id', Auth::id())->where('status', 'pending')->first();
        if ($followError2) {
            return response()->json(['message' => 'You cannot send a follow request to this person because he has already sent you a follow request. Please accept it o']);
        }
        $follow = Follow::create(['follower_id' => Auth::id(), 'following_id' => $user->id, 'status' => 'pending']);
        return response()->json([new FollowResource($follow),'message' => 'You cannot send a follow request to this person because he has already sent you a follow request. Please accept it o']);
    }

    // الغاء طلب المتابعه

    public function cancelFollow($user_id)
    {
        $follow = Follow::where('follower_id', Auth::id())->Orwhere('following_id', $user_id)->first();
        if (!$follow) {
            return response()->json(['message' => ' Your follow request has already been cancelled']);
        }
        $follow->delete();
        return response()->json(['message' => ' The follow request was successfully cancelled']);
    }

// قبول طلب المتابعه  المرسل

    public function acceptFollow($user_id)
    {
        $follow = Follow::where('following_id', Auth::id())->where('follower_id', $user_id)->where('status', 'pending')->first();
        if ($follow) {
            $follow->status = 'accept';
            $follow->save();
            return response()->json($follow,['message' => ' Follow-up request has been successfully accepted']);
        }
        return response()->json($follow,['message' => 'An error occurred']);
    }

// رفض طلب المتابعه  المرسل

    public function rejectFollow($user_id)
    {
        $follow = Follow::where('following_id', Auth::id())->where('follower_id', $user_id)->where('status', 'pending')->first();
        if ($follow) {
            $follow->status = 'reject';
            $follow->save();
            return $this->successResponse($follow, 'Your follow request has been successfully declined.', 200);
        }
        return $this->errorResponse('An error occurred.', null);
    }


    public function showFollower()
    {
        return response()->json(['followers' => FollowerResource::collection(Auth()->user()->followers())]);
    }


    public function countFollower()
    {
        return response()->json(['count followers' => Auth()->user()->followers()->count()]);
    }


    public function showFollowing()
    {
        return response()->json(['followings' => FolloweringResource::collection(Auth()->user()->followings())]);
    }

    public function countFollowing()
    {
        return response()->json(['count followings' => Auth()->user()->followings()->count()]);
    }


}
