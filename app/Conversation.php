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
}