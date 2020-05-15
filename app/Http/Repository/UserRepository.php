<?php

namespace App\Http\Repository;

use App\Model\Overtime;
use App\User;
use Illuminate\Support\Carbon;

class UserRepository
{
    public static function getOvertime($id)
    {
        return Overtime::find($id);
    }

    public static function findUserByEmail(string $email)
    {
        $user = User::where('status', 1)->where('email', $email)->first();
        if ($user) {
            return $user;
        }
        return false;
    }

    public static function getAllNames()
    {
        return User::where('status', 1)->select('id', 'name')->get();
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
}
