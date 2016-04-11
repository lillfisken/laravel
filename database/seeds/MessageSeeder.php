<?php

// Composer: "fzaninotto/faker": "v1.4.0"
//use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\models\Conversation;
use market\models\Message;

class MessageTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('messages')->delete();

        Conversation::chunk(10, function($conversations) {
            foreach($conversations as $conversation)
            {
                $limit = rand(3,15);
                for($i = 0; $i < $limit; $i++)
                {
                    $m = $this->generate([
                        'conversationId' => $conversation->id,
                        'senderId' => $conversation->user1
                    ]);
                    $m->save(['seeding' => true]);
                    $this->command->info('Conversation: ' . $conversation->id . ' Sender: ' . $conversation->user1 . ' Message: ' . $i);
                }

                $limit = rand(3,15);
                for($i = 0; $i < $limit; $i++)
                {
                    $m = $this->generate([
                        'conversationId' => $conversation->id,
                        'senderId' => $conversation->user2
                    ]);
                    $m->save(['seeding' => true]);
                    $this->command->info('Conversation: ' . $conversation->id . ' Sender: ' . $conversation->user2 . ' Message: ' . $i);
                    \Illuminate\Support\Facades\Log::debug('MEMORY: ' . memory_get_usage());
                }
            }
        });
    }

    private function generate($options = [])
    {
        $m = new Message();
        $faker = \Faker\Factory::create('sv_SE');
        $conv =  Conversation::orderByRaw("RAND()")->first();

        //id	bigint(20) unsigned Auto Increment
        isset($options['id']) ? $m->id = $options['id'] : null;

        //conversationId	bigint(20) unsigned
        $m->conversationId = isset($options['conversationId']) ? $options['conversationId'] : $conv->id;

        //senderId	bigint(20) unsigned
        $m->senderId = isset($options['senderId']) ? $options['senderId'] : $conv->user1;

        //message	text
        $m->message = isset($options['message']) ? $options['message'] : $faker->sentences(rand(1,10), true);

        //read	tinyint(1) [0]
        $m->read = isset($options['read']) ? $options['read'] : $faker->boolean(25);

        //deletedBySender	tinyint(1) [0]
        //deletedByReciever	tinyint(1) [0]

        //created_at	timestamp [0000-00-00 00:00:00]
        $m->created_at = isset($options['created_at']) ? $options['created_at'] : $faker->dateTime;

        //updated_at	timestamp [0000-00-00 00:00:00]
        $m->updated_at = isset($options['updated_at']) ? $options['updated_at'] : $m->created_at;

        //deleted_at	timestamp NULL
        $m->deleted_at = isset($options['deleted_at']) ? $options['deleted_at'] : null;

        return $m;
    }
}