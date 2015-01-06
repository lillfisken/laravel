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
		'createdByUser',
		'title', 
		'description', 
		'price',
		//TODO:Fix all fields fillable
		'extra_price_info',
		'number_of_items',
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

	/*
	 * Add navigation for user connected with market
	*/
	public function user()
	{
//		return $this->hasMany('Market');

//		dd(User::find('16'));

		//return User::find('16');

		//dd($this->belongsTo('market\User'));

		return $this->belongsTo('market\User', 'createdByUser');
	}


	
	

}
