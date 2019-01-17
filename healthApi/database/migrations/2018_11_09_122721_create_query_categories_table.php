<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQueryCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('query_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category_name');
            $table->string('happy_marks')->default('0');
            $table->string('excellent_marks')->default('0');
            $table->string('good_marks')->default('0');
            $table->string('bad_marks')->default('0');
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
        Schema::dropIfExists('query_categories');
    }
}
