<?php

// Composer: "fzaninotto/faker": "v1.4.0"
//use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\models\Message;

class MessageTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('messages')->delete();

        Message::create([
            'senderId' => '4',
            'conversationId' => '312',
            'message' => 'Ställer en fråga om annonsen',
            'read' => 1
        ]);
        sleep(3);

        Message::create([
            'senderId' => '2',
            'conversationId' => '312',
            'message' => 'Svarar på en fråga',
            'read' => 1
        ]);
        sleep(3);

        Message::create([
            'senderId' => '4',
            'conversationId' => '312',
            'message' => 'Och ställer en följdfråga',
            'read' => 1
        ]);
        sleep(3);

        Message::create([
            'senderId' => '4',
            'conversationId' => '312',
            'message' => 'Och en till',
            'read' => 1
        ]);
        sleep(3);

        Message::create([
            'senderId' => '2',
            'conversationId' => '312',
            'message' => 'Svarar på frågorna',
            'read' => 0
        ]);

        //-----------------------------------------

        Message::create([
            'senderId' => '3',
            'conversationId' => '316',
            'message' => 'Babblar på om lorem ipsum',
            'read' => 1
        ]);
        sleep(3);

        Message::create([
            'senderId' => '2',
            'conversationId' => '316',
            'message' => 'Vad är lorem ipsum',
            'read' => 1
        ]);
        sleep(3);

        Message::create([
            'senderId' => '3',
            'conversationId' => '316',
            'message' => 'Mockup text',
            'read' => 1
        ]);
        sleep(3);

        Message::create([
            'senderId' => '2',
            'conversationId' => '316',
            'message' => 'VGadå mockuptext?',
            'read' => 1
        ]);
        sleep(3);

        Message::create([
            'senderId' => '3',
            'conversationId' => '316',
            'message' => 'Text utan någon mening men som visar på att det finns data och som kan användas för att fylla ut textmassor under utveckling',
            'read' => 0
        ]);
        sleep(3);
    }
}