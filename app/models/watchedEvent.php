<?php namespace market\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class watchedEvent extends Model {

    use SoftDeletes;

    protected $fillable = [
        'market',
        'user',
        'id',
        'read',
        'message'
    ];
}
