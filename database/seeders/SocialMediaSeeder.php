<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocialMedia::create([
            'facebook' => 'www.facebook.com',
            'instagram' => 'www.instagram.com',
            'twitter' => 'www.twitter.com',
            'linkedin' => 'www.linkedin.com',
        ]);
    }
}