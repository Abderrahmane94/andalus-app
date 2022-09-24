<?php

namespace App\Services;

use App\Models\AccountEmployeeSalary;
use App\Models\GroupAttendance;
use App\Models\User;
use Carbon\Carbon;
use DB;
use PDF;
use Illuminate\Http\Request;

class EmployeeService
{
    protected $userService;
    protected $setupService;

    public function __construct(UserService $userService, SetupService $setupService)
    {
        $this->userService = $userService;
        $this->setupService = $setupService;
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
                $user['profile_photo_path'] = 'upload/student_images/' . $filename;

            }
            if ($request->filled('image_captured')) {
                $folderPath = "upload/student_images/";
                $base64Image = explode(";base64,", $request->image_captured);
                $explodeImage = explode("image/", $base64Image[0]);
                $imageType = $explodeImage[1];
                $image_base64 = base64_decode($base64Image[1]);
                $file = $folderPath . $final_id_no . '. ' . $imageType;
                file_put_contents($file, $image_base64);
                $user['image'] = $final_id_no . '. ' . $imageType;
                $user['profile_photo_path'] = $file;
            }
            $user->save();


        });
    }

    public function addEmployeeSalary($description, $principal_amount, $grant_amount, $employee_id, $group_attendance_id)
    {
        $account_employee_salary_id = $this->addAccountEmployeeSalary($description, $principal_amount, $grant_amount, $employee_id);

        $group_attendances = GroupAttendance::wherein('id',$group_attendance_id)->get();
        foreach ($group_attendances as $group_attendance) {
            $group_attendance->isSalary = true;
            $group_attendance->account_employee_salary_id = $account_employee_salary_id;
            $group_attendance->save();
        }

    }

    public function addAccountEmployeeSalary($description, $principal_amount, $grant_amount, $employee_id)
    {
        $salaryData = new AccountEmployeeSalary();
        $salaryData->description = $description;
        $salaryData->employee_id = $employee_id;
        $salaryData->principal_amount = $principal_amount;
        $salaryData->grant_amount = $grant_amount;
        $salaryData->date = Carbon::now();
        $salaryData->save();

        return $salaryData->id;
    }

    public function employeeDetailsPDF($id)
    {
        $data['details'] = $this->userService->findUserById($id);
        $pdf = PDF::loadView('backend.employee.employee_reg.employee_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');
    }

    public function deleteEmployeeById($employee_id)
    {
        User::destroy($employee_id);
    }

    public function findAccountSalaryByIdEmployee($employee_id)
    {
        return AccountEmployeeSalary::where('employee_id', $employee_id)->get();
    }

    public function getGroupAttendancesByIdEmployee($employee_id, bool $isSalary)
    {
        return GroupAttendance::where('teacher_id', $employee_id)
            ->where('isPaid', true)
            ->where('isSalary', $isSalary)
            ->get();
    }

    public function getPrincipalSalaryAmountByEmployeeId($student_groups)
    {
        $amount = 0;
        foreach ($student_groups->values() as $student_group) {
            $amount = $amount + $student_group->get('amount');
            if ($student_group->get('fix_salary') != 0) $amount = $amount + $student_group->get('fix_salary');
        }
        return $amount;
    }

    public function getStudentGroupsSalaryByIdEmployee($employee_id,$group_Attendances)
    {
        $student_groups = collect();
        foreach ($group_Attendances as $group_Attendance) {
            // update student group collection
            if ($student_groups->has($group_Attendance->group_id)) {
                $new_student_group = $student_groups->get($group_Attendance->group_id);
                $amount = $this->calculateAmountSalaryByGroupAttendance($group_Attendance->id, $employee_id);
                $first_date = $student_groups->get($group_Attendance->group_id)->get('first_date');
                $last_date = $student_groups->get($group_Attendance->group_id)->get('last_date');
                if ($group_Attendance->date < $first_date) $first_date = $group_Attendance->date;
                if ($group_Attendance->date > $last_date) $last_date = $group_Attendance->date;
                if ($group_Attendance->teacher_id == $group_Attendance->group->teacher_id
                    && $group_Attendance->group->feeType->name == 'شهري') $fix_salary = $group_Attendance->group->fix_salary;
                else $fix_salary = 0;
                $student_groups->put($group_Attendance->group_id, collect([
                    'group_name' => $group_Attendance->group->name,
                    'nb_student' => $new_student_group->get('nb_student') + $group_Attendance->nb_student,
                    'seances' => $new_student_group->get('seances')->push($group_Attendance->num_lesson),
                    'amount' => $new_student_group->get('amount') + $amount,
                    'fix_salary' => $fix_salary,
                    'fee_type' => $group_Attendance->group->feeType->name,
                    'first_date' => $first_date,
                    'last_date' => $last_date,
                    'group_attendances_id' => $new_student_group->get('group_attendances_id')->push($group_Attendance->id)]));
            } // create new student group collection
            else {
                $amount = $this->calculateAmountSalaryByGroupAttendance($group_Attendance->id, $employee_id);
                if ($group_Attendance->teacher_id == $group_Attendance->group->teacher_id
                    && $group_Attendance->group->feeType->name == 'شهري') $fix_salary = $group_Attendance->group->fix_salary;
                else $fix_salary = 0;
                $student_groups->put($group_Attendance->group_id, collect(['group_name' => $group_Attendance->group->name,
                    'nb_student' => $group_Attendance->nb_student,
                    'seances' => collect($group_Attendance->num_lesson),
                    'amount' => $amount,
                    'fix_salary' => $fix_salary,
                    'fee_type' => $group_Attendance->group->feeType->name,
                    'first_date' => $group_Attendance->date,
                    'last_date' => $group_Attendance->date,
                    'group_attendances_id' => collect($group_Attendance->id)]));
            }
        }
        return $student_groups;
    }

    public function calculateAmountSalaryByGroupAttendance($group_Attendance_id, $employee_id)
    {
        $employee = User::find($employee_id);
        $group_Attendance = GroupAttendance::find($group_Attendance_id);

        /// salary per seance
        if ($group_Attendance->group->feeType->name == 'عدد الحصص') {
            return ((($group_Attendance->amount / $group_Attendance->group->nb_lesson_cycle) * $group_Attendance->nb_student) * ($employee->profit_rate / 100));
        } /// salary per month
        else return $group_Attendance->group->amount_per_student * $group_Attendance->nb_student;
    }
}
