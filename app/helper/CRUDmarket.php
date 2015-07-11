<?php namespace market\helper;

use Illuminate\Support\Facades\Config;
use market\Market;
use Illuminate\Support\Facades\Auth;
use File;
//use Intervention\Image\Facades\Image;
use Image;
use Request;
use market\helper\images;

/**
 * Class marketCRUD
 * @package market\helper
 */
class marketCRUD
{
    /**
     * @param $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function save($input, $callbackRoute)
    {
//        //This assumes correct input values have been checked and validated
//        //Some error handling will have to be attached here
//        $input = images::saveImages($input, true);
//
//        //dd($input);
//
//        //Create new market and save
//        $m = new Market($input);
//        $m['createdByUser'] = Auth::id();
//
//        //dd($m);
//        $m->save();
//
//        return redirect()->route($callbackRoute, $m->id);
//    }
//
//    /**
//     * @param $input
//     * @param $postBackURL
//     * @param $postBackType
//     * @return \Illuminate\View\View
//     */
//    public static function preview($input, $postBackURL, $postBackType)
//    {
//        $input = images::saveImages($input);
//        $temp = new Market($input);
//
//        $temp['createdByUser'] = Auth::id();
//        $temp['preview'] = true;
//
//        //TODO: Every week, clean temp images...
//
//        return view('markets.preview', ['market' => $temp,
//        'postBackURL' => $postBackURL,
//        'postBackType' => $postBackType]);
//    }
//
//    /**
//     * @param $input
//     * @return \Illuminate\View\View
//     */
//    public static function editPreview($input)
//    {
//        $temp = new Market($input);
//
//        return view('markets.previewEdit', ['market' => $temp]);
//    }
//
//    /**
//     * @param $id
//     * @param $input
//     */
//    public static function update($id, $input){
//        //Assuming input is validated
//        //Add some error handling
//
//        $market = Market::find($id);
//
//        if (!$market) { abort(404); }
//
//        $input = images::saveImages($input, true);
//
//        $market->fill($input)->save();
//
//        //TODO: Add changes to separate db table
//    }
//
//    /**
//     * @param $market
//     */
//    public static function addMarketMenu($market)
//    {
//        if(Auth::check()) {
//            $id = Auth::id();
//            $temp = array();
//
//            //Adds link to edit market if it's created by logged in user
//            if ($id == $market->createdByUser && $market->deleted_at == null) {
//                $temp[] = array('text' => 'Redigera', 'href' => route('markets.edit', $market->id ));
//                $temp[] = array('text' => 'Avslutad', 'href' => route('markets.delete', $market->id ));
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
//        }
    }


}