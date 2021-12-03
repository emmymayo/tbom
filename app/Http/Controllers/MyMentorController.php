<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Services\Mentors\Mentor as MentorService;

class MyMentorController extends Controller
{
    public function index(){
        Gate::authorize('mentee-only');
        
        return Inertia::render('Mentee/Mentors/Index',[
            'connected_mentors' => MentorService::getUserConnectedMentors(),
            'requested_mentors' => MentorService::getUserRequestedMentors(),
        ]);
    }
}
