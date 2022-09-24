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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class StudentService
{
    /*-------------- Student registration ------------------*/

    public function addStudent(Request $request)
    {
        Log::info('Enter To Add Student Service !');

        DB::transaction(function () use ($request) {
            // create student account
            $student = $this->createStudent($request);

            /// registration fee
            $amount_to_be_paid = FeeCategoryAmount::where('fee_category_id', 1)
                ->where('class_id', $request->class_id)->first();

            $this->addAccountStudentFee($student->id, null, 1, $amount_to_be_paid->amount, null, null, 0, 0, false, false);
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
        return $checkYear . "-" . $id_no;
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
            $student['image'] = $filename;
            $student['profile_photo_path'] = 'upload/student_images/' . $filename;

        }
        if ($request->filled('image_captured')) {
            $folderPath = "upload/student_images/";
            $base64Image = explode(";base64,", $request->image_captured);
            $explodeImage = explode("image/", $base64Image[0]);
            $imageType = $explodeImage[1];
            $image_base64 = base64_decode($base64Image[1]);
            $file = $folderPath . $final_id_no . '. ' . $imageType;
            file_put_contents($file, $image_base64);
            $student['image'] = $final_id_no . '. ' . $imageType;
            $student['profile_photo_path'] = $file;
        }
        $student->save();

        // assign student to a class
        $this->assignStudentToAClass($student, $request->year_id, $request->class_id);

        return $student;
    }

    /*-------------- Assign Student ------------------*/

    public function getAssignStudentByGroupId($Group_id)
    {
        return AssignStudent::where('group_id', $Group_id)->get();
    }

    public function assignStudentToAClass(User $student, $year_id, $class_id): void
    {
        $assign_student = new AssignStudent();
        $assign_student->student_id = $student->id;
        $assign_student->year_id = $year_id;
        $assign_student->class_id = $class_id;
        $assign_student->save();
    }

    public function getAssignStudentByYearByClass($year_id, $class_id)
    {
        return AssignStudent::where('year_id', $year_id)->where('class_id', $class_id)->get();
    }

    public function getAssignStudentByStudentId($student_id)
    {
        return AssignStudent::with(['student'])->where('student_id', $student_id)->get();
    }

    /*-------------- Student Attendances ----------- */

    public function addStudentAttendance(Request $request,$group_id)
    {
        $student_group = StudentGroup::where('id', $group_id)->first();
        $count_students = count($request->student_id);
        $count_present_students = 0;
        $nb_lesson = $student_group->nb_lessons + 1;
        $attendanceCollection = collect();

        // update student group
        $student_group->nb_lessons = $student_group->nb_lessons + 1;
        $student_group->save();

        //// add new group Attendance
        $attend_group = new GroupAttendance();
        $attend_group->group_id = $group_id;
        $attend_group->teacher_id = $request->teacher_id;
        $attend_group->classes_id = $request->classes_id;
        $attend_group->date = date('Y-m-d', strtotime($request->date));
        if ($student_group->nb_lessons == 0) {
            $attend_group->num_lesson = 1;
        } else {
            $attend_group->num_lesson = $student_group->nb_lessons + 1;
        }
        $attend_group->save();

        // add Student Attendances
        for ($i = 0; $i < $count_students; $i++) {
            $attend_status = 'attend_status' . $i;
            $attend = new StudentAttendance();
            $attend->student_id = $request->student_id[$i];
            $attend->attendance_status = $request->$attend_status;
            if ( $request->$attend_status == 'حاضر') $count_present_students++;
            $attend->attendance_group_id = $attend_group->id;
            $attend->save();
            $attendanceCollection->put($attend->student_id, $attend->attendance_status);
        }

        // update nb present student
        $attend_group->nb_student = $count_present_students;
        $attend_group->save();

        /// account student fee
        /// paiement per session
        if ($student_group->fee_type_id == 2) {

            $account_student_fees = AccountStudentFee::where('group_id', $group_id)->get();

            $amount_to_be_paid = FeeCategoryAmount::where('fee_category_id', 2)
                ->where('class_id', $student_group->class_id)->first();

            foreach ($account_student_fees as $account_student_fee) {
                if ($account_student_fee->active) {
                    if ($account_student_fee->num_lesson_end == $nb_lesson) {
                        $num_lesson_start = $nb_lesson + 1;
                        $num_lesson_end = $nb_lesson + $student_group->nb_lesson_cycle;
                        // add new account student fee for the new cycle
                        $this->addAccountStudentFee($account_student_fee->student_id, $account_student_fee->group_id, 2, $amount_to_be_paid->amount, $num_lesson_start, $num_lesson_end, 0, 0, false, false);
                    }
                } else {
                    if ($attendanceCollection->pull($account_student_fee->student_id) == 'حاضر') {
                        $account_student_fee->num_lesson_start = $nb_lesson;
                        $account_student_fee->num_lesson_end = $nb_lesson + $student_group->nb_lesson_cycle - 1;
                        $account_student_fee->active = true;
                        $account_student_fee->save();
                    } else {
                        $account_student_fee->num_lesson_start = $nb_lesson + 1;
                        $account_student_fee->num_lesson_end = $nb_lesson + $student_group->nb_lesson_cycle;
                        $account_student_fee->save();
                    }
                }
            }
        }
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

    public function addAccountStudentFee($student_id, $group_id, $fee_category_id, $amount_to_be_paid, $num_lesson_start, $num_lesson_end, $month, $days_month, $fee_status, $active): void
    {
        $accountStudentFee = new AccountStudentFee();
        $accountStudentFee->student_id = $student_id;
        $accountStudentFee->group_id = $group_id;
        $accountStudentFee->fee_category_id = $fee_category_id;
        $accountStudentFee->amount_to_be_paid = $amount_to_be_paid;
        $accountStudentFee->num_lesson_start = $num_lesson_start;
        $accountStudentFee->num_lesson_end = $num_lesson_end;
        $accountStudentFee->month = $month;
        $accountStudentFee->days_month = $days_month;
        $accountStudentFee->fee_status = $fee_status;
        $accountStudentFee->active = $active;
        $accountStudentFee->save();

        /*        $ligne_account_reg_student = new LigneAccountStudentFee();
                $ligne_account_reg_student->account_student_id = $account_reg_student->id;
                $ligne_account_reg_student->amount = $account_reg_student->amount_to_be_paid;
                $ligne_account_reg_student->save();*/
    }
}
