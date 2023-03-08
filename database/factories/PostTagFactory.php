<?php

namespace Database\Factories;

use App\Models\PostTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = PostTag::class;
    public function definition()
    {
        return [
            'post_id' => rand(1, 100),
            'tag_id' => rand(1, 5)
        ];
    }
}