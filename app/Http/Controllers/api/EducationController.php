<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EducationRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Education;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        if (Auth::User()->educations()->isNotEmpty()) {
            return response()->json([
                'message' => 'your Educations ',
                'Data' => Auth::User()->educations()
            ], 200);
        }
        return response()->json(['message' => 'No Educations for You.'],404);
    }

    public function store(EducationRequest $request)
    {
        $eduction = Education::create([
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
            'message' => 'Education Created Successfully. ',
            'Data' => $eduction
        ], 201);
    }

    public function update(EducationRequest $request, $id)
    {
        $eduction = Education::where('id', $id)->first();
        $eduction->update($request->validated());
        return response()->json([
            'message' => 'Education Updated Successfully. ',
            'Data' => $eduction
        ], 200);
    }


    public function destroy($id)
    {
        $education = Education::where('id', $id)->first();
        if ($education) {
            if (auth()->user()->id === $education->user_id) {
                $education->delete();
                return response()->json(['message' => 'Delete Successfully'], 200);
            }
        }
        return response()->json(['message' => 'An error occurred'], 404);

    }
}
