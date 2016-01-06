<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-03
 * Time: 01:43
 */

namespace market\Http\Controllers\Markets;


use market\Http\Controllers\Controller;

abstract class baseReadController extends Controller
{
    protected $marketHelper;

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->marketHelper->show($id);
    }
}