<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Repository\OvertimeRepository;
use App\Http\Requests\UpdateStatusRequest;
use App\Mail\SendMailToCreator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mail;

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

        Mail::to($overtime->creator->email)
            ->send(new SendMailToCreator($request->status, $overtime));

        return $this->sendResult(
            'Status updated.',
            compact('overtime'),
            Response::HTTP_OK
        );
    }
}
