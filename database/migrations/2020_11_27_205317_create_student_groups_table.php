<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('subject_id');
            $table->integer('teacher_id');
            $table->integer('classes_id');///room
            $table->integer('class_id');
            $table->integer('year_id');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('day');
            $table->string('group_type');//common or individual
            $table->integer('nb_lessons');
            $table->integer('fee_type_id');
            $table->boolean('active');
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
        Schema::dropIfExists('student_groups');
    }
}
