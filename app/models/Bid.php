<?php namespace market\models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use market\helper\mailer;
use market\helper\watched as watchedHelper;

class Bid extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bids';

//    protected $primaryKey = ['auctionId','bidder'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo('market\models\User', 'bidder');
    }

    public function market()
    {
        return $this->belongsTo('market\models\Market', 'auctionId', 'id');
    }

    /**
     * Set the keys for a save update query.
     * This is a fix for tables with composite keys
     * TODO: Investigate this later on
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery(Builder $query)
    {
        //https://github.com/laravel/framework/issues/5517 2015-06-08

        $query
            //Put appropriate values for your keys here:
            ->where('auctionId', '=', $this->auctionId)
            ->where('bidder', '=', $this->bidder);

        return $query;
    }

    public function save(array $options = array())
    {
        parent::save($options);
//        dd('Bid saved in model');
        $mailer = new mailer();
        $mailer->sendMailNewBidOnMyAuction($this);
        $mailer->sendMailNewBidWatchedAuction($this->id);

        $watched = new watchedHelper();
        $watched->newBid($this);
    }
}
