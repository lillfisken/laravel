<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePhpBBUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('phpBBUsers', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('user')->unsigned();
            $table->char('forumKey', 255);
            $table->string('username');
            $table->string('url');
            $table->timestamps();

            $table->unique(['forumKey', 'username']);
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
