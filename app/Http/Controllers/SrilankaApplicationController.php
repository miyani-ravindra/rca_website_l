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
use App\Models\EvisaAppDetails;
//use Illuminate\Contracts\Routing\ResponseFactory;
use Softon\Indipay\Facades\Indipay;
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

class SrilankaApplicationController extends ApplicationController {


	public function visaapplication(Request $request){
		$getrequest = $request->all();
		$utm_url = "";
		$referer = "";
		
		if(!empty($getrequest['residing_in'])){
			try{
				$country_name = DB::table('countries')
						->where('country_code',$getrequest['residing_in'])
						->first();	
			} catch(\Illuminate\Database\QueryException $ex){
				dd($ex->getMessage());
			} catch(PDOException $ex){
				dd($ex->getMessage());
			}			
		}

		if(!empty($getrequest['citizen_to'])){
			try{
				$evisa_summary = DB::table('tbl_summary_page')
						->where('country_code',$getrequest['citizen_to'])
						->where('travel_to',$getrequest['country_code'])
						->first();	
			} catch(\Illuminate\Database\QueryException $ex){
				dd($ex->getMessage());
			} catch(PDOException $ex){
				dd($ex->getMessage());
			}
		}

		if(isset($getrequest['utm_source']) && !empty($getrequest['utm_source'])){
			$referer = $_SERVER['HTTP_REFERER'];
			$utm_url = $referer."?utm_source=".$getrequest['utm_source']."&utm_medium=".$getrequest['utm_medium']."&utm_campaign=".$getrequest['utm_campaign'];
		}
		
		$postData = array(
			'travel_to'=> !empty($getrequest['travel_to'])?$getrequest['travel_to']:NULL,
			'country_code'=> !empty($getrequest['country_code'])?$getrequest['country_code']:NULL,
			'citizen_to'=> !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
			'residing_in'=> !empty($getrequest['residing_in'])?$country_name->country_name:NULL,
			'residing_code'=> !empty($getrequest['residing_in'])?$country_name->country_code:NULL,
			'evisa_summary'=> !empty($evisa_summary)?htmlspecialchars_decode(stripslashes($evisa_summary->content)):NULL,
			'travel_to_text'=> !empty($getrequest['travel_to_text'])?$getrequest['travel_to_text']:NULL,
			'citizen_to_text'=> !empty($getrequest['citizen_to_text'])?$getrequest['citizen_to_text']:NULL,
			'utm_url'=> !empty($utm_url)?$utm_url:NULL
		);
		
		return view('srilanka/srilanka_step_1',compact('postData'));
	}



	public function srilankaEvisaApplicationForm(Request $request){
		
		$getrequest 		= $request->all();
		$ccode 				= isset($getrequest['country_code']) && !empty($getrequest['country_code']) ? strtolower($getrequest['country_code']) : null;

		$typeformurl 		= "";
		$webhooksurl 		= "";
		$formid 			= "";
		$getservice 		= "";
		$product_name 		= "";
		$arr_city__state 	= array();
		$country_arr 		= array();
		$data_name 			= array();
		$getpostdata 		= array();

		$getservice 		= PricingMaster::where('nationality', "India")->where('product_id',1)->first();
		$getmarital 		= DB::table('marital_status')->where('enabled','Y')->get();
		$getcity 			= DB::table('cities')->where('isactive','Y')->orderby('city_name','ASC')->get();
		$getstate 			= DB::table('states')->where('isactive','Y')->orderby('state_name','ASC')->get();
		$getcountry 		= DB::table('countries')->where('enabled','Y')->orderby('country_name','ASC')->get();

		if(count($getstate)>0 && count($getcity)>0){
			$arr_city__state = array_merge($getstate,$getcity);
		}
		rsort($arr_city__state);
		foreach ($arr_city__state as $key => $value) {
			if(isset($value->state_name) && !empty($value->state_name)){
				$data_name['data_arr'][] = $value->state_name;
			}else{
				$data_name['data_arr'][] = $value->city_name;
			}
		}

		foreach($getcountry as $key=>$val){
			$country_arr[] = $val->country_name;
		}

		if(isset($getrequest) && !empty($getrequest)){
			$getpostdata = array(
				'nationality'=> $getrequest['citizen_to_text'],
				'terms'=> ($getrequest['terms']=='on')?"yes":"no"
			);
		}

		return view('srilanka/srilanka_visa_application', compact('ccode','getpostdata','getservice','getmarital','data_name','country_arr'));
}

public function saveSLformdata(Request $request){
	
	$getrequest = $request->all();
	$ccode = $request->route('ccode');
	// echo "<pre>";print_r($getrequest);exit;
	$responseData = array();
	$data_user = array();
	$child_array = array();
	$marital_status_id = "";
	$purposeid = "";
	$serviceid = "";
	$emailid = "";
	$mobilenumber = "";
	if(isset($getrequest) && !empty($getrequest)){
		
		if($getrequest['travel_type_text']=="Tourist"){
				$serviceid = 5;
		} else if($getrequest['travel_type_text']=="Business"){
				$serviceid = 6;
		} else if($getrequest['travel_type_text']=="Transit"){
				$serviceid = 7;
		}

		if($getrequest['travel_type_text']=="Business") {
			$emailid = !empty($getrequest['email_id'])?$getrequest['email_id']:NULL;
			$mobilenumber = !empty($getrequest['applicant_telephone_number_business'])?$getrequest['applicant_telephone_number_business']:NULL;
		} else {
			$emailid = !empty($getrequest['email_id'])?$getrequest['email_id']:NULL;
			$mobilenumber = !empty($getrequest['mobile_number_tourist'])?$getrequest['mobile_number_tourist']:$getrequest['telephone_number_tourist'];
		}

		if(isset($getrequest['alias_is']) && $getrequest['alias_is']=="Y"){
			$child_arr = array($getrequest['child_given_name'],$getrequest['child_surname_name'],$getrequest['child_type_dob_srilanka'],$getrequest['child_gender_text'],$getrequest['child_relation_text']);
			foreach($child_arr as $array){
				foreach($array as $key=>$val) {
					$child_array[$key][] = $val;
				}
			}
		}
		
			$data_user = array(
					'uid'=>'',
					'username'=>!empty($getrequest['passport_given_name'])?$getrequest['passport_given_name']." ".$getrequest['passport_surname_name']:NULL,
					'email'=> $emailid,
					'phone'=> $mobilenumber,
					'nationality'=>"India",
					'created_at'=> date('Y-m-d H:i:s')
				);
			$uid = $this->saveUserDetails($data_user);
			if($uid){
				$data_ord = array(
					'order_id'=>'',
					'order_code'=> 'RCAETA'.date("ymd").rand(10000 , 99999),
					'user_id'=> $uid,
					'product_id'=> 1,
					'adult'=> 0,
					'child'=> 0,
					'infant'=> 0,
					'nationality'=> "India",
					'total_price'=> NULL,
					'residing_in'=> NULL,
					'residing_code'=> NULL,
					'travel_to'=> "Sri Lanka",
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
					'username' => !empty($getrequest['passport_given_name'])?$getrequest['passport_given_name']:NULL,
					'surname' => !empty($getrequest['passport_surname_name'])?$getrequest['passport_surname_name']:NULL,		
					'mobile_number' => $mobilenumber,
					'marital_status_id' => NULL,
  	 				'dob' => !empty($getrequest['type_dob_srilanka'])?$getrequest['type_dob_srilanka']:NULL,
					'gender' => !empty($getrequest['gender'])?$getrequest['gender']:NULL,
					'nationality'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
					'is_child'=>!empty($getrequest['alias_is'])?$getrequest['alias_is']:NULL,
					'order_id' => $ordid
				);

				$this->saveApplicantProfile($app_data);

				$user_leads_data = array(
					'session_id'=> session()->getId(),
					'name' => !empty($getrequest['passport_given_name'])?$getrequest['passport_given_name']." ".$getrequest['passport_surname_name']:NULL,
					'phone_number' => $mobilenumber,
					'email_id'=> $emailid,
					'nationality' => !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
					'residing_in' => NULL,
					'travelling_to' => "Sri Lanka",
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

						$ppid = DB::table('passport_details')->insertGetId([
				    		'user_id'=>$uid,
				    		'applicant_id'=>$applicant_id->profile_id,
				    		'pp_no' => !empty($getrequest['passport_number'])?$getrequest['passport_number']:NULL,
				    		'pp_issue_date'=> !empty($getrequest['type_doi_srilanka'])?$getrequest['type_doi_srilanka']:NULL,
				    		'pp_expiry_date'=> !empty($getrequest['type_doe_srilanka'])?$getrequest['type_doe_srilanka']:NULL,
				    	]);

				    	$saveservicedetails = UserserviceDetails::firstOrCreate(['order_id'=>$ordid,'service_id'=>$serviceid]);
						$saveservicedetails->service_id = $serviceid;
						$saveservicedetails->purpose_id = "";
						$saveservicedetails->order_id = $ordid;
						$saveservicedetails->applicant_id = $applicant_id->profile_id;
						$saveservicedetails->user_id = $uid;
						$saveservicedetails->status = "Y";

					$saveservicedetails->save();

					$res_arr = array(
						'i_agree_terms'=> !empty($getrequest['i_agree_terms'])?$getrequest['i_agree_terms']:NULL,
						'tourist_purpose' => !empty($getrequest['purpose_of_visit_text_tourist'])?$getrequest['purpose_of_visit_text_tourist']:NULL,
			        	'business_purpose' => !empty($getrequest['purpose_of_visit_text_business'])?$getrequest['purpose_of_visit_text_business']:NULL,
			        	'purpose_description'=> !empty($getrequest['purpose_description'])?$getrequest['purpose_description']:NULL,
			        	'intended_stay_days_text'=> !empty($getrequest['intended_stay_days_text'])?$getrequest['intended_stay_days_text']:NULL,
			        	'transit_purpose' => !empty($getrequest['purpose_of_visit_text_transit'])?$getrequest['purpose_of_visit_text_transit']:NULL,
			        	'final_destination'=> !empty($getrequest['final_destination'])?$getrequest['final_destination']:NULL,
						'applicant_company_contact_details'=>array(
							'company_name'=>!empty($getrequest['applicant_company_name_business'])?$getrequest['applicant_company_name_business']:NULL,
							'address1'=>!empty($getrequest['applicant_address_line_one_business'])?$getrequest['applicant_address_line_one_business']:NULL,
							'address2'=>!empty($getrequest['applicant_address_line_two_business'])?$getrequest['applicant_address_line_two_business']:NULL,
							'city'=>!empty($getrequest['applicant_city_business'])?$getrequest['applicant_city_business']:NULL,
							'state'=>!empty($getrequest['applicant_state_business'])?$getrequest['applicant_state_business']:NULL,
							'zipcode'=>!empty($getrequest['applicant_zipcode_business'])?$getrequest['applicant_zipcode_business']:NULL,
							'country'=>!empty($getrequest['applicant_country_business'])?$getrequest['applicant_country_business']:NULL,
							'telephone'=>!empty($getrequest['applicant_telephone_number_business'])?$getrequest['applicant_telephone_number_business']:NULL,
							'mobile'=>!empty($getrequest['applicant_mobile_number_business'])?$getrequest['applicant_mobile_number_business']:NULL,
							'fax'=>!empty($getrequest['applicant_fax_number_business'])?$getrequest['applicant_fax_number_business']:NULL,
							'email'=>!empty($getrequest['applicant_email_id_business'])?$getrequest['applicant_email_id_business']:NULL,
						),
						'srilanka_company_contact_details'=>array(
							'company_name'=>!empty($getrequest['srilankan_company_name_business'])?$getrequest['srilankan_company_name_business']:NULL,
							'address1'=>!empty($getrequest['srilankan_address_line_one_business'])?$getrequest['srilankan_address_line_one_business']:NULL,
							'address2'=>!empty($getrequest['srilankan_address_line_two_business'])?$getrequest['srilankan_address_line_two_business']:NULL,
							'city'=>!empty($getrequest['srilankan_city_business'])?$getrequest['srilankan_city_business']:NULL,
							'state'=>!empty($getrequest['srilankan_state_business'])?$getrequest['srilankan_state_business']:NULL,
							'zipcode'=>!empty($getrequest['srilankan_zipcode_business'])?$getrequest['srilankan_zipcode_business']:NULL,
							'telephone'=>!empty($getrequest['srilankan_telephone_number_business'])?$getrequest['srilankan_telephone_number_business']:NULL,
							'mobile'=>!empty($getrequest['srilankan_mobile_number_business'])?$getrequest['srilankan_mobile_number_business']:NULL,
							'fax'=>!empty($getrequest['srilankan_fax_number_business'])?$getrequest['srilankan_fax_number_business']:NULL,
							'email'=>!empty($getrequest['srilankan_email_id_business'])?$getrequest['srilankan_email_id_business']:NULL,
						),
						'address1'=>!empty($getrequest['address_line_one_tourist'])?$getrequest['address_line_one_tourist']:NULL,
						'address2'=> !empty($getrequest['address_line_two_tourist'])?$getrequest['address_line_two_tourist']:NULL,
						'city'=> !empty($getrequest['city_tourist'])?$getrequest['city_tourist']:NULL,
						'state'=> !empty($getrequest['state_tourist'])?$getrequest['state_tourist']:NULL,
						'zipcode'=> !empty($getrequest['zipcode_tourist'])?$getrequest['zipcode_tourist']:NULL,
						'country'=> !empty($getrequest['country_tourist'])?$getrequest['country_tourist']:NULL,
						'address_srilanka'=> !empty($getrequest['address_line_in_srilanka_tourist'])?$getrequest['address_line_in_srilanka_tourist']:NULL,
						'email'=> !empty($getrequest['email_id'])?$getrequest['email_id']:NULL,
						'telephone'=> !empty($getrequest['telephone_number_tourist'])?$getrequest['telephone_number_tourist']:NULL,
						'mobile'=> $mobilenumber,
						'fax'=> !empty($getrequest['fax_number_tourist'])?$getrequest['fax_number_tourist']:NULL,
						'purpose_desc'=> !empty($getrequest['purpose_description'])?$getrequest['purpose_description']:NULL,
						'intended_stay_days'=>!empty($getrequest['intended_stay_days_text'])?$getrequest['intended_stay_days_text']:NULL,
						'is_child_on_pass'=> !empty($getrequest['alias_is'])?$getrequest['alias_is']:NULL,
						'child'=> $child_array,
						'arrival_date'=> !empty($getrequest['arrival_date'])?$getrequest['arrival_date']:NULL,
						'port_of_departue'=> !empty($getrequest['port_of_departure'])?$getrequest['port_of_departure']:NULL,
						'airline_vessel'=> !empty($getrequest['airline_vessel'])?$getrequest['airline_vessel']:NULL,
						'airline_vessel_no'=> !empty($getrequest['flight_vessel_number'])?$getrequest['flight_vessel_number']:NULL,
						'valid_resident'=> !empty($getrequest['is_valid_resident_visa_to_srilanka_tourist'])?$getrequest['is_valid_resident_visa_to_srilanka_tourist']:NULL,
						'has_valid_eta'=> !empty($getrequest['is_currently_in_srilanka_with_valid_eta_tourist'])?$getrequest['is_currently_in_srilanka_with_valid_eta_tourist']:NULL,
						'mutiple_entry_visa'=> !empty($getrequest['have_multiple_entry_visa_to_srilanka_tourist'])?$getrequest['have_multiple_entry_visa_to_srilanka_tourist']:NULL,
						'is_valid_resident_visa_to_srilanka_business'=>!empty($getrequest['is_valid_resident_visa_to_srilanka_business'])?$getrequest['is_valid_resident_visa_to_srilanka_business']:NULL,
						'have_multiple_entry_visa_to_srilanka_business'=> !empty($getrequest['have_multiple_entry_visa_to_srilanka_business'])?$getrequest['have_multiple_entry_visa_to_srilanka_business']:NULL,
						'is_currently_in_srilanka_with_valid_eta_business'=> !empty($getrequest['is_currently_in_srilanka_with_valid_eta_business'])?$getrequest['is_currently_in_srilanka_with_valid_eta_business']:NULL,
						'occupation'=>!empty($getrequest['occupation'])?$getrequest['occupation']:NULL,
						'is_valid_resident_visa_to_srilanka_transit'=> !empty($getrequest['is_valid_resident_visa_to_srilanka_transit'])?$getrequest['is_valid_resident_visa_to_srilanka_transit']:NULL,
						'have_multiple_entry_visa_to_srilanka_transit'=> !empty($getrequest['have_multiple_entry_visa_to_srilanka_transit'])?$getrequest['have_multiple_entry_visa_to_srilanka_transit']:NULL,
						'is_currently_in_srilanka_with_valid_eta_transit'=> !empty($getrequest['is_currently_in_srilanka_with_valid_eta_transit'])?$getrequest['is_currently_in_srilanka_with_valid_eta_transit']:NULL,
						'country_of_birth'=> !empty($getrequest['country_of_birth'])?$getrequest['country_of_birth']:NULL,
						'salutation'=> !empty($getrequest['salutation'])?$getrequest['salutation']:NULL
					);				

					$saverelationdetails = ApplicationrelationDetails::firstOrCreate(['applicant_id'=>$applicant_id->profile_id]);
					$saverelationdetails->applicant_id = $applicant_id->profile_id;
					$saverelationdetails->pres_add1 = !empty($getrequest['address_line_one_tourist'])?$getrequest['address_line_one_tourist']:NULL;
					$saverelationdetails->pres_country = !empty($getrequest['country_tourist'])?$getrequest['country_tourist']:NULL;
					$saverelationdetails->state_name = !empty($getrequest['state_tourist'])?$getrequest['state_tourist']:NULL;
					$saverelationdetails->pres_phone = $mobilenumber;
					$saverelationdetails->application_details = !empty($res_arr)?json_encode($res_arr):NULL;
					
					$saverelationdetails->save();
						}
					}
					
				$getorderdetails = OrderDetails::where('order_id','=',$ordid)
        							->first();
			    $getservice = PricingMaster::where('nationality', $getrequest['nationality'])
								->where('product_id',1)->where('product_name',$getrequest['travel_type_text'])->where('product_type','Sri Lanka Evisa')
								->first();

				$saveFinalData = array(
					'nationality'=>!empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
					'order_id'=>!empty($ordid)?$ordid:NULL,
					'applicant_id'=>!empty($applicant_id->profile_id)?$applicant_id->profile_id:NULL,
					'uid'=>!empty($uid)?$uid:NULL,
					'type_of_visa'=>"ETA-Sri Lanka",
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
		
	}

	$postData = array(
		'order_id'=>$ordid,
		'applicant_id'=>$applicant_id->profile_id,
		'uid'=>$uid,
		'order_code'=>$getorderdetails['order_code']
	);


	UserLeads::where('order_id', $postData['order_id'])
            ->update(['status'=>'Evisa-verifyemail']);

    OrderDetails::where('order_id', $postData['order_id'])
            ->update(['applicant_booking_status'=>'Evisa-verifyemail']);

    /* setcookie ("partial_form", 'verifyemail', time()+3600*24*(2), '/', "", 0 );
    setcookie ("uid", $getpostdata['uid'], time()+3600*24*(2), '/', "", 0 );
	setcookie ("order_id", $getpostdata['order_id'], time()+3600*24*(2), '/', "", 0 ); */  
	if(!empty($postData['order_id']) && !empty($postData['uid'])){
		$track_data = array(
					'partial_form'=>"verifyemail",
            		'order_id'=>$postData['order_id'],
            		'user_id'=>$postData['uid'],
            	);
        Session::put('track_details', $track_data);	
	}

	return view('srilanka/getSLformresponse', compact('postData','ccode','getservice'));
}

public function srilankareviewform(Request $request) {
	$getrequest = $request->all();
	$order_id = $request->route('ordid');
	$extractdata = array();
	
	if(!empty($order_id)) {
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

		// $getpurposename = DB::table('india_evisa_purpose')->where('purpose_id',$getserviceiddetails->purpose_id)->first();	

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
		echo "<pre>";print_r($extractdata);exit;						
	}
	if($request->isMethod('post')) {

	}

	return view('srilanka/srilankareviewform', compact('extractdata','getservice','getmarital'));
}

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
	$ord_details->applicant_booking_status = $getpostdata['applicant_booking_status'];

	$ord_details->save();

	$ordid = $ord_details->order_id;

	return $ordid;
}
public function saveApplicantProfile($getpostdata){
	$saveapplicant = new ApplicantProfiles;

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
	$saveapplicant->is_child = $getpostdata['is_child'];

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
}
