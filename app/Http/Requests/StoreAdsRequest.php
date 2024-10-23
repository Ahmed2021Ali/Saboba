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
            'translations' => 'nullable|array',
            'translations.*.locale' => 'required|string',
            'translations.*.name' => 'required|string|max:255',
            'translations.*.description' => 'required|string|max:1000',
            'additional_fields' => 'nullable|json',

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
            'translations.array' => 'The translations must be an array.',
            'translations.*.locale.required' => 'Please enter the locale.',
            'translations.*.locale.string' => 'The locale must be a string.',
            'translations.*.name.required' => 'Please enter the advertisement name.',
            'translations.*.name.string' => 'The name must be a string.',
            'translations.*.name.max' => 'The name may not be greater than 255 characters.',
            'translations.*.description.required' => 'Please enter the advertisement description.',
            'translations.*.description.string' => 'The description must be a string.',
            'translations.*.description.max' => 'The description may not be greater than 1000 characters.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422));
    }
}
