<?php

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function getItemByEmail(string $email)
    {
        return User::where('email', strtolower($email))->first();
    }

    public function itemUpdate(User $user, array $data)
    {
        $user->fill($data);
        $user->save();
        return $user;
    }
}
