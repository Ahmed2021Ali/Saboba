<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLanguagesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //'languages_id' => ['array', 'required'],
            'languages_id.*' => ['required', 'numeric', 'exists:languages,id'],
        ];
    }
}
