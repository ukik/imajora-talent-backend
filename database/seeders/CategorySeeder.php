<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Category::create([
            'title' => 'Epic',
            'slug' => 'epic'
        ]);

        // 2
        Category::create([
            'title' => 'Esports',
            'slug' => 'esports'
        ]);

        // 3
        Category::create([
            'title' => 'Coming Soon',
            'slug' => 'coming-soon'
        ]);
        // 4
        Category::create([
            'title' => 'Legendary',
            'slug' => 'legendary'
        ]);

        // 5
        Category::create([
            'title' => 'Adventure',
            'slug' => 'Adventure'
        ]);

        // 6
        Category::create([
            'title' => 'Single Player',
            'slug' => 'single-player'
        ]);

        // 7
        Category::create([
            'title' => 'Extreme',
            'slug' => 'extreme'
        ]);
    }
}