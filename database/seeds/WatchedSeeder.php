<?php
use market\models\User;
use market\models\watchedMarketsByUser;

/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-09
 * Time: 23:57
 */
class WatchedSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('watched_markets_by_users')->delete();

        User::chunk(10,function($users) {
            foreach($users as $user)
            {
                $this->generate($user);
            }
        });
    }

    private function generate($user)
    {
        //id	bigint(20) unsigned Auto Increment
        //market	bigint(20) unsigned
        //user	bigint(20) unsigned
        //created_at	timestamp [0000-00-00 00:00:00]
        //updated_at	timestamp [0000-00-00 00:00:00]

        if($user)
        {
            $this->command->info('Seeding watched market for user ' . $user->username);

            $faker = \Faker\Factory::create('sv_SE');

            $count = rand(5,10);
            for($i = 0; $i < $count; $i++)
            {
                $date = $faker->dateTime;
                $market = \market\models\Market::select('id')->orderByRaw("RAND()")->first();
                $marketId = $market->id;
                $userId = $user->id;

                $data = [
                    'market' => $marketId,
                    'user' => $userId,
                    'created_at' => $date,
                    'updated_at' => $date
                ];

                if(watchedMarketsByUser::where('market', $marketId)->where('user', $userId)->first() == null)
                {
                    watchedMarketsByUser::create($data);
                }
            }
        }
    }
}