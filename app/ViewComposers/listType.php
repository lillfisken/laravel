<?php
/**
 * Created by PhpStorm.
 * User: Oskar
 * Date: 2016-01-08
 * Time: 19:11
 */

namespace market\ViewComposers;


use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class listType
{
    protected $request;
    protected $cookie;

    public function __construct(Request $request, CookieJar $cookieJar)
    {
        $this->request = $request;
        $this->cookie = $cookieJar;
    }

    public function compose(View $view)
    {
        $view->with('listType', $this->getListType());
        $view->with('listTypeHrefs', $this->getListTypeHrefs());
    }

    private function getListType()
    {
        //Get the list type from url or session
        if ($this->request->has('listType'))
        {
            $this->setCookie($this->request->get('listType'));
            return $this->request->get('listType');
        }
        elseif ($this->hasCookie())
        {
            return $this->getCookie();
        }
        //Default value
        return 'smallList';
    }

    private function getListTypeHrefs()
    {
        $list = 'smallList';
        $small = 'galleryS';
        $medium = 'galleryM';
        $large = 'galleryL';
        $requestUri = $this->request->getRequestUri();
        if (strpos($requestUri, 'listType') !== false)
        {
            $list = preg_replace('/(\\blistType=)[^\&]*/', 'listType=' . $list, $requestUri);
            $small = preg_replace('/(\\blistType=)[^\&]*/', 'listType=' . $small, $requestUri);
            $medium = preg_replace('/(\\blistType=)[^\&]*/', 'listType=' . $medium, $requestUri);
            $large = preg_replace('/(\\blistType=)[^\&]*/', 'listType=' . $large, $requestUri);
        }
        elseif (strpos($requestUri, '?') !== false)
        {
            //requestUri already contain parameters
            $list = $requestUri . '&listType=' . $list; //Appending to requestUri
            $small = $requestUri . '&listType=' . $small; //Appending to requestUri
            $medium = $requestUri . '&listType=' . $medium; //Appending to requestUri
            $large = $requestUri . '&listType=' . $large; //Appending to requestUri
        }
        else
        {
            //requestUri don't contain parameters
            $list = $requestUri . '?listType=' . $list; //Appending to requestUri
            $small = $requestUri . '?listType=' . $small; //Appending to requestUri
            $medium = $requestUri . '?listType=' . $medium; //Appending to requestUri
            $large = $requestUri . '?listType=' . $large; //Appending to requestUri
        }

        $hrefs = [
            'list' => $list,
            'small' => $small,
            'medium' => $medium,
            'large' => $large
        ];

        return $hrefs;
    }

    private function setCookie($listType)
    {
        $this->cookie->queue('listType', $listType);
    }

    private function hasCookie()
    {
        return $this->request->cookie('listType') !== null;
    }

    private function getCookie()
    {
        return $this->request->cookie('listType');
    }
}