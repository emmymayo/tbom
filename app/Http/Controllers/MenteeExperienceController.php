<?php

namespace App\Http\Controllers;

use App\Models\MenteeExperience;
use App\Models\Mentee;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MenteeExperienceController extends Controller
{
    public function index(){
        
        $experiences = MenteeExperience::whereIn('mentee_id',
                        function($query){
                            $query->select('id')
                                ->from('mentees')
                                ->where('user_id',auth()->id());
                        })->get();
                    
        return Inertia::render('Mentee/Experience/Index',[
            'experiences' =>  $experiences,
        ]);
    }

    public function create(){
        return Inertia::render('Mentee/Experience/AddExperience');
    }

    public function store(Request $request){
        $data = $request->validate([
            'school' => ['required','string', 'max:255'],
            'degree' => ['nullable','string', 'max:255'],
            'area_of_study' => ['nullable','string', 'max:255'],
            'from' => ['nullable', 'year'],
            'to' => ['nullable', 'year'],
            'mentee_id' => ['required','exists:mentees,id']
        ]);

        MenteeExperience::create($data);

        return redirect()->route('mentee.experience')->banner('Educational Experience Added');
    }
}
