<?php

namespace Database\Seeders;

use App\Models\Mentor;
use App\Models\MentorExpertise;
use App\Models\User;
use Illuminate\Database\Seeder;

class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<5;$i++){
            $mentor = Mentor::factory()->for(User::factory()->create(['role_id' => 4, 'nationality_id' =>19]))
                            ->create(['qualification_id' => 3]);

            MentorExpertise::factory()->create([
                'expertise_id' => collect([2,3,4,5])->random(1)[0],
                'mentor_id' => $mentor->id

            ]);
            //$user = ;

        }
        
    }
}
