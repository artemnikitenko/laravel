<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNeosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('reference');
            $table->string('name', 250);
            $table->double('speed', 16, 10);
            $table->boolean('is_hazardous');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('neos');
    }
}
