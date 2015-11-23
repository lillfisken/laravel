<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockedUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blocked_users', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('blockingUserId');
			$table->bigInteger('blockedUserId');
			$table->timestamps();
			$table->softDeletes();

			$table->unique(['blockingUserId', 'blockedUserId']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('blocked_users');
	}

}
