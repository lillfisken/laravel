<?php namespace market\Http\Controllers\Markets;

use Chromabits\Purifier\Purifier;
use Illuminate\Support\Facades\Input;
use market\helper\text;
use market\Http\Requests;
use market\Http\Controllers\Controller;

use Illuminate\Http\Request;
use market\helper;
use market\Market;


class BuyController extends MarketBaseController {

    public function __construct(Purifier $purifier)
    {
        parent::__construct($purifier);

        $this->marketHelper = new helper\markets\buy();
        $this->routeBase = 'buy';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createForm()
    {
        return view('markets.buy.create', [
//            'type' => 'create',
            'title'=>'Ny köpesannons',
            'callbackRoute' => 'buy.store',
            'marketType' => '1',
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

//        dd('Buy controller', $input);


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
//            dd('Save form');
            return $this->marketHelper->saveFromCreateForm($input);
        }
        elseif(isset($input['saveFromPreview']))
        {
            return $this->marketHelper->saveFromCreatePreview($input);
        }

        abort(404);
    }

    public function show($id)
    {
        return $this->marketHelper->show($id);
    }

}
