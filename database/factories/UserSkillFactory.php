<?php

namespace Database\Factories;

use App\Models\UserSkill;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = UserSkill::class;
    public function definition()
    {
        return [
            'user_id' => rand(1, 100),
            'skill_id' => rand(1, 5)
        ];
    }
}