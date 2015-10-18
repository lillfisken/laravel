<?php namespace market\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use market\helper\mailer;

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
        return $this->belongsTo('market\models\User', 'senderId');
    }

    public function conversation()
    {
        return $this->belongsTo('market\models\Conversation', 'conversationId');
    }

    public function isRead()
    {
        return $this->getAttribute('read');
    }

    public function save(array $options = [])
    {
        parent::save($options);

        $mailer = new mailer();
        $mailer->sendMailNewPm($this->id);
    }
}
