<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateStatusRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Repository\OvertimeRepository;
use Illuminate\Support\Facades\Config;

class OvertimeController extends Controller
{
    public function index(Request $request, $status)
    {
        $overtimes = OvertimeRepository::paginate($status);

        return $this->sendResult(
            'List OverTimes',
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
