<?php

use Illuminate\Support\Facades\Config;

$public = '/market/public/';
$system = '/var/www/market/public/';

return [
    'public_path' => $public,
    'public_path_images' => $public . 'images/',
    'public_path_images_temp' => $public . 'images/temp/',

    'system_path' => $system,
    'system_path_images' => $system . 'images/',
    'system_path_images_temp' => $system . 'images/temp/',

];