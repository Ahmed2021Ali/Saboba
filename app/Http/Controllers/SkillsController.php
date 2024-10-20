<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillsRequest;
use App\Http\Resources\SkillsResource;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Skills;
use Illuminate\Support\Facades\Auth;

class SkillsController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        return response()->json(['skills'=>(Auth::User()->userSkills]);
    }

    public function store(StoreSkillsRequest $request)
    {
        foreach ($request->skills_id as $skill_id) {
            $skill = Auth::User()->userSkills()->where('skills_id', $skill_id)->first();
            if ($skill) {
                return response()->json(['success' => 'your Language already exists']);
            } else {
                Auth::User()->userSkills()->attach($skill_id);
                return response()->json(['success' => 'your Language created successfully']);
            }
        }
    }

    public function destroy($id)
    {
        $skill = Skills::where('id', $id)->first();
        if ($skill) {
            Auth::User()->userskills()->detach($id);
            return response()->json(['success' => 'your Language deleted successfully']);
        }
        return response()->json(['error' => 'An error occurred']);

    }

}
