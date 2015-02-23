<?php

// Composer: "fzaninotto/faker": "v1.4.0"
//use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\Conversation;

class ConversationTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('conversations')->delete();

        Conversation::create([
            'id' => '312',
            'title' => 'Fråga om annons',
            'user1' => '2',
            'user2' => '4'
        ]);

        Conversation::create([
            'id' => '316',
            'title' => 'En annan totalt värdelöskonversation',
            'user1' => '2',
            'user2' => '3'
        ]);

    }
}
