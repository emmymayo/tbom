<?php

namespace App\Http\Controllers;

use App\Models\Expertise;
use App\Models\Mentee;
use App\Models\Mentor;
use App\Models\MentorExpertise;
use App\Models\MentorMentee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use App\Services\Mentors\Mentor as MentorService;
use Illuminate\Validation\Rule;

class MentorSearchController extends Controller
{
    public function index(Request $request){
        Gate::authorize('mentee-only');
        //Frontend may return null for empty strings--- convert back to empty string
        
        $data = $request->validate([
            'q' => 'nullable|string',
            'f' => 'nullable|integer|exists:expertises,id'
        ]);
        $q = isset($data['q'])?$data['q']:null; //$request->query('q')=='null' ? null : $request->query('q','') ;
        $f = isset($data['f'])?$data['f']:null; //$request->query('f')=='null' ? null : $request->query('f','') ;
        $mentors = Mentor::query()
                    ->when(isset($f), function($query) use($f){
                        $query->whereIn('id', function($query) use($f){
                                $query->select('mentor_id')
                                    ->from('mentor_expertises')
                                    ->where('expertise_id',$f);
                        });
                    })
                    ->when(isset($q)!=null, function($query) use($q){
                            $query->whereIn('user_id',function($query) use($q){
                                $query->select('id')
                                      ->from('users')
                                      ->where('name','LIKE','%'.$q.'%');
                            });
                    })
                    ->when(isset($q), function($query) use($q){
                            $query->orWhereIn('id', 
                                    MentorExpertise::whereIn('expertise_id', 
                                        Expertise::where('name','LIKE','%'.$q.'%')
                                                 ->pluck('id'))
                                        ->pluck('mentor_id'));
                    })
                    ->paginate();
        
        $my_connected_mentors = MentorService::getUserConnectedMentors();
        
        $my_requested_mentors = MentorService::getUserRequestedMentors();
        
        
        return Inertia::render('Search/Index',[
            'mentors' => $mentors,
            'connected_mentors' => $my_connected_mentors,
            'requested_mentors' => $my_requested_mentors,
            'q' => $q,
            'f' => $f,
            'expertises' => Expertise::all(['id','name']),
        ]);
    }
}
