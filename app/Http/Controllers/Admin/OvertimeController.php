<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateStatusRequest;
use Carbon\Carbon;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Repository\OvertimeRepository;
use Illuminate\Support\Facades\Config;

class OvertimeController extends Controller
{
    public function index()
    {
        $overtimes = OvertimeRepository::paginate(Config::get('statusOverTimes.pending'));

        return $this->sendResult(
            'List OverTimes Pending',
            compact('overtimes'),
            Response::HTTP_OK
        );
    }

    public function listApproved()
    {
        $overtimes = OvertimeRepository::paginate(Config::get('statusOverTimes.accepted'));

        return $this->sendResult(
            'List Overtimes Approved',
            compact('overtimes'),
            Response::HTTP_OK
        );
    }

    public function listDenited()
    {
        $overtimes = OvertimeRepository::paginate(Config::get('statusOverTimes.denited'));

        return $this->sendResult(
            'List Overtimes Denited',
            compact('overtimes'),
            Response::HTTP_OK
        );
    }

    public function update(UpdateStatusRequest $request, $id)
    {
        $overtime = OvertimeRepository::updateStatus($id, $request->status);

        return $this->sendResult(
            'Status updated.',
            compact('overtime'),
            Response::HTTP_OK
        );
    }
}
