<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_users', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->unsignedBigInteger('userId');
			$table->unsignedBigInteger('eventId');
			$table->timestamp('read')->nullable();
            $table->softDeletes();
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
		Schema::drop('event_users');
	}

}
