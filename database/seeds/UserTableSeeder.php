<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\Market;

class UserTableSeeder extends Seeder {
	
	public function run() {
			
		DB::table('markets')->delete();
		
		$lindningsmaskin = Market::create(array(
			/*id*/
			'created_by_user'	=>	'2',
			'title'	=>	'Lindningsmaskin',
			/*type*/
			'type' => 'sellRow',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel tortor at purus consequat gravida a at justo. Donec vel efficitur ex. Aliquam tempor nisl non mauris feugiat, eu lobortis leo tempor. Aliquam eu erat posuere diam malesuada sollicitudin in quis tellus. Donec semper purus sit amet diam tristique porta. Quisque at purus dui. Morbi gravida lectus eu nibh sagittis, sed sodales nunc varius. Sed nisl lectus, dignissim eu fermentum et, placerat vel nunc. Vivamus augue ipsum, porttitor vitae ultrices vitae, tempor quis sem. Nulla vestibulum diam orci, non scelerisque dolor aliquet eget. Aliquam sodales pellentesque erat, nec dapibus turpis pretium nec. Morbi eu eros iaculis risus vestibulum luctus a sit amet metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
			'price'	=>	'2500.00',
            'extra_price_info' => 'Lorem ipsum',
			'number_of_items' => '3',
			/*contactOptions*/
			'contact_options' => 'mail',
			'image1_std' => '/market/public/images/2014/11/lindningsmaskin.jpg',
			'image1_thumb' => '/market/public/images/2014/11/lindningsmaskin_small.jpg',
			/*
			'image2'
			'image2_small'
			'image3'
			'image3_small'
			'image4'
			'image4_small'
			'image5'
			'image5_small'
			'image6'
			'image6_small'
			'endAt'
			/*
			'created_at'
			'update_at'
			'deleted_at'
			*/

		));
	
	}
}


