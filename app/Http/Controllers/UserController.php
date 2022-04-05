<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function UserView()
    {
        $data['allData'] = $this->userService->getAllUser();
        return view('backend.user.list_user', $data);
    }


    public function UserAdd()
    {
        return view('backend.user.add_user');
    }


    public function UserStore(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required',
        ]);


        $this->userService->addUser($request->name,$request->email,$request->password);

        $notification = array(
            'message' => 'User Inserted Successfully',
            'alert-type' => 'success'

        );


        return redirect()->route('users.view')->with($notification);

    }


    public function UserEdit($id)
    {
        $editData = $this->userService->findUserById($id);
        return view('backend.user.edit_user', compact('editData'));

    }


    public function UserUpdate(Request $request, $id)
    {

        $data = $this->userService->findUserById($id);
        $data->name = $request->name;
        $data->email = $request->email;
        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('/img/profiles' . $data->profile_photo_path));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('/img/profiles'), $filename);
            $data['profile_photo_path'] = '/img/profiles/'.$filename;
        }
        $data->save();

        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('users.view')->with($notification);

    }


    public function UserDelete($id)
    {
        $user = $this->userService->findUserById($id);
        $user->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('users.view')->with($notification);

    }

}
