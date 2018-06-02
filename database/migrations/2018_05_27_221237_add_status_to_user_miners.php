<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToUserMiners extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_miners', function (Blueprint $table) {
            $table->enum('status' , ['working','over'])->default("working");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_miners', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
