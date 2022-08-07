<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use DB;
use PDF;
use Illuminate\Http\Request;

class EmployeeService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function addEmployee(Request $request)
    {
        DB::transaction(function () use ($request) {
            $checkYear = Carbon::now();
            $employee = User::where('user_type', 'Employee')->orderBy('id', 'DESC')->first();

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
                $employee = User::where('user_type', 'Employee')->orderBy('id', 'DESC')->first()->id;
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
            $user->user_type = 'Employee';
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
    }

    public function employeeDetailsPDF($id)
    {
        $data['details'] = $this->userService->findUserById($id);
        $pdf = PDF::loadView('backend.employee.employee_reg.employee_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }
}
