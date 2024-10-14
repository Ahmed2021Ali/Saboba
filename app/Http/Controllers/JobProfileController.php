<?php

namespace App\Http\Controllers;

use App\Http\Resources\JopProfileResource;
use App\Models\JobProfile;
use Illuminate\Http\Request;

class JobProfileController extends Controller
{
    public function index()
    {
        $jobs = JobProfile::all();
        return response()->json(JopProfileResource::collection($jobs));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nationality' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'job_title' => 'required',
            'user_id' => 'required',
        ]);
        $job = JobProfile::create($request->validated());
        return response()->json(new JopProfileResource($job));
    }
}
