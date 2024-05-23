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
}
