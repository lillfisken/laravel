<?php

// Composer: "fzaninotto/faker": "v1.4.0"
//use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\models\Market;
use market\models\User;

class MarketsTableSeeder extends Seeder
{
    private $images = [
        [
            'std' => '/market/public/images/2014/11/lindningsmaskin.jpg',
            'thumb' => '/market/public/images/2014/11/lindningsmaskin_small.jpg',
            'full' => '/market/public/images/2014/11/lindningsmaskin.jpg'
        ],
        [
            'std' => '/market/public/images/2014/11/usbladdare.jpg',
            'thumb' => '/market/public/images/2014/11/usbladdare_small.jpg',
            'full' => '/market/public/images/2014/11/usbladdare.jpg'
        ],
        [
            'std' => '/market/public/images/2014/11/nixie2.jpg',
            'thumb' => '/market/public/images/2014/11/nixie2_small.jpg',
            'full' => '/market/public/images/2014/11/nixie2.jpg'
        ],
        [
            'std' => '/market/public/images/2014/11/produktbild10.png',
            'thumb' => '/market/public/images/2014/11/produktbild10.png',
            'full' => '/market/public/images/2014/11/produktbild10.png'
        ],
        [
            'std' => '/market/public/images/2014/11/cncfras.JPG',
            'thumb' => '/market/public/images/2014/11/cncfras_small.JPG',
            'full' => '/market/public/images/2014/11/cncfras.JPG'
        ],
        [
            'std' => '/market/public/images/2014/11/UVbox.jpg',
            'thumb' => '/market/public/images/2014/11/UVbox_small.jpg',
            'full' => '/market/public/images/2014/11/UVbox.jpg'
        ],
//        [
//            'std' => '',
//            'thumb' => '',
//            'full' => ''
//        ],
//        [
//            'std' => '',
//            'thumb' => '',
//            'full' => ''
//        ],
//        [
//            'std' => '',
//            'thumb' => '',
//            'full' => ''
//        ]
    ];

    public function run()
    {
        $seedfactor = config('market.seedFactor');

        DB::table('markets')->delete();

        $market = $this->generateMarket([
            'id' => '1',
            'createdByUser' => '2',
            'title' => 'Lindningsmaskin',
            'marketType' => '0',
            'price' => '2500.00',
            'number_of_items' => '3',
            'image1_std' => '/market/public/images/2014/11/lindningsmaskin.jpg',
            'image1_thumb' => '/market/public/images/2014/11/lindningsmaskin_small.jpg',
            'contactMail' => true,
            'contactPhone' => true,
            'contactPm' => true,
            'contactQuestions' => true,
        ]);
        $market->save();

        $market = $this->generateMarket([
            'createdByUser' => '2',
            'title' => 'USB-laddare',
            'description' => 'Multi-USB-Laddare<br />
							8 USB uttag.<br />
							Drivning externt 230v->5v nätagg <br />
							Slimmad konstruktion.<br />
							Klara tex. av att ladda upp Androidmobiler till 2A.<br />
							Individuellt avsäkrade kanaler.<br />
							Följer USB-speccarna.',
            'price' => '200.-',
            'extra_price_info' => 'Lorem ipsum',
            'number_of_items' => '49',
            'image1_std' => '/market/public/images/2014/11/usbladdare.jpg',
            'image1_thumb' => '/market/public/images/2014/11/usbladdare_small.jpg',
            'marketType' => '0',
            'contactMail' => 'true',
            'contactPhone' => 'true',
            'contactPm' => 'true',
            'contactQuestions' => 'false',
        ]);
        $market->save();

        $market = $this->generateMarket([
            'createdByUser' => '2',
            'title' => 'Nixie-Klocka-med-jättelång-rubrik-så-man-ser-hur-det-kan-se-ut',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel tortor at purus consequat gravida a at justo. Donec vel efficitur ex. Aliquam tempor nisl non mauris feugiat, eu lobortis leo tempor. Aliquam eu erat posuere diam malesuada sollicitudin in quis tellus. Donec semper purus sit amet diam tristique porta. Quisque at purus dui. Morbi gravida lectus eu nibh sagittis, sed sodales nunc varius. Sed nisl lectus, dignissim eu fermentum et, placerat vel nunc. Vivamus augue ipsum, porttitor vitae ultrices vitae, tempor quis sem. Nulla vestibulum diam orci, non scelerisque dolor aliquet eget. Aliquam sodales pellentesque erat, nec dapibus turpis pretium nec. Morbi eu eros iaculis risus vestibulum luctus a sit amet metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            'price' => '123.00',
            'extra_price_info' => '',
            'number_of_items' => '1',
            'image1_std' => '/market/public/images/2014/11/nixie2.jpg',
            'image1_thumb' => '/market/public/images/2014/11/nixie2_small.jpg',
            'image2_std' => '/market/public/images/2014/11/produktbild10.png',
            'image2_thumb' => '/market/public/images/2014/11/produktbild10.png',
            'marketType' => '0',
            'contactMail' => 'true',
            'contactPhone' => 'true',
            'contactPm' => 'true',
            'contactQuestions' => 'true',
        ]);
        $market->save();

        $market = $this->generateMarket([
            'createdByUser' => '2',
            'title' => 'Frekvensomformare',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel tortor at purus consequat gravida a at justo. Donec vel efficitur ex. Aliquam tempor nisl non mauris feugiat, eu lobortis leo tempor. Aliquam eu erat posuere diam malesuada sollicitudin in quis tellus. Donec semper purus sit amet diam tristique porta. Quisque at purus dui. Morbi gravida lectus eu nibh sagittis, sed sodales nunc varius. Sed nisl lectus, dignissim eu fermentum et, placerat vel nunc. Vivamus augue ipsum, porttitor vitae ultrices vitae, tempor quis sem. Nulla vestibulum diam orci, non scelerisque dolor aliquet eget. Aliquam sodales pellentesque erat, nec dapibus turpis pretium nec. Morbi eu eros iaculis risus vestibulum luctus a sit amet metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            'price' => '2500.00',
            'extra_price_info' => '',
            'number_of_items' => '1',
            'marketType' => '0',
            'contactMail' => 'true',
            'contactPhone' => 'true',
            'contactPm' => 'true',
            'contactQuestions' => 'true',
        ]);
        $market->save();

        $market = $this->generateMarket([
            'createdByUser' => '2',
            'title' => 'CNC-fräs',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel tortor at purus consequat gravida a at justo. Donec vel efficitur ex. Aliquam tempor nisl non mauris feugiat, eu lobortis leo tempor. Aliquam eu erat posuere diam malesuada sollicitudin in quis tellus. Donec semper purus sit amet diam tristique porta. Quisque at purus dui. Morbi gravida lectus eu nibh sagittis, sed sodales nunc varius. Sed nisl lectus, dignissim eu fermentum et, placerat vel nunc. Vivamus augue ipsum, porttitor vitae ultrices vitae, tempor quis sem. Nulla vestibulum diam orci, non scelerisque dolor aliquet eget. Aliquam sodales pellentesque erat, nec dapibus turpis pretium nec. Morbi eu eros iaculis risus vestibulum luctus a sit amet metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            'price' => '7500.00',
            'extra_price_info' => '',
            'number_of_items' => '1',
            'image1_std' => '/market/public/images/2014/11/cncfras.JPG',
            'image1_thumb' => '/market/public/images/2014/11/cncfras_small.JPG',
            'contactMail' => 'true',
            'contactPhone' => 'true',
            'contactPm' => 'true',
            'contactQuestions' => 'true',
        ]);
        $market->save();

        $market = $this->generateMarket([
            'createdByUser' => '2',
            'title' => 'UV-Box för kretskortstillverkning',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel tortor at purus consequat gravida a at justo. Donec vel efficitur ex. Aliquam tempor nisl non mauris feugiat, eu lobortis leo tempor. Aliquam eu erat posuere diam malesuada sollicitudin in quis tellus. Donec semper purus sit amet diam tristique porta. Quisque at purus dui. Morbi gravida lectus eu nibh sagittis, sed sodales nunc varius. Sed nisl lectus, dignissim eu fermentum et, placerat vel nunc. Vivamus augue ipsum, porttitor vitae ultrices vitae, tempor quis sem. Nulla vestibulum diam orci, non scelerisque dolor aliquet eget. Aliquam sodales pellentesque erat, nec dapibus turpis pretium nec. Morbi eu eros iaculis risus vestibulum luctus a sit amet metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            'price' => '550.00',
            'extra_price_info' => '',
            'number_of_items' => '1',
            'image1_std' => '/market/public/images/2014/11/UVbox.jpg',
            'image1_thumb' => '/market/public/images/2014/11/UVbox_small.jpg',
            'marketType' => '0',
            'contactMail' => 'true',
            'contactPhone' => 'true',
            'contactPm' => 'true',
            'contactQuestions' => 'true',
        ]);
        $market->save();

        $limit = 8;
        for($i = 0; $i < $limit; $i++)
        {
            $market = $this->generateMarket(['createdByUser' => '2']);
            $market->save();
            $this->command->info($i+1 . ' market seeded for user 2');
        }

        $limit = 12;
        for($i = 0; $i < $limit; $i++)
        {
            $market = $this->generateMarket(['createdByUser' => '4']);
            $market->save();
            $this->command->info($i+1 . ' market seeded for user 4');
        }

        $limit = 50 * $seedfactor;
        for($i = 0; $i < $limit; $i++)
        {
            $market = $this->generateMarket();
            $market->save();
            $this->command->info($i+1 . ' market auto seeded');
        }
    }

    private function generateMarket($options = [])
    {
        $market = new Market();
        $faker = Faker\Factory::create('sv_SE');
        $config = \Illuminate\Support\Facades\Config::get('market');

        isset($options['id']) ? $market->id = $options['id'] : null;

        //createdByUser	bigint(20) [1]
        $market->createdByUser = isset($options['createdByUser']) ? $options['createdByUser'] : User::orderByRaw("RAND()")->first()->id;

        //title	varchar(255)
        $market->title = isset($options['title']) ? $options['title'] : $faker->words(3, true);

        //marketType	int(11)
        $market->marketType = isset($options['marketType']) ? $options['marketType'] : array_rand($config['marketTypes']);

        //description	text
        $market->description = isset($options['description']) ? $options['description'] : $faker->sentences(rand(5, 25), true);

        //price	double(8,2)
        $market->price = isset($options['price']) ? $options['price'] : rand(1, 10000);

        //extra_price_info	text NULL
        if( isset($options['extra_price_info']) )
        {
            $market->extra_price_info = $options['extra_price_info'];
        }
        else
        {
            if(rand(0,1) == 1)
            {
                $market->extra_price_info = $faker->sentences(rand(1, 5), true);
            }
        }

        //number_of_items	int(11) [1]
        $market->number_of_items = isset($options['number_of_items']) ? $options['number_of_items'] : rand(1, 10);

        //endReason	int(11) NULL
        $market->endReason = isset($options['endReason']) ? $options['endReason'] : null;

        $numberOfImages = rand(0,6);
        for($i = 1; $i <= $numberOfImages; $i++)
        {
            $img = $this->images[array_rand($this->images)];
            $market['image' . $i . '_thumb'] = $img['thumb'];
            $market['image' . $i . '_std'] = $img['std'];
            $market['image' . $i . '_full'] = $img['full'];

            //image1_thumb	varchar(255) NULL
            //image1_std	varchar(255) NULL
            //image1_full	varchar(255) NULL
            //image2_thumb	varchar(255) NULL
            //image2_std	varchar(255) NULL
            //image2_full	varchar(255) NULL
            //image3_thumb	varchar(255) NULL
            //image3_std	varchar(255) NULL
            //image3_full	varchar(255) NULL
            //image4_thumb	varchar(255) NULL
            //image4_std	varchar(255) NULL
            //image4_full	varchar(255) NULL
            //image5_thumb	varchar(255) NULL
            //image5_std	varchar(255) NULL
            //image5_full	varchar(255) NULL
            //image6_thumb	varchar(255) NULL
            //image6_std	varchar(255) NULL
            //image6_full	varchar(255) NULL
        }

        //contactMail	tinyint(1)
        $market->contactMail = isset($options['contactMail']) ? $options['contactMail'] : $faker->boolean(80);

        //contactPhone	tinyint(1)
        $market->contactPhone = isset($options['contactPhone']) ? $options['contactPhone'] : $faker->boolean(80);

        //contactPm	tinyint(1)
        $market->contactPm = isset($options['contactPm']) ? $options['contactPm'] : $faker->boolean(80);

        //contactQuestions	tinyint(1)
        $market->contactQuestions = isset($options['contactQuestions']) ? $options['contactQuestions'] : $faker->boolean(80);

        //end_at	timestamp NULL
        isset($options['end_at']) ? $market->end_at = $options['end_at'] : null;

        //created_at	timestamp [0000-00-00 00:00:00]
        $market->created_at = isset($options['created_at']) ? $options['created_at'] : $faker->dateTime;

        //updated_at	timestamp [0000-00-00 00:00:00]
        $market->updated_at = isset($options['updated_at']) ? $options['updated_at'] : $market->created_at;

        //deleted_at	timestamp NULL
        $market->deleted_at = isset($options['deleted_at']) ? $options['deleted_at'] : null;

        if($market->marketType == 4 && !isset($market->end_at) )
        {
            $market->end_at = \Carbon\Carbon::now()->addWeek(rand(-2,8))->format('Y/m/d H:i');
        }

        return $market;
    }
}


