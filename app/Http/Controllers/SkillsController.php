<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguagesRequest;
use App\Http\Requests\StoreSkillsRequest;
use App\Http\Requests\UpdateSkillsRequest;
use App\Http\Resources\SkillsResource;
use App\Models\Skills;
use Illuminate\Support\Facades\Auth;

class SkillsController extends Controller
{
    public function index()
    {
        dd(Auth::User()->userSkills());
        return response()->json([
            'message' => ' User Skills',
            'languages' => SkillsResource::collection(Auth::User()->userSkills),
        ], 201);
    }

    public function store(StoreSkillsRequest $request)
    {
        foreach ($request->skills_id as $skill_id) {
            Auth::User()->userSkills()->attach($skill_id);
            return response()->json([
                'message' => 'your Language created successfully',
            ], 201);
/*            $skill = Auth::User()->userSkills()->where('skills_id', $skill_id)->first();
            dd($skill);
            if ($skill) {
                return response()->json([
                    'message' => 'your Language already exists',
                ], 201);
            } else {

            }*/
        }
    }

    public function destroy(Skills $skills)
    {
        Auth::User()->userskills()->detach($skills->id);
    }
}
