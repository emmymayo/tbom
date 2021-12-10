<?php

namespace App\Services\Mentees ;

use App\Models\MentorMentee;

class Mentee {

    public static function getUserConnectedMentees($paginate = false){
        
       $mentees_query = MentorMentee::with('mentee')->where('status', MentorMentee::STATUS_CONNECTED)
                            ->whereIn('mentor_id', function($query){
                                        $query->select('id')
                                            ->from('mentors')
                                            ->where('user_id', auth()->id());
                            });
        return $paginate == true? $mentees_query->paginate() : $mentees_query->get();
    }

    public static function getUserRequestedMentees($paginate = false){

        $mentees_query = MentorMentee::with('mentee')->where('status', MentorMentee::STATUS_PENDING)
                            ->whereIn('mentor_id', function($query){
                                        $query->select('id')
                                            ->from('mentors')
                                            ->where('user_id', auth()->id());
                            });
        return $paginate == true? $mentees_query->paginate() : $mentees_query->get();
    }

   
}