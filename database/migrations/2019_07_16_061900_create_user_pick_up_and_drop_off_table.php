<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPickUpAndDropOffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_user_pick_up_and_drop_off', function (Blueprint $table) {
            $table->bigIncrements('user_pick_up_and_drop_off_id');
            $table->enum('pick_up_or_drop_off_id',[1,2])->comment('1 => Pick-up, 2 => Drop-off ');
            $table->integer('user_id')->unsigned();
            $table->integer('pick_up_and_drop_off_user_id')->nullable()->unsigned();
            $table->string('relationship')->nullable();
            $table->text('transportation_purpose');
            $table->date('date')->nullable();
            $table->integer('hour')->nullable();
            $table->integer('minute')->nullable();
            $table->integer('created_user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('ka_users')->onDelete('cascade');
            $table->foreign('created_user_id')->references('user_id')->on('ka_users')->onDelete('cascade');
            $table->foreign('pick_up_and_drop_off_user_id')->references('pick_up_and_drop_off_user_id')->on('ka_pick_up_and_drop_off_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_user_pick_up_and_drop_off');
    }
}
