<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_events', function (Blueprint $table) {
            $table->bigIncrements('event_id');
			$table->text('description')->nullable();
			$table->text('event_title')->nullable();
            $table->integer('event_type')->nullable()->comment('1 => By Principal, 2 => Person of Month, 3=> Theme of Month, 4=>Club notice, 5=> Class Notice, 6=> Birthday notices');
            $table->integer('is_all')->nullable()->comment('1 => All, 0 => Specific User');
            $table->integer('created_user_id')->unsigned();
            $table->integer('user_id')->unsigned()->comment('Birthday notices');
            $table->integer('class_id')->unsigned()->nullable()->comment('Class Notice');
            $table->integer('club_id')->unsigned()->nullable()->comment('Club notice');
            $table->integer('school_id')->unsigned()->nullable();
			$table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->time('end_time')->nullable();
			$table->string('photo')->nullable();
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
        Schema::dropIfExists('ka_events');
    }
}
