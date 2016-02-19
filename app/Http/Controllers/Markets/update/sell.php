<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 23:47
 */

namespace market\Http\Controllers\Markets\update;


use Illuminate\Http\Request;
use market\core\market\marketType;
use market\core\market\update\sell as updateSell;
use market\Http\Controllers\Controller;

class sell extends Controller
{
    use base;

    protected $marketHelper;
    protected $marketType;

    public function __construct(updateSell $sell, marketType $marketType)
    {
        $this->marketHelper = $sell;
        $this->marketType = $marketType;
    }

    public function showUpdateForm(Request $request, $id)
    {
        //TODO: Authorize, only your own
        return $this->baseShowUpdateForm($id, $this->marketHelper);
    }

    public function updateFromForm(Request $request)
    {
        //TODO: validate request
        return $this->baseUpdateFromForm($request, $this->marketHelper);
    }

    public function updateFromPreview()
    {
        return $this->baseUpdateFromPreview($this->marketHelper);
    }

    public function previewFromForm(Request $request)
    {
        //TODO: Validate request
        return $this->basePreviewFromForm($request, $this->marketHelper, $this->marketType);
    }

    public function updateFormFromPreview()
    {
        return $this->baseUpdateFormFromPreview($this->marketHelper);
    }
}