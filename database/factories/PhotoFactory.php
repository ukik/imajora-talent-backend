<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'image' => 'null',
            'description' => $this->faker->sentence(3),
            'album_id' => rand(1, 1000),
            'user_id' => rand(1, 100),
        ];
    }
}