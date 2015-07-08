<?php namespace market;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
        return $this->belongsTo('market\User', 'bidder');
    }

    public function market()
    {
        return $this->belongsTo('market\Market');
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
}
