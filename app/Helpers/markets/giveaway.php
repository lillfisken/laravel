<?php namespace market\helper\markets;

class giveaway extends MarketBase
{
    protected $routeBase = 'giveaway';
    protected $marketType = 3;
    protected $titleNew = 'Ny bortskänkesannons';

    public function __construct()
    {
        $this->rules['price'] = 'not_in';
    }

}