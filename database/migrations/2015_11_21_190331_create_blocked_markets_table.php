<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockedMarketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blocked_markets', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('marketId');
			$table->bigInteger('userId');
			$table->timestamps();
			$table->softDeletes();

			$table->unique(['marketId', 'userId']);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('blocked_markets');
	}

}
