<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuctionToMarket extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('markets', function($table)
        {
            $table->boolean('auction')->default(0);
            $table->dateTime('endingAt')->nullable;
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('markets', function($table)
        {
            $table->dropColumn('auction');
            $table->dropColumn('edningAt');
        });
	}

}
