<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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
                'message' => 'Your Experience. ',
                'Data' => Auth::User()->experiences()
            ], 200);
        }
        return response()->json(['message' => 'No experiences for You'], 404);
    }

    public function store(ExperienceRequest $request)
    {
        $experience = Experience::create([
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);
        return response()->json([
            'message' => 'Experience Created Successfully. ',
            'Data' => new ExperienceResource($experience)
        ], 201);
    }

    public function update(ExperienceRequest $request, $id)
    {
        $experience = Experience::where('id', $id)->first();
        if ($experience) {
            $experience->update($request->validated());
            return response()->json([
                'message' => 'Experience Created Successfully. ',
                'Data' => new ExperienceResource($experience)
            ], 200);
        }
        return response()->json(['error' => 'An error occurred'], 404);
    }


    public function destroy($id)
    {
        $experience = Experience::where('id', $id)->first();
        if ($experience) {
            if (auth()->user()->id === $experience->user_id) {
                $experience->delete();
                return response()->json(['message' => 'Experience deleted successfully'], 200);
            }
        }
        return response()->json(['error' => 'An error occurred'], 404);
    }
}
