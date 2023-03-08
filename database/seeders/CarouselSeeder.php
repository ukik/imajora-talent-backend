<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Seeder;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Carousel::create([
            'title' => 'First your tagline',
            'description' => 'This is your footer descriptions of theme your website or motto for website and ilustration over specific',
            'image' => 'https://technext.github.io/game-warrior/img/slider-1.jpg',
        ]);

        Carousel::create([
            'title' => 'Seconds your tagline',
            'description' => 'This is your footer descriptions of theme your website or motto for website and ilustration over specific',
            'image' => 'https://technext.github.io/game-warrior/img/slider-2.jpg',
        ]);
    }
}