<?php

// Composer: "fzaninotto/faker": "v1.4.0"
//use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\models\Bid;

class BidTableSeeder extends Seeder
{

    public function run()
    {

        $this->command->info('Bid table seeder');

        DB::table('bids')->delete();

//        $auctions = \market\models\Market::where('marketType', 4)->get();
        \market\models\Market::where('marketType', 4)->chunk(5, function($auctions){
            $this->generate($auctions);
        });

    }

    private function generate($auctions)
    {

        $faker = \Faker\Factory::create('sv_SE');

        foreach ($auctions as $auction) {
            if ($faker->boolean(80)) {
                $numberOfBids = rand(3, 10);
                $nextBid = rand($auction->price, $auction->price * 2);
                $latestBid = $auction->created_at;

                for ($i = 0; $i < $numberOfBids; $i++)
                {
                    $user = \market\models\User::select('id')->orderByRaw("RAND()")->first();
                    $latestBid = $faker->dateTimeBetween($latestBid , $auction->end_at);

                    $this->command->info('Generating bid for ' . $auction->title);

                    //id	bigint(20) unsigned Auto Increment
                    //auctionId	bigint(20) unsigned
                    //bidder	bigint(20) unsigned
                    //bid	int(10) unsigned
                    //created_at	timestamp [0000-00-00 00:00:00]
                    //updated_at	timestamp [0000-00-00 00:00:00]

                    $data = [
                        'auctionId' => $auction->id,
                        'bidder' => $user->id,
                        'bid' => $nextBid,
                        'created_at' => $latestBid,
                        'updated_at' => $latestBid
                    ];

                    $nextBid = $nextBid + rand(100,1000);

                    Bid::create($data);
                }
            }
        }
    }
}


