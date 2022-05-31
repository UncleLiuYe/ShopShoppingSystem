<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function userLogin($username, $password)
    {
        $user = User::where("username", "=", $username)->where("password", "=", $password)->get();
        return $user->count() > 0 ? $user[0] : null;
    }
}
