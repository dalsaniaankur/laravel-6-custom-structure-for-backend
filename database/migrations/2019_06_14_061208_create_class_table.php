<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_class', function (Blueprint $table) {
            $table->bigIncrements('class_id');
            $table->integer('school_id')->unsigned();
            $table->integer('grade_id')->unsigned();
            $table->string('class_name');
            $table->integer('status')->comment('1 = Active, 0 = Inactive')->nullable();
            $table->timestamps();

            $table->foreign('school_id')->references('user_id')->on('ka_users')->onDelete('cascade');
            $table->foreign('grade_id')->references('grade_id')->on('ka_grade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_class');
    }
}
