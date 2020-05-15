<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Repository\UserRepository;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        $names = UserRepository::getAllNames();

        return $this->sendResult(
            'Selectable names',
            compact('names'),
            Response::HTTP_OK
        );
    }
}
