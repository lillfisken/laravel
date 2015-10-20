<?php namespace market\helper\markets;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use market\helper\marketMenu;
use market\helper\time;
use market\models\Market as MarketModel;
use market\models\User;
use market\helper\images;
use market\helper\text;

/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2015-06-17
 * Time: 22:15
 */

abstract class MarketBase
{
    protected $marketCommon;
    protected $time;
    protected $marketMenu;

    public function __construct()
    {
        $this->marketCommon = new common();
        $this->time = new time();
        $this->marketMenu = new marketMenu();
    }

    //region Create

    public function saveFromCreateForm($input)
    {
//        images::saveImages($input, true);
//        $input = text::marketFromBbToHtml($input);
//
//        $this->clearSession();
//
//        return marketCRUD::save($input, 'auction.show');
//        dd('saveFromCreateForm', $input);
        if(isset($input['end_at']))
        {
            $set = true;
            $parsedTime = $this->time->parseTimeAndDateFromStringToUnix($input['end_at']);
            $input['end_at'] = $this->time->parseTimeAndDateFromStringToUnix($input['end_at']);
//            $input['end_at'] = $this->time->parseTimeAndDateFromStringToUnix($input['end_at']);
//            dd('marketBase', $input['end_at'], $this->time->parseTimeAndDateFromStringToUnix($input['end_at']));
        }

        $input = text::marketFromBbToHtml($input);
//        dd('saveFromCreateForm, after marketFromBbToHtml', $input);

        $input = images::saveImages($input, true);
//        dd('saveFromCreateForm, after saveImages', $input);

        $market = new MarketModel($input);
        $market['createdByUser'] = Auth::id();

//        if(isset($market->end_at))
//        {
//            $set = true;
//            $parsedTime = $this->time->parseTimeAndDateFromStringToUnix($market->end_at);
//            $market->end_at = $this->time->parseTimeAndDateFromStringToUnix($market->end_at);
////            $input['end_at'] = $this->time->parseTimeAndDateFromStringToUnix($input['end_at']);
////            dd('marketBase', $input['end_at'], $this->time->parseTimeAndDateFromStringToUnix($input['end_at']));
//        }

//        dd($market, isset($market->end_at));


//        dd($market, $this->routeBase);
        $this->save($market);

//        dd($set, $parsedTime, $market);
//        dd($input, $market);

//        dd($market, $this->routeBase, $market->id);


        return redirect()->route( $this->routeBase . '.show', ['id' => $market->id]);

    }

    public function saveFromCreatePreview($input)
    {
        $auction = $this->getAuctionFromSession(false);

        $this->save($auction);
//        $auction->save();

        $this->clearSession();

        return redirect()->route($this->routeBase . '.show', ['id' => $auction->id]);
    }

    public function previewFromCreateForm($input)
    {
        $input = images::saveImages($input);

        $auction = new MarketModel($input);
        $auction->user = Auth::user();

//        dd($auction, $input);

        $this->putAuctionInSession($auction);

        return view('markets.' . $this->routeBase . '.show' , [
            'type' => 'create',
            'preview' => true,
            'callbackRoute' => $this->routeBase . '.store',
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

        return view('markets.' . $this->routeBase . '.create', [
            'title'=>'Titel saknas',
            'callbackRoute' => $this->routeBase . '.create',
            'marketType' => $this->marketType,
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

    protected function save($market)
    {
        return $market->save();
    }

    //endregion

    //region Read

    public function show($id)
    {
        $market = MarketModel::withTrashed()->with(['bids.user'])->where('id','=',$id)->first();

        // If auction exist and is of type auction
        if($market != null)
        {
            //TODO: Add market menu
            $this->addMarketMenu($market);

//            helper\auction::addMarketMenu($auction, )
//            marketCRUD::addMarketMenu($auction);
//            marketHelper::addMarketMenuAuction($auction);
            //$this->auctionHelper->addMarketMenuPerType($auction);

            return view('markets.' . $this->routeBase .'.show', [
                'market'=>$market,
                'marketCommon' => $this->marketCommon,
            ]);
        }
        else
        {
            dd('Null or not auction');
            abort(404);
        }
    }

    //endregion

    //region Update
    public function editFromStart($id)
    {
        Log::debug('editFromStart');

        $auction = MarketModel::find($id);
        if(!$auction) { abort(404); }
//        dd($auction);
        if($auction->createdByUser != Auth::id()) {abort(403);}

        $this->putAuctionDataInSession($id, $auction['createdByUser']);

        return view('markets.' . $this->routeBase . '.create', [
//            'type' => 'edit',
            'title'=> 'Redigera ' . $auction['title'],
            'callbackRoute' => $this->routeBase . '.update.store',
            'marketType' => $this->marketType,
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
        $input = text::marketFromBbToHtml($input);
        $auctionData = $this->getAuctionDataFromSession();

        $input = images::saveImages($input, true);

        $market = new MarketModel($input);
        $market->createdByUser = $auctionData['createdByUser'];
        $market->id = $auctionData['id'];

        $this->update($market);

        $this->clearSession();

        return redirect()->route($this->routeBase . '.show', $auctionData['id']);
    }

    public function previewFromEditForm($input)
    {
        $input = images::saveImages($input);

        $auction = new MarketModel(text::marketFromBbToHtml($input));
        $auction->user = Auth::user();

        $auctionData = $this->getAuctionDataFromSession();
        $this->putAuctionInSession($auction, $auctionData['id'], $auctionData['createdByUser']);

        //Todo: (Bids/preview, not needed, not able to edit after first bid)

        return view('markets.' . $this->routeBase . '.show' , [
            'type' => 'edit',
            'preview' => true,
            'callbackRoute' => $this->routeBase . '.update.store',
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

        return redirect()->route($this->routeBase . '.show', ['id' => $auction->id]);
    }

    public function editFromEditPreview()
    {
        $auction = $this->getAuctionFromSession();
        $this->putAuctionDataInSession($auction->id, $auction->createdByUser);

        return view('markets.' . $this->routeBase . '.create', [
//            'type' => 'edit',
            'title'=> 'Redigera ' . $auction->title,
            'callbackRoute' => $this->routeBase . '.update.store',
            'marketType' => $this->marketType,
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
    //endregion

    //region Delete

    public function deleteGet($id)
    {
        Session::put('uri', Session::get('_previous'));

//        $reasons = marketEndReason::getAllTypes();
        $reasons = $this->getAllEndReasons();
//        $reasons = ['Varan såld' => 'Varan såld', 'Övrigt' => 'Övrigt'];

        $market = MarketModel::find($id);

        return view('markets.base.delete', [
            'market' => $market,
            'reasons' => $reasons,
            'callBackRoute' => $this->routeBase . '.destroy.post']);
    }

    public function deletePost()
    {
//TODO:
//        dd('deleteing market in marketAuctionController');
        $id = Input::get('market');
        $market = MarketModel::where('id', '=', $id)->firstorfail();
        //dd(Input::all());

        $market['endReason'] = Input::get('reason');
        $market['deleted_at'] = new DateTime();
        $market->save();

        $uri = Session::get('uri');
//        dd($uri);

        if(isset($uri))
        {
            //dd($uri);
            if(isset($uri['url']))
            {
                //dd($uri['url']);
                return redirect($uri['url']);
            }
            return redirect()->route('markets.index');
            //return URL::to($uri);

            //return redirect('markets/public');
        }
        else
        {
            return redirect()->route('markets.index');
        }

    }

    //endregion

    //region Session
    protected function getAuctionFromSession($withUser = true)
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

    protected function putAuctionInSession($auction, $id=null, $createdByUser=null)
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
    protected function getAuctionDataFromSession()
    {
        $auctionData = json_decode(Session::get('auctionData'), true);
        if(!$auctionData) { abort(403); } //Abort if auction is not in session

        return $auctionData;
    }

    protected function putAuctionDataInSession($id, $createdByUser)
    {
//        dd('putAuctionDataInSession', $id, $createdByUser);
        Session::put('auctionData', json_encode(['id'=> $id, 'createdByUser' => $createdByUser]));
    }

    protected function clearSession()
    {
        Session::forget('auction');
        Session::forget('auctionData');
    }

    //endregion

    //region Validate
    protected $rules = [
        'title' => 'required|min:3',
        'price' => 'required|numeric|min:0',
        'description' => 'required|min:5',
        'contactPm' => 'boolean',
        'contactPhone' => 'boolean',
        'contactMail' => 'boolean',
        'contactQuestions' => 'boolean',
    ];
    protected $messages = [
        'price.min' => 'Priset måste vara över 0',
        'required' => ':attribute är obligatoriskt.',
        'numeric' => ':attribute får bara innehålla ett tal (decimal med &#39.&#39)',
        'min' => ':attribute måste innehålla minst :min bokstäver'
    ];
    protected $attributes = [
        'title' => 'Rubrik',
        'price' => 'Pris',
        'description' => 'Beskrivning'
    ];

    public function validate(Request $request)
    {
//        return $this->validate($request, [
//           'title' => 'required'
//        ]);

        $validator = Validator::make($request->all(), $this->rules, $this->messages, $this->attributes);

        if ($validator->fails()) {
            Log::debug($validator->errors());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    }
    //endregion

    //region Market menu

    public function addMarketMenu($market)
    {
        $this->marketMenu->addMarketMenu($market);
//        if(Auth::check()) {
//            $id = Auth::id();
//            $temp = array();
//
//            //Adds link to edit market if it's created by logged in user
//            if ($id == $market->createdByUser &&
//                $market->deleted_at == null &&
//                !($market->bids->count() > 0))
//            {
//                    $temp[] = array('text' => 'Redigera ', 'href' => route($this->routeBase . '.update', $market->id ));
//                    $temp[] = array('text' => 'Avslutad', 'href' => route( $this->routeBase . '.destroy.get', $market->id ));
//            }
//
//            if  ($id != $market->createdByUser) {
//                //TODO: Check if market is blocked, then ad link to unblock instead
//                $temp[] = array('text' => 'Dölj annons', 'href' => route('accounts.blockMarket', $market->id));
//                //TODO: Check if market is seller, then ad link to unblock instead
//                $temp[] = array('text' => 'Dölj säljare', 'href' => route('accounts.blockSeller', $market->createdByUser));
//            }
//
//            $market['marketmenu'] = $temp;
////        }
    }

    //endregion

    //region Market end reason
    private static $endreasons = [
        '0' => 'Såld/Skänkt',
        '1' => 'Slängd',
        '2' => 'Återtagen',
        '3' => 'Övrigt'
    ];

    public static function getAllEndReasons()
    {
        return self::$endreasons;
    }

    public static function getEndReasonName($number)
    {
//        if(self::$endreasons[$number] != null)
//        {
//            return self::$endreasons[$number];
//        }
//        else
//        {
//            abort('404', 'Number is not a market end type');
//        }
    }
    //endregion

    //region misc
        public function getRouteBase()
        {
            return $this->routeBase;
        }

        public function getMarketType()
        {
            return $this->marketType;
        }

        public function getTitleNew()
        {
            return $this->titleNew;
        }
    //endregion
}