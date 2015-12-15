<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchedsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('watcheds', function(Blueprint $table)
		{
            $table->bigIncrements('id');
            $table->unsignedBigInteger('market');
			$table->unsignedBigInteger('userId');
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
		Schema::drop('watcheds');
	}

}
