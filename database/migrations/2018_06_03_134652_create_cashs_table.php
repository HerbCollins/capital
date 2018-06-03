<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCashsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->string('cash_no')->unique()->index();
            $table->decimal('rmb',10,2);
            $table->enum('type' , ['recharge' , 'withdraw' , 'buycoin' , 'sellcoin'])->default('recharge');
            $table->enum('status' , ['dealing' , 'finished' , 'withdraw'])->default('dealing');
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
        Schema::drop('cashs');
    }
}
