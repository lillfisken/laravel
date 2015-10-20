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
			$table->unsignedBigInteger('market');
			$table->unsignedBigInteger('user');
			$table->timestamps();
            $table->softDeletes();

            $table->primary(['market', 'user']);
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
