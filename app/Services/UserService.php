<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Boolean;

class UserService
{
    public function getAllUser()
    {
        return User::all();
    }

    public function addUser($first_name, $last_name, $email, $image, $user_type): void
    {
        $data = new User();
        $data->first_name = $first_name;
        $data->last_name = $last_name;
        $data->username = $last_name.'.'.$first_name;
        $data->email = $email;
        $data->user_type = $user_type;
        $data->password = bcrypt('andalus2022');
        if ($image != null) {
            @unlink(public_path('/img/profiles' . $data->profile_photo_path));
            $filename = date('YmdHi') . $image->getClientOriginalName();
            $image->move(public_path('/img/profiles'), $filename);
            $data['profile_photo_path'] = '/img/profiles/'.$filename;
        }
        $data->save();
    }

    public function findUserById($userId)
    {
        return User::find($userId);
    }

    public function findUserByType($type)
    {
        return User::where('user_type',$type)->get();
    }

    public function findUserByCancelingType($type)
    {
        return User::where('user_type','!=',$type)->get();
    }

    public function editUser($id, $first_name, $last_name,$email, $file, $user_type)
    {
        $data = $this->findUserById($id);
        $data->first_name = $first_name;
        $data->last_name = $last_name;
        $data->email = $email;
        $data->user_type = $user_type;
        if ($file != null) {
            @unlink(public_path('/img/profiles' . $data->profile_photo_path));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/img/profiles'), $filename);
            $data['profile_photo_path'] = '/img/profiles/'.$filename;
        }
        $data->username = $last_name.'.'.$first_name;
        $data->save();
    }

    public function updatePassword($request) : bool {

        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            return true;
        } else {
            return false;
        }
    }
}
