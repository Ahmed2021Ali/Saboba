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
        return response()->json([
            'message' => ' User Skills',
            'skills' => SkillsResource::collection(Auth::User()->userSkills),
        ], 201);
    }

    public function store(StoreSkillsRequest $request)
    {
        foreach ($request->skills_id as $skill_id) {
            $skill = Auth::User()->userSkills()->where('skills_id', $skill_id)->first();
            if ($skill) {
                return response()->json([
                    'message' => 'your Language already exists',
                ], 201);
            } else {
                Auth::User()->userSkills()->attach($skill_id);

                return response()->json([
                    'message' => 'your Language created successfully',
                ], 201);
            }
        }
    }

    public function destroy($id)
    {
        Auth::User()->userskills()->detach($id);
    }
}
