<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-03
 * Time: 01:44
 */

namespace market\Http\Controllers\Markets;


use Illuminate\Http\Request;
use market\Http\Controllers\Controller;

abstract class baseDeleteController extends Controller
{
    protected $marketHelper;

    /**
     * Remove the specified resource from storage.
     * DELETE /markets/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyGet($id)
    {
        return $this->marketHelper->deleteGet($id);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /markets/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyPost(Request $request)
    {
        return $this->marketHelper->deletePost();
    }
}