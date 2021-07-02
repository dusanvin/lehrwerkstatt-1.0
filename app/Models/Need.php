<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    use HasFactory;

    protected $fillable = [
        'body',
        'rahmen',
        'sprachkenntnisse',
        'studiengang',
        'fachsemester'
    ];

    public function ownedBy (User $user)
    {
        return $user->id === $this->user_id;
    }

    public function user() 
    {
    	return $this->belongsTo(User::class);
    }
    
}
