<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserWithSettings extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('users', function($table)
        {
            $table->boolean('mailNewPm')->default(1);
            $table->boolean('mailNewBidMyAuction')->default(1);
            $table->boolean('mailMyAuctionEnded')->default(1);
            $table->boolean('mailAuctionWatched')->default(1);
            $table->boolean('mailMarketEnded')->default(1);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('users', function($table)
        {
            $table->dropColumn('mailNewPm');
            $table->dropColumn('mailNewBidMyAuction');
            $table->dropColumn('mailMyAuctionEnded');
            $table->dropColumn('mailAuctionWatched');
            $table->dropColumn('mailMarketEnded');
        });
	}

}
