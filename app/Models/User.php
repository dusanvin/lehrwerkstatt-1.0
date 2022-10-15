<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Events\Registered;
use Cmgmyr\Messenger\Traits\Messagable;

use App\Notifications\CustomVerifyEmail;


class User extends Authenticatable implements MustVerifyEmail
{
    use Messagable, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'vorname',
        'nachname',
        'email',
        'password',
        'role',
        'survey_data',
        'is_evaluable',
        'assigned',
        'is_matchable',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function SendEmailVerificationNotification() 
    {
        $this->notify(new CustomVerifyEmail);
    }

    public function image() {
        return $this->hasOne(ImageFile::class);
    }

    public function getRoleName() {
        switch($this->getRoleNames()[0]) {
            case 'Admin':
                return 'Administration';
            case 'Moderierende':
                return 'Moderation';
            case 'Stud':
                return 'Studium';
            case 'Lehr':
                return 'Schuldienst';
        }
    }

    public function matchable(){
        if ($this->role == 'Lehr') {
            return $this->belongsToMany(User::class, 'lehr_stud_matchable', 'lehr_id', 'stud_id')->withPivot(['mse', 'recommended'])->withTimestamps();
        } elseif ($this->role == 'Stud') {
            return $this->belongsToMany(User::class, 'lehr_stud_matchable', 'stud_id', 'lehr_id')->withPivot(['mse', 'recommended'])->withTimestamps();
        }  
    }

    public function prematched(){
        if ($this->role == 'Lehr') {
            return $this->belongsToMany(User::class, 'lehr_stud', 'lehr_id', 'stud_id')->withPivot(['is_accepted_lehr', 'is_accepted_stud', 'is_notified', 'mse'])->withTimestamps()->wherePivot('is_notified', false);
        } elseif ($this->role == 'Stud') {
            return $this->belongsToMany(User::class, 'lehr_stud', 'stud_id', 'lehr_id')->withPivot(['is_accepted_lehr', 'is_accepted_stud', 'is_notified', 'mse'])->withTimestamps()->wherePivot('is_notified', false);
        }  
    }

    public function matchings(){
        // return $this->belongsToMany(User::class, 'user_user', 'user_id', 'matching_id');
        if ($this->role == 'Lehr') {
            return $this->belongsToMany(User::class, 'lehr_stud', 'lehr_id', 'stud_id')->withPivot(['is_accepted_lehr', 'is_accepted_stud', 'is_notified', 'mse'])->withTimestamps()->wherePivot('is_notified', true);
        } elseif ($this->role == 'Stud') {
            return $this->belongsToMany(User::class, 'lehr_stud', 'stud_id', 'lehr_id')->withPivot(['is_accepted_lehr', 'is_accepted_stud', 'is_notified', 'mse'])->withTimestamps()->wherePivot('is_notified', true);
        }  
    }
    
    public function data() {
        if(is_string($this->survey_data)) {
            return json_decode($this->survey_data);
        }
    }

}
