<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|min:2|max:50',
            'email' => 'nullable|string|email|max:50|unique:users',
            'password' => 'nullable|string|min:6|confirmed|max:50',
            'phone' => 'nullable|string|min:8|max:20|unique:users',
            'country_id' => 'nullable|exists:countries,id',
            'whatsapp_number' => 'nullable|string|min:8|max:20',
            'contact_number' => 'nullable|string|min:8|max:20',
            'overview' => 'nullable|string|max:500',
            'images.*' => 'nullable|max:10000'
        ];
    }
}
