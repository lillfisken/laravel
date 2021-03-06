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

        $this->call('UserTableSeeder');
        $this->call('MarketsTableSeeder');
        $this->call('QuestionTableSeeder');
        $this->call('ConversationTableSeeder');
        $this->call('MessageTableSeeder');
        $this->call('BidTableSeeder');
        $this->call('MarketEventSeeder');
        $this->call('BlockedMarketSeeder');
        $this->call('BlockedSellerSeeder');
        $this->call('WatchedSeeder');
        $this->call('EventUserSeeder');

        Model::reguard();
    }
}
