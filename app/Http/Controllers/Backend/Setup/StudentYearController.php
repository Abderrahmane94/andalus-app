<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    public function ViewYear(){
    	$data['allData'] = StudentYear::all();
    	return view('backend.setup.academic_year.view-year',$data);

    }


    public function StudentYearAdd(){
    	return view('backend.setup.academic_year.add-year');
    }

	public function StudentYearStore(Request $request){


	    	$data = new StudentYear();
	    	$data->name = $request->name;
	    	$data->save();

	    	$notification = array(
	    		'message' => 'تمت إضافة السنة بنجاح',
	    		'alert-type' => 'success'
	    	);

	    	return redirect()->route('student.year.view')->with($notification);

	    }


	 public function StudentYearEdit($id){
	    	$editData = StudentYear::find($id);
	    	return view('backend.setup.academic_year.edit-year',compact('editData'));

	    }


	    public function StudentYearUpdate(Request $request,$id){

		$data = StudentYear::find($id);

     $validatedData = $request->validate([
    		'name' => 'required|unique:student_years,name,'.$data->id

    	]);


    	$data->name = $request->name;
    	$data->save();

    	$notification = array(
    		'message' => 'تم تعديل السنة الدراسية بنجاح',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('student.year.view')->with($notification);
    }



	 public function StudentYearDelete($id){
	    	$user = StudentYear::find($id);
	    	$user->delete();

	    	$notification = array(
	    		'message' => 'تم إزالة السنة الدراسية بنجاح',
	    		'alert-type' => 'info'
	    	);

	    	return redirect()->route('student.year.view')->with($notification);

	    }



}
