<?php

namespace App\Http\Controllers;

use App\Models\Expertise;
use App\Models\Mentee;
use App\Models\Mentor;
use App\Models\MentorMentee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Services\Mentors\Mentor as MentorService;

class MentorSearchController extends Controller
{
    public function index(Request $request){
        Gate::authorize('mentee-only');
        //Frontend may return null for empty strings--- convert back to empty string
        $q = $request->query('q')=='null' ? '' : $request->query('q','') ;
    
        $mentors = Mentor::query()
                    ->paginate();
        //Move to Get My Mentors Action
        $my_connected_mentors = MentorService::getUserConnectedMentors();
        //Move to get my requested mentors action
        $my_requested_mentors = MentorService::getUserRequestedMentors();
        //dd($my_mentors);
        
        return Inertia::render('Search/Index',[
            'mentors' => $mentors,
            'connected_mentors' => $my_connected_mentors,
            'requested_mentors' => $my_requested_mentors,
            'q' => $q,
            'expertises' => Expertise::all(['id','name']),
        ]);
    }
}
