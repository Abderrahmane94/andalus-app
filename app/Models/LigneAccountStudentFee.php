<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneAccountStudentFee extends Model
{
    use HasFactory;


    public function accountStudentFee()
    {

        return $this->$this->belongsTo(AccountStudentFee::class, 'account_student_id', 'id');
    }


}
