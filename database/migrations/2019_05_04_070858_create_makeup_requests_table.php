<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMakeupRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('makeup_requests', function (Blueprint $table) {
            $table->increments('makeup_request_id');
            $table->integer('t_course_id');
            $table->integer('slot_id');
            $table->integer('room_id');
            $table->string('day');
            $table->integer('sec_id');
            $table->integer('requested_teacher_id');
            $table->foreign('t_course_id')->references('t_course_id')->on('teacher_courses')->onDelete('cascade');
            $table->foreign('slot_id')->references('slot_id')->on('slots')->onDelete('cascade');
            $table->foreign('sec_id')->references('section_id')->on('sections')->onDelete('cascade');
            $table->foreign('room_id')->references('room_id')->on('rooms')->onDelete('cascade');
            $table->foreign('requested_teacher_id')->references('teacher_info_id')->on('teacher_infos')->onDelete('cascade');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('makeup_requests');
    }
}
