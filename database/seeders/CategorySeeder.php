<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\CategoryTranslation;

class CategorySeeder extends Seeder
{

                        /*
                        الملابس (فئة رئيسية)

                        ملابس رياضية (فئة فرعية لفئة الملابس)
                        أحذية رياضية (فئة فرعية من "ملابس رياضية")
                        تي شيرتات (فئة فرعية من "ملابس رياضية")
                        بنطلونات رياضية (فئة فرعية من "ملابس رياضية")
                        ملابس رسمية (فئة فرعية لفئة الملابس)
                        بدل رجالي (فئة فرعية من "ملابس رسمية")
                        فستان سهرة (فئة فرعية من "ملابس رسمية")

                        الأحذية (فئة رئيسية)

                        أحذية رياضية (فئة فرعية)
                        أحذية رسمية (فئة فرعية)
                        
                        الإكسسوارات (فئة رئيسية)

                        ساعات (فئة فرعية)
                        أساور (فئة فرعية)
                        أحزمة (فئة فرعية)
                    */
    public function run()
    {
        // هنا بنحدد الفئات الأساسية
        $categories = [
            [
                // الفئة الأساسية: الملابس
                'translations' => [
                    ['locale' => 'en', 'name' => 'Clothing'], // الاسم بالإنجليزي
                    ['locale' => 'ar', 'name' => 'الملابس'], // الاسم بالعربي
                ],
                // الفئة الفرعية الخاصة بالملابس
                'children' => [
                    [
                        // الفئة الفرعية: ملابس رياضية
                        'translations' => [
                            ['locale' => 'en', 'name' => 'Sportswear'], // الاسم بالإنجليزي
                            ['locale' => 'ar', 'name' => 'ملابس رياضية'], // الاسم بالعربي
                        ],
                        // الفئات الفرعية الخاصة بالملابس الرياضية
                        'children' => [
                            [
                                // الفئة الفرعية: أحذية رياضية
                                'translations' => [
                                    ['locale' => 'en', 'name' => 'Sports Shoes'], // الاسم بالإنجليزي
                                    ['locale' => 'ar', 'name' => 'أحذية رياضية'], // الاسم بالعربي
                                ],
                            ],
                            [
                                // الفئة الفرعية: تي شيرتات
                                'translations' => [
                                    ['locale' => 'en', 'name' => 'T-Shirts'], // الاسم بالإنجليزي
                                    ['locale' => 'ar', 'name' => 'تي شيرتات'], // الاسم بالعربي
                                ],
                            ],
                            [
                                // الفئة الفرعية: بنطلونات رياضية
                                'translations' => [
                                    ['locale' => 'en', 'name' => 'Sports Pants'], // الاسم بالإنجليزي
                                    ['locale' => 'ar', 'name' => 'بنطلونات رياضية'], // الاسم بالعربي
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                // الفئة الأساسية: الإلكترونيات
                'translations' => [
                    ['locale' => 'en', 'name' => 'Electronics'], // الاسم بالإنجليزي
                    ['locale' => 'ar', 'name' => 'الإلكترونيات'], // الاسم بالعربي
                ],
                // الفئات الفرعية الخاصة بالإلكترونيات
                'children' => [
                    [
                        // الفئة الفرعية: هواتف محمولة
                        'translations' => [
                            ['locale' => 'en', 'name' => 'Mobile Phones'], // الاسم بالإنجليزي
                            ['locale' => 'ar', 'name' => 'هواتف محمولة'], // الاسم بالعربي
                        ],
                        // مافيش فئات فرعية تحت هواتف محمولة
                        'children' => [],
                    ],
                    [
                        // الفئة الفرعية: أجهزة الكمبيوتر المحمولة
                        'translations' => [
                            ['locale' => 'en', 'name' => 'Laptops'], // الاسم بالإنجليزي
                            ['locale' => 'ar', 'name' => 'أجهزة الكمبيوتر المحمولة'], // الاسم بالعربي
                        ],
                        // مافيش فئات فرعية تحت أجهزة الكمبيوتر المحمولة
                        'children' => [],
                    ],
                    [
                        // الفئة الفرعية: أجهزة التلفاز
                        'translations' => [
                            ['locale' => 'en', 'name' => 'Televisions'], // الاسم بالإنجليزي
                            ['locale' => 'ar', 'name' => 'أجهزة التلفاز'], // الاسم بالعربي
                        ],
                        // مافيش فئات فرعية تحت أجهزة التلفاز
                        'children' => [],
                    ],
                ],
            ],
            [
                // الفئة الأساسية: المكتبات
                'translations' => [
                    ['locale' => 'en', 'name' => 'Libraries'], // الاسم بالإنجليزي
                    ['locale' => 'ar', 'name' => 'المكتبات'], // الاسم بالعربي
                ],
                // مافيش فئات فرعية تحت المكتبات
                'children' => [],
            ],
        ];

        // دلوقتي هنبدأ نضيف الفئات للأصناف في قاعدة البيانات
        foreach ($categories as $categoryData) {
            // بننشئ الفئة الأم في قاعدة البيانات
            $category = Category::create();
            // بنضيف الترجمة الخاصة بالفئة الأم
            foreach ($categoryData['translations'] as $translation) {
                CategoryTranslation::create(array_merge($translation, ['category_id' => $category->id]));
            }

            // هنا بننشئ الفئات الفرعية للفئة الأم
            foreach ($categoryData['children'] as $childData) {
                // بننشئ الفئة الفرعية في قاعدة البيانات
                $childCategory = Category::create(['parent_id' => $category->id]);
                // بنضيف الترجمة الخاصة بالفئة الفرعية
                foreach ($childData['translations'] as $translation) {
                    CategoryTranslation::create(array_merge($translation, ['category_id' => $childCategory->id]));
                }

                // هنا بننشئ الفئات الفرعية للملابس الرياضية (لو فيه)
                foreach ($childData['children'] ?? [] as $grandChildData) {
                    $grandChildCategory = Category::create(['parent_id' => $childCategory->id]);
                    foreach ($grandChildData['translations'] as $translation) {
                        CategoryTranslation::create(array_merge($translation, ['category_id' => $grandChildCategory->id]));
                    }
                }
            }
        }
    }
}
