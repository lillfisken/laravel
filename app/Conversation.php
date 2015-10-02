<?php namespace market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Conversation extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    protected $table = 'conversations';

    protected $fillable = [

    ];

    public function messages()
    {
        return $this->hasMany('market\Message', 'conversationId');
    }

    public function getUser1()
    {
        return $this->hasOne('market\User', 'id', 'user1');
    }

    public function getUser2()
    {
        return $this->hasOne('market\User', 'id', 'user2');
    }
}