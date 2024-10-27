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
            'sub_category_id' => 'required|exists:categories,id',
            'city_id' => 'required|exists:cities,id',
            'main_image' => 'required|image|max:5000',
            'images.*' => 'nullable|image|max:5000',
            'reals' => 'nullable|mimes:mp4,mov,ogg,qt|max:20000',
            'translations_en' => 'nullable|array',
            'translations_ar' => 'nullable|array',
            'translations_en.*.name' => 'required|string|max:255',
            'translations_en.*.description' => 'required|string|max:1000',
            'translations_ar.*.name' => 'required|string|max:255',
            'translations_ar.*.description' => 'required|string|max:1000',
            'additional_fields' => 'nullable|json',
        ];
    }

    public function messages(): array
    {
        return [
            'price.required' => 'Please enter the advertisement price.',
            'price.numeric' => 'The price must be a number.',
            'price.min' => 'The price must be zero or greater.',
            'sub_category_id.required' => 'Please enter the sub-category ID.',
            'sub_category_id.exists' => 'The sub-category ID does not exist.',
            'city_id.required' => 'Please enter the city ID.',
            'city_id.exists' => 'The city ID does not exist.',
            'image.image' => 'The image must be a valid image file.',
            'translations_en.array' => 'The English translations must be an array.',
            'translations_ar.array' => 'The Arabic translations must be an array.',
            'translations_en.*.name.required' => 'Please enter the English advertisement name.',
            'translations_en.*.name.string' => 'The English name must be a string.',
            'translations_en.*.name.max' => 'The English name may not be greater than 255 characters.',
            'translations_en.*.description.required' => 'Please enter the English advertisement description.',
            'translations_en.*.description.string' => 'The English description must be a string.',
            'translations_en.*.description.max' => 'The English description may not be greater than 1000 characters.',
            'translations_ar.*.name.required' => 'Please enter the Arabic advertisement name.',
            'translations_ar.*.name.string' => 'The Arabic name must be a string.',
            'translations_ar.*.name.max' => 'The Arabic name may not be greater than 255 characters.',
            'translations_ar.*.description.required' => 'Please enter the Arabic advertisement description.',
            'translations_ar.*.description.string' => 'The Arabic description must be a string.',
            'translations_ar.*.description.max' => 'The Arabic description may not be greater than 1000 characters.',
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
