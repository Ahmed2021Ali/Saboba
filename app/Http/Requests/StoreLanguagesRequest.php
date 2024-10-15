<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLanguagesRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // array
        return [
          'languages_id' => ['array', 'required','exists:languages,id'],
        ];
    }
}
