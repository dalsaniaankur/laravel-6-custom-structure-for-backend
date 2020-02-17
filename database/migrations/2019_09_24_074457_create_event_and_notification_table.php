<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventAndNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_event_and_notification', function (Blueprint $table) {
            $table->bigIncrements('event_and_notification_id');
            $table->string('title')->nullable();
            $table->date('event_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->integer('sender_id')->unsigned()->nullable()->comment('Created by');
            $table->integer('status')->nullable()->comment('1 = Active, 0 = Inactive');
            $table->string('created_type')->nullable()->comment('Web, App');
            $table->integer('notification_type')->nullable()->comment('1 = Pickup/Drop Off, 2 = Principal, 3 = Admin, 4 = Teacher, 5 = PTA');
            $table->timestamps();

            $table->foreign('sender_id')->references('user_id')->on('ka_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_event_and_notification');
    }
}
