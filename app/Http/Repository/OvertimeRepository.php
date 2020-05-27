<?php

namespace App\Http\Repository;

use App\Model\Overtime;
use Illuminate\Support\Facades\Config;

class OvertimeRepository
{
    public static function pendingOverTimes()
    {
        $overtimes = Overtime::with('creator', 'approver')->where('status', 0)->get();
        foreach ($overtimes as $key => $value) {
            $member_array = json_decode($value->member_ids);
            $value->member_ids = $value->members($member_array);
            $value->hour = (strtotime($value->to) - strtotime($value->from)) / 3600;
        }

        return $overtimes;
    }

    public static function listApprove()
    {
        $overtimes = Overtime::with('creator', 'approver')
            ->where('approver_id', auth()->user()->id)->get();
        foreach ($overtimes as $key => $value) {
            $member_array = json_decode($value->member_ids);
            $value->member_ids = $value->members($member_array);
            $value->hour = (strtotime($value->to) - strtotime($value->from)) / 3600;
        }

        return $overtimes;
    }

    public static function paginate()
    {
        $overtimes = Overtime::with('creator', 'approver')->where('status', 0)
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
        $overtime->approver_id = auth()->user()->id;
        $overtime->save();

        return $overtime;
    }
}
