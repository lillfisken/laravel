<?php

// Composer: "fzaninotto/faker": "v1.4.0"
//use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\models\Conversation;

class ConversationTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('conversations')->delete();

//        Conversation::create([
//            'id' => '312',
//            'title' => 'Fråga om annons',
//            'user1' => '2',
//            'user2' => '4'
//        ]);
//
//        Conversation::create([
//            'id' => '316',
//            'title' => 'En annan totalt värdelöskonversation',
//            'user1' => '2',
//            'user2' => '3'
//        ]);

        $limit = 3;
        for($i = 0; $i < $limit; $i++)
        {
            $c = $this->generate(['user1' => 2]);
            $c->save();
            $this->command->info($i+1 . ' conversation auto seeded for user 2');
        }

        $limit = 5 * config('market.seedFactor');
        for($i = 0; $i < $limit; $i++)
        {
            $c = $this->generate();
            $c->save();
            $this->command->info($i+1 . ' conversation auto seeded');
        }


    }

    private function generate($options = [])
    {

        $c = new Conversation();
        $faker = \Faker\Factory::create('sv_SE');

        //id	bigint(20) unsigned Auto Increment
        isset($options['id']) ? $c->id = $options['id'] : null;

        //user1	bigint(20) unsigned
        $c->user1 = isset($options['user1']) ? $options['user1'] : \market\models\User::orderByRaw("RAND()")->first()->id;

        //user2	bigint(20) unsigned
        if(isset($options['user2']))
        {
            $c->user2 = $options['user2'];
        }
        else
        {
            do
            {
                $user2 = \market\models\User::orderByRaw("RAND()")->first()->id;
            } while($c->user1 == $user2);
            $c->user2 = $user2;
        }

        //title	varchar(255)
        $c->title = isset($options['title']) ? $options['title'] : $faker->words(3,true);

        //created_at	timestamp [0000-00-00 00:00:00]
        $c->created_at = isset($options['created_at']) ? $options['created_at'] : $faker->dateTime;

        //updated_at	timestamp [0000-00-00 00:00:00]
        $c->updated_at = isset($options['updated_at']) ? $options['updated_at'] : $c->created_at;

        //deleted_at	timestamp NULL
        $c->deleted_at = isset($options['deleted_at']) ? $options['deleted_at'] : null;

        return $c;
    }
}
