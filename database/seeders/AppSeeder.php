<?php

namespace Database\Seeders;

use App\Models\App;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App::create([
            'title' => 'Imajora | News and Talent Platform',
            'brand_icon' => 'https://technext.github.io/game-warrior/img/logo.png',
            'bg_recent_game' => 'https://technext.github.io/game-warrior/img/recent-game-bg.png',
            'bg_footer' => 'https://technext.github.io/game-warrior/img/footer-top-bg.png',
            'footer_description' => 'This is your footer descriptions of theme your website or motto for website and ilustration over specific',
        ]);
    }
}