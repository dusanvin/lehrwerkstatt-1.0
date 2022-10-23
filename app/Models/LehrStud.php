<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;


class LehrStud extends Pivot
{
    public function getLehrAttribute() {
        return User::find($this->lehr_id);
    }

    public function getStudAttribute() {
        return User::find($this->stud_id);
    }
}
