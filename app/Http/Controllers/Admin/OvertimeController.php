<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OvertimeRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Model\Overtime;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Repository\UserRepository;
use App\Http\Repository\OvertimeRepository;

class OvertimeController extends Controller
{
    public function index(Request $request)
    {
        $overtimes = Overtime::paginate(4);

        return $this->sendResult(
            'Overtimes',
            compact('overtimes'),
            Response::HTTP_OK
        );
    }

    public function update(UpdateStatusRequest $request, $id)
    {
        $overtime = OvertimeRepository::getOvertime($id);
        $overtime->status = $request->status;
        $overtime->save();

        return $this->sendResult(
            'Status updated.',
            compact('overtime'),
            Response::HTTP_OK
        );
    }
}
