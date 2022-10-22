<?php

namespace App\Services;

use App\Models\AccountStudentFee;
use App\Models\AssignStudent;
use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\GroupAttendance;
use App\Models\LigneAccountStudentFee;
use App\Models\SchoolClasses;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentYear;
use Carbon\Carbon;
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
        $year = new StudentYear();
        $year->name = $name;
        $year->active = false;
        $year->save();
    }

    public function editYear($id, $request)
    {
        $data = $this->findYearById($id);
        $data->name = $request->name;
        $data->save();
    }

    public function findYearById($yearId)
    {
        return StudentYear::find($yearId);
    }

    public function findActiveYear()
    {
        return StudentYear::where('active', true)->first();
    }

    public function deleteYearById($id): void
    {
        $year = $this->findYearById($id);
        $year->delete();
    }

    public function updateStatusStudentYearById($year_id)
    {
        $year = $this->findYearById($year_id);
        if (!$year->active) {
            StudentYear::where('id', '!=', $year_id)
                ->update(['active' => false]);
            $year->active = true;
        }
        $year->save();
        return $year->active;
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

    public function findFeeCategoryAMountByClassIdByFeeCategory($class_id, $fee_cat_id)
    {
        return FeeCategoryAmount::where('class_id', $class_id)
            ->where('fee_category_id', $fee_cat_id)
            ->get();
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

    public function getStudentClassesHasStudent()
    {
        $assign_student_id = AssignStudent::whereNotNull('class_id')->get()->unique('class_id')->pluck('class_id');
        return StudentClass::whereIn('id', $assign_student_id)->get();
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

    public function getActiveStudentGroup()
    {
        return StudentGroup::where('active', true)->get();
    }

    public function addStudentGroup(Request $request)
    {
        $student_group_name = $this->createStudentGroupName($request->subject,$request->class);
        $activeYear = $this->findActiveYear();
        DB::transaction(function () use ($request,$student_group_name,$activeYear) {
            $data = new StudentGroup();
            $data->name = $student_group_name;
            $data->subject_id = $request->subject;
            $data->teacher_id = $request->teacher;
            $data->class_id = $request->class;
            $data->year_id = $activeYear->id;
            $data->active = false;
            $data->group_type = $request->group_type;
            $data->alone_date = $request->alone_date_input;
            $data->nb_lessons = 0;
            $data->nb_lesson_cycle = $request->nb_cycle_lesson;
            $data->fee_type_id = $request->fee_type_id;
            $data->fix_salary = $request->fix_salary;
            $data->amount_per_student = $request->amount_per_student;

            if ($request->group_type == 'فردي' && $request->room != null && $request->start_time != null && $request->end_time != null) {
                $data->start_time = $request->start_time[0];
                $data->end_time = $request->end_time[0];
                $data->classes_id = $request->room[0];
            }

            $data->save();

            if ($request->group_type == 'جماعي' && $request->group_date_input != null) {
                for ($i = 0; $i < count($request->group_date_input); $i++) {
                    DB::table('learning_seances')->insertGetId(
                        ['day' => $request->group_date_input[$i], 'start_time' => $request->start_time[$i], 'end_time' => $request->end_time[$i], 'student_group_id' => $data->id, 'room_id' => $request->room[$i], 'year_id' => $activeYear->id]
                    );
                }
            }
        });
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
        $data->nb_lesson_cycle = $request->nb_cycle_lesson;
        $data->fee_type_id = $request->fee_type_id;
        $data->fix_salary = $request->fix_salary;
        $data->amount_per_student = $request->amount_per_student;

        $data->save();
    }

    public function addGroupsToStudent(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {

            foreach (array_unique($request->group_id) as $key => $value) {
                $assignStudent = new AssignStudent();
                $assignStudent->student_id = $student_id;
                $assignStudent->group_id = $value;
                $assignStudent->year_id = $this->findActiveYear()->id;
                $assignStudent->save();

                $last_group_attendance = GroupAttendance::where('group_id', $request->group_id)->get();
                $last_group_attendance = $last_group_attendance->sortByDesc('num_lesson')->first();

                if (empty($last_group_attendance)) $num_lesson = 0;
                else $num_lesson = $last_group_attendance->num_lesson;

                $group = StudentGroup::where('id', $request->group_id)->first();

                $fee_amount_group = FeeCategoryAmount::where('fee_category_id', 2)
                    ->where('class_id', $group->class_id)
                    ->first();
                $fee_amount = $fee_amount_group->amount;
                if ($group->fee_type_id == 2) {
                    $nb_lesson_cycle = $group->nb_lesson_cycle;

                    $account_student_fees = new AccountStudentFee();
                    $account_student_fees->student_id = $student_id;
                    $account_student_fees->group_id = $value;
                    $account_student_fees->fee_category_id = 2;
                    $account_student_fees->amount_to_be_paid = $fee_amount;
                    $account_student_fees->num_lesson_start = $num_lesson + 1;
                    $account_student_fees->num_lesson_end = $num_lesson + 4;
                    $account_student_fees->year_id = $this->findActiveYear()->id;
                    $account_student_fees->save();

                    for ($i = 1; $i <= $nb_lesson_cycle; $i++) {
                        $ligne_account_student_fee = new LigneAccountStudentFee();
                        $ligne_account_student_fee->account_student_id = $account_student_fees->id;
                        $ligne_account_student_fee->amount = $fee_amount / $nb_lesson_cycle;
                        $ligne_account_student_fee->num_lesson = $num_lesson + $i;
                        $ligne_account_student_fee->year_id = $this->findActiveYear()->id;
                        $ligne_account_student_fee->save();
                    }
                } elseif ($group->fee_type_id == 1) {
                    if ($num_lesson == 0) {
                        $account_student_fees = new AccountStudentFee();
                        $account_student_fees->student_id = $student_id;
                        $account_student_fees->group_id = $value;
                        $account_student_fees->fee_category_id = 2;
                        $account_student_fees->amount_to_be_paid = $fee_amount;
                        $account_student_fees->year_id = $this->findActiveYear()->id;
                        $account_student_fees->save();
                    } else {
                        $total_days_in_current_month = date('t', strtotime($last_group_attendance->date));
                        $remaining_days = $total_days_in_current_month - date('d');
                        $account_student_fees = new AccountStudentFee();
                        $account_student_fees->student_id = $student_id;
                        $account_student_fees->group_id = $value;
                        $account_student_fees->fee_category_id = 2;
                        $account_student_fees->amount_to_be_paid = $remaining_days * ($fee_amount / $total_days_in_current_month);
                        $account_student_fees->year_id = $this->findActiveYear()->id;
                        $account_student_fees->save();
                    }
                }
            }
        });
    }

    public function updateStatusStudentGroupById($id_group): bool
    {
        $group = $this->findStudentGroupById($id_group);

        if ($group->active) {
            $group->active = false;
            $group->end_date = Carbon::now()->format('Y-m-d');
        }
        else {
            $group->active = true;
            $group->start_date = Carbon::now()->format('Y-m-d');
            $group->end_date = null;
        }

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
        $last_group_attendance = GroupAttendance::where('group_id', $group_id)->get()->sortByDesc('num_lesson')->first();
        $last_num_lesson = $last_group_attendance->num_lesson;

        // delete account student fees lower than last attendance************************** to complete
        $account_student_fees = AccountStudentFee::where('student_id', $student_id)->where('group_id', $group_id)
            ->where('num_lesson_start', '<=', $last_num_lesson)->where('fee_status', false)->get();


        // delete account student fees upper than last attendance
        AccountStudentFee::where('student_id', $student_id)->where('group_id', $group_id)
            ->where('num_lesson_start', '>', $last_num_lesson)->where('fee_status', false)->delete();

        // delete assignment of the student to the group
        AssignStudent::where('student_id', $student_id)->where('group_id', $group_id)->delete();
    }

    public function deleteStudentGroupById($id): void
    {
        $this->findStudentGroupById($id)->delete();
        DB::table('learning_seances')
            ->where('student_group_id', $id)
            ->delete();
    }

    public function getStudentGroupByActive(bool $active)
    {
        return StudentGroup::where('active', $active)->get();
    }

    public function getFeeCategoryWithoutAmount()
    {
        $fee_category_amount = FeeCategoryAmount::all();
        $fee_category = FeeCategory::all();
        $fee_category = $fee_category->whereNotIn('id', $fee_category_amount->pluck('fee_category_id'));
        return $fee_category;
    }

    public function getAllActiveLearningSeances()
    {
        $groups_id = $this->getActiveStudentGroup()->pluck('id');

        return DB::table('learning_seances')->whereIn('student_group_id', $groups_id)->get();
    }

    public function createStudentGroupName($subject_id, $class_id)
    {
        $nb_group = StudentGroup::where('subject_id',$subject_id)
                                    ->where('class_id',$class_id)->get()->count()+1;
        $subject_name = $this->getSubjectById($subject_id)->name;
        $class_name = $this->getClassById($class_id)->name;

        return $class_name.' '.$subject_name.' '.$nb_group;
    }

    public function getSubjectById($subject_id)
    {
        return SchoolSubject::find($subject_id);
    }

    public function getClassById($class_id)
    {
        return StudentClass::find($class_id);
    }
}
