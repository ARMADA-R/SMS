<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyGroupStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_group_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student');
            $table->foreign('student')->references('id')->on('students')->onDelete('CASCADE');
            $table->unsignedBigInteger('study_group_id');
            $table->foreign('study_group_id')->references('id')->on('study_groups')->onDelete('CASCADE');
            $table->json('grades');
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
        Schema::dropIfExists('study_group_students');
    }
}
