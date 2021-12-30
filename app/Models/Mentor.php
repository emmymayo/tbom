<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function assessments(){
        return $this->hasMany(MentorAssessment::class);
    }
    /* 
        assessing six attributes in percentage
        expertise, availability, motivation, listening, adaptability, positivity
        To find index
        Step 1 - Sum the attributes for each assessment
        Step 2 - find the avearge
        Step 3 - divide by no of attributes
    */
    public function assessmentIndex(){
        $no_of_attributes = 6;
        $average_of_sum = MentorAssessment::where('mentor_id',$this->id)
                            ->select()
                            ->avg(DB::raw('expertise+availability+motivation+listening+adaptability+positivity'));
        $index = $average_of_sum/$no_of_attributes;      
        $index = round($index,1);
        return $index;
        
    }

    protected static function booted(){
        static::addGlobalScope('disabled', function(Builder $query){
            $query->whereIn('user_id',User::all()->pluck('id'));
        });
    }
    
}
