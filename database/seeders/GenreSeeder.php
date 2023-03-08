<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Genre::create([
            'title' => 'action',
            'slug' => 'action'
        ]);
        Genre::create([
            'title' => 'adventure',
            'slug' => 'adventure'
        ]);
        Genre::create([
            'title' => 'rpg',
            'slug' => 'rpg'
        ]);
        Genre::create([
            'title' => 'simulation',
            'slug' => 'simulation'
        ]);
        Genre::create([
            'title' => 'strategy',
            'slug' => 'strategy'
        ]);
        Genre::create([
            'title' => 'sport',
            'slug' => 'sport'
        ]);
    }
}
