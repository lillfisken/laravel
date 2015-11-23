<?php namespace market\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class blockedMarket extends Model {

//	use SoftDeletes;

    protected $fillable = [
        'marketId',
        'userId'
    ];

}
