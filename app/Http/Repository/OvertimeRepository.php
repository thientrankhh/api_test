<?php

namespace App\Http\Repository;

use App\Model\Overtime;
use App\User;
use Illuminate\Support\Facades\Config;

class OvertimeRepository
{
    public static function pendingOvertimes()
    {
        return Overtime::where('approver_id', auth()->user()->approver_id)
            ->paginate(Config::get('pagination.overtimes'));
    }

    public static function paginate()
    {
        $overtimes = Overtime::with('creator','approver')->where('status', 0)
            ->paginate(Config::get('pagination.overtimes'));
        foreach ($overtimes as $key => $value) {
            $member_array = json_decode($value->member_ids);
            $value->member_ids = $value->members($member_array);
            $value->hour = (strtotime($value->to) - strtotime($value->from)) / 3600;
        }

        return $overtimes;
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
