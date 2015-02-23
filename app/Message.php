<?php namespace market;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $softDelete = true;

    protected $table = 'messages';

    protected $fillable = [
//        'sender',
//        'conversationId',
//        'message'
    ];

    /*
     * Add navigation for user connected with market
    */
    public function sender()
    {
        return $this->belongsTo('market\User', 'senderId');
    }

    public function conversation()
    {
        return $this->belongsTo('market\Conversation', 'conversationId');
    }

}
