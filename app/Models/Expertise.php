<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expertise extends Model
{
    use HasFactory;

    public function mentors(){
        return $this->belongsToMany(Mentor::class,'mentor_expertises')
                    ->withPivot(['years_of_experience', 'duration_of_mentorship'])
                    ->withTimestamps();
    }
}
