<?php
use market\models\blockedMarket;
use market\models\User;

/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-09
 * Time: 23:57
 */
class BlockedMarketSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
//        $this->generate(\market\models\User::find('2'));
        DB::table('blocked_markets')->delete();

        User::chunk(4, function($users) {
            foreach($users as $user)
            {
                $this->generate($user);
            }
        });
    }

    public function generate($user)
    {
        if($user)
        {
            $this->command->info('Seeding blocked market for user ' . $user->username);

            $faker = \Faker\Factory::create('sv_SE');

            $count = rand(1,10);
            for($i = 0; $i < $count; $i++)
            {
                //id	bigint(20) unsigned Auto Increment
                //marketId	bigint(20)
                //userId	bigint(20)
                //created_at	timestamp [0000-00-00 00:00:00]
                //updated_at	timestamp [0000-00-00 00:00:00]
                //deleted_at	timestamp NULL

                $market = \market\models\Market::select('id')->orderByRaw("RAND()")->first();
                $marketId = $market->id;
                $userId = $user->id;
                $date = $faker->dateTimeBetween($market->created_at);

                $data = [
                    'marketId' => $marketId,
                    'userId' => $userId,
                    'created_at' => $date,
                    'updated_at' => $date
                ];

                if(
                    blockedMarket::where('marketId', $marketId)->where('userId', $userId)->first() == null
                    && $market->createdByUser != $userId
                )
                {
                    blockedMarket::create($data);
                }
            }
        }
    }
}