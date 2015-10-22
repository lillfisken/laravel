<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->bigInteger('auctionId')->unsigned();
            $table->bigInteger('bidder')->unsigned();
            $table->integer('bid')->unsigned();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bids');
    }

}
