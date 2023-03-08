<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'title' => 'Tutorial',
            'slug' => 'Tutorial',
        ]);
        Tag::create([
            'title' => 'HTML',
            'slug' => 'HTML',
        ]);
        Tag::create([
            'title' => 'CSS',
            'slug' => 'CSS',
        ]);
        Tag::create([
            'title' => 'Javascript',
            'slug' => 'Javascript',
        ]);
        Tag::create([
            'title' => 'Bootstrap',
            'slug' => 'Bootstrap',
        ]);
    }
}
