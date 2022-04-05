<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\SchoolClasses;
use Illuminate\Http\Request;

class SchoolClassesController extends Controller
{
    public function ViewClasses(){
        $data['allData'] = SchoolClasses::all();
        return view('backend.setup.school_classes.view-classes',$data);

    }


    public function ClassesAdd(){
        return view('backend.setup.school_classes.add-classes');
    }

    public function ClassesStore(Request $request){



        $data = new SchoolClasses();
        $data->name = $request->name;
        $data->nb_students = $request->nb_student;
        $data->surface = $request->surface;
        $data->save();

        $notification = array(
            'message' => 'تمت إضافة القاعة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('school.classes.view')->with($notification);

    }



    public function ClassesEdit($id){
        $editData = SchoolClasses::find($id);
        return view('backend.setup.school_classes.edit-classes',compact('editData'));

    }


    public function ClassesUpdate(Request $request,$id){

        $data = SchoolClasses::find($id);

        $validatedData = $request->validate([
            'name' => 'required|unique:student_years,name,'.$data->id

        ]);


        $data->name = $request->name;
        $data->nb_students = $request->nb_student;
        $data->surface = $request->surface;
        $data->save();

        $notification = array(
            'message' => 'تم تعديل القاعة بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('school.classes.view')->with($notification);
    }



    public function ClassesDelete($id){
        $user = SchoolClasses::find($id);
        $user->delete();

        $notification = array(
            'message' => 'تم إزالة القاعة بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('school.classes.view')->with($notification);

    }
}
