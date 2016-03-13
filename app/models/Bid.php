<?php namespace market\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use market\core\event\newEvents;
use market\helper\mailer;

class Bid extends Model
{

    protected $newEvents;

    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
        $newEvents = App::make('market\core\event\newEvents');
//        dd($newEvents);
        $this->newEvents = $newEvents;
    }

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bids';

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

    public function save(array $options = array())
    {
        parent::save($options);
        //TODO: fix, is it possible?

        //TODO: queue
        $mailer = new mailer();
        $mailer->sendMailNewBidOnMyAuction($this);
        $mailer->sendMailNewBidWatchedAuction($this->id);

        //TODO: queue
//        $events = new newEvents();
//        $events->newBidAuction($this->id);
        $this->newEvents->newBidAuction($this->id);

//        $watched = new watchedHelper();
//        $watched->newBid($this);
    }
}
