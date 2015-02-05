<?php namespace market\Http\Controllers;

use market\Http\Requests;
use market\Http\Controllers\Controller;
use Request;
use Session;

class DevController extends Controller {

	public function road()
	{
		return view('roadmap');
	}

	public function getUrl()
	{
	    $uri = Request::url();
		dd($uri);
	}

	public function session()
	{
		$session = Session::all();
		dd($session);
	}

}
