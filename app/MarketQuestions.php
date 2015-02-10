<?php namespace market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class marketQuestions extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    protected $table = 'marketQuestions';

    protected $fillable = [
        'createdByUser',
        'market',
        'message'
    ];

    public function user()
    {
        //dd($this->belongsTo('market\User'));
//        return $this->belongsTo('market\User', 'user');
        return $this->belongsTo('market\User', 'createdByUser');
    }

    public function market()
    {
        return $this->belongsTo('market\Market', 'market');
    }
}