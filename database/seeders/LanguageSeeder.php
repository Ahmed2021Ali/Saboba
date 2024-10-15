<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('languages')->delete();
        $languages = [
            [
                'ar' => ['name' => 'عربية '],
                'en' => ['name' => 'arabic '],
            ],
            [
                'ar' => ['name' => 'الانجليزية '],
                'en' => ['name' => 'English '],
            ],
        ];
        foreach ($languages as $language) {
            $lang = Language::create();
            foreach ($language as $key => $value) {
                $lang->translateOrNew($key)->name = $value;
            }
            $lang->save();

        }
    }
}
