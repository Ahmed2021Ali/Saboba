<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        // بيانات الدول
        $countriesData = [
            [
                ['locale' => 'en', 'name' => 'Egypt'],
                ['locale' => 'ar', 'name' => 'مصر'],
                ['locale' => 'fr', 'name' => 'Égypte'],
            ],
            [
                ['locale' => 'en', 'name' => 'Palestine'],
                ['locale' => 'ar', 'name' => 'فلسطين'],
                ['locale' => 'fr', 'name' => 'Palestine'],
            ],
        ];

        // إنشاء الدول الجديدة
        foreach ($countriesData as $countryData) {
            // إنشاء الدولة الجديدة
            $country = Country::create(); // إنشاء الدولة بدون اسم
            
            // إضافة الترجمات للبلد
            foreach ($countryData as $data) {
                $country->translateOrNew($data['locale'])->name = $data['name'];
            }

            $country->save();
        }
    }
}
