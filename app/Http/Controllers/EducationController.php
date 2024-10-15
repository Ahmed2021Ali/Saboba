<?php

namespace App\Http\Controllers;

use App\Http\Requests\EducationRequest;
use App\Http\Resources\EducationResource;
use App\Models\BasicInformation;
use App\Models\Education;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{

    public function index()
    {
        if (Auth::User()->educations()->isNotEmpty()) {
            return response()->json(['message' => 'your Education ', 'education' => Auth::User()->educations()], 201);
        }
        return response()->json(['message' => 'No Educations for You'], 200);
    }

    public function store(EducationRequest $request)
    {
        $educate = Education::updateOrCreate(['user_id' => auth()->user()->id], [
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);
        return response()->json(['message' => 'your Education created ', 'education' => $educate], 201);
    }


    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        if (auth()->user()->id === $education->user_id) {
            $education->delete();
            return response()->json(['message' => 'Delete Successfully'], 200);
        }
        return response()->json(['error' => 'invalid'], 500);
    }
}
