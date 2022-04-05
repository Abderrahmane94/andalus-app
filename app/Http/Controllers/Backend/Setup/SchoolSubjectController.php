<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SchoolSubject;

class SchoolSubjectController extends Controller
{
      public function ViewSubject(){
    	$data['allData'] = SchoolSubject::all();
    	return view('backend.setup.school_subject.view-subject',$data);

    }


	public function SubjectAdd(){
    	return view('backend.setup.school_subject.add-subject');
    }

    public function SubjectStore(Request $request){



	    	$data = new SchoolSubject();
	    	$data->name = $request->name;
	    	$data->save();

	    	$notification = array(
	    		'message' => 'تمت إضافة المادة بنجاح',
	    		'alert-type' => 'success'
	    	);

	    return redirect()->route('school.subject.view')->with($notification);

	    }


	    public function SubjectEdit($id){
	    	$editData = SchoolSubject::find($id);
	    	return view('backend.setup.school_subject.edit-subject',compact('editData'));
	    }



	    public function SubjectUpdate(Request $request,$id){

	 $data = SchoolSubject::find($id);

     $validatedData = $request->validate([
    		'name' => 'required|unique:school_subjects,name,'.$data->id

    	]);


    	$data->name = $request->name;
    	$data->save();

    	$notification = array(
    		'message' => 'تم تعديل المادة الدراسية',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('school.subject.view')->with($notification);
    }


     public function SubjectDelete($id){
	    	$user = SchoolSubject::find($id);
	    	$user->delete();

	    	$notification = array(
	    		'message' => 'تم إزالة المادة الدراسية',
	    		'alert-type' => 'info'
	    	);

	   return redirect()->route('school.subject.view')->with($notification);

	    }




}
