<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePickUpAndDropOffUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_pick_up_and_drop_off_user', function (Blueprint $table) {
            $table->bigIncrements('pick_up_and_drop_off_user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('gender')->nullable()->comment('1 => Male, 2 => Female');
            $table->string('phone')->nullable();
            $table->text('short_physical_description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_pick_up_and_drop_off_user');
    }
}
