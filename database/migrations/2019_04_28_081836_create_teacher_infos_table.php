<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_infos', function (Blueprint $table) {
            $table->increments('teacher_info_id');
            $table->string("teacher_cnic");
            $table->string("address");
            $table->string("gender");
            $table->integer("dep_id");
            $table->integer("teacher_id");

            $table->foreign('dep_id')->references('department_id')->on('departments')->onDelete('cascade');

            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('teacher_infos');
        $table->dropForeign('dep_id');
        $table->dropForeign('teacher_id');
    }
}
