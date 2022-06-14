<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolClasses;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function ViewGroup()
    {
        $data['allData'] = StudentGroup::all();
        return view('backend.setup.group.view-group', $data);

    }

    public function StudentGroupAdd()
    {
        $data['subjects'] = SchoolSubject::all();
        $data['teachers'] = User::where('user_type','Employee')->get();
        $data['classes'] = StudentClass::all();
        $data['rooms'] = SchoolClasses::all();
        return view('backend.setup.group.add-group',$data);
    }


    public function StudentGroupStore(Request $request)
    {
        $data = new StudentGroup();
        $data->name       = $request->name;
        $data->subject_id = $request->subject;
        $data->teacher_id = $request->teacher;
        $data->classes_id = $request->room;
        $data->class_id   = $request->class;
        $data->group_type = $request->group_type;
        $data->start_time = $request->start_time;
        $data->end_time = $request->end_time;
        $data->day = $request->day;
        $data->nb_lessons = 0;
        $data->fee_type_id = $request->fee_type_id;

        $data->save();

        $notification = array(
            'message' => 'تم إضافة الصف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.view')->with($notification);

    }


    public function StudentGroupEdit($id)
    {
        $editData = StudentGroup::find($id);
        return view('backend.setup.group.edit-group', compact('editData'));

    }


    public function StudentGroupUpdate(Request $request, $id)
    {

        $data = StudentGroup::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_groups,name,' . $data->id

        ]);


        $data->name = $request->name;
        $data->save();

        $notification = array(
            'message' => 'تم تعديل الصف بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.group.view')->with($notification);
    }


    public function StudentGroupDelete($id)
    {
        $group = StudentGroup::find($id);
        $group ->delete();

        $notification = array(
            'message' => 'تم إزالة الصف بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('student.group.view')->with($notification);

    }


}
