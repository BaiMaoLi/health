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
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('featured_picture')->nullable();;
            $table->string('slide_picture')->nullable();;
            $table->string('category_name');
            $table->string('tag_name');
            $table->string('event_title');
            $table->string('event_location');
            $table->text('event_body');
            $table->string('event_date');
            $table->string('event_time');
            $table->string('create_task')->default('0');
            $table->integer('task_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
