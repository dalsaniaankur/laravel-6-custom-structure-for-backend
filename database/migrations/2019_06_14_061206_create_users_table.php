<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ka_users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('school_name')->nullable();
            $table->integer('school_level_id')->unsigned()->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();

            $table->integer('school_id')->unsigned()->nullable();
            $table->integer('class_id')->unsigned()->nullable();
            $table->integer('grade_id')->unsigned()->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->integer('gender')->nullable()->comment('1 => Male, 2 => Female');
            $table->string('eye_color')->nullable();
            $table->string('height_in_meter')->nullable();
            $table->string('height_in_inche')->nullable();
            $table->string('weight')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->text('comment')->nullable();

            $table->string('bio')->nullable();

            $table->string('principal_first_name')->nullable();
            $table->string('principal_last_name')->nullable();
            $table->string('principal_email')->nullable();
            $table->string('principal_phone')->nullable();
            $table->text('school_motto')->nullable();
            $table->text('core_values')->nullable();
            $table->text('short_description')->nullable();

            $table->text('address')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('state_id')->unsigned()->nullable();
            $table->integer('city_id')->unsigned()->nullable();
            $table->string('zipcode')->nullable();
            $table->string('photo')->nullable();
            $table->dateTime('last_login_date')->nullable();
            $table->string('created_type',100)->nullable()->comment('Web, App');
            $table->string('ip_address',100)->nullable();
            $table->integer('role_id')->unsigned()->nullable();
            $table->integer('status')->comment('1 = Active, 0 = Inactive')->nullable();
            $table->string('fcm_token')->nullable();
            $table->string('device_type')->comment('android, ios')->nullable();
            $table->integer('is_show_club_notification')->nullable();
            $table->dateTime('club_notification_update_date')->nullable();
            $table->integer('is_show_class_notification')->nullable();
            $table->dateTime('class_notification_update_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('role_id')->references('role_id')->on('ka_roles')->onDelete('cascade');
            $table->foreign('country_id')->references('country_id')->on('ka_country')->onDelete('cascade');
            $table->foreign('state_id')->references('state_id')->on('ka_state')->onDelete('cascade');
            $table->foreign('city_id')->references('city_id')->on('ka_city')->onDelete('cascade');

            $table->foreign('school_id')->references('user_id')->on('ka_users')->onDelete('cascade');
            //$table->foreign('class_id')->references('class_id')->on('ka_class')->onDelete('cascade');
            //$table->foreign('grade_id')->references('grade_id')->on('ka_grade')->onDelete('cascade');
            //$table->foreign('club_id')->references('club_id')->on('ka_club')->onDelete('cascade');
            $table->foreign('school_level_id')->references('school_level_id')->on('ka_school_level')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ka_users');
    }
}
