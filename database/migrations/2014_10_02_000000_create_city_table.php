<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_city', function (Blueprint $table) {
            $table->bigIncrements('city_id');
            $table->string('city_name')->nullable();
            $table->integer('state_id')->unsigned();

           $table->foreign('state_id')->references('state_id')->on('ka_state')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_city');
    }
}
