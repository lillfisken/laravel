<?php namespace market\models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
//use Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'presentation',
        'phone1',
        'phoneAllowed',
        'email',
        'emailAllowed',
        'name',
        'street',
        'zip',
        'city',
        'cityAllowed',
		'password',

        'mailNewPm',
        'mailNewBidMyAuction',
        'mailMyAuctionEnded',
        'mailAuctionWatched',
        'mailMarketEnded'
    ];
	
	/**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

	public function markets()
	{
		return $this->hasMany('market\models\Market', 'createdByUser', 'id');
	}

    public function bids()
    {
        return $this->hasMany('market\models\Bid', 'bidder', 'id');
    }

    public function phpBBUsers()
    {
        return $this->hasMany('market\models\phpBBUsers', 'user', 'id');
    }

	public function getUserActiveMarketsCount()
	{
		return Market::where('createdByUser', '=' , $this->id)->count();
	}

	public function getUserTotalMarketsCount()
	{
		return Market::withTrashed()->where('createdByUser', '=' , $this->id)->count();
	}

	public function marketQuestions()
	{
		return $this->hasMany('market\models\MarketQuestion', 'user', 'id');
	}

	public function blockedUsers()
	{
		return $this->hasMany('\market\models\blockedUser', 'blockingUserId', 'id');
	}
}
