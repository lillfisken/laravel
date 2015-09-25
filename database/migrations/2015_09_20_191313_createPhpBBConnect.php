<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhpBBConnect extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('phpBBconnect', function($t)
        {
            $t->char('token', 255);
            $t->char('forumKey', 255);
            $t->boolean('register')->default(0);
            $t->boolean('login')->default(0);
            $t->string('url')->nullable();
            $t->bigInteger('user')->unsigned()->nullable();
            $t->timestamps();

            $t->primary('token');

//            $t->foreign('user')->references('id')->on('users');
        });	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('phpBBconnect');
    }

}
