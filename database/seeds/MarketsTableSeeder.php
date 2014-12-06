<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\Market;

class MarketsTableSeeder extends Seeder {
	
	public function run() {
			
		DB::table('markets')->delete();
		
		$lindningsmaskin = Market::create(array(
			/*id*/
			'createdByUser'	=>	'2',
			'title'	=>	'Lindningsmaskin',
			/*type*/
			'type' => 'sellRow',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel tortor at purus consequat gravida a at justo. Donec vel efficitur ex. Aliquam tempor nisl non mauris feugiat, eu lobortis leo tempor. Aliquam eu erat posuere diam malesuada sollicitudin in quis tellus. Donec semper purus sit amet diam tristique porta. Quisque at purus dui. Morbi gravida lectus eu nibh sagittis, sed sodales nunc varius. Sed nisl lectus, dignissim eu fermentum et, placerat vel nunc. Vivamus augue ipsum, porttitor vitae ultrices vitae, tempor quis sem. Nulla vestibulum diam orci, non scelerisque dolor aliquet eget. Aliquam sodales pellentesque erat, nec dapibus turpis pretium nec. Morbi eu eros iaculis risus vestibulum luctus a sit amet metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
			'price'	=>	'2500.00',
			/*numberOfItems*/
			/*contactOptions*/
			'contactOptions' => 'mail',
			'image1' => '/market/public/images/2014/11/lindningsmaskin.jpg',
			'image1_small' => '/market/public/images/2014/11/lindningsmaskin_small.jpg',
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
		
		$usbladdare = Market::create(array(
			/*id*/
			'createdByUser'	=>	'2',
			'title'	=>	'USB-laddare',
			'description' => 'Multi-USB-Laddare<br />
							8 USB uttag.<br />
							Drivning externt 230v->5v nätagg <br />
							Slimmad konstruktion.<br />
							Klara tex. av att ladda upp Androidmobiler till 2A.<br />
							Individuellt avsäkrade kanaler.<br />
							Följer USB-speccarna.',
			'price'	=>	'200.-',
			'numberOfItems' => '12',
			'image1' => '/market/public/images/2014/11/usbladdare.jpg',
			'image1_small' => '/market/public/images/2014/11/usbladdare_small.jpg',
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
			'type' => 'sellRow',
			'contactOptions' => 'mail',

		));
		
		$nixieklocka = Market::create(array(
			/*id*/
			'createdByUser'	=>	'2',
			'title'	=>	'Nixie-Klocka-med-jättelång-rubrik-så-man-ser-hur-det-kan-se-ut',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel tortor at purus consequat gravida a at justo. Donec vel efficitur ex. Aliquam tempor nisl non mauris feugiat, eu lobortis leo tempor. Aliquam eu erat posuere diam malesuada sollicitudin in quis tellus. Donec semper purus sit amet diam tristique porta. Quisque at purus dui. Morbi gravida lectus eu nibh sagittis, sed sodales nunc varius. Sed nisl lectus, dignissim eu fermentum et, placerat vel nunc. Vivamus augue ipsum, porttitor vitae ultrices vitae, tempor quis sem. Nulla vestibulum diam orci, non scelerisque dolor aliquet eget. Aliquam sodales pellentesque erat, nec dapibus turpis pretium nec. Morbi eu eros iaculis risus vestibulum luctus a sit amet metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
			'price'	=>	'123.00',
			/*numberOfItems*/
			'image1' => '/market/public/images/2014/11/nixie2.jpg',
			'image1_small' => '/market/public/images/2014/11/nixie2_small.jpg',
			'image2' => '/market/public/images/2014/11/produktbild10.png',
			'image2_small' => '/market/public/images/2014/11/produktbild10.png',
			/*
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
			'type' => 'sellRow',
			'contactOptions' => 'mail',

		));
		
		$frekvensomformare = Market::create(array(
			/*id*/
			'createdByUser'	=>	'2',
			'title'	=>	'Frekvensomformare',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel tortor at purus consequat gravida a at justo. Donec vel efficitur ex. Aliquam tempor nisl non mauris feugiat, eu lobortis leo tempor. Aliquam eu erat posuere diam malesuada sollicitudin in quis tellus. Donec semper purus sit amet diam tristique porta. Quisque at purus dui. Morbi gravida lectus eu nibh sagittis, sed sodales nunc varius. Sed nisl lectus, dignissim eu fermentum et, placerat vel nunc. Vivamus augue ipsum, porttitor vitae ultrices vitae, tempor quis sem. Nulla vestibulum diam orci, non scelerisque dolor aliquet eget. Aliquam sodales pellentesque erat, nec dapibus turpis pretium nec. Morbi eu eros iaculis risus vestibulum luctus a sit amet metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
			'price'	=>	'2500.00',
			/*numberOfItems*/
			/*image1''
			'image1_small'
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
			'type' => 'sellRow',
			'contactOptions' => 'mail',

		));
		
		$cncfras = Market::create(array(
			/*id*/
			'createdByUser'	=>	'2',
			'title'	=>	'CNC-fräs',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel tortor at purus consequat gravida a at justo. Donec vel efficitur ex. Aliquam tempor nisl non mauris feugiat, eu lobortis leo tempor. Aliquam eu erat posuere diam malesuada sollicitudin in quis tellus. Donec semper purus sit amet diam tristique porta. Quisque at purus dui. Morbi gravida lectus eu nibh sagittis, sed sodales nunc varius. Sed nisl lectus, dignissim eu fermentum et, placerat vel nunc. Vivamus augue ipsum, porttitor vitae ultrices vitae, tempor quis sem. Nulla vestibulum diam orci, non scelerisque dolor aliquet eget. Aliquam sodales pellentesque erat, nec dapibus turpis pretium nec. Morbi eu eros iaculis risus vestibulum luctus a sit amet metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
			'price'	=>	'7500.00',
			/*numberOfItems*/
			'image1' => '/market/public/images/2014/11/cncfras.JPG',
			'image1_small' => '/market/public/images/2014/11/cncfras_small.JPG',
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
			'type' => 'sellRow',
			'contactOptions' => 'mail',

		));
		
		$uvbox = Market::create(array(
			/*id*/
			'createdByUser'	=>	'2',
			'title'	=>	'UV-Box för kretskortstillverkning',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel tortor at purus consequat gravida a at justo. Donec vel efficitur ex. Aliquam tempor nisl non mauris feugiat, eu lobortis leo tempor. Aliquam eu erat posuere diam malesuada sollicitudin in quis tellus. Donec semper purus sit amet diam tristique porta. Quisque at purus dui. Morbi gravida lectus eu nibh sagittis, sed sodales nunc varius. Sed nisl lectus, dignissim eu fermentum et, placerat vel nunc. Vivamus augue ipsum, porttitor vitae ultrices vitae, tempor quis sem. Nulla vestibulum diam orci, non scelerisque dolor aliquet eget. Aliquam sodales pellentesque erat, nec dapibus turpis pretium nec. Morbi eu eros iaculis risus vestibulum luctus a sit amet metus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
			'price'	=>	'550.00',
			/*numberOfItems*/
			'image1' => '/market/public/images/2014/11/UVbox.jpg',
			'image1_small' => '/market/public/images/2014/11/UVbox_small.jpg',
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
			'type' => 'sellRow',
			'contactOptions' => 'mail',

		));
		
		
	
	}
}


