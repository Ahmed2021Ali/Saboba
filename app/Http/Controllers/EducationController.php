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
            return response()->json(Auth::User()->educations());
        }
        return response()->json(['success'=>'No Educations for You.']);
    }

    public function store(EducationRequest $request)
    {
        $educate = Education::updateOrCreate(['user_id' => auth()->user()->id], [
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);
        return response()->json([$educate,'success'=>'Education Created Successfully.']);
    }


    public function destroy($id)
    {
        $education = Education::where('id',$id)->first();
        if (auth()->user()->id === $education->user_id) {
            $education->delete();
            return response()->json(['success'=>'Delete Successfully']);
        }
        return response()->json(['error'=>'An error occurred']);

    }
}
