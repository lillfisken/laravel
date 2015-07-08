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
        Schema::create('bids', function($t)
        {
            $t->bigInteger('auctionId')->unsigned();
            $t->bigInteger('bidder')->unsigned();
            $t->integer('bid')->unsigned();
            $t->timestamps();

            $t->primary(['auctionId', 'bidder']);
//            $t->foreign('auctionId')->references('id')->on('markets');
//            $t->foreign('bidder')->references('id')->on('users');
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
