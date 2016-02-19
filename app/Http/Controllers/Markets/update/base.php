<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-02-15
 * Time: 00:56
 */

namespace market\Http\Controllers\Markets\update;


use Illuminate\Http\Request;
use market\core\interfaces\iMarketUpdate;
use market\core\market\marketType;
use market\models\Market;

trait base
{
    public function baseShowUpdateForm($marketId, iMarketUpdate $marketHelper)
    {
        $market = $marketHelper->editFromStart($marketId);
//        dd($market);
        return $this->baseReturnUpdateForm($market, $marketHelper);
    }

    public function baseUpdateFromForm(Request $request, iMarketUpdate $marketHelper)
    {
        $input = $request->all();

        $market = $marketHelper->saveFromEditForm($input);

        return redirect()->route($marketHelper->getRouteBase() . '.show', $market->id);
    }

    public function baseUpdateFromPreview(iMarketUpdate $marketHelper)
    {
        $market = $marketHelper->saveFromEditPreview();
        return redirect()->route($marketHelper->getRouteBase() . '.show', ['id' => $market->id]);
    }

    public function basePreviewFromForm(Request $request, iMarketUpdate $marketHelper, marketType $marketType)
    {
        $input = $request->all();
        //Todo: Purify
        //TODO: Request

        $market = $marketHelper->previewFromEditForm($input);

        return $this->baseReturnUpdatePreview($market, $marketHelper, $marketType);
    }

    public function baseUpdateFormFromPreview(iMarketUpdate $marketHelper)
    {
        $market = $marketHelper->editFromEditPreview();

        return $this->baseReturnUpdateForm($market, $marketHelper);
    }

    protected function baseReturnUpdateForm(Market $market, iMarketUpdate $marketHelper)
    {
        return view('markets.' . $marketHelper->getRouteBase() . '.create', [
            'title'=> 'Redigera ' . $market['title'],
            'model' => $market,
            'buttons' => [
                'save' => [
                    'title' => 'Uppdatera',
                    'name' => 'save',
                    'formactionRoute' => $marketHelper->getRouteBase() . '.updateFromForm'
                ],
                'preview' => [
                    'title' => 'Förhandsgranska',
                    'name' => 'previewFromEditForm',
                    'formactionRoute' => $marketHelper->getRouteBase() . '.previewFromUpdateForm'
                ]
            ],
        ]);
    }

    protected function baseReturnUpdatePreview(Market $market, iMarketUpdate $marketHelper, marketType $marketType)
    {
        return view('markets.' . $marketHelper->getRouteBase() . '.show' , [
            'preview' => true,
            'market' => $market,
            'bidCount' => 0,
            'bidHighest' => 0,
            'yourBid' => 0,
            'buttons' => [
                'save' => [
                    'title' => 'Uppdatera',
                    'name' => 'saveFromPreview',
                    'formactionRoute' => $marketHelper->getRouteBase() . '.updateFromPreview'
                ],
                'preview' => [
                    'title' => 'Redigera',
                    'name' => 'editFromPreview',
                    'formactionRoute' => $marketHelper->getRouteBase() . '.updateFormFromPreview'
                ]
            ],
            'marketCommon' => $marketType
        ]);
    }
}