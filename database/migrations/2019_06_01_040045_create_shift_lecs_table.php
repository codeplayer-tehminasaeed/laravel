<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShiftLecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_lecs', function (Blueprint $table) {
            $table->increments('shift_lec_id');
            $table->string('timetable_id');
            $table->string('shift_day');
            $table->string('shift_slot_id');
            $table->string('shift_slot_no');
            $table->string('teacher_id');
            $table->string('status');
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
        Schema::dropIfExists('shift_lecs');
    }
}
