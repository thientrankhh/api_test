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
        $users = User::paginate(4);

        return $this->sendResult(
            'Users',
            compact('users'),
            Response::HTTP_OK
        );
    }

    public function toggle($id)
    {
        $user = User::find($id);
        $user->active = !$user->active;
        $user->save();

        return $this->sendResult(
            'User\'s status changed',
            compact('user'),
            Response::HTTP_OK
        );
    }

    public function changeRole()
    {

    }
}
