<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-24
 * Time: 15:30
 */

namespace market\core;


use Illuminate\Http\Request;

class urlParam
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get($param)
    {
        return $this->request->get($param);
    }

    public function all()
    {
        return $this->request->all();
    }

    public function exist($param)
    {
        return $this->request->has($param);
    }

    public function isTrue($param)
    {
        return $this->exist($param) && $this->get($param) == true;
    }
}
