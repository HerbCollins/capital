<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWechatAndAlipayAndBankcardAndPaymentPasswordToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('wechat' , 256)->nullable();
            $table->string('alipay' , 256)->nullable();
            $table->string('bankcard' , 19)->nullable();
            $table->string('bank' , 256)->nullable();
            $table->string('payment_password' , 60)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('wechat');
            $table->dropColumn('alipay');
            $table->dropColumn('bankcard');
            $table->dropColumn('bank');
            $table->dropColumn('payment_password');
        });
    }
}
