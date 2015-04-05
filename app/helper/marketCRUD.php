<?php namespace market\helper;

use Illuminate\Support\Facades\Config;
use market\Market;
use Illuminate\Support\Facades\Auth;
use File;
//use Intervention\Image\Facades\Image;
use Image;
use Request;

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
    public static function save($input)
    {
        //This assumes correct input values have been checked and validated
        //Some error handling will have to be attached here
        $input = self::saveImages($input, true);

        //dd($input);

        //Create new market and save
        $m = new Market($input);
        $m['createdByUser'] = Auth::id();

        //dd($m);
        $m->save();

        return redirect()->route('markets.show', $m->id);
    }

    /**
     * @param $input
     * @param $postBackURL
     * @param $postBackType
     * @return \Illuminate\View\View
     */
    public static function preview($input, $postBackURL, $postBackType)
    {
        $input = self::saveImages($input);
        $temp = new Market($input);

        $temp['createdByUser'] = Auth::id();
        $temp['preview'] = true;

        //TODO: Every week, clean temp images...

        return view('markets.preview', ['market' => $temp,
        'postBackURL' => $postBackURL,
        'postBackType' => $postBackType]);
    }

    /**
     * @param $input
     * @return \Illuminate\View\View
     */
    public static function editPreview($input)
    {
        $temp = new Market($input);

        return view('markets.previewEdit', ['market' => $temp]);
    }

    /**
     * @param $id
     * @param $input
     */
    public static function update($id, $input){
        //Assuming input is validated
        //Add some error handling

        $market = Market::find($id);

        $input = self::saveImages($input, true);

        $market->fill($input)->save();

        //TODO: Add changes to separate db table
    }

    /**
     * @param $input
     * @param bool $persistent
     * @return mixed
     */
    private static function saveImages($input, $persistent = false){

//        dd($input);
        //Process images in input
        $input = self::saveImage($input, 'image1', $persistent);
        $input = self::saveImage($input, 'image2', $persistent);
        $input = self::saveImage($input, 'image3', $persistent);
        $input = self::saveImage($input, 'image4', $persistent);
        $input = self::saveImage($input, 'image5', $persistent);
        $input = self::saveImage($input, 'image6', $persistent);
        //dd($input);

        return $input;
    }

    /*
	 * Process input/image-stream to save imagename to db and imagefile to disc
	 *
	 * @param Input $input Inputstream
	 * @param string $image_name Name of the desired image in the inputstream
	 *
	 * @return Processed inputstream
	 *
	 */
    /**
     * @param $input
     * @param $image_name
     * @param $persistent
     * @return mixed
     */
    private static function saveImage($input, $image_name, $persistent)
    {
        debug::logConsole('marketCRUD -> saveImage -> image_name: ' . $image_name);
        debug::logConsole('marketCRUD -> saveImage -> persistent: ' . $persistent);
//        debug::logConsole('marketCRUD -> saveImage -> image_name: ' . $image_name);
//        debug::logConsole('marketCRUD -> saveImage -> image_name: ' . $image_name);

        if(isset($input[$image_name . '_thumb']) && $persistent && !isset($input[$image_name]))
        {
            debug::logConsole('marketCRUD -> saveImage -> $input[$image_name . _thumb]: ' . $input[$image_name . '_thumb']);

            $year = date('y');
            $month = date('m');

            $input = images::moveImageFromTempToPublic($input, $image_name, '_thumb', $year, $month);
            $input = images::moveImageFromTempToPublic($input, $image_name, '_std', $year, $month);
            $input = images::moveImageFromTempToPublic($input, $image_name, '_full', $year, $month);
        }
        else if (isset($input[$image_name]) && $input[$image_name] != "")
        {
            debug::logConsole('marketCRUD -> saveImage -> second if');


            //-------------------------------------------------------------------------------------
            // Settings for saving image
            // Create a two base paths for images, one real and one virtual
            // Create directore if non existing based by month and year
            //-------------------------------------------------------------------------------------

            //TODO: add check 'is image'

            #region set this image parameters
            $year = date('y');
            $month = date('m');
            $rdm = str_random(5);

            $web_public_path = Config::get('market.public_path_images') . $year . '/' . $month . '/';
            $system_public_path = Config::get('market.system_path_images') . $year . '/' . $month . '/';

            $web_public_temp_path = Config::get('market.public_path_images_temp');
            $system_public_temp_path = Config::get('market.system_path_images_temp');

            debug::logConsole('-> $web_public_path: ' . $web_public_path);
            debug::logConsole('-> $web_public_temp_path: ' . $web_public_temp_path);
            debug::logConsole('-> $system_public_path: ' . $system_public_path);
            debug::logConsole('-> $system_public_temp_path: ' . $system_public_temp_path);

            #endregion

            #region Set directory structure

            //TODO: FIX IT
            //Create a temporary director to store images in when previewing markets
//            images::makeDirectory($system_public_temp_path);
            if (!File::exists($system_public_temp_path))
            {
                echo '<script>console.log("Making directory $system_public_temp_path: ' . $system_public_temp_path . '")</script>';
                File::makeDirectory($system_public_temp_path, 0774 , true);
            }

            //Create the real path to store the images persistent
//            images::makeDirectory($system_public_path);
//             Adding directory for year
//            $system_path = $system_public_path . $year . '/';
            if (!File::exists($system_public_path))
            {
                echo '<script>console.log("Making directory $system_public_path: ' . $system_public_path . '")</script>';
                File::makeDirectory($system_public_path, 0774 , true);
            }
//
//            //Adding directory for month
//            $system_path = $system_path . $month . '/';
//            if (!File::exists($system_path))
//            {
//                File::makeDirectory($system_path, 0774 , true);
//            }

            //1: Path to public directory from root, 2: Path to store image directory
//            $public_path_base = $web_public_path;
//            $system_path_base = $system_public_path;

            #endregion

            #region Image std size
            //-------------------------------------------------------------------------------------

            $file_name = $rdm . '_std_' .  $input[$image_name]->getClientOriginalName();

            //Resize image to max 700 width keeping aspect ratio
            $image = Image::make($input[$image_name]->getRealPath())->resize(700, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            if($persistent){
                $public_path = $web_public_path . $file_name;
                $system_path = $system_public_path . $file_name;
            }
            else{
                $public_path = $web_public_temp_path . $file_name;
                $system_path = $system_public_temp_path . $file_name;
            }

            $image->save($system_path);
            $input[$image_name . '_std'] = $public_path;

            #endregion

            #region Image thumb size
            //-------------------------------------------------------------------------------------

            $file_name = $rdm . '_thumb_' .  $input[$image_name]->getClientOriginalName();

            //Resize image to max 700 width keeping aspect ratio
            $image = Image::make($input[$image_name]->getRealPath())->resize(140, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            if($persistent){
                $public_path = $web_public_path . $file_name;
                $system_path = $system_public_path . $file_name;
            }
            else{
                $public_path = $web_public_temp_path . $file_name;
                $system_path = $system_public_temp_path . $file_name;
            }

            $image->save($system_path);
            $input[$image_name . '_thumb'] = $public_path;

            #endregion

            #region Image full size
            //-------------------------------------------------------------------------------------

            $file_name = $rdm . '_full_' .  $input[$image_name]->getClientOriginalName();

            $image = Image::make($input[$image_name]);

            if($persistent){
                $public_path = $web_public_path . $file_name;
                $system_path = $system_public_path . $file_name;
            }
            else{
                $public_path = $web_public_temp_path . $file_name;
                $system_path = $system_public_temp_path . $file_name;
            }

            $image->save($system_path);
            $input[$image_name . '_full'] = $public_path;

            #endregion
        }
        else
        {
            debug::logConsole('marketCRUD -> saveImage -> saving never hit');

        }

        return $input;
    }

    /**
     * @param $market
     */
    public static function addMarketMenu($market)
    {
        if(Auth::check()) {
            $id = Auth::id();
            $temp = array();

            //Adds link to edit market if it's created by logged in user
            if ($id == $market->createdByUser && $market->deleted_at == null) {
                $temp[] = array('text' => 'Redigera', 'href' => route('markets.edit', $market->id ));
                $temp[] = array('text' => 'Avslutad', 'href' => route('markets.delete', $market->id ));
            }

            if  ($id != $market->createdByUser) {
                //TODO: Check if market is blocked, then ad link to unblock instead
                $temp[] = array('text' => 'Dölj annons', 'href' => route('accounts.blockMarket', $market->id));
                //TODO: Check if market is seller, then ad link to unblock instead
                $temp[] = array('text' => 'Dölj säljare', 'href' => route('accounts.blockSeller', $market->createdByUser));
            }

            $market['marketmenu'] = $temp;
        }
    }


}