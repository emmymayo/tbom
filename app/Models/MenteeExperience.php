<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenteeExperience extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function mentee(){
        return $this->belongsTo(Mentee::class);
    }
}
