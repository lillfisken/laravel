<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 23:54
 */

namespace market\Http\Controllers\Markets\create;

use market\core\market\create\sell as createSell;
use market\core\market\marketType;
use market\core\text;
use market\Http\Controllers\Controller;
use market\Http\Requests\market\create\sell as sellRequest;

class sell extends Controller
{
    use base;

    protected $iMarketCreate;

    public function __construct(createSell $sell)
    {
        $this->iMarketCreate = $sell;
    }

    public function showCreateForm()
    {
        return $this->baseShowCreateForm($this->iMarketCreate);
    }

    public function previewFromForm(sellRequest $request, text $text, marketType $marketType)
    {
        return $this->basePreviewFromForm($request, $this->iMarketCreate, $text, $marketType);
    }

    public function createFormFromPreview()
    {
        return $this->baseCreateFormFromPreview($this->iMarketCreate);
    }

    public function createFromForm(sellRequest $request, text $text)
    {
        return $this->baseCreateFromForm($request, $text, $this->iMarketCreate);
    }

    public function createFromPreview()
    {
        return $this->baseCreateFromPreview($this->iMarketCreate);
    }
}