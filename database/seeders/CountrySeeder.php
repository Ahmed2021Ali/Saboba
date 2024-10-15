<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            ['locale' => 'en', 'name' => 'Egypt'],
            ['locale' => 'ar', 'name' => 'مصر'],
            ['locale' => 'fr', 'name' => 'Égypte'],
            // ممكن تضيف دول تانية هنا
        ];

        foreach ($countries as $countryData) {
            $country = Country::create(); // إنشاء الدولة بدون اسم
            $country->translateOrNew($countryData['locale'])->name = $countryData['name'];
            $country->save();
        }
    }
}
