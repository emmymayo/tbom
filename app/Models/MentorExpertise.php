<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class MentorExpertise extends Model
{
    use HasFactory;

    protected $with = ['expertise'];

    public function expertise(){
        return $this->belongsTo(Expertise::class);
    }

}
