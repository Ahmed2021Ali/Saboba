<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdsRequest;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Ad;
use App\Models\AdTranslation;
use App\Models\AdUpdate;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdsController extends Controller
{
    
    use ApiResponseTrait;
    public function index(Request $request)
    {
        $ads = Ad::with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->get();
    
        if ($ads->isNotEmpty()) {
            return response()->json($ads, 200); 
        } 
        return response()->json([], 404);
    }
    

    public function store(StoreAdsRequest $request)
    {
        return DB::transaction(function () use ($request) {
            // 1. Create the Ad
            $ad = $this->createAd($request);

            // 2. Handle translations if available
            if ($this->hasValidTranslations($request)) {
                $this->createTranslations($ad->id, $request->translations);
            }

            // 3. Return response
            return $this->buildSuccessResponse($ad, $request->translations);
        });
    }

    
      //Create the Ad using the request data
    
    protected function createAd($request)
    {
        return Ad::create([
            'price' => $request->price,
            'reference_number' => strtoupper(Str::random(10)),
            'user_id' => 1,
            'category_id' => $request->category_id,
            'city_id' => $request->city_id,
            'image' => $request->file('image') ? $request->file('image')->store('ads') : null,
            'status' => 0,
        ]);
    }

    
     // Check if the request has valid translations
     
    protected function hasValidTranslations($request)
    {
        return $request->has('translations') && is_array($request->translations);
    }


     //Create translations for the Ad

    protected function createTranslations($adId, array $translations)
    {
        $translationsData = [];

        foreach ($translations as $translation) {
            $translationsData[] = [
                'ad_id' => $adId,
                'locale' => $translation['locale'],
                'name' => $translation['name'],
                'description' => $translation['description'],
            ];
        }

        AdTranslation::insert($translationsData);
    }

    protected function buildSuccessResponse($ad, $translations)
    {
        return response()->json([
            'message' => 'Ad created successfully!',
            'data' => $ad->only('id', 'price', 'reference_number', 'user_id', 'category_id', 'city_id', 'image', 'status'),
            'translations' => $translations,
        ], 201);
    }

    


    public function show(Request $request, $id)
    {
        $ad = Ad::with(['translations' => function ($query) use ($request) {
            $query->where('locale', $request->getLanguages());
        }])->find($id);
    
        if ($ad) {
            return response()->json($ad, 200); 
        }
    
        return response()->json(['message' => 'Ad not found'], 404);
    }
    

    public function update(Request $request, $id)
    {
        // 1. تحديث حالة الإعلان
            $ad = Ad::findOrFail($id);
            $ad->status = 0; // حالة الانتظار
            $ad->save();

            $oldLocale = AdTranslation::where('ad_id', $ad->id)->value('locale');
            // 2. تخزين التعديلات في ads_updates
            $updateData = $this->createUpdateData($ad, $request, $oldLocale);
            AdUpdate::create($updateData);

            return response()->json([
                'message' => 'التعديل في انتظار الموافقة!',
                'data' => $ad
            ], 200);
        
    }

    protected function createUpdateData($ad, $request, $oldLocale)
    {
        return [
            'ad_id' => $ad->id,
            'price' => $request->has('price') ? $request->price : $ad->price, // Keep the old price if not provided
            'category_id' => $request->has('category_id') ? $request->category_id : $ad->category_id, // Keep the old value
            'city_id' => $request->has('city_id') ? $request->city_id : $ad->city_id, // Keep the old value
            'locale' => $request->getLanguages() ? $request->getLanguages()[0] : $oldLocale, // Keep the old locale
            'name' => $request->has('name') ? $request->name : $ad->name, // Keep the old name
            'description' => $request->has('description') ? $request->description : $ad->description, // Keep the old description
            'status' => 0, // New status
        ];
    }
    

    public function getMainCategoryOfAd(Request $request)
    {
        $ad = Ad::findOrFail($request->id);
        
        $mainCategory = $ad->category;

        while ($mainCategory->parent) {
            $mainCategory = $mainCategory->parent; 
        }

        return response()->json([
            'ad_id' => $ad->id,
            'main_category' => $mainCategory
        ]);
    }

    public function destroy(Ad $ad)
    {
        if ($ad) {
            $ad->delete(); 
            
            return response()->json(['message' => 'Ad deleted successfully'], 200); 
        }
    
        return response()->json(['message' => 'Ad not found'], 404);
    }


    public function getAllCategoriesWithSub()
    {
       
        try {
            // Fetch categories with their children and translations
            $categories = Category::with(['children.translations', 'translations'])
                ->whereNull('parent_id') // Get only main categories
                ->get()
                ->map(function ($category) {
                    // Call the formatCategory method from the model
                    return $category->formatCategory();
                });
    
            // Structure the response in the desired format
            $response = [
                "data" => $categories,
                "message" => "Categories fetched successfully",
                "status" => 200
            ];
    
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                "message" => $e->getMessage(),
                "status" => 500
            ], 500);
        }
    }
    
    
}
