<?php

namespace App\Http\Controllers;

use App\Models\Expertise;
use App\Models\Mentor;
use App\Models\MentorExpertise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MentorExpertiseController extends Controller
{
    public function index(){
        
        $mentor_expertises = MentorExpertise::whereIn('mentor_id',
                        function($query){
                            $query->select('id')
                                ->from('mentors')
                                ->where('user_id',auth()->id());
                        })->get();
                    
        return Inertia::render('Mentor/Expertise/Index',[
            'mentor_expertises' =>  $mentor_expertises,
        ]);
    }

    public function create(){
        return Inertia::render('Mentor/Expertise/AddMentorExpertise',[
            'mentor' => Mentor::firstWhere('user_id',auth()->id())
        ]);
    }

    public function edit(MentorExpertise $mentor_expertise){
        
        return Inertia::render('Mentor/Expertise/EditMentorExpertise',[
            'mentor_expertise' => $mentor_expertise
        ]);
    }

    
    public function store(Request $request){
        // TODO Validate minimum Year FRom /To
        $data = $request->validate([
            'expertise' => ['required','string', 'max:255'],
            'years_of_experience' => ['nullable','numeric', 'max:99'],
            'duration_of_mentorship' => ['nullable','string', 'max:255'],
            
            'mentor_id' => ['required','exists:mentors,id']
        ]);

        $mentor_expertise = DB::transaction(function() use($data){
            $expertise = Expertise::firstWhere('name',$data['expertise']);
            if(!$expertise){
                $expertise = new Expertise();
                $expertise->name = $data['expertise'];
                $expertise->save();
            }

            $mentor_expertise = new MentorExpertise();
            $mentor_expertise->expertise_id = $expertise->id;
            $mentor_expertise->mentor_id = $data['mentor_id'];
            $mentor_expertise->years_of_experience = $data['years_of_experience'];
            $mentor_expertise->duration_of_mentorship = $data['duration_of_mentorship'];
            $mentor_expertise->save();
            return $mentor_expertise;
        
        });
        
        return redirect()->route('mentor.expertise')->banner('Expertise Added');
    }

    public function update(Request $request, MentorExpertise $mentor_expertise){
        // TODO Validate minimum Year FRom /To
        $data = $request->validate([
            'expertise' => ['nullable','string', 'max:255'],
            'years_of_experience' => ['nullable','numeric', 'max:99'],
            'duration_of_mentorship' => ['nullable','string', 'max:255'],
        ]);
        DB::transaction(function() use($data, $mentor_expertise){
            //Check if the expertise was provided
            //if true fetch the expertise
            $expertise = isset($data['expertise'])?Expertise::firstWhere('name',$data['expertise']):null;
            
            if(!$expertise && isset($data['expertise']) ){
                //if no such expertise in db and it was provided then create a new one
                $expertise = new Expertise();
                $expertise->name = $data['expertise'];
                $expertise->save();
            }

            
            //if its not null then update else it wasnt provided
            $expertise!=null? $mentor_expertise->expertise_id = $expertise->id:null;
            isset($data['years_of_experience']) ? $mentor_expertise->years_of_experience = $data['years_of_experience']:null;
            isset($data['duration_of_mentorship']) ? $mentor_expertise->duration_of_mentorship = $data['duration_of_mentorship'] : null;
            $mentor_expertise->save();
        
        });

        return redirect()->route('mentor.expertise')->banner('Expertise Updated');
    }

    public function destroy(MentorExpertise $mentor_expertise){
        
       
        $mentor_expertise->delete();

        return redirect()->route('mentor.expertise')->banner('Expertise Trashed');
    }
}
