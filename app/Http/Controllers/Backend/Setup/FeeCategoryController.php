<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategoryAmount;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    public function ViewFeeCat(){
    	$data['allData'] = FeeCategory::all();
    	return view('backend.setup.fee_category.view-fee-category',$data);

    }


    public function FeeCatAdd(){
    	return view('backend.setup.fee_category.add-fee-category');
    }


public function FeeCatStore(Request $request){

	    	$data = new FeeCategory();
	    	$data->name = $request->name;
	    	$data->save();

	    	$notification = array(
	    		'message' => 'تمت إضافة فئة الرسوم بنجاح',
	    		'alert-type' => 'success'
	    	);

	    	return redirect()->route('fee.category.view')->with($notification);

	    }



	 public function FeeCatEdit($id){
	    	$editData = FeeCategory::find($id);
	    	return view('backend.setup.fee_category.edit_fee_category',compact('editData'));

	    }



	 public function FeeCategoryUpdate(Request $request,$id){

	 $data = FeeCategory::find($id);

     $validatedData = $request->validate([
    		'name' => 'required|unique:fee_categories,name,'.$data->id

    	]);


    	$data->name = $request->name;
    	$data->save();

    	$notification = array(
    		'message' => 'تم تعديل فئة الرسوم بنجاح',
    		'alert-type' => 'success'
    	);

    	return redirect()->route('fee.category.view')->with($notification);
    }


 public function FeeCategoryDelete($id){

            FeeCategoryAmount::where('fee_category_id',$id)->delete();
	    	FeeCategory::find($id)->delete();


	    	$notification = array(
	    		'message' => 'تم إزالة فئة الرسوم بنجاح',
	    		'alert-type' => 'info'
	    	);

	    	return redirect()->route('fee.category.view')->with($notification);

	    }



}
