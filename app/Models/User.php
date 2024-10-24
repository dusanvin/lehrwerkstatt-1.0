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
use Cmgmyr\Messenger\Models\Thread;


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
        'nutzungsbedingungen',
        'datenschutz'
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

    // $user->survey_data as json object
    public function getSurveyDataAttribute($value)
    {
        return json_decode($value);
    }

    public function setSurveyDataAttribute($value)
    {
        $this->attributes['survey_data'] = json_encode($value);
    }

    public function getFaecherAsStringAttribute()
    {
        if (isset($surveyData->faecher) && is_array($surveyData->faecher)) {
            return implode(', ', $this->survey_data->faecher);
        }
        else return 'Keine Fächer angegeben';
    }

    public function getLandkreiseAsStringAttribute()
    {
        return implode(', ', $this->survey_data->landkreise);
    }


    public function SendEmailVerificationNotification()
    {
        $this->notify(new CustomVerifyEmail);
    }

    // $user->image, returns row of image table
    public function image()
    {
        return $this->hasOne(ImageFile::class);
    }

    // remap to ui strings
    public function getRoleName()
    {
        // $this->getRoleNames() from spatie permissions
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

    // returns all possible matchable user instances along with attributes from lehr_stud
    public function matchable()
    {
        [$current_id, $related_id] = ['stud_id', 'lehr_id'];
        if ($this->role == 'Lehr') {
            [$current_id, $related_id] = [$related_id, $current_id];
        }
        // the order of arguments is important: pivot_table, current_id, related_id
        // withPivot: returns additionally the specified attributes from lehr_stud table along with user instances
        // current user id gets inserted always as third argument, so the proper column name has to be provided
        // if it is a lehr user 'lehr_id', for stud user 'stud_id'
        // related user id is fourth argument
        // syncWithoutDetaching(id): id refers to related_id, which is related models primary key
        return $this->belongsToMany(User::class, 'lehr_stud', $current_id, $related_id)
            ->withPivot(['is_accepted_lehr', 'is_accepted_stud', 'is_matched', 'is_notified', 
                    'mse', 'recommended', 'has_no_alternative_lehr', 'has_no_alternative_stud'])->withTimestamps();
    }

    // access with $user->full_name
    public function getFullNameAttribute() {
        return $this->vorname.' '.$this->nachname;
    }

    // access with $user->is_matchable
    public function getIsMatchableAttribute()
    {
        return $this->matchable->isNotEmpty();
    }
    
    // access with $user->matching_state
    public function getMatchingStateAttribute()
    {   
        if($this->matchable()->where(function ($query) {
            $query->where('is_matched', true)->orWhere('is_notified', true);
            })->doesntExist())
            return 'unassigned';

        if ($this->matchable()->where('is_matched', true)->where('is_notified', false)->exists()) 
            return 'matched';

        if ($this->matchable()->where('is_notified', true)->exists())
            return 'notified';

    }

    // access with $user->matched_user, matchingpartner aus der vorauswahl
    public function getMatchedUserAttribute() {
        return $this->matchable()->where('is_matched', true)->where('is_notified', false)->first();
    }

    // access with $user->notified_user, fest vorgeschlagener matchingpartner
    public function getNotifiedUserAttribute() {
        return $this->matchable()->where('is_notified', true)->first();
    }

    public function excludeFromMatching() {
        // einträge in denen user enthalten ist, können gelöscht werden
        DB::table('lehr_stud')->where('lehr_id', $user->id)->orWhere('stud_id', $user->id)->delete();

        if (!$user->is_available) {
            $matched_user = $user->matched_user;
            $matched_user->is_available = true;
            $matched_user->save();
        }

        $user->is_evaluable = false;
        $user->is_available = true;
        $user->save();
    }

    // access with $user->unread_messages, anzahl ungelesener nachrichten
    public function getUnreadMessagesAttribute() {
        $threads = Thread::forUser($this->id)
            ->latest('updated_at')
            ->simplePaginate(5);
        $count = 0;
        foreach($threads as $thread) {
            $count += $thread->userUnreadMessagesCount($this->id);
        }
        return $count;
    }


    // TODO: vereinfachung: sollte mit $user->notified_user gehen
    public function hasMatchingAccepted($id) {
        if($this->role == 'Lehr') {
            return $this->matchable()->where('stud_id', $id)->where('is_accepted_lehr', true)->exists();
        }
        if($this->role == 'Stud') {
            return $this->matchable()->where('lehr_id', $id)->where('is_accepted_stud', true)->exists();
        }
        else return null;
    }

    // TODO: vereinfachung: sollte mit $user->notified_user gehen
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
