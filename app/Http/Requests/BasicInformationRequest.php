<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BasicInformationRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nationality' => ['nullable', 'string', 'min:2', 'max:150'],
            'gender' => ['nullable', 'string', Rule::in(['male', 'female'])],
            'age' => ['nullable', 'numeric', 'min:18', 'max:100'],
            'job_title' => ['nullable', 'string', 'min:2', 'max:150'],
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
