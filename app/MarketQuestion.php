<?php namespace Market;

class MarketQuestion extends Model
{
    protected $dates = ['deleted_at'];

    protected $table = 'MarketQuestion';

    protected $fillable = [
        'user',
        'market',
        'message'
    ];

    public function user()
    {
        return $this->belongsTo('market\User', 'user');
    }

    public function market()
    {
        return $this->belongsTo('market\Market', 'market');
    }
}