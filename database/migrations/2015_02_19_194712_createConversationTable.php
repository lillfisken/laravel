<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConversationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('conversations', function(Blueprint $table)
        {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user1');
            $table->unsignedBigInteger('user2');

            $table->string('title');

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
        Schema::drop('conversations');

    }

}
