<?php

namespace App\Services;

use App\Models\AccountStudentFee;
use App\Models\AssignStudent;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\GroupAttendance;
use App\Models\SchoolClasses;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentYear;
use Illuminate\Http\Request;
use DB;


class SetupService
{

    /*----- Student Year -----*/
    public function getAllYears()
    {
        return StudentYear::all();
    }

    public function addYear($name)
    {
        $data = new StudentYear();
        $data->name = $name;
        $data->save();
    }

    public function editYear($id, $request)
    {
        $data = $this->findYearById($id);
        $data->name = $request->name;
        if ($request->has('active')) {
            StudentYear::where('id', '!=', $id)
                ->update(['active' => false]);
            $data->active = true;
        }
        /*else $data->active = false;*/

        $data->save();
    }

    public function findYearById($yearId)
    {
        return StudentYear::find($yearId);
    }

    public static function findActiveYear()
    {
        return StudentYear::where('active', true)->first();
    }

    public function deleteYearById($id): void
    {
        $year = $this->findYearById($id);
        $year->delete();
    }

    /*----- School Subject -----*/

    public function getAllSubjects()
    {
        return SchoolSubject::all();
    }

    public function addSubject($name)
    {
        $data = new SchoolSubject();
        $data->name = $name;
        $data->save();
    }

    public function editSubject($id, $name)
    {
        $data = $this->findSubjectById($id);
        $data->name = $name;
        $data->save();
    }

    public function findSubjectById($subjectId)
    {
        return SchoolSubject::find($subjectId);
    }

    public function deleteSubjectById($id): void
    {
        $user = $this->findSubjectById($id);
        $user->delete();
    }

    /*----- School Classes -----*/

    public function getAllClasses()
    {
        return SchoolClasses::all();
    }

    public function addClasses($name, $nb_student, $surface)
    {
        $data = new SchoolClasses();
        $data->name = $name;
        $data->nb_students = $nb_student;
        $data->surface = $surface;
        $data->save();
    }

    public function editClasses($id, $name, $nb_student, $surface)
    {
        $data = $this->findClassesById($id);
        $data->name = $name;
        $data->nb_students = $nb_student;
        $data->surface = $surface;
        $data->save();
    }

    public function findClassesById($id)
    {
        return SchoolClasses::find($id);
    }

    public function deleteClassesById($id): void
    {
        $classe = $this->findClassesById($id);
        $classe->delete();
    }

    /*----- Fee Category -----*/

    public function getAllFeeCategory()
    {
        return FeeCategory::all();
    }

    public function addFeeCategory($name)
    {
        $data = new FeeCategory();
        $data->name = $name;
        $data->save();
    }

    public function editFeeCategory($id, $name)
    {
        $data = $this->findFeeCategoryById($id);
        $data->name = $name;
        $data->save();
    }

    public function findFeeCategoryById($id)
    {
        return FeeCategory::find($id);
    }

    public function deleteFeeCategoryById($id): void
    {
        FeeCategoryAmount::where('fee_category_id', $id)->delete();
        $this->findFeeCategoryById($id)->delete();
    }

    /*----- Fee Category Amount -----*/

    public function getAllFeeAmountByCategory()
    {
        return FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
    }

    public function findFeeCategoryAmountByFeeCategory($fee_cat_id)
    {
        return FeeCategoryAmount::where('fee_category_id', $fee_cat_id)->orderBy('class_id', 'asc')->get();
    }

    public function addFeeAmount(Request $request)
    {
        $countClass = count($request->class_id);

        if ($countClass != NULL) {
            for ($i = 0; $i < $countClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();

            } // End For Loop
        }// End If Condition
    }

    public function editFeeAmount(Request $request, $fee_category_id)
    {
        $countClass = count($request->class_id);
        FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();
        for ($i = 0; $i < $countClass; $i++) {
            $fee_amount = new FeeCategoryAmount();
            $fee_amount->fee_category_id = $request->fee_category_id;
            $fee_amount->class_id = $request->class_id[$i];
            $fee_amount->amount = $request->amount[$i];
            $fee_amount->save();

        } // End For Loop
    }

    /*----- Student class -----*/

    public function getAllStudentClasses()
    {
        return StudentClass::all();
    }

    public function addStudentClass($name, $level): void
    {
        $data = new StudentClass();
        $data->name = $name;
        $data->level = $level;
        $data->save();
    }

    public function getStudentClassById($id)
    {
        return StudentClass::find($id);
    }

    public function editStudentClass($id, $name, $level): void
    {
        $data = $this->getStudentClassById($id);
        $data->name = $name;
        $data->level = $level;
        $data->save();
    }

    public function deleteStudentClassById($id): void
    {
        $user = $this->getStudentClassById($id);
        $user->delete();
    }

    /*----- Student Group -----*/

    public function getAllStudentGroup()
    {
        return StudentGroup::all();
    }

    public function addStudentGroup(Request $request)
    {
        $data = new StudentGroup();
        $data->name = $request->name;
        $data->subject_id = $request->subject;
        $data->teacher_id = $request->teacher;
        $data->classes_id = $request->room;
        $data->class_id = $request->class;
        $data->group_type = $request->group_type;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->day = $request->day;
        $data->nb_lessons = 0;
        $data->fee_type_id = $request->fee_type_id;

        $data->save();
    }

    public function findStudentGroupById($id)
    {
        return StudentGroup::find($id);
    }

    public function editStudentGroup(Request $request, $id)
    {
        $data = $this->findStudentGroupById($id);
        $data->name = $request->name;
        $data->subject_id = $request->subject;
        $data->teacher_id = $request->teacher;
        $data->classes_id = $request->room;
        $data->class_id = $request->class;
        $data->group_type = $request->group_type;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->day = $request->day;
        $data->nb_lessons = 0;
        $data->fee_type_id = $request->fee_type_id;

        $data->save();
    }

    public function addGroupsToStudent(Request $request, $student_id)
    {
        DB::transaction(function () use ($request,$student_id) {

            foreach (array_unique($request->group_id) as $key => $value) {
                $assignStudent = new AssignStudent();
                $assignStudent->student_id = $student_id;
                $assignStudent->group_id = $value;
                $assignStudent->save();

                $last_group_attendance = GroupAttendance::where('group_id',$request->group_id)->get();
                $last_group_attendance = $last_group_attendance->sortByDesc('num_lesson')->first();

                $group = StudentGroup::find($request->group_id);
                $fee_amount_group = FeeCategoryAmount::where('fee_category_id', 2)
                    ->where('class_id', $group->pluck('class_id'))
                    ->first();
                $fee_amount = $fee_amount_group->amount;

                //dd($last_group_attendance);
                if (!empty($last_group_attendance)) {
                    $num_last_lesson = $last_group_attendance->num_lesson;
                    $account_student_fees = new AccountStudentFee();
                    $account_student_fees->student_id = $student_id;
                    $account_student_fees->group_id = $value;
                    $account_student_fees->fee_category_id = 2;
                    /// amount = (fee_amount / 4) x (4- (nb_lesson mod(4))
                    $account_student_fees->amount_to_be_paid = ($fee_amount / 4) * (4 - ($num_last_lesson % 4));
                    $account_student_fees->num_lesson_start = $num_last_lesson + 1;
                    $account_student_fees->num_lesson_end = $num_last_lesson + 4;
                    $account_student_fees->save();
                } else {
                    $account_student_fees = new AccountStudentFee();
                    $account_student_fees->student_id = $student_id;
                    $account_student_fees->group_id = $value;
                    $account_student_fees->fee_category_id = 2;
                    $account_student_fees->amount_to_be_paid = $fee_amount;
                    $account_student_fees->num_lesson_start = 1;
                    $account_student_fees->num_lesson_end = 4;
                    $account_student_fees->save();
                }
            }
        });
    }

    public function updateStatusStudentGroupById($id_group): bool
    {
        $group = $this->findStudentGroupById($id_group);

        if ($group->active) $group->active = false;
        else $group->active = true;

        $group->save();

        return $group->active;
    }

    public function findStudentByGroupId($group_id)
    {
        $students = DB::table('users')
            ->where('status', '=', true)
            ->join('assign_students', function ($join) use ($group_id) {
                $join->on('users.id', '=', 'assign_students.student_id')
                    ->where('assign_students.group_id', '=', $group_id);
            })
            ->get();

        return $students;
    }

    public function removeStudentFromGroup($group_id, $student_id)
    {
        AssignStudent::where('group_id', $group_id)
            ->where('student_id', $student_id)->delete();
    }

    public function deleteStudentFromGroup($student_id, $group_id)
    {
        $last_group_attendance = GroupAttendance::where('group_id',$group_id)->get()->sortByDesc('num_lesson')->first();
        $last_num_lesson = $last_group_attendance->num_lesson;

        // delete account student fees lower than last attendance************************** to complete
        $account_student_fees  = AccountStudentFee::where('student_id',$student_id)->where('group_id',$group_id)
            ->where('num_lesson_start','<=',$last_num_lesson)->where('fee_status',false)->get();




        // delete account student fees upper than last attendance
        AccountStudentFee::where('student_id',$student_id)->where('group_id',$group_id)
            ->where('num_lesson_start','>',$last_num_lesson)->where('fee_status',false)->delete();

        // delete assignment of the student to the group
        AssignStudent::where('student_id',$student_id)->where('group_id',$group_id)->delete();


    }

    public function deleteStudentGroupById($id): void
    {
        $group = $this->findStudentGroupById($id);
        $group->delete();
    }

    public function getStudentGroupByActive(bool $active)
    {
        return StudentGroup::where('active', $active)->get();
    }

}
