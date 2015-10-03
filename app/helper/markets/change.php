<?php namespace market\helper\markets;

class change extends MarketBase
{
    protected $routeBase = 'change';
    protected $marketType = 2;
    protected $titleNew = 'Ny bytesannons';

    public function __construct()
    {
        parent::__construct();
        $this->rules['price'] = 'not_in';
    }
}