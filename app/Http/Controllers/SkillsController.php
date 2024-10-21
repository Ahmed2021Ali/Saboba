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
        return response()->json([
            'success' => 'Your skills ',
            'data' => Auth::User()->userSkills
        ], 200);
    }

    public function store(StoreSkillsRequest $request)
    {
        $skill = Skills::where('id', $request->skill_id)->first();
        if ($skill) {
            $userSkill = Auth::User()->userSkills()->where('skills_id', $skill->id)->first();
            if ($userSkill) {
                return response()->json(['success' => 'your Language already exists', 'data' => $userSkill]);
            } else {
                Auth::User()->userSkills()->attach($skill->id);
                return response()->json(['success' => 'your Language created successfully', 'data' => $userSkill]);
            }
        }
        return response()->json(['error' => 'your Language Not Found']);
    }

    public function destroy($id)
    {
        $skill = Skills::where('id', $id)->first();
        if ($skill) {
            Auth::User()->userskills()->detach($skill->id);
            return response()->json(['success' => 'your Language deleted successfully']);
        }
        return response()->json(['error' => 'An error occurred']);

    }

}
