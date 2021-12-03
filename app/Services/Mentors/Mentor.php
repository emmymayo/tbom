<?php

namespace App\Services\Mentors ;

use App\Models\MentorMentee;

class Mentor {

    public static function getUserConnectedMentors($paginate = false){
        
       $mentors_query = MentorMentee::with('mentor')->where('status', MentorMentee::STATUS_CONNECTED)
                            ->whereIn('mentee_id', function($query){
                                        $query->select('id')
                                            ->from('mentees')
                                            ->where('user_id', auth()->id());
                            });
        return $paginate == true? $mentors_query->paginate() : $mentors_query->get();
    }

    public static function getUserRequestedMentors($paginate = false){

        $mentors_query = MentorMentee::with('mentor')->where('status', MentorMentee::STATUS_PENDING)
                            ->whereIn('mentee_id', function($query){
                                        $query->select('id')
                                            ->from('mentees')
                                            ->where('user_id', auth()->id());
                            });
        return $paginate == true? $mentors_query->paginate() : $mentors_query->get();
    }

   
}