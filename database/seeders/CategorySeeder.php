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
                'translations' => [
                    ['locale' => 'en', 'name' => 'Clothing'],
                    ['locale' => 'ar', 'name' => 'الملابس'],
                ],
                'children' => [
                    [
                        'translations' => [
                            ['locale' => 'en', 'name' => 'Sportswear'],
                            ['locale' => 'ar', 'name' => 'ملابس رياضية'],
                        ],
                        'children' => [
                            [
                                'translations' => [
                                    ['locale' => 'en', 'name' => 'Sports Shoes'],
                                    ['locale' => 'ar', 'name' => 'أحذية رياضية'],
                                ],
                                'children' => [],
                            ],
                            [
                                'translations' => [
                                    ['locale' => 'en', 'name' => 'T-Shirts'],
                                    ['locale' => 'ar', 'name' => 'تي شيرتات'],
                                ],
                                'children' => [
                                    [
                                        'translations' => [
                                            ['locale' => 'en', 'name' => 'Casual T-Shirts'],
                                            ['locale' => 'ar', 'name' => 'تي شيرتات كاجوال'],
                                        ],
                                        'children' => [
                                            [
                                                'translations' => [
                                                    ['locale' => 'en', 'name' => 'Graphic Casual T-Shirts'],
                                                    ['locale' => 'ar', 'name' => 'تي شيرتات كاجوال برسومات'],
                                                ],
                                                'children' => [],
                                            ],
                                            [
                                                'translations' => [
                                                    ['locale' => 'en', 'name' => 'Plain Casual T-Shirts'],
                                                    ['locale' => 'ar', 'name' => 'تي شيرتات كاجوال بسيطة'],
                                                ],
                                                'children' => [],
                                            ],
                                        ],
                                    ],
                                    [
                                        'translations' => [
                                            ['locale' => 'en', 'name' => 'Sports T-Shirts'],
                                            ['locale' => 'ar', 'name' => 'تي شيرتات رياضية'],
                                        ],
                                        'children' => [
                                            [
                                                'translations' => [
                                                    ['locale' => 'en', 'name' => 'Compression Sports T-Shirts'],
                                                    ['locale' => 'ar', 'name' => 'تي شيرتات رياضية ضاغطة'],
                                                ],
                                                'children' => [],
                                            ],
                                            [
                                                'translations' => [
                                                    ['locale' => 'en', 'name' => 'Loose Sports T-Shirts'],
                                                    ['locale' => 'ar', 'name' => 'تي شيرتات رياضية فضفاضة'],
                                                ],
                                                'children' => [],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'translations' => [
                                    ['locale' => 'en', 'name' => 'Sports Pants'],
                                    ['locale' => 'ar', 'name' => 'بنطلونات رياضية'],
                                ],
                                'children' => [],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'Electronics'],
                    ['locale' => 'ar', 'name' => 'الإلكترونيات'],
                ],
                'children' => [
                    [
                        'translations' => [
                            ['locale' => 'en', 'name' => 'Mobile Phones'],
                            ['locale' => 'ar', 'name' => 'هواتف محمولة'],
                        ],
                        'children' => [],
                    ],
                    [
                        'translations' => [
                            ['locale' => 'en', 'name' => 'Laptops'],
                            ['locale' => 'ar', 'name' => 'أجهزة الكمبيوتر المحمولة'],
                        ],
                        'children' => [],
                    ],
                    [
                        'translations' => [
                            ['locale' => 'en', 'name' => 'Televisions'],
                            ['locale' => 'ar', 'name' => 'أجهزة التلفاز'],
                        ],
                        'children' => [],
                    ],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'Libraries'],
                    ['locale' => 'ar', 'name' => 'المكتبات'],
                ],
                'children' => [],
            ],
        ];

        foreach ($categories as $categoryData) {
            // Create the main category
            $category = Category::create();
            foreach ($categoryData['translations'] as $translation) {
                CategoryTranslation::create(array_merge($translation, ['category_id' => $category->id]));
            }

            // Create child categories
            $this->createChildCategories($category, $categoryData['children']);
        }
    }

    private function createChildCategories(Category $parentCategory, array $children)
    {
        foreach ($children as $childData) {
            $childCategory = Category::create(['parent_id' => $parentCategory->id]);
            foreach ($childData['translations'] as $translation) {
                CategoryTranslation::create(array_merge($translation, ['category_id' => $childCategory->id]));
            }

            // Recursively create further children if any
            if (isset($childData['children'])) {
                $this->createChildCategories($childCategory, $childData['children']);
            }
        }
    }
}
