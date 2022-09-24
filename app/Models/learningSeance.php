<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class learningSeance extends Model
{
    public function group(){
        return $this->belongsTo(StudentGroup::class,'student_group_id','id');
    }

    public function room(){
        return $this->belongsTo(SchoolClasses::class,'room_id','id');
    }
}
