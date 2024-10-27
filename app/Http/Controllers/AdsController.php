<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Ad;
use App\Models\AdField;
use App\Models\AdTranslation;
use Illuminate\Support\Str;
use App\Http\Requests\StoreAdsRequest;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    
    use ApiResponseTrait;
    
    public function createNewAd(StoreAdsRequest $request)
    {
        $ad = Ad::create([
            'price' => $request->price,
            'reference_number' => strtoupper(Str::random(10)),
            'user_id' => auth()->user()->id,
            'category_id' => $request->sub_category_id,
            'city_id' => $request->city_id,
            'status' => 0
        ]);

        foreach (['translations_en', 'translations_ar'] as $localeKey) {
            if (!empty($request->$localeKey)) {
                $locale = $localeKey === 'translations_en' ? 'en' : 'ar';
                foreach ($request->$localeKey as $translationData) {
                    AdTranslation::create([
                        'ad_id' => $ad->id,
                        'locale' => $locale,
                        'name' => $translationData['name'],
                        'description' => $translationData['description']
                    ]);

                    foreach ($translationData as $fieldName => $fieldValue) {
                        if (!in_array($fieldName, ['name', 'description'])) {
                            if (is_array($fieldValue)) {
                                foreach ($fieldValue as $value) {
                                    AdField::create([
                                        'ad_id' => $ad->id,
                                        'field_name' => $fieldName,
                                        'field_value' => $value,
                                        'locale' => $locale
                                    ]);
                                }
                            } else {
                                AdField::create([
                                    'ad_id' => $ad->id,
                                    'field_name' => $fieldName,
                                    'field_value' => $fieldValue,
                                    'locale' => $locale
                                ]);
                            }
                        }
                    }
                }
            }
        }

        return $this->successResponse(['ad_id' => $ad->id], 'Ad added successfully');
    }




    public function getAdById(Request $request)
{
    if (!$request->has('id')) {
        return $this->errorResponse('id field is required', 400);
    }

    $ad = Ad::find($request->id);
    if (!$ad) {
        return $this->errorResponse('Ad not found', 404);
    }

    // استرجاع الفئة الرئيسية
    $category = Category::with('parent')->find($ad->category_id);

    // إضافة حقل type إذا كانت الفئة الرئيسية "وظائف" أو "خدمات"
    $type = null;
    if ($category && $category->parent && in_array($category->parent->name, ['وظائف', 'خدمات'])) {
        $type = $category->name;
    }

    $translations = [
        'translations_en' => [],
        'translations_ar' => []
    ];
    
    // بقية الكود كما هو لاسترجاع بيانات الإعلان
    $adTranslations = AdTranslation::where('ad_id', $ad->id)->get();
    $adFields = AdField::where('ad_id', $ad->id)->get();

    foreach ($adTranslations as $translation) {
        $locale = $translation->locale === 'en' ? 'translations_en' : 'translations_ar';
        $data = [
            'name' => $translation->name,
            'description' => $translation->description,
        ];

        foreach ($adFields as $field) {
            if ($field->locale === $translation->locale) {
                if (!isset($data[$field->field_name])) {
                    $data[$field->field_name] = $field->field_value;
                } else {
                    $data[$field->field_name] = is_array($data[$field->field_name])
                        ? array_merge((array)$data[$field->field_name], [$field->field_value])
                        : [$data[$field->field_name], $field->field_value];
                }
            }
        }
        $translations[$locale][] = $data;
    }

    $response = [
        'ad_id' => $ad->id,
        'sub_category_id' => $ad->category_id,
        'city_id' => $ad->city_id,
        'price' => $ad->price,
        'type' => $type, // إضافة حقل type
    ] + $translations;

    return $this->successResponse($response);
}

public function getAllAds()
{
    $ads = Ad::all();
    $response = [];

    foreach ($ads as $ad) {
        $category = Category::with('parent')->find($ad->category_id);
        $type = null;
        if ($category && $category->parent && in_array($category->parent->name, ['وظائف', 'خدمات'])) {
            $type = $category->name;
        }

        $adData = [
            'ad_id' => $ad->id,
            'sub_category_id' => $ad->category_id,
            'city_id' => $ad->city_id,
            'price' => $ad->price,
            'type' => $type, // إضافة حقل type
        ];

        $translations = [
            'translations_en' => [],
            'translations_ar' => []
        ];
        
        // بقية الكود كما هو لاسترجاع بيانات الإعلان
        $adTranslations = AdTranslation::where('ad_id', $ad->id)->get();
        $adFields = AdField::where('ad_id', $ad->id)->get();

        foreach ($adTranslations as $translation) {
            $locale = $translation->locale === 'en' ? 'translations_en' : 'translations_ar';
            $data = [
                'name' => $translation->name,
                'description' => $translation->description,
            ];

            foreach ($adFields as $field) {
                if ($field->locale === $translation->locale) {
                    if (!isset($data[$field->field_name])) {
                        $data[$field->field_name] = $field->field_value;
                    } else {
                        $data[$field->field_name] = is_array($data[$field->field_name])
                            ? array_merge((array)$data[$field->field_name], [$field->field_value])
                            : [$data[$field->field_name], $field->field_value];
                    }
                }
            }
            $translations[$locale][] = $data;
        }

        $response[] = $adData + $translations;
    }

    return $this->successResponse($response);
}

}