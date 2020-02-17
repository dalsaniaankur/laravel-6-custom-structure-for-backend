<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_homework', function (Blueprint $table) {
            $table->bigIncrements('homework_id');
            $table->integer('class_id')->unsigned()->nullable();
            $table->integer('created_user_id')->unsigned();
            $table->integer('school_id')->unsigned()->nullable();
			$table->text('content')->nullable();
			$table->string('photo')->nullable();
			$table->date('homework_date')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('ka_homework');
    }
}
