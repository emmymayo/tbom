<?php

namespace App\Http\Controllers;

use App\Models\Mentee;
use App\Models\Mentor;
use App\Models\MentorAssessment;
use App\Services\Mentors\Mentor as MentorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class MentorAssessmentController extends Controller
{
    private $max_rating = 100;
    public function edit(Request $request, Mentor $mentor){
        Gate::authorize('mentee-only');

        $mentor_assessment = MentorService::getUserMentorAssessment($mentor->id);
        if($mentor_assessment==null){
            $max_rating= $this->max_rating;
            $mentor_assessment = (new MentorAssessment)->forceFill([
                'mentee_id' => Mentee::firstWhere('user_id',auth()->id())->id,
                'mentor_id' => $mentor->id,
                'expertise' => $max_rating,
                'availability' => $max_rating,
                'motivation' => $max_rating,
                'listening' => $max_rating,
                'adaptability' => $max_rating,
                'positivity' => $max_rating,
            ]);
        }
        
        return Inertia::render('Mentee/Mentors/Assessment',[
            'mentor' => $mentor,
            'assessment' => $mentor_assessment
        ]);
    }

    public function update(Request $request, Mentor $mentor){
        Gate::authorize('mentee-only');
        $max_rating = $this->max_rating;
        $data = $request->validate([
            'expertise' => ['required','integer','min:1','max:'.$max_rating],
            'availability' => ['required','integer','min:1','max:'.$max_rating],
            'motivation' => ['required','integer','min:1','max:'.$max_rating],
            'listening' => ['required','integer','min:1','max:'.$max_rating],
            'adaptability' => ['required','integer','min:1','max:'.$max_rating],
            'positivity' => ['required','integer','min:1','max:'.$max_rating],
        ]);

        MentorAssessment::updateOrCreate(
            [
                'expertise' => $data['expertise'],
                'availability' => $data['availability'],
                'motivation' => $data['motivation'],
                'listening' => $data['listening'],
                'adaptability' => $data['listening'],
                'adaptability' => $data['adaptability'],
                'positivity' => $data['positivity'],
            ],
            [
                'mentee_id' => Mentee::firstWhere('user_id',auth()->id())->id, 
                'mentor_id' => $mentor->id, 
            ]
        );

        return back()->banner('Assessment Updated Successfully');
    }
}
