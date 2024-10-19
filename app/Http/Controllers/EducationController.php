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
            return $this->successResponse(Auth::User()->educations(), 'your Education ', 200);
        }
        return $this->errorResponse('No Educations for You.', null);
    }

    public function store(EducationRequest $request)
    {
        $educate = Education::updateOrCreate(['user_id' => auth()->user()->id], [
            ...$request->validated(),
            'user_id' => auth()->user()->id,
        ]);
        return $this->successResponse($educate, 'your Education created ', 201);
    }


    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        if (auth()->user()->id === $education->user_id) {
            $education->delete();
            return $this->successResponse(null, 'Delete Successfully', 200);
        }
        return $this->errorResponse('An error occurred', null);
    }
}
