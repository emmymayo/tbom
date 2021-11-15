<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;


class MentorMentee extends Pivot
{
    use HasFactory;

    const STATUS_PENDING = 1;
    const STATUS_CONNECTED = 2;
    const STATUS_DECLINED = 3;

    
}
