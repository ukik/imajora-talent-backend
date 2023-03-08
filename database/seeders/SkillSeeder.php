<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Skill::create([
            'title' => 'Programmer',
            'slug' => 'programmer'
        ]);

        Skill::create([
            'title' => 'System Analyst',
            'slug' => 'system-analyst'
        ]);

        Skill::create([
            'title' => 'Gammers',
            'slug' => 'gammers'
        ]);

        Skill::create([
            'title' => 'Copywriting',
            'slug' => 'copywriting'
        ]);

        Skill::create([
            'title' => 'Musisi',
            'slug' => 'musisi'
        ]);
    }
}