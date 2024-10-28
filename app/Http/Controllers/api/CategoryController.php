<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponseTrait;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ApiResponseTrait;


    public function getAllMainCategoriesWithSubcategories()
    {
        $mainCategories = Category::whereNull('parent_id')->with('translations', 'children.translations')->get();

        if ($mainCategories->isEmpty()) {
            return $this->errorResponse('No main categories found', 404);
        }

        $response = [];
        foreach ($mainCategories as $mainCategory) {
            $categoryData = [
                'main_category_id' => $mainCategory->id,
                'main_category_translation_en' => $mainCategory->translations->where('locale', 'en')->pluck('name'),
                'main_category_translation_ar' => $mainCategory->translations->where('locale', 'ar')->pluck('name'),
                'subcategories' => []
            ];

            foreach ($mainCategory->children as $subCategory) {
                $categoryData['subcategories'][] = [
                    'sub_category_id' => $subCategory->id,
                    'sub_category_translation_en' => $subCategory->translations->where('locale', 'en')->pluck('name'),
                    'sub_category_translation_ar' => $subCategory->translations->where('locale', 'ar')->pluck('name'),
                ];
            }

            $response[] = $categoryData;
        }

        return $this->successResponse($response, 'Main categories with subcategories retrieved successfully');
    }
}
