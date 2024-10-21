<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        if (Auth::User()->experiences()->isNotEmpty()) {
            return response()->json([
                'success' => 'Your Experience. ',
                'data' => Auth::User()->experiences()
            ], 200);
        }
        return response()->json(['success' => 'No experiences for You']);
    }

    public function store(ExperienceRequest $request)
    {
        $experience = Experience::create([
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);
        return response()->json([
            'success' => 'Experience Created Successfully. ',
            'data' => new ExperienceResource($experience)
        ], 201);
    }

    public function update(ExperienceRequest $request, Experience $experience)
    {
        $experience->update($request->validated());
        return response()->json([
            'success' => 'Experience Created Successfully. ',
            'data' => new ExperienceResource($experience)
        ], 201);
    }


    public function destroy($id)
    {
        $experience = Experience::where('id', $id)->first();
        if ($experience) {
            if (auth()->user()->id === $experience->user_id) {
                $experience->delete();
                return response()->json(['success' => 'Experience deleted successfully']);
            }
        }
        return response()->json(['error' => 'An error occurred']);
    }
}
