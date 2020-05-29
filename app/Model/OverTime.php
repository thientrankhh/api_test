<?php

namespace App\Model;

use App\User;
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

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id')->select('id', 'name', 'email');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id')->select('id', 'name');
    }

    public static function members(array $member_array)
    {
        $members = User::query()->whereIn('id', $member_array)->get('name');

        return $members;
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
