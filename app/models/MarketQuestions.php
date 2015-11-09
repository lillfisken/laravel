<?php namespace market\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use market\helper\mailer;


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
//        dd($this->belongsTo('market\User', 'user', 'id')->get());
        //dd($this->belongsTo('market\User'));
//        return $this->belongsTo('market\User', 'user');
        return $this->belongsTo('market\models\User', 'createdByUser');

//        return $this->belongsTo('market\User', 'createdByUser', 'id');
    }

    public function getMarket()
    {
        return $this->belongsTo('market\models\Market', 'market');
    }

    public function save(array $options = array())
    {
        parent::save($options);

        $mailer = new mailer();
        $mailer->sendMailNewQuestionAsked($this);
    }
}