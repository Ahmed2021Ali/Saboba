<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use App\Http\Requests\JwtAuthRequest;
use App\Http\Traits\ApiResponseTrait as TraitsApiResponseTrait;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class JWTAuthController extends Controller
{

    use TraitsApiResponseTrait;

    public function register(JwtAuthRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $validatedData['password'] = Hash::make($validatedData['password']);
            $user = User::create($validatedData);
            $token = JWTAuth::fromUser($user);

            return $this->successResponse([
                'user' => $user,
                'token' => $token
            ], 'User registered successfully', 201);

        } catch (QueryException $e) {
            return $this->errorResponse('Database error: ' . $e->getMessage(), 500);

        } catch (\Exception $e) {
            return $this->errorResponse('User registration failed. Please try again.', 500);
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
    
        return $this->successResponse([
            'user' => $userData,
            'token' => $token
        ], 'Login successful', 200);
    }
    

    public function logout()
{
    try {
        JWTAuth::invalidate(JWTAuth::getToken());
        return $this->successResponse([], 'Successfully logged out', 200);
    } catch (JWTException $e) {
        return $this->errorResponse('Could not log out', 500);
    }
}
}
