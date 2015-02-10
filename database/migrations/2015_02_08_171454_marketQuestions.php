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
		Schema::create('marketQuestions', function($table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('createdByUser')->unsigned();
			$table->bigInteger('market')->unsigned();
			$table->text('message');

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
		Schema::drop('marketQuestions');
	}

}
