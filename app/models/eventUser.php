<?php namespace market\models;

use Illuminate\Database\Eloquent\Model;

class eventUser extends Model {

    //TODO: set read as a date

    public function event()
    {
        return $this->hasOne('market\models\eventMarket', 'id', 'eventId');
    }
}
