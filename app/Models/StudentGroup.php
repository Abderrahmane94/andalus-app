<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroup extends Model
{
    use HasFactory;


    public function learningseances() {
        return $this->hasMany(learningSeance::class);
    }

    public function teacher(){
        return $this->belongsTo(User::class,'teacher_id','id');
    }

    public function room(){
        return $this->belongsTo(SchoolClasses::class,'classes_id','id');
    }


    public function subject(){
        return $this->belongsTo(SchoolSubject::class,'subject_id','id');
    }

    public function class(){
        return $this->belongsTo(StudentClass::class,'class_id','id');
    }

    public function day(){
        return $this->hasMany(Day::class);
    }

    public function year(){
        return $this->belongsTo(StudentYear::class,'year_id','id');
    }

    public function feeType(){
        return $this->belongsTo(FeeTypes::class,'fee_type_id','id');
    }



}
