<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->string('username')->unique();
			$table->string('address')->nullable();
			$table->string('city')->nullable();
			$table->integer('zipcode')->nullable();
			$table->string('phone1');
			$table->string('phone2')->nullable();
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
			$table->dropColumn('username');
			$table->dropColumn('address');
			$table->dropColumn('city');
			$table->dropColumn('zipcode');
			$table->dropColumn('phone1');
			$table->dropColumn('phone2');
		});
	}

}
