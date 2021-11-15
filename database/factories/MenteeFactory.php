<?php

namespace Database\Factories;

use App\Models\Nationality;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenteeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'dob' => $this->faker->date()
        ];
    }
}
