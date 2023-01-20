<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\User;


class LehrStud extends Pivot
{
    public function getLehrAttribute() {
        return User::find($this->lehr_id);
    }

    public function getStudAttribute() {
        return User::find($this->stud_id);
    }

    // ::with('lehr_id') in queries
    public function lehr_id() {
        return $this->belongsTo(User::class, 'lehr_id');
    }

    // ::with('stud_id') in queries
    public function stud_id() {
        return $this->belongsTo(User::class, 'stud_id');
    }
}


