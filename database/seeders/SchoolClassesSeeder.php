<?php

namespace Database\Seeders;

use App\Models\SchoolClasses;
use Illuminate\Database\Seeder;

class SchoolClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new SchoolClasses();
        $data->name = 'قرطبة - الأزرق';
        $data->nb_students = 16;
        $data->save();
        $data = new SchoolClasses();
        $data->name = 'غرناطة - الأصفر';
        $data->nb_students = 10;
        $data->save();
        $data = new SchoolClasses();
        $data->name = 'إشبيلية - الأخضر';
        $data->nb_students = 8;
        $data->save();
    }
}
