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
		



	}
}


