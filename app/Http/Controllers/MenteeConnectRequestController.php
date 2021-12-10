<?php

namespace App\Http\Controllers;

use App\Models\Mentee;
use App\Models\Mentor;
use App\Models\MentorMentee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MenteeConnectRequestController extends Controller
{
    /* 
    *  Mentor Handles Connect Request From Mentee
    * May Decline Request, Accept Request or Disconnect From Existing Connection
    */

    public function __invoke()
    {
         //Ensure its a Mentor
         Gate::authorize('mentor-only');

         $data = request()->validate([
            'mentee_id' => ['required', 'exists:mentees,id'],
            'action' => ['in:accept,decline,disconnect']
        ]);

        //get authenticated mentor
        $mentor = Mentor::firstWhere('user_id',auth()->id());
        
        //Depending on the query parameter action
        $data['action'] === 'accept' ? $this->acceptRequest($mentor->id, $data['mentee_id'])
                                      : ( ($data['action'] == 'decline') ? $this->declineRequest($mentor->id, $data['mentee_id'])
                                                                        : $this->disconnectRequest($mentor->id, $data['mentee_id'])
                                        );
        
        if(request()->acceptsJson()){
            return response()->json(['message' => 'success'],201);
        }
    }

    protected function acceptRequest($mentor_id, $mentee_id){
        // Get Connection request made my Mentee
        $connection_request = MentorMentee::where('mentor_id', $mentor_id)
                                ->where('mentee_id', $mentee_id)
                                ->where('status', MentorMentee::STATUS_PENDING)
                                ->first();
        // Change status to connected
        $connection_request->status = MentorMentee::STATUS_CONNECTED;
        $connection_request->save();
    }

    protected function declineRequest($mentor_id, $mentee_id){
        // Delete the connection request 
        // OR we might consider switching the status to MentorMentee::STATUS_DECLINED for audit reasons
        MentorMentee::where('mentor_id', $mentor_id)
                    ->where('mentee_id', $mentee_id)
                    ->where('status', MentorMentee::STATUS_PENDING)
                    ->delete();
    }

    protected function disconnectRequest($mentor_id, $mentee_id){
    //   Delete a previously accepted Connection request
        MentorMentee::where('mentor_id', $mentor_id)
                    ->where('mentee_id', $mentee_id)
                    ->where('status', MentorMentee::STATUS_CONNECTED)
                    ->delete();
    }
}
