<?php

namespace App\Http\Repository;

use App\Model\Overtime;

class OvertimeRepository
{
    public static function getOvertime($id)
    {
        return Overtime::find($id);
    }

    public static function pendingOvertimes()
    {
        return Overtime::where('approver_id', auth()->user()->approver_id);
    }
}
