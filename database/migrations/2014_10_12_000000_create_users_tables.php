<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTables extends Migration
{
    // Both Admin and User tables
    protected $tables = ['admins', 'users'];

    /**
     * Add the ability to run certain functions
     * @param Closure $action
     */
    protected function eachTable(Closure $action)
    {
        foreach ($this->tables as $table) {
            $action($table);
        }
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $blueprint) {
            $blueprint->increments('id');
            $blueprint->string('name');
            $blueprint->string('email')->nullable();
            $blueprint->integer('coin')->unsigned()->default(0);
            $blueprint->string('phone' , '11');
            $blueprint->string('inviter' , '16')->nullable();
            $blueprint->string('hash' , '16')->index();
            $blueprint->string('password', 60);
            $blueprint->rememberToken();
            $blueprint->timestamps();
        });

        Schema::create('admins', function (Blueprint $blueprint) {
            $blueprint->increments('id');
            $blueprint->string('name');
            $blueprint->string('email');
            $blueprint->string('password', 60);
            $blueprint->rememberToken();
            $blueprint->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->eachTable(function ($table) {
            Schema::drop($table);
        });
    }
}
