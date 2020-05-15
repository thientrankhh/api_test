<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Uuids;

class Overtime extends Model
{
    use Uuids;

      /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = ['creator_id', 'member_ids', 'from', 'to', 'approver_id', 'reason'];

    public function user()
    {
        return $this->belongsTo(Overtime::class);
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
