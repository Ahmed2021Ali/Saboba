<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    public function index()
    {
        if (Auth::User()->experiences()->isNotEmpty()) {
            return response()->json(Auth::User()->experiences());
        }
        return response()->json(['message' => 'No experiences for You'], 200);
    }

    public function store(ExperienceRequest $request)
    {
        $experience = Experience::updateOrCreate(['user_id' => auth()->user()->id], [
            ...$request->all(),
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(new ExperienceResource($experience));
    }


    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        if (auth()->user()->id === $experience->user_id) {
            $experience->delete();
            return response()->json(['message' => 'Delete Successfully'], 200);
        }
        return response()->json(['error' => 'invalid'], 500);
    }
}
