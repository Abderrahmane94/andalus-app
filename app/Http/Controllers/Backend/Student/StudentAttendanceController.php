<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AccountStudentFee;
use App\Models\AssignStudent;
use App\Models\GroupAttendance;
use App\Models\SchoolClasses;
use App\Models\StudentAttendance;
use App\Models\StudentGroup;
use App\Models\User;
use App\Services\SetupService;
use App\Services\StudentService;
use App\Services\UserService;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    protected $setupService;
    protected $userService;
    protected $studentService;

    public function __construct(SetupService $setupService, UserService $userService, StudentService $studentService)
    {
        $this->setupService = $setupService;
        $this->userService = $userService;
        $this->studentService = $studentService;
    }

    public function AttendanceStudentView()
    {
        $data['studentsAttendances'] = $this->studentService->getStudentAttendances();
        $data['groups']              = $this->setupService->getStudentGroupByActive(true);
        $data['groupsAttendances']   = $this->studentService->getGroupAttendances();

        return view('backend.student.student_attendance.student-attendance-view', $data);
    }

    public function AttendanceStudentAdd(Request $request)
    {
        $data['students'] = AssignStudent::where('group_id', $request->group_id)
            ->leftJoin('users', 'assign_students.student_id', '=', 'users.id')
            ->select('users.id', 'users.last_name', 'users.first_name')->get();
        $data['group'] = StudentGroup::where('id', $request->group_id)->first();
        $data['teachers'] = User::all()->except($data['group']->teacher_id);
        $data['rooms'] = SchoolClasses::all()->except($data['group']->classes_id);
        return view('backend.student.student_attendance.student-attendance-add', $data);
    }

    public function AttendanceStudentStore(Request $request, $group_id)
    {
        $this->studentService->addStudentAttendance($request,$group_id);

        $notification = array(
            'message' => 'تم إضافة كشف الحضور بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.attendance.view')->with($notification);
    }

    public function AttendanceStudentEdit($group_attendance_id)
    {
        $data['student_attendances'] = StudentAttendance::where('attendance_group_id', $group_attendance_id)->with(['student'])->get();
        $data['group_attendance'] = GroupAttendance::find($group_attendance_id);
        $data['teachers'] = User::all();
        $data['rooms'] = SchoolClasses::all();
        return view('backend.student.student_attendance.student-attendance-edit', $data);
    }

    public function AttendanceStudentUpdate(Request $request, $group_attendance_id)
    {
        $attend_group = GroupAttendance::find($group_attendance_id);
        $attend_group->teacher_id = $request->teacher_id;
        $attend_group->classes_id = $request->classes_id;
        $attend_group->date = date('Y-m-d', strtotime($request->date));
        $attend_group->save();

        StudentAttendance::where('attendance_group_id', $group_attendance_id)->delete();

        $countstudents = count($request->student_id);
        for ($i = 0; $i < $countstudents; $i++) {
            $attend_status = 'attend_status' . $i;
            $attend = new StudentAttendance();
            $attend->student_id = $request->student_id[$i];
            $attend->attendance_status = $request->$attend_status;
            $attend->attendance_group_id = $attend_group->id;
            $attend->save();
        } // end For Loop

        $notification = array(
            'message' => 'تم تعديل كشف الحضور بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.attendance.view')->with($notification);
    }

    public function AttendanceStudentDetails($date, $group_id)
    {
        $data['groupAttendances'] = GroupAttendance::where('date', $date)->where('group_id', $group_id)->first();
        $data['studentAttendances'] = StudentAttendance::where('attendance_group_id', $data['groupAttendances']->id)->get();
        $data['group'] = StudentGroup::where('id', $group_id)->get();
        return view('backend.student.student_attendance.student-attendance-details', $data);
    }
}
