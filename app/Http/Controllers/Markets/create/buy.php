<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 23:54
 */

namespace market\Http\Controllers\Markets\create;

use market\core\market\create\buy as buyCreate;
use market\core\market\marketType;
use market\core\text;
use market\Http\Controllers\Controller;
use market\Http\Requests\market\create\buy as buyRequest;

class buy extends Controller
{
    use base;

    protected $iMarketCreate;

    public function __construct(buyCreate $buy)
    {
        $this->iMarketCreate = $buy;
    }

    public function showCreateForm()
    {
        return $this->baseShowCreateForm($this->iMarketCreate);
    }

    public function previewFromForm(buyRequest $request, text $text, marketType $marketType)
    {
        return $this->basePreviewFromForm($request, $this->iMarketCreate, $text, $marketType);
    }

    public function createFormFromPreview()
    {
        return $this->baseCreateFormFromPreview($this->iMarketCreate);
    }

    public function createFromForm(buyRequest $request, text $text)
    {
        return $this->baseCreateFromForm($request, $text, $this->iMarketCreate);
    }

    public function createFromPreview()
    {
        return $this->baseCreateFromPreview($this->iMarketCreate);
    }
}