<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-03-19
 * Time: 18:00
 */

namespace market\Http\Controllers\Markets\delete;


use Illuminate\Http\Request;
use market\core\session\sessionUrl;
use market\Http\Controllers\Controller;
use market\Http\Requests\market\delete\sell as sellRequest;

class sell extends Controller
{
    use base;

    public function __construct()
    {
        $this->routeBase = 'sell'; //TODO: move to ???
        $this->endReasons = ['0' => '', '10' => '', '20' => '', '30' => '', '40' => '' ];
        //        '0' => 'Såld',
        //        '10' => 'Bortskänkt',
        //        '20' => 'Slängd',
        //        '30' => 'Återtagen från försäljning',
        //        '40' => 'Övrigt'
    }

    public function destroyGet($marketId, sessionUrl $url)
    {
        return $this->baseDestroyGet($marketId, $url);
    }

    public function destroyPost(sellRequest $request, sessionUrl $url)
    {
        return $this->baseDestroyPost($request, $url);
    }
}