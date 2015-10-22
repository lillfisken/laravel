<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('marketQuestions', function(Blueprint $table)
		{
			$table->bigIncrements('id');

			$table->bigInteger('createdByUser')->unsigned();
            $table->foreign('createdByUser')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('market')->unsigned();
            $table->foreign('market')->references('id')->on('markets')->onDelete('cascade');

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
