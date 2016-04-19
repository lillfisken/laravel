<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->string('name');
            $table->string('username')->unique();
			$table->string('email')->unique();
			$table->string('password', 120);

            $table->string('street');
            $table->string('city');
            $table->integer('zip');
            $table->string('phone1');

            $table->text('presentation')->nullable();

            $table->boolean('phoneAllowed')->default(1);
            $table->boolean('emailAllowed')->default(1);
            $table->boolean('cityAllowed')->default(1);

            $table->boolean('mailNewPm')->default(1);
            $table->boolean('mailNewBidMyAuction')->default(1);
            $table->boolean('mailMyAuctionEnded')->default(1);
            $table->boolean('mailAuctionWatched')->default(1);
            $table->boolean('mailMarketEnded')->default(1);

			$table->rememberToken();
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
		Schema::drop('users');
	}
}
