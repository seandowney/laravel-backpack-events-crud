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
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('speaker', 100)->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->text('body');
            $table->string('ticket_vendor_id')->nullable();
            $table->tinyInteger('ticket_vendor')->nullable();
            $table->string('venue_id')->nullable();
            $table->string('meta_description', 255)->nullable();
            $table->tinyInteger('status');
            $table->timestamps();

            $table->index(['status', 'start_time']);
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
