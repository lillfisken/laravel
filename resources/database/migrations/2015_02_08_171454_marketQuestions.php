<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketQuestions extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('MarketQuestion', function(Blueprint $table)
		{
			$table->increments('id');

			$table->bigInteger('user');
			$table->foreign('user')->references('id')->on('users');

			$table->bigInteger('market');
			$table->foreign('market')->references('id')->on('markets');

			$table->text('message');
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
		Schema::drop('MarketQuestion');
	}

}
