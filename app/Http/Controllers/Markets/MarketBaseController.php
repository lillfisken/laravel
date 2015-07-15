<?php namespace market\Http\Controllers\Markets;

use Chromabits\Purifier\Purifier;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use market\helper\text;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Http\Request;
use market\helper;
use market\Market;

abstract class MarketBaseController extends Controller {

    /**
     * @var Purifier
     */
    protected $purifier;
    protected $marketHelper;

    /**
     * Construct an instance of MyClass
     *
     * @param Purifier $purifier
     */
    public function __construct(Purifier $purifier) {
        // Inject dependencies
        $this->purifier = $purifier;
    }

    //region create

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createForm()
    {
        return view('markets.auction.create', [
//            'type' => 'create',
            'title'=> $this->marketHelper->getTitleNew(),
            'callbackRoute' => $this->marketHelper->getRouteBase() . '.store',
            'marketType' => $this->marketHelper->getMarketType(),
            'model' => null,
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

    public function create(Request $request)
    {
        // Create a new market or show preview for creating a new market

        $input = Input::all();

        //TODO: change to purify auction, add type to request etc...
        $input = text::purifyMarketInput($input, $this->purifier);

        if(isset($input['previewFromCreateForm']))
        {
            return $this->marketHelper->previewFromCreateForm($input);
        }
        elseif(isset($input['editFromPreview']))
        {
            return $this->marketHelper->editFromCreatePreview();
        }
        elseif(isset($input['save']))
        {
            return $this->marketHelper->saveFromCreateForm($input);
        }
        elseif(isset($input['saveFromPreview']))
        {
            return $this->marketHelper->saveFromCreatePreview($input);
        }


        abort(404);
    }

    //endregion

    //region read

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return $this->marketHelper->show($id);
//        $market = Market::withTrashed()->with(['bids.user'])->where('id','=',$id)->first();
//
//        // If auction exist and is of type auction
//        if($market != null)
//        {
//            $this->marketHelper->addMarketMenu($market);
//
//            return view('markets.' . $this->marketHelper->getRouteBase() .'.show', [
//                'market'=>$market,
//            ]);
//        }
//        else
//        {
//            Log::debug('MarketBaseController -> show: Wrong market type');
//
//            abort(404);
//        }
    }

    //endregion

    //region update

    public function updateForm($id)
    {
        return $this->marketHelper->editFromStart($id);
    }

    public function update(Request $request)
    {
        $input = Input::all();

        //TODO: change to purify auction, add type to request etc...
        $input = text::purifyMarketInput($input, $this->purifier);

        if(isset($input['previewFromEditForm']))
        {
            return $this->marketHelper->previewFromEditForm($input);
        }
        elseif(isset($input['save']))
        {
            return $this->marketHelper->saveFromEditForm($input);
        }
        elseif(isset($input['saveFromPreview']))
        {
            return $this->marketHelper->saveFromEditPreview();
        }
        elseif(isset($input['editFromPreview']))
        {
            return $this->marketHelper->editFromEditPreview();
        }

        abort(404);
    }

    //endregion

    //region delete

    /**
     * Remove the specified resource from storage.
     * DELETE /markets/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroyGet($id)
    {
//        Session::put('uri', Session::get('_previous'));
//
////        $reasons = marketEndReason::getAllTypes();
//        $reasons = $this->marketHelper->getAllEndReasons();
////        $reasons = ['Varan såld' => 'Varan såld', 'Övrigt' => 'Övrigt'];
//
//        return view('markets.base.delete', [
//            'market' => $market,
//            'reasons' => $reasons,
//            'callBackRoute' => $this->marketHelper->routeBase . '.destroy.post']);

//        dd('marketbasecontroller destroyGet', $id);
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
    //endregion

}
