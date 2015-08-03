<?php namespace market\helper;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class images
{
    public static function moveImageFromTempToPublic($input, $imageName, $suffix, $paths)
    {
        Log::debug('Images -> moveImageFromTempToPublic -> imageName: ' . $imageName . ', suffix: ' . $suffix);

        // If file is set AND If file is in temp folder
        if (isset($input[$imageName . $suffix]) && starts_with($input[$imageName . $suffix], Config::get('market.public_path_images_temp')))
        {
            $path = $input[$imageName . $suffix];

//            $public_path = Config::get('market.public_path_images') . $year . '/' . $month . '/';
//            $public_temp_path = Config::get('market.public_path_images_temp');
//            $system_path = Config::get('market.system_path_images') . $year . '/' . $month . '/';
//            $system_temp_path = Config::get('market.system_path_images_temp');

//            $moveFrom = str_replace($public_temp_path, $system_temp_path, $path);
//            $moveTo = str_replace($public_temp_path, $system_path, $path);
//            $newPath = str_replace($public_temp_path, $public_path, $path);

//            $paths['web_public_path'] = Config::get('market.public_path_images') . $year . '/' . $month . '/';
//            $paths['system_public_path'] = Config::get('market.system_path_images') . $year . '/' . $month . '/';
//
//            $paths['web_public_temp_path'] = Config::get('market.public_path_images_temp');
//            $paths['system_public_temp_path']

            $moveFrom = str_replace($paths['web_public_temp_path'], $paths['system_public_temp_path'], $path);
            $moveTo = str_replace($paths['web_public_temp_path'], $paths['system_public_path'], $path);
            $newPath = str_replace($paths['web_public_temp_path'], $paths['web_public_path'], $path);

            self::makeDirectory($paths['system_public_path']);

//            Log::debug('$public_path exist: ' . File::exists($public_path));
//            Log::debug('$public_temp_path exist: ' . File::exists($public_temp_path));
//            Log::debug('$system_path exist: ' .  File::exists($system_path));
//            Log::debug('$system_temp_path exist: ' . File::exists($system_temp_path));
//            Log::debug('$moveFrom exist: ' . File::exists($moveFrom));
//            Log::debug('$moveTo exist: ' . File::exists($moveTo));

            //Move file from temp directory to persistent director
            $fileMoved = rename($moveFrom, $moveTo);
            if($fileMoved == true) // This is something wrong
            {
                //Changing path to image in input
                $input[$imageName . $suffix] = $newPath;

                Log::debug('File Moved');
            }
            else
            {
                Log::debug('No file moved');
            }
        }

        return $input;
    }

    public static function makeDirectory($path)
    {
        if ($path != null && !File::exists($path))
        {
            File::makeDirectory($path, 0774 , true);
        }
    }

    /**
     * @param $input
     * @param bool $persistent
     * @return mixed
     */
    public static function saveImages($input, $persistent = false){

        Log::debug('saveImages');

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
        // if file exist in temp, move, else if file exist in public, ???

        // If persistent
        //      if image in temp
        //          move file
        //      if image in persistent
        //          do nothing (in move image?)
        // Else if not persistent
        //      if new name == old name
        //          do nothing
        //      else
        //          replace image names in input

        // USE paths()

        if(isset($input[$image_name . '_thumb']) && $persistent && !isset($input[$image_name]))
        {
            Log::debug('saveImage, moving image from temporary directory to persistant, image name: ' . $image_name);
            /* If image_thumb is set, all sizes should be set
             * If persistent it ment to be stored permanetly
             * If there is no new image uploaded
             *
             * Image is in temp directory and should be moved to permanant storage
             */
//
//            $year = date('y');
//            $month = date('m');

            $paths = self::getPaths();

            $input = images::moveImageFromTempToPublic($input, $image_name, '_thumb',$paths);
            $input = images::moveImageFromTempToPublic($input, $image_name, '_std', $paths);
            $input = images::moveImageFromTempToPublic($input, $image_name, '_full', $paths);
        }
        else if (isset($input[$image_name]) && $input[$image_name] != "")
        {
            Log::debug('saveImage, new image, image name: ' .$image_name);
            Log::debug('$input[$image_name]: ' . $input[$image_name]);
            //-------------------------------------------------------------------------------------
            // Settings for saving image
            //
            // If $input[$image_name] is set there is a new image
            //
            // Create a two base paths for images, one real and one virtual
            // Create directory if non existing based by month and year
            //-------------------------------------------------------------------------------------

            //TODO: add check 'is image'

            $rdm = str_random(5);
            $paths = self::getPaths();

            $input = self::saveStd($input, $rdm, $image_name, $paths, $persistent);
            $input = self::saveThumb($input, $rdm, $image_name, $paths, $persistent);
            $input = self::saveFull($input, $rdm, $image_name, $paths, $persistent);
        }

        return $input;
    }

    private static function getPaths()
    {
        $year = date('y');
        $month = date('m');
        $paths = array();

        $paths['web_public_path'] = Config::get('market.public_path_images') . $year . '/' . $month . '/';
        $paths['system_public_path'] = Config::get('market.system_path_images') . $year . '/' . $month . '/';

        $paths['web_public_temp_path'] = Config::get('market.public_path_images_temp');
        $paths['system_public_temp_path'] = Config::get('market.system_path_images_temp');

        return $paths;
    }

    private static function saveThumb($input, $rdm, $image_name, $paths, $persistent)
    {
        $file_name = $rdm . '_thumb_' .  $input[$image_name]->getClientOriginalName();

        //Resize image to max 700 width keeping aspect ratio
        $image = Image::make($input[$image_name]->getRealPath())->resize(140, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        if($persistent){
            $public_path = $paths['web_public_path'] . $file_name;
            $system_path = $paths['system_public_path'] . $file_name;
        }
        else{
            $public_path = $paths['web_public_temp_path'] . $file_name;
            $system_path = $paths['system_public_temp_path'] . $file_name;
        }

        $image->save($system_path);
        $input[$image_name . '_thumb'] = $public_path;

        return $input;
    }

    private static function saveStd($input, $rdm, $image_name, $paths, $persistent)
    {
        $file_name = $rdm . '_std_' .  $input[$image_name]->getClientOriginalName();

        //Resize image to max 700 width keeping aspect ratio
        $image = Image::make($input[$image_name]->getRealPath())->resize(700, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        if($persistent){
            $public_path = $paths['web_public_path'] . $file_name;
            $system_path = $paths['system_public_path'] . $file_name;
        }
        else{
            $public_path = $paths['web_public_temp_path'] . $file_name;
            $system_path = $paths['system_public_temp_path'] . $file_name;
        }

        $image->save($system_path);
        $input[$image_name . '_std'] = $public_path;

        return $input;
    }

    private static function saveFull($input, $rdm, $image_name, $paths, $persistent)
    {
        $file_name = $rdm . '_full_' .  $input[$image_name]->getClientOriginalName();

        $image = Image::make($input[$image_name]);

        if($persistent){
            $public_path = $paths['web_public_path'] . $file_name;
            $system_path = $paths['system_public_path'] . $file_name;
        }
        else{
            $public_path = $paths['web_public_temp_path'] . $file_name;
            $system_path = $paths['system_public_temp_path'] . $file_name;
        }

        $image->save($system_path);
        $input[$image_name . '_full'] = $public_path;

        return $input;
    }

}