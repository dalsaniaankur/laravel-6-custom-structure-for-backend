<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_notification', function (Blueprint $table) {
            $table->bigIncrements('notification_id');
            $table->string('unique_group_id')->nullable();
            $table->integer('user_id')->unsigned();
            $table->text('description')->nullable();
            $table->integer('created_user_id')->unsigned();
            $table->dateTime('display_date')->nullable();
            $table->integer('status')->comment('1 = Schedule, 0 = Sent, 2 = View, 3 = Failed');
            $table->integer('notification_type')->comment('1 = Class, 2 = Club');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('ka_users')->onDelete('cascade');
            $table->foreign('created_user_id')->references('user_id')->on('ka_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_notification');
    }
}
