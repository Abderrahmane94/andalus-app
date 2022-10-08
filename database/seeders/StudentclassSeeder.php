<?php

namespace Database\Seeders;

use App\Models\StudentClass;
use Illuminate\Database\Seeder;

class StudentclassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new StudentClass();
        $data->name = 'براعم';
        $data->save();
        $data = new StudentClass();
        $data->name = 'تمهيدي';
        $data->save();
        $data = new StudentClass();
        $data->name = 'تحضيري';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الأولى ابتدائي';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الثانية ابتدائي';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الثالثة ابتدائي';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الرابعة ابتدائي';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الخامسة ابتدائي';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الأولى متوسط';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الثانية متوسط';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الثالثة متوسط';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الرابعة متوسط';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الأولى ثانوي';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الثانية ثانوي';
        $data->save();
        $data = new StudentClass();
        $data->name = 'السنة الثالثة ثانوي';
        $data->save();
    }
}
