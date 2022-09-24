<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolClasses;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\User;
use App\Services\SetupService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    protected $setupService;
    protected $userService;

    public function __construct(SetupService $setupService, UserService $userService)
    {
        $this->setupService = $setupService;
        $this->userService = $userService;
    }

    public function ViewGroup()
    {
        $data['allData'] = $this->setupService->getAllStudentGroup();
        return view('backend.setup.group.view-group', $data);
    }

    public function ViewGroupDetails($id_group)
    {
        $data['students'] = $this->setupService->findStudentByGroupId($id_group);
        return view('backend.setup.group.view-detail',$data);
    }

    public function StudentGroupAdd()
    {
        $data['subjects'] = $this->setupService->getAllSubjects();
        $data['teachers'] = $this->userService->findUserByType('Teacher');
        $data['classes'] = $this->setupService->getAllStudentClasses();
        $data['rooms'] = $this->setupService->getAllClasses();
        $data['groups'] = $this->setupService->getActiveStudentGroup();
        $data['learning_seances'] = $this->setupService->getAllActiveLearningSeances();
        return view('backend.setup.group.add-group', $data);
    }

    public function StudentGroupStore(Request $request)
    {
        $this->setupService->addStudentGroup($request);

        $notification = array(
            'message' => 'تم إضافة الصف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.view')->with($notification);
    }

    public function StudentGroupEdit($student_group_id)
    {
        $editData['group'] = $this->setupService->findStudentGroupById($student_group_id);
        $editData['subjects'] = $this->setupService->getAllSubjects();
        $editData['teachers'] = $this->userService->findUserByType('Teacher');
        $editData['classes'] = $this->setupService->getAllStudentClasses();
        $editData['rooms'] = $this->setupService->getAllClasses();
        return view('backend.setup.group.edit-group', $editData);
    }

    public function StudentGroupUpdate(Request $request, $id)
    {
        $this->setupService->editStudentGroup($request, $id);

        $notification = array(
            'message' => 'تم تعديل الصف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.view')->with($notification);
    }

    public function StudentGroupDelete($id)
    {
        $this->setupService->deleteStudentGroupById($id);

        $notification = array(
            'message' => 'تم إزالة الصف بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('student.group.view')->with($notification);
    }

    public function StudentGroupUpdateStatus($id_group)
    {
        $group = $this->setupService->updateStatusStudentGroupById($id_group);

        if ($group)
            $notification = array(
                'message' => 'تم تفعيل الصف بنجاح',
                'alert-type' => 'info'
            );

        else
            $notification = array(
                'message' => 'تم تعطيل الصف بنجاح',
                'alert-type' => 'info'
            );

        return redirect()->route('student.group.view')->with($notification);
    }

    public function RemoveStudentFromGroup($group_id,$student_id)
    {
        $this->setupService->removeStudentFromGroup($group_id,$student_id);

        $notification = array(
            'message' => 'تم حذف التلميذ من الصف بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('student.group.view')->with($notification);
    }
}
