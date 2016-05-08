<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 23:54
 */

namespace market\Http\Controllers\Markets\create;


use Illuminate\Http\Request;
use market\core\interfaces\iMarketCreate;
use market\core\market\marketType;
use market\core\text;
use market\models\Market;

trait base
{
    public function baseShowCreateForm(iMarketCreate $marketCreate )
    {
        return $this->returnForm(null, $marketCreate);
    }

    public function basePreviewFromForm(Request $request, iMarketCreate $marketCreate, text $text, marketType $marketType)
    {
        $input = $text->purifyMarketInput($request->all());
        $market = $marketCreate->previewFromCreateForm($input);
//        dd($market);

        return $this->returnPreview($market, $market->getRouteBase(), $marketType);
    }

    public function baseCreateFormFromPreview(iMarketCreate $marketCreate)
    {
        //Done 2016-02-08
        $market = $marketCreate->editFromCreatePreview();

        return $this->returnForm($market, $marketCreate);

//        return view('markets.' . $marketCreate->getRouteBase() . '.create', [
//            'title'=>'Titel saknas',
//            'marketType' => $marketCreate->getMarketType(),
//            'model' => $market,
//            'buttons' => [
//                'save' => [
//                    'title' => 'Publicera',
//                    'name' => 'save',
//                    'formactionRoute' => $marketCreate->getRouteBase() . '.createFromForm'
//                ],
//                'preview' => [
//                    'title' => 'Förhandsgranska',
//                    'name' => 'previewFromCreateForm',
//                    'formactionRoute' => $marketCreatea->getRouteBase() . '.previewFromCreateForm'
//                ]
//            ],
//            'marketCommon' => $this->marketType,
//        ]);
    }

    public function baseCreateFromForm(Request $request, text $text, iMarketCreate $marketCreate)
    {
        $input = $text->purifyMarketInput($request->all());
        $market = $marketCreate->saveFromCreateForm($input);

        return $this->returnMarketView($market->getRouteBase(), $market->id);

        //------------------------------------------------------------------------

//        $validation = $this->marketHelper->validate($request);
//        $input = text::purifyMarketInput($request->all(), $purifier);
//        if($validation != null)
//        {
//            return $validation;
//        }

//        return $this->marketHelper->saveFromCreateForm($input);
    }

    public function baseCreateFromPreview(iMarketCreate $marketCreate)
    {
//        $input = $this->text->purifyMarketInput($request->all());
        $market = $marketCreate->saveFromCreatePreview();

        return $this->returnMarketView($market->getRouteBase(), $market->id);

//        return redirect()->route($marketCreate->getRouteBase() . '.show', ['id' => $market->id]);
    }

    protected function returnForm(Market $market = null, iMarketCreate $marketCreate)
    {
        return view('markets.' . $marketCreate->getRouteBase() . '.create', [
            'title'=> $marketCreate->getTitleNew(),
            'marketType' => $marketCreate->getMarketType(),
            'model' => $market,
            'buttons' => [
                'save' => [
                    'title' => 'Publicera',
                    'name' => 'save',
                    'formactionRoute' => $marketCreate->getRouteBase() . '.createFromForm'
                ],
                'preview' => [
                    'title' => 'Förhandsgranska',
                    'name' => 'previewFromCreateForm',
                    'formactionRoute' => $marketCreate->getRouteBase() . '.previewFromCreateForm'
                ]
            ],
        ]);
    }

    protected function returnPreview(Market $market, $routeBase, marketType $marketType)
    {
        return view(
            'markets.' . $routeBase . '.show' , [
            'type' => 'create',
            'preview' => true,
            'callbackRoute' => '',
            'market' => $market,
            'bidCount' => 0,
            'bidHighest' => 0,
            'yourBid' => 0,
            'buttons' => [
                'save' => [
                    'title' => 'Publicera',
                    'name' => 'saveFromPreview',
                    'formactionRoute' => $routeBase . '.createFromPreview'
                ],
                'preview' => [
                    'title' => 'Redigera',
                    'name' => 'editFromPreview',
                    'formactionRoute' => $routeBase . '.createFormFromPreview'
                ]
            ],
            'marketCommon' => $marketType,
        ]);
    }

    protected function returnMarketView($routeBase, $id)
    {
        return redirect()->route( $routeBase . '.show', ['id' => $id]);
    }
}