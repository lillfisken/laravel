<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-03
 * Time: 01:31
 */

namespace market\Http\Controllers\Markets;

use Chromabits\Purifier\Purifier;
use Illuminate\Http\Request;
use market\helper\text;
use market\Http\Controllers\Controller;
//use market\Http\Requests\Request;

abstract class baseCreateController extends Controller
{
    //TODO: Move market helper to core, create interface
    //TODO: Move validation to request
    //TODO: Move purifing to request

    protected $marketHelper;

    public function showCreateForm()
    {
        return view('markets.' . $this->marketHelper->getRouteBase() . '.create', [
            'title'=> $this->marketHelper->getTitleNew(),
            'marketType' => $this->marketHelper->getMarketType(),
            'model' => null,
            'buttons' => [
                'save' => [
                    'title' => 'Publicera',
                    'name' => 'save',
                    'formactionRoute' => $this->marketHelper->getRouteBase() . '.createFromForm'
                ],
                'preview' => [
                    'title' => 'Förhandsgranska',
                    'name' => 'previewFromCreateForm',
                    'formactionRoute' => $this->marketHelper->getRouteBase() . '.previewFromCreateForm'
                ]
            ],
        ]);
    }

    public function createFromForm(Request $request, Purifier $purifier)
    {
        $validation = $this->marketHelper->validate($request);
        $input = text::purifyMarketInput($request->all(), $purifier);
        if($validation != null)
        {
            return $validation;
        }

        return $this->marketHelper->saveFromCreateForm($input);
    }

    public function createFromPreview(Request $request, Purifier $purifier)
    {
        $input = text::purifyMarketInput($request->all(), $purifier);
        return $this->marketHelper->saveFromCreatePreview($input);
    }

    public function previewFromForm(Request $request, Purifier $purifier)
    {
        $input = text::purifyMarketInput($request->all(), $purifier);
        $validation = $this->marketHelper->validate($request);
        if($validation != null)
        {
            return $validation;
        }

        return $this->marketHelper->previewFromCreateForm($input);
    }

    public function createFormFromPreview()
    {
        return $this->marketHelper->editFromCreatePreview();
    }
}