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
            $table->integer('teacher_id')->nullable();
            $table->integer('classes_id')->nullable();///room
            $table->integer('class_id');
            $table->integer('year_id');
            $table->date('alone_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('day')->nullable();
            $table->string('group_type');//common or individual
            $table->integer('nb_lessons')->nullable();
            $table->integer('nb_lesson_cycle');
            $table->integer('fix_salary')->nullable();
            $table->integer('amount_per_student')->nullable();
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
