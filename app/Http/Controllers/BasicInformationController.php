<?php

namespace App\Http\Controllers;

use App\Http\Requests\BasicInformationRequest;
use App\Http\Resources\BasicInformationResource;
use App\Models\BasicInformation;

class BasicInformationController extends Controller
{
    public function index()
    {
        $job = BasicInformation::where('user_id', auth()->user()->id)->first();
        return response()->json(new BasicInformationResource($job));
    }

    public function store(BasicInformationRequest $request)
    {
        $job = BasicInformation::create([
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(new BasicInformationResource($job));
    }

    public function update(BasicInformationRequest $request, BasicInformation $basicInformation)
    {
        $basicInformation->update($request->validated());
        return response()->json(new BasicInformationResource($basicInformation));
    }

    public function destroy(BasicInformation $basicInformation)
    {
        $basicInformation->delete();
        return response()->json(['message' => 'Delete Successfully'], 200);
    }
}
