<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-10-03
 * Time: 19:47
 */

namespace market\helper\markets;


class common {

    //region Market Type
    private $marketTypes = [
        '0' => 'Säljes',
        '1' => 'Köpes',
        '2' => 'Bytes',
        '3' => 'Skänkes',
        '4' => 'Auktion',
    ];

    public function getAllMarketTypes()
    {
        return $this->marketTypes;
    }

    public function getMarketTypeName($number)
    {
        if($this->marketTypes[$number] != null)
        {
            return $this->marketTypes[$number];
        }
        else
        {
            abort('404', 'Number is not a market type');
        }
    }

    //endregion
}