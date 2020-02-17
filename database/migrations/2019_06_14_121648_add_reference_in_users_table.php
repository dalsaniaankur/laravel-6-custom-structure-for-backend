<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReferenceInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        \DB::statement('ALTER TABLE `ka_users` ADD KEY `ka_users_class_id_foreign` (`class_id`)');
        \DB::statement('ALTER TABLE `ka_users` ADD  CONSTRAINT `ka_users_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `ka_class`(`class_id`) ON DELETE CASCADE;');

        \DB::statement('ALTER TABLE `ka_users` ADD KEY `ka_users_grade_id_foreign` (`grade_id`)');
        \DB::statement('ALTER TABLE `ka_users` ADD  CONSTRAINT `ka_users_grade_id_foreign` FOREIGN KEY (`grade_id`) REFERENCES `ka_grade`(`grade_id`) ON DELETE CASCADE;');

        /*\DB::statement('ALTER TABLE `ka_users` ADD KEY `ka_users_club_id_foreign` (`club_id`)');
        \DB::statement('ALTER TABLE `ka_users` ADD  CONSTRAINT `ka_users_club_id_foreign` FOREIGN KEY (`club_id`) REFERENCES `ka_club`(`club_id`) ON DELETE CASCADE;');*/

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
