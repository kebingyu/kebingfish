<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSignupLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signup_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->unique();
            $table->string('data');
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
        Schema::table('signup_locations', function (Blueprint $table) {
            $table->dropUnique(['name']);
        });
        Schema::dropIfExists('signup_locations');
    }
}
