<?php

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
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('speaker');
            $table->string('slug');
            $table->string('ticket_vendor_id');
            $table->tinyInteger('ticket_vendor');
            $table->string('venue_id');
            $table->dateTime('start_time');
            $table->text('body');
            $table->text('meta_description');
            $table->tinyInteger('status');
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
        Schema::drop('events');
    }
}
