<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\JwtAuthRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Resources\UserResource;
use App\Http\Traits\ApiResponseTrait as TraitsApiResponseTrait;
use App\Http\Traits\media;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTAuthController extends Controller
{

    use TraitsApiResponseTrait, media;

    public function register(JwtAuthRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $validatedData['password'] = Hash::make($validatedData['password']);
            $user = User::create($validatedData);
            $token = JWTAuth::fromUser($user);
            $this->downloadImages($request->images, $user, 'userImages');
            return response()->json([
                'Data' => new UserResource($user),
                'token' => $token,
                'message' => 'User registered successfully'
            ], 201);

        } catch (QueryException $e) {
            return response()->json(['message' => 'Database error' . $e->getMessage()], 500);

        } catch (\Exception $e) {
            return response()->json(['message' => 'User registration failed. Please try again.'], 500);
        }
    }

    public function login(JwtAuthRequest $request)
    {
        $validatedData = $request->validated();

        $credentials = [
            'phone' => $validatedData['phone'],
            'password' => $validatedData['password']
        ];

        if (!$token = JWTAuth::attempt($credentials)) {
            return $this->errorResponse('Invalid credentials', 401);
        }

        $userData = auth()->user();

        return response()->json([
            'Data' => new UserResource($userData),
            'token' => $token,
            'message' => 'Login successful'
        ], 200);
    }


    public function updateUserProfile(UpdateUserProfileRequest $request)
    {
        $user = auth()->user();
        $validatedData = $request->validated();
        if ($validatedData['password']) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }
        $this->updateImages($validatedData['images'], $user, 'userImages');
        $user->update($request->validated());

        return response()->json([
            'Data' => new UserResource($user),
            'message' => 'User Updated successfully'
        ], 200);
    }


    public function getAuthUser()
    {
        return response()->json([
            'Data' => new UserResource(Auth::user()),
            'message' => 'The user who is currently logged in'
        ], 200);
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (JWTException $e) {
            return response()->json(['message' => 'Could not log out'], 500);
        }
    }


}
