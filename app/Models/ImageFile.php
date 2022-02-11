<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImageFile extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'user_id']; // 'data'

    public function user() {
        return $this->belongsTo(User::class);
    }
}
