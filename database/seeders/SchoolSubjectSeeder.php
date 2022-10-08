<?php

namespace Database\Seeders;

use App\Models\SchoolSubject;
use Illuminate\Database\Seeder;

class SchoolSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new SchoolSubject();
        $data->name = 'رياضيات';
        $data->save();
        $data = new SchoolSubject();
        $data->name = 'فيزياء';
        $data->save();
        $data = new SchoolSubject();
        $data->name = 'عربية';
        $data->save();
        $data = new SchoolSubject();
        $data->name = 'علوم طبيعية';
        $data->save();
        $data = new SchoolSubject();
        $data->name = 'فرنسية';
        $data->save();
        $data = new SchoolSubject();
        $data->name = 'إنجليزية';
        $data->save();
        $data = new SchoolSubject();
        $data->name = 'محاسبة';
        $data->save();
        $data = new SchoolSubject();
        $data->name = 'فلسفة';
        $data->save();
        $data = new SchoolSubject();
        $data->name = 'اسبانية';
        $data->save();

    }
}
