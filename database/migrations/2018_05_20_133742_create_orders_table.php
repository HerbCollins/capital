<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash_no' , 16)->unique()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->integer('coins')->unsigned()->default(0);
            $table->double('price')->unsigned()->default(0);
            $table->enum('type' , ["1","2","3","4"])->default("1");
            $table->enum('status' , ["1","2","3"])->default("1");
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
        Schema::drop('orders');
    }
}
