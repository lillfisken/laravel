<?php namespace market\helper;

use Chromabits\Purifier\Contracts\Purifier;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\App;

class text
{
    /**
     * @var Purifier
     */
//    protected static $purifier;
//
//    protected static $text;
//
//    /**
//     * Construct an instance of MyClass
//     *
//     * @param Purifier $purifier
//     */
//    public function __construct(Purifier $purifier) {
//        // Inject dependencies
//        $this->$purifier = $purifier;
//    }

//    public static function getText()
//    {
//        if ( is_null( self::$text ) )
//        {
//            self::$text = new self();
//        }
//        return self::$instance;
//    }

    public static function purify($string, $purifier)
    {
        $string = $purifier->clean($string, 'custom');
//        $string = str_replace(['<script>', '</script>'], ['',''], $string);
//dd($string);
        return $string;
    }

    public static function purifyMarketInput($input, $purifier)
    {
        if(isset($input['description']))
        {
            $input['description'] = self::purify($input['description'], $purifier);
        }

        if(isset($input['title']))
        {
            $input['title'] = self::purify($input['title'], $purifier);
        }

        if(isset($input['extra_price_info']))
        {
            $input['extra_price_info'] = self::purify($input['extra_price_info'], $purifier);
        }
//        dd($input, 'purifyMarketInput');

        return $input;
    }

    public function purifyQuestionInput($input)
    {

        return $input;
    }

    public function purifyPassword($password)
    {
        return $password;
    }

    public function htmlToBBCode($string)
    {

        return $string;
    }

    public function bbCodeToHtml($string)
    {

        return $string;
    }


}