<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Repository\UserRepository;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index()
    {
        $users = UserRepository::paginate();

        return $this->sendResult(
            'Users',
            compact('users'),
            Response::HTTP_OK
        );
    }

    public function toggleStatus($id)
    {
        $user = UserRepository::toggleStatus($id);

        return $this->sendResult(
            'User\'s status changed',
            compact('user'),
            Response::HTTP_OK
        );
    }

    public function toggleRole($id)
    {
        $user = UserRepository::toggleRole($id);

        return $this->sendResult(
            'User\'s role changed',
            compact('user'),
            Response::HTTP_OK
        );
    }
}
