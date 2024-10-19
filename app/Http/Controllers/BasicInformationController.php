<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasicInformationRequest;
use App\Http\Resources\BasicInformationResource;
use App\Models\BasicInformation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class BasicInformationController extends Controller
{

    public function index()
    {
        return response()->json(['message' => 'your Basic Information',
            'basicInformation' => Auth::User()->basicInformation()], 201);
    }

    public function store(BasicInformationRequest $request)
    {
        if (auth()->user()->type === '')
            $basicInformation = BasicInformation::updateOrCreate(['user_id' => auth()->user()->id], [
                ...$request->validated(), 'user_id' => auth()->user()->id]);

        return response()->json([
            'message' => 'your Basic Information Created.',
            'basicInformation' => $basicInformation],
            201);
    }
}
