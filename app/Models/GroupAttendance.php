<?php

namespace App\Models;

use App\Services\SetupService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupAttendance extends Model
{
    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id','id');
    }

    public function room(){
        return $this->belongsTo(SchoolClasses::class,'classes_id','id');
    }

    public function group(){
        return $this->belongsTo(StudentGroup::class,'group_id','id');
    }

    public function getAmountAttribute(){
        return FeeCategoryAmount::where('class_id',$this->group->class->id)
                                ->where('fee_category_id',2)
                                ->first()->amount;
    }
}
