<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AccountEmployeeSalary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_employee_salary', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->integer('employee_id');
            $table->double('principal_amount');
            $table->double('grant_amount');
            $table->date('date');
            $table->integer('year_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_employee_salary');
    }
}
