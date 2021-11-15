<?php

namespace Database\Factories;

use App\Models\Mentee;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenteeExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mentee_id' => Mentee::factory(),
            'school' => $this->faker->name().' School'
        ];
    }
}
