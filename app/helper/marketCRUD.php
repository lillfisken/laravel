<?php namespace market\helper;

use market\Market;
use Illuminate\Support\Facades\Auth;
use File;
//use Intervention\Image\Facades\Image;
use Image;
use Request;

class marketCRUD
{
    public static function save($input)
    {
        //This assumes correct input values have been checked and validated
        //Some error handling will have to be attached here

        //Process images in input
        $input = self::saveImage($input, 'image1');
        $input = self::saveImage($input, 'image2');
        $input = self::saveImage($input, 'image3');
        $input = self::saveImage($input, 'image4');
        $input = self::saveImage($input, 'image5');
        $input = self::saveImage($input, 'image6');

        //Create new market and save
        $m = new Market($input);
        $m['createdByUser'] = Auth::id();
        $m->save();

        return redirect()->route('markets.index');
    }

    public static function preview($input, $postBackURL, $postBackType)
    {
//        dd(Input::all());
//        dd('preview');
        $temp = new Market($input);

        $temp['createdByUser'] = Auth::id();
        $temp['preview'] = true;
//            dd($temp);

        return view('markets.preview', ['market' => $temp,
            'postBackURL' => $postBackURL,
            'postBackType' => $postBackType]);
    }

    public static function editPreview($input)
    {
        $temp = new Market($input);

        return view('markets.previewEdit', ['market' => $temp]);

//        dd(Input::all());
    }

    public static function update($id, $input){
        //Assuming input is validated
        //Add some error handling

//        dd(Request::getClientIp());

        $temp = Market::find($id);
//        dd([$input, $temp]);
        //TODO: Not updating images
        $input = self::saveImage($input, 'image1');
        $input = self::saveImage($input, 'image2');
        $input = self::saveImage($input, 'image3');
        $input = self::saveImage($input, 'image4');
        $input = self::saveImage($input, 'image5');
        $input = self::saveImage($input, 'image6');

        $temp->fill($input)->save();
        //TODO: Add changes to separate db table
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
    public static function saveImage($input, $image_name)
    {
        //dd($input);
//        if (Input::hasFile($image_name))
        //dd(isset($input[$image_name]));
//        dd(['imageName'=>$image_name, 'input'=>$input]);
        if (isset($input[$image_name]) && $input[$image_name] != "")
        {
            //-------------------------------------------------------------------------------------
            // Settings for saving image
            // Create a two base paths for images, one real and one virtual
            // Create directore if non existing based by month and year
            //-------------------------------------------------------------------------------------

            //TODO: add check 'is image'
            $year = date('y');
            $month = date('m');
            $rdm = str_random(5);

            //TODO: Move path to separete config file instead of saving in db, Low priority
            $real_path = public_path() . '/images/' . $year . '/';
            if (!File::exists($real_path))
            {
                File::makeDirectory($real_path, 0774 , true);
            }

            $real_path = $real_path . $month . '/';
            if (!File::exists($real_path))
            {
                File::makeDirectory($real_path, 0774 , true);
            }

            //1: Path to public directory from root, 2: Path to store image directory
            $public_path_base = '/market/public/' . 'images/' . $year . '/' . $month . '/';
            $real_path_base = $real_path;

            //-------------------------------------------------------------------------------------
            // Image std size
            //-------------------------------------------------------------------------------------

            $file_name = $rdm . '_std_' .  $input[$image_name]->getClientOriginalName();

            $public_path = $public_path_base . $file_name;
            $real_path = $real_path_base . $file_name;

            //dd($input[$image_name]);

            //Resize image to max 700 width keeping aspect ratio
            $image = Image::make($input[$image_name]->getRealPath());

            //dd($image);
            $image = $image->resize(700, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $image->save($real_path);

            $input[$image_name . '_std'] = $public_path;

            //dd('image saved');

            //-------------------------------------------------------------------------------------
            // Image thumb size
            //-------------------------------------------------------------------------------------

            $file_name = $rdm . '_thumb_' .  $input[$image_name]->getClientOriginalName();

            $public_path = $public_path_base . $file_name;
            $real_path = $real_path_base . $file_name;

            //Resize image to max 700 width keeping aspect ratio
            $image = Image::make($input[$image_name]->getRealPath())->resize(140, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($real_path);

            $input[$image_name . '_thumb'] = $public_path;

            //-------------------------------------------------------------------------------------
            // Image full size
            //-------------------------------------------------------------------------------------

            $file_name = $rdm . '_full_' .  $input[$image_name]->getClientOriginalName();

            $public_path = $public_path_base . $file_name;
            $real_path = $real_path_base . $file_name;

            $image = Image::make($input[$image_name])->save($real_path);

            $input[$image_name . '_full'] = $public_path;

            //-------------------------------------------------------------------------------------
        }

        return $input;
    }

    public static function addMarketMenu($market)
    {
        //dd($market);

        if(Auth::check()) {
            $id = Auth::id();
            $temp = array();
            //dd($id);
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
//			dd($temp);
//			dd(gettype($market));
//			dd($market);

//			$market->offsetSet('marketmenu', $temp);

            $market['marketmenu'] = $temp;

//			dd($market);
        }
    }


}