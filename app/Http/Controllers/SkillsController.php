<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillsRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Skills;
use Illuminate\Support\Facades\Auth;

class SkillsController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        if (Auth::User()->userSkills->isNotEmpty()) {
            return response()->json([
                'message' => 'Your skills ',
                'Data' => Auth::User()->userSkills
            ], 200);
        }
        return response()->json(['message' => 'No Skills  for You'], 404);
    }

    public function store(StoreSkillsRequest $request)
    {
        $skill = Skills::where('id', $request->skill_id)->first();
        if ($skill) {
            $userSkill = Auth::User()->userSkills()->where('skills_id', $skill->id)->first();
            if ($userSkill) {
                return response()->json(['message' => 'your Language already exists', 'Data' => $userSkill], 500);
            } else {
                Auth::User()->userSkills()->attach($skill->id);
                return response()->json(['message' => 'your Language created successfully', 'Data' => $userSkill], 201);
            }
        }
        return response()->json(['message' => 'your Language Not Found'], 404);
    }

    public function destroy($id)
    {
        $skill = Skills::where('id', $id)->first();
        if ($skill) {
            Auth::User()->userskills()->detach($skill->id);
            return response()->json(['message' => 'your Language deleted successfully'], 200);
        }
        return response()->json(['message' => 'An error occurred'], 404);
    }

}
