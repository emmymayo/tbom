<?php

namespace Database\Factories;

use App\Models\Mentee;
use App\Models\Mentor;
use Illuminate\Database\Eloquent\Factories\Factory;

class MentorMenteeFactory extends Factory
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
            'mentee_id' => Mentee::factory()
        ];
    }
}
