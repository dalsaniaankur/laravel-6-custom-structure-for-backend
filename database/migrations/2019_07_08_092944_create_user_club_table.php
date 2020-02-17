<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserClubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_user_club', function (Blueprint $table) {
            $table->bigIncrements('user_club_id');
            $table->integer('user_id')->unsigned();
            $table->integer('club_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('ka_users')->onDelete('cascade');
            $table->foreign('club_id')->references('club_id')->on('ka_club')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_user_club');
    }
}
