<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExperienceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'job_title' => ['required', 'string','min:2', 'max:150'],
            'company_name' => ['required', 'string','min:2', 'max:150'],
            'description' => ['required', 'string','min:2', 'max:250'],
            'employment_type' => ['required', 'string',Rule::in(['temporary', 'full_time', 'part_time', 'contract'])],
            'status' => ['required', 'boolean'],
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
