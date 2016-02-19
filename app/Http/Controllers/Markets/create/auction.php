<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-18
 * Time: 21:47
 */

namespace market\Http\Controllers\Markets\create;


use market\core\market\create\auction as auctionCreate;
use market\core\market\marketType;
use market\core\text;
use market\Http\Controllers\Controller;
use market\Http\Requests\market\create\auction as auctionRequest;

class auction extends Controller
{
    use base;

    protected $iMarketCreate;

    public function __construct(auctionCreate $auction)
    {
        $this->iMarketCreate = $auction;
    }

    public function showCreateForm()
    {
        return $this->baseShowCreateForm($this->iMarketCreate);
    }

    public function previewFromForm(auctionRequest $request, text $text, marketType $marketType)
    {
        return $this->basePreviewFromForm($request, $this->iMarketCreate, $text, $marketType);
    }

    public function createFormFromPreview()
    {
        return $this->baseCreateFormFromPreview($this->iMarketCreate);
    }

    public function createFromForm(auctionRequest $request, text $text)
    {
        return $this->baseCreateFromForm($request, $text, $this->iMarketCreate);
    }

    public function createFromPreview()
    {
        return $this->baseCreateFromPreview($this->iMarketCreate);
    }
}