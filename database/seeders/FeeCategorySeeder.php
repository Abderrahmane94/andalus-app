<?php

namespace Database\Seeders;

use App\Models\FeeCategory;
use Illuminate\Database\Seeder;

class FeeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new FeeCategory();
        $data->name = 'حقوق التسجيل';
        $data->save();
        $data = new FeeCategory();
        $data->name = 'حقوق الدراسة الشهرية';
        $data->save();
        $data = new FeeCategory();
        $data->name = 'كتب';
        $data->save();

    }
}
