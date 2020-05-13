<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function sendResult(
        string  $message,
        array   $data,
        int     $httpCode
    ) {
        return response()->json(
            [
                'message' => $message,
                $data
            ],
            $httpCode
        );
    }

    public function sendError(
        string  $message,
        array   $errors,
        int     $httpCode
    ) {
        return response()->json(
            [
                'message' => $message,
                $errors
            ],
            $httpCode
        );
    }
}
