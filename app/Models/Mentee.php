<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentee extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $with = ['user','experiences'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function experiences(){
        return $this->hasMany(MenteeExperience::class);
    }

    public function mentors(){
        return $this->belongsToMany(Mentor::class)->using(MentorMentee::class);
        // return $this->belongsToMany(Mentor::class,'mentor_mentees')
        //             ->withPivot('status')
        //             ->withTimestamps();
    }

    public function assessments(){
        return $this->hasMany(MentorAssessment::class);
    }
}
