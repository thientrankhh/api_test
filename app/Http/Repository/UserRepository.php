<?php

namespace App\Http\Repository;

use App\Model\Overtime;
use App\User;

class UserRepository
{
    public static function getOvertime($id)
    {
        return Overtime::find($id);
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
}
