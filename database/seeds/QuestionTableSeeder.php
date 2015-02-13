<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\MarketQuestions;

class QuestionTableSeeder extends Seeder
{

    public function run()
    {

        DB::table('marketQuestions')->delete();

        marketQuestions::create([
            'createdByUser' => '3',
            'market' => '1',
            'message' => 'Hur gammal är den?'
        ]);
        sleep(3);

        marketQuestions::create([
            'createdByUser' => '4',
            'market' => '1',
            'message' => 'Har du använt den?'
        ]);
        sleep(3);

        marketQuestions::create([
            'createdByUser' => '3',
            'market' => '1',
            'message' => 'Finns den i rosa?'
        ]);
        sleep(3);

        marketQuestions::create([
            'createdByUser' => '2',
            'market' => '1',
            'message' => "Ca 20 år, var min fars. <br/> Har lindat många spolar med den men vissa delar saknas nu, har inte hittat de efter flytten <br/> Finns inte i rosa"
        ]);
        sleep(3);


    }
}