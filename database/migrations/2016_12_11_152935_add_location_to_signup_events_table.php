<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLocationToSignupEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('signup_events', function (Blueprint $table) {
            $table->integer('location_id')->unsigned()->nullable();
            $table->foreign('location_id')->references('id')->on('signup_locations');
        });
        Schema::table('signup_event_user', function (Blueprint $table) {
            $table->integer('location_id')->unsigned()->nullable();
            $table->foreign('location_id')->references('id')->on('signup_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('signup_event_user', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
        });
        Schema::table('signup_events', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
        });
    }
}
