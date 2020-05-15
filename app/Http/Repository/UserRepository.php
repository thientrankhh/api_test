<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Model\Overtime;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class UserRepository
{
    public static function getOvertime($id)
    {
        return Overtime::find($id);
    }

    public static function checkEmailCompany(string $email)
    {
        if (strpos($email, '@dienhoa1080.com') == false) {
            return false;
        } else {
            return true;
        }
    }

    public static function findUserByEmail(string $email)
    {
        $user = User::where('email', $email)->first();
        if ($user) {
            return $user;
        }
        return false;
    }

    public static function getAllNames()
    {
        return User::select('id', 'name')->get();
    }

    public static function abc($authenticated_user)
    {
        $scopes = json_decode($authenticated_user->role->scopes);
        $tokenResult = $authenticated_user->createToken('User Access Token', $scopes);
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addYears(1);
        $token->save();

        $access_token = $tokenResult->accessToken;
    }
}
