<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAllergiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_student_allergies', function (Blueprint $table) {
            $table->bigIncrements('student_allergie_id');
            $table->integer('user_id')->unsigned();
            $table->integer('allergie_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('ka_users')->onDelete('cascade');
            $table->foreign('allergie_id')->references('allergie_id')->on('ka_allergies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_user_allergies');
    }
}
