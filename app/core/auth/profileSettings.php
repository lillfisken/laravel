<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-24
 * Time: 23:23
 */

namespace market\core\auth;


class profileSettings
{
    public function setCheckboxesOptions($input)
    {
        $checkboxes = [
            'mailNewPm',
            'mailNewBidMyAuction',
            'mailMyAuctionEnded',
            'mailAuctionWatched',
            'mailMarketEnded'
        ];

//        dd($input);

        foreach($checkboxes as $checkbox)
        {
            if(!isset($input[$checkbox]) || $input[$checkbox] != 1)
            {
                $input[$checkbox] = 0;
            }
        }

        return $input;
    }
}