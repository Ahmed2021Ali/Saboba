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
        if (Auth::User()->basicInformation->isEmpty()) {
            return response()->json([
                'message' => 'No  Basic Information For You  ',
            ], 404);
        }
        return response()->json([
            'message' => 'Your Basic Information ',
            'Data' => Auth::User()->basicInformation()
        ], 200);
    }

    public function store(BasicInformationRequest $request)
    {
        $basicInformation = BasicInformation::updateOrCreate(['user_id' => auth()->user()->id], [
            ...$request->validated(), 'user_id' => auth()->user()->id]);

        return response()->json([
            'message' => 'your Basic Information Updated ',
            'Data' => Auth::User()->basicInformation()
        ], 201);
    }
}
