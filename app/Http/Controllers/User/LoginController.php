<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\User;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Repository\UserRepository;
use DB;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $google_response = Http::withToken($request->bearerToken())->get('https://openidconnect.googleapis.com/v1/userinfo');
        $google_credentials = json_decode($google_response, true);

        if ($google_response->failed()) {
            return $this->sendError(
                'Google authentication failed',
                $google_credentials,
                Response::HTTP_UNAUTHORIZED
            );
        }
        if (!UserRepository::checkEmailCompany($google_credentials['email'])) {
            return $this->sendError(
                'Email must have @dienhoa1080.com',
                [],
                Response::HTTP_UNAUTHORIZED
            );
        }
        $authenticated_user = UserRepository::findUserByEmail($google_credentials['email']);
        if (!$authenticated_user) {
            User::create([
                'name' => $google_credentials['name'],
                'email' => $google_credentials['email'],
            ]);
            $authenticated_user = UserRepository::findUserByEmail($google_credentials['email']);
            $access_token = UserRepository::createToken($authenticated_user);
            return $this->sendResult(
                'Successful login',
                compact('access_token'),
                Response::HTTP_OK
            );
        }

        $access_token = UserRepository::createToken($authenticated_user);
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
