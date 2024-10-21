<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasicInformationRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\BasicInformation;
use Illuminate\Support\Facades\Auth;

class BasicInformationController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        return response()->json([
            'success' => 'Your Basic Information ',
            'data' => Auth::User()->basicInformation()
        ], 200);
    }

    public function store(BasicInformationRequest $request)
    {
        BasicInformation::updateOrCreate(['user_id' => auth()->user()->id], [
            ...$request->validated(), 'user_id' => auth()->user()->id]);

        return response()->json([
            'success' => 'your Basic Information Updated ',
            'data' => Auth::User()->basicInformation()
        ], 201);
    }
}
