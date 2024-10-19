<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
use App\Http\Requests\JwtAuthRequest;
use Illuminate\Http\Request;

class JWTAuthController extends Controller
{
    public function register(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'overview' => 'required|string', // Adjust if you want to impose length limits
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15', // Adjust length according to your needs
            'type' => 'required|in:personal,company,admin',
            'country_id' => 'nullable|exists:countries,id', // Ensure the country exists in countries table
            'contact_number' => 'nullable|string|max:15', // Adjust length according to your needs
            'whatsapp_number' => 'nullable|string|max:15', // Adjust length according to your needs
        ]);
    
        // Hash the password
        $validatedData['password'] = bcrypt($validatedData['password']);
    
        try {
            // Create the user and generate a token
            $user = User::create($validatedData);
            $token = JWTAuth::fromUser($user);
    
            return response()->json([
                'message' => 'User registered successfully.',
                'user' => $user,
                'token' => $token,
            ], 201);
    
        } catch (\Exception $e) {
            // Return the actual error message for debugging
            return response()->json(['error' => 'User registration failed. Error: ' . $e->getMessage()], 500);
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
