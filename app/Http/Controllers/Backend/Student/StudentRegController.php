<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AccountStudentFee;
use App\Models\FeeCategoryAmount;
use App\Models\LigneAccountStudentFee;
use App\Models\SchoolSubject;
use Illuminate\Http\Request;
use App\Models\AssignStudent;
use App\Models\User;
use App\Models\DiscountStudent;

use App\Models\StudentYear;
use App\Models\StudentClass;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB;
use PDF;


class StudentRegController extends Controller
{
    public function StudentRegView()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['allData'] = AssignStudent::where('group_id','=',null)->get();

        //$data['year_id'] = StudentYear::orderBy('id','desc')->first()->id;
        //$data['class_id'] = StudentClass::orderBy('id','desc')->first()->id;
        // dd($data['class_id']);
        //$data['allData'] = AssignStudent::where('year_id',$data['year_id'])->where('class_id',$data['class_id'])->get();
        return view('backend.student.student_registration.student-view', $data);

    }


    public function StudentClassYearWise(Request $request)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();

        $data['year_id'] = $request->year_id;
        $data['class_id'] = $request->class_id;

        $data['allData'] = AssignStudent::where('year_id', $request->year_id)->where('class_id', $request->class_id)->get();
        return view('backend.student.student_registration.student-view', $data);

    }


    public function StudentRegAdd()
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['subjects'] = SchoolSubject::all();
        $data['groups'] = StudentGroup::all();
        return view('backend.student.student_registration.student-add', $data);
    }


    public function StudentRegStore(Request $request)
    {
        DB::transaction(function () use ($request) {
            $checkYear = StudentYear::find($request->year_id)->name;
            $student = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first();
            // create student code
            if ($student == null) {
                $firstReg = 0;
                $studentId = $firstReg + 1;
                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } elseif ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } elseif ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }
            } else {
                $student = User::where('usertype', 'Student')->orderBy('id', 'DESC')->first()->id;
                $studentId = $student + 1;
                if ($studentId < 10) {
                    $id_no = '000' . $studentId;
                } elseif ($studentId < 100) {
                    $id_no = '00' . $studentId;
                } elseif ($studentId < 1000) {
                    $id_no = '0' . $studentId;
                }

            } // end else
            $final_id_no = $checkYear ."/". $id_no;

            $user = new User();
            $user->id_no = $final_id_no;
            $user->password = bcrypt('password');
            $user->usertype = 'Student';
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->mother_name = $request->mother_name;
            $user->father_name = $request->father_name;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
            $user->save();

            // assign student to a class
            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->save();

            // assign student to groups
            if ($request->group_id != NULL) {
                $countGroups = count($request->group_id);
                for ($i=0; $i <$countGroups ; $i++) {
                    $assign_student = new AssignStudent();
                    $assign_student->student_id = $user->id;
                    $assign_student->year_id = $request->year_id;
                    $assign_student->class_id = $request->class_id;
                    $assign_student->group_id = $request->group_id[$i];
                    $assign_student->save();

                } // End For Loop
            }// End If Condition

            /// registration fee
            $account_reg_student = new AccountStudentFee();
            $account_reg_student->student_id = $user->id;
            $account_reg_student->fee_category_id = 1;
            $amount_to_be_paid = FeeCategoryAmount::where('fee_category_id',1)
                                            ->where('class_id',$request->class_id)
                                            ->pluck('amount');
            $account_reg_student->amount_paid = 0;
            $account_reg_student->amount_to_be_paid = $amount_to_be_paid->get(0);
            $account_reg_student->save();

            $ligne_account_reg_student = new LigneAccountStudentFee();
            $ligne_account_reg_student->account_student_id = $account_reg_student->id;
            $ligne_account_reg_student->amount = $account_reg_student->amount_to_be_paid;
            $ligne_account_reg_student->ligne_date = $account_reg_student->created_at;
            $ligne_account_reg_student->save();


           /* $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();*/

        });


        $notification = array(
            'message' => 'تم إضافة التلميذ بنجاح',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);

    } // End Method


    public function StudentRegEdit($student_id)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['subjects'] = SchoolSubject::all();

        //$data['editData'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();
        // dd($data['editData']->toArray());
        return view('backend.student.student_registration.student-edit', $data);

    }


    public function StudentRegUpdate(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {


            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/' . $user->image));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = AssignStudent::where('id', $request->id)->where('student_id', $student_id)->first();

            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = DiscountStudent::where('assign_student_id', $request->id)->first();

            $discount_student->discount = $request->discount;
            $discount_student->save();

        });


        $notification = array(
            'message' => 'Student Registration Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);

    } // End Method


    public function StudentRegPromotion($student_id)
    {
        $data['years'] = StudentYear::all();
        $data['classes'] = StudentClass::all();
        $data['groups'] = StudentGroup::all();
        $data['shifts'] = StudentShift::all();

        $data['editData'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();

        return view('backend.student.student_reg.student-promotion', $data);

    }


    public function StudentUpdatePromotion(Request $request, $student_id)
    {
        DB::transaction(function () use ($request, $student_id) {


            $user = User::where('id', $student_id)->first();
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->dob = date('Y-m-d', strtotime($request->dob));

            if ($request->file('image')) {
                $file = $request->file('image');
                @unlink(public_path('upload/student_images/' . $user->image));
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/student_images'), $filename);
                $user['image'] = $filename;
            }
            $user->save();

            $assign_student = new AssignStudent();

            $assign_student->student_id = $student_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->class_id = $request->class_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();

            $discount_student = new DiscountStudent();

            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();

        });


        $notification = array(
            'message' => 'Student Promotion Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('student.registration.view')->with($notification);

    } // End Method


    public function StudentRegDetails($student_id)
    {
        $data['details'] = AssignStudent::with(['student', 'discount'])->where('student_id', $student_id)->first();

        $pdf = PDF::loadView('backend.student.student_reg.student_details_pdf', $data);
        $pdf->SetProtection(['copy', 'print'], '', 'pass');
        return $pdf->stream('document.pdf');

    }

    public function StudentRegGroupsDetails($student_id){
        $data['detailsData'] = AssignStudent::where('student_id',$student_id)->where('group_id','!=',null)->get();
        $data['detail'] = AssignStudent::where('student_id',$student_id)->where('group_id','!=',null)->first();
        return view('backend.student.student_registration.details-student-groups',$data);


    }


}
