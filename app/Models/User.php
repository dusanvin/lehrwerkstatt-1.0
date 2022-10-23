<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Auth\Events\Registered;
use Cmgmyr\Messenger\Traits\Messagable;
use DB;

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

    public function image()
    {
        return $this->hasOne(ImageFile::class);
    }

    public function getRoleName()
    {
        switch ($this->getRoleNames()[0]) {
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

    public function matchable()
    {
        if ($this->role == 'Lehr') {
            return $this->belongsToMany(User::class, 'lehr_stud', 'lehr_id', 'stud_id')->withPivot(['is_accepted_lehr', 'is_accepted_stud', 'is_matched', 'is_notified', 'mse', 'recommended', 'has_no_alternative_lehr', 'has_no_alternative_stud'])->withTimestamps();
        } elseif ($this->role == 'Stud') {
            return $this->belongsToMany(User::class, 'lehr_stud', 'stud_id', 'lehr_id')->withPivot(['is_accepted_lehr', 'is_accepted_stud', 'is_matched', 'is_notified', 'mse', 'recommended', 'has_no_alternative_lehr', 'has_no_alternative_stud'])->withTimestamps();
        }
        return $this->belongsToMany(User::class, 'lehr_stud', 'stud_id', 'lehr_id')->withPivot(['is_accepted_lehr', 'is_accepted_stud', 'is_matched', 'is_notified', 'mse', 'recommended', 'has_no_alternative_lehr', 'has_no_alternative_stud'])->withTimestamps();
    }

    public function getHasAnyMatchingAttribute() {
        if ($this->role == 'Lehr') {

            foreach($this->matchable as $stud) {
                if($stud->matching_state == 'unmatched') {
                    return true;
                }
            }
            
        } elseif ($this->role == 'Stud') {

            $lehr = $this->matchable;
            foreach($this->matchable as $lehr) {
                if($lehr->matching_state == 'unmatched') {
                    return true;
                }
            }
            
        }
        return false;
    }

    public function getFullNameAttribute() {
        return $this->vorname.' '.$this->nachname;
    }


    // public function getaAttribute() {
    //     if($this->role == 'Lehr') {
    //         $matching = DB::table('lehr_stud')->where('lehr_id', $this->id)->where('is_matched', true)->first();
    //         return User::find($matching->stud_id);
    //     }
    //     if($this->role == 'Stud') {
    //         $matching = DB::table('lehr_stud')->where('stud_id', $this->id)->where('is_matched', true)->first();
    //         return User::find($matching->lehr_id);
    //     }
    // }


    public function data()
    {
        if (is_string($this->survey_data)) {
            return json_decode($this->survey_data);
        }
    }


    public function getIsMatchableAttribute()
    {
        return $this->matchable->isNotEmpty();
    }
    

    public function getMatchingStateAttribute()
    {   
        if($this->matchable()->where(function ($query) {
            $query->where('is_matched', true)->orWhere('is_notified', true);
            })->doesntExist())
            return 'unmatched';

        if ($this->matchable()->where('is_matched', true)->where('is_notified', false)->exists()) 
            return 'matched';

        if ($this->matchable()->where('is_notified', true)->exists())
            return 'notified';

        // if ($this->matchable()->where('is_matched', true)->where('is_notified', true)->where(function ($query) {

        //     $query->whereNull('is_accepted_lehr')->where('is_accepted_stud', true)->orWhere(function ($query) {
        //             $query->where('is_accepted_lehr', true)->whereNull('is_accepted_stud');
        //         })->orWhere(function ($query) {
        //             $query->whereNull('is_accepted_lehr')->whereNull('is_accepted_stud');
        //         });
        //     })->exists())
        //                 return 'notified';

    }


    public function getMatchedUserAttribute() {
        return $this->matchable()->where('is_matched', true)->where('is_notified', false)->first();
    }


    public function getNotifiedUserAttribute() {
        return $this->matchable()->where('is_notified', true)->first();
    }


    public function hasMatchingAccepted($id) {
        if($this->role == 'Lehr') {
            return $this->matchable()->where('stud_id', $id)->where('is_accepted_lehr', true)->exists();
        }
        if($this->role == 'Stud') {
            return $this->matchable()->where('lehr_id', $id)->where('is_accepted_stud', true)->exists();
        }
        else return null;
    }


    public function hasMatchingDeclined($id) {
        if($this->role == 'Lehr') {
            return $this->matchable()->where('stud_id', $id)->where('is_accepted_lehr', false)->exists();
        }
        if($this->role == 'Stud') {
            return $this->matchable()->where('lehr_id', $id)->where('is_accepted_stud', false)->exists();
        }
        else return null;
    }

}
