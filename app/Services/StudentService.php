<?php

namespace App\Services;

use App\Models\AccountStudentFee;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use App\Models\GroupAttendance;
use App\Models\LigneAccountStudentFee;
use App\Models\StudentAttendance;
use App\Models\StudentGroup;
use App\Models\StudentYear;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class StudentService
{
    /*-------------- Student registration ------------------*/

    public function addStudent(Request $request)
    {
        DB::transaction(function () use ($request) {
            // create student account
            $student = $this->createStudent($request);
            /// registration fee
            $this->addStudentFeeAmount($student, 1, $request->class_id, 0);

            /*            // assign student to groups
                        if ($request->group_id != NULL) {
                            $countGroups = count($request->group_id);
                            for ($i = 0; $i < $countGroups; $i++) {
                                $assign_student = new AssignStudent();
                                $assign_student->student_id = $user->id;
                                $assign_student->year_id = $request->year_id;
                                $assign_student->class_id = $request->class_id;
                                $assign_student->group_id = $request->group_id[$i];
                                $assign_student->save();
                            } // End For Loop
                        }// End If Condition*/

            /* $discount_student = new DiscountStudent();
             $discount_student->assign_student_id = $assign_student->id;
             $discount_student->fee_category_id = '1';
             $discount_student->discount = $request->discount;
             $discount_student->save();*/

        });
    }

    public function deleteStudent($student_id)
    {
        User::find($student_id)->delete();
        AccountStudentFee::where('student_id', $student_id)->delete();
        AssignStudent::where('student_id', $student_id)->delete();
    }

    public function generateStudentCode($year_id): string
    {
        $checkYear = StudentYear::find($year_id)->name;
        $student = User::where('user_type', 'Student')->orderBy('id', 'DESC')->first();
        // create student code
        if ($student == null) {
            $firstReg = 0;
            $studentId = $firstReg + 1;
            if ($studentId < 10) {
                $id_no = '000' . $studentId;
            } elseif ($studentId < 100) {
                $id_no = '00' . $studentId;
            } elseif ($studentId < 1000) {
                $id_no = '0' . $studentId;
            }
        } else {
            $student = User::where('user_type', 'Student')->orderBy('id', 'DESC')->first()->id;
            $studentId = $student + 1;
            if ($studentId < 10) {
                $id_no = '000' . $studentId;
            } elseif ($studentId < 100) {
                $id_no = '00' . $studentId;
            } elseif ($studentId < 1000) {
                $id_no = '0' . $studentId;
            }

        }
        return $checkYear . "/" . $id_no;
    }

    public function createStudent(Request $request): User
    {
        // generate student code
        $final_id_no = $this->generateStudentCode($request->year_id);
        // create account
        $student = new User();
        $student->id_no = $final_id_no;
        $student->password = bcrypt('password');
        $student->user_type = 'Student';
        $student->username = $request->last_name . '.' . $request->first_name;
        $student->last_name = $request->last_name;
        $student->first_name = $request->first_name;
        $student->mother_name = $request->mother_name;
        $student->father_name = $request->father_name;
        $student->mobile = $request->mobile;
        $student->address = $request->address;
        $student->gender = $request->gender;
        $student->dob = date('Y-m-d', strtotime($request->dob));
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/student_images'), $filename);
            $user['image'] = $filename;
        }
        $student->save();

        // assign student to a class
        $this->assignStudentToAClass($student, $request);

        return $student;
    }

    /*-------------- Assign Student ------------------*/

    public function getAssignStudentByGroupId($Group_id)
    {
        return AssignStudent::where('group_id', '=', $Group_id)->get();
    }

    public function assignStudentToAClass(User $student, Request $request): void
    {
        $assign_student = new AssignStudent();
        $assign_student->student_id = $student->id;
        $assign_student->year_id = $request->year_id;
        $assign_student->class_id = $request->class_id;
        $assign_student->save();
    }

    public function getAssignStudentByYearByClass(Request $request)
    {
        return AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
    }

    public function getAssignStudentByStudentId($student_id)
    {
        return AssignStudent::with(['student'])->where('student_id', $student_id)->get();
    }

    /*-------------- Student Attendances ----------- */

    public function addStudentAttendance(Request $request)
    {
        $student_group = StudentGroup::find($request->group_id);

        //// add new group Attendance
        $attend_group = new GroupAttendance();
        $attend_group->group_id = $request->group_id;
        $attend_group->teacher_id = $request->teacher_id;
        $attend_group->classes_id = $request->classes_id;
        $attend_group->date = date('Y-m-d', strtotime($request->date));
        if ($student_group->nb_lessons == 0) {
            $attend_group->num_lesson = 1;
        } else {
            $attend_group->num_lesson = $student_group->nb_lessons + 1;
        }
        $attend_group->save();

        ///// update student group
        $student_group->nb_lessons = $student_group->nb_lessons + 1;
        $student_group->save();

        $countstudents = count($request->student_id);
        for ($i = 0; $i < $countstudents; $i++) {
            $attend_status = 'attend_status' . $i;
            $attend = new StudentAttendance();
            $attend->student_id = $request->student_id[$i];
            $attend->attendance_status = $request->$attend_status;
            $attend->attendance_group_id = $attend_group->id;
            $attend->save();

            /// account student fee for the next cycle for all students
            if ($student_group->nb_lessons % 4 == 1 && $student_group->nb_lessons != 1) {
                $amount_to_be_paid = FeeCategoryAmount::where('fee_category_id', 2)
                    ->where('class_id', $student_group->class_id)->first();
                $account_student_fee = new AccountStudentFee();
                $account_student_fee->student_id = $request->student_id[$i];
                $account_student_fee->group_id = $request->group_id;
                $account_student_fee->fee_category_id = 2;
                $account_student_fee->amount_to_be_paid = $amount_to_be_paid->amount;
                $account_student_fee->num_lesson_start = $student_group->nb_lessons;
                $account_student_fee->num_lesson_end = $student_group->nb_lessons + 3;
                $account_student_fee->save();
            }
        } // end For Loop
    }

    public function getStudentAttendances()
    {
        return StudentAttendance::all();
    }

    public function getGroupAttendances()
    {
        return GroupAttendance::all();
    }

    /*------------- Student Fee -------------------*/

    public function addStudentFeeAmount(User $student, int $fee_category, int $class_id, int $group_id): void
    {
        $account_reg_student = new AccountStudentFee();
        $account_reg_student->student_id = $student->id;
        $account_reg_student->fee_category_id = $fee_category;
        $amount_to_be_paid = FeeCategoryAmount::where('fee_category_id', $fee_category)
            ->where('class_id', $class_id)->first();
        $account_reg_student->amount_to_be_paid = $amount_to_be_paid->amount;
        $account_reg_student->save();

/*        $ligne_account_reg_student = new LigneAccountStudentFee();
        $ligne_account_reg_student->account_student_id = $account_reg_student->id;
        $ligne_account_reg_student->amount = $account_reg_student->amount_to_be_paid;
        $ligne_account_reg_student->save();*/
    }
}
