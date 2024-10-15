<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;
use App\Http\Resources\EducationResource;
use App\Models\Education;

class EducationController extends Controller
{

    public function index()
    {
        $educate = Education::where('user_id', auth()->user()->id)->first();
        return response()->json(new EducationResource($educate));
    }

    public function store(StoreEducationRequest $request)
    {
        $educate = Education::create([
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(new EducationResource($educate));
    }

    public function update(UpdateEducationRequest $request, Education $education)
    {
        $education->update($request->validated());
        return response()->json(new EducationResource($education));
    }

    public function destroy(Education $education)
    {
        $education->delete();
        return response()->json(['message' => 'Delete Successfully'], 200);
    }
}
