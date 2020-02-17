<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentFeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_student_feed', function (Blueprint $table) {
            $table->bigIncrements('student_feed_id');
            $table->date('feed_date');
            $table->integer('user_id')->unsigned();
            $table->integer('created_user_id')->unsigned();
            $table->integer('attendance')->comment("1 => Present, 2 => Absent, 3 => Absent with request")->nullable();
            $table->text('general')->nullable();
            $table->text('behavior')->nullable();
            $table->text('food')->nullable();
            $table->text('health_medical')->nullable();
            $table->text('extra_curricular')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('ka_student_feed');
    }
}
