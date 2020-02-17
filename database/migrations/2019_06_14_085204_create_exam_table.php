<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_exam', function (Blueprint $table) {
            $table->bigIncrements('exam_id');
            $table->string('exam_name')->nullable();
            $table->integer('created_user_id')->unsigned();
            $table->integer('school_id')->unsigned();
            $table->date('exam_date')->nullable();
            $table->timestamps();

            $table->foreign('created_user_id')->references('user_id')->on('ka_users')->onDelete('cascade');
            $table->foreign('school_id')->references('user_id')->on('ka_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_exam');
    }
}
