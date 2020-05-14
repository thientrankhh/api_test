<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\OvertimeRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Model\Overtime;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Repository\UserRepository;

class OvertimeController extends Controller
{
    public function index(Request $request)
    {
        $overtimes = Overtime::all();

        return $this->sendResult(
            'Overtimes',
            compact('overtimes'),
            Response::HTTP_OK
        );
    }

    public function store(OvertimeRequest $request)
    {
        $overtime = new Overtime($request->all());
        $overtime->creator_id = auth()->user()->id;
        $overtime->status = 0; // Set status to pending
        $overtime->save();

        return $this->sendResult(
            'Overtime was successfully created.',
            compact('overtime'),
            Response::HTTP_OK
        );
    }

    public function update(UpdateStatusRequest $request, Overtime $overtime)
    {
        $overtime->status = $request->status;
        $overtime->save();

        return $this->sendResult(
            'Status updated.',
            compact('overtime'),
            Response::HTTP_OK
        );
    }

    public function names()
    {
        $names = UserRepository::getAllNames();

        return $this->sendResult(
            'Selectable names',
            compact('names'),
            Response::HTTP_OK
        );
    }
}
