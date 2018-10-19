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
use App\Models\EvisaPurpose;
use App\Models\EvisaAppDetails;
use App\Models\ProductMaster;
use App\Models\PresaleQuestions;
use App\Models\AirlineDetails;
use App\Models\AirportDetails;
use App\Models\PassportTypes;
use App\Models\OrderDetails;
use App\Models\Users;
use App\Models\ApplicantProfiles;
use App\Models\ApplicantTypes;
use App\Models\DocumentDetails;
use App\Models\UserLeads;
use App\Models\UserserviceDetails;
use App\Models\OccupationDetails;
use App\Models\ApplicationrelationDetails;
use App\Models\ApplicationserviceDetails;
use App\Models\VisatypeDetails;
use App\Models\PassportDetails;
use DB;
use Response;
use Session;
use ImageManipulator;
use SolidusMRZ;
use RenderXMLForm;
use Typeform;
use Commonfunction;

// include(app_path() . '/ocr/ImageManipulator.php');
$path = getenv('PATH'); 
putenv("PATH=$path:/usr/local/bin");
use thiagoalessio\TesseractOCR\TesseractOCR;
use Deft\MrzParser\MrzParser;

class HongKongapplicationController extends ApplicationController {

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

public function saveUserDetails($getpostdata){
	$uid = Users::firstOrCreate(['email_id' => $getpostdata['email']]);
    $uid->email_id  = $getpostdata['email']; 
    $uid->mobile_no = $getpostdata['phone']; 
    $uid->username  = $getpostdata['username']; 
    $uid->nationality = $getpostdata['nationality']; 
    $uid->created_at = $getpostdata['created_at'];

    $uid->save();

    return $uid->user_id;	
}
	
public function saveOrderDetails($getpostdata){
	$ord_details = OrderDetails::firstOrCreate(['order_code'=>$getpostdata['order_code']]);
	$ord_details->order_code = 	$getpostdata['order_code'];
	$ord_details->user_id = 	$getpostdata['user_id'];
	$ord_details->product_id = 	$getpostdata['product_id'];
	$ord_details->adult = 		$getpostdata['adult'];
	$ord_details->child = 		$getpostdata['child'];
	$ord_details->infant = 		$getpostdata['infant'];
	$ord_details->nationality = $getpostdata['nationality'];
	$ord_details->total_price = $getpostdata['total_price'];
	$ord_details->residing_in = $getpostdata['residing_in'];
	$ord_details->residing_code = $getpostdata['residing_code'];
	$ord_details->travel_to = $getpostdata['travel_to'];
	$ord_details->citizen_to = $getpostdata['citizen_to'];
	$ord_details->passport_type = $getpostdata['passport_type'];
	$ord_details->airport_code = $getpostdata['airport_code'];
	$ord_details->arrival_date = $getpostdata['arrival_date'];
	$ord_details->created_at = 	$getpostdata['created_at'];
	$ord_details->is_review_updated = !empty($getpostdata['is_review_updated'])?$getpostdata['is_review_updated']:"N";
	$ord_details->applicant_booking_status = $getpostdata['applicant_booking_status'];

	$ord_details->save();

	$ordid = $ord_details->order_id;

	return $ordid;
}

public function saveOrderIdDetails($getpostdata){
	$ord_details = OrderDetails::firstOrCreate(['order_id'=>$getpostdata['order_id']]);
	$ord_details->order_code = 	$getpostdata['order_code'];
	$ord_details->user_id = 	$getpostdata['user_id'];
	$ord_details->product_id = 	$getpostdata['product_id'];
	$ord_details->adult = 		$getpostdata['adult'];
	$ord_details->child = 		$getpostdata['child'];
	$ord_details->infant = 		$getpostdata['infant'];
	$ord_details->nationality = $getpostdata['nationality'];
	$ord_details->total_price = $getpostdata['total_price'];
	$ord_details->residing_in = $getpostdata['residing_in'];
	$ord_details->residing_code = $getpostdata['residing_code'];
	$ord_details->travel_to = $getpostdata['travel_to'];
	$ord_details->citizen_to = $getpostdata['citizen_to'];
	$ord_details->passport_type = $getpostdata['passport_type'];
	$ord_details->airport_code = $getpostdata['airport_code'];
	$ord_details->arrival_date = $getpostdata['arrival_date'];
	$ord_details->created_at = 	$getpostdata['created_at'];
	$ord_details->is_review_updated = !empty($getpostdata['is_review_updated'])?$getpostdata['is_review_updated']:"N";
	$ord_details->applicant_booking_status = $getpostdata['applicant_booking_status'];

	$ord_details->save();

	$ordid = $ord_details->order_id;

	return $ordid;
}

public function saveApplicantProfile($getpostdata){
	$saveapplicant = ApplicantProfiles::firstOrCreate(['order_id'=>$getpostdata['order_id']]);

	$saveapplicant->user_id = $getpostdata['user_id'];
	$saveapplicant->username = $getpostdata['username'];
	$saveapplicant->surname = !empty($getpostdata['surname'])?$getpostdata['surname']:NULL;
	$saveapplicant->previous_name = !empty($getpostdata['previous_name'])?$getpostdata['previous_name']:NULL;
	$saveapplicant->previous_surname = !empty($getpostdata['previous_surname'])?$getpostdata['previous_surname']:NULL;
	$saveapplicant->dob = !empty($getpostdata['dob'])?$getpostdata['dob']:NULL;
	$saveapplicant->gender = !empty($getpostdata['gender'])?$getpostdata['gender']:NULL;
	$saveapplicant->mobile_number = !empty($getpostdata['mobile_number'])?$getpostdata['mobile_number']:NULL;
	$saveapplicant->nationality = !empty($getpostdata['nationality'])?$getpostdata['nationality']:NULL;
	$saveapplicant->place_of_birth = !empty($getpostdata['place_of_birth'])?$getpostdata['place_of_birth']:NULL;
	$saveapplicant->marital_status_id = !empty($getpostdata['marital_status_id'])?$getpostdata['marital_status_id']:NULL;
	$saveapplicant->country = !empty($getpostdata['country'])?$getpostdata['country']:NULL;
	$saveapplicant->order_id = $getpostdata['order_id'];
	$saveapplicant->is_submitted = "Y";

	$saveapplicant->save();
}

public function saveUserLeads($getpostdata){
	$saveuserlead = new UserLeads;

	$saveuserlead->name = !empty($getpostdata['name'])?$getpostdata['name']:NULL;
	$saveuserlead->phone_number = !empty($getpostdata['phone_number'])?$getpostdata['phone_number']:NULL;
	$saveuserlead->email_id = !empty($getpostdata['email_id'])?$getpostdata['email_id']:NULL;
	$saveuserlead->nationality = !empty($getpostdata['nationality'])?$getpostdata['nationality']:NULL;
	$saveuserlead->residing_in = !empty($getpostdata['residing_in'])?$getpostdata['residing_in']:NULL;
	$saveuserlead->travelling_to = !empty($getpostdata['travelling_to'])?$getpostdata['travelling_to']:NULL;
	$saveuserlead->passport_type = !empty($getpostdata['passport_type'])?$getpostdata['passport_type']:NULL;
	$saveuserlead->airport_code = !empty($getpostdata['airport_code'])?$getpostdata['airport_code']:NULL;
	$saveuserlead->arrival_date = !empty($getpostdata['arrival_date'])?$getpostdata['arrival_date']:NULL;
	$saveuserlead->product_id = $getpostdata['product_id'];
	$saveuserlead->order_id = $getpostdata['order_id'];
	$saveuserlead->session_id = $getpostdata['session_id'];
	$saveuserlead->created_at = $getpostdata['created_at'];
	$saveuserlead->status = $getpostdata['status'];

	$saveuserlead->save();
}

public function hongkongbasicdetails(Request $request) {
	$getrequest = $request->all();
	$ccode = "hongkong";
	$getsession = Session::get('track_details');
	$extractdata = array();
	$getpostdata = array();
	// echo "<pre>";print_r($ccode);exit;

	if(isset($getsession['order_id']) && isset($getsession['user_id'])){
			$getorderdetails = 	DB::table('order_details')
						->join('users','users.user_id','=','order_details.user_id')
						->where('order_details.order_id',$getsession['order_id'])
						->where('order_details.user_id',$getsession['user_id'])
						->first();
			$getpostdata = array(
		    	'order_id'=> !empty($getorderdetails->order_id)?$getorderdetails->order_id:NULL,
		    	'order_code'=> !empty($getorderdetails->order_code)?$getorderdetails->order_code:NULL,
		    	'user_id'=> !empty($getorderdetails->user_id)?$getorderdetails->user_id:NULL,
		    	'product_id'=> !empty($getorderdetails->product_id)?$getorderdetails->product_id:NULL,
		    	'travel_to'=> !empty($getorderdetails->travel_to)?$getorderdetails->travel_to:NULL,
		    	'citizen_to'=> !empty($getorderdetails->citizen_to)?$getorderdetails->citizen_to:NULL,
		    	'nationality'=> !empty($getorderdetails->nationality)?$getorderdetails->nationality:NULL,
		    	'email_id'=> !empty($getorderdetails->email_id)?$getorderdetails->email_id:NULL,
		    	'mobile_no'=> !empty($getorderdetails->mobile_no)?$getorderdetails->mobile_no:NULL,
		    	'username'=> !empty($getorderdetails->username)?$getorderdetails->username:NULL,
		    	'residing_code'=> !empty($getorderdetails->residing_code)?$getorderdetails->residing_code:NULL,
				'residing_in'=> !empty($getorderdetails->residing_in)?$getorderdetails->residing_in:NULL,
	    	);			
	} else {
		if(isset($getrequest) && !empty($getrequest)){
			$getpostdata = array(
				'travel_to'=> !empty($getrequest['travel_to_text'])?$getrequest['travel_to_text']:NULL,
				'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
				'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
				'nationality'=> !empty($getrequest['citizen_to_text'])?$getrequest['citizen_to_text']:NULL,
			);
		}	
	}	
	
	// echo "<pre>";print_r($extractdata);exit;
	return view('evisaapplication/hongkong-basicdetails', compact('ccode','getpostdata'));
}

public function evisahongkongform(Request $request){
	$getrequest = $request->all();
	$ccode = $request->route('ccode');
	$typeformurl = "";
	$webhooksurl = "";
	$formid = "";
	$getservice = "";
	$product_name = "";
	$arr_city__state = array();
	$country_arr = array();
	$occupation_arr = array();
	$data_name = array();
	$getpostdata = array();
	$getsession = Session::get('track_details');
	//echo "<pre>";print_r($ccode);exit;
	$getservice = PricingMaster::where('nationality', "India")
								->where('product_id',1)
								->first();
	$getmarital = DB::table('marital_status')->where('enabled','Y')->get();
	$getcity = DB::table('cities')->where('isactive','Y')->orderby('city_name','ASC')->get();
	$getstate = DB::table('states')->where('isactive','Y')->orderby('state_name','ASC')->get();
	$getcountry = DB::table('countries')->where('enabled','Y')->orderby('country_name','ASC')->get();
	$getoccupation = DB::table('tbl_occupation')->where('active','Y')->orderby('occupation_name','ASC')->get();

	if(count($getstate)>0 && count($getcity)>0){
		$arr_city__state = array_merge($getstate,$getcity);
	}
	rsort($arr_city__state);
	//echo "<pre>";print_r($arr_city__state);exit;
	foreach ($arr_city__state as $key => $value) {
		# code...
		if(isset($value->state_name) && !empty($value->state_name)){
			$data_name['data_arr'][] = $value->state_name;
		}else{
			$data_name['data_arr'][] = $value->city_name;
		}
		
	}

	
	foreach($getcountry as $key=>$val){
		$country_arr[] = $val->country_name;
	}

	foreach($getoccupation as $key=>$val){
		$occupation_arr[] = array('id'=>$val->id,'occupation_name'=>$val->occupation_name);
	}
	// echo "<pre>";print_r($getsession);exit;
	if(isset($getsession) && !empty($getsession['order_id'])){
		$getorderdetails = OrderDetails::join('users','users.user_id','=','order_details.user_id')->where('order_id','=',$getsession['order_id'])->first();

	    $applicant_id = ApplicantProfiles::where('order_id','=',$getsession['order_id'])->orderby('profile_id','DESC')->get()->first();

	    if(!empty($applicant_id->profile_id)){
	    	$getserviceiddetails = DB::table('tbl_user_service_details')->where('order_id','=',$getsession['order_id'])->where('applicant_id','=',$applicant_id->profile_id)->first();
	    }

	    if(!empty($applicant_id->profile_id)){
	    	$getpassportdetails = DB::table('passport_details')->where('applicant_id','=',$applicant_id->profile_id)->first();

	    	$getotherdetails = DB::table('application_relationdetails')->where('applicant_id','=',$applicant_id->profile_id)->first();

	    	$getmaritalname = DB::table('marital_status')->where('marital_status_id','=',$applicant_id->marital_status_id)->where('enabled','Y')->first();
	    }

	    $getservice = PricingMaster::where('nationality', "India")
								->where('product_id',1)
								->first();
		if(!empty($getserviceiddetails->purpose_id)){
			$getpurposename = DB::table('india_evisa_purpose')->where('purpose_id',$getserviceiddetails->purpose_id)->first();	
		}
		
	    $getpostdata = array(
	    	'order_id'=> !empty($getorderdetails->order_id)?$getorderdetails->order_id:NULL,
	    	'order_code'=> !empty($getorderdetails->order_code)?$getorderdetails->order_code:NULL,
	    	'uid'=> !empty($getorderdetails->user_id)?$getorderdetails->user_id:NULL,
	    	'product_id'=> !empty($getorderdetails->product_id)?$getorderdetails->product_id:NULL,
	    	'travel_to'=> !empty($getorderdetails->travel_to)?$getorderdetails->travel_to:NULL,
	    	'citizen_to'=> !empty($getorderdetails->citizen_to)?$getorderdetails->citizen_to:NULL,
	    	'nationality'=> !empty($getorderdetails->nationality)?$getorderdetails->nationality:NULL,
	    	'email_id'=> !empty($getorderdetails->email_id)?$getorderdetails->email_id:NULL,
	    	'phone_number'=> !empty($getorderdetails->mobile_no)?$getorderdetails->mobile_no:NULL,
	    	'profile_id'=> !empty($applicant_id->profile_id)?$applicant_id->profile_id:NULL,
	    	'username'=> !empty($applicant_id->username)?$applicant_id->username:NULL,
	    	'surname'=> !empty($applicant_id->surname)?$applicant_id->surname:NULL,
	    	'previous_surname'=> !empty($applicant_id->previous_surname)?$applicant_id->previous_surname:NULL,
	    	'previous_name'=> !empty($applicant_id->previous_name)?$applicant_id->previous_name:NULL,
	    	'dob'=> !empty($applicant_id->dob)?$applicant_id->dob:NULL,
	    	'gender'=> !empty($applicant_id->gender)?$applicant_id->gender:NULL,
	    	'marital_status_id'=> !empty($applicant_id->marital_status_id)?$applicant_id->marital_status_id:NULL,
	    	'marital_status_name'=> !empty($getmaritalname->marital_status_name)?$getmaritalname->marital_status_name:NULL,
	    	'place_of_birth'=> !empty($applicant_id->place_of_birth)?$applicant_id->place_of_birth:NULL,
	    	'service_id'=> !empty($getserviceiddetails->service_id)?$getserviceiddetails->service_id:NULL,
	    	'purpose_id'=> !empty($getserviceiddetails->purpose_id)?$getserviceiddetails->purpose_id:NULL,
	    	'purpose_name'=> !empty($getpurposename->purpose_name)?$getpurposename->purpose_name:NULL,
	    	'pp_no'=> !empty($getpassportdetails->pp_no)?$getpassportdetails->pp_no:NULL,
	    	'pp_issue_date'=> !empty($getpassportdetails->pp_issue_date)?$getpassportdetails->pp_issue_date:NULL,
	    	'pp_expiry_date'=> !empty($getpassportdetails->pp_expiry_date)?$getpassportdetails->pp_expiry_date:NULL,
	    	'pp_place_of_issue'=> !empty($getpassportdetails->pp_place_of_issue)?$getpassportdetails->pp_place_of_issue:NULL,
	    	'pres_add1'=> !empty($getotherdetails->pres_add1)?$getotherdetails->pres_add1:NULL,
	    	'state_name'=> !empty($getotherdetails->state_name)?$getotherdetails->state_name:NULL,
	    	'oth_add'=> !empty($getotherdetails->oth_add)?$getotherdetails->oth_add:NULL,
	    	'oth_country'=> !empty($getotherdetails->oth_country)?$getotherdetails->oth_country:NULL,
	    	'pres_phone'=> !empty($getotherdetails->pres_phone)?$getotherdetails->pres_phone:NULL,
	    	'application_details'=> !empty($getotherdetails->application_details)?json_decode($getotherdetails->application_details, true):NULL,
	    	'is_review_updated'=>!empty($getorderdetails->is_review_updated)?$getorderdetails->is_review_updated:NULL
	    );

	    if(!empty($getpostdata['application_details']['emp_sector'])){
	    	$getoccupationname = DB::table('tbl_occupation')->where('id',$getpostdata['application_details']['emp_sector'])->where('active','Y')->orderby('occupation_name','ASC')->first();
	    }
	}

	// echo "<pre>";print_r($getpostdata);exit;

	if(isset($getrequest) && !empty($getrequest)){
		if(empty($getpostdata['order_id'])){
			$data_user = array(
				'uid'=>'',
				'username'=>$getrequest['user_name'],
				'email'=> $getrequest['email_id'],
				'phone'=> $getrequest['phone_number'],
				'nationality' => $getrequest['citizen_to'],
				'created_at'=> date('Y-m-d H:i:s')
			);
				
			$uid = $this->saveUserDetails($data_user);

			$data_ord = array(
					'order_id'=>'',
					'order_code'=> 'RCAV'.date("ymd").rand(10000 , 99999),
					'user_id'=> $uid,
					'product_id'=> 1,
					'adult'=> 0,
					'child'=> 0,
					'infant'=> 0,
					'nationality'=> !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
					'total_price'=> NULL,
					'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
					'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
					'travel_to'=> !empty($getrequest['travel_to'])?$getrequest['travel_to']:NULL,
					'citizen_to'=> !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
					'passport_type'=> NULL,
					'airport_code'=> NULL,
					'arrival_date'=> NULL,
					//'typeform_token'=> !empty($ccode)?$ccode:NULL,
					'applicant_booking_status'=> "Evisa-HongKongBasicDetails",
					'created_at'=> date('Y-m-d H:i:s')
			);

			$ordid = $this->saveOrderDetails($data_ord);

			$user_leads_data = array(
				'session_id'=> session()->getId(),
				'name' => !empty($getrequest['user_name'])?$getrequest['user_name']:NULL,
				'phone_number' => !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL,
				'email_id'=> !empty($getrequest['email_id'])?$getrequest['email_id']:NULL,
				'nationality' => !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
				'residing_in' => !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
				'travelling_to' => !empty($getrequest['travel_to'])?$getrequest['travel_to']:NULL,
				'passport_type' => NULL,
				'airport_code' => NULL,
				'arrival_date' => NULL,
				'product_id' => 1,
				'order_id' => $ordid,
				'created_at' => date('Y-m-d H:i:s'),
				'status' => "Evisa-HongKongBasicDetails"	
			);

			$this->saveUserLeads($user_leads_data);

			$getorderdetails = OrderDetails::where('order_id','=',$ordid)
			        ->first();

			// $getpostdata = array(
			// 	'nationality'=> !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
			// 	'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
			// 	'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
			// 	'order_id'=> $ordid,
			// 	'order_code'=> !empty($getorderdetails['order_code'])?$getorderdetails['order_code']:NULL,
			// 	'uid'=> $uid,
			// 	'email_id'=> !empty($getrequest['email_id'])?$getrequest['email_id']:NULL,
			// 	'phone_number'=> !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL,
			// );

			$postData = array(
				'order_id'=>!empty($getorderdetails['order_id'])?$getorderdetails['order_id']:NULL,
				'uid'=>!empty($getorderdetails['user_id'])?$getorderdetails['user_id']:NULL,
				'order_code'=>!empty($getorderdetails['order_code'])?$getorderdetails['order_code']:NULL
			);


			UserLeads::where('order_id', $postData['order_id'])
			            ->update(['status'=>'Evisa-HongKongApplicationDetails']);

			OrderDetails::where('order_id', $postData['order_id'])
			            ->update(['applicant_booking_status'=>'Evisa-HongKongApplicationDetails']);

			    /* setcookie ("partial_form", 'verifyemail', time()+3600*24*(2), '/', "", 0 );
			    setcookie ("uid", $getpostdata['uid'], time()+3600*24*(2), '/', "", 0 );
				setcookie ("order_id", $getpostdata['order_id'], time()+3600*24*(2), '/', "", 0 ); */  
			if(!empty($postData['order_id']) && !empty($postData['uid'])){
				$track_data = array(
						'partial_form'=>"Evisa-HongKongApplicationDetails",
			            'order_id'=>$postData['order_id'],
			            'user_id'=>$postData['uid'],
			        );
			    Session::put('track_details', $track_data);	
			} 
			$getpostdata = array(
				'nationality'=> !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
				'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
				'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
				'order_id'=> !empty($postData['order_id'])?$postData['order_id']:NULL,
				'order_code'=> !empty($postData['order_code'])?$postData['order_code']:NULL,
				'uid'=> !empty($postData['uid'])?$postData['uid']:NULL,
				'email_id'=> !empty($getrequest['email_id'])?$getrequest['email_id']:NULL,
				'phone_number'=> !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL,
			);       
		} /*else {
			$getpostdata = array(
				'nationality'=> !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
				'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
				'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
				'order_id'=> !empty($getrequest['order_id'])?$getrequest['order_id']:NULL,
				'order_code'=> !empty($getrequest['order_code'])?$getrequest['order_code']:NULL,
				'uid'=> !empty($getrequest['uid'])?$getrequest['uid']:NULL,
				'email_id'=> !empty($getrequest['email_id'])?$getrequest['email_id']:NULL,
				'phone_number'=> !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL,
			);
		}*/
	}
	// echo "<pre>";print_r($getpostdata);exit;

	// echo "<pre>";print_r($postData);exit;
	
	return view('evisaapplication/evisahongkong', compact('ccode','getpostdata','getservice','getmarital','data_name','country_arr','occupation_arr','getoccupationname'));
}

public function savetypeformdata(Request $request){
	$getrequest = $request->all();
	$ccode = $request->route('ccode');
	// echo "<pre>";print_r($getrequest);exit;
	if(isset($getrequest) && !empty($getrequest)){
				$app_data = array(
							'user_id' => !empty($getrequest['uid'])?$getrequest['uid']:NULL,
							'username' => !empty($getrequest['passport_given_name'])?$getrequest['passport_given_name']:NULL,
							'surname' => !empty($getrequest['passport_surname_name'])?$getrequest['passport_surname_name']:NULL,
							'previous_name' => !empty($getrequest['oth_given_name'])?$getrequest['oth_given_name']:NULL,
							'previous_surname'=> !empty($getrequest['oth_surname_name'])?$getrequest['oth_surname_name']:NULL,
							'place_of_birth'=> !empty($getrequest['place_of_birth'])?$getrequest['place_of_birth']:NULL,
							'mobile_number' => !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL,
							'marital_status_id' => !empty($getrequest['marital_status_id'])?$getrequest['marital_status_id']:NULL,
							'dob' => !empty($getrequest['type_dob'])?$getrequest['type_dob']:NULL,
							'gender' => !empty($getrequest['gender'])?$getrequest['gender']:NULL,
							'nationality'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
							'order_id' => !empty($getrequest['order_id'])?$getrequest['order_id']:NULL
						);

						$this->saveApplicantProfile($app_data);

						$applicant_id = ApplicantProfiles::where('order_id','=',$getrequest['order_id'])->first();

						$savepassportdetails = PassportDetails::firstOrCreate(['applicant_id'=>$applicant_id->profile_id]);

						$savepassportdetails->user_id = !empty($getrequest['uid'])?$getrequest['uid']:NULL;
						$savepassportdetails->applicant_id = $applicant_id->profile_id;
						$savepassportdetails->pp_no = !empty($getrequest['passport_number'])?$getrequest['passport_number']:NULL;
						$savepassportdetails->pp_issue_date = !empty($getrequest['type_doi'])?$getrequest['type_doi']:NULL;
						$savepassportdetails->pp_expiry_date = !empty($getrequest['type_doe'])?$getrequest['type_doe']:NULL;
						$savepassportdetails->pp_place_of_issue = !empty($getrequest['place_of_issue'])?$getrequest['place_of_issue']:NULL;

						$savepassportdetails->save();
						
				    	$ppid = PassportDetails::where('applicant_id','=',$applicant_id->profile_id)->first();

				    	$saveservicedetails = UserserviceDetails::firstOrCreate(['order_id'=>$getrequest['order_id'],'service_id'=>4]);
						$saveservicedetails->service_id = 4;
						$saveservicedetails->purpose_id = $getrequest['purpose_visit'];
						$saveservicedetails->order_id = $getrequest['order_id'];
						$saveservicedetails->applicant_id = $applicant_id->profile_id;
						$saveservicedetails->user_id = $getrequest['uid'];
						$saveservicedetails->status = "Y";

						$saveservicedetails->save();

						$res_arr = array(
						'alias_is'=> !empty($getrequest['alias_is'])?$getrequest['alias_is']:NULL,
						'alias_given_name'=> !empty($getrequest['alias_given_name'])?$getrequest['alias_given_name']:NULL,
						'alias_surname_name'=> !empty($getrequest['alias_surname_name'])?$getrequest['alias_surname_name']:NULL,
						'pre_travel_hk'=> !empty($getrequest['is_travel_hk'])?$getrequest['is_travel_hk']:NULL,
						'res_add_india'=> !empty($getrequest['res_add_is'])?$getrequest['res_add_is']:NULL,
						'pre_add_hk'=> !empty($getrequest['hk_pass_number'])?$getrequest['hk_pass_number']:NULL,
						'pre_travel_oth'=> !empty($getrequest['is_travel_oth'])?$getrequest['is_travel_oth']:NULL,
						'pre_add_oth'=> !empty($getrequest['oth_pass_number'])?$getrequest['oth_pass_number']:NULL,
						'emp_sector'=> !empty($getrequest['emp_sector'])?$getrequest['emp_sector']:NULL,
						'name_of_com'=> !empty($getrequest['name_of_company'])?$getrequest['name_of_company']:NULL,
						'office_add'=> !empty($getrequest['add_of_company'])?$getrequest['add_of_company']:NULL,
						'office_city'=> !empty($getrequest['com_city_state'])?$getrequest['com_city_state']:NULL,
						'phone_com'=> !empty($getrequest['com_phone'])?$getrequest['com_phone']:NULL,
						'purpose_of_visit'=> !empty($getrequest['purpose_visit'])?$getrequest['purpose_visit']:NULL,
						'proposed_duration_stay'=> !empty($getrequest['purpose_day'])?$getrequest['purpose_day']:NULL,
						'accommodation_add_hk'=> !empty($getrequest['address_acco'])?$getrequest['address_acco']:NULL,
						'fund_travel_hksar'=> !empty($getrequest['hk_travel_fund'])?$getrequest['hk_travel_fund']:NULL,
						'local_conn_hk'=> !empty($getrequest['is_local_conn'])?$getrequest['is_local_conn']:NULL,
						'local_name_hk'=> !empty($getrequest['local_conn_name'])?$getrequest['local_conn_name']:NULL,
						'local_conn_relation'=> !empty($getrequest['local_conn_relative'])?$getrequest['local_conn_relative']:NULL,
						'difficulty_ret_india'=> !empty($getrequest['is_return_ind'])?$getrequest['is_return_ind']:NULL,
						'criminal_offence'=> !empty($getrequest['is_arrested'])?$getrequest['is_arrested']:NULL,
						'convicted_offence'=> !empty($getrequest['is_convicted'])?$getrequest['is_convicted']:NULL,
						'refused_visa'=> !empty($getrequest['is_refused'])?$getrequest['is_refused']:NULL,
						'refused_permission'=> !empty($getrequest['is_refused_per'])?$getrequest['is_refused_per']:NULL,
						'deported_country'=> !empty($getrequest['is_deported'])?$getrequest['is_deported']:NULL,
						'engaged_terrorist_activities'=> !empty($getrequest['is_engage'])?$getrequest['is_engage']:NULL,
						'oth_name_is'=> !empty($getrequest['oth_name_is'])?$getrequest['oth_name_is']:NULL
					);
				$saverelationdetails = ApplicationrelationDetails::firstOrCreate(['applicant_id'=>$applicant_id->profile_id]);
				$saverelationdetails->applicant_id = $applicant_id->profile_id;
				$saverelationdetails->pres_add1 = !empty($getrequest['red_add_ind'])?$getrequest['red_add_ind']:NULL;
				$saverelationdetails->oth_add = !empty($getrequest['red_add_oth'])?$getrequest['red_add_oth']:NULL;
				$saverelationdetails->oth_country = !empty($getrequest['district_city_oth'])?$getrequest['district_city_oth']:NULL;
				$saverelationdetails->pres_country = NULL;
				$saverelationdetails->state_name = !empty($getrequest['district_city'])?$getrequest['district_city']:NULL;
				$saverelationdetails->pres_phone = !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL;
				$saverelationdetails->application_details = !empty($res_arr)?json_encode($res_arr):NULL;
				
				$saverelationdetails->save();	
				
				$getorderdetails = OrderDetails::where('order_id','=',$getrequest['order_id'])
			        ->first();
			    $getservice = PricingMaster::where('nationality', "India")
								->where('product_id',1)
								->first();

				$saveFinalData = array(
					'nationality'=>!empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
					'order_id'=>!empty($getrequest['order_id'])?$getrequest['order_id']:NULL,
					'applicant_id'=>!empty($applicant_id->profile_id)?$applicant_id->profile_id:NULL,
					'uid'=>!empty($getrequest['uid'])?$getrequest['uid']:NULL,
					'type_of_visa'=>"eVisa-HongKong",
					'visa_service'=>!empty($getservice->product_name)?$getservice->product_name:NULL,
					'status'=>"Completed Form",
				);				

				$checkvisadetails = EvisaAppDetails::firstOrCreate(['order_id' => $saveFinalData['order_id']]);
				$checkvisadetails->order_id = $saveFinalData['order_id'];
				$checkvisadetails->applicant_id = $saveFinalData['applicant_id'];
				$checkvisadetails->uid = $saveFinalData['uid'];
				$checkvisadetails->type_of_visa = $saveFinalData['type_of_visa'];
				$checkvisadetails->visa_service = $saveFinalData['visa_service'];
				$checkvisadetails->created_at = date('Y-m-d H:i:s');
				$checkvisadetails->status = "Complete Form";

				$checkvisadetails->save();

		$postData = array(
		'order_id'=>$getorderdetails['order_id'],
		'applicant_id'=>$applicant_id->profile_id,
		'uid'=>$getrequest['uid'],
		'order_code'=>$getorderdetails['order_code']
		);


		UserLeads::where('order_id', $postData['order_id'])
	            ->update(['status'=>'Evisa-HongKongApplicationDetails']);

	    OrderDetails::where('order_id', $postData['order_id'])
	            ->update(['applicant_booking_status'=>'Evisa-HongKongApplicationDetails']);

	    /* setcookie ("partial_form", 'verifyemail', time()+3600*24*(2), '/', "", 0 );
	    setcookie ("uid", $getpostdata['uid'], time()+3600*24*(2), '/', "", 0 );
		setcookie ("order_id", $getpostdata['order_id'], time()+3600*24*(2), '/', "", 0 ); */  
		if(!empty($postData['order_id']) && !empty($postData['uid'])){
			$track_data = array(
						'partial_form'=>"Evisa-HongKongApplicationDetails",
	            		'order_id'=>$postData['order_id'],
	            		'user_id'=>$postData['uid'],
	            	);
	        Session::put('track_details', $track_data);	
		}		    
	}

	return view('evisaapplication/gettypeformresponse', compact('postData','ccode','getservice'));
}

public function ajaxautosavedata(Request $request) {
	$getrequest = $request->all();
	$error = array();
	// echo "<pre>";print_r($getrequest);exit;
	if($request->isMethod('post')){
		if(!empty($getrequest['order_id'])){
				$getlastorderid = OrderDetails::join('users','users.user_id','=','order_details.user_id')->where('order_id','=',$getrequest['order_id'])->first();
				$app_data = array(
						'user_id' => !empty($getrequest['uid'])?$getrequest['uid']:NULL,
						'username' => !empty($getrequest['passport_given_name'])?$getrequest['passport_given_name']:NULL,
						'surname' => !empty($getrequest['passport_surname_name'])?$getrequest['passport_surname_name']:NULL,
						'previous_name' => !empty($getrequest['oth_given_name'])?$getrequest['oth_given_name']:NULL,
						'previous_surname'=> !empty($getrequest['oth_surname_name'])?$getrequest['oth_surname_name']:NULL,
						'place_of_birth'=> !empty($getrequest['place_of_birth'])?$getrequest['place_of_birth']:NULL,
						'mobile_number' => !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL,
						'marital_status_id' => !empty($getrequest['marital_status_id'])?$getrequest['marital_status_id']:NULL,
						'dob' => !empty($getrequest['type_dob'])?$getrequest['type_dob']:NULL,
						'gender' => !empty($getrequest['gender'])?$getrequest['gender']:NULL,
						'nationality'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
						'order_id' => !empty($getrequest['order_id'])?$getrequest['order_id']:NULL
					);

				$this->saveApplicantProfile($app_data);

				$applicant_id = ApplicantProfiles::where('order_id','=',$getrequest['order_id'])->first();
				
				if(!empty($getrequest['passport_number'])){
					$savepassportdetails = PassportDetails::firstOrCreate(['applicant_id'=>$applicant_id->profile_id]);

					$savepassportdetails->user_id = !empty($getrequest['uid'])?$getrequest['uid']:NULL;
					$savepassportdetails->applicant_id = $applicant_id->profile_id;
					$savepassportdetails->pp_no = !empty($getrequest['passport_number'])?$getrequest['passport_number']:NULL;
					$savepassportdetails->pp_issue_date = !empty($getrequest['type_doi'])?$getrequest['type_doi']:NULL;
					$savepassportdetails->pp_expiry_date = !empty($getrequest['type_doe'])?$getrequest['type_doe']:NULL;
					$savepassportdetails->pp_place_of_issue = !empty($getrequest['place_of_issue'])?$getrequest['place_of_issue']:NULL;

					$savepassportdetails->save();
				}

				if(!empty($getrequest['purpose_visit'])){
					$saveservicedetails = UserserviceDetails::firstOrCreate(['order_id'=>$getrequest['order_id'],'service_id'=>4]);
					$saveservicedetails->service_id = 4;
					$saveservicedetails->purpose_id = $getrequest['purpose_visit'];
					$saveservicedetails->order_id = $getrequest['order_id'];
					$saveservicedetails->applicant_id = $applicant_id->profile_id;
					$saveservicedetails->user_id = $getrequest['uid'];
					$saveservicedetails->status = "Y";

					$saveservicedetails->save();
				}

				$res_arr = array(
						'alias_is'=> !empty($getrequest['alias_is'])?$getrequest['alias_is']:NULL,
						'alias_given_name'=> !empty($getrequest['alias_given_name'])?$getrequest['alias_given_name']:NULL,
						'alias_surname_name'=> !empty($getrequest['alias_surname_name'])?$getrequest['alias_surname_name']:NULL,
						'pre_travel_hk'=> !empty($getrequest['is_travel_hk'])?$getrequest['is_travel_hk']:NULL,
						'res_add_india'=> !empty($getrequest['res_add_is'])?$getrequest['res_add_is']:NULL,
						'pre_add_hk'=> !empty($getrequest['hk_pass_number'])?$getrequest['hk_pass_number']:NULL,
						'pre_travel_oth'=> !empty($getrequest['is_travel_oth'])?$getrequest['is_travel_oth']:NULL,
						'pre_add_oth'=> !empty($getrequest['oth_pass_number'])?$getrequest['oth_pass_number']:NULL,
						'emp_sector'=> !empty($getrequest['emp_sector'])?$getrequest['emp_sector']:NULL,
						'name_of_com'=> !empty($getrequest['name_of_company'])?$getrequest['name_of_company']:NULL,
						'office_add'=> !empty($getrequest['add_of_company'])?$getrequest['add_of_company']:NULL,
						'office_city'=> !empty($getrequest['com_city_state'])?$getrequest['com_city_state']:NULL,
						'phone_com'=> !empty($getrequest['com_phone'])?$getrequest['com_phone']:NULL,
						'purpose_of_visit'=> !empty($getrequest['purpose_visit'])?$getrequest['purpose_visit']:NULL,
						'proposed_duration_stay'=> !empty($getrequest['purpose_day'])?$getrequest['purpose_day']:NULL,
						'accommodation_add_hk'=> !empty($getrequest['address_acco'])?$getrequest['address_acco']:NULL,
						'fund_travel_hksar'=> !empty($getrequest['hk_travel_fund'])?$getrequest['hk_travel_fund']:NULL,
						'local_conn_hk'=> !empty($getrequest['is_local_conn'])?$getrequest['is_local_conn']:NULL,
						'local_name_hk'=> !empty($getrequest['local_conn_name'])?$getrequest['local_conn_name']:NULL,
						'local_conn_relation'=> !empty($getrequest['local_conn_relative'])?$getrequest['local_conn_relative']:NULL,
						'difficulty_ret_india'=> !empty($getrequest['is_return_ind'])?$getrequest['is_return_ind']:NULL,
						'criminal_offence'=> !empty($getrequest['is_arrested'])?$getrequest['is_arrested']:NULL,
						'convicted_offence'=> !empty($getrequest['is_convicted'])?$getrequest['is_convicted']:NULL,
						'refused_visa'=> !empty($getrequest['is_refused'])?$getrequest['is_refused']:NULL,
						'refused_permission'=> !empty($getrequest['is_refused_per'])?$getrequest['is_refused_per']:NULL,
						'deported_country'=> !empty($getrequest['is_deported'])?$getrequest['is_deported']:NULL,
						'engaged_terrorist_activities'=> !empty($getrequest['is_engage'])?$getrequest['is_engage']:NULL,
						'oth_name_is'=> !empty($getrequest['oth_name_is'])?$getrequest['oth_name_is']:NULL
					);
				$saverelationdetails = ApplicationrelationDetails::firstOrCreate(['applicant_id'=>$applicant_id->profile_id]);
				$saverelationdetails->applicant_id = $applicant_id->profile_id;
				$saverelationdetails->pres_add1 = !empty($getrequest['red_add_ind'])?$getrequest['red_add_ind']:NULL;
				$saverelationdetails->oth_add = !empty($getrequest['red_add_oth'])?$getrequest['red_add_oth']:NULL;
				$saverelationdetails->oth_country = !empty($getrequest['district_city_oth'])?$getrequest['district_city_oth']:NULL;
				$saverelationdetails->pres_country = NULL;
				$saverelationdetails->state_name = !empty($getrequest['district_city'])?$getrequest['district_city']:NULL;
				$saverelationdetails->pres_phone = !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL;
				$saverelationdetails->application_details = !empty($res_arr)?json_encode($res_arr):NULL;
				
				$saverelationdetails->save();

				$getservice = PricingMaster::where('nationality', "India")
								->where('product_id',1)
								->first();

				$saveFinalData = array(
					'nationality'=>!empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
					'order_id'=>!empty($getrequest['order_id'])?$getrequest['order_id']:NULL,
					'applicant_id'=>!empty($applicant_id->profile_id)?$applicant_id->profile_id:NULL,
					'uid'=>!empty($getrequest['uid'])?$getrequest['uid']:NULL,
					'type_of_visa'=>"eVisa-HongKong",
					'visa_service'=>!empty($getservice->product_name)?$getservice->product_name:NULL,
					'status'=>"Completed Form",
				);				

				$checkvisadetails = EvisaAppDetails::firstOrCreate(['order_id' => $saveFinalData['order_id']]);
				$checkvisadetails->order_id = $saveFinalData['order_id'];
				$checkvisadetails->applicant_id = $saveFinalData['applicant_id'];
				$checkvisadetails->uid = $saveFinalData['uid'];
				$checkvisadetails->type_of_visa = $saveFinalData['type_of_visa'];
				$checkvisadetails->visa_service = $saveFinalData['visa_service'];
				$checkvisadetails->created_at = date('Y-m-d H:i:s');
				$checkvisadetails->status = "Complete Form";

				$checkvisadetails->save();

				$postData = array(
					'order_id'=>$getrequest['order_id'],
					'applicant_id'=>$applicant_id->profile_id,
					'uid'=>$getrequest['uid'],
					'order_code'=>$getrequest['order_code']
				);


				UserLeads::where('order_id', $postData['order_id'])
			            ->update(['status'=>'Evisa-HongKongApplicationDetails']);

			    OrderDetails::where('order_id', $postData['order_id'])
			            ->update(['applicant_booking_status'=>'Evisa-HongKongApplicationDetails']);

			    /* setcookie ("partial_form", 'verifyemail', time()+3600*24*(2), '/', "", 0 );
			    setcookie ("uid", $getpostdata['uid'], time()+3600*24*(2), '/', "", 0 );
				setcookie ("order_id", $getpostdata['order_id'], time()+3600*24*(2), '/', "", 0 ); */  
				if(!empty($postData['order_id']) && !empty($postData['uid'])){
					$track_data = array(
								'partial_form'=>"Evisa-HongKongApplicationDetails",
			            		'order_id'=>$postData['order_id'],
			            		'user_id'=>$postData['uid'],
			            	);
			        Session::put('track_details', $track_data);	
				}
				// echo "<pre>";print_r($getlastorderid);exit;

				$error['status'] = "success";
				$error['msg'] = "Saved...";
				
		}
	}

	return json_encode($error);exit;
}

public function hongkongreviewform(Request $request){
	$getrequest = $request->all();
	$order_id = $request->route('ordid');
	$extractdata = array();
	$arr_city__state = array();
	$country_arr = array();
	$occupation_arr = array();
	$data_name = array();
	// echo "<pre>";print_r($getrequest);exit;
	if(!empty($order_id)){
		$getorderdetails = OrderDetails::join('users','users.user_id','=','order_details.user_id')->where('order_id','=',$order_id)->first();

	    $applicant_id = ApplicantProfiles::where('order_id','=',$order_id)->orderby('profile_id','DESC')->get()->first();

	    $getserviceiddetails = DB::table('tbl_user_service_details')->where('order_id','=',$order_id)->where('applicant_id','=',$applicant_id->profile_id)->first();

	    $getpassportdetails = DB::table('passport_details')->where('applicant_id','=',$applicant_id->profile_id)->first();

	    $getotherdetails = DB::table('application_relationdetails')->where('applicant_id','=',$applicant_id->profile_id)->first();

	    $getservice = PricingMaster::where('nationality', "India")
								->where('product_id',1)
								->first();
		$getmarital = DB::table('marital_status')->where('enabled','Y')->get();
		$getcity = DB::table('cities')->where('isactive','Y')->orderby('city_name','ASC')->get();
		$getstate = DB::table('states')->where('isactive','Y')->orderby('state_name','ASC')->get();
		$getcountry = DB::table('countries')->where('enabled','Y')->orderby('country_name','ASC')->get();
		$getoccupationname = DB::table('tbl_occupation')->where('active','Y')->orderby('occupation_name','ASC')->get();

		$getpurposename = DB::table('india_evisa_purpose')->where('purpose_id',$getserviceiddetails->purpose_id)->first();

		if(count($getstate)>0 && count($getcity)>0){
			$arr_city__state = array_merge($getstate,$getcity);
		}
		rsort($arr_city__state);
		//echo "<pre>";print_r($arr_city__state);exit;
		foreach ($arr_city__state as $key => $value) {
			# code...
			if(isset($value->state_name) && !empty($value->state_name)){
				$data_name['data_arr'][] = $value->state_name;
			}else{
				$data_name['data_arr'][] = $value->city_name;
			}
			
		}

		
		foreach($getcountry as $key=>$val){
			$country_arr[] = $val->country_name;
		}

		foreach($getoccupation as $key=>$val){
			$occupation_arr[] = array('id'=>$val->id,'occupation_name'=>$val->occupation_name);
		}

	    $extractdata = array(
	    	'order_id'=> !empty($getorderdetails->order_id)?$getorderdetails->order_id:NULL,
	    	'order_code'=> !empty($getorderdetails->order_code)?$getorderdetails->order_code:NULL,
	    	'user_id'=> !empty($getorderdetails->user_id)?$getorderdetails->user_id:NULL,
	    	'product_id'=> !empty($getorderdetails->product_id)?$getorderdetails->product_id:NULL,
	    	'travel_to'=> !empty($getorderdetails->travel_to)?$getorderdetails->travel_to:NULL,
	    	'citizen_to'=> !empty($getorderdetails->citizen_to)?$getorderdetails->citizen_to:NULL,
	    	'nationality'=> !empty($getorderdetails->nationality)?$getorderdetails->nationality:NULL,
	    	'email_id'=> !empty($getorderdetails->email_id)?$getorderdetails->email_id:NULL,
	    	'mobile_no'=> !empty($getorderdetails->mobile_no)?$getorderdetails->mobile_no:NULL,
	    	'profile_id'=> !empty($applicant_id->profile_id)?$applicant_id->profile_id:NULL,
	    	'username'=> !empty($applicant_id->username)?$applicant_id->username:NULL,
	    	'surname'=> !empty($applicant_id->surname)?$applicant_id->surname:NULL,
	    	'previous_surname'=> !empty($applicant_id->previous_surname)?$applicant_id->previous_surname:NULL,
	    	'previous_name'=> !empty($applicant_id->previous_name)?$applicant_id->previous_name:NULL,
	    	'dob'=> !empty($applicant_id->dob)?$applicant_id->dob:NULL,
	    	'gender'=> !empty($applicant_id->gender)?$applicant_id->gender:NULL,
	    	'marital_status_id'=> !empty($applicant_id->marital_status_id)?$applicant_id->marital_status_id:NULL,
	    	'place_of_birth'=> !empty($applicant_id->place_of_birth)?$applicant_id->place_of_birth:NULL,
	    	'service_id'=> !empty($getserviceiddetails->service_id)?$getserviceiddetails->service_id:NULL,
	    	'purpose_id'=> !empty($getserviceiddetails->purpose_id)?$getserviceiddetails->purpose_id:NULL,
	    	'purpose_name'=> !empty($getpurposename->purpose_name)?$getpurposename->purpose_name:NULL,
	    	'pp_no'=> !empty($getpassportdetails->pp_no)?$getpassportdetails->pp_no:NULL,
	    	'pp_issue_date'=> !empty($getpassportdetails->pp_issue_date)?$getpassportdetails->pp_issue_date:NULL,
	    	'pp_expiry_date'=> !empty($getpassportdetails->pp_expiry_date)?$getpassportdetails->pp_expiry_date:NULL,
	    	'pp_place_of_issue'=> !empty($getpassportdetails->pp_place_of_issue)?$getpassportdetails->pp_place_of_issue:NULL,
	    	'pres_add1'=> !empty($getotherdetails->pres_add1)?$getotherdetails->pres_add1:NULL,
	    	'state_name'=> !empty($getotherdetails->state_name)?$getotherdetails->state_name:NULL,
	    	'oth_add'=> !empty($getotherdetails->oth_add)?$getotherdetails->oth_add:NULL,
	    	'oth_country'=> !empty($getotherdetails->oth_country)?$getotherdetails->oth_country:NULL,
	    	'pres_phone'=> !empty($getotherdetails->pres_phone)?$getotherdetails->pres_phone:NULL,
	    	'application_details'=> !empty($getotherdetails->application_details)?json_decode($getotherdetails->application_details, true):NULL,
	    	'is_review_updated'=>!empty($getorderdetails->is_review_updated)?$getorderdetails->is_review_updated:NULL
	    );
	}
	
	if ($request->isMethod('post'))
	{
		// echo "<pre>";print_r($getrequest);exit;
		$data_user = array(
					'uid'=>'',
					'username'=>!empty($getrequest['passport_given_name'])?$getrequest['passport_given_name']." ".$getrequest['passport_surname_name']:NULL,
					'email'=> !empty($getrequest['email_id'])?$getrequest['email_id']:NULL,
					'phone'=> !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL,
					'nationality'=>"India",
					'created_at'=> date('Y-m-d H:i:s')
		);
		$uid = $this->saveUserDetails($data_user);

		if($uid){
			$data_ord = array(
						'order_id'=>'',
						'order_code'=> $getrequest['order_code'],
						'user_id'=> $uid,
						'product_id'=> 1,
						'adult'=> 0,
						'child'=> 0,
						'infant'=> 0,
						'nationality'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
						'total_price'=> NULL,
						'residing_in'=> NULL,
						'residing_code'=> NULL,
						'travel_to'=> "Hong Kong",
						'citizen_to'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
						'passport_type'=> NULL,
						'airport_code'=> NULL,
						'arrival_date'=> NULL,
						'applicant_booking_status'=> "Evisa-ApplicationDetails",
						'created_at'=> date('Y-m-d H:i:s'),
						'is_review_updated'=> "Y"
					);

			$ordid = $this->saveOrderDetails($data_ord);

			if($ordid){
				$app_data = array(
						'user_id' => $uid,
						'username' => !empty($getrequest['passport_given_name'])?$getrequest['passport_given_name']:NULL,
						'surname' => !empty($getrequest['passport_surname_name'])?$getrequest['passport_surname_name']:NULL,
						'previous_name' => !empty($getrequest['oth_given_name'])?$getrequest['oth_given_name']:NULL,
						'previous_surname'=> !empty($getrequest['oth_surname_name'])?$getrequest['oth_surname_name']:NULL,
						'place_of_birth'=> !empty($getrequest['place_of_birth'])?$getrequest['place_of_birth']:NULL,
						'mobile_number' => !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL,
						'marital_status_id' => !empty($getrequest['marital_status_id'])?$getrequest['marital_status_id']:NULL,
						'dob' => !empty($getrequest['type_dob'])?$getrequest['type_dob']:NULL,
						'gender' => !empty($getrequest['gender'])?$getrequest['gender']:NULL,
						'nationality'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
						'order_id' => $ordid
				);

				$saveapplicant = ApplicantProfiles::firstOrCreate(['profile_id' => $getrequest['profile_id']]);
				$saveapplicant->user_id = $app_data['user_id'];
				$saveapplicant->username = $app_data['username'];
				$saveapplicant->surname = !empty($app_data['surname'])?$app_data['surname']:NULL;
				$saveapplicant->previous_name = !empty($app_data['previous_name'])?$app_data['previous_name']:NULL;
				$saveapplicant->previous_surname = !empty($app_data['previous_surname'])?$app_data['previous_surname']:NULL;
				$saveapplicant->dob = !empty($app_data['dob'])?$app_data['dob']:NULL;
				$saveapplicant->gender = !empty($app_data['gender'])?$app_data['gender']:NULL;
				$saveapplicant->mobile_number = !empty($app_data['mobile_number'])?$app_data['mobile_number']:NULL;
				$saveapplicant->nationality = !empty($app_data['nationality'])?$app_data['nationality']:NULL;
				$saveapplicant->place_of_birth = !empty($app_data['place_of_birth'])?$app_data['place_of_birth']:NULL;
				$saveapplicant->marital_status_id = !empty($app_data['marital_status_id'])?$app_data['marital_status_id']:NULL;
				$saveapplicant->country = !empty($app_data['country'])?$app_data['country']:NULL;
				$saveapplicant->order_id = $app_data['order_id'];
				$saveapplicant->is_submitted = "Y";

				$saveapplicant->save();

				$user_leads_data = array(
					'session_id'=> session()->getId(),
					'name' => !empty($getrequest['passport_given_name'])?$getrequest['passport_given_name']." ".$getrequest['passport_surname_name']:NULL,
					'phone_number' => !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL,
					'email_id'=> !empty($getrequest['email_id'])?$getrequest['email_id']:NULL,
					'nationality' => !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
					'residing_in' => NULL,
					'travelling_to' => "Hong Kong",
					'passport_type' => NULL,
					'airport_code' => NULL,
					'arrival_date' => NULL,
					'product_id' => 1,
					'order_id' => $ordid,
					'created_at' => date('Y-m-d H:i:s'),
					'status' => "Evisa-ApplicationDetails"	
				);

				$saveuserlead = UserLeads::firstOrCreate(['order_id' => $getrequest['order_id']]);

				$saveuserlead->name = !empty($user_leads_data['name'])?$user_leads_data['name']:NULL;
				$saveuserlead->phone_number = !empty($user_leads_data['phone_number'])?$user_leads_data['phone_number']:NULL;
				$saveuserlead->email_id = !empty($user_leads_data['email_id'])?$user_leads_data['email_id']:NULL;
				$saveuserlead->nationality = !empty($user_leads_data['nationality'])?$user_leads_data['nationality']:NULL;
				$saveuserlead->residing_in = !empty($user_leads_data['residing_in'])?$user_leads_data['residing_in']:NULL;
				$saveuserlead->travelling_to = !empty($user_leads_data['travelling_to'])?$user_leads_data['travelling_to']:NULL;
				$saveuserlead->passport_type = !empty($user_leads_data['passport_type'])?$user_leads_data['passport_type']:NULL;
				$saveuserlead->airport_code = !empty($user_leads_data['airport_code'])?$user_leads_data['airport_code']:NULL;
				$saveuserlead->arrival_date = !empty($user_leads_data['arrival_date'])?$user_leads_data['arrival_date']:NULL;
				$saveuserlead->product_id = $user_leads_data['product_id'];
				$saveuserlead->order_id = $user_leads_data['order_id'];
				$saveuserlead->session_id = $user_leads_data['session_id'];
				$saveuserlead->created_at = $user_leads_data['created_at'];
				$saveuserlead->status = $user_leads_data['status'];

				$saveuserlead->save();

				DB::table('passport_details')->where('applicant_id','=',$getrequest['profile_id'])
				    		->update(
				            	['user_id'=>$uid,'applicant_id'=>$applicant_id->profile_id,'pp_no' => !empty($getrequest['passport_number'])?$getrequest['passport_number']:NULL, 'pp_issue_date'=> !empty($getrequest['type_doi'])?$getrequest['type_doi']:NULL, 'pp_expiry_date'=> !empty($getrequest['type_doe'])?$getrequest['type_doe']:NULL, 'pp_place_of_issue'=>!empty($getrequest['place_of_issue'])?$getrequest['place_of_issue']:NULL]
							);

				$saveservicedetails = UserserviceDetails::firstOrCreate(['order_id'=>$ordid,'service_id'=>4]);
				$saveservicedetails->service_id = 4;
				$saveservicedetails->purpose_id = $getrequest['purpose_visit'];
				$saveservicedetails->order_id = $ordid;
				$saveservicedetails->applicant_id = $applicant_id->profile_id;
				$saveservicedetails->user_id = $uid;
				$saveservicedetails->status = "Y";

				$saveservicedetails->save();			

				$res_arr = array(
						'alias_is'=> !empty($getrequest['alias_is'])?$getrequest['alias_is']:NULL,
						'alias_given_name'=> !empty($getrequest['alias_given_name'])?$getrequest['alias_given_name']:NULL,
						'alias_surname_name'=> !empty($getrequest['alias_surname_name'])?$getrequest['alias_surname_name']:NULL,
						'pre_travel_hk'=> !empty($getrequest['is_travel_hk'])?$getrequest['is_travel_hk']:NULL,
						'res_add_india'=> !empty($getrequest['res_add_is'])?$getrequest['res_add_is']:NULL,
						'pre_add_hk'=> !empty($getrequest['hk_pass_number'])?$getrequest['hk_pass_number']:NULL,
						'pre_travel_oth'=> !empty($getrequest['is_travel_oth'])?$getrequest['is_travel_oth']:NULL,
						'pre_add_oth'=> !empty($getrequest['oth_pass_number'])?$getrequest['oth_pass_number']:NULL,
						'emp_sector'=> !empty($getrequest['emp_sector'])?$getrequest['emp_sector']:NULL,
						'name_of_com'=> !empty($getrequest['name_of_company'])?$getrequest['name_of_company']:NULL,
						'office_add'=> !empty($getrequest['add_of_company'])?$getrequest['add_of_company']:NULL,
						'office_city'=> !empty($getrequest['com_city_state'])?$getrequest['com_city_state']:NULL,
						'phone_com'=> !empty($getrequest['com_phone'])?$getrequest['com_phone']:NULL,
						'purpose_of_visit'=> !empty($getrequest['purpose_visit'])?$getrequest['purpose_visit']:NULL,
						'proposed_duration_stay'=> !empty($getrequest['purpose_day'])?$getrequest['purpose_day']:NULL,
						'accommodation_add_hk'=> !empty($getrequest['address_acco'])?$getrequest['address_acco']:NULL,
						'fund_travel_hksar'=> !empty($getrequest['hk_travel_fund'])?$getrequest['hk_travel_fund']:NULL,
						'local_conn_hk'=> !empty($getrequest['is_local_conn'])?$getrequest['is_local_conn']:NULL,
						'local_name_hk'=> !empty($getrequest['local_conn_name'])?$getrequest['local_conn_name']:NULL,
						'local_conn_relation'=> !empty($getrequest['local_conn_relative'])?$getrequest['local_conn_relative']:NULL,
						'difficulty_ret_india'=> !empty($getrequest['is_return_ind'])?$getrequest['is_return_ind']:NULL,
						'criminal_offence'=> !empty($getrequest['is_arrested'])?$getrequest['is_arrested']:NULL,
						'convicted_offence'=> (isset($getrequest['is_convicted']) && !empty($getrequest['is_convicted']))?$getrequest['is_convicted']:NULL,
						'refused_visa'=> !empty($getrequest['is_refused'])?$getrequest['is_refused']:NULL,
						'refused_permission'=> !empty($getrequest['is_refused_per'])?$getrequest['is_refused_per']:NULL,
						'deported_country'=> !empty($getrequest['is_deported'])?$getrequest['is_deported']:NULL,
						'engaged_terrorist_activities'=> !empty($getrequest['is_engage'])?$getrequest['is_engage']:NULL,
						'oth_name_is'=> !empty($getrequest['oth_name_is'])?$getrequest['oth_name_is']:NULL
					);

				$saverelationdetails = ApplicationrelationDetails::firstOrCreate(['applicant_id'=>$applicant_id->profile_id]);
				$saverelationdetails->applicant_id = $applicant_id->profile_id;
				$saverelationdetails->pres_add1 = !empty($getrequest['red_add_ind'])?$getrequest['red_add_ind']:NULL;
				$saverelationdetails->oth_add = !empty($getrequest['red_add_oth'])?$getrequest['red_add_oth']:NULL;
				$saverelationdetails->oth_country = !empty($getrequest['district_city_oth'])?$getrequest['district_city_oth']:NULL;
				$saverelationdetails->pres_country = NULL;
				$saverelationdetails->state_name = !empty($getrequest['district_city'])?$getrequest['district_city']:NULL;
				$saverelationdetails->pres_phone = !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL;
				$saverelationdetails->application_details = !empty($res_arr)?json_encode($res_arr):NULL;
				
				$saverelationdetails->save();

				// $request->session()->flash('alert-success', 'Record Successfully Updated!');
				return Redirect::back()->withErrors(['Record Successfully Updated!']);			
			}
		}
	}
			
	// echo "<pre>";print_r($extractdata);exit;
	return view('evisaapplication/hongkongreview', compact('extractdata','getservice','getmarital','data_name','country_arr','occupation_arr'));
}

public function saveHKtypeformdata($request=NULL){
	$responseArr = $request;
	$responseData = array();
	$data_user = array();
	$marital_status_id = "";
	$purposeid = "";
	$serviceid = "";

	if(isset($responseArr) && !empty($responseArr)){
		// file_put_contents(public_path().'/typeform_log/log_hk'.date("j.n.Y").'.log', print_r($responseArr, TRUE));exit;
		
		$responseData = $responseArr;
		
		if(isset($responseData['dropdown_Pj4pgTxjZ4LD'][0]['label']) && $responseData['dropdown_Pj4pgTxjZ4LD'][0]['label'] == "Single"){
					$marital_status_id = 1;
				} else if(isset($responseData['dropdown_Pj4pgTxjZ4LD'][0]['label']) && $responseData['dropdown_Pj4pgTxjZ4LD'][0]['label'] == "Married"){
					$marital_status_id = 2;
				} else if(isset($responseData['dropdown_Pj4pgTxjZ4LD'][0]['label']) && $responseData['dropdown_Pj4pgTxjZ4LD'][0]['label'] == "Separated"){
					$marital_status_id = 7;
				} else if(isset($responseData['dropdown_Pj4pgTxjZ4LD'][0]['label']) && $responseData['dropdown_Pj4pgTxjZ4LD'][0]['label'] == "Divorced"){
					$marital_status_id = 3;
				} else if(isset($responseData['dropdown_Pj4pgTxjZ4LD'][0]['label']) && $responseData['dropdown_Pj4pgTxjZ4LD'][0]['label'] == "Widowed"){
					$marital_status_id = 8;
				}

				if(isset($responseData['dropdown_Gbc7HdjG9shP'][0]['label']) && $responseData['dropdown_Gbc7HdjG9shP'][0]['label'] == "Leisure Visit"){
					$purposeid = 13;
				} else if(isset($responseData['dropdown_Gbc7HdjG9shP'][0]['label']) && $responseData['dropdown_Gbc7HdjG9shP'][0]['label'] == "Business Visit"){
					$purposeid = 14;
				} else if(isset($responseData['dropdown_Gbc7HdjG9shP'][0]['label']) && $responseData['dropdown_Gbc7HdjG9shP'][0]['label'] == "Family Visit"){
					$purposeid = 15;
				} else if(isset($responseData['dropdown_Gbc7HdjG9shP'][0]['label']) && $responseData['dropdown_Gbc7HdjG9shP'][0]['label'] == "Transit"){
					$purposeid = 16;
				}

				$data_user = array(
					'uid'=>'',
					'username'=>(isset($responseData['short_text_P6fRxPs3m5js'][0]) && !empty($responseData['short_text_P6fRxPs3m5js'][0]))?$responseData['short_text_P6fRxPs3m5js'][0]." ".$responseData['short_text_kgfV720bjC6D'][0]:NULL,
					'email'=> (isset($responseData['email_DwVLtm5Bu4hK'][0]) && !empty($responseData['email_DwVLtm5Bu4hK'][0]))?$responseData['email_DwVLtm5Bu4hK'][0]:NULL,
					'phone'=> (isset($responseData['number_FMrNAKDD1TXU'][0]) && !empty($responseData['number_FMrNAKDD1TXU'][0]))?$responseData['number_FMrNAKDD1TXU'][0]:NULL,
					'nationality'=>"India",
					'created_at'=> date('Y-m-d H:i:s')
				);
				$uid = $this->saveUserDetails($data_user);
				if($uid){
					$data_ord = array(
						'order_id'=>'',
						'order_code'=> $this->RandomString(15),
						'user_id'=> $uid,
						'product_id'=> 1,
						'adult'=> 0,
						'child'=> 0,
						'infant'=> 0,
						'nationality'=> "India",
						'total_price'=> NULL,
						'residing_in'=> NULL,
						'residing_code'=> NULL,
						'travel_to'=> "Hong Kong",
						'citizen_to'=> "India",
						'passport_type'=> NULL,
						'airport_code'=> NULL,
						'arrival_date'=> NULL,
						'applicant_booking_status'=> "Evisa-ApplicationDetails",
						'created_at'=> date('Y-m-d H:i:s')
					);

					$ordid = $this->saveOrderDetails($data_ord);

					if($ordid){
						
						$app_data = array(
							'user_id' => $uid,
							'username' => (isset($responseData['short_text_P6fRxPs3m5js'][0]) && !empty($responseData['short_text_P6fRxPs3m5js'][0]))?$responseData['short_text_P6fRxPs3m5js'][0]:NULL,
							'surname' => (isset($responseData['short_text_kgfV720bjC6D'][0]) && !empty($responseData['short_text_kgfV720bjC6D'][0]))?$responseData['short_text_kgfV720bjC6D'][0]:NULL,
							'mobile_number' => (isset($responseData['number_FMrNAKDD1TXU'][0]) && !empty($responseData['number_FMrNAKDD1TXU'][0]))?$responseData['number_FMrNAKDD1TXU'][0]:NULL,
							'marital_status_id' => !empty($marital_status_id)?$marital_status_id:NULL,
							'dob' => (isset($responseData['date_LhAK6hPW4GrH'][0]) && !empty($responseData['date_LhAK6hPW4GrH'][0]))?$responseData['date_LhAK6hPW4GrH'][0]:NULL,
							'gender' => (isset($responseData['dropdown_jU5Nx1CNOsYR'][0]['label']) && !empty($responseData['dropdown_jU5Nx1CNOsYR'][0]['label']))?$responseData['dropdown_jU5Nx1CNOsYR'][0]['label']:NULL,
							'place_of_birth'=> (isset($responseData['short_text_UWruJymUBChD'][0]) && !empty($responseData['short_text_UWruJymUBChD'][0]))?$responseData['short_text_UWruJymUBChD'][0]:NULL,
							'nationality'=> "India",
							'order_id' => $ordid
						);

						$this->saveApplicantProfile($app_data);

						$user_leads_data = array(
						'session_id'=> session()->getId(),
						'name' => (isset($responseData['short_text_P6fRxPs3m5js'][0]) && !empty($responseData['short_text_P6fRxPs3m5js'][0]))?$responseData['short_text_P6fRxPs3m5js'][0]." ".$responseData['short_text_kgfV720bjC6D'][0]:NULL,
						'phone_number' => (isset($responseData['number_FMrNAKDD1TXU'][0]) && !empty($responseData['number_FMrNAKDD1TXU'][0]))?$responseData['number_FMrNAKDD1TXU'][0]:NULL,
						'email_id'=> (isset($responseData['email_DwVLtm5Bu4hK'][0]) && !empty($responseData['email_DwVLtm5Bu4hK'][0]))?$responseData['email_DwVLtm5Bu4hK'][0]:NULL,
						'nationality' => "India",
						'residing_in' => NULL,
						'travelling_to' => "Hong Kong",
						'passport_type' => NULL,
						'airport_code' => NULL,
						'arrival_date' => NULL,
						'product_id' => 1,
						'order_id' => $ordid,
						'created_at' => date('Y-m-d H:i:s'),
						'status' => "Evisa-ApplicationDetails"	
						);

						$this->saveUserLeads($user_leads_data);

						$applicant_id = ApplicantProfiles::select(DB::raw('max(profile_id) as profile_id'))->get()->first();

						$ppid = DB::table('passport_details')
				    		->insertGetId(
				            	['user_id'=>$uid,'applicant_id'=>$applicant_id->profile_id,'pp_no' => (isset($responseData['short_text_DPCtGXtCuvcy'][0]) && !empty($responseData['short_text_DPCtGXtCuvcy'][0]))?$responseData['short_text_DPCtGXtCuvcy'][0]:NULL, 'pp_issue_date'=> (isset($responseData['date_nNa8AbgzqfMy'][0]) && !empty($responseData['date_nNa8AbgzqfMy'][0]))?$responseData['date_nNa8AbgzqfMy'][0]:NULL, 'pp_expiry_date'=> (isset($responseData['date_aqCHTLRKDKj1'][0]) && !empty($responseData['date_aqCHTLRKDKj1'][0]))?$responseData['date_aqCHTLRKDKj1'][0]:NULL, 'pp_place_of_issue'=>(isset($responseData['short_text_chdUfDBL0vRQ'][0]) && !empty($responseData['short_text_chdUfDBL0vRQ'][0]))?$responseData['short_text_chdUfDBL0vRQ'][0]:NULL]
				    	);

				    	$saveservicedetails = UserserviceDetails::firstOrCreate(['order_id'=>$ordid,'service_id'=>4]);
						$saveservicedetails->service_id = 4;
						$saveservicedetails->purpose_id = $purposeid;
						$saveservicedetails->order_id = $ordid;
						$saveservicedetails->applicant_id = $applicant_id->profile_id;
						$saveservicedetails->user_id = $uid;
						$saveservicedetails->status = "Y";

						$saveservicedetails->save();	

					$res_arr = array(
						'alias_name_is'=> (isset($responseData['yes_no_V1bafoU0wMvu'][0]) && !empty($responseData['yes_no_V1bafoU0wMvu'][0]))?$responseData['yes_no_V1bafoU0wMvu'][0]:NULL,
						'alias_given_name'=> (isset($responseData['short_text_Edg75AlhXXEF'][0]) && !empty($responseData['short_text_Edg75AlhXXEF'][0]))?$responseData['short_text_Edg75AlhXXEF'][0]:NULL,
						'alias_surname'=> (isset($responseData['short_text_eSEw3szjX8Zj'][0]) && !empty($responseData['short_text_eSEw3szjX8Zj'][0]))?$responseData['short_text_eSEw3szjX8Zj'][0]:NULL,
						'pre_travel_hk'=> (isset($responseData['yes_no_TmJMicRkiKFj'][0]) && !empty($responseData['yes_no_TmJMicRkiKFj'][0]))?$responseData['yes_no_TmJMicRkiKFj'][0]:NULL,
						'res_add_india'=> (isset($responseData['yes_no_eu19zZy7P5wC'][0]) && !empty($responseData['yes_no_eu19zZy7P5wC'][0]))?$responseData['yes_no_eu19zZy7P5wC'][0]:NULL,
						'pre_add_hk'=> (isset($responseData['long_text_L2ztcIZb1B1P'][0]) && !empty($responseData['long_text_L2ztcIZb1B1P'][0]))?$responseData['long_text_L2ztcIZb1B1P'][0]:NULL,
						'pre_travel_oth'=> (isset($responseData['yes_no_SqBzl9bGXdPc'][0]) && !empty($responseData['yes_no_SqBzl9bGXdPc'][0]))?$responseData['yes_no_SqBzl9bGXdPc'][0]:NULL,
						'pre_add_oth'=> (isset($responseData['long_text_EN8fOZRQ3Y87'][0]) && !empty($responseData['long_text_EN8fOZRQ3Y87'][0]))?$responseData['long_text_EN8fOZRQ3Y87'][0]:NULL,
						'emp_sector'=> (isset($responseData['dropdown_QnepypebUoLB'][0]['label']) && !empty($responseData['dropdown_QnepypebUoLB'][0]['label']))?$responseData['dropdown_QnepypebUoLB'][0]['label']:NULL,
						'name_of_com'=> (isset($responseData['long_text_AFHTIwUrGTeI'][0]) && !empty($responseData['long_text_AFHTIwUrGTeI'][0]))?$responseData['long_text_AFHTIwUrGTeI'][0]:NULL,
						'office_add'=> (isset($responseData['long_text_PCznIpsBcI26'][0]) && !empty($responseData['long_text_PCznIpsBcI26'][0]))?$responseData['long_text_PCznIpsBcI26'][0]:NULL,
						'office_city'=> (isset($responseData['dropdown_Vf1WVs57yxK3'][0]['label']) && !empty($responseData['dropdown_Vf1WVs57yxK3'][0]['label']))?$responseData['dropdown_Vf1WVs57yxK3'][0]['label']:NULL,
						'phone_com'=> (isset($responseData['number_E1XEDo4SLOqk'][0]) && !empty($responseData['number_E1XEDo4SLOqk'][0]))?$responseData['number_E1XEDo4SLOqk'][0]:NULL,
						'purpose_of_visit'=> (isset($responseData['dropdown_Gbc7HdjG9shP'][0]['label']) && !empty($responseData['dropdown_Gbc7HdjG9shP'][0]['label']))?$responseData['dropdown_Gbc7HdjG9shP'][0]['label']:NULL,
						'proposed_duration_stay'=> (isset($responseData['dropdown_PSRFS8wjJIXd'][0]['label']) && !empty($responseData['dropdown_PSRFS8wjJIXd'][0]['label']))?$responseData['dropdown_PSRFS8wjJIXd'][0]['label']:NULL,
						'accommodation_add_hk'=> (isset($responseData['long_text_l26o944O26De'][0]) && !empty($responseData['long_text_l26o944O26De'][0]))?$responseData['long_text_l26o944O26De'][0]:NULL,
						'fund_travel_hksar'=> (isset($responseData['dropdown_uZkqfrthP7RP'][0]['label']) && !empty($responseData['dropdown_uZkqfrthP7RP'][0]['label']))?$responseData['dropdown_uZkqfrthP7RP'][0]['label']:NULL,
						'local_conn_hk'=> (isset($responseData['yes_no_HSmEWCeqzg4H'][0]) && !empty($responseData['yes_no_HSmEWCeqzg4H'][0]))?$responseData['yes_no_HSmEWCeqzg4H'][0]:NULL,
						'local_name_hk'=> (isset($responseData['long_text_qMp3YyvS3Z98'][0]) && !empty($responseData['long_text_qMp3YyvS3Z98'][0]))?$responseData['long_text_qMp3YyvS3Z98'][0]:NULL,
						'local_conn_relation'=> (isset($responseData['dropdown_tVxpc52aYeVc'][0]['label']) && !empty($responseData['dropdown_tVxpc52aYeVc'][0]['label']))?$responseData['dropdown_tVxpc52aYeVc'][0]['label']:NULL,
						'difficulty_ret_india'=> (isset($responseData['yes_no_KKMo36NUANoO'][0]) && !empty($responseData['yes_no_KKMo36NUANoO'][0]))?$responseData['yes_no_KKMo36NUANoO'][0]:NULL,
						'criminal_offence'=> (isset($responseData['yes_no_v6oFP4Erb8CI'][0]) && !empty($responseData['yes_no_v6oFP4Erb8CI'][0]))?$responseData['yes_no_v6oFP4Erb8CI'][0]:NULL,
						'convicted_offence'=> (isset($responseData['yes_no_BbQySmZZtMyi'][0]) && !empty($responseData['yes_no_BbQySmZZtMyi'][0]))?$responseData['yes_no_BbQySmZZtMyi'][0]:NULL,
						'refused_visa'=> (isset($responseData['yes_no_eWC2HyJNgsSQ'][0]) && !empty($responseData['yes_no_eWC2HyJNgsSQ'][0]))?$responseData['yes_no_eWC2HyJNgsSQ'][0]:NULL,
						'refused_permission'=> (isset($responseData['yes_no_oNZlxph6KpVH'][0]) && !empty($responseData['yes_no_oNZlxph6KpVH'][0]))?$responseData['yes_no_oNZlxph6KpVH'][0]:NULL,
						'deported_country'=> (isset($responseData['yes_no_ZOOx0LJDJAS7'][0]) && !empty($responseData['yes_no_ZOOx0LJDJAS7'][0]))?$responseData['yes_no_ZOOx0LJDJAS7'][0]:NULL,
						'engaged_terrorist_activities'=> (isset($responseData['yes_no_QSXabUB5zoDn'][0]) && !empty($responseData['yes_no_QSXabUB5zoDn'][0]))?$responseData['yes_no_QSXabUB5zoDn'][0]:NULL,
					);				

	$saverelationdetails = ApplicationrelationDetails::firstOrCreate(['applicant_id'=>$applicant_id->profile_id]);
	$saverelationdetails->applicant_id = $applicant_id->profile_id;
	$saverelationdetails->pres_add1 = (isset($responseData['long_text_mf56zSghwDod'][0]) && !empty($responseData['long_text_mf56zSghwDod'][0]))?$responseData['long_text_mf56zSghwDod'][0]:NULL;
	$saverelationdetails->pres_country = NULL;
	$saverelationdetails->state_name = (isset($responseData['dropdown_Fy3ij1e6LIeY'][0]['label']) && !empty($responseData['dropdown_Fy3ij1e6LIeY'][0]['label']))?$responseData['dropdown_Fy3ij1e6LIeY'][0]['label']:NULL;
	$saverelationdetails->pres_phone = (isset($responseData['number_FMrNAKDD1TXU'][0]) && !empty($responseData['number_FMrNAKDD1TXU'][0]))?$responseData['number_FMrNAKDD1TXU'][0]:NULL;
	$saverelationdetails->application_details = !empty($res_arr)?json_encode($res_arr):NULL;
	
	$saverelationdetails->save();
					}
				}
				$getserviceidorderdetails = OrderDetails::join('users','users.user_id','=','order_details.user_id')
							->where('email_id','=',$responseData['email_DwVLtm5Bu4hK'][0])
                     		->first();
}
	return array('order_id'=>$ordid,'applicant_id'=>$applicant_id->profile_id,'uid'=>$uid,'order_code'=>$getorderdetails['order_code']);
}

public function checksession(Request $request){
	$getsession = $request->session()->get('track_details');
	//echo "<pre>";print_r($getsession);exit;
	$form_url = "";
	$data = array();
	if(isset($getsession['user_id']) && isset($getsession['order_id'])){
		$data['status'] = "success";
		$data['value'] = $getsession;
	}else{
		$data['status'] = "failed";
		$data['msg'] = "Session Not Set";
	}
	echo json_encode($data);exit;
	// return view('evisaapplication/evisaapplicationtrack');
}

/**
 * Convert a multi-dimensional array into a single-dimensional array.
 * @author Sean Cannon, LitmusBox.com | seanc@litmusbox.com
 * @param  array $array The multi-dimensional array.
 * @return array
 */
public function array_flatten($array) { 
  if (!is_array($array)) { 
    return false; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, $this->array_flatten($value)); 
    } else { 
      $result[$key] = $value; 
    } 
  } 
  return $result; 
}

public function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

/**
 * function to generate random strings
 * @param 		int 	$length 	number of characters in the generated string
 * @return 		string	a new string is created with random characters of the desired length
 */
public function RandomString($size = 32) {
	$alpha_key = '';
	$keys = range('A', 'Z');

	for ($i = 0; $i < 2; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}

	$length = $size - 2;

	$key = '';
	$keys = range(0, 9);

	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}

	return $alpha_key . $key;
}

public function e(&$r,$m) {
	$r["error"]=$r["error"]||true;
	$r["message"].=$m;
}
public function ex($r) {
	echo json_encode($r);
	exit();
}	
}
