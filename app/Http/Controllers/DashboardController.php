<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\Mentors\Mentor as MentorService;
use App\Services\Mentees\Mentee as MenteeService;
use App\Models\User;

class DashboardController extends Controller
{
    public function __invoke()
    {
       
        $user = User::find(auth()->id());
        
        $data = $user->isMentee() 
                    ? [
                        'mentee' => $user->mentee,
                        'connected_mentor_count' => MentorService::getUserConnectedMentors()->count(),
                        'requested_mentor_count' => MentorService::getUserRequestedMentors()->count(),
                        'academic_entries' => $user->mentee->experiences->count()
                    ]
                    : ($user->isMentor() 
                            ? [
                            'mentor' =>  $user->mentor,
                            'connected_mentee_count' => MenteeService::getUserConnectedMentees()->count(),
                            'requested_mentee_count' => MenteeService::getUserRequestedMentees()->count(),
                            'expertise_entries' => $user->mentor->expertises->count(),
                            'assessment_index' => $user->mentor->assessmentIndex()
                            ] 
                            : []);


        return Inertia::render('Dashboard',$data);
    }
}
