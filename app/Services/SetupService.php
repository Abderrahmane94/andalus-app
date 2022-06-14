<?php

namespace App\Services;

use App\Models\FeeCategory;
use App\Models\FeeCategoryAmount;
use App\Models\SchoolClasses;
use App\Models\SchoolSubject;
use App\Models\StudentClass;
use App\Models\StudentYear;
use Illuminate\Http\Request;

class SetupService
{

    /*----- Student Year -----*/
    public function getAllYears()
    {
        return StudentYear::all();
    }

    public function addYear($name)
    {
        $data = new StudentYear();
        $data->name = $name;
        $data->save();
    }

    public function editYear($id, $name)
    {
        $data = $this->findYearById($id);
        $data->name = $name;
        $data->save();
    }

    public function findYearById($yearId)
    {
        return StudentYear::find($yearId);
    }

    /*----- School Subject -----*/

    public function getAllSubjects()
    {
        return SchoolSubject::all();
    }

    public function addSubject($name)
    {
        $data = new SchoolSubject();
        $data->name = $name;
        $data->save();
    }

    public function editSubject($id, $name)
    {
        $data = $this->findSubjectById($id);
        $data->name = $name;
        $data->save();
    }

    public function findSubjectById($subjectId)
    {
        return SchoolSubject::find($subjectId);
    }

    /*----- School Classes -----*/

    public function getAllClasses()
    {
        return SchoolClasses::all();
    }

    public function addClasses($name, $nb_student, $surface)
    {
        $data = new SchoolClasses();
        $data->name = $name;
        $data->nb_students = $nb_student;
        $data->surface = $surface;
        $data->save();
    }

    public function editClasses($id, $name, $nb_student, $surface)
    {
        $data = $this->findClassesById($id);
        $data->name = $name;
        $data->nb_students = $nb_student;
        $data->surface = $surface;
        $data->save();
    }

    public function findClassesById($id)
    {
        return SchoolClasses::find($id);
    }

    /*----- Fee Category -----*/

    public function getAllFeeCategory()
    {
        return FeeCategory::all();
    }

    public function addFeeCategory($name)
    {
        $data = new FeeCategory();
        $data->name = $name;
        $data->save();
    }

    public function editFeeCategory($id, $name)
    {
        $data = $this->findFeeCategoryById($id);
        $data->name = $name;
        $data->save();
    }

    public function findFeeCategoryById($id)
    {
        return FeeCategory::find($id);
    }

    /*----- Fee Category Amount -----*/

    public function getAllFeeAmountByCategory()
    {
        return FeeCategoryAmount::select('fee_category_id')->groupBy('fee_category_id')->get();
    }

    public function findFeeCategoryAmountByFeeCategory($fee_cat_id)
    {
        return FeeCategoryAmount::where('fee_category_id', $fee_cat_id)->orderBy('class_id', 'asc')->get();
    }

    public function addFeeAmount(Request $request)
    {
        $countClass = count($request->class_id);

        if ($countClass != NULL) {
            for ($i = 0; $i < $countClass; $i++) {
                $fee_amount = new FeeCategoryAmount();
                $fee_amount->fee_category_id = $request->fee_category_id;
                $fee_amount->class_id = $request->class_id[$i];
                $fee_amount->amount = $request->amount[$i];
                $fee_amount->save();

            } // End For Loop
        }// End If Condition
    }

    public function editFeeAmount(Request $request, $fee_category_id)
    {
        $countClass = count($request->class_id);
        FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();
        for ($i = 0; $i < $countClass; $i++) {
            $fee_amount = new FeeCategoryAmount();
            $fee_amount->fee_category_id = $request->fee_category_id;
            $fee_amount->class_id = $request->class_id[$i];
            $fee_amount->amount = $request->amount[$i];
            $fee_amount->save();

        } // End For Loop
    }

    /*----- Student class -----*/

    public function getAllStudentClasses()
    {
        return StudentClass::all();
    }

}




