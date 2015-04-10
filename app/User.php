<?php namespace market;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Auth;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;
    //
    //`id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    //`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    //`username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    //`email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    //`password` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
    //`street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    //`city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
    //`zip` int(11) DEFAULT NULL,
    //`phone1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    //`remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
    //`created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    //`updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
    //`phoneAllowed` tinyint(1) NOT NULL,
    //`emailAllowed` tinyint(1) NOT NULL,
    //`cityAllowed` tinyint(1) NOT NULL,

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
    ];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	public function markets()
	{
		return $this->hasMany('market\Market', 'createdByUser', 'id');
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
		return $this->hasMany('market\MarketQuestion', 'user', 'id');
	}

}
