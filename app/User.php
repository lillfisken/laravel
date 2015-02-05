<?php namespace market;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Auth;

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
	protected $fillable = ['name', 'email', 'password'];

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

}
