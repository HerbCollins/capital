<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMinersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('miners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title' , 256);
            $table->string('img' , 256);
            $table->double('price');
            $table->integer('max')->unsigned()->default(0);
            $table->integer('day_max')->unsigned()->default(0);
            $table->integer('exist_max')->unsigned()->default(0);
            $table->double('income');
            $table->double('timelong');
            $table->integer('cycle')->unsigned()->default(0);
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
        Schema::drop('miners');
    }
}
