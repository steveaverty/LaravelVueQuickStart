<?php

namespace App\Services\Authentication;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait RegisterService
{
    /**
     * Register
     * @param string $name
     * @param string $email
     * @param string $password
     * @return String
     */
    public function register(string $name, string $email, string $password): String
    {
        $user =  new User(
            [
                'name'     => $name,
                'email'    => $email,
                'password' => Hash::make($password)
            ]
        );

        $user->save();

        return  $user->createToken('')->accessToken;
    }
}
