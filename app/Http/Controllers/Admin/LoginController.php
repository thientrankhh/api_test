<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Repository\UserRepository;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->all())) {
            return $this->sendError(
                'Wrong email or password.',
                [],
                Response::HTTP_BAD_REQUEST
            );
        }
        
        $access_token = UserRepository::createToken(auth()->user());
        
        return $this->sendResult(
            'Successful login',
            compact('access_token'),
            Response::HTTP_OK
        );
    }

    public function logout()
    {
        $token = auth()->user()->token();
        $token->revoke();
        
        return $this->sendResult(
            'Logged out',
            [],
            Response::HTTP_ACCEPTED
        );
    }
}
