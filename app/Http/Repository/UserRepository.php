<?php

namespace App\Http\Repository;

use App\Model\Overtime;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;

class UserRepository
{
    public static function paginate()
    {
        $users = User::with('role')->paginate(Config::get('pagination.users'));
        foreach ($users as $user) {
            $user->role_id = $user->role->name;
        }

        return $users;
    }

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

    public static function toggleStatus($id)
    {
        $user = User::find($id);
        $user->active = !$user->active;
        $user->save();

        return $user;
    }

    public static function toggleRole($id)
    {
        $user = User::find($id);
        if ($user->role_id == 2) {
            $user->role_id = 3;
        } elseif ($user->role_id == 3) {
            $user->role_id = 2;
        }
        $user->save();

        return $user;
    }
}
