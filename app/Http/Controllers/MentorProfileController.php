<?php

namespace App\Http\Controllers;

use App\Models\Mentee;
use App\Models\Mentor;
use App\Models\MentorMentee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class MentorProfileController extends Controller
{
    public function __invoke(Request $request, Mentor $mentor)
    {
        Gate::authorize('mentee-only');
        $auth_mentee = Mentee::firstWhere('user_id',auth()->id());
        $is_mentee_connected = MentorMentee::where('mentor_id',$mentor->id)
                                    ->where('mentee_id', $auth_mentee->id)
                                    ->where('status', MentorMentee::STATUS_CONNECTED)
                                    ->count() > 0 ? true : false   ;

        $is_mentee_requested = MentorMentee::where('mentor_id',$mentor->id)
                                    ->where('mentee_id', $auth_mentee->id)
                                    ->where('status', MentorMentee::STATUS_PENDING)
                                    ->count() > 0 ? true : false   ;

        $mentee_count = MentorMentee::where('mentor_id',$mentor->id)
                                    ->where('status', MentorMentee::STATUS_CONNECTED)
                                    ->count();

        return Inertia::render('Mentor/Profile/Index',[
            'mentor' => $mentor,
            'is_connected' => $is_mentee_connected,
            'is_requested' => $is_mentee_requested,
            'mentee_count' => $mentee_count
        ]);
    }
}
