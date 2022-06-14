<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolClasses;
use App\Services\SetupService;
use Illuminate\Http\Request;

class SchoolClassesController extends Controller
{
    protected $setupService;

    public function __construct(SetupService $setupService)
    {
        $this->setupService = $setupService;
    }

    public function ViewClasses()
    {
        $data['allData'] = $this->setupService->getAllClasses();
        return view('backend.setup.school_classes.view-classes', $data);

    }


    public function ClassesAdd()
    {
        return view('backend.setup.school_classes.add-classes');
    }

    public function ClassesStore(Request $request)
    {
        $this->setupService->addClasses($request->name, $request->nb_student, $request->surface);

        $notification = array(
            'message' => 'تمت إضافة القاعة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('school.classes.view')->with($notification);

    }


    public function ClassesEdit($id)
    {
        $editData = $this->setupService->findClassesById($id);
        return view('backend.setup.school_classes.edit-classes', compact('editData'));

    }


    public function ClassesUpdate(Request $request, $id)
    {

        $this->setupService->editClasses($id, $request->name, $request->nb_student, $request->surface);

        $notification = array(
            'message' => 'تم تعديل القاعة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('school.classes.view')->with($notification);
    }


    public function ClassesDelete($id)
    {
        $classe = $this->setupService->findClassesById($id);
        $classe->delete();

        $notification = array(
            'message' => 'تم إزالة القاعة بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('school.classes.view')->with($notification);

    }
}
