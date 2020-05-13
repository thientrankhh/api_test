<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $google_response = Http::withToken($request->bearerToken())->get('https://www.googleapis.com/oauth2/v1/userinfo');
        
        $google_credentials = json_decode($google_response, true);


        if ($google_response->failed()) {
            return $this->sendError(
                'Google authentication failed',
                $google_credentials,
                Response::HTTP_UNAUTHORIZED
            );
        }

        $authenticated_user = User::findByEmail($google_credentials['email']);
        
        if (!$authenticated_user) {
            return $this->sendError(
                'Unauthenticated user',
                [],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $tokenResult = $authenticated_user->createToken('User Access Token', ['creator']);
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addYears(1);
        $token->save();

        $access_token = $tokenResult->accessToken;
        
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
            compact('token'),
            Response::HTTP_ACCEPTED
        );
    }
}
