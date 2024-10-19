<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExperienceRequest;
use App\Http\Resources\ExperienceResource;
use App\Models\Education;
use App\Models\Experience;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class ExperienceController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        if (Auth::User()->experiences()->isNotEmpty()) {
            return $this->successResponse(Auth::User()->experiences(), null, 200);
        }
        return $this->errorResponse('No experiences for You', null);
    }

    public function store(ExperienceRequest $request)
    {
        $experience = Experience::updateOrCreate(['user_id' => auth()->user()->id], [
            ...$request->all(),
            'user_id' => auth()->user()->id,
        ]);
        return $this->successResponse(new ExperienceResource($experience), null, 200);
    }


    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        if (auth()->user()->id === $experience->user_id) {
            $experience->delete();
            return $this->successResponse(null, 'Delete Successfully', 200);
        }
        return $this->errorResponse('An error occurred', null);
    }
}
