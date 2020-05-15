<?php

namespace App\Http\Repository;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Model\Overtime;
use App\User;
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
        $user = User::where('active', 1)->where('email', $email)->first();
        if ($user) {
            return $user;
        }
        return false;
    }

    public static function getAllNames()
    {
        return User::where('active', 1)->select('id', 'name')->get();
    }

    public static function createToken(User $user)
    {
        $scopes = json_decode($user->role->scopes);
        $tokenResult = $user->createToken('User Access Token', $scopes);
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addYears(1);
        $token->save();
        return $tokenResult->accessToken;
    }

    public static function toggleStatus(User $user)
    {
        $user->active = !$user->active;
        $user->save();
    }

    public static function toggleRole(User $user)
    {
        if ($user->role_id == 2) {
            $user->role_id = 3;
        } elseif ($user->role_id == 3) {
            $user->role_id = 2;
        }
        $user->save();
    }
}
