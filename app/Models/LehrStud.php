<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\User;


class LehrStud extends Pivot
{
    public function lehr() {
        return $this->belongsTo(User::class, 'lehr_id');
    }

    public function stud() {
        return $this->belongsTo(User::class, 'stud_id');
    }
}


