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

class PagesController extends ApplicationController {

	/*
	|--------------------------------------------------------------------------
	| Pages Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
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
	public function index()
	{	
		// $visa_96_hours_qry = PricingMaster::where('product_id', 1)
  //                    ->get()->first();
  //       $visa_96_hours = $visa_96_hours_qry->price;
  //                    // print_r($visa_96_hours);exit;
  //       $visa_30_days_qry = PricingMaster::where('product_id', 3)
  //                    ->get()->first();
  //       $visa_30_days = $visa_30_days_qry->price;
  //       $visa_90_days_qry = PricingMaster::where('product_id', 4)
  //                    ->get()->first();
  //       $visa_90_days = $visa_90_days_qry->price;
  //                    //print_r($visa_96_hours);exit;
  //       $visa_14_days_qry = PricingMaster::where('product_id', 2)
  //                    ->get()->first();
  //       $visa_14_days = $visa_14_days_qry->price;
		$get_country = DB::table('countries')
						->select(DB::raw("country_id, country_code, country_name, is_residing"))
						->where('enabled', 'Y')
						->get();
		return view('pages/index',compact('get_country'));			
	}

	public function visaapplication(Request $request){
		$getrequest = $request->all();
		echo "<pre>";print_r($getrequest);exit;
	}

	public function enquiry(Request $request)
	{

		$getrequest = $request->all();
		$contact = Contact::create($request->all());
		$sendmail = new ApplicationController;
		$to = env("SUPPORT_EMAIL_ID", "");
		$subject = "RCA Website - Enquiry";
		$name = $getrequest['f_name_frm'] . $getrequest['l_name_frm'];
        $content = "Hi Team, <br> There is an enquiry from RCA Website. The details are as given below.<br>Name: $name <br> Email: ".$getrequest['email_frm']."<br>Phone: ".$getrequest['phone_frm'] ."<br>Service: " . $getrequest['enq_services'];
		$sendmail->sendEmail($getrequest['email_frm'], $to,null,null,$subject, $content);

	}

	public function mnaEnquiry(Request $request)
	{
		$getrequest = $request->all();
		$sendmail = new ApplicationController;
		$to = env("SUPPORT_EMAIL_ID", "");
		$subject = "RCA Website - M&A Enquiry";
		$name = $getrequest['mna_name'];
        $content = "Hi Team, <br> There is an enquiry from RCA Website for M&A. The details are as given below.<br>Name: $name <br> Email: ".$getrequest['mna_email']."<br>Phone: ".$getrequest['mna_phone'] ."<br>M&A Service: " . $getrequest['mna_service'];
		$sendmail->sendEmail($getrequest['mna_email'], $to,null,null,$subject, $content);
	}

	public function loungEnquiry(Request $request)
	{
		$getrequest = $request->all();
		$sendmail = new ApplicationController;
		$to = env("SUPPORT_EMAIL_ID", "");
		$subject = "RCA Website - Lounge Enquiry";
		$name = $getrequest['lounge_name'];
        $content = "Hi Team, <br> There is an enquiry from RCA Website for M&A. The details are as given below.<br>Name: $name <br> Email: ".$getrequest['lounge_email']."<br>Phone: ".$getrequest['lounge_phone'] ."<br>Lounge Service: " . $getrequest['lounge_other_service'];
		$sendmail->sendEmail($getrequest['lounge_email'], $to,null,null,$subject, $content);
	}

	public function meetAndAssist()
	{
		return view('pages/meet_and_assist');
	}

	public function lounge()
	{
		return view('pages/lounge');
	}

	public function faq()
	{
		return view('pages/faq');
	}

	public function testimonial()
	{
		return view('pages/testimonial');
	}

	public function contact()
	{
		return view('pages/contact');
	}

	public function visa_30_days()
	{
		$visa_30_days_qry = PricingMaster::where('product_id', 3)
                                         ->get()->first();
        $visa_30_days = $visa_30_days_qry->price;
        $visa_96_hours_qry = PricingMaster::where('product_id', 1)
                     ->get()->first();
        $visa_96_hours = $visa_96_hours_qry->price;
                     // print_r($visa_96_hours);exit;
        $visa_90_days_qry = PricingMaster::where('product_id', 4)
                     ->get()->first();
        $visa_90_days = $visa_90_days_qry->price;
                     //print_r($visa_96_hours);exit;
        $visa_14_days_qry = PricingMaster::where('product_id', 2)
                     ->get()->first();
        $visa_14_days = $visa_14_days_qry->price;
		return view('pages/visa_30_days',compact('visa_96_hours', 'visa_30_days','visa_90_days','visa_14_days'));
	}

	public function visa_90_days()
	{
		$visa_90_days_qry = PricingMaster::where('product_id', 4)
                                         ->get()->first();
        $visa_90_days = $visa_90_days_qry->price;
        $visa_96_hours_qry = PricingMaster::where('product_id', 1)
                     ->get()->first();
        $visa_96_hours = $visa_96_hours_qry->price;
                     // print_r($visa_96_hours);exit;
        $visa_30_days_qry = PricingMaster::where('product_id', 3)
                     ->get()->first();
        $visa_30_days = $visa_30_days_qry->price;
                     //print_r($visa_96_hours);exit;
        $visa_14_days_qry = PricingMaster::where('product_id', 2)
                     ->get()->first();
        $visa_14_days = $visa_14_days_qry->price;
		return view('pages/visa_90_days',compact('visa_96_hours', 'visa_30_days','visa_90_days','visa_14_days'));
	}

	public function visa_96_hrs()
	{
		$visa_96_hrs_qry = PricingMaster::where('product_id', 1)
                                         ->get()->first();
        $visa_96_hours = $visa_96_hrs_qry->price;
                             // print_r($visa_96_hours);exit;
        $visa_30_days_qry = PricingMaster::where('product_id', 3)
                     ->get()->first();
        $visa_30_days = $visa_30_days_qry->price;
        $visa_90_days_qry = PricingMaster::where('product_id', 4)
                     ->get()->first();
        $visa_90_days = $visa_90_days_qry->price;
                     //print_r($visa_96_hours);exit;
        $visa_14_days_qry = PricingMaster::where('product_id', 2)
                     ->get()->first();
        $visa_14_days = $visa_14_days_qry->price;
		return view('pages/visa_96_hrs',compact('visa_96_hours', 'visa_30_days','visa_90_days','visa_14_days'));
	}

	public function visa_14_days()
	{
		$visa_14_days_qry = PricingMaster::where('product_id', 2)
                                         ->get()->first();
        $visa_14_days = $visa_14_days_qry->price;
        $visa_96_hours_qry = PricingMaster::where('product_id', 1)
                     ->get()->first();
        $visa_96_hours = $visa_96_hours_qry->price;
                     // print_r($visa_96_hours);exit;
        $visa_30_days_qry = PricingMaster::where('product_id', 3)
                     ->get()->first();
        $visa_30_days = $visa_30_days_qry->price;
        $visa_90_days_qry = PricingMaster::where('product_id', 4)
                     ->get()->first();
        $visa_90_days = $visa_90_days_qry->price;
                     //print_r($visa_96_hours);exit;
        return view('pages/visa_14_days',compact('visa_96_hours', 'visa_30_days','visa_90_days','visa_14_days'));
	}


	public function termsAndConditions()
	{
		return view('pages/terms_and_conditions');
	}

	public function sitemap()
	{
		return view('pages/sitemap');
	}

	public function privacyPolicy()
	{
		return view('pages/privacy_policy');
	}

	public function about()
	{
		return view('pages/about');
	}

	public function contact_submit(Request $request)
	{

		$getrequest = $request->all();
		$contact = Contact::create($request->all());
		echo "Thank you! We'll get back to you.";
		$sendmail = new ApplicationController;
		$to = env("SUPPORT_EMAIL_ID", "");
		$subject = "RCA Contact Email";
		$sendmail->sendEmail($getrequest['contact_email'],$to,null,null,$subject, $getrequest['contact_content']);
	}

	public function thankyoulp(Request $request){
		return view('pages/thankyoulp');
	}

	public function ajaxopenproduct($id){

		$data_arr = array();

		$get_prod_data = ProductMaster::where('product_id', $id)
                     ->get()->first();

	    // $get_prod_data = DB::table('product_master')
        // ->join('pricing_master', function ($join) {
        //     $join->on('product_master.product_id', '=', 'pricing_master.p_id')
        //          ->where('product_master.product_id', '=', $id);
        // })
        // ->get()->first(); 

                 
        
        if(!empty($get_prod_data)){
        	$data_arr = array(
        		'product_id'=>$get_prod_data->product_id,
        		'product_name'=>$get_prod_data->product_name,
        		'product_validity'=>$get_prod_data->product_validity,
        		'product_type'=>$get_prod_data->product_type,
        		'active'=>$get_prod_data->is_active
        	);
        }

        //echo "<pre>";print_r($getproduct);exit;         
		return Response::json($data_arr);
	}

	public function ajaxgetairline(){
		$get_airline = DB::table('airline_details')
						->select(DB::raw("airline_id, airline_name, code, terminal"))
						->get();
		//return Response::json($get_airline);
		return json_encode($get_airline);				
	}

	public function ajaxgetcountry(){
		$get_country = DB::table('countries')
						->select(DB::raw("country_id, country_code, country_name, is_residing"))
						->where('is_residing', 'Y')
						->get();
		//return Response::json($get_airline);
		return json_encode($get_country);				
	}

	public function ajaxgetcountrybyname(Request $request) {
		$getrequest = $request->all();

		$get_country = DB::table('countries')
						->select(DB::raw("country_id, country_code, country_name, is_residing"))
						->where('enabled', 'Y')
						->where('country_code',"!=",$getrequest['country_code'])
						->get();
		//return Response::json($get_airline);
		return json_encode($get_country);
	}


	public function ajaxgetproductprice(Request $request){
		$getrequest = $request->all();

		try{
			$price_qry = DB::table('pricing_master')
						->where('product_id',$getrequest['product_id'])
						->where('person_type',$getrequest['person_type'])
						->first();	
		} catch(\Illuminate\Database\QueryException $ex){
			dd($ex->getMessage());
		} catch(PDOException $ex){
			dd($ex->getMessage());
		}
		
		return Response::json($price_qry);
	}

	public function ajaxsubmitdata(Request $request){
		$getrequest = $request->all();
		// echo "<pre>";print_r($getrequest);exit;
		$data_user = array(
			'uid'=>'',
			'username'=>$getrequest['first_name'],
			'email'=> $getrequest['email'],
			'phone'=> $getrequest['phone'],
			'nationality' => "Indian"
		);

		if(empty($data_user['uid'])){
			$uid = DB::table('users')
    		->insertGetId(
            	['email_id' => $data_user['email'], 'mobile_no'=>$data_user['phone'], 'username'=> $data_user['username'], 'nationality'=> $data_user['nationality']]
    		);
		}
		
		if(!empty($uid)){
			$ordid = OrderDetails::select(DB::raw('max(order_id) as ord_id'))->get()->first();
						
			$data_ord = array(
				'order_id'=>'',
				'order_code'=> "order-".$ordid->ord_id,
				'user_id'=> $uid,
				'product_id'=> !empty($getrequest['product_id'])?$getrequest['product_id']:0,
				//'product_id'=> 3,
				'adult'=> !empty($getrequest['adult'])?$getrequest['adult']:0,
				'child'=> !empty($getrequest['child'])?$getrequest['child']:0,
				'infant'=> !empty($getrequest['infant'])?$getrequest['infant']:0,
				'nationality'=> !empty($getrequest['nation'])?'2':0,
				'total_price'=> !empty($getrequest['product_price'])?$getrequest['product_price']:0,
				'travel_date'=> !empty($getrequest['traval_date'])?$getrequest['traval_date']:NULL,
				'applicant_booking_status'=> "applied",
				'created_at'=> date('Y-m-d H:i:s')
			);
			//echo "<pre>";print_r($data_ord);exit;
			if(empty($data_ord['order_id'])){
				
				$ord_details = new OrderDetails;
				$ord_details->order_code = 	$data_ord['order_code'];
				$ord_details->user_id = 	$data_ord['user_id'];
				$ord_details->product_id = 	$data_ord['product_id'];
				$ord_details->adult = 		$data_ord['adult'];
				$ord_details->child = 		$data_ord['child'];
				$ord_details->infant = 		$data_ord['infant'];
				$ord_details->nationality = $data_ord['nationality'];
				$ord_details->total_price = $data_ord['total_price'];
				$ord_details->travel_date = $data_ord['travel_date'];
				$ord_details->created_at = 	$data_ord['created_at'];
				$ord_details->applicant_booking_status = $data_ord['applicant_booking_status'];

				$ord_details->save();

				$ordid = $ord_details->order_id;
			}

			return Response::json($ordid);
		}
	}

	public function showLogin(){
		// show the form
    	return view('pages/login');
	}

	public function attemptLogin(Request $request){
		// validate the info, create rules for the inputs
		$rules = array(
		    'email_id'    => 'required|email', // make sure the email is an actual email
		    'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		$getrequest = $request->all();

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
		
    	// if the validator fails, redirect back to the form
		if ($validator->fails()) {
		    return Redirect::to('/login')
		        ->withErrors($validator) // send back all errors to the login form
		        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {
			$salt = "VZF^T";
		    $user = Users::where([
        	'email_id' => $getrequest['email_id'],
        	'password' => md5($salt.$getrequest['password'])
    		])->first();

		    // echo "<pre>";print_r($user);exit;
    		// attempt to do the login
		    if ($user) {

		    	Session::put('email_id', $user->email_id);
		    	Session::put('user_id', $user->user_id);
		    	Session::put('username', $user->username);

		    	// $remember_me = ($getrequest['remember'] == 1)? true : false;
       //          Auth::loginUsingId($user->user_id,$remember_me);

		    	// $this->guard()->login($user, $request->has('remember'));
		    	return Redirect::to('/orders/my-account');
		        // validation successful!
		        // redirect them to the secure section or whatever
		        // return Redirect::to('secure');
		        // for now we'll just echo success (even though echoing in a controller is bad)
		        // echo 'SUCCESS!';

		    } else {        

		        // validation not successful, send back to form 
		        return Redirect::to('/login');

		    }

    	}
	}

	public function userregister(Request $request){
		$getrequest = $request->all();
		//echo "<pre>";print_r($getrequest);//exit;

		// validate the info, create rules for the inputs
		$rules = array(
			'full_name'=> 'required',
		    'email_id' => 'required|email', // make sure the email is an actual email
		    'password' => 'required|min:5' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);
		
    	// if the validator fails, redirect back to the form
		if ($validator->fails()) {
		    // return Redirect::back()->withErrors($validator);
		}else{
			$salt = "VZF^T";
			$user = Users::where([
        	'email_id' => $getrequest['email_id']
    		])->first();
    		// echo "<pre>";print_r($user);exit;

			if(!$user){
				$saveuser = new Users;

				$saveuser->username = $getrequest['full_name'];
				$saveuser->email_id = $getrequest['email_id'];
				$saveuser->password = md5($salt.$getrequest['password']);
				$saveuser->salt = $salt;

				$saveuser->save();

				return Redirect::to('/login');
			}

		}

		return view('pages/sign-up');

	}

	public function resetformshow(){
		return view('pages/reset');
	}

	public function sendPasswordResetToken(Request $request){
		$user = Users::where ('email_id', $request->email)
						->orderby('user_id', 'DESC')
						->first();
    	if ( !$user ) return redirect()->back()->withErrors(['error' => '404']);

    	$user->token = str_random(60);
    	$user->update();

    	$token = $user->token;
   		$email = $request->email;
   		$url = url('reset-password/'.$token);

   		$sendmail = new ApplicationController;

		$sendmail->sendEmail("smitha@thewhiteboard.company",$email,null,null,$url);

	}

	public function showPasswordResetForm($token)
	{
	    $tokenData = Users::where ('token', $token)
						->orderby('user_id', 'DESC')
						->first();

	     if ( !$tokenData ) return redirect()->to('/'); //redirect them anywhere you want if the token does not exist.
	     $token = $tokenData->token;
	     return view('pages/password_reset', compact('token'));
	}

	public function resetPassword(Request $request, $token)
	{
		$getrequest = $request->all();
		// echo "<pre>";print_r($getrequest);exit;
	     //some validation
		 $salt = "VZF^T";
	     $password = $getrequest['password'];

	    $rules = array(
		    'password' => 'required|confirmed' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
		    return Redirect::to('/reset-password/'.$token)
		        ->withErrors($validator) // send back all errors to the login form
		        ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		}else{
			$tokenData = Users::where ('token', $token)
						->orderby('user_id', 'DESC')
						->first();
			$user = Users::where('user_id', $tokenData->user_id)->first();
		     if ( !$user ) return redirect()->to('/'); //or wherever you want

		     $user->password = md5($salt.$password);
		     $user->token = NULL;
		     $user->update(); //or $user->save();

		     return Redirect::to('/login');

		    // If the user shouldn't reuse the token later, delete the token 
		    // DB::table('password_resets')->where('email', $user->email)->delete();

		    //redirect where we want according to whether they are logged in or not.
		}
	}

	public function logout(){
		Session::flush(); // log the user out of our application
    	return Redirect::to('login'); // redirect the user to the login screen
	}

	public function lpcambodia(){
		// show the form
    	return view('landingpages/cambodia');
	}

	public function lphongkong(){
		// show the form
    	return view('landingpages/hong-kong');
	}

	public function lpmalaysia(){
		// show the form
    	return view('landingpages/malaysia');
	}

	public function lpsrilanka(){
		// show the form
    	return view('landingpages/srilanka');
	}

	public function lpturkey(){
		// show the form
    	return view('landingpages/turkey');
	}

	public function lpvietnam(){
		// show the form
    	return view('landingpages/vietnam');
	}

	//RCAV1-168 - START
	public function lpoman(){
    	return view('landingpages/oman');
	}
	//RCAV1-168 - END

	//RCAS-2 START
	public function get_all_country(){

		//$country_resultset = DB::select("SELECT distinct(country_code),country FROM pricing_master");
		$country_resultset = DB::table('pricing_master')
						->select(DB::raw("DISTINCT country_code, country"))
						->where('country_code','<>', 'NA')
						->where('product_category','=', 'M&A')
						->where('is_active', 'Y')
						->get();
		return Response::json($country_resultset);				
	}

	public function get_all_cities_by_country_code($country_code){

		//$country_resultset = DB::select("SELECT distinct(country_code),country FROM pricing_master");
		$city_resultset = DB::table('pricing_master')
						->select(DB::raw("DISTINCT city"))
						->where('country_code', $country_code)
						->where('is_active', 'Y')
						->get();
		return Response::json($city_resultset);				
	}

	public function get_all_country_for_lounge(){

		//$country_resultset = DB::select("SELECT distinct(country_code),country FROM pricing_master");
		$country_resultset = DB::table('pricing_master')
						->select(DB::raw("DISTINCT country_code, country"))
						->where('product_category','=', 'Lounge')
						->where('is_active', 'Y')
						->get();
		return Response::json($country_resultset);				
	}


	public function get_all_airports_by_city($city){

		//$country_resultset = DB::select("SELECT distinct(country_code),country FROM pricing_master");
		$airport_resultset = DB::table('pricing_master')
						->select(DB::raw("DISTINCT airport_code,airport"))
						->where('city', $city)
						->where('is_active', 'Y')
						->get();
		return Response::json($airport_resultset);				
	}

	//RCAS-2 END

	//RCAV1-35 Notification Mailer
	public function ajaxenquirymailer(Request $request)
	{

		$getrequest = $request->all();
		$error = array();
		// echo "<pre>";print_r($getrequest);exit;
		$sendmail = new ApplicationController;
		if(!empty($getrequest['email'])){
			$to = $getrequest['email'];
			$subject = "Thank You for enquiring with RedCarpet Assist";
			$from = "support@redcarpetassist.com";
			$name = $getrequest['first_name'] ."&nbsp;". $getrequest['last_name'];
	        $content = "Dear ".$name.",<br><p>Thank you for your interest in our services. We take great pride in exceptional customer service and our team will get in touch with you shortly to answer all your questions.</p><p>In case you do need to get in touch with us urgently, please do call us at +91 22 6253 8600 or email us at <a href='mailto:customercare@redcarpetassist.com?Subject=Thank You for enquiring with RedCarpet Assist' target='_top'>customercare@redcarpetassist.com</a>. We work Monday to Saturday, 10 am to 8pm Indian Standard Time (GMT +5.30)</p><p>In the meanwhile, please do check our reviews on Facebook and Google.</p><p>We look forward to welcoming you as our customer.</p><p>Your <span style='color:#ED1C24;'>RedCarpet</span> Assist Team.</p><p><i>Add support@redcarpetassist.com to your address book to ensure that our mails reach your Inbox.</i></p>";
			$sendmail->sendEmail($from, $to,null,null,$subject, $content);
			$error['status'] = "success";
			$error['msg'] = "Send Mail Successful";
		}else{
			$error['status'] = "fail";
			$error['msg'] = "Somthing Worng not Sending Mail";
		}

		return json_encode($error);exit;
	}

	public function ajaxpaymentcancelmailer(Request $request)
	{

		$getrequest = $request->all();
		$error = array();
		// echo "<pre>";print_r($getrequest);exit;
		$sendmail = new ApplicationController;
		if(!empty($getrequest['email'])){
			$to = $getrequest['email'];
			$subject = "We received a Payment Cancellation Update";
			$from = "support@redcarpetassist.com";
			$name = $getrequest['username'];
	        $content = "Dear ".$name.",<br><p>Thank you for your interest in our services. We notice that you changed your mind while making the payment. Our services have been highly recommended by other customers and you can read the reviews <a href='https://www.redcarpetassist.com/testimonial' title='RedCarpet Assist'>here</a></p><p>Our team will get in touch with you shortly to help you through your transaction.</p><p>In case you do need to get in touch with us urgently, please do call us at +91 22 6253 8600 or email us at <a href='mailto:customercare@redcarpetassist.com?Subject=We received a Payment Cancellation Update' target='_top'>customercare@redcarpetassist.com</a>. We work Monday to Saturday, 10 am to 8pm Indian Standard Time (GMT +5.30)</p><p>Your <span style='color:#ED1C24;'>RedCarpet</span> Assist Team.</p><p><i>Add support@redcarpetassist.com to your address book to ensure that our mails reach your Inbox.</i></p>";
			$sendmail->sendEmail($from, $to,null,null,$subject, $content);
			$error['status'] = "success";
			$error['msg'] = "Send Mail Successful";
		}else{
			$error['status'] = "fail";
			$error['msg'] = "Somthing Worng not Sending Mail";
		}

		return json_encode($error);exit;
	}
}
