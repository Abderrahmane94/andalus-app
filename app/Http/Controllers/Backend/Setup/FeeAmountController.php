<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use App\Services\SetupService;
use Illuminate\Http\Request;
use App\Models\FeeCategory;
use App\Models\StudentClass;
use App\Models\FeeCategoryAmount;

class FeeAmountController extends Controller
{
    protected $setupService;

    public function __construct(SetupService $setupService)
    {
        $this->setupService = $setupService;
    }

    public function ViewFeeAmount()
    {
        // $data['allData'] = FeeCategoryAmount::all();
        $data['allData'] = $this->setupService->getAllFeeAmountByCategory();
        return view('backend.setup.fee_amount.view-fee-amount', $data);
    }


    public function AddFeeAmount()
    {
        $data['fee_categories'] = $this->setupService->getAllFeeCategory();
        $data['classes'] = $this->setupService->getAllStudentClasses();
        return view('backend.setup.fee_amount.add-fee-amount', $data);
    }


    public function StoreFeeAmount(Request $request)
    {
        $this->setupService->addFeeAmount($request);

        $notification = array(
            'message' => 'تم إضافة مبلغ الرسوم بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.amount.view')->with($notification);

    }


    public function EditFeeAmount($fee_category_id)
    {
        $data['editData'] = $this->setupService->findFeeCategoryAmountByFeeCategory($fee_category_id);
        $data['fee_categories'] = $this->setupService->getAllFeeCategory();
        $data['classes'] = $this->setupService->getAllStudentClasses();
        return view('backend.setup.fee_amount.edit-fee-amount', $data);

    }


    public function UpdateFeeAmount(Request $request, $fee_category_id)
    {
        if ($request->class_id == NULL) {

            $notification = array(
                'message' => 'Sorry You do not select any class amount',
                'alert-type' => 'error'
            );

            return redirect()->route('fee.amount.edit', $fee_category_id)->with($notification);

        } else {
            $this->setupService->editFeeAmount($request, $fee_category_id);
        }// end Else

        $notification = array(
            'message' => 'تم تعديل مبالغ الرسوم بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('fee.amount.view')->with($notification);
    } // end Method


    public function DetailsFeeAmount($fee_category_id)
    {
        $data['detailsData'] = $this->setupService->findFeeCategoryAmountByFeeCategory($fee_category_id);

        return view('backend.setup.fee_amount.details-fee-amount', $data);


    }


}
