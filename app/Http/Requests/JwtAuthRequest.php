<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JwtAuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules()
    {
        if ($this->isMethod('post') && $this->route()->getName() === 'login') {
            return [
                'phone' => 'required|string|min:8|max:20',
                'password' => 'required|string|min:6|max:50',
            ];
        }
    
        return [
            'name' => 'required|string|min:2|max:50', 
            'email' => 'nullable|string|email|max:50|unique:users',
            'password' => 'required|string|min:6|confirmed|max:50',
            'type' => 'required|in:personal,company',
            'phone' => 'required|string|min:8|max:20|unique:users',
            'country_id' => 'required|exists:countries,id',
            'whatsapp_number' => 'nullable|string|min:8|max:20',
            'contact_number' => 'nullable|string|min:8|max:20',
            'overview' => 'nullable|string|max:500', 
        ];
    }
    
    
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.min' => 'The name must be at least 2 characters.',
            'name.max' => 'The name may not be greater than 50 characters.',
            
            'email.email' => 'The email must be a valid email address.',
            'email.unique' => 'The email has already been taken.',
            
            'password.required' => 'The password field is required.',
            'password.string' => 'The password must be a string.',
            'password.min' => 'The password must be at least 6 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.max' => 'The password may not be greater than 50 characters.',
            
            'type.required' => 'The user type is required.',
            'type.in' => 'The selected type is invalid. Must be personal or company.',
            
            'phone.required' => 'The phone field is required.',
            'phone.string' => 'The phone must be a string.',
            'phone.min' => 'The phone must be at least 8 characters.',
            'phone.max' => 'The phone may not be greater than 20 characters.',
            
            'country_id.required' => 'The country field is required.',
            'country_id.exists' => 'The selected country is invalid.',
            
            'whatsapp_number.string' => 'The WhatsApp number must be a string.',
            'whatsapp_number.min' => 'The WhatsApp number must be at least 8 characters.',
            'whatsapp_number.max' => 'The WhatsApp number may not be greater than 20 characters.',
            
            'contact_number.string' => 'The contact number must be a string.',
            'contact_number.min' => 'The contact number must be at least 8 characters.',
            'contact_number.max' => 'The contact number may not be greater than 20 characters.',
            
            'overview.string' => 'The overview must be a string.',
            'overview.max' => 'The overview may not be greater than 500 characters.',
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException($validator, response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422));
    }
}
