<?php

namespace Database\Factories;

use App\Models\Expertise;
use App\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\Factory;

class MentorExpertiseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mentor_id' => Mentor::factory(),
            'expertise_id' => Expertise::factory(),
        ];
    }
}
