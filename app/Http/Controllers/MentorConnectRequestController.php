<?php

namespace App\Http\Controllers;

use App\Models\Mentee;
use App\Models\Mentor;
use Illuminate\Http\Request;
use App\Models\MentorMentee;
use Illuminate\Support\Facades\Gate;

class MentorConnectRequestController extends Controller
{

    public function __invoke()
    {
         //Ensure its a Mentee
         Gate::authorize('mentee-only');

         $data = request()->validate([
            'mentor_id' => ['required', 'exists:mentors,id'],
            'action' => ['in:request,cancel,disconnect']
        ]);

        //get authenticated mentee
        $mentee = Mentee::firstWhere('user_id',auth()->id());
        
        //Depending on the query parameter action
        $data['action'] === 'request' ? $this->makeRequest($data['mentor_id'], $mentee->id)
                                      : ( ($data['action'] == 'cancel') ? $this->cancelRequest($data['mentor_id'], $mentee->id)
                                                                        : $this->disconnectRequest($data['mentor_id'], $mentee->id)
                                        );
        
        if(request()->acceptsJson()){
            return response()->json(['message' => 'success'],201);
        }
    }

    protected function makeRequest($mentor_id, $mentee_id){
        // $mentor = Mentor::find($mentor_id);
        // $mentor->mentees()->attach($mentee_id, ['status' => MentorMentee::STATUS_PENDING]); 

        MentorMentee::create([
            'mentor_id' => $mentor_id,
            'mentee_id' => $mentee_id,
            'status' => MentorMentee::STATUS_PENDING
        ]);
    }

    protected function cancelRequest($mentor_id, $mentee_id){
        //  $mentor = Mentor::find($mentor_id);
        //  $mentor->mentees()->detach($mentee_id);
        
        MentorMentee::where('mentor_id', $mentor_id)
                    ->where('mentee_id', $mentee_id)
                    ->where('status', MentorMentee::STATUS_PENDING)
                    ->delete();
    }

    protected function disconnectRequest($mentor_id, $mentee_id){
        //  $mentor = Mentor::find($mentor_id);
        //  $mentor->mentees()->detach($mentee_id);
        
        MentorMentee::where('mentor_id', $mentor_id)
                    ->where('mentee_id', $mentee_id)
                    ->where('status', MentorMentee::STATUS_CONNECTED)
                    ->delete();
    }
    
}
