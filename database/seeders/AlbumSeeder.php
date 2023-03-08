<?php

namespace Database\Seeders;

use App\Models\Album;
use Database\Factories\AlbumFactory;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Album::factory()
            ->count(1000)
            ->create();
    }
}