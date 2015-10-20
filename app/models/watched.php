<?php namespace market\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class watched extends Model {

    use SoftDeletes;

    protected $table = 'watcheds';

    protected $fillable = [
        'market',
        'user'
    ];

    public function user()
    {
        return $this->belongsTo('User', 'id', 'user');
    }

    public function market()
    {
        return $this->belongsTo('Market', 'id', 'market');
    }

    public function events()
    {
        return $this->hasMany('watchedEvent', ['market', 'user'], ['market', 'user']);
    }

    public static function getAllMarketIdsWatchedByUserId($userid = null)
    {
        $watched = watched::where('user', ($userid == null ? Auth::id() : $userid))->get(['market']);
        $watched_array = [];
        foreach($watched as $watch)
        {
            $watched_array[] = $watch['market'];
        }

        return $watched_array;
    }
}
