<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index()
    {
        $experience = Experience::where('user_id', auth()->user()->id)->first();
        return response()->json(new ExperienceResource($experience));
    }

    public function store(StoreExperienceRequest $request)
    {
        $educate = Experience::create([
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(new ExperienceResource($educate));
    }

    public function update(UpdateExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->validated());
        return response()->json(new ExperienceResource($experience));
    }

    public function destroy(Experience $experience)
    {
        $experience->delete();
        return response()->json(['message' => 'Delete Successfully'], 200);
    }
}
