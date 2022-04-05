<?php

namespace App\Models;

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
}
