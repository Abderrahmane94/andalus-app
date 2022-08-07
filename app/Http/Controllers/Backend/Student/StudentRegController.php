<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use App\Models\StudentYear;
use App\Models\User;
use App\Services\SetupService;
use App\Services\StudentService;
use App\Services\UserService;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PDF;


class StudentRegController extends Controller
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

    public function StudentRegView()
    {
        $data['years'] = $this->setupService->getAllYears();
        $data['classes'] = $this->setupService->getAllStudentClasses();
        $data['allData'] = $this->studentService->getAssignStudentByGroupId(null);
        $data['allStudent'] = $this->userService->findUserByType('Student');

        return view('backend.student.student_registration.student-view', $data);
    }

    public function StudentClassYearWise(Request $request)
    {
        $data['years'] = $this->setupService->getAllYears();
        $data['classes'] = $this->setupService->getAllStudentClasses();
        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;
        $data['allData'] = $this->studentService->getAssignStudentByYearByClass($request);
        return view('backend.student.student_registration.student-view', $data);
    }

    public function StudentRegGroupsDelete($student_id, $group_id)
    {
        $this->setupService->deleteStudentFromGroup($student_id, $group_id);

        $notification = array(
            'message' => 'تم حذف التلميذ من الصف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.groups.details', $student_id)->with($notification);
    }

    public function StudentRegAdd()
    {
        $data['years'] = $this->setupService->getAllYears();
        $data['classes'] = $this->setupService->getAllStudentClasses();
        $data['subjects'] = $this->setupService->getAllSubjects();
        $data['groups'] = $this->setupService->getAllStudentGroup();
        return view('backend.student.student_registration.student-add', $data);
    }

    public function StudentRegGroupsStore(Request $request, $student_id)
    {
        $this->setupService->addGroupsToStudent($request, $student_id);

        $notification = array(
            'message' => 'تمت العملية بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.groups.details', $student_id)->with($notification);
    }

    public function StudentRegStore(Request $request)
    {
        $this->studentService->addStudent($request);

        $notification = array(
            'message' => 'تم إضافة التلميذ بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);
    }

    public function StudentRegEdit($student_id)
    {
        $data['years'] = $this->setupService->getAllYears();
        $data['classes'] = $this->setupService->getAllStudentClasses();
        $data['subjects'] = $this->setupService->getAllSubjects();
        $data['editData'] = $this->studentService->getAssignStudentByStudentId($student_id)->first();

        return view('backend.student.student_registration.student-edit', $data);
    }

    public function StudentRegUpdate(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {

            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/' . $user->image));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = AssignStudent::where('id', $request->id)->where('student_id', $student_id)->first();

            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id', $request->id)->first();

            $discount_student->discount = $request->discount;
            $discount_student->save();

        });

        $notification = array(
            'message' => 'Student Registration Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);

    }

    public function StudentRegPromotion($student_id) ///////// for delete
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();

        $data['editData'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();

        return view('backend.student.student_reg.student-promotion', $data);
    }

    public function StudentUpdatePromotion(Request $request, $student_id) /////////// for delete
    {
        DB::transaction(function () use ($request, $student_id) {

            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/' . $user->image));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = new AssignStudent();

            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();

            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();

        });


        $notification = array(
            'message' => 'Student Promotion Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);

    } // End Method

    public function StudentRegDetails($student_id)
    {
        $data['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();

        $pdf = PDF::loadView('backend.student.student_reg.student_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

    }

    public function StudentRegGroupsDetails($student_id)
    {
        $data['StudentDetailGroups'] = $this->studentService->getAssignStudentByStudentId($student_id);
        $data['detailGroups'] = $data['StudentDetailGroups']->where('group_id', '!=', null);
        $studentGroup = $data['StudentDetailGroups']->pluck('class_id')->first();
        $studentGroups = $data['StudentDetailGroups']->pluck('group_id');
        $data['detailStudent'] = $data['StudentDetailGroups']->where('group_id', null)->first();
        $data['groups'] = StudentGroup::where('class_id', $studentGroup)->get()->wherenotin('id', $studentGroups);
        $data['studentId'] = $student_id;
        return view('backend.student.student_registration.details-student-groups', $data);
    }

    public function StudentRegDelete($student_id)
    {
        $this->studentService->deleteStudent($student_id);

        $notification = array(
            'message' => 'تم إزالةالتلميذ بنجاح',
            'alert_type' => 'info'
        );

        return redirect()->route('student.registration.view')->with($notification);
    }
}
