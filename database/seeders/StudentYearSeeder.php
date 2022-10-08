<?php

namespace Database\Seeders;

use App\Models\StudentYear;
use Illuminate\Database\Seeder;

class StudentYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new StudentYear();
        $data->name = '2023-2022';
        $data->active = true;
        $data->save();
    }
}
