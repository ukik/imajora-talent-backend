<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'thumbnail' => 'null',
            'description' => $this->faker->sentence(),
            'link_embed_youtube' => 'https://www.youtube.com/embed/Za5-fvwbPJI',
            'content' => $this->faker->sentence(),
            'user_id' => rand(1, 100),
            'contest_category_id' => rand(1, 4),
        ];
    }
}
