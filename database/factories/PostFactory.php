<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;


class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Post::class;

    public function definition()
    {

        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(3, false),
            // 'thumbnail' => 'https://source.unsplash.com/480x480/?news',
            'description' => $this->faker->paragraph(2),
            'content' => $this->faker->text(2000),
            'status' => 'publish',
            'user_id' => '1',
            'category_id' => rand(1, 7),
        ];
    }
}