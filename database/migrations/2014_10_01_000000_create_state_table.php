<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_state', function (Blueprint $table) {
            $table->bigIncrements('state_id');
            $table->string('state_name')->nullable();
            $table->integer('country_id')->unsigned();
            $table->timestamps();

            $table->foreign('country_id')->references('country_id')->on('ka_country')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_state');
    }
}
