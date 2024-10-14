<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationRequest;
use App\Http\Requests\JobProfileRequest;
use App\Http\Resources\EducationResource;
use App\Models\Education;
use App\Models\JobProfile;

class EducationController extends Controller
{
    public function index()
    {
        $educate = Education::where('job_profile_id', auth()->user()->jobProfile()->id)->first();
        return response()->json(new EducationResource($educate));
    }

    public function store(EducationRequest $request)
    {
        $educate = Education::create([
            ...$request->validated(),
            'job_profile_id' => auth()->user()->jobProfile()->id,
        ]);
        return response()->json(new EducationResource($educate));
    }

    public function update(EducationRequest $request, Education $educate)
    {
        /*        $job_profile->update($request->validated());
                return response()->json(new JopProfileResource($job_profile));*/
    }

    public function destroy(Education $educate)
    {
        $educate->delete();
        return response()->json(['message' => 'Delete Successfully'], 200);
    }
}
