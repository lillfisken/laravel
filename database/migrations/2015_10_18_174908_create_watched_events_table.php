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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('watched');
            $table->boolean('read')->default(0);
            $table->string('message');
            $table->timestamps();
            $table->softDeletes();
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
