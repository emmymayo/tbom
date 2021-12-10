<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    //use TwoFactorAuthenticatable;


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'nationality_id',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_PENDING = 2;
    const STATUS_DISABLED = 3;

    protected $with = ['role','nationality:id,country','documents'];

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function nationality(){
        return $this->belongsTo(Nationality::class);
    }

    public function mentee(){
        return $this->hasOne(Mentee::class);
    }
    public function mentor(){
        return $this->hasOne(Mentor::class);
    }

    public function documents(){
        return $this->hasMany(UserDocument::class);
    }

    public function isMentee(){
        return $this->role->name == 'mentee'? true : false ;
    }

    public function isMentor(){
        return $this->role->name == 'mentor'? true : false ;
    }

    public function disable(){
        $this->status = static::STATUS_DISABLED;
        $this->save();
        return $this;
    }
}
