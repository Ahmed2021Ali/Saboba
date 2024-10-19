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
            return $this->errorResponse('You cannot send a follow request to yourself', null);
        }
        $followError1 = Follow::where('follower_id', Auth::id())->where('following_id', $user_id)->where('status', 'pending')->first();
        if ($followError1) {
            return $this->errorResponse('You cannot send a follow request more than once.', null);
        }
        $followError2 = Follow::where('follower_id', $user_id)->where('following_id', Auth::id())->where('status', 'pending')->first();
        if ($followError2) {
            return $this->errorResponse('You cannot send a follow request to this person because he has already sent you a follow request. Please accept it or', null);
        }
        $follow = Follow::create(['follower_id' => Auth::id(), 'following_id' => $user->id, 'status' => 'pending']);
        return $this->successResponse(new FollowResource($follow), 'Follow-up request has been sent successfully', 200);
    }

    // الغاء طلب المتابعه

    public function cancelFollow($user_id)
    {
        $follow = Follow::where('follower_id', Auth::id())->Orwhere('following_id', $user_id)->first();
        if (!$follow) {
            return $this->errorResponse('Your follow request has already been cancelled', null);
        }
        $follow->delete();
        return $this->successResponse(null, 'The follow request was successfully cancelled', 200);
    }

// قبول طلب المتابعه  المرسل

    public function acceptFollow($user_id)
    {
        $follow = Follow::where('following_id', Auth::id())->where('follower_id', $user_id)->where('status', 'pending')->first();
        if ($follow) {
            $follow->status = 'accept';
            $follow->save();
            return $this->successResponse($follow, 'Follow-up request has been successfully accepted', 200);
        }
        return $this->errorResponse('An error occurred.', null);
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
        return $this->successResponse(FollowerResource::collection(Auth()->user()->followers()), null, 200);
    }


    public function countFollower()
    {
        return $this->successResponse(Auth()->user()->followers()->count(), null, 200);
    }


    public function showFollowing()
    {
        return $this->successResponse(FolloweringResource::collection(Auth()->user()->followings()), null, 200);
    }

    public function countFollowing()
    {
        return $this->successResponse(Auth()->user()->followings()->count(), null, 200);
    }


}
