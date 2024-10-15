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
        $languages = Auth::User()->userskills();
        return response()->json(SkillsResource::collection($languages));
    }

    public function store(StoreSkillsRequest $request)
    {
        foreach ($request->skills_id as $skill_id) {
            $language = Auth::User()->userLanguages()->where('language_id', $skill_id)->first();
            if ($language) {
                return response()->json([
                    'message' => 'your Language already exists', 'language' => $language->name,
                ], 201);
            } else {
                Auth::User()->userLanguages()->attach($language_id);
                return response()->json([
                    'message' => 'your Language created successfully','language' => $language->name,
                ], 201);
            }
        }
    }

    public function destroy(Skills $skills)
    {
        Auth::User()->userskills()->detach($skills->id);
    }
}
