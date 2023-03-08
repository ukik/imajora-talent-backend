<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Post;
use App\Models\UserSkill;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            AppSeeder::class,
            CarouselSeeder::class,
            ContactSeeder::class,
            DeviceSeeder::class,
            GenreSeeder::class,
            CountrySeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            PageSeeder::class,
            UserSeeder::class,
            GameSeeder::class,
            PostSeeder::class,
            NoticeSeeder::class,
            SkillSeeder::class,
            UserSkillSeeder::class,
            SocialMediaSeeder::class,
            PostTagSeeder::class,
            AlbumSeeder::class,
            PhotoSeeder::class,
            ContestCategorySeeder::class,
            ContestSeeder::class,
            ContestTagsSeeder::class,
        ]);
        // \App\Models\User::factory(100)->create();
        // \App\Models\Post::factory(100)->create();
        // \App\Models\Game::factory(100)->create();
    }
}
