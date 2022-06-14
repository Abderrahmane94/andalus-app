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

        $this->userService->addUser($request->first_name, $request->last_name, $request->email, $request->image, $request->user_type);

        $notification = array(
            'message' => 'تم إضافة المستخدم بنجاح',
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
        $this->userService->editUser($id, $request->first_name, $request->last_name, $request->email, $request->file('image'));

        $notification = array(
            'message' => 'تم تعديل المستخدم بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('users.view')->with($notification);

    }


    public function UserDelete($id)
    {
        $user = $this->userService->findUserById($id);
        $user->delete();

        $notification = array(
            'message' => 'تم حذف المستخدم بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('users.view')->with($notification);

    }

}
