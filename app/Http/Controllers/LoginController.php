<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $google_response = Http::withHeaders([
            'Authorization' => $request->accessToken
        ])->get('https://www.googleapis.com/oauth2/v1/userinfo');
        $credentials = json_decode($google_response, true);
        
        if (Arr::has($credentials, 'error')) {
            return $this->sendError('Google authentication failed', $credentials, 401);
        }

        $user = User::where('email', $credentials['email'])->first();
        
        if ($user) {
            $token = $user->createToken('OverTime', ['creator'])->accessToken;

            return $this->sendResult('Login successful', compact('token'), Response::HTTP_OK);
        } else {
            return $this->sendError('Unauthenticated user', [], 401);
        }
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
    }
    
    public function details()
    {
        return $this->sendResult('User details', auth()->user(), 200);
    }
}
