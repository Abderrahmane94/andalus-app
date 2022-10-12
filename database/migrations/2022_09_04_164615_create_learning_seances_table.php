<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLearningSeancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('learning_seances', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->time('start_time');
            $table->time('end_time');
            $table->bigInteger('student_group_id');
            $table->bigInteger('room_id');
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
        Schema::dropIfExists('learning_seances');
    }
}
