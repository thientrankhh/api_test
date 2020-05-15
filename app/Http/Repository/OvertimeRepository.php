<?php

namespace App\Http\Repository;

use App\Model\Overtime;
use Illuminate\Support\Facades\Config;

class OvertimeRepository
{
    public static function pendingOvertimes()
    {
        return Overtime::where('approver_id', auth()->user()->approver_id)->paginate(Config::get('pagination.overtimes'));
    }

    public static function paginate()
    {
        return Overtime::paginate(Config::get('pagination.overtimes'));
    }

    public static function store($parameters)
    {
        $members = json_encode($parameters['member_ids']);
        $overtime = new Overtime($parameters);
        $overtime->member_ids = $members;
        $overtime->creator_id = auth()->user()->id;
        $overtime->status = 0; // Set status to pending
        $overtime->save();
        return $overtime;
    }

    public static function updateStatus($id, $status)
    {
        $overtime = Overtime::find($id);
        $overtime->status = $status;
        $overtime->save();
        return $overtime;
    }
}
