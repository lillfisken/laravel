<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-07
 * Time: 23:33
 */

namespace market\core\market\create;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use market\core\image;
use market\core\interfaces\iMarketCreate;
use market\core\session;
use market\core\text;
use market\models\Market;

abstract class base implements iMarketCreate
{
    use session;

    protected $text;
    protected $image;

    public function __construct(text $text, image $image)
    {
        $this->text = $text;
        $this->image = $image;
    }

    public function saveFromCreateForm($input)
    {
        $input = $this->text->marketFromBbToHtml($input);

        $input = $this->image->saveImages($input, true);

        $market = new Market($input);
        $market['createdByUser'] = Auth::id();

        $this->save($market);

        return $market;
    }

    public function saveFromCreatePreview()
    {
        $auction = $this->getMArketFromSession(false);

        $this->save($auction);

        $this->clearSession();

        return $auction;
    }

    public function previewFromCreateForm($input)
    {
        //Done 2016-02-08
        $input = $this->image->saveImages($input);
        $auction = new Market($input);
        $auction->user = Auth::user();
        $auction->marketType = $this->getMarketType();

        $this->putAuctionInSession($auction);

        $auction->created_at = new Carbon($auction->created_at);
        $auction->updated_at = new Carbon($auction->updated_at);

        return $auction;
    }

    public function editFromCreatePreview()
    {
        $auction = $this->getMarketFromSession();

        return $auction;
    }

    protected function save($market)
    {
        $market->marketType = $this->getMarketType();
        return $market->save();
    }
}