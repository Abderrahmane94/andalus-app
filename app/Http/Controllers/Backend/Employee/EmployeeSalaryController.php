<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Services\EmployeeService;
use App\Services\SetupService;
use App\Services\UserService;
use Illuminate\Http\Request;

class EmployeeSalaryController extends Controller
{
    protected $employeeService;
    protected $userService;
    protected $setupService;

    public function __construct(UserService $userService, EmployeeService $employeeService, SetupService $setupService)
    {
        $this->userService = $userService;
        $this->employeeService = $employeeService;
        $this->setupService = $setupService;
    }

    public function SalaryView($employee_id) {
    	$data['employee'] = $this->userService->findUserById($employee_id);
        $data['account_employee_salaries'] = $this->employeeService->findAccountSalaryByIdEmployee($employee_id);
    	return view('backend.employee.employee_salary.salary-view',$data);
    }

    public function SalaryAdd($employee_id) {
        $data['employee'] = $this->userService->findUserById($employee_id);
        $data['group_attendances'] = $this->employeeService->getGroupAttendancesByIdEmployee($employee_id,false);
        $data['student_groups'] = $this->employeeService->getStudentGroupsSalaryByIdEmployee($employee_id,$data['group_attendances']);
        $data['principal_amount'] = $this->employeeService->getPrincipalSalaryAmountByEmployeeId($data['student_groups']);
        return view('backend.employee.employee_salary.salary-add',$data);
    }

    public function SalaryStore(Request $request, $employee_id){
        $this->employeeService->addEmployeeSalary($request->description,$request->principal_amount,$request->grant_amount,$employee_id,$request->group_Attendance_id);

        $notification = array(
    		'message' => 'تم إضافة الراتب بنجاح',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('employee.salary.view',$employee_id)->with($notification);
    }
}
