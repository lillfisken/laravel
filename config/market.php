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

    'phpBBforums' => [
        [
            'id' => 'elektroForumet',
            'displayName' => 'Elektro forumet',
            'urlConnect' => 'http://elektro.coo/phpBB3/login/connect/',
            'urlLogin' => 'http://elektro.coo/phpBB3/login/login/',
            'key' => '9LDuc64mWWlfohwGygBUjMO75pGQChRWsT2kCXBSf89uoTYYNifpzFleTlRaYvwNLkNNLFUhWE3lGfsqyDw6cSiLZ73WkZiAnw2XF4URwjsFf4bUWRu3tHKbNqtRFkpMbVvl0XlYLcculqY1kk3ZVfmXXlcNvj6WyttjaDopHHUDt6MC6xxafaly6xTTAx4lXuUBbovxaPkHxJ1n9ICe2mp38Qwiq5KvKU40mVNSI7q0w4nq6aKyIzSUUc7YQOw',
        ],
        [
            'id' => 'helikpterorumet',
            'displayName' => 'Helikopterforumet',
            'urlConnect' => 'http://helikopter.coo/phpBB3/login/connect/',
            'urlLogin' => 'http://helikopter.coo/phpBB3/login/login/',
            'key' => 'cnt7jftaGtcA0wnPaOmyqGORoCApjJHru5oTgPgtHFjEyrL8DTuocabyOBYXLkxNYeiBzl3IXnhDMmBBLxRpNr02humSPkbL1H0iIG1lSL4z7ViLU6V7AiGcShqUCnUQVrFVv3Cw9uSK29bpM9IaFR85C3YLYDteuiQI11pnprVoFXbKCwwls3e6M51GAKu20CARy3vec9GCr1ZfXcSXen0QfXFJyDgAIoLPhfFJ3OoOTPkmkb3fax9gZVwI8f9',
        ],
    ],

    'paginationNr' => env('PAGINATION_NR_OF', 5),
];

