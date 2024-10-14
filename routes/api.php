<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

Route::get('/users', function () {
    return response()->json(User::with('translations')->get());
});

// إضافة مستخدم جديد
Route::post('/create-users', function (Request $request) {
    // التحقق من صحة البيانات
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'phone' => 'required|string',
        'type' => 'required|in:personal,company,admin',
        'country_id' => 'required|exists:countries,id',
        'name' => 'required|string',
        'overview' => 'nullable|string',
        'locale' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user = User::create($request->only('email', 'password', 'phone', 'type', 'country_id'));
    $user->translateOrNew($request->locale)->name = $request->name;
    $user->translateOrNew($request->locale)->overview = $request->overview;
    $user->save();

    return response()->json($user, 201);
});

// تحديث مستخدم
Route::put('/users/{id}', function (Request $request, $id) {
    // التحقق من صحة البيانات
    $user = User::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:6',
        'phone' => 'required|string',
        'type' => 'required|in:personal,company,admin',
        'country_id' => 'required|exists:country,id',
        'name' => 'required|string',
        'overview' => 'nullable|string',
        'locale' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user->update($request->only('email', 'password', 'phone', 'type', 'country_id'));
    $user->translateOrNew($request->locale)->name = $request->name;
    $user->translateOrNew($request->locale)->overview = $request->overview;
    $user->save();

    return response()->json($user);
});

// حذف مستخدم
Route::delete('/users/{id}', function ($id) {
    $user = User::findOrFail($id);
    $user->delete();
    return response()->json(null, 204);
});