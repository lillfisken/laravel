<?php

// Composer: "fzaninotto/faker": "v1.4.0"
use Illuminate\Database\Seeder;
use market\models\User;
use Illuminate\Support\Facades\Hash;

//use Hash;

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        $user = $this->generateUser([
            'id' => 2,
            'name' => 'Oskar',
            'email' => 'oskar@example.com',
            'city' => 'Trelleborg',
            'password' => 'market',
            'username' => 'LillaFisken',
        ]);
        $user->save();

        $user = $this->generateUser([
            'id' => 3,
            'name' => 'Oskar2',
            'email' => 'oskar2@example.com',
            'password' => 'market',
            'username' => 'LillaFisken2',
        ]);
        $user->save();

        $user = $this->generateUser([
            'id' => 4,
            'name' => 'example',
            'email' => 'example@example.com',
            'password' => 'market',
            'username' => 'example user',
        ]);
        $user->save();

        $limit = 8 * config('market.seedFactor');
        for ($i = 0; $i < $limit; $i++) {
            $user = $this->generateUser();
            if(User::where('username', $user->username)->first() == null)
            {
                $user->save();
                $this->command->info($i+1 . ' users auto seeded');
            }
            else
            {
                $this->command->info('Users already exist');
            }
        }
    }

    private function generateUser($options = [])
    {
        $user = new \market\models\User();
        $faker = Faker\Factory::create('sv_SE');
//        \Illuminate\Support\Facades\Log::debug($options);

        //id	bigint(20) unsigned Auto Increment
        $user->id = isset($options['id']) ? $options['id'] : null;

        //name	varchar(255)
        $user->name = isset($options['name']) ? $options['name'] : $faker->name;

        //username	varchar(255)
        $user->username = isset($options['username']) ? $options['username'] : $faker->userName;

        //email	varchar(255)
        $user->email = isset($options['email']) ? $options['email'] : $faker->email;

        //password	varchar(120)
        $user->password = Hash::make(isset($options['password']) ? $options['password'] : $faker->password);

        //street	varchar(255)
        $user->street = isset($options['street']) ? $options['street'] : $faker->streetAddress;

        //city	varchar(255)
        $user->city = isset($options['city']) ? $options['city'] : $faker->city;

        //zip	int(11)
        $user->zip = isset($options['zip']) ? $options['zip'] : $faker->postcode;

        //phone1	varchar(255)
        $user->phone1 = isset($options['phone1']) ? $options['phone1'] : $faker->phoneNumber;

        //presentation	text NULL
        $user->presentation = isset($options['presentation']) ? $options['presentation'] : $faker->sentences(rand(0, 30), true);

        //phoneAllowed	tinyint(1) [1]
        $user->phoneAllowed = isset($options['phoneAllowed']) ? $options['phoneAllowed'] : $faker->boolean(80);

        //emailAllowed	tinyint(1) [1]
        $user->emailAllowed = isset($options['emailAllowed']) ? $options['emailAllowed'] : $faker->boolean(80);

        //cityAllowed	tinyint(1) [1]
        $user->cityAllowed = isset($options['cityAllowed']) ? $options['cityAllowed'] : $faker->boolean(80);

        //mailNewPm	tinyint(1) [1]
        $user->mailNewPm = isset($options['mailNewPm']) ? $options['mailNewPm'] : $faker->boolean(80);

        //mailNewBidMyAuction	tinyint(1) [1]
        $user->mailNewBidMyAuction = isset($options['mailNewBidMyAuction']) ? $options['mailNewBidMyAuction'] : $faker->boolean(80);

        //mailMyAuctionEnded	tinyint(1) [1]
        $user->mailMyAuctionEnded = isset($options['mailMyAuctionEnded']) ? $options['mailMyAuctionEnded'] : $faker->boolean(80);

        //mailAuctionWatched	tinyint(1) [1]
        $user->mailAuctionWatched = isset($options['mailAuctionWatched']) ? $options['mailAuctionWatched'] : $faker->boolean(80);

        //mailMarketEnded	tinyint(1) [1]
        $user->mailMarketEnded = isset($options['mailMarketEnded']) ? $options['mailMarketEnded'] : $faker->boolean(80);

        //remember_token	varchar(100) NULL
        //$user->email = isset($options['email']) ? $options['email'] : $faker->email;

        //created_at	timestamp [0000-00-00 00:00:00]
        $user->created_at = isset($options['created_at']) ? $options['created_at'] : $faker->dateTime;

        //updated_at	timestamp [0000-00-00 00:00:00]
        $user->updated_at = isset($options['updated_at']) ? $options['updated_at'] : $user->created_at;

        //deleted_at	timestamp NULL
        //isset($options['name']) ? $user->id = $options['name'] : $faker->name;

        return $user;
    }
}


