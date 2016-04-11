<?php
use Illuminate\Database\Seeder;
use market\models\Market;

/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-08
 * Time: 22:19
 */
class MarketEventSeeder extends Seeder
{
    public function run()
    {
        //id	bigint(20) unsigned Auto Increment
        //market	bigint(20) unsigned
        //body	text
        //deleted_at	timestamp NULL
        //created_at	timestamp [0000-00-00 00:00:00]
        //updated_at	timestamp [0000-00-00 00:00:00]

        Market::chunk(10, function($markets) {
            $faker = \Faker\Factory::create('sv_SE');

            foreach($markets as $market)
            {
                $this->command->info('Generating event for ' . $market->title);

                if(rand(1,100) > 20)
                {
                    //TODO: add 1-10 events
                    $time = $faker->dateTimeBetween($market->created_at);
                    $this->command->info('time: ' . $time->format('y-m-d h:m:s') .
                        'market->created_at: ' . $market->created_at->format('y-m-d h:m:s'));

                    $data = [
                        'market' => $market->id,
                        'body' => $faker->sentences(2, true),
                        'created_at' => $time,
                        'updated_at' => $time
                    ];
                    \market\models\eventMarket::create($data);
                }
            }
        });
    }
}
