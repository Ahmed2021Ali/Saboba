<?php

use App\Http\Controllers\Auth\JWTAuthController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\User;
use Illuminate\Support\Facades\Validator;


Route::post('register', [JWTAuthController::class, 'register']);
Route::post('login', [JWTAuthController::class, 'login'])->name('login');
Route::get('get-user', [JWTAuthController::class, 'getUser']);


Route::middleware([JwtMiddleware::class])->group(function () {
    Route::post('logout', [JWTAuthController::class, 'logout']);
});


// Route::get('/users', function () {
//     return response()->json(User::with('translations')->get());
// });

// Route::post('/create-users', function (Request $request) {
//     $validator = Validator::make($request->all(), [
//         'email' => 'required|email|unique:users,email',
//         'password' => 'required|string|min:6',
//         'phone' => 'required|string',
//         'type' => 'required|in:personal,company,admin',
//         'country_id' => 'required|exists:countries,id',
//         'name' => 'required|string',
//         'overview' => 'nullable|string',
//         'locale' => 'required|string',
//     ]);

//     if ($validator->fails()) {
//         return response()->json($validator->errors(), 422);
//     }

//     $user = User::create($request->only('email', 'password', 'phone', 'type', 'country_id'));
//     $user->translateOrNew($request->locale)->name = $request->name;
//     $user->translateOrNew($request->locale)->overview = $request->overview;
//     $user->save();

//     return response()->json($user, 201);
// });

// Route::put('/users/{id}', function (Request $request, $id) {
//     $user = User::findOrFail($id);

//     $validator = Validator::make($request->all(), [
//         'email' => 'required|email|unique:users,email,' . $user->id,
//         'password' => 'nullable|string|min:6',
//         'phone' => 'required|string',
//         'type' => 'required|in:personal,company,admin',
//         'country_id' => 'required|exists:country,id',
//         'name' => 'required|string',
//         'overview' => 'nullable|string',
//         'locale' => 'required|string',
//     ]);

//     if ($validator->fails()) {
//         return response()->json($validator->errors(), 422);
//     }

//     $user->update($request->only('email', 'password', 'phone', 'type', 'country_id'));
//     $user->translateOrNew($request->locale)->name = $request->name;
//     $user->translateOrNew($request->locale)->overview = $request->overview;
//     $user->save();

//     return response()->json($user);
// });

// Route::delete('/users/{id}', function ($id) {
//     $user = User::findOrFail($id);
//     $user->delete();
//     return response()->json(null, 204);
// });