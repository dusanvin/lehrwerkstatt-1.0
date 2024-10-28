<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeclinedMatching extends Model
{
    use HasFactory;

    protected $fillable = [
        'lehr_id',
        'stud_id',
        'role',
        'schulart',
        'text'
    ];

    public function lehr() {
        return $this->belongsTo(User::class, 'lehr_id');
    }

    public function stud() {
        return $this->belongsTo(User::class, 'stud_id');
    }
}
