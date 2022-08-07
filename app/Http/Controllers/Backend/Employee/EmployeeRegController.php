<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Services\EmployeeService;
use App\Services\UserService;
use Illuminate\Http\Request;

class EmployeeRegController extends Controller
{
    protected $employeeService;
    protected $userService;

    public function __construct(UserService $userService, EmployeeService $employeeService)
    {
        $this->userService = $userService;
        $this->employeeService = $employeeService;
    }

    public function EmployeeView()
    {
        $data['allData'] = $this->userService->findUserByCancelingType('Student');
        return view('backend.employee.employee_registration.employee-view', $data);
    }

    public function EmployeeAdd()
    {
        return view('backend.employee.employee_registration.employee-add');
    }

    public function EmployeeStore(Request $request)
    {
        $this->employeeService->addEmployee($request);

        $notification = array(
            'message' => 'تم إضافة العامل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.registration.view')->with($notification);

    } // END Method

    public function EmployeeEdit($id)
    {
        $data['editData'] = $this->userService->findUserById($id);
        return view('backend.employee.employee_registration.employee-edit', $data);
    }

    public function EmployeeUpdate(Request $request, $id)
    {
        $this->userService->editUser($id, $request->first_name, $request->last_name, $request->email, $request->image, $request->user_type);

        // $user->dob = date('Y-m-d', strtotime($request->dob));

        $notification = array(
            'message' => 'تم تعديل العامل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.registration.view')->with($notification);
    }

    public function EmployeeDetails($id)
    {
        $this->employeeService->employeeDetailsPDF($id);
    }
}
