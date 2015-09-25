<?php namespace market;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class phpBBUsers extends Model {

    protected $table = 'phpBBUsers';

    protected $fillable = [
        'forumKey',
        'user',
        'username'
    ];
    //TODO: Add link to profile

    public function user()
    {
        return $this->belongsTo('market\User', 'user');
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
            ->where('user', '=', $this->user)
            ->where('forumKey', '=', $this->forumKey);

        return $query;
    }
}
