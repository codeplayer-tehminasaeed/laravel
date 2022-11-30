<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_courses', function (Blueprint $table) {
            $table->increments('teacher_course_id');
            $table->integer('teacher_id');
            $table->integer('course_id');
            $table->integer('sec_id');
            $table->string('no_lectures');
            $table->foreign('teacher_id')->references('teacher_info_id')->on('teacher_infos_id')->onDelete('cascade');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            $table->foreign('sec_id')->references('sec_id')->on('sections')->onDelete('cascade');

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
        Schema::dropIfExists('teacher_courses');
        $table->dropForeign('course_id');
        $table->dropForeign('teacher_id');
        $table->dropForeign('sec_id');

    }
}
