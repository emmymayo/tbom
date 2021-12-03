<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Mentor extends Model
{
    use HasFactory;
 
    protected $guarded = ['id'];

    protected $with = ['user','expertises:id,name', 'qualification:id,name'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    // Highest Qualification
    public function qualification(){
        return $this->belongsTo(Qualification::class);
    }

    public function expertises(){
        return $this->belongsToMany(Expertise::class,'mentor_expertises')
                    ->withPivot(['years_of_experience', 'duration_of_mentorship'])
                    ->withTimestamps();
    }

    public function mentees(){
        return $this->belongsToMany(Mentee::class)->using(MentorMentee::class);
        // return $this->belongsToMany(Mentee::class,'mentor_mentees')
        //             ->withPivot('status')
        //             ->withTimestamps();
    }
}
