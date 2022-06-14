<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Services\SetupService;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    protected $setupService;

    public function __construct(SetupService $setupService)
    {
        $this->setupService = $setupService;
    }

    public function ViewYear()
    {
        $data['allData'] = $this->setupService->getAllYears();
        return view('backend.setup.academic_year.view-year', $data);

    }


    public function StudentYearAdd()
    {
        return view('backend.setup.academic_year.add-year');
    }

    public function StudentYearStore(Request $request)
    {
        $this->setupService->addYear($request->name);

        $notification = array(
            'message' => 'تمت إضافة السنة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);

    }


    public function StudentYearEdit($id)
    {
        $editData = $this->setupService->findYearById($id);
        return view('backend.setup.academic_year.edit-year', compact('editData'));

    }


    public function StudentYearUpdate(Request $request, $id)
    {

        $this->setupService->editYear($id, $request->name);

        $notification = array(
            'message' => 'تم تعديل السنة الدراسية بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.year.view')->with($notification);
    }


    public function StudentYearDelete($id)
    {
        $year = $this->setupService->findYearById($id);
        $year->delete();

        $notification = array(
            'message' => 'تم إزالة السنة الدراسية بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('student.year.view')->with($notification);

    }


}
