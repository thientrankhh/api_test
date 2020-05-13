<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OverTime extends Model
{
    public function user()
    {
        return $this->belongsTo(OverTime::class);
    }
}
