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
        Schema::create('signup_events', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type')->default(1);
            $table->string('title', 255);
            $table->mediumText('description', 255)->nullable();
            $table->timestamps();
            $table->timestamp('expires_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signup_events');
    }
}
