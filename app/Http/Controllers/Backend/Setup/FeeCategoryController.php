<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Models\FeeCategoryAmount;
use App\Services\SetupService;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{

    protected $setupService;

    public function __construct(SetupService $setupService)
    {
        $this->setupService = $setupService;
    }

    public function ViewFeeCat()
    {
        $data['allData'] = $this->setupService->getAllFeeCategory();
        return view('backend.setup.fee_category.view-fee-category', $data);

    }


    public function FeeCatAdd()
    {
        return view('backend.setup.fee_category.add-fee-category');
    }


    public function FeeCatStore(Request $request)
    {

        $this->setupService->addFeeCategory($request->name);

        $notification = array(
            'message' => 'تمت إضافة فئة الرسوم بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.category.view')->with($notification);

    }


    public function FeeCatEdit($id)
    {
        $editData = $this->setupService->findFeeCategoryById($id);
        return view('backend.setup.fee_category.edit-fee-category', compact('editData'));

    }


    public function FeeCategoryUpdate(Request $request, $id)
    {

        $this->setupService->editFeeCategory($id, $request->name);

        $notification = array(
            'message' => 'تم تعديل فئة الرسوم بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.category.view')->with($notification);
    }


    public function FeeCategoryDelete($id)
    {

        FeeCategoryAmount::where('fee_category_id', $id)->delete();
        $this->setupService->findFeeCategoryById($id)->delete();


        $notification = array(
            'message' => 'تم إزالة فئة الرسوم بنجاح',
            'alert-type' => 'info'
        );

        return redirect()->route('fee.category.view')->with($notification);

    }


}
