<?php

use Illuminate\Support\Facades\Config;

$public = env('PUBLIC_PATH');
$system = env('SYSTEM_PATH');
//$public = '/market/public/';
//$system = '/var/www/market/public/';

return [
    //----- Paths ---------------------------------------------------------

    'public_path' => $public,
    'public_path_images' => $public . 'images/',
    'public_path_images_temp' => $public . 'images/temp/',

    'system_path' => $system,
    'system_path_images' => $system . 'images/',
    'system_path_images_temp' => $system . 'images/temp/',

    //----- phpBB Auth ----------------------------------------------------

    'phpBB_api_path' => 'http://elektro.coo/phpBB3/api.php',
    'phpBB_key' => '',
];
