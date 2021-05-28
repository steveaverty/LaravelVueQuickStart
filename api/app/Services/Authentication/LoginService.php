<?php

namespace App\Services\Authentication;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait LoginService
{
    /**
     * Login
     * @param string $email
     * @param string $password
     * @return string|null
     */
    public function login(string $email, string $password): ?String
    {
        $user = User::query()->where('email', $email)->get()->first();

        if($user !== null && Hash::check($password, $user->password)){
            return  $user->createToken('')->accessToken;
        }

        return null;
    }
}


