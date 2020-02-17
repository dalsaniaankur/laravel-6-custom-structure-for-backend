<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentParentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_student_parent', function (Blueprint $table) {
            $table->bigIncrements('student_parent_id');
            $table->integer('student_id')->unsigned();
            $table->integer('parent_id')->unsigned();
            $table->timestamps();

            $table->foreign('student_id')->references('user_id')->on('ka_users')->onDelete('cascade');
            $table->foreign('parent_id')->references('user_id')->on('ka_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_student_parent');
    }
}
