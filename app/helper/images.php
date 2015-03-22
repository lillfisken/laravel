<?php namespace market\helper;

use Illuminate\Support\Facades\Config;
use File;
use Image;

class images
{
    public static function moveImageFromTempToPublic($input, $imageName, $suffix, $year, $month)
    {
        debug::logConsole('Helper -> Images');

        debug::logConsole('$imageName: ' . $imageName);
        debug::logConsole('$suffix: ' . $suffix);
        debug::logConsole('');
        debug::logConsole('');


        if (isset($input[$imageName . $suffix]))
        {
            debug::logConsole('Input is set');


            if (starts_with($input[$imageName . $suffix], Config::get('market.public_path_images_temp')))
            {
                debug::logConsole('Moving function');

                debug::logConsole('Imagestarts with ' . $input[$imageName . $suffix]);

                $path = $input[$imageName . $suffix];

                debug::logConsole('Path is: ' . $path);

                $public_path = Config::get('market.public_path_images');
                $public_temp_path = Config::get('market.public_path_images_temp');
                $system_path = Config::get('market.system_path_images');
                $system_temp_path = Config::get('market.system_path_images_temp');

                $moveFrom = str_replace($public_temp_path, $system_temp_path, $path);
                $moveTo = str_replace($public_temp_path, $system_path, $path);
                $newPath = str_replace($public_temp_path, $public_path, $path);

                //Move file from temp directory to persistent director
                if(File::move( $moveFrom, $moveTo ))
                {
                    debug::logConsole('File moved');


                    debug::logConsole('New path: ' . $newPath);

                    //Change path to image in input
                    $input[$imageName . $suffix] = $newPath;
                }


            }
//            else
//            {
//                debug::logConsole('Moving function never hit');
//            }
        }

        return $input;
    }
}