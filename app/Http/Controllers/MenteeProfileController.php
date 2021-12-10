<?php

namespace App\Http\Controllers;

use App\Models\Mentee;
use App\Models\Mentor;
use App\Models\MentorMentee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class MenteeProfileController extends Controller
{
    public function __invoke(Request $request, Mentee $mentee)
    {
        Gate::authorize('mentor-only');
        $auth_mentor = Mentor::firstWhere('user_id',auth()->id());
        $is_mentee_connected = MentorMentee::where('mentor_id',$auth_mentor->id)
                                    ->where('mentee_id', $mentee->id)
                                    ->where('status', MentorMentee::STATUS_CONNECTED)
                                    ->count() > 0 ? true : false   ;
        
        $is_mentee_requested = MentorMentee::where('mentor_id',$auth_mentor->id)
                                    ->where('mentee_id', $mentee->id)
                                    ->where('status', MentorMentee::STATUS_PENDING)
                                    ->count() > 0 ? true : false   ;
        //How many Mentor does the Mentee Have
        $mentor_count = MentorMentee::where('mentee_id',$mentee->id)
                                    ->where('status', MentorMentee::STATUS_CONNECTED)
                                    ->count();

        return Inertia::render('Mentee/Profile/Index',[
            'mentee' => $mentee,
            'is_connected' => $is_mentee_connected,
            'is_requested' => $is_mentee_requested,
            'mentor_count' => $mentor_count
        ]);
    }
}
