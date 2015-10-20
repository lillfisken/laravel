<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchedEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('watched_events', function(Blueprint $table)
		{
            $table->unsignedBigInteger('market');
            $table->unsignedBigInteger('user');
            $table->unsignedInteger('id')->default(0);
            $table->boolean('read')->default(0);
            $table->string('message');
            $table->timestamps();
            $table->softDeletes();

            $table->primary(['market', 'user', 'id']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('watched_events');
	}

}
