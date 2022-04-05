<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountStudentFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_student_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('fee_category_id')->nullable();
            $table->double('amount_paid')->nullable();
            $table->double('remaining_amount')->nullable();
            $table->string('paiement_date')->nullable();
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
        Schema::dropIfExists('account_student_fees');
    }
}
