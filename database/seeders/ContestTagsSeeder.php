<?php

namespace Database\Seeders;

use App\Models\ContestTag;
use Illuminate\Database\Seeder;

class ContestTagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContestTag::create([
            'title' => 'gamming',
            'slug' => 'gamming',
        ]);

        ContestTag::create([
            'title' => 'liga',
            'slug' => 'liga',
        ]);

        ContestTag::create([
            'title' => 'coming soon',
            'slug' => 'coming-soon',
        ]);

        ContestTag::create([
            'title' => 'tournament',
            'slug' => 'tournament',
        ]);
    }
}
