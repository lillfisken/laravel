<?php
use market\models\blockedUser;
use market\models\User;

/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-04-09
 * Time: 23:57
 */
class BlockedSellerSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        DB::table('blocked_users')->delete();

        User::chunk(10, function($users) {
            foreach($users As $user)
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
        //id	bigint(20) unsigned Auto Increment
        //blockingUserId	bigint(20)
        //blockedUserId	bigint(20)
        //created_at	timestamp [0000-00-00 00:00:00]
        //updated_at	timestamp [0000-00-00 00:00:00]
        //deleted_at	timestamp NULL

        $faker = \Faker\Factory::create('sv_SE');
        $count = rand(1,3);

        for($i = 0; $i < $count; $i++)
        {
            $this->command->info('Generating blocked seller for ' . $user->username);

            $blocked = User::orderByRaw("RAND()")->first(['id']);

            if(blockedUser::where('blockedUserId', $blocked->id)->where('blockingUserId', $user->id)->first() == null)
            {
                $date = $faker->dateTime;

                $data = [
                    'blockingUserId' => $user->id,
                    'blockedUserId' => $blocked->id,
                    'created_at' => $date,
                    'updated_at' => $date
                ];

                blockedUser::create($data);
            }
        }
    }
}