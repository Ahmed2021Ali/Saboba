<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'specialization' => ['required', 'string', 'min:2', 'max:250'],
            'university' => ['required', 'string', 'min:2', 'max:250'],
            'employment_type' => ['required', 'string', Rule::in(['phd', 'master', 'without_certificate', 'diploma', 'college_student', 'high_school', 'grade_school'])],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException(
            $validator, response()->json([
            'success' => false,
            'errors' => $validator->errors(), 401])
        );
    }
}
