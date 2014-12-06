<?php namespace market;

use Illuminate\Database\Eloquent\Model;

class Market extends Model {
	
	/*
	id
	createdByUser
	title
	type
	description
	price
	extraPriceInfo
	numberOfItems
	contactOptions
	image1_thumb
	image1_std
	image1_full
	image2_thumb
	image2_std
	image2_full
	image3_thumb
	image3_std
	image3_full
	image4_thumb
	image4_std
	image4_full
	image5_thumb
	image5_std
	image5_full
	image6_thumb
	image6_std
	image6_full
	
	endAt
	created_at
	update_at
	deleted_at
	*/
	
	protected $table = 'markets';

	protected $fillable = [
		'title', 
		'description', 
		'price', 
		'extraPriceInfo',
		'numberOfItems',
		/*'contactOptions',*/
		'image1_small',
		'image1_thumb',
		'image1_std',
		'image1_full',
		'image2_thumb',
		'image2_std',
		'image2_full',
		'image3_thumb',
		'image3_std',
		'image3_full',
		'image4_thumb',
		'image4_std',
		'image4_full',
		'image5_thumb',
		'image5_std',
		'image5_full',
		'image6_thumb',
		'image6_std',
		'image6_full',
	];
	
	

}
