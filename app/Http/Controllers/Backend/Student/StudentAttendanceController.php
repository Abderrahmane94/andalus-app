<?php
namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\GroupAttendance;
use App\Models\SchoolClasses;
use App\Models\StudentAttendance;
use App\Models\StudentGroup;
use App\Models\User;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{

    public function AttendanceStudentView(){
//        $data['allData'] = EmployeeAttendance::select('date')->groupBy('date')->orderBy('id','DESC')->get();
        $data['studentsAttendances'] = StudentAttendance::all();
        $data['groups'] = StudentGroup::all();
        $data['groupsAttendances'] = GroupAttendance::all();

        return view('backend.student.student_attendance.student-attendance-view',$data);
    }


    public function AttendanceStudentAdd(Request $request){
        $data['students'] = AssignStudent::where('group_id', $request->group_id)
            ->leftJoin('users', 'assign_students.student_id', '=', 'users.id')
            ->select('users.id','users.last_name','users.first_name')->get();
        $data['group'] = StudentGroup::where('id',$request->group_id)->first();
        $data['teachers'] = User::all()->except($data['group']->teacher_id);
        $data['rooms'] = SchoolClasses::all()->except($data['group']->classes_id);
        return view('backend.student.student_attendance.student-attendance-add',$data);

    }


    public function AttendanceStudentStore(Request $request){

/*        StudentAttendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();*/

        $attend_group = new GroupAttendance();
        $attend_group->group_id = $request->group_id;
        $attend_group->teacher_id = $request->teacher_id;
        $attend_group->classes_id = $request->classes_id;
        $attend_group->date = date('Y-m-d',strtotime($request->date));
        $attend_group->save();

        $countstudents = count($request->student_id);
        for ($i=0; $i <$countstudents ; $i++) {
            $attend_status = 'attend_status'.$i;
            $attend = new StudentAttendance();
            $attend->student_id = $request->student_id[$i];
            $attend->attendance_status = $request->$attend_status;
            $attend->attendance_group_id = $attend_group->id;
            $attend->save();
        } // end For Loop

        $notification = array(
            'message' => 'تم إضافة كشف الحضور بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.attendance.view')->with($notification);

    } // end Method



    public function AttendanceStudentEdit($date){
        $data['editData'] = StudentAttendance::where('date',$date)->get();
        $data['employees'] = User::where('usertype','employee')->get();
        return view('backend.employee.employee_attendance.employee_attendance_edit',$data);
    }


    public function AttendanceStudentDetails($date,$group_id){
        $data['groupAttendances'] = GroupAttendance::where('date',$date)->where('group_id',$group_id)->first();
        $data['studentAttendances'] = StudentAttendance::where('attendance_group_id',$data['groupAttendances']->id)->get();
        $data['group'] = StudentGroup::where('id',$group_id)->get();
        return view('backend.student.student_attendance.student-attendance-details',$data);

    }






}
