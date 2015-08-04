<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder::class');
        $this->call('UserTableSeeder::class');
        $this->call('MarketsTableSeeder::class');
        $this->call('QuestionTableSeeder::class');
        $this->call('ConversationTableSeeder::class');
        $this->call('MessageTableSeeder::class');
        $this->call('BidTableSeeder::class');

        Model::reguard();
    }
}
