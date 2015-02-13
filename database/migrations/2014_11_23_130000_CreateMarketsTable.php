<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('markets', function(Blueprint $table)
		{
			$table->bigIncrements('id');
			$table->bigInteger('createdByUser')->default(1);
			$table->string('title');
            $table->integer('marketType');
			$table->text('description');
			$table->float('price');
			$table->text('extra_price_info')->nullable();
			$table->integer('number_of_items')->default(1);
			$table->string('contact_options');
			
			$table->string('image1_thumb')->nullable();
			$table->string('image1_std')->nullable();
			$table->string('image1_full')->nullable();
			
			$table->string('image2_thumb')->nullable();
			$table->string('image2_std')->nullable();
			$table->string('image2_full')->nullable();
			
			$table->string('image3_thumb')->nullable();
			$table->string('image3_std')->nullable();
			$table->string('image3_full')->nullable();
			
			$table->string('image4_thumb')->nullable();
			$table->string('image4_std')->nullable();
			$table->string('image4_full')->nullable();
			
			$table->string('image5_thumb')->nullable();
			$table->string('image5_std')->nullable();
			$table->string('image5_full')->nullable();
			
			$table->string('image6_thumb')->nullable();
			$table->string('image6_std')->nullable();
			$table->string('image6_full')->nullable();


            $table->boolean('contactMail');
            $table->boolean('contactPhone');
            $table->boolean('contactPm');
            $table->boolean('contactQuestions');

			$table->dateTime('end_at')->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('markets');

    }

}
