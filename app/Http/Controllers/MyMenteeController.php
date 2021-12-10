<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Services\Mentees\Mentee as MenteeService;

class MyMenteeController extends Controller
{
    public function index(){
        Gate::authorize('mentor-only'); 
        
        return Inertia::render('Mentor/Mentees/Index',[
            'connected_mentees' => MenteeService::getUserConnectedMentees(),
            'requested_mentees' => MenteeService::getUserRequestedMentees(),
        ]);
    }
}
