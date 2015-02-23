<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('messages', function(Blueprint $table)
        {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('conversationId');
            $table->foreign('conversationId')->references('id')->on('conversations')->onDelete('cascade');

            $table->unsignedBigInteger('senderId');
            $table->foreign('senderId')->references('id')->on('users')->onDelete('cascade');

            $table->text('message');
            $table->boolean('read')->default(false);

            $table->boolean('deletedBySender')->default(false);
            $table->boolean('deletedByReciever')->default(false);

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
        Schema::drop('messages');

    }

}
