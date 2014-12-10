<?php namespace market\Http\Controllers;

use Illuminate\Routing\Controller as ControllerMarket;
use market\Market;
use Illuminate\Http\Request;
use Input;
//use Image;
use market\Http\Requests\CreateMarketRequest;
use File;

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
//        return 'data';
		$temp = Market::all();
		/*$temp = dd($temp);*/
		
		
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
		/*
		Input :all
		
		If input has file x
			Create directory if not exist based on year and month
			Save full image path as variable
			Save public image path as variable
			Resize image and save it to the path
				thumb, std and full
			add public path to input
			
		create model from input
		
		redirekt to list
		*/
		
		$input = Input::all();
		//dd($input);
		
		$input = $this->saveImage($input, 'image1');
		$input = $this->saveImage($input, 'image2');
		$input = $this->saveImage($input, 'image3');
		$input = $this->saveImage($input, 'image4');
		$input = $this->saveImage($input, 'image5');
		$input = $this->saveImage($input, 'image6');

		//dd($input);
		
		$market->create($input);
		
		return redirect()->route('markets.index');
	}
	
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
	
	/**
	 * Display the specified resource.
	 * GET /markets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($market)
	{
		$temp = Market::find($market);
		/*dd($temp);*/
		
		
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
		//dd($market);
		
		$temp = Market::find($market);
		//$temp['image1'] = 'testpath';
		
		//dd($temp);
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
		$input = Input::all();
		$temp = Market::find($id);
		/*
		dd($temp);*/
		
		$input = $this->saveImage($input, 'image1');
		$input = $this->saveImage($input, 'image2');
		$input = $this->saveImage($input, 'image3');
		$input = $this->saveImage($input, 'image4');
		$input = $this->saveImage($input, 'image5');
		$input = $this->saveImage($input, 'image6');
		
		//dd($temp);
		
		$temp->fill($input)->save();
		
		//dd($temp);
		
		return redirect()->route('markets.index');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /markets/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    public function search()
    {
        $search = Input::get('s');
        if(isset($search)){
            return $search;
        }

        return 'Searchterm is missing';
    }

}
