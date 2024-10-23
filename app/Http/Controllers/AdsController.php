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

    
    // public function index(Request $request)
    // {
    //     try {
    //         // Get the preferred locale from the request header, default to 'ar'
    //         $locale = $request->header('Accept-Language', 'ar'); // Default to 'ar'
            
    //         // Fetch ads with translations
    //         $ads = Ad::with('translations')->get();
            
    //         // Transform the ads to include the preferred locale
    //         $adsArray = $ads->map(function ($ad) use ($locale) {
    //             return $this->transformAd($ad, $locale);
    //         });
    
    //         // Check if the ads are not empty
    //         if ($adsArray->isNotEmpty()) {
    //             return $this->successResponse($adsArray, 'Ads fetched successfully');
    //         }
    
    //         return $this->errorResponse('No ads found', 404);
    //     } catch (\Exception $e) {
    //         return $this->errorResponse($e->getMessage(), 500);
    //     }
    // }
    
    // private function transformAd($ad, $locale)
    // {
    //     // Remove 'translations' field from the ad
    //     $ad->makeHidden('translations');
        
    //     // Get the ad title and description based on the preferred locale
    //     $translation = $ad->translations->firstWhere('locale', $locale);
    //     $ad->description = $translation ? $translation->description : '';
    
    //     // Convert the ad to an array
    //     $adArray = $ad->toArray();
        
    //     return $adArray;
    // }
    
    // // Assuming you have these methods in your controller for response handling
    // private function successResponse($data, $message = '', $status = 200)
    // {
    //     return response()->json(['data' => $data, 'message' => $message], $status);
    // }
    
    // private function errorResponse($message, $status)
    // {
    //     return response()->json(['error' => $message], $status);
    // }
    
    

    public function store(Request $request)
    {
        // return DB::transaction(function () use ($request) {
        //     // 1. Create the Ad
        //     $ad = $this->createAd($request);

        //     // 2. Handle translations if available
        //     if ($this->hasValidTranslations($request)) {
        //         $this->createTranslations($ad->id, $request->translations);
        //     }

        //     // 3. Return response
        //     return $this->buildSuccessResponse($ad, $request->translations);
        // });
        return $request;
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
            // Get the preferred locale from the request header, default to 'ar'
            $locale = request()->header('Accept-Language', 'ar'); // Default to 'ar'
    
            // Fetch all main categories (top-level) with translations
            $categories = Category::with('translations')
                ->whereNull('parent_id') // Get only main categories
                ->get();
    
            // Transform categories to include all subcategories
            $categoriesArray = $categories->map(function ($category) use ($locale) {
                return $this->transformCategory($category, $locale);
            });
    
            return $this->successResponse($categoriesArray, 'Categories fetched successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    
    private function transformCategory($category, $locale)
    {
        // Remove 'parent_id' field for main categories
        $category->makeHidden('parent_id');
    
        // Get the category name based on the preferred locale
        $translation = $category->translations->firstWhere('locale', $locale);
        $category->name = $translation ? $translation->name : '';
    
        // Remove translations
        $category->makeHidden('translations');
    
        // Convert the category to an array
        $categoryArray = $category->toArray();
    
        // Get child categories
        $children = Category::with('translations')->where('parent_id', $category->id)->get();
    
        // Process child categories recursively
        $transformedChildren = $children->map(function ($child) use ($locale) {
            return $this->transformChildCategory($child, $locale);
        });
    
        // Add children only if they exist
        if ($transformedChildren->isNotEmpty()) {
            $categoryArray['children'] = $transformedChildren;
        }
    
        return $categoryArray;
    }
    
    private function transformChildCategory($child, $locale)
    {
        // Remove unnecessary fields for child category
        $child->makeHidden('translations');
        
        // Get child category name based on the preferred locale
        $childTranslation = $child->translations->firstWhere('locale', $locale);
        $child->name = $childTranslation ? $childTranslation->name : '';
        
        // Include the 'parent_id' from the parent category
        $child->parent_id = $child->parent_id; // This will show the parent_id of the child category
        
        // Get subcategories recursively
        $subChildren = Category::with('translations')->where('parent_id', $child->id)->get();
        
        // Transform the child category into an array
        $childArray = $child->toArray();
        
        // Transform subcategories
        $transformedSubChildren = $subChildren->map(function ($subChild) use ($locale) {
            return $this->transformChildCategory($subChild, $locale);
        });
        
        // Add subcategories only if they exist
        if ($transformedSubChildren->isNotEmpty()) {
            $childArray['children'] = $transformedSubChildren;
        }
    
        // Return the child array
        return [
            'id' => $childArray['id'],
            'parent_id' => $childArray['parent_id'],
            'created_at' => $childArray['created_at'],
            'updated_at' => $childArray['updated_at'],
            'name' => $childArray['name'], 
            // Include 'children' only if it's not empty
            ...(isset($childArray['children']) ? ['children' => $childArray['children']] : [])
        ];
    }
    
    
    public function getAllSubcategoriesOfMainCategory(Request $request)
    {
        try {
            $request->validate([
                'category_id' => 'required|exists:categories,id', 
            ]);
    
            $categoryId = $request->input('category_id');
    
            // Get the preferred locale from the request header, default to 'ar'
            $locale = $request->header('Accept-Language', 'ar');
    
            $mainCategory = Category::with('translations')->find($categoryId);
    
            if (!$mainCategory) {
                return $this->errorResponse('Category not found', 404);
            }
    
            // Transform the main category for response
            $mainCategoryArray = $this->transformCategory($mainCategory, $locale);
    
            // Fetch subcategories
            $subcategories = Category::with('translations')->where('parent_id', $mainCategory->id)->get();
    
            // Transform subcategories
            $subcategoriesArray = $subcategories->map(function ($subcategory) use ($locale) {
                return $this->transformChildCategory($subcategory, $locale);
            });
    
            // Add subcategories only if they exist
            if ($subcategoriesArray->isNotEmpty()) {
                $mainCategoryArray['children'] = $subcategoriesArray;
            } else {
                // If there are no subcategories, remove 'children' key
                unset($mainCategoryArray['children']);
            }
    
            return $this->successResponse($mainCategoryArray, 'Subcategories fetched successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
    
    
    
    
}
