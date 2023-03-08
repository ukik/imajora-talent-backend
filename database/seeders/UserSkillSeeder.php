<?php

namespace Database\Seeders;

use App\Models\UserSkill;
use Illuminate\Database\Seeder;

class UserSkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserSkill::factory()
            ->count(500)
            ->create();
    }
}