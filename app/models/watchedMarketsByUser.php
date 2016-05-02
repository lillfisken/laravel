<?php namespace market\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class watchedMarketsByUser extends Model
{
    protected $table = 'watched_markets_by_users';

    protected $fillable = [
        'user',
        'market'
    ];

    public static function getAllMarketIdsWatchedByUserId($userId)
    {
        $ids = watchedMarketsByUser::select('market')->where('user', $userId)->get();
        $watched_array = [];
        foreach ($ids as $id) {
            $watched_array[] = $id['market'];
        }

        return $watched_array;
    }

    public function User()
    {
        return $this->belongsTo('\market\models\User', 'user', 'id');
    }

    public function Market()
    {
        return $this->belongsTo('\market\models\Market', 'market', 'id')->withTrashed();
    }
}
