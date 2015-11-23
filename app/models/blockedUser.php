<?php namespace market\models;

use Illuminate\Database\Eloquent\Model;

class blockedUser extends Model {

    protected $table = 'blocked_users';

	protected $fillable = [
        'blockingUserId',
        'blockedUserId'
    ];

    public function blockedUser()
    {
        return $this->hasOne('market\models\User', 'id', 'blockedUserId');
    }
}
