<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = new User();
        $data->username = 'admin.admin';
        $data->first_name = 'admin';
        $data->last_name = 'admin';
        $data->email = 'admin@gmail.com';
        $data->password = bcrypt('password');
        $data->save();
    }
}
