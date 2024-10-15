<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        // بيانات الدولة (هنا بس دولة واحدة)
        $countryData = [
            ['locale' => 'en', 'name' => 'Egypt'],
            ['locale' => 'ar', 'name' => 'مصر'],
            ['locale' => 'fr', 'name' => 'Égypte'],
        ];

        // إنشاء الدولة الجديدة
        $country = Country::create(); // إنشاء الدولة بدون اسم

        // إضافة الترجمات للبلد
        foreach ($countryData as $data) {
            $country->translateOrNew($data['locale'])->name = $data['name'];
        }

        $country->save();
    }
}
