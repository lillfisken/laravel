<?php namespace market\helper;

use Illuminate\Support\Facades\Config;
use File;
use Image;

class images
{
    public static function moveImageFromTempToPublic($input, $imageName, $suffix, $year, $month)
    {
        debug::logConsole('Images -> makeDirectory -> moveImageFromTempToPublic');
        debug::logConsole('-> imageName: ' . $imageName . ', suffix: ' . $suffix);


        if (isset($input[$imageName . $suffix]))
        {
            if (starts_with($input[$imageName . $suffix], Config::get('market.public_path_images_temp')))
            {
                $path = $input[$imageName . $suffix];

                $public_path = Config::get('market.public_path_images') . $year . '/' . $month . '/';
                $public_temp_path = Config::get('market.public_path_images_temp');
                $system_path = Config::get('market.system_path_images') . $year . '/' . $month . '/';
                $system_temp_path = Config::get('market.system_path_images_temp');

                $moveFrom = str_replace($public_temp_path, $system_temp_path, $path);
                $moveTo = str_replace($public_temp_path, $system_path, $path);
                $newPath = str_replace($public_temp_path, $public_path, $path);

                debug::logConsole('Images -> moveImageFromTempToPublic -> system_path: ' . $system_path);
                self::makeDirectory($system_path);

                //Move file from temp directory to persistent director
                if(File::move( $moveFrom, $moveTo ))
                {
                    //Changing path to image in input
                    $input[$imageName . $suffix] = $newPath;

                    debug::logConsole('Images -> makeDirectory -> moveImageFromTempToPublic -> Moving image');

                }
            }
        }

        return $input;
    }

    public static function makeDirectory($path)
    {
        debug::logConsole('Images -> makeDirectory -> path: ' . $path);

        if ($path != null && !File::exists($path))
        {
            File::makeDirectory($path, 0774 , true);
        }
    }
}