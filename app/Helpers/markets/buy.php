<?php namespace market\helper\markets;

class buy extends MarketBase
{
    protected $routeBase = 'buy';
    protected $marketType = 1;
    protected $titleNew = 'Ny köpesannons';

    public function __construct()
    {
//        $this->rules['price'] = 'numeric|min:0';
        parent::__construct();
    }
}