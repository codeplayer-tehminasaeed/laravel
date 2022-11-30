<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_infos', function (Blueprint $table) {
            $table->increments('student_info_id');
            $table->string("std_cnic");
            $table->string("address");
            $table->string("gender");
            $table->integer("dep_id");
            $table->integer("prg_id");
            $table->integer("sec_id");
            $table->string("semester");
            $table->integer("student_id");
            // $table->foreign('dep_id')->references('department_id')->on('departments')->onDelete('cascade');

            // $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            // $table->foreign('sec_id')->references('section_id')->on('sections')->onDelete('cascade');

            // $table->foreign('prg_id')->references('program_id')->on('programs')->onDelete('cascade');
           
           
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
        Schema::dropIfExists('student_infos');
        $table->dropForeign('dep_id');
        $table->dropForeign('sec_id');
        $table->dropForeign('prg_id');
        $table->dropForeign('student_id');
    }
}
