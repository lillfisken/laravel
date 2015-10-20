<?php namespace market\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use market\helper\mailer;
use market\helper\watched;

class Market extends Model {

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $softDelete = true;

	protected $table = 'markets';

	protected $fillable = [
		'createdByUser',
		'title', 
		'description', 
		'price',
		'extra_price_info',
		'number_of_items',
        'marketType',

//        Contact options
        'contactMail',
        'contactPhone',
        'contactPm',
        'contactQuestions',

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

		'created_at',
		'update_at',
		'deleted_at',
        'end_at',
	];

    public function getDates()
    {
        return ['created_at', 'updated_at', 'deleted_at', 'end_at'];
//        return ['created_at', 'updated_at', 'deleted_at', 'end_at'];
    }

	/*
	 * Add navigation for user connected with market
	*/
	public function user()
	{
//		return $this->hasMany('Market');

//		dd(User::find('16'));

		//return User::find('16');

		//dd($this->belongsTo('market\User'));

		return $this->belongsTo('market\models\User', 'createdByUser');
	}

    public function bids()
    {
        return $this->hasMany('market\models\Bid', 'auctionId', 'id');
//        return $this->hasMany('market\MarketQuestions', 'market', 'id');

    }

	public function marketQuestions()
	{
		return $this->hasMany('market\models\MarketQuestions', 'market', 'id');
	}

    public function watched()
    {
        return $this->hasMany('market\models\watched', ['market', 'user'], ['id', 'createdByUser'] );
    }

    public function delete()
    {
        parent::delete();

        $mailer = new mailer();

        if($this->marketType == 4)
        {
            $mailer->sendMailMyAuctionEnded($this->id);
            $mailer->sendMailToWinnerOfAuction($this->id);
        };
        $mailer->sendMailEndedWatchedMarket($this->id);

        $watched = new watched();
        $watched->marketEnded($this);

    }
	
	

}
