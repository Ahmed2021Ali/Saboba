<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguagesRequest;
use App\Http\Requests\StoreSkillsRequest;
use App\Http\Requests\UpdateSkillsRequest;
use App\Http\Resources\SkillsResource;
use App\Models\Skills;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class SkillsController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        return $this->successResponse(SkillsResource::collection(Auth::User()->userSkills), 'User Skills', 200);
    }

    public function store(StoreSkillsRequest $request)
    {
        foreach ($request->skills_id as $skill_id) {
            $skill = Auth::User()->userSkills()->where('skills_id', $skill_id)->first();
            if ($skill) {
                return $this->successResponse(null, 'your Language already exists', 200);
            } else {
                Auth::User()->userSkills()->attach($skill_id);
                return $this->successResponse(null, 'your Language created successfully', 201);
            }
        }
    }

    public function destroy($id)
    {
        Auth::User()->userskills()->detach($id);
        return $this->successResponse(null, 'your Language deleted successfully', 201);
    }

}
