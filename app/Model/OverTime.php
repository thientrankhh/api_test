<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    protected $fillable = ['creator_id', 'member_ids', 'from', 'to', 'approval_id', 'reason'];

    public function user()
    {
        return $this->belongsTo(Overtime::class);
    }
}
