<?php

namespace Database\Seeders;

use App\Models\Country;
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
                ['locale' => 'en', 'name' => 'english'],
                ['locale' => 'ar', 'name' => 'الانجليزية '],
            ],
            [
                ['locale' => 'en', 'name' => 'Arabic'],
                ['locale' => 'ar', 'name' => 'عربية'],
            ],
        ];
        foreach ($languages as $language) {
            $lang = Language::create();
            foreach ($language as $data) {
                $lang->translateOrNew($data['locale'])->name = $data['name'];
            }
            $lang->save();
        }
    }
}
