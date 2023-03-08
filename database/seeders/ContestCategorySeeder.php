<?php

namespace Database\Seeders;

use App\Models\ContestCategory;
use Illuminate\Database\Seeder;

class ContestCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ContestCategory::create([
            'title' => 'tournament',
            'slug' => 'tournament',
        ]);

        ContestCategory::create([
            'title' => 'liga',
            'slug' => 'liga',
        ]);

        ContestCategory::create([
            'title' => 'contest',
            'slug' => 'contest',
        ]);

        ContestCategory::create([
            'title' => 'live show',
            'slug' => 'live-show',
        ]);
    }
}
