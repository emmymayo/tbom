<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    const DOC_TYPE_CV = 1;
    const DOC_TYPE_BIO = 2;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
