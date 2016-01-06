<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-03
 * Time: 01:31
 */

namespace market\Http\Controllers\Markets;

use Chromabits\Purifier\Purifier;
use market\Http\Controllers\Controller;
use Illuminate\Http\Request;

abstract class baseUpdateController extends Controller
{
    //TODO: Move market helper to core, create interface
    //TODO: Move validation to request
    //TODO: Move purifing to request

    protected $marketHelper;

    public function showUpdateForm($id)
    {
        //TODO: Authorize, only your own
        return $this->marketHelper->editFromStart($id);
    }

    public function updateFromForm(Request $request, Purifier $purifier)
    {
        $input = $request->all();
        $validation = $this->marketHelper->validate($request);
        if($validation != null)
        {
            return $validation;
        }

        return $this->marketHelper->saveFromEditForm($input);
    }

    public function updateFromPreview(Request $request, Purifier $purifier)
    {
        return $this->marketHelper->saveFromEditPreview();
    }

    public function previewFromForm(Request $request, Purifier $purifier)
    {
        $input = $request->all();
        //Todo: Purify

        $validation = $this->marketHelper->validate($request);
        if($validation != null)
        {
            return $validation;
        }

        return $this->marketHelper->previewFromEditForm($input);
    }

    public function updateFormFromPreview()
    {
        return $this->marketHelper->editFromEditPreview();
    }
}