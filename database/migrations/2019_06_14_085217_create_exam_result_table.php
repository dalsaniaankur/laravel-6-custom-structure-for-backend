<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_exam_result', function (Blueprint $table) {
            $table->bigIncrements('exam_result_id');
            $table->integer('exam_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('subject')->nullable();
            $table->string('percent')->nullable();
            $table->date('exam_date')->nullable();
            $table->timestamps();

            $table->foreign('exam_id')->references('exam_id')->on('ka_exam')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('ka_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_exam_result');
    }
}
