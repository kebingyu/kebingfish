<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignupEventUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signup_event_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('group_size')->default(1);
        });
        Schema::table('signup_event_user', function (Blueprint $table) {
            $table->foreign('event_id')->references('id')->on('signup_events');
            $table->foreign('user_id')->references('id')->on('signup_users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['user_id', 'event_id']);
        Schema::dropIfExists('signup_event_user');
    }
}
