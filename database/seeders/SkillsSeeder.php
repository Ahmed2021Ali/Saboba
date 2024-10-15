<?php

namespace Database\Seeders;

use App\Models\Language;
use App\Models\Skills;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('skills')->delete();
        $skills = [
            [
                ['locale' => 'en', 'name' => 'Computer Science'],
                ['locale' => 'ar', 'name' => 'علوم الكمبيوتر '],
            ],
            [
                ['locale' => 'en', 'name' => 'football'],
                ['locale' => 'ar', 'name' => 'كة القدم'],
            ],
            [
                ['locale' => 'en', 'name' => 'read'],
                ['locale' => 'ar', 'name' => ' القراء'],
            ],
            [
                ['locale' => 'en', 'name' => 'swimming'],
                ['locale' => 'ar', 'name' => ' السباحة'],
            ],
        ];
        foreach ($skills as $skill) {
            $sk = Skills::create();
            foreach ($skill as $data) {
                $sk->translateOrNew($data['locale'])->name = $data['name'];
            }
            $sk->save();
        }
    }
}
