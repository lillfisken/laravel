<?php namespace market\Http\Controllers;

use Illuminate\Routing\Controller as ControllerMarket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use market\Market;
use Illuminate\Http\Request;
use Input;
use market\Http\Requests\CreateMarketRequest;
use File;
use DB;
use Session;

use Intervention\Image\ImageManagerStatic as Image;

class MarketsController extends ControllerMarket {
	
	/*
	|--------------------------------------------------------------------------
	| Market Controller
	|--------------------------------------------------------------------------
	|
	| Controller methods are called when a request enters the application
	| with their assigned URI. The URI a method responds to may be set
	| via simple annotations.
	|
	*/

	public function __construct(Market $market)
	{
		//$this->market = $market;
	}
	
	/**
	 * Display a listing of the resource.
	 * GET /markets
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check())
		{
			//TODO::Sort non blocked markets for user
			//Get all markets from db

			$temp = Market::select()->with('User')->get();

			//Set menu for each market
			foreach ($temp as $market)
			{
				$this->addMarketMenu($market);
			}

			//echo("<script>console.log('MarketsController->index');</script>");
		}
		else {
			//Get all markets from db
			$temp = Market::all();
			//$temp = dd($temp);
		}

		//dd($market);

		return view('markets.index', ['markets' => $temp]);
	}

	public function filter()
	{
		//TODO:: Move all all market type to separate file/enum and update db
		// Begining of building db query
		$query = Market::select('*');

		// Remove deleted markets from query if box checked
		if(Input::has('ended'))
		{
			$query->withTrashed();
		}

//		// Add type af markets to query depending on which boxes are ticked
		$query->where(function($query) {


			if (Input::has('saljes')) {
				$query->orWhere('type', '=', 'saljes');
			}

			if (Input::has('kopes')) {
				$query->orWhere('type', '=', 'kopes');
			}

			if (Input::has('bytes')) {
				$query->orWhere('type', '=', 'bytes');
			}

			if (Input::has('skankes')) {
				$query->orWhere('type', '=', 'skankes');
			}

			if (Input::has('samkop')) {
				$query->orWhere('type', '=', 'samkop');
			}

			if (Input::has('tjanst_erbjudes')) {
				$query->orWhere('type', '=', 'tjanst_erbjudes');
			}

			if (Input::has('tjanst_sökes')) {
				$query->orWhere('type', '=', 'tjanst_sökes');
			}

			if (Input::has('anstallning')) {
				$query->orWhere('type', '=', 'anstallning');
			}

			if (Input::has('tips')) {
				$query->orWhere('type', '=', 'tips');
			}
		});

		if (Input::has('hiddenAds')) {
			//TODO: Check for hidden markets
		}

		if (Input::has('hiddenSellers')) {
			//TODO: Check for hidden sellers
		}

		$temp = $query->get();

		// add a menu to each market if user is logged in
		if(Auth::check())
		{
			foreach ($temp as $market)
			{
				$this->addMarketMenu($market);
			}
		}

		Input::flash();
		return view('markets.index', ['markets' => $temp]);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /markets/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('markets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /markets
	 *
	 * @return Response
	 */
	public function store(CreateMarketRequest $request, Market $market)
	{
		//TODO: Validation
		$input = Input::all();

		$input['createdByUser'] = Auth::id();

		$input = $this->saveImage($input, 'image1');
		$input = $this->saveImage($input, 'image2');
		$input = $this->saveImage($input, 'image3');
		$input = $this->saveImage($input, 'image4');
		$input = $this->saveImage($input, 'image5');
		$input = $this->saveImage($input, 'image6');

		$market->create($input);
		
		return redirect()->route('markets.index');
	}

	/**
	 * Display the specified resource.
	 * GET /markets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($market)
	{
		//dd($market);
		//echo("<script>console.log('Markets controller -> show');</script>");
		$temp = Market::withTrashed()->with('user', 'user.markets')->find($market);
		$this->addMarketMenu($temp);
		//$tempCount = $temp->getUserMarketsCount;
		//echo("<script>console.log('Count: " .$tempCount."');</script>");

		return view('markets.show', ['market' => $temp]);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /markets/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($market)
	{
		$temp = Market::find($market);

		return view('markets.edit', ['market' => $temp]);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /markets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( $id , Request $request)
	{
		//TODO: Validation
		$input = Input::all();
		$temp = Market::find($id);

		//TODO: Not updating images
		$input = $this->saveImage($input, 'image1');
		$input = $this->saveImage($input, 'image2');
		$input = $this->saveImage($input, 'image3');
		$input = $this->saveImage($input, 'image4');
		$input = $this->saveImage($input, 'image5');
		$input = $this->saveImage($input, 'image6');

		$temp->fill($input)->save();

		return redirect()->route('markets.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /markets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($market, Request $request)
	{
//		$uri = $request->getBasePath();
//		dd($uri);
		//dd($market);

		Session::put('uri', Session::get('_previous'));

		$reasons = ['Varan såld' => 'Varan såld', 'Övrigt' => 'Övrigt'];

		return view('markets.delete', ['markets' => $market, 'reasons' => $reasons]);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /markets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		$id = Input::get('market');
		//$market = Market::where( 'id', '=', $id )->firstOrFail();
		$market = Market::where('id', '=', $id)->firstorfail();
		//dd($id);

		//$reason = Input::get('reason);
		//TODO: Add deletion reason to db
		//dd($market);

		$market->delete();

		//$uri = Input::get('uri');
		//return URL::to('', array(), false);

		$uri = Session::get('uri');
		//dd($uri);

		if(isset($uri))
		{
			//dd($uri);
			if(isset($uri['url']))
			{
				//dd($uri['url']);
				return redirect($uri['url']);
			}
			return redirect()->route('markets.index');
			//return URL::to($uri);

			//return redirect('markets/public');
		}
		else
		{
			dd('redirect route');
			return redirect()->route('markets.index');
		}

	}

    public function search()
    {
        $search = Input::get('s');
        if(isset($search)){

            //inspired by:
            //http://stackoverflow.com/questions/19612180/creating-search-functionality-with-laravel-4

			$query = Market::where('title', 'LIKE', '%' . $search . '%')
				->orWhere('description', 'LIKE', '%' . $search . '%');

            $result = $query->get();

			//Set menu for each market
			foreach ($result as $market)
			{
				$this->addMarketMenu($market);
			}

            return view('markets.index', ['markets' => $result]);
        }


        return 'Searchterm is missing';
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
	protected function saveImage($input, $image_name)
	{
		if (Input::hasFile($image_name))
		{
			//-------------------------------------------------------------------------------------
			// Settings for saving image
			// Create a two base paths for images, one real and one virtual
			// Create directore if non existing based by month and year
			//-------------------------------------------------------------------------------------

			//TODO: add check 'is image'
			$year = date('y');
			$month = date('m');
			$rdm = str_random(5);

			$real_path = public_path() . '/images/' . $year . '/';
			if (!File::exists($real_path))
			{
				File::makeDirectory($real_path, 0774 , true);
			}

			$real_path = $real_path . $month . '/';
			if (!File::exists($real_path))
			{
				File::makeDirectory($real_path, 0774 , true);
			}

			//1: Path to public directory from root, 2: Path to store image
			$public_path_base = '/market/public/' . 'images/' . $year . '/' . $month . '/';
			$real_path_base = $real_path;

			//-------------------------------------------------------------------------------------
			// Image std size
			//-------------------------------------------------------------------------------------

			$file_name = $rdm . '_std_' .  $input[$image_name]->getClientOriginalName();

			$public_path = $public_path_base . $file_name;
			$real_path = $real_path_base . $file_name;

			//Resize image to max 700 width keeping aspect ratio
			$image = Image::make(Input::file($image_name)->getRealPath())->resize(700, null, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			})->save($real_path);

			$input[$image_name . '_std'] = $public_path;

			//-------------------------------------------------------------------------------------
			// Image thumb size
			//-------------------------------------------------------------------------------------

			$file_name = $rdm . '_thumb_' .  $input[$image_name]->getClientOriginalName();

			$public_path = $public_path_base . $file_name;
			$real_path = $real_path_base . $file_name;

			//Resize image to max 700 width keeping aspect ratio
			$image = Image::make(Input::file($image_name)->getRealPath())->resize(140, null, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			})->save($real_path);

			$input[$image_name . '_thumb'] = $public_path;

			//-------------------------------------------------------------------------------------
			// Image full size
			//-------------------------------------------------------------------------------------

			$file_name = $rdm . '_full_' .  $input[$image_name]->getClientOriginalName();

			$public_path = $public_path_base . $file_name;
			$real_path = $real_path_base . $file_name;

			//Resize image to max 700 width keeping aspect ratio
			$image = Image::make(Input::file($image_name))->save($real_path);

			$input[$image_name . '_full'] = $public_path;

			//-------------------------------------------------------------------------------------
		}

		return $input;
	}

	protected function addMarketMenu($market)
	{
		//dd($market);

		if(Auth::check()) {
			$id = Auth::id();
			$temp = array();
			//dd($id);
			//Adds link to edit market if it's created by logged in user
			if ($id == $market->createdByUser ) {
				$temp[] = array('text' => 'Redigera', 'href' => route('markets.edit', $market->id ));
				$temp[] = array('text' => 'Avslutad', 'href' => route('markets.delete', $market->id ));
			}

			//TODO: Check if market is blocked, then ad link to unblock instead
			$temp[] = array('text' => 'Dölj annons', 'href' => route('accounts.blockMarket', $market->id ));
			//TODO: Check if market is seller, then ad link to unblock instead
			$temp[] = array('text' => 'Dölj säljare', 'href' => route('accounts.blockSeller', $market->createdByUser ));

//			dd($temp);
//			dd(gettype($market));
//			dd($market);

//			$market->offsetSet('marketmenu', $temp);

			$market['marketmenu'] = $temp;

//			dd($market);
		}
	}

	protected function filterMarket()
	{

	}

}
