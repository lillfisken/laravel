<?php

// Composer: "fzaninotto/faker": "v1.4.0"
//use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\models\Bid;

class BidTableSeeder extends Seeder {

    public function run() {

        DB::table('bids')->delete();

        Bid::create([
            'auctionId' => 54,
            'bidder' => 3,
            'bid' => 350,
        ]);

        Bid::create([
            'auctionId' => 54,
            'bidder' => 2,
            'bid' => 450,
        ]);
    }
}


