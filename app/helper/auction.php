<?php namespace market\helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use market\Market as MarketModel;
use market\User;

/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-06-17
 * Time: 22:15
 */

class auction extends market
{
    var $routeBase = 'auction';

    //region Create

    public function saveFromCreateForm($input)
    {
//        images::saveImages($input, true);
//        $input = text::marketFromBbToHtml($input);
//
//        $this->clearSession();
//
//        return marketCRUD::save($input, 'auction.show');

        $input = text::marketFromBbToHtml($input);
        $input = images::saveImages($input, true);

        $market = new MarketModel($input);
        $market['createdByUser'] = Auth::id();

        $this->save($market);

        return redirect()->route($this->routeBase . '.show', ['id' => $market->id]);

    }

    public function saveFromCreatePreview($input)
    {
        $auction = $this->getAuctionFromSession(false);

        $this->save($auction);
//        $auction->save();

        $this->clearSession();

        return redirect()->route('auction.show', ['id' => $auction->id]);
    }

    public function previewFromCreateForm($input)
    {
        $input = images::saveImages($input);

        $auction = new MarketModel($input);
        $auction->user = Auth::user();

//        dd($auction, $input);

        $this->putAuctionInSession($auction);

        return view('markets.auction.show' , [
            'type' => 'create',
            'preview' => true,
            'callbackRoute' => 'auction.store',
            'market' => $auction,
            'bidCount' => 0,
            'bidHighest' => 0,
            'yourBid' => 0,
            'buttons' => [
                'save' => [
                    'title' => 'Publicera',
                    'name' => 'saveFromPreview'
                ],
                'preview' => [
                    'title' => 'Redigera',
                    'name' => 'editFromPreview'
                ]
            ],
        ]);
    }

    public function editFromCreatePreview()
    {
        $auction = $this->getAuctionFromSession();

        return view('markets.auction.create', [
            'title'=>'Ny auktion',
            'callbackRoute' => 'auction.create',
            'marketType' => '4',
            'model' => $auction,
            'buttons' => [
                'save' => [
                    'title' => 'Publicera',
                    'name' => 'save'
                ],
                'preview' => [
                    'title' => 'Förhandsgranska',
                    'name' => 'previewFromCreateForm'
                ]
            ],
        ]);
    }

    //endregion

    //region Update
    public function editFromStart($id)
    {
        Log::debug('editFromStart');

        $auction = MarketModel::find($id);
        if(!$auction) { abort(404); }

        self::putAuctionDataInSession($id, $auction['createdByUser']);

        return view('markets.auction.create', [
//            'type' => 'edit',
            'title'=> 'Redigera ' . $auction['title'],
            'callbackRoute' => 'auction.update.store',
            'marketType' => '4',
            'model' => $auction,
            'buttons' => [
                'save' => [
                    'title' => 'Publicera',
                    'name' => 'save'
                ],
                'preview' => [
                    'title' => 'Förhandsgranska',
                    'name' => 'previewFromEditForm'
                ]
            ],
        ]);
    }

    public function saveFromEditForm($input)
    {
        Log::debug('saveFromEditForm');
//        TODO: Something wrong here...
//        images::saveImages($input, true);


        Log::debug('saveFromEditForm ->  marketCRUD::update');
        //GET ID FROM SESSION?
//        marketCRUD::update($auctionData['id'], $input);
        $input = text::marketFromBbToHtml($input);
        $auctionData = $this->getAuctionDataFromSession();

        //TODO: Save images
        $input = images::saveImages($input, true);

        $market = new MarketModel($input);
        $market->createdByUser = $auctionData['createdByUser'];
        $market->id = $auctionData['id'];

        $this->update($market);

        $this->clearSession();

        return redirect()->route('auction.show', $auctionData['id']);
    }

    public function previewFromEditForm($input)
    {
        $input = images::saveImages($input);

        $auction = new MarketModel(text::marketFromBbToHtml($input));
        $auction->user = Auth::user();

        $auctionData = $this->getAuctionDataFromSession();
        $this->putAuctionInSession($auction, $auctionData['id'], $auctionData['createdByUser']);

        //Todo: (Bids/preview, not needed, not able to edit after first bid)

        return view('markets.auction.show' , [
            'type' => 'edit',
            'preview' => true,
            'callbackRoute' => 'auction.update.store',
            'market' => $auction,
            'bidCount' => 0,
            'bidHighest' => 0,
            'yourBid' => 0,
            'buttons' => [
                'save' => [
                    'title' => 'Publicera',
                    'name' => 'saveFromPreview'
                ],
                'preview' => [
                    'title' => 'Redigera',
                    'name' => 'editFromPreview'
                ]
            ],
        ]);
    }

    public function saveFromEditPreview()
    {
        $auction = $this->getAuctionFromSession(false);

        //TODO: Is this saving or updating, SAVING; CREATING NEW!!!!?
//        $auction->save();

        $this->update($auction);
        $this->clearSession();

        return redirect()->route('auction.show', ['id' => $auction->id]);
    }

    public function editFromEditPreview()
    {
        $auction = $this->getAuctionFromSession();
        $this->putAuctionDataInSession($auction->id, $auction->createdByUser);

        return view('markets.auction.create', [
//            'type' => 'edit',
            'title'=> 'Redigera ' . $auction->title,
            'callbackRoute' => 'auction.update.store',
            'marketType' => '4',
            'model' => $auction,
            'buttons' => [
                'save' => [
                    'title' => 'Publicera',
                    'name' => 'save'
                ],
                'preview' => [
                    'title' => 'Förhandsgranska',
                    'name' => 'previewFromEditForm'
                ]
            ],
        ]);
    }
    //endregion

    //region Session
    private function getAuctionFromSession($withUser = true)
    {
        $auctionArray = json_decode(Session::get('auction'), true);

        if(!$auctionArray) { abort(403); } //Abort if auction is not in session
        $auction = new MarketModel($auctionArray);

        if($withUser)
        {
            $user = new User($auctionArray['user']);
            $user->exists = true;
            $auction->user = $user;
        }

        $auction->createdByUser = $auctionArray['user']['id'];
        $auctionData = $this->getAuctionDataFromSession();
//        dd($auction, $auctionData);
        if($auctionData && $auctionData['id'] != 0)
        {
            $auction->id = $auctionData['id'];
            $auction->exists = true;
        }

        return $auction;
    }

    private function putAuctionInSession($auction, $id=null, $createdByUser=null)
    {
        Session::put('auction', $auction);

//        dd('putAUctionInSession', $auction, $id, $createdByUser);

        if($id!=null && $createdByUser!=null)
        {
            $this->putAuctionDataInSession($id,$createdByUser);
        }
        else
        {
            $this->putAuctionDataInSession(0, Auth::id());
        }
    }

    /**
     *     Return array vith auction data
     */
    private function getAuctionDataFromSession()
    {
        $auctionData = json_decode(Session::get('auctionData'), true);
        if(!$auctionData) { abort(403); } //Abort if auction is not in session

        return $auctionData;
    }

    private function putAuctionDataInSession($id, $createdByUser)
    {
//        dd('putAuctionDataInSession', $id, $createdByUser);
        Session::put('auctionData', json_encode(['id'=> $id, 'createdByUser' => $createdByUser]));
    }

    private function clearSession()
    {
        Session::forget('auction');
        Session::forget('auctionData');
    }

    //endregion

    //region CRUD

    protected function save($market)
    {
        return $market->save();
    }

    protected function update($market)
    {
        if(isset($market->createdByUser) &&
            isset($market->id) &&
            $market->id > 0)
        {
            $market->exists = true;
            return $market->save();
        }

        abort(400);
    }

    public function delete($id)
    {

    }

    public function deletePost()
    {

    }

    //endregion
}