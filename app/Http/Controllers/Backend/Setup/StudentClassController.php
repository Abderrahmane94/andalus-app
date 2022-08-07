<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Services\SetupService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    protected $setupService;

    public function __construct(SetupService $setupService)
    {
        $this->setupService = $setupService;
    }

    public function ViewStudent()
    {
        $data['allData'] = $this->setupService->getAllStudentClasses();
        return view('backend.setup.student_class.view-class', $data);
    }

    public function StudentClassAdd()
    {
        return view('backend.setup.student_class.add-class');
    }

    public function StudentClassStore(Request $request)
    {
        $this->setupService->addStudentClass($request->name, $request->level);

        $notification = array(
            'message' => 'تم إضافة الفئة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.class.view')->with($notification);
    }

    public function StudentClassEdit($id)
    {
        $editData = $this->setupService->getStudentClassById($id);

        return view('backend.setup.student_class.edit-class', compact('editData'));
    }

    public function StudentClassUpdate(Request $request, $id)
    {
        $this->setupService->editStudentClass($id, $request->name, $request->level);

        $notification = array(
            'message' => 'تم تعديل فئة التلاميذ بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.class.view')->with($notification);
    }

    public function StudentClassDelete($id)
    {
        $this->setupService->deleteStudentClassById($id);

        $notification = array(
            'message' => 'تم إزالة الفئة بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('student.class.view')->with($notification);
    }
}
