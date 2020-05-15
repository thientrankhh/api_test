<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateStatusRequest;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Repository\OvertimeRepository;

class OvertimeController extends Controller
{
    public function index()
    {
        $overtimes = OvertimeRepository::paginate();

        return $this->sendResult(
            'Overtimes',
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
