<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryTranslation;

class CategorySeeder extends Seeder
{


        public function run()
        {
            $categories = [
                [
                    'en' => 'Home Furniture',
                    'ar' => 'أثاث المنزل',
                ],
                [
                    'en' => 'Real Estate',
                    'ar' => 'عقارات',
                ],
                [
                    'en' => 'Services',
                    'ar' => 'خدمات',
                ],
                [
                    'en' => 'Cars and Vehicles',
                    'ar' => 'سيارات ومركبات',
                ],
                [
                    'en' => 'Jobs',
                    'ar' => 'وظائف',
                ],
                [
                    'en' => 'Classifieds',
                    'ar' => 'إعلانات مبوبة',
                ],
            ];
    
            foreach ($categories as $category) {
                $newCategory = new Category();
                $newCategory->parent_id = null; // الفئة الرئيسية من غير أب
                $newCategory->save();
            
                $newCategory->translateOrNew('en')->name = $category['en'];
                $newCategory->translateOrNew('ar')->name = $category['ar'];
                $newCategory->save();
            }
            
        }
}
