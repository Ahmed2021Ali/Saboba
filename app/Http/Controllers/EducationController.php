<?php

namespace App\Http\Controllers;

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
                'success' => 'your Educations ',
                'data' => Auth::User()->educations()
            ], 201);
        }
        return response()->json(['success' => 'No Educations for You.']);
    }

    public function store(EducationRequest $request)
    {
        $eduction = Education::create([
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);

        return response()->json([
            'success' => 'Education Created Successfully. ',
            'data' => $eduction
        ], 201);
    }

    public function update(EducationRequest $request, $id)
    {
        $eduction = Education::where('id', $id)->first();
        $eduction->update($request->validated());
        return response()->json([
            'success' => 'Education Updated Successfully. ',
            'data' => $eduction
        ], 200);
    }


    public function destroy($id)
    {
        $education = Education::where('id', $id)->first();
        if ($education) {
            if (auth()->user()->id === $education->user_id) {
                $education->delete();
                return response()->json(['success' => 'Delete Successfully']);
            }
        }
        return response()->json(['error' => 'An error occurred']);

    }
}
