<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountStudentFee extends Model
{
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(StudentGroup::class, 'group_id', 'id');
    }

    public function fee_category()
    {
        return $this->belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }


}
