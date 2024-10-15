<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSkillsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //'skills_id' => ['array', 'required','exists:skills,id'],
            'skills_id' => ['array', 'required','exists:skills,id'],
        ];
    }
}
