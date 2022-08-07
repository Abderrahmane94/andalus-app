<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Services\SetupService;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
    protected $setupService;

    public function __construct(SetupService $setupService)
    {
        $this->setupService = $setupService;
    }

    public function ViewSubject()
    {
        $data['allData'] = $this->setupService->getAllSubjects();
        return view('backend.setup.school_subject.view-subject', $data);
    }

    public function SubjectAdd()
    {
        return view('backend.setup.school_subject.add-subject');
    }

    public function SubjectStore(Request $request)
    {
        $this->setupService->addSubject($request->name);
        $notification = array(
            'message' => 'تمت إضافة المادة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('school.subject.view')->with($notification);
    }

    public function SubjectEdit($id)
    {
        $editData = $this->setupService->findSubjectById($id);
        return view('backend.setup.school_subject.edit-subject', compact('editData'));
    }

    public function SubjectUpdate(Request $request, $id)
    {
        $this->setupService->editSubject($id, $request->name);

        $notification = array(
            'message' => 'تم تعديل المادة الدراسية',
            'alert-type' => 'success'
        );

        return redirect()->route('school.subject.view')->with($notification);
    }

    public function SubjectDelete($id)
    {
        $this->setupService->deleteSubjectById($id);

        $notification = array(
            'message' => 'تم إزالة المادة الدراسية',
            'alert-type' => 'info'
        );

        return redirect()->route('school.subject.view')->with($notification);
    }
}
