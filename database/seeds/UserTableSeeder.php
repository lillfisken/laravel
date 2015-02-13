<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\User;
use Illuminate\Support\Facades\Hash;
//use Hash;

class UserTableSeeder extends Seeder {
	
	public function run() {
			
		DB::table('users')->delete();

        $oskar = User::create([
            'id' => '2',
            'name' => 'Oskar',
            'email'=> 'oskar@example.com',
            'city' => 'Trelleborg',
            'password' => Hash::make('market'),
            'username' => 'LillaFisken',
        ]);

        $oskar2 = User::create([
            'id' => '3',
            'name' => 'Oskar2',
            'email'=> 'oskar2@example.com',
            'city' => 'Trelleborg',
            'password' => Hash::make('market'),
            'username' => 'LillaFisken2',
        ]);

        $example = User::create([
            'id' => '4',
            'name' => 'example',
            'email'=> 'example@example.com',
            'city' => 'MakedUpTown',
            'password' => Hash::make('market'),
            'username' => 'example user',
        ]);
		



	}
}


