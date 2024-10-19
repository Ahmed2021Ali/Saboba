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
        return $this->successResponse(Auth::User()->basicInformation(), 'your Basic Information', 200);
    }

    public function store(BasicInformationRequest $request)
    {
        if (auth()->user()->type === '')
            $basicInformation = BasicInformation::updateOrCreate(['user_id' => auth()->user()->id], [
                ...$request->validated(), 'user_id' => auth()->user()->id]);

        return $this->successResponse($basicInformation, 'your Basic Information Created', 201);

    }
}
