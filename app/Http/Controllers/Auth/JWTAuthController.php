<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use App\Http\Requests\JwtAuthRequest;

class JWTAuthController extends Controller
{
    public function register(JwtAuthRequest $request)
    {
        $validatedData = $request->validated();

        $validatedData['password'] = bcrypt($validatedData['password']);

        try {
            $user = User::create($validatedData);

            $token = JWTAuth::fromUser($user);

            return response()->json([
                'message' => 'User registered successfully.',
                'user' => $user,
                'token' => $token,
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => 'User registration failed. Please try again later.'], 500);
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
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $userData = auth()->user();

        return response()->json([
            'user' => $userData,
            'token' => $token,
        ], 200);
    }


    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not log out'], 500);
        }
    }
}
