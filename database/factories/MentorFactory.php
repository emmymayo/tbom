<?php

namespace Database\Factories;

use App\Models\Mentor;
use App\Models\Nationality;
use App\Models\Qualification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MentorFactory extends Factory
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
            'title' => $this->faker->title(),
            'qualification_id' => Qualification::factory(),
            'nationality_id' => Nationality::factory()
        ];
    }
}
