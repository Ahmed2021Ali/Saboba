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
            return response()->json(Auth::User()->experiences());
        }
        return response()->json(['success'=>'No experiences for You']);
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
        $experience = Experience::where('id',$id)->first();
        if ($experience) {
            if (auth()->user()->id === $experience->user_id) {
                $experience->delete();
                return response()->json(['success'=>'Experience deleted successfully']);
            }
        }
        return response()->json(['error'=>'An error occurred']);
    }
}
