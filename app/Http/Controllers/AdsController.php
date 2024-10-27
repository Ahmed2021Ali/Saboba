<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Models\Ad;
use App\Models\AdField;
use App\Models\AdTranslation;
use App\Models\AdUpdate;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreAdsRequest;

class AdsController extends Controller
{
    
    use ApiResponseTrait;
    
    public function createNewAd(StoreAdsRequest $request)
    {
        // **الخطوة 1: إضافة البيانات الرئيسية في جدول ads**
        $ad = Ad::create([
            'price' => $request->price,
            'reference_number' => strtoupper(Str::random(10)),
            'user_id' => auth()->user()->id, // استخدام user_id الحالي للمستخدم المسجل
            'category_id' => $request->sub_category_id,
            'city_id' => $request->city_id,
            'status' => 0 // اعتبرناها نشطة افتراضياً
        ]);

        // **الخطوة 2: إضافة بيانات الترجمة في ad_translations**
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

                    // **الخطوة 3: إضافة أي فيلد إضافي لجدول ad_fields**
                    foreach ($translationData as $fieldName => $fieldValue) {
                        if (!in_array($fieldName, ['name', 'description'])) {
                            if (is_array($fieldValue)) {
                                // لو القيمة عبارة عن مصفوفة
                                foreach ($fieldValue as $value) {
                                    AdField::create([
                                        'ad_id' => $ad->id,
                                        'field_name' => $fieldName,
                                        'field_value' => $value,
                                        'locale' => $locale
                                    ]);
                                }
                            } else {
                                // لو القيمة نص عادي
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

        return response()->json(['message' => 'Ad added successfully', 'ad_id' => $ad->id]);
    }

    

    public function getAdById($id)
    {
        $ad = Ad::findOrFail($id);

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
            $translations[$locale][] = $data;
        }

        $response = [
            'sub_category_id' => $ad->category_id,
            'city_id' => $ad->city_id,
            'price' => $ad->price,
        ] + $translations;

        return response()->json($response);
    }


    public function getAllAds()
{
    // **الخطوة 1: جلب جميع الإعلانات**
    $ads = Ad::all();
    $response = [];

    foreach ($ads as $ad) {
        // **الخطوة 2: إعداد بيانات الإعلان الأساسية**
        $adData = [
            'sub_category_id' => $ad->category_id,
            'city_id' => $ad->city_id,
            'price' => $ad->price,
        ];

        // **الخطوة 3: جلب الترجمات لكل إعلان**
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

            // **الخطوة 4: إضافة الحقول الإضافية**
            foreach ($adFields as $field) {
                if ($field->locale === $translation->locale) {
                    if (!isset($data[$field->field_name])) {
                        $data[$field->field_name] = $field->field_value;
                    } else {
                        // إذا كانت القيمة مصفوفة، أضف القيم إليها
                        $data[$field->field_name] = is_array($data[$field->field_name])
                            ? array_merge((array)$data[$field->field_name], [$field->field_value])
                            : [$data[$field->field_name], $field->field_value];
                    }
                }
            }
            $translations[$locale][] = $data;
        }

        // **الخطوة 5: تجميع بيانات الإعلان النهائي**
        $response[] = $adData + $translations;
    }

    return response()->json($response);
}
}
