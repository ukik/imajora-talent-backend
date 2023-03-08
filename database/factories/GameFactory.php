<?php

namespace Database\Factories;

use App\Models\Game;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Game::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(3, false),
            // 'thumbnail' => 'https://source.unsplash.com/480x480/?game',
            'description' => $this->faker->paragraph(2),
            'content' => $this->faker->text(2000),
            'trailer' => 'https://www.youtube.com/embed/1WolDM3mnSY',
            'status' => 'publish',
            'user_id' => '1',
            'genre_id' => rand(1, 5),
        ];
    }
}