<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobProfileRequest;
use App\Http\Resources\JopProfileResource;
use App\Models\JobProfile;
use Illuminate\Http\Request;

class JobProfileController extends Controller
{
    public function index()
    {
        $job = JobProfile::where('user_id', auth()->user()->id)->first();
        return response()->json(new JopProfileResource($job));
    }

    public function store(JobProfileRequest $request)
    {
        $job = JobProfile::create([
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(new JopProfileResource($job));
    }

    public function update(JobProfileRequest $request, JobProfile $job_profile)
    {
        $job_profile->update($request->validated());
        return response()->json(new JopProfileResource($job_profile));
    }

    public function destroy(JobProfile $job_profile)
    {
        $job_profile->delete();
        return response()->json(['message' => 'Delete Successfully'], 200);
    }
}
