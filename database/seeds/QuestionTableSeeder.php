<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\models\MarketQuestions;

class QuestionTableSeeder extends Seeder
{

    public function run()
    {

        DB::table('marketQuestions')->delete();

        $q = $this->generate([
            'createdByUser' => '3',
            'market' => '1',
            'message' => 'Hur gammal är den?'
        ]);
        $q->save();

        $q = $this->generate([
            'createdByUser' => '4',
            'market' => '1',
            'message' => 'Har du använt den?'
        ]);
        $q->save();

        $q = $this->generate([
            'createdByUser' => '3',
            'market' => '1',
            'message' => 'Finns den i rosa?'
        ]);
        $q->save();

        $q = $this->generate([
            'createdByUser' => '2',
            'market' => '1',
            'message' => "Ca 20 år, var min fars. <br/> Har lindat många spolar med den men vissa delar saknas nu, har inte hittat de efter flytten <br/> Finns inte i rosa"
        ]);
        $q->save();

        $limit = 80 * config('market.seedFactor');
        for($i = 0; $i < $limit; $i++)
        {
            $question = $this->generate();
            $question->save();
            $this->command->info($i+1 . ' market question auto seeded');
        }
    }

    private function generate($options = [])
    {
        $question = new marketQuestions();
        $faker = \Faker\Factory::create('sv_SE');

        //id	bigint(20) unsigned Auto Increment
        isset($options['id']) ? $question->id = $options['id'] : null;

        //createdByUser	bigint(20) unsigned
        $question->createdByUser = isset($options['createdByUser']) ? $options['createdByUser'] : \market\models\User::orderByRaw("RAND()")->first()->id;

        //market	bigint(20) unsigned
        $question->market = isset($options['market']) ? $options['market'] : \market\models\Market::orderByRaw("RAND()")->first()->id;

        //message	text
        $question->message = isset($options['message']) ? $options['message'] : $faker->sentences(rand(1,10),true);

        //created_at	timestamp [0000-00-00 00:00:00]
        $question->created_at = isset($options['created_at']) ? $options['created_at'] : $faker->dateTime;

        //updated_at	timestamp [0000-00-00 00:00:00]
        $question->updated_at = isset($options['updated_at']) ? $options['updated_at'] : $question->created_at;

        //deleted_at	timestamp NULL
        $question->deleted_at = isset($options['deleted_at']) ? $options['deleted_at'] : null;

        return $question;
    }
}