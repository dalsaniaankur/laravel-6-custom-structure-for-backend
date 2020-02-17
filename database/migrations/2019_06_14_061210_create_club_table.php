<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_club', function (Blueprint $table) {
            $table->bigIncrements('club_id');
            $table->integer('school_id')->unsigned();
            $table->string('club_name')->nullable();
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
        Schema::dropIfExists('ka_club');
    }
}
