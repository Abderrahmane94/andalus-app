<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ProfileController extends Controller
{


    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function ProfileView()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('backend.user.view_profile', compact('user'));
    }


    public function ProfileEdit()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('backend.user.edit_profile', compact('editData'));
    }


    public function ProfileStore(Request $request)
    {

        $this->userService->editUser(Auth::user()->id, $request->first_name, $request->last_name, $request->email, $request->image);

        $notification = array(
            'message' => 'تم تعديل معلوماتك الشخصية بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('profile.view')->with($notification);
    }


    public function PasswordView()
    {
        return view('backend.user.edit_password');
    }


    public function PasswordUpdate(Request $request)
    {
        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $notification = array(
            'message' => 'كلمة المرور الحالية خاطئة',
            'alert-type' => 'error'
        );



        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        } else {
            return redirect()->back()->with($notification);
        }

    }
}
