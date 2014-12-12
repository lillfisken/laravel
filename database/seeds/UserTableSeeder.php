<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use market\User;
use Hash;

class UserTableSeeder extends Seeder {
	
	public function run() {
			
		DB::table('users')->delete();

        $oskar = User::create([
            'name' => 'Oskar',
            'email'=> 'oskar@example.com',
            'password' => Hash::make('market'),
        ]);
		



	}
}


