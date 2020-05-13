<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Model\Role;
use App\Http\Controllers\Controller;
use App\Http\Repository\UserRepository;

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

        $authenticated_user = UserRepository::findUserByEmail($google_credentials['email']);
        
        if (!$authenticated_user) {
            return $this->sendError(
                'Unauthenticated user',
                [],
                Response::HTTP_UNAUTHORIZED
            );
        }

        $scopes = json_decode($authenticated_user->role->scopes);
        $tokenResult = $authenticated_user->createToken('User Access Token', $scopes);
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addYears(1);
        $token->save();

        $access_token = $tokenResult->accessToken;
        
        return $this->sendResult(
            'Successful login',
            [
                'access_token'  =>   $access_token,
                'token'         =>   $token
            ],
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
