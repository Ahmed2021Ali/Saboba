<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreAdsRequest extends FormRequest
{
    public function authorize()
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'price' => 'required|numeric|min:0',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'city_id' => 'required|exists:cities,id',
            'image' => 'nullable|image',
            'locale' => 'required|string',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'price.required' => 'Please enter the advertisement price.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be zero or greater.',
            'user_id.required' => 'Please enter the user ID.',
            'user_id.exists' => 'The user ID does not exist.',
            'category_id.required' => 'Please enter the category ID.',
            'category_id.exists' => 'The category ID does not exist.',
            'city_id.required' => 'Please enter the city ID.',
            'city_id.exists' => 'The city ID does not exist.',
            'image.image' => 'The image must be a valid image file.',
            'locale.required' => 'Please enter the locale.',
            'locale.string' => 'The locale must be a string.',
            'name.required' => 'Please enter the advertisement name.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'description.required' => 'Please enter the advertisement description.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 1000 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Throw an HttpResponseException with a custom JSON error response
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }
}
