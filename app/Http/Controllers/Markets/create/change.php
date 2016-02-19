<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-18
 * Time: 19:30
 */

namespace market\Http\Controllers\Markets\create;


use market\core\market\create\change as changeCreate;
use market\core\market\marketType;
use market\core\text;
use market\Http\Controllers\Controller;
use market\Http\Requests\market\create\change as changeRequest;

class change extends Controller
{
    use base;

    protected $iMarketChange;

    public function __construct(changeCreate $change)
    {
        $this->iMarketChange = $change;
    }

    public function showCreateForm()
    {
        return $this->baseShowCreateForm($this->iMarketChange);
    }

    public function previewFromForm(changeRequest $request, text $text, marketType $marketType)
    {
        return $this->basePreviewFromForm($request, $this->iMarketChange, $text, $marketType);
    }

    public function createFormFromPreview()
    {
        return $this->baseCreateFormFromPreview($this->iMarketChange);
    }

    public function createFromForm(changeRequest $request, text $text)
    {
        return $this->baseCreateFromForm($request, $text, $this->iMarketChange);
    }

    public function createFromPreview()
    {
        return $this->baseCreateFromPreview($this->iMarketChange);
    }
}