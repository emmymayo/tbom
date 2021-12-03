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
        return Inertia::render('Mentee/Experience/AddExperience',[
            'mentee' => Mentee::firstWhere('user_id',auth()->id())
        ]);
    }

    public function edit(MenteeExperience $experience){
        
        return Inertia::render('Mentee/Experience/EditExperience',[
            'experience' => $experience
        ]);
    }

    public function store(Request $request){
        // TODO Validate minimum Year FRom /To
        $data = $request->validate([
            'school' => ['required','string', 'max:255'],
            'degree' => ['nullable','string', 'max:255'],
            'area_of_study' => ['nullable','string', 'max:255'],
            'from' => ['nullable', 'date_format:Y'],
            'to' => ['nullable', 'date_format:Y'],
            'mentee_id' => ['required','exists:mentees,id']
        ]);

        MenteeExperience::create($data);

        return redirect()->route('mentee.experience')->banner('Educational Experience Added');
    }

    public function update(Request $request, MenteeExperience $experience){
        // TODO Validate minimum Year FRom /To
        $data = $request->validate([
            'school' => ['nullable','string', 'max:255'],
            'degree' => ['nullable','string', 'max:255'],
            'area_of_study' => ['nullable','string', 'max:255'],
            'from' => ['nullable', 'date_format:Y'],
            'to' => ['nullable', 'date_format:Y'],
        ]);
        
        $experience->update($data);

        return redirect()->route('mentee.experience')->banner('Educational Experience Updated');
    }

    public function destroy(MenteeExperience $experience){
        
       
        $experience->delete();

        return redirect()->route('mentee.experience')->banner('Educational Experience Trashed');
    }
}
