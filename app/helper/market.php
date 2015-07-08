<?php namespace market\helper;

use Illuminate\Support\Facades\Auth;

class market{

    var $routeBase = 'market';

    //region Market Type
    private static $marketTypes = [
        '0' => 'Säljes',
        '1' => 'Köpes',
        '2' => 'Bytes',
        '3' => 'Skänkes',
        '4' => 'Auktion',
    ];

    public static function getAllMarketTypes()
    {
        return self::$marketTypes;
    }

    public static function getMarketTypeName($number)
    {
        if(self::$marketTypes[$number] != null)
        {
            return self::$marketTypes[$number];
        }
        else
        {
            abort('404', 'Number is not a market type');
        }
    }

    //endregion

    //region Market end reason
        private static $endreasons = [
            '0' => 'Såld/Skänkt',
            '1' => 'Slängd',
            '2' => 'Återtagen',
            '3' => 'Övrigt'
        ];

        public static function getAllEndReasons()
        {
            return self::$endreasons;
        }

        public static function getEndReasonName($number)
        {
            if(self::$endreasons[$number] != null)
            {
                return self::$endreasons[$number];
            }
            else
            {
                abort('404', 'Number is not a market end type');
            }
        }
    //endregion

    //region Market Menu

//    private static function addMarketMenu($market, $routeBase)
//    {
//        if(Auth::check()) {
//            $id = Auth::id();
//            $temp = array();
//
//            //Adds link to edit market if it's created by logged in user
//            if ($id == $market->createdByUser && $market->deleted_at == null) {
//                $temp[] = array('text' => 'Redigera', 'href' => route( $routeBase . '.edit', $market->id ));
//                $temp[] = array('text' => 'Avslutad', 'href' => route( $routeBase . '.delete', $market->id ));
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
//    }

//    public static function addMarketMenuAuction($auction)
//    {
//        return self::addMarketMenu($auction, 'auction');
//    }

    public function addMarketMenu($market)
    {
        if(Auth::check()) {
            $id = Auth::id();
            $temp = array();

            //Adds link to edit market if it's created by logged in user
            if ($id == $market->createdByUser && $market->deleted_at == null) {
                $temp[] = array('text' => 'Redigera', 'href' => route( $this->routeBase . '.edit', $market->id ));
                $temp[] = array('text' => 'Avslutad', 'href' => route( $this->routeBase . '.delete', $market->id ));
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
    //endregion

    // CRUD -----------------------------------------------------------

//    static public function saveFromCreateForm($input)
//    {
//
//    }
//
//    static public function saveFromEditForm($input)
//    {
//
//    }
//
//    static public function previewFromCreateForm($input)
//    {
//
//    }
//
//    static public function previewFromEditForm($input)
//    {
//
//    }
//
//    static public function saveFromCreatePreview($input)
//    {
//
//    }
//
//    static public function saveFromEditPreview($input)
//    {
//
//    }
//
//    static public function editFromCreatePreview()
//    {
//
//    }
//
//    static public function editFromEditPreview()
//    {
//
//    }
//
//    static public function save($market)
//    {
//
//    }
}