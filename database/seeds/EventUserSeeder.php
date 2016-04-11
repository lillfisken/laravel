<?php
use market\models\eventMarket;
use market\models\eventUser;
use market\models\User;
use market\models\watchedMarketsByUser;

/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-09
 * Time: 23:58
 */
class EventUserSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('event_users')->delete();

        User::chunk(10, function($users) {
            foreach($users as $user)
            {
                $this->generate($user);
            }
        });
    }

    /**
     * @param $user
     */
    private function generate($user)
    {
        //get all watched market by user
        $markets = watchedMarketsByUser::where('user', $user->id)->get();
        $faker = \Faker\Factory::create('sv_SE');

        $this->command->info('test');

        //Foreach market, get all events with marketId and userId
        foreach($markets as $market)
        {
            $events = eventMarket::where('market', $market->market)->get();

            //foreach event, generate eventUser
            foreach ($events as $event)
            {
                $this->command->info('Event for user ' . $user->username . ', Market: ' . $market->title . ' event: ' . $event->id);

                //marketId	bigint(20) unsigned
                //id	bigint(20) unsigned Auto Increment
                //userId	bigint(20) unsigned
                //eventId	bigint(20) unsigned
                //read	timestamp NULL
                //deleted_at	timestamp NULL
                //created_at	timestamp [0000-00-00 00:00:00]
                //updated_at	timestamp [0000-00-00 00:00:00]

                $date = $event->created_at;
                $read = $faker->boolean(30);
                $userId = $user->id;
                $eventId = $event->id;
                $marketId = $market->id;

                $data = [
                    'marketId' => $marketId,
                    'userId' => $userId,
                    'eventId' => $eventId,
                    'read' => $read,
                    'created_at' => $date,
                    'updated_at' => $date
                ];

                eventUser::create($data);
            }
        }
    }
}