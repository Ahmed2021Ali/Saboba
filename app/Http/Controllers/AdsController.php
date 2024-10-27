<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Ad;
use App\Models\AdField;
use App\Models\AdTranslation;
use App\Models\Category;
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
    
        $translations = [
            'translations_en' => [],
            'translations_ar' => []
        ];
    
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
    
            // جلب نوع الفئة الفرعية حسب اللغة
            $category = Category::with('parent')->find($ad->category_id);
            if ($category && $category->parent) {
                // الحصول على أول فئة فرعية بعد الفئة الرئيسية
                $firstSubCategory = Category::where('parent_id', $category->parent_id)->first();
    
                // تحقق مما إذا كانت الفئة الفرعية هي الفئة التالية
                $validTypes = ['وظائف', 'خدمات', 'Jobs', 'Services'];
                if ($firstSubCategory && $ad->category_id === $firstSubCategory->id && in_array($category->parent->name, $validTypes)) {
                    $data['type'] = $firstSubCategory->translations->where('locale', $translation->locale)->first()->name ?? $firstSubCategory->name;
                }
            }
    
            $translations[$locale][] = $data;
        }
    
        $response = [
            'ad_id' => $ad->id,
            'sub_category_id' => $ad->category_id,
            'city_id' => $ad->city_id,
            'price' => $ad->price,
        ];
    
        return $this->successResponse($response + $translations);
    }
    
    

    public function getAllAds()
    {
        $ads = Ad::all();
    
        if ($ads->isEmpty()) {
            return $this->successResponse(null, 'No ads found', 200);
        }
    
        $response = [];
    
        foreach ($ads as $ad) {
            $adData = [
                'ad_id' => $ad->id,
                'sub_category_id' => $ad->category_id,
                'city_id' => $ad->city_id,
                'price' => $ad->price,
            ];
    
            $translations = [
                'translations_en' => [],
                'translations_ar' => []
            ];
    
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
    
                // جلب نوع الفئة الفرعية حسب اللغة
                $category = Category::with('parent')->find($ad->category_id);
                if ($category && $category->parent) {
                    // الحصول على أول فئة فرعية بعد الفئة الرئيسية
                    $firstSubCategory = Category::where('parent_id', $category->parent_id)->first();
    
                    // تحقق مما إذا كانت الفئة الفرعية هي الفئة التالية
                    $validTypes = ['وظائف', 'خدمات', 'Jobs', 'Services'];
                    if ($firstSubCategory && $ad->category_id === $firstSubCategory->id && in_array($category->parent->name, $validTypes)) {
                        $data['type'] = $firstSubCategory->translations->where('locale', $translation->locale)->first()->name ?? $firstSubCategory->name;
                    }
                }
    
                $translations[$locale][] = $data;
            }
    
            $response[] = $adData + $translations;
        }
    
        return $this->successResponse($response);
    }
    

}