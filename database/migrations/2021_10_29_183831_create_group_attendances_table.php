<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('teacher_id');
            $table->integer('group_id');
            $table->integer('classes_id');
            $table->dateTime('start_time',$precision = 0);
            $table->dateTime('end_time',$precision = 0);
            $table->string('date');
            $table->string('changes');
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
        Schema::dropIfExists('group_attendances');
    }
}



