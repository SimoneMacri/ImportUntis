<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Lessons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson', function (Blueprint $table) {
            $table->string('teacher_id');
            $table->integer('giorno_id');
            $table->integer('ora_id');
            $table->string('room_id');
            $table->string('class_id');

            $table->primary(['teacher_id', 'giorno_id', 'ora_id', 'room_id', 'class_id']);



            $table->foreign('teacher_id')->references('id')->on('teacher')->onDelete('cascade');
            $table->foreign('giorno_id')->references('giorno_id')->on('time')->onDelete('cascade');
            $table->foreign('ora_id')->references('ora_id')->on('time')->onDelete('cascade');
            $table->foreign('room_id')->references('id')->on('room')->onDelete('cascade');
            $table->foreign('class_id')->references('id')->on('classe')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lesson');
    }
}
