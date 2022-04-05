<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService
{
    public function getAllUser()
    {
        return User::all();
    }

    public function addUser($name, $email, $password): void
    {
        $data = new User();
        $data->username = $name;
        $data->email = $email;
        $data->password = bcrypt($password);
        $data->save();
    }

    public function findUserById($userId)
    {
        return User::find($userId);
    }
}
