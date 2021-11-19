<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qualifications = ['Undergraduate', 'Graduate', 'Post Graduate', 'Doctorate'];
        foreach ($qualifications as $qualification) {
            Qualification::factory()->create(['name' => $qualification]);
        }
    }
}
