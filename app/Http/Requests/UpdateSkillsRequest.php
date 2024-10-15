<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSkillsRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //'skills_id' => ['array', 'required'],
            'skills_id.*' => ['required', 'numeric', 'exists:skills,id'],
        ];
    }
}
