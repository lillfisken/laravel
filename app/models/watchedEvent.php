<?php namespace market\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class watchedEvent extends Model {

    use SoftDeletes;

    protected $table = 'watched_events';

    protected $fillable = [
        'market',
        'user',
        'id',
        'read',
        'message'
    ];

    public function watchers()
    {
        return $this->belongsTo('market\models\watched', 'id', 'watched');
    }
}
