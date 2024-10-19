<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\CityTranslation;
use App\Models\Country;
use App\Models\CountryTranslation;

class CountryCitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array of countries with translations
        $countries = [
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'United States'],
                    ['locale' => 'ar', 'name' => 'الولايات المتحدة'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'Egypt'],
                    ['locale' => 'ar', 'name' => 'مصر'],
                ],
            ],
            [
                'translations' => [
                    ['locale' => 'en', 'name' => 'Canada'],
                    ['locale' => 'ar', 'name' => 'كندا'],
                ],
            ],
        ];

        foreach ($countries as $countryData) {
            // Create country first
            $country = Country::create();

            // Create translations for the country
            foreach ($countryData['translations'] as $translation) {
                CountryTranslation::create(array_merge($translation, ['country_id' => $country->id]));
            }
        }

        // Get all countries
        $countries = Country::with('translations')->get();

        // Array of cities with translations for each country
        $cities = [
            'United States' => [
                [
                    'translations' => [
                        ['locale' => 'en', 'name' => 'New York'],
                        ['locale' => 'ar', 'name' => 'نيويورك'],
                    ],
                ],
                [
                    'translations' => [
                        ['locale' => 'en', 'name' => 'Los Angeles'],
                        ['locale' => 'ar', 'name' => 'لوس أنجلوس'],
                    ],
                ],
            ],
            'Egypt' => [
                [
                    'translations' => [
                        ['locale' => 'en', 'name' => 'Cairo'],
                        ['locale' => 'ar', 'name' => 'القاهرة'],
                    ],
                ],
                [
                    'translations' => [
                        ['locale' => 'en', 'name' => 'Alexandria'],
                        ['locale' => 'ar', 'name' => 'الإسكندرية'],
                    ],
                ],
            ],
        ];

        // Populate cities based on the countries
        foreach ($countries as $country) {
            // Use the first translation to check the country name
            $countryName = $country->translate('en')->name; // Get the English name

            // Check if we have cities for this country
            if (isset($cities[$countryName])) {
                foreach ($cities[$countryName] as $cityData) {
                    // Create the city and associate it with the country
                    $city = City::create(['country_id' => $country->id]);

                    // Create translations for the city
                    foreach ($cityData['translations'] as $translation) {
                        CityTranslation::create(array_merge($translation, ['city_id' => $city->id]));
                    }
                }
            }
        }
    }
}
