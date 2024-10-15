<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillsRequest;
use App\Http\Requests\UpdateSkillsRequest;
use App\Http\Resources\SkillsResource;
use App\Models\Skills;
use Illuminate\Support\Facades\Auth;

class SkillsController extends Controller
{
    public function index()
    {
        $languages = Auth::User()->userskills();
        return response()->json(SkillsResource::collection($languages));
    }

    public function store(StoreSkillsRequest $request)
    {
        foreach ($request->skills_id as $skill_id) {
            Auth::User()->userskills()->attach($skill_id);
        }
        return response()->json(SkillsResource::collection(Auth::User()->userskills()));
    }

    public function update(UpdateSkillsRequest $request)
    {
        //  Auth::User()->userLanguages()->detach();
        foreach ($request->skills_id as $skill_id) {
            Auth::User()->userskills()->attach($skill_id);
        }
        return response()->json(SkillsResource::collection(Auth::User()->userskills()));
    }

    public function destroy(Skills $skills)
    {
        Auth::User()->userskills()->detach($skills->id);
    }
}
