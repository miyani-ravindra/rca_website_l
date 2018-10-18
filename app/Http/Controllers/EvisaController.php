<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Session\Store;
use App\Models\Contact;
use App\Models\PricingMaster;
use App\Models\ProductMaster;
use App\Models\PresaleQuestions;
use App\Models\AirlineDetails;
use App\Models\OrderDetails;
use App\Models\Users;
//use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Response;
use Session;

class EvisaController extends ApplicationController {

	/*
	|--------------------------------------------------------------------------
	| Evisa Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "SEO marketing page" for the application and
	| is configured to allow everyone to use.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//$this->middleware('guest');
	}

	/**
	 * Show the application home screen to the user.
	 *
	 * @return Response
	 */
	public function india()
	{	
		return view('seo_pages/india');				
	}
	public function srilanka()
	{	
		return view('seo_pages/srilanka');				
	}
	public function hongkong()
	{	
		return view('seo_pages/hongkong');				
	}
	public function turkey()
	{	
		return view('seo_pages/turkey');				
	}
	public function combodia()
	{	
		return view('seo_pages/combodia');				
	}
	public function vietnam()
	{	
		return view('seo_pages/vietnam');				
	}
	
}
