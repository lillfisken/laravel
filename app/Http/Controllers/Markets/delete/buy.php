<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-03-19
 * Time: 23:58
 */

namespace market\Http\Controllers\Markets\delete;


use market\core\session\sessionUrl;
use market\Http\Controllers\Controller;
use market\Http\Requests\market\delete\buy as buyRequest;

class buy extends  Controller
{
    use base;

    public function __construct()
    {
        $this->routeBase = 'buy'; //TODO: move to ???
        $this->endReasons = ['1' => '', '31' => '', '40' => ''];
        //        '0' => 'Såld',
        //        '1' => 'Köpt',
        //        '2' => 'Såld på annat ställe',
        //        '10' => 'Bortskänkt',
        //        '20' => 'Slängd',
        //        '30' => 'Återtagen från försäljning',
        //        '31' => 'Inget behov längre',
        //        '40' => 'Övrigt'
    }

    public function destroyGet($marketId, sessionUrl $url)
    {
        return $this->baseDestroyGet($marketId, $url);
    }

    public function destroyPost(buyRequest $request, sessionUrl $url)
    {
        return $this->baseDestroyPost($request, $url);
    }
}