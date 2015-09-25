<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePhpBBusers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('phpBBUsers', function($t)
        {
            $t->bigInteger('user')->unsigned();
            $t->char('forumKey', 255);
            $t->string('username');
            $t->timestamps();

            $t->primary(['user', 'forumKey']);
            $t->unique(['forumKey', 'username']);

//            $t->foreign('user')->references('id')->on('users');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('phpBBUsers');
    }

}
