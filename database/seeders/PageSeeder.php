<?php

namespace Database\Seeders;

use App\Models\Page;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'content' => 'Belum ada content!'
        ]);
        Page::create([
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'content' => 'Belum ada content!'
        ]);
    }
}
