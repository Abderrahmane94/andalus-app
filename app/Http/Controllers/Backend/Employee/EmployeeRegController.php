<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;

use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB;
use PDF;

use App\Models\Designation;
use App\Models\EmployeeSallaryLog;

class EmployeeRegController extends Controller
{

    public function EmployeeView()
    {

        $data['allData'] = User::where('usertype', 'Employee')->get();
        return view('backend.employee.employee_registration.employee-view', $data);
    }


    public function EmployeeAdd()
    {
        return view('backend.employee.employee_registration.employee-add');
    }


    public function EmployeeStore(Request $request)
    {
        DB::transaction(function () use ($request) {
            $checkYear = Carbon::now();
            $employee = User::where('usertype', 'Employee')->orderBy('id', 'DESC')->first();

            if ($employee == null) {
                $firstReg = 0;
                $employeeId = $firstReg + 1;
                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } elseif ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } elseif ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }
            } else {
                $employee = User::where('usertype', 'Employee')->orderBy('id', 'DESC')->first()->id;
                $employeeId = $employee + 1;
                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } elseif ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } elseif ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }

            } // end else

            $final_id_no = $checkYear->year . $id_no;
            $user = new User();
            $user->id_no = $final_id_no;
            $user->password = bcrypt('password');
            $user->usertype = 'Employee';
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
            $user->save();


        });


        $notification = array(
            'message' => 'تم إضافة العامل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.registration.view')->with($notification);

    } // END Method


    public function EmployeeEdit($id)
    {
        $data['editData'] = User::find($id);
        return view('backend.employee.employee_registration.employee-edit', $data);

    }


    public function EmployeeUpdate(Request $request, $id)
    {

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->gender = $request->gender;

        $user->dob = date('Y-m-d', strtotime($request->dob));


        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/employee_images/' . $user->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/employee_images'), $filename);
            $user['image'] = $filename;
        }
        $user->save();


        $notification = array(
            'message' => 'تم تعديل العامل بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('employee.registration.view')->with($notification);


    }// END METHOD


    public function EmployeeDetails($id)
    {
        $data['details'] = User::find($id);

        $pdf = PDF::loadView('backend.employee.employee_reg.employee_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

    }


}
