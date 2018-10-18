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

class EvisaapplicationController extends ApplicationController {

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
	
	public function visaapplication(Request $request){
		$getrequest = $request->all();
		$utm_url = "";
		$referer = "";
		$getsession = Session::get('track_details');
		
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
						->where('travel_to',$getrequest['travel_to'])
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

		if(isset($getsession) && !empty($getsession['order_id'])){
			Session::flush();
		}
		
		$postData = array(
			'travel_to'=> !empty($getrequest['travel_to'])?$getrequest['travel_to']:NULL,
			'citizen_to'=> !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
			'residing_in'=> !empty($getrequest['residing_in'])?$country_name->country_name:NULL,
			'residing_code'=> !empty($getrequest['residing_in'])?$country_name->country_code:NULL,
			'evisa_summary'=> !empty($evisa_summary)?htmlspecialchars_decode(stripslashes($evisa_summary->content)):NULL,
			'travel_to_text'=> !empty($getrequest['travel_to_text'])?$getrequest['travel_to_text']:NULL,
			'citizen_to_text'=> !empty($getrequest['citizen_to_text'])?$getrequest['citizen_to_text']:NULL,
			'utm_url'=> !empty($utm_url)?$utm_url:NULL
		);
		
		return view('evisaapplication/visaapplication_step_1',compact('postData'));
	}

	public function applyonline(Request $request){
		$getrequest = $request->all();
		$getairport = AirportDetails::where('active', 'Y')
						->orderby('airport_name', 'ASC')
                     	->get();
		$getpassporttype = PassportTypes::where('enabled', 'Y')
						->orderby('display_seq', 'ASC')
                     	->get();                     	
        $airport_arr = $passporttype_arr = array();
        $postData = array(
			'travel_to'=> !empty($getrequest['travel_to'])?$getrequest['travel_to']:NULL,
			'citizen_to'=> !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
			'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
			'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL
		);
        foreach($getairport as $key=>$val){
        	$airport_arr[] = array(
        			'airport_id'=>$val['airport_id'],
        			'airport_name'=>$val['airport_name']
        	);
        } 
        foreach ($getpassporttype as $key => $value) {
           $passporttype_arr[] = array(
        			'passport_type_id'=>$value['passport_type_id'],
        			'passport_type_code'=>$value['passport_type_code'],
        			'passport_type_name'=>$value['passport_type_name']
        	);
        }            	
        // echo "<pre>";print_r($airport_arr);exit;             	
		return view('evisaapplication/applyonline',compact('airport_arr','passporttype_arr','postData'));
	}

public function evisaservicedocument(Request $request){
	$getrequest = $request->all();
	$serviceid = array();
	$getsession = Session::get('track_details');
	
	if(isset($getrequest) && empty($getrequest)){
		$getorderdetails = 	DB::table('order_details')
						->join('users','users.user_id','=','order_details.user_id')
						->join('applicant_profiles','applicant_profiles.order_id','=','order_details.order_id')
						->where('order_details.order_id',$getsession['order_id'])
						->where('order_details.user_id',$getsession['user_id'])
						->first();
		$getservice_arr = DB::table('tbl_user_service_details')
							->where('order_id',$getsession['order_id'])
							->where('user_id',$getsession['user_id'])
							->get();
		foreach ($getservice_arr as $key => $value) {
								# code...
			$serviceid[] = $value->service_id;
		}

		if(!empty($serviceid)){
			$serviceid = array_flip($serviceid);
		}					
											
		$getpostdata = array(
		'residing_in'=> !empty($getorderdetails->residing_in)?$getorderdetails->residing_in:NULL,
		'residing_code'=> !empty($getorderdetails->residing_code)?$getorderdetails->residing_code:NULL,
		'nationality'=> !empty($getorderdetails->nationality)?$getorderdetails->nationality:NULL,
		'order_id'=> !empty($getorderdetails->order_id)?$getorderdetails->order_id:NULL,
		'applicant_id'=> !empty($getorderdetails->profile_id)?$getorderdetails->profile_id:NULL,
		'uid'=> !empty($getorderdetails->user_id)?$getorderdetails->user_id:NULL,
		'passport_type'=> !empty($getorderdetails->passport_type)?$getorderdetails->passport_type:NULL,
		'order_code'=> !empty($getorderdetails->order_code)?$getorderdetails->order_code:NULL
		);			
	}else{
		$getpostdata = array(
		'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
		'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
		'nationality'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
		'order_id'=> !empty($getrequest['order_id'])?$getrequest['order_id']:NULL,
		'applicant_id'=> !empty($getrequest['applicant_id'])?$getrequest['applicant_id']:NULL,
		'uid'=> !empty($getrequest['uid'])?$getrequest['uid']:NULL,
		'passport_type'=> !empty($getrequest['passport_type'])?$getrequest['passport_type']:NULL,
		'order_code'=> !empty($getrequest['order_code'])?$getrequest['order_code']:NULL
		);
	}

	if(isset($getrequest['visa_type'])){
		$serviceid = array_flip($getrequest['visa_type']);
	}
	
	UserLeads::where('order_id', $getpostdata['order_id'])
            ->update(['status'=>'Evisa-ExtraDocument']);

    OrderDetails::where('order_id', $getpostdata['order_id'])
            ->update(['applicant_booking_status'=>'Evisa-ExtraDocument']);

    //Page: set_cookie.php
	//$_SERVER['HTTP_HOST'] = 'http://www.example.com ';
	// localhost create problem on IE so this line
	// to get the top level domain
	/* setcookie ("partial_form", 'Evisa-ExtraDocument', time()+3600*24*(2), '/', "", 0 );
	setcookie ("uid", $getrequest['uid'], time()+3600*24*(2), '/', "", 0 );
	setcookie ("order_id", $getrequest['order_id'], time()+3600*24*(2), '/', "", 0 );  */
	
	if(!empty($getpostdata['order_id']) && !empty($getpostdata['uid'])){
		$track_data = array(
					'partial_form'=>"Evisa-ExtraDocument",
            		'order_id'=>$getpostdata['order_id'],
            		'user_id'=>$getpostdata['uid'],
            	);
        Session::put('track_details', $track_data);	
	}	

    if(!empty($getrequest['evisa_purpose'])){
		foreach($getrequest['evisa_purpose'] as $key=>$val){
				$saveservicedetails = UserserviceDetails::firstOrCreate(['order_id'=>$getpostdata['order_id'],'service_id'=>$key]);
				$saveservicedetails->service_id = $key;
				$saveservicedetails->purpose_id = $val;
				$saveservicedetails->order_id = !empty($getpostdata['order_id'])?$getpostdata['order_id']:NULL;
				$saveservicedetails->applicant_id = !empty($getpostdata['applicant_id'])?$getpostdata['applicant_id']:NULL;
				$saveservicedetails->user_id = !empty($getpostdata['uid'])?$getpostdata['uid']:NULL;
				$saveservicedetails->status = "Y";

				$saveservicedetails->save();
		}
	}        

	return view('evisaapplication/evisaservicedoc',compact('getpostdata','serviceid'));
}	

public function saveevisaapplication(Request $request){
		$getrequest = $request->all();
		$getsession = Session::get('track_details');
		$postData = array();
		
		if(isset($getrequest) && empty($getrequest)){
			// echo "hii";exit;
			$getorderdetails = 	DB::table('order_details')
						->join('users','users.user_id','=','order_details.user_id')
						->join('applicant_profiles','applicant_profiles.order_id','=','order_details.order_id')
						->where('order_details.order_id',$getsession['order_id'])
						->where('order_details.user_id',$getsession['user_id'])
						->first();

			$service_arr = array();
			$purpose_arr = array();
			$get_service_arr = array();
			$getservice = PricingMaster::where('nationality', $getorderdetails->nationality)
								->where('product_id',1)
								->get();
										
		}else{
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
				'order_code'=> $this->RandomString(15),
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
				'passport_type'=> !empty($getrequest['passport_code'])?$getrequest['passport_code']:NULL,
				'airport_code'=> !empty($getrequest['airport_code'])?$getrequest['airport_code']:NULL,
				'arrival_date'=> !empty($getrequest['arrival_date'])?$getrequest['arrival_date']:NULL,
				'applicant_booking_status'=> "Evisa-Services",
				'created_at'=> date('Y-m-d H:i:s')
			);

			$ordid = $this->saveOrderDetails($data_ord);

				if(!empty($ordid)){

					$app_data = array(
						'user_id' => $uid,
						'username' => "Applicant-1",
						'mobile_number' => !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL,
						'nationality' => !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
						'country' => !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
						'order_id' => $ordid
					);

					$this->saveApplicantProfile($app_data);

					$applicant_id = ApplicantProfiles::select(DB::raw('max(profile_id) as profile_id'))->get()->first();

					if(!empty($applicant_id->profile_id)){
						if(!empty($getrequest['frontpage'])){
							// $validator = Validator::make($getrequest,
				   //              [
				   //                  'frontpage' => 'image',
				   //              ],
				   //              [
				   //                  'frontpage.image' => 'The file must be an image (jpeg, jpg, png, bmp, gif, or svg)'
				   //              ]);
				   //          if ($validator->fails())
				   //              return array(
				   //                  'fail' => true,
				   //                  'errors' => $validator->errors()
				   //              );


					    	$passport_front = $request->file('frontpage');
					    	$doc_type = "PASSPORT_FRONT";

					    	$input['imagename'] = "passport-front-".time().'.'.$passport_front->getClientOriginalExtension();
						    $imgsize = $passport_front->getClientSize();
						    $imgtype = $passport_front->getClientMimeType();

						    $destinationPath = public_path('doc-upload/');
						    
						    $request->file('frontpage')->move($destinationPath, $input['imagename']);

						    $savedocdetails = DocumentDetails::firstOrCreate(['applicant_id' => $applicant_id->profile_id,'doc_type_id'=>1]);

						    $savedocdetails->user_id = $uid;
						    $savedocdetails->applicant_id = $applicant_id->profile_id;
						    $savedocdetails->doc_type = $doc_type;
						    $savedocdetails->doc_type_id = 1;
						    $savedocdetails->doc_size = $imgsize;
						    $savedocdetails->doc_url = "/doc-upload/".$input['imagename'];
						    $savedocdetails->doc_mime_type = $imgtype;

						    $savedocdetails->save();	
						}

						if(!empty($getrequest['photograph'])){
							// $validator = Validator::make($getrequest,
				   //              [
				   //                  'photograph' => 'image',
				   //              ],
				   //              [
				   //                  'photograph.image' => 'The file must be an image (jpeg, jpg, png, bmp, gif, or svg)'
				   //              ]);
				   //          if ($validator->fails())
				   //              return array(
				   //                  'fail' => true,
				   //                  'errors' => $validator->errors()
				   //              );


					    	$photograph = $request->file('photograph');
					    	$doc_type = "PHOTO";

					    	$input['imagename'] = "photograph-".time().'.'.$photograph->getClientOriginalExtension();
						    $imgsize = $photograph->getClientSize();
						    $imgtype = $photograph->getClientMimeType();

						    $destinationPath = public_path('doc-upload/');
						    
						    $request->file('photograph')->move($destinationPath, $input['imagename']);

						    $savedocdetails = DocumentDetails::firstOrCreate(['applicant_id' => $applicant_id->profile_id,'doc_type_id'=>3]);

						    $savedocdetails->user_id = $uid;
						    $savedocdetails->applicant_id = $applicant_id->profile_id;
						    $savedocdetails->doc_type = $doc_type;
						    $savedocdetails->doc_type_id = 3;
						    $savedocdetails->doc_size = $imgsize;
						    $savedocdetails->doc_url = "/doc-upload/".$input['imagename'];
						    $savedocdetails->doc_mime_type = $imgtype;

						    $savedocdetails->save();	
						}
					}

					$user_leads_data = array(
						'session_id'=> session()->getId(),
						'name' => !empty($getrequest['user_name'])?$getrequest['user_name']:NULL,
						'phone_number' => !empty($getrequest['phone_number'])?$getrequest['phone_number']:NULL,
						'email_id'=> !empty($getrequest['email_id'])?$getrequest['email_id']:NULL,
						'nationality' => !empty($getrequest['citizen_to'])?$getrequest['citizen_to']:NULL,
						'residing_in' => !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
						'travelling_to' => !empty($getrequest['travel_to'])?$getrequest['travel_to']:NULL,
						'passport_type' => !empty($getrequest['passport_code'])?$getrequest['passport_code']:NULL,
						'airport_code' => !empty($getrequest['airport_code'])?$getrequest['airport_code']:NULL,
						'arrival_date' => !empty($getrequest['arrival_date'])?$getrequest['arrival_date']:NULL,
						'product_id' => 1,
						'order_id' => $ordid,
						'created_at' => date('Y-m-d H:i:s'),
						'status' => "Evisa-Services"	
					);

					$this->saveUserLeads($user_leads_data);
				}

				$service_arr = array();
				$purpose_arr = array();
				$get_service_arr = array();
				$getservice = PricingMaster::where('nationality', $getrequest['citizen_to'])
									->where('product_id',1)
									->get();
		}
		
		foreach($getservice as $key=>$row){
			$service_arr[] = array(
				'p_id'=> $row['p_id'],
				'nationality'=> $row->nationality,
				'product_id'=> $row->product_id,
				'product_type'=> $row->product_type,
				'product_name'=> $row->product_name,
				'service_id'=> $row->service_id,
				'currency'=> $row->currency,
				'adult_cost_price'=> $row->adult_cost_price,
				'service_charge_adult'=> $row->service_charge_adult,
				'total'=> $row->total,
				'is_active'=> $row->is_active
			);
		}

		foreach ($service_arr as $key => $value) {
					# code...
					$getpurpose = EvisaPurpose::where('service_id', $value['service_id'])
							->where('product_id',1)
							->get();
					foreach ($getpurpose as $key => $value1) {
						# code...
						$purpose_arr[$value['product_name']][] = array(
							'purpose_id'=> $value1->purpose_id,
							'purpose_name'=> $value1->purpose_name,
							'product_name'=> $value1->product_name,
							'product_id'=> $value1->product_id,
							'is_active'=> $value1->is_active
						);		
					}

					$get_service_arr[] = array(
						'p_id'=> $value['p_id'],
						'nationality'=> $value['nationality'],
						'product_id'=> $value['product_id'],
						'product_type'=> $value['product_type'],
						'product_name'=> $value['product_name'],
						'service_id'=> $value['service_id'],
						'currency'=> $value['currency'],
						'adult_cost_price'=> $value['adult_cost_price'],
						'service_charge_adult'=> $value['service_charge_adult'],
						'total'=> $value['total'],
						'is_active'=> $value['is_active'],
						'purpose_que'=> $purpose_arr
					);	
					unset($purpose_arr);		
				}
		$getpostdata = array(
			'order_id' => !empty($ordid)?$ordid:$getorderdetails->order_id,
			'applicant_id' => !empty($applicant_id->profile_id)?$applicant_id->profile_id:$getorderdetails->profile_id,
			'uid' => !empty($uid)?$uid:$getorderdetails->user_id,
			'residing_in'=>!empty($getrequest['residing_in'])?$getrequest['residing_in']:$getorderdetails->residing_in,
			'nationality'=>!empty($getrequest['citizen_to'])?$getrequest['citizen_to']:$getorderdetails->nationality,
			'residing_code'=>!empty($getrequest['residing_code'])?$getrequest['residing_code']:$getorderdetails->residing_code,
			'passport_type'=> !empty($getrequest['passport_code'])?$getrequest['passport_code']:$getorderdetails->passport_type,
			'order_code'=>$data_ord['order_code']
		);

	return view('evisaapplication/evisatype',compact('getpostdata','get_service_arr'));

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
	$ord_details->is_review_updated = !empty($getpostdata['is_review_updated'])?$getpostdata['is_review_updated']:"N";
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

public function evisaapplicationform(Request $request){
	$getrequest = $request->all();
	$r=array("error"=>false,"message"=>"");
	$getsession = Session::get('track_details');
	// echo "<pre>";print_r($getrequest);exit; 
	if(isset($getrequest) && empty($getrequest)){
		$getorderdetails = 	DB::table('order_details')
						->join('users','users.user_id','=','order_details.user_id')
						->join('applicant_profiles','applicant_profiles.order_id','=','order_details.order_id')
						->where('order_details.user_id',$getsession['user_id'])
						->where('order_details.order_id',$getsession['order_id'])
						->first();
		$getpostdata = array(
		'residing_in'=> !empty($getorderdetails->residing_in)?$getorderdetails->residing_in:NULL,
		'residing_code'=> !empty($getorderdetails->residing_code)?$getorderdetails->residing_code:NULL,
		'nationality'=> !empty($getorderdetails->nationality)?$getorderdetails->nationality:NULL,
		'order_id'=> !empty($getorderdetails->order_id)?$getorderdetails->order_id:NULL,
		'applicant_id'=> !empty($getorderdetails->profile_id)?$getorderdetails->profile_id:NULL,
		'uid'=> !empty($getorderdetails->user_id)?$getorderdetails->user_id:NULL,
		'passport_type'=> !empty($getorderdetails->passport_type)?$getorderdetails->passport_type:NULL,
		'order_code'=> !empty($getorderdetails->order_code)?$getorderdetails->order_code:NULL
		);			
	}else{
		$getpostdata = array(
		'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
		'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
		'nationality'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
		'order_id'=> !empty($getrequest['order_id'])?$getrequest['order_id']:NULL,
		'applicant_id'=> !empty($getrequest['applicant_id'])?$getrequest['applicant_id']:NULL,
		'uid'=> !empty($getrequest['uid'])?$getrequest['uid']:NULL,
		'passport_type'=> !empty($getrequest['passport_type'])?$getrequest['passport_type']:NULL,
		'order_code'=> !empty($getrequest['order_code'])?$getrequest['order_code']:NULL
		);
	}

	/* setcookie ("partial_form", 'Evisa-ApplicationDetails', time()+3600*24*(2), '/', "", 0 );
	setcookie ("uid", $getpostdata['uid'], time()+3600*24*(2), '/', "", 0 );
	setcookie ("order_id", $getpostdata['order_id'], time()+3600*24*(2), '/', "", 0 ); */
	
	if(!empty($getpostdata['order_id']) && !empty($getpostdata['uid'])){
		$track_data = array(
					'partial_form'=>"Evisa-ApplicationDetails",
            		'order_id'=>$getpostdata['order_id'],
            		'user_id'=>$getpostdata['uid'],
            	);
        Session::put('track_details', $track_data);	
	}
	
	UserLeads::where('order_id', $getpostdata['order_id'])
            ->update(['status'=>'Evisa-ApplicationDetails']);

    OrderDetails::where('order_id', $getpostdata['order_id'])
            ->update(['applicant_booking_status'=>'Evisa-ApplicationDetails']);
    //Page: set_cookie.php
	//$_SERVER['HTTP_HOST'] = 'http://www.example.com ';
	// localhost create problem on IE so this line
	// to get the top level domain
	
	// $applicant_id = ApplicantProfiles::select(DB::raw('max(profile_id) as profile_id'))->get()->first();
	$getorderdetails = 	DB::table('order_details')
						->join('product_master','product_master.product_id','=','order_details.product_id')
						->where('user_id',$getpostdata['uid'])
						->where('order_id',$getpostdata['order_id'])
						->first();

	$getapplicatdata = ApplicantProfiles::query()
						->join('document_details as dd','dd.applicant_id','=','applicant_profiles.profile_id')
						->where('applicant_profiles.user_id',$getpostdata['uid'])
						->where('applicant_profiles.profile_id',$getpostdata['applicant_id'])
						->get([
													'applicant_profiles.*',
													'dd.doc_id',
													'dd.doc_type',
													'dd.doc_url'
												])->first();					

	//echo "<pre>";print_r($getapplicatdata);exit;

	// $this->ex($r);

	if(!empty($getpostdata['applicant_id'])){
		if(isset($getrequest['business_card']) && !empty($getrequest['business_card'])){							
			$passport_front = $request->file('business_card');
			$doc_type = "BUSINESS_CARD";

			$input['imagename'] = "business-card-".time().'.'.$passport_front->getClientOriginalExtension();
			$imgsize = $passport_front->getClientSize();
			$imgtype = $passport_front->getClientMimeType();

			$destinationPath = public_path('doc-upload/');
							    
			$request->file('business_card')->move($destinationPath, $input['imagename']);

			$savedocdetails = DocumentDetails::firstOrCreate(['applicant_id' => $getpostdata['applicant_id'],'doc_type_id'=>18]);

			$savedocdetails->user_id = $getpostdata['uid'];
			$savedocdetails->applicant_id = $getpostdata['applicant_id'];
			$savedocdetails->doc_type = $doc_type;
			$savedocdetails->doc_type_id = 18;
			$savedocdetails->doc_size = $imgsize;
			$savedocdetails->doc_url = "/doc-upload/".$input['imagename'];
			$savedocdetails->doc_mime_type = $imgtype;

			$savedocdetails->save();
		}

		if(isset($getrequest['hospital_letter']) && !empty($getrequest['hospital_letter'])){
			$passport_front = $request->file('hospital_letter');
			$doc_type = "HOSPITAL_LETTER";

			$input['imagename'] = "hospital-letter-".time().'.'.$passport_front->getClientOriginalExtension();
			$imgsize = $passport_front->getClientSize();
			$imgtype = $passport_front->getClientMimeType();

			$destinationPath = public_path('doc-upload/');
							    
			$request->file('hospital_letter')->move($destinationPath, $input['imagename']);

			$savedocdetails = DocumentDetails::firstOrCreate(['applicant_id' => $getpostdata['applicant_id'],'doc_type_id'=>19]);

			$savedocdetails->user_id = $getpostdata['uid'];
			$savedocdetails->applicant_id = $getpostdata['applicant_id'];
			$savedocdetails->doc_type = $doc_type;
			$savedocdetails->doc_type_id = 19;
			$savedocdetails->doc_size = $imgsize;
			$savedocdetails->doc_url = "/doc-upload/".$input['imagename'];
			$savedocdetails->doc_mime_type = $imgtype;

			$savedocdetails->save();
		}
	}				

	if(!empty($getapplicatdata['doc_url'])){
		$passport_type      = $getapplicatdata["doc_type"];
		$passport_image_url = $getapplicatdata["doc_url"];
		$getocr = array();

		if(empty($passport_type) || empty($passport_image_url))
		{ 
			$this->e($r,"Cannot proceed, Passport front image is not present");
		}


		if($r["error"]){
			$this->ex($r);	
		}

		$target_dir = "/ocr-upload/";
	    $uploadOk = 1;
	    $FileType = strtolower(pathinfo($getapplicatdata['doc_url'],PATHINFO_EXTENSION));
	    $target_file = public_path().$target_dir . $this->generateRandomString() .'-'.$getpostdata['applicant_id'].'.'.$FileType;
	    $img_path     = public_path().$getapplicatdata['doc_url'];
	    
	    // GET ORIGINAL IMAGE DIMENSIONS
	        list($original_w, $original_h) = getimagesize($img_path);
	        // echo $original_w.'/'.$original_h;exit;
	        if ($original_w > $original_h){
	            //it's a landscape
	            $manipulator = new ImageManipulator($img_path);
	            $flag = $manipulator->save($target_file);
	            if($flag == 1){
	                $getocr = $this->uploadToApi($target_file, $FileType);
	            } else {
	                header('HTTP/1.0 403 Forbidden');
	                echo "Sorry, there was an error uploading your file.";
	            }
	        } else if ($original_w < $original_h){
	            //it's a portrait
	            if($original_h > 414){
	            $manipulator = new ImageManipulator($img_path);
	            $width  = $manipulator->getWidth();
	            $height = $manipulator->getHeight();
	            $centreX = 0;
	            $centreY = round($height / 2);

	            // our dimensions will be 200x130
	            $x1 = $centreX; // 200 / 2
	            $y1 = $centreY - 200; // 130 / 2
	     
	            $x2 = $centreX; // 200 / 2
	            $y2 = $centreY + 200; // 130 / 2

	            // echo $x2.'/'.$y2;exit;
	            // center cropping to 200x130
	            $newImage = $manipulator->crop(0, (round(($height)/2)) , $width, $height);
	            // saving file to uploads folder
	            $flag = $manipulator->save($target_file);
	            if($flag == 1){
	                $getocr = $this->uploadToApi($target_file, $FileType);
	            } else {
	                header('HTTP/1.0 403 Forbidden');
	                echo "Sorry, there was an error uploading your file.";
	            }
	            }else{
	            	$manipulator = new ImageManipulator($img_path);
	            	$flag = $manipulator->save($target_file);
		            if($flag == 1){
		                $getocr = $this->uploadToApi($target_file, $FileType);
		            } else {
		                header('HTTP/1.0 403 Forbidden');
		                echo "Sorry, there was an error uploading your file.";
		            }
	            }
	        } else {
	            //image width and height are equal, therefore it is square.
	            $manipulator = new ImageManipulator($img_path);
	            	$flag = $manipulator->save($target_file);
		            if($flag == 1){
		                $getocr = $this->uploadToApi($target_file, $FileType);
		        } else {
		                header('HTTP/1.0 403 Forbidden');
		                echo "Sorry, there was an error uploading your file.";
		        }
	        }
	}

	$getpassporttype = DB::table('passport_types')->get();
	$getcountry = DB::table('countries')->where('enabled',"Y")->orderby('country_name', 'ASC')->get();
	$getqualification = DB::table('tbl_qualification')->orderby('qualification', 'ASC')->get();
	// $getpropfession = DB::table('professions')->get();
	$getmarital = DB::table('marital_status')->get();
	// $getlang = DB::table('languages')->get();
	$getreligion = DB::table('religions')->orderby('religion_name')->get();	

	if(!empty($getrequest['evisa_purpose'])){
		foreach($getrequest['evisa_purpose'] as $key=>$val){
				$saveservicedetails = UserserviceDetails::firstOrCreate(['order_id'=>$getpostdata['order_id'],'service_id'=>$key]);
				$saveservicedetails->service_id = $key;
				$saveservicedetails->purpose_id = $val;
				$saveservicedetails->order_id = !empty($getpostdata['order_id'])?$getpostdata['order_id']:NULL;
				$saveservicedetails->applicant_id = !empty($getpostdata['applicant_id'])?$getpostdata['applicant_id']:NULL;
				$saveservicedetails->user_id = !empty($getpostdata['uid'])?$getpostdata['uid']:NULL;
				$saveservicedetails->status = "Y";

				$saveservicedetails->save();
		}
	}

	// echo "<pre>";print_r($getocr);exit;
	return view('evisaapplication/evisaform',compact('getpostdata','getapplicatdata','getocr','getpassporttype','getcountry','getpropfession','getmarital','getlang','getreligion','getqualification'));
}

public function evisaapplicationfamily(Request $request){
	$getrequest = $request->all();
	$getsession = Session::get('track_details');
	// $getsession = $request->session()->get('applicantdetails');
	// echo "<pre>";print_r($getrequest);exit;
	if(isset($getrequest) && empty($getrequest)){
		$getorderdetails = 	DB::table('order_details')
						->join('users','users.user_id','=','order_details.user_id')
						->join('applicant_profiles','applicant_profiles.order_id','=','order_details.order_id')
						->where('order_details.user_id',$getsession['user_id'])
						->where('order_details.order_id',$getsession['order_id'])
						->first();
		$getpostdata = array(
		'residing_in'=> !empty($getorderdetails->residing_in)?$getorderdetails->residing_in:NULL,
		'residing_code'=> !empty($getorderdetails->residing_code)?$getorderdetails->residing_code:NULL,
		'nationality'=> !empty($getorderdetails->nationality)?$getorderdetails->nationality:NULL,
		'order_id'=> !empty($getorderdetails->order_id)?$getorderdetails->order_id:NULL,
		'applicant_id'=> !empty($getorderdetails->profile_id)?$getorderdetails->profile_id:NULL,
		'uid'=> !empty($getorderdetails->user_id)?$getorderdetails->user_id:NULL,
		'passport_type'=> !empty($getorderdetails->passport_type)?$getorderdetails->passport_type:NULL,
		'order_code'=> !empty($getorderdetails->order_code)?$getorderdetails->order_code:NULL
		);			
	}else{
		
		$getpostdata = array(
		'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
		'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
		'nationality'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
		'order_id'=> !empty($getrequest['order_id'])?$getrequest['order_id']:NULL,
		'applicant_id'=> !empty($getrequest['applicant_id'])?$getrequest['applicant_id']:NULL,
		'uid'=> !empty($getrequest['uid'])?$getrequest['uid']:NULL,
		'passport_type'=> !empty($getrequest['passport_type'])?$getrequest['passport_type']:NULL,
		'order_code'=> !empty($getrequest['order_code'])?$getrequest['order_code']:NULL
		);

		$pass_data = array(
			'user_id'=>$getrequest['uid'],
			'applicant_id'=>$getrequest['applicant_id'],
			'pp_no'=>$getrequest['Passport_number'],
			'pp_type'=>$getrequest['passport_type'],
			'pp_expiry_date'=>$getrequest['doe'],
			'pp_issuing_date'=>$getrequest['doi'],
			'pp_issuing_govt'=>$getrequest['issue_gov'],
			'oth_ppt'=>!empty($getrequest['oth_ppt'])?$getrequest['oth_ppt']:NULL,
			'prev_passport_country_issue'=>!empty($getrequest['prev_passport_country_issue'])?$getrequest['prev_passport_country_issue']:NULL,
			'other_ppt_no'=>!empty($getrequest['other_ppt_no'])?$getrequest['other_ppt_no']:NULL,
			'other_ppt_issue_place'=>!empty($getrequest['other_ppt_issue_place'])?$getrequest['other_ppt_issue_place']:NULL,
			'other_ppt_issue_date'=>!empty($getrequest['other_ppt_issue_date'])?$getrequest['other_ppt_issue_date']:NULL,
			'other_ppt_nationality'=>!empty($getrequest['other_ppt_nationality'])?$getrequest['other_ppt_nationality']:NULL,
			'pp_place_of_issue'=>!empty($getrequest['issue_place'])?$getrequest['issue_place']:NULL
		);
		// echo "<pre>";print_r($pass_data);exit;
		$ppid = DB::table('passport_details')
    		->insertGetId(
            	['user_id'=>$pass_data['user_id'],'applicant_id'=>$pass_data['applicant_id'],'pp_no' => $pass_data['pp_no'], 'pp_type'=>$pass_data['pp_type'], 'pp_issue_date'=> $pass_data['pp_issuing_date'], 'pp_expiry_date'=> $pass_data['pp_expiry_date'], 'pp_issuing_govt'=> $pass_data['pp_issuing_govt'],'pp_place_of_issue'=>$pass_data['pp_place_of_issue'],'oth_ppt'=>$pass_data['oth_ppt'],'prev_passport_country_issue'=>$pass_data['prev_passport_country_issue'],'other_ppt_no'=>$pass_data['other_ppt_no'],'other_ppt_issue_place'=>$pass_data['other_ppt_issue_place'],'other_ppt_issue_date'=>$pass_data['other_ppt_issue_date'],'other_ppt_nationality'=>$pass_data['other_ppt_nationality']]
    	);

    	if($ppid){
    		ApplicantProfiles::where('profile_id', $getrequest['applicant_id'])
            ->where('user_id', $getrequest['uid'])
            ->update(['username'=>$getrequest['given_name'],'surname'=>$getrequest['surname'],'nationality_id'=>$getrequest['nationality'],'previous_surname'=>$getrequest['previous_surname'],'previous_name'=>$getrequest['previous_name'],'passport_detail_id'=>$ppid,'gender' => $getrequest['gender'], 'dob'=>$getrequest['dob'], 'place_of_birth'=> $getrequest['city_birth'], 'religion'=>$getrequest['religion_code'],'visible_marks'=>$getrequest['visible_marks'],'qualification'=>$getrequest['qualification'],'aquired_nation'=>$getrequest['aquired_nation'],'prev_nationality'=>$getrequest['prev_nationality'],'refer_flag'=>!empty($getrequest['refer_flag'])?$getrequest['refer_flag']:NULL,'country_of_birth'=>$getrequest['cob'],'citizenship_no'=>$getrequest['nation_id'],'visible_marks'=>$getrequest['visible_marks'],'qualification'=>$getrequest['qualification'],'aquired_nation'=>$getrequest['aquired_nation'],'prev_nationality'=>$getrequest['prev_nationality']]);
    	}
	}

	UserLeads::where('order_id', $getpostdata['order_id'])
            ->update(['status'=>'Evisa-RelationDetails']);

    OrderDetails::where('order_id', $getpostdata['order_id'])
            ->update(['applicant_booking_status'=>'Evisa-RelationDetails']);

    /* setcookie ("partial_form", 'Evisa-RelationDetails', time()+3600*24*(2), '/', "", 0 );  
    setcookie ("uid", $getpostdata['uid'], time()+3600*24*(2), '/', "", 0 );
	setcookie ("order_id", $getpostdata['order_id'], time()+3600*24*(2), '/', "", 0 );  */ 

	if(!empty($getpostdata['order_id']) && !empty($getpostdata['uid'])){
		$track_data = array(
					'partial_form'=>"Evisa-RelationDetails",
            		'order_id'=>$getpostdata['order_id'],
            		'user_id'=>$getpostdata['uid'],
            	);
        Session::put('track_details', $track_data);	
	}

	$getapplicatdata = ApplicantProfiles::query()
						->join('users','users.user_id','=','applicant_profiles.user_id')
						->where('applicant_profiles.user_id',$getpostdata['uid'])
						->where('applicant_profiles.profile_id',$getpostdata['applicant_id'])
						->get([
													'applicant_profiles.*',
													'email_id'
												])->first();
	// echo "<pre>";print_r($getapplicatdata);exit;
	$getcountry = DB::table('countries')->orderby('country_name', 'ASC')->get();
	$getpropfession = DB::table('tbl_occupation')->orderby('occupation_name','ASC')->get();
	$getmarital = DB::table('marital_status')->where('enabled','Y')->get();
	$getlang = DB::table('languages')->get();

	
    return view('evisaapplication/evisaform-familydetails',compact('getpostdata', 'getapplicatdata', 'getcountry','getpropfession','getmarital','getlang'));	

}

public function evisaapplicationdetails(Request $request){
	$getrequest = $request->all();
	$getsession = Session::get('track_details');
	
	if(isset($getrequest) && empty($getrequest)){
		$getorderdetails = 	DB::table('order_details')
						->join('users','users.user_id','=','order_details.user_id')
						->join('applicant_profiles','applicant_profiles.order_id','=','order_details.order_id')
						->where('order_details.user_id',$getsession['user_id'])
						->where('order_details.order_id',$getsession['order_id'])
						->first();
		$getpostdata = array(
		'residing_in'=> !empty($getorderdetails->residing_in)?$getorderdetails->residing_in:NULL,
		'residing_code'=> !empty($getorderdetails->residing_code)?$getorderdetails->residing_code:NULL,
		'nationality'=> !empty($getorderdetails->nationality)?$getorderdetails->nationality:NULL,
		'order_id'=> !empty($getorderdetails->order_id)?$getorderdetails->order_id:NULL,
		'applicant_id'=> !empty($getorderdetails->profile_id)?$getorderdetails->profile_id:NULL,
		'uid'=> !empty($getorderdetails->user_id)?$getorderdetails->user_id:NULL,
		'passport_type'=> !empty($getorderdetails->passport_type)?$getorderdetails->passport_type:NULL,
		'order_code'=> !empty($getorderdetails->order_code)?$getorderdetails->order_code:NULL
		);
	}else{
		$getpostdata = array(
		'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
		'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
		'nationality'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
		'order_id'=> !empty($getrequest['order_id'])?$getrequest['order_id']:NULL,
		'applicant_id'=> !empty($getrequest['applicant_id'])?$getrequest['applicant_id']:NULL,
		'uid'=> !empty($getrequest['uid'])?$getrequest['uid']:NULL,
		'passport_type'=> !empty($getrequest['passport_type'])?$getrequest['passport_type']:NULL,
		'order_code'=> !empty($getrequest['order_code'])?$getrequest['order_code']:NULL
		);
	$saverelationdetails = ApplicationrelationDetails::firstOrCreate(['applicant_id'=>$getrequest['applicant_id']]);
	$saverelationdetails->applicant_id = $getrequest['applicant_id'];
	$saverelationdetails->pres_add1 = !empty($getrequest['pres_add1'])?$getrequest['pres_add1']:NULL;
	$saverelationdetails->pres_add2 = !empty($getrequest['pres_add2'])?$getrequest['pres_add2']:NULL;
	$saverelationdetails->pres_country = !empty($getrequest['pres_country'])?$getrequest['pres_country']:NULL;
	$saverelationdetails->state_name = !empty($getrequest['state_name'])?$getrequest['state_name']:NULL;
	$saverelationdetails->pincode = !empty($getrequest['pincode'])?$getrequest['pincode']:NULL;
	$saverelationdetails->pres_phone = !empty($getrequest['pres_phone'])?$getrequest['pres_phone']:NULL;
	$saverelationdetails->perm_address1 = !empty($getrequest['perm_address1'])?$getrequest['perm_address1']:NULL;
	$saverelationdetails->perm_address2 = !empty($getrequest['perm_address2'])?$getrequest['perm_address2']:NULL;
	$saverelationdetails->perm_address3 = !empty($getrequest['perm_address3'])?$getrequest['perm_address3']:NULL;
	$saverelationdetails->father_name = !empty($getrequest['fthrname'])?$getrequest['fthrname']:NULL;
	$saverelationdetails->father_nationality = !empty($getrequest['father_nationality'])?$getrequest['father_nationality']:NULL;
	$saverelationdetails->father_previous_nationality = !empty($getrequest['father_previous_nationality'])?$getrequest['father_previous_nationality']:NULL;
	$saverelationdetails->father_place_of_birth = !empty($getrequest['father_place_of_birth'])?$getrequest['father_place_of_birth']:NULL;
	$saverelationdetails->father_country_of_birth = !empty($getrequest['father_country_of_birth'])?$getrequest['father_country_of_birth']:NULL;
	$saverelationdetails->mother_name = !empty($getrequest['mother_name'])?$getrequest['mother_name']:NULL;
	$saverelationdetails->mother_nationality = !empty($getrequest['mother_nationality'])?$getrequest['mother_nationality']:NULL;
	$saverelationdetails->mother_previous_nationality = !empty($getrequest['mother_previous_nationality'])?$getrequest['mother_previous_nationality']:NULL;
	$saverelationdetails->mother_place_of_birth = !empty($getrequest['mother_place_of_birth'])?$getrequest['mother_place_of_birth']:NULL;
	$saverelationdetails->mother_country_of_birth = !empty($getrequest['mother_country_of_birth'])?$getrequest['mother_country_of_birth']:NULL;
	$saverelationdetails->spouse_name = !empty($getrequest['spouse_name'])?$getrequest['spouse_name']:NULL;
	$saverelationdetails->spouse_nationality = !empty($getrequest['spouse_nationality'])?$getrequest['spouse_nationality']:NULL;
	$saverelationdetails->spouse_previous_nationality =!empty($getrequest['spouse_previous_nationality'])?$getrequest['spouse_previous_nationality']:NULL;
	$saverelationdetails->spouse_place_of_birth = !empty($getrequest['spouse_place_of_birth'])?$getrequest['spouse_place_of_birth']:NULL;
	$saverelationdetails->spouse_country_of_birth = !empty($getrequest['spouse_country_of_birth'])?$getrequest['spouse_country_of_birth']:NULL;
	$saverelationdetails->grandparent_flag1 = !empty($getrequest['grandparent_flag1'])?$getrequest['grandparent_flag1']:NULL;
	$saverelationdetails->grandparent_details = !empty($getrequest['grandparent_details'])?$getrequest['grandparent_details']:NULL;
	$saverelationdetails->pre_occupation = !empty($getrequest['pre_occupation'])?$getrequest['pre_occupation']:NULL;
	$saverelationdetails->if_occ_other = !empty($getrequest['if_prof_other'])?$getrequest['if_prof_other']:NULL;
	$saverelationdetails->occ_flag = !empty($getrequest['occ_flag'])?$getrequest['occ_flag']:NULL;
	$saverelationdetails->empname = !empty($getrequest['empname'])?$getrequest['empname']:NULL;
	$saverelationdetails->empdesignation = !empty($getrequest['empdesignation'])?$getrequest['empdesignation']:NULL;
	$saverelationdetails->empaddress = !empty($getrequest['empaddress'])?$getrequest['empaddress']:NULL;
	$saverelationdetails->empphone = !empty($getrequest['empphone'])?$getrequest['empphone']:NULL;
	$saverelationdetails->previous_occupation = !empty($getrequest['previous_occupation'])?$getrequest['previous_occupation']:NULL;
	$saverelationdetails->prev_org = !empty($getrequest['prev_org'])?$getrequest['prev_org']:NULL;
	$saverelationdetails->previous_organization = !empty($getrequest['previous_organization'])?$getrequest['previous_organization']:NULL;
	$saverelationdetails->previous_designation = !empty($getrequest['previous_designation'])?$getrequest['previous_designation']:NULL;
	$saverelationdetails->previous_rank = !empty($getrequest['previous_rank'])?$getrequest['previous_rank']:NULL;
	$saverelationdetails->previous_posting = !empty($getrequest['previous_posting'])?$getrequest['previous_posting']:NULL;

	$saverelationdetails->save();

	ApplicantProfiles::where('profile_id', $getrequest['applicant_id'])
            ->where('user_id', $getrequest['uid'])
            ->update(['marital_status_id'=>$getrequest['marital_status']]);
	}
	
	UserLeads::where('order_id', $getpostdata['order_id'])
            ->update(['status'=>'Evisa-FinalForm']);

    OrderDetails::where('order_id', $getpostdata['order_id'])
            ->update(['applicant_booking_status'=>'Evisa-FinalForm']);

    /* setcookie ("partial_form", 'Evisa-FinalForm', time()+3600*24*(2), '/', "", 0 );
	setcookie ("uid", $getpostdata['uid'], time()+3600*24*(2), '/', "", 0 );
	setcookie ("order_id", $getpostdata['order_id'], time()+3600*24*(2), '/', "", 0 );   */      

	if(!empty($getpostdata['order_id']) && !empty($getpostdata['uid'])){
		$track_data = array(
					'partial_form'=>"Evisa-FinalForm",
            		'order_id'=>$getpostdata['order_id'],
            		'user_id'=>$getpostdata['uid'],
            	);
        Session::put('track_details', $track_data);	
	}
	
	$getservices = ApplicationserviceDetails::join('applicant_profiles','applicant_profiles.profile_id','=','tbl_user_service_details.applicant_id')
    ->join('order_details','order_details.order_id','=','applicant_profiles.order_id')
    ->join('pricing_master',function($join){
    	$join->on('pricing_master.service_id','=','tbl_user_service_details.service_id')
    		->on('pricing_master.nationality','=','order_details.nationality');	
    })
    ->join('india_evisa_purpose','india_evisa_purpose.purpose_id','=','tbl_user_service_details.purpose_id')
    ->where('tbl_user_service_details.applicant_id', $getpostdata['applicant_id'])->where('tbl_user_service_details.user_id',$getpostdata['uid'])
         ->get(); 

    $getvisadetails = UserLeads::join('order_details','order_details.order_id','=','user_leads.order_id')
    ->join('product_master','product_master.product_id','=','order_details.product_id')
    ->join('airport_details','airport_details.airport_id','=','user_leads.airport_code')
    ->where('order_details.order_id', $getpostdata['order_id'])
    ->where('order_details.user_id',$getpostdata['uid'])
    ->get()->first();

    $service_arr = array();
    $no_entries = 0;     
    foreach ($getservices as $key => $row) {
       	$service_arr[] = array(
       		'service_id'=>$row->service_id,
       		'purpose_id'=>$row->purpose_id,
       		'order_id'=>$row->order_id,
       		'applicant_id'=>$row->applicant_id,
       		'user_id'=>$row->user_id,
       		'product_name'=>$row->product_name,
       		'product_type'=>$row->product_type,
       		'purpose_name'=>$row->purpose_name,
       	);

       	if($row->service_id == 1 && $row->service_id == 2){
       		$no_entries = 2;
       	}elseif($row->service_id == 1 && $row->service_id == 2 && $row->service_id == 3){
       		$no_entries = 3;
       	}elseif($row->service_id == 3){
       		$no_entries = 3;
       	}else{
       		$no_entries = 2;
       	}
    }

    $getnationname = DB::table('countries')->where('country_id',$getpostdata['nationality'])->first();

    $visa_data = array(
    	'visa_duration'=>60,
    	'no_entries'=>$no_entries,
    	'airport_name'=>$getvisadetails['airport_name'],
       	'airport_id'=>$getvisadetails['airport_id'],
       	'visa_type'=>$getvisadetails['product_name'],
       	'visa_services'=>implode(", ", array_column($service_arr, 'product_name')),
       	'ref_name_in_nation'=> !empty($getnationname->country_name)?$getnationname->country_name:NULL
    );

    $getairport = AirportDetails::where('active', 'Y')
						->orderby('airport_name', 'ASC')
                     	->get();
    $getvisatypes = VisatypeDetails::where('active', 'Y')
    					->orderby('type_name', 'ASC')
    					->get();

   	$getsaarccountry = DB::table('countries')->where('is_saarc','Y')->orderby('country_name', 'ASC')->get();

   	$current_year = date('Y');
	$min_year = $current_year - 3;
	for($i = $min_year; $i <= $current_year; $i++){
	    $year_array[$i] = $i;
	}
    $getsaarcyear = array_reverse($year_array,true);
    
    return view('evisaapplication/evisaformdetails',compact('getpostdata', 'service_arr', 'visa_data','getairport', 'getvisatypes', 'getsaarccountry', 'getsaarcyear'));           
}

public function verifymail(Request $request){
	$getrequest = $request->all();
	$getsession = Session::get('track_details');
	//echo "<pre>";print_r($getrequest);exit;
	$service_arr = array();
	$sarrc_arr = array();

	$sendmail = new ApplicationController;

	if(isset($getrequest) && empty($getrequest)){
		$getorderdetails = 	DB::table('order_details')
						->join('users','users.user_id','=','order_details.user_id')
						->join('applicant_profiles','applicant_profiles.order_id','=','order_details.order_id')
						->join('tbl_visa_app_details','tbl_visa_app_details.order_id','=','order_details.order_id')
						->where('order_details.user_id',$getsession['user_id'])
						->where('order_details.order_id',$getsession['order_id'])
						->first();

		$getpostdata = array(
		'residing_in'=> !empty($getorderdetails->residing_in)?$getorderdetails->residing_in:NULL,
		'residing_code'=> !empty($getorderdetails->residing_code)?$getorderdetails->residing_code:NULL,
		'ccode'=> !empty($getorderdetails->typeform_token)?$getorderdetails->typeform_token:NULL,
		'nationality'=> !empty($getorderdetails->nationality)?$getorderdetails->nationality:NULL,
		'order_id'=> !empty($getorderdetails->order_id)?$getorderdetails->order_id:NULL,
		'applicant_id'=> !empty($getorderdetails->profile_id)?$getorderdetails->profile_id:NULL,
		'uid'=> !empty($getorderdetails->user_id)?$getorderdetails->user_id:NULL,
		'passport_type'=> !empty($getorderdetails->passport_type)?$getorderdetails->passport_type:NULL,
		'order_code'=> !empty($getorderdetails->order_code)?$getorderdetails->order_code:NULL,
		'visa_service'=>!empty($getorderdetails->visa_service)?$getorderdetails->visa_service:NULL,
		);
	} else { 
		$getpostdata = array(
		'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
		'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
		'nationality'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
		'order_id'=> !empty($getrequest['order_id'])?$getrequest['order_id']:NULL,
		'applicant_id'=> !empty($getrequest['applicant_id'])?$getrequest['applicant_id']:NULL,
		'uid'=> !empty($getrequest['uid'])?$getrequest['uid']:NULL,
		'passport_type'=> !empty($getrequest['passport_type'])?$getrequest['passport_type']:NULL,
		'visa_service'=>!empty($getrequest['visa_service'])?$getrequest['visa_service']:NULL,
		'ccode'=> !empty($getrequest['ccode'])?$getrequest['ccode']:NULL,
		);

	// 	if(isset($getrequest['ccode']) && !empty($getrequest['ccode'])){ 
	// 	$getpostdata = array(
	// 		'residing_in'=> !empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
	// 		'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
	// 		'nationality'=> !empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
	// 		'order_id'=> !empty($getrequest['order_id'])?$getrequest['order_id']:NULL,
	// 		'applicant_id'=> !empty($getrequest['applicant_id'])?$getrequest['applicant_id']:NULL,
	// 		'uid'=> !empty($getrequest['uid'])?$getrequest['uid']:NULL,
	// 		'passport_type'=> !empty($getrequest['passport_type'])?$getrequest['passport_type']:NULL,
	// 		'visa_service'=>!empty($getrequest['visa_service'])?$getrequest['visa_service']:NULL,
			
	// 	);
	// }
	if(isset($getrequest['service_req_meeting_frend']) && !empty($getrequest['service_req_meeting_frend']['frnd_name'])){
		// $json_encode .= json_encode(array('service_req_meeting_frend'=>$getrequest['service_req_meeting_frend']));
		$service_arr['service_req_meeting_frend'] = array(
				'frnd_name'=>$getrequest['service_req_meeting_frend']['frnd_name'],
				'frnd_address'=>$getrequest['service_req_meeting_frend']['frnd_address'],
				'frnd_state'=>$getrequest['service_req_meeting_frend']['frnd_state'],
				'frnd_district'=>$getrequest['service_req_meeting_frend']['frnd_district'],
				'frnd_phone'=>$getrequest['service_req_meeting_frend']['frnd_phone']
			);
	}

	if(isset($getrequest['service_req_con_tours']) && !empty($getrequest['service_req_con_tours']['travel_name_address'])){
		// $json_encode .= json_encode(array('service_req_con_tours'=>$getrequest['service_req_con_tours']));
		$service_arr['service_req_con_tours'] = array(
			'travel_name_address'=>$getrequest['service_req_con_tours']['travel_name_address'],
			'travel_city_name'=>$getrequest['service_req_con_tours']['travel_city_name'],
			'travel_name'=>$getrequest['service_req_con_tours']['travel_name'],
			'travel_address'=>$getrequest['service_req_con_tours']['travel_address'],
			'travel_phone_no'=>$getrequest['service_req_con_tours']['travel_phone_no']
		);
	}
	
	if(isset($getrequest['service_req_recreation'])){
		// $json_encode .= json_encode(array('service_req_recreation'));
		$service_arr['service_req_recreation'] = array(
			'service_req_recreation'=>NULL
		);
	}
	
	if(isset($getrequest['service_req_short_medical']) && !empty($getrequest['service_req_short_medical']['hospital_name'])){
		// $json_encode .= json_encode(array('service_req_short_medical'=>$getrequest['service_req_short_medical']));
		$service_arr['service_req_short_medical'] = array(
			'hospital_name'=>$getrequest['service_req_short_medical']['hospital_name'],
			'hospital_address'=>$getrequest['service_req_short_medical']['hospital_address'],
			'hospital_state'=>$getrequest['service_req_short_medical']['hospital_state'],
			'hospital_district'=>$getrequest['service_req_short_medical']['hospital_district'],
			'hospital_phone_no'=>$getrequest['service_req_short_medical']['hospital_phone_no'],
			'type_of_medical'=>$getrequest['service_req_short_medical']['type_of_medical']
		);
	}
	
	if(isset($getrequest['service_req_business_meeting']) && !empty($getrequest['service_req_business_meeting']['meet_co_name'])){
		// $json_encode .= json_encode(array('service_req_business_meeting'=>$getrequest['service_req_business_meeting']));
		$service_arr['service_req_business_meeting'] = array(
			'meet_co_name'=>$getrequest['service_req_business_meeting']['meet_co_name'],
			'meet_co_address'=>$getrequest['service_req_business_meeting']['meet_co_address'],
			'meet_co_phone_no'=>$getrequest['service_req_business_meeting']['meet_co_phone_no'],
			'meet_co_webiste'=>$getrequest['service_req_business_meeting']['meet_co_webiste'],
			'meet_firm_name'=>$getrequest['service_req_business_meeting']['meet_firm_name'],
			'meet_firm_address'=>$getrequest['service_req_business_meeting']['meet_firm_address'],
			'meet_firm_phone'=>$getrequest['service_req_business_meeting']['meet_firm_phone'],
			'meet_firm_wbsite'=>$getrequest['service_req_business_meeting']['meet_firm_wbsite']

		);
	}

	if(isset($getrequest['service_req_business_venture']) && !empty($getrequest['service_req_business_venture']['venture_name'])){
		// $json_encode .= json_encode(array('service_req_business_venture'=>$getrequest['service_req_business_venture']));
		$service_arr['service_req_business_venture'] = array(
			'venture_name'=>$getrequest['service_req_business_venture']['venture_name'],
			'venture_address'=>$getrequest['service_req_business_venture']['venture_address'],
			'venture_phone_no'=>$getrequest['service_req_business_venture']['venture_phone_no'],
			'venture_website'=>$getrequest['service_req_business_venture']['venture_website'],
			'venture_nature_business'=>$getrequest['service_req_business_venture']['venture_nature_business']

		);
	}

	if(isset($getrequest['service_req_exp_spe']) && !empty($getrequest['service_req_exp_spe']['expart_co_name'])){
		// $json_encode .= json_encode(array('service_req_exp_spe'=>$getrequest['service_req_exp_spe']));
		$service_arr['service_req_exp_spe'] = array(
			'expart_co_name'=>$getrequest['service_req_exp_spe']['expart_co_name'],
			'expert_co_address'=>$getrequest['service_req_exp_spe']['expert_co_address'],
			'expert_co_phone'=>$getrequest['service_req_exp_spe']['expert_co_phone'],
			'expert_co_website'=>$getrequest['service_req_exp_spe']['expert_co_website'],
			'firm_name'=>$getrequest['service_req_exp_spe']['firm_name'],
			'firm_address'=>$getrequest['service_req_exp_spe']['firm_address'],
			'firm_phone'=>$getrequest['service_req_exp_spe']['firm_phone'],
			'firm_website'=>$getrequest['service_req_exp_spe']['firm_website']

		);
	}

	if(isset($getrequest['service_req_part_exhi']) && !empty($getrequest['service_req_part_exhi']['exhi_name'])){
		// $json_encode .= json_encode(array('service_req_part_exhi'=>$getrequest['service_req_part_exhi']));
		$service_arr['service_req_part_exhi'] = array(
			'exhi_name'=>$getrequest['service_req_part_exhi']['exhi_name'],
			'exhi_address'=>$getrequest['service_req_part_exhi']['exhi_address'],
			'exhi_phone_no'=>$getrequest['service_req_part_exhi']['exhi_phone_no'],
			'exhi_website'=>$getrequest['service_req_part_exhi']['exhi_website'],
			'exhi_name_address'=>$getrequest['service_req_part_exhi']['exhi_name_address']

		);
	}

	if(isset($getrequest['service_req_form_purchase']) && !empty($getrequest['service_req_form_purchase']['purchase_name'])){
		// $json_encode .= json_encode(array('service_req_form_purchase'=>$getrequest['service_req_form_purchase']));
		$service_arr['service_req_form_purchase'] = array(
			'purchase_name'=>$getrequest['service_req_form_purchase']['purchase_name'],
			'purchase_address'=>$getrequest['service_req_form_purchase']['purchase_address'],
			'purchase_phone_no'=>$getrequest['service_req_form_purchase']['purchase_phone_no'],
			'purchase_website'=>$getrequest['service_req_form_purchase']['purchase_website'],
			'purchase_nature_business'=>$getrequest['service_req_form_purchase']['purchase_nature_business']

		);
	}

	if(isset($getrequest['service_req_recruit_manpower']) && !empty($getrequest['service_req_recruit_manpower']['recruit_name'])){
		// $json_encode .= json_encode(array('service_req_recruit_manpower'=>$getrequest['service_req_recruit_manpower']));
		$service_arr['service_req_recruit_manpower'] = array(
			'recruit_name'=>$getrequest['service_req_recruit_manpower']['recruit_name'],
			'recruit_address'=>$getrequest['service_req_recruit_manpower']['recruit_address'],
			'recruit_phone_no'=>$getrequest['service_req_recruit_manpower']['recruit_phone_no'],
			'recruit_website'=>$getrequest['service_req_recruit_manpower']['recruit_website'],
			'recruit_name_contact'=>$getrequest['service_req_recruit_manpower']['recruit_name_contact'],
			'recruit_nature_job'=>$getrequest['service_req_recruit_manpower']['recruit_nature_job'],
			'recruit_place'=>$getrequest['service_req_recruit_manpower']['recruit_place']

		);
	}

	if(isset($getrequest['service_req_short_yoga']) && !empty($getrequest['service_req_short_yoga']['yoga_institute_name'])){
		// $json_encode .= json_encode(array('service_req_short_yoga'=>$getrequest['service_req_short_yoga']));
		$service_arr['service_req_short_yoga'] = array(
			'yoga_institute_name'=>$getrequest['service_req_short_yoga']['yoga_institute_name'],
			'yoga_institute_address'=>$getrequest['service_req_short_yoga']['yoga_institute_address'],
			'yoga_institute_state'=>$getrequest['service_req_short_yoga']['yoga_institute_state'],
			'yoga_institute_district'=>$getrequest['service_req_short_yoga']['yoga_institute_district'],
			'yoga_institute_phone_no'=>$getrequest['service_req_short_yoga']['yoga_institute_phone_no']

		);
	}

	// if(isset($getrequest['service_req_academic_network'])){
	// 	$json_encode .= json_encode(array('service_req_academic_network'));
	// }

	// echo $json_encode;exit;
	if(isset($getrequest['saarc_flag']) && $getrequest['saarc_flag']=="Y"){
		// $saarc_json .= json_encode(array('saarcCountry'=>$getrequest['saarcCountry'],'saarcYear'=>$getrequest['saarcYear'],'saarcVisitNo'=>$getrequest['saarcVisitNo']));
		$sarrc_arr = array(
			'saarcCountry'=>!empty($getrequest['saarcCountry'])?$getrequest['saarcCountry']:NULL,
			'saarcYear'=>!empty($getrequest['saarcYear'])?$getrequest['saarcYear']:NULL,
			'saarcVisitNo'=>!empty($getrequest['saarcVisitNo'])?$getrequest['saarcVisitNo']:NULL
		);
	}
	// echo $saarc_json;exit;
	$saveFinalData = [
		// 'residing_in'=>!empty($getrequest['residing_in'])?$getrequest['residing_in']:NULL,
		// 'residing_code'=>!empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
		'nationality'=>!empty($getrequest['nationality'])?$getrequest['nationality']:NULL,
		'order_id'=>!empty($getrequest['order_id'])?$getrequest['order_id']:NULL,
		'applicant_id'=>!empty($getrequest['applicant_id'])?$getrequest['applicant_id']:NULL,
		'uid'=>!empty($getrequest)?$getrequest['uid']:NULL,
		'passport_type'=>!empty($getrequest['passport_type'])?$getrequest['passport_type']:NULL,
		'type_of_visa'=>!empty($getrequest['type_of_visa'])?$getrequest['type_of_visa']:NULL,
		'visa_service'=>!empty($getrequest['visa_service'])?$getrequest['visa_service']:NULL,
		'service_req_form_values'=>!empty($getrequest['service_req_form_values'])?$getrequest['service_req_form_values']:NULL,
                'service_req_form_values2'=>!empty($getrequest['service_req_form_values2'])?$getrequest['service_req_form_values2']:NULL,
		'visa_duration'=>!empty($getrequest['visa_duration'])?$getrequest['visa_duration']:NULL,
		'no_entries'=>!empty($getrequest['no_entries'])?$getrequest['no_entries']:NULL,
		'airport_name'=>!empty($getrequest['airport_name'])?$getrequest['airport_name']:NULL,
		'pres_country'=>!empty($getrequest['pres_country'])?$getrequest['pres_country']:NULL,
		'service_purpose_json'=>json_encode($service_arr),
		'airport_id'=> !empty($getrequest['airport_id'])?$getrequest['airport_id']:NULL,
		'old_visa_flag'=> !empty($getrequest['old_visa_flag'])?$getrequest['old_visa_flag']:NULL,
		'prv_visit_add1'=> !empty($getrequest['prv_visit_add1'])?$getrequest['prv_visit_add1']:NULL,
		'visited_city'=> !empty($getrequest['visited_city'])?$getrequest['visited_city']:NULL,
		'old_visa_no'=> !empty($getrequest['old_visa_no'])?$getrequest['old_visa_no']:NULL,
		'old_visa_type_id'=> !empty($getrequest['old_visa_type_id'])?$getrequest['old_visa_type_id']:NULL,
		'oldvisaissueplace'=> !empty($getrequest['oldvisaissueplace'])?$getrequest['oldvisaissueplace']:NULL,
		'oldvisaissuedate'=> !empty($getrequest['oldvisaissuedate'])?$getrequest['oldvisaissuedate']:NULL,
		'refuse_flag'=> !empty($getrequest['refuse_flag'])?$getrequest['refuse_flag']:NULL,
		'refuse_details'=> !empty($getrequest['refuse_details'])?$getrequest['refuse_details']:NULL,
		'country_visited'=> !empty($getrequest['country_visited'])?$getrequest['country_visited']:NULL,
		'saarc_flag'=> !empty($getrequest['saarc_flag'])?$getrequest['saarc_flag']:NULL,
		'saarc_details'=> !empty($sarrc_arr)?json_encode($sarrc_arr):NULL,
		'nameofsponsor_ind'=> !empty($getrequest['nameofsponsor_ind'])?$getrequest['nameofsponsor_ind']:NULL,
		'add1ofsponsor_ind'=> !empty($getrequest['add1ofsponsor_ind'])?$getrequest['add1ofsponsor_ind']:NULL,
		'phoneofsponsor_ind'=> !empty($getrequest['phoneofsponsor_ind'])?$getrequest['phoneofsponsor_ind']:NULL,
		'nameofsponsor_msn'=> !empty($getrequest['nameofsponsor_msn'])?$getrequest['nameofsponsor_msn']:NULL,
		'add1ofsponsor_msn'=> !empty($getrequest['add1ofsponsor_msn'])?$getrequest['add1ofsponsor_msn']:NULL,
		'phoneofsponsor_msn'=> !empty($getrequest['phoneofsponsor_msn'])?$getrequest['phoneofsponsor_msn']:NULL,
		'status'=>"Completed Form",
	];

	// echo "<pre>";print_r($saveFinalData);exit;

	// $checkvisadetails = EvisaAppDetails::Where('order_id',$saveFinalData['order_id'])->first();

	$checkvisadetails = EvisaAppDetails::firstOrCreate(['order_id' => $saveFinalData['order_id']]);
	$checkvisadetails->order_id = $saveFinalData['order_id'];
	$checkvisadetails->applicant_id = $saveFinalData['applicant_id'];
	$checkvisadetails->uid = $saveFinalData['uid'];
	$checkvisadetails->nationality = $saveFinalData['nationality'];
	$checkvisadetails->passport_type = $saveFinalData['passport_type'];
	$checkvisadetails->type_of_visa = $saveFinalData['type_of_visa'];
	$checkvisadetails->visa_service = $saveFinalData['visa_service'];
	$checkvisadetails->service_req_form_values = $saveFinalData['service_req_form_values'];
        $checkvisadetails->service_req_form_values2 = $saveFinalData['service_req_form_values2'];
	$checkvisadetails->visa_duration = $saveFinalData['visa_duration'];
	$checkvisadetails->no_entries = $saveFinalData['no_entries'];
	$checkvisadetails->airport_name = $saveFinalData['airport_name'];
	$checkvisadetails->pres_country = $saveFinalData['pres_country'];
	$checkvisadetails->service_purpose_json = $saveFinalData['service_purpose_json'];
	$checkvisadetails->airport_id = $saveFinalData['airport_id'];
	$checkvisadetails->old_visa_flag = $saveFinalData['old_visa_flag'];
	$checkvisadetails->prv_visit_add1 = $saveFinalData['prv_visit_add1'];
	$checkvisadetails->visited_city = !empty($getrequest['visited_city'])?$getrequest['visited_city']:NULL;
	$checkvisadetails->old_visa_no = !empty($getrequest['old_visa_no'])?$getrequest['old_visa_no']:NULL;
	$checkvisadetails->old_visa_type_id = !empty($getrequest['old_visa_type_id'])?$getrequest['old_visa_type_id']:NULL;
	$checkvisadetails->oldvisaissueplace = !empty($getrequest['oldvisaissueplace'])?$getrequest['oldvisaissueplace']:NULL;
	$checkvisadetails->oldvisaissuedate = !empty($getrequest['oldvisaissuedate'])?$getrequest['oldvisaissuedate']:NULL;
	$checkvisadetails->refuse_flag = !empty($getrequest['refuse_flag'])?$getrequest['refuse_flag']:NULL;
	$checkvisadetails->refuse_details = !empty($getrequest['refuse_details'])?$getrequest['refuse_details']:NULL;
	$checkvisadetails->country_visited = !empty($getrequest['country_visited'])?$getrequest['country_visited']:NULL;
	$checkvisadetails->saarc_flag = !empty($getrequest['saarc_flag'])?$getrequest['saarc_flag']:NULL;
	$checkvisadetails->saarc_details = !empty($sarrc_arr)?json_encode($sarrc_arr):NULL;
	$checkvisadetails->nameofsponsor_ind = !empty($getrequest['nameofsponsor_ind'])?$getrequest['nameofsponsor_ind']:NULL;
	$checkvisadetails->add1ofsponsor_ind = !empty($getrequest['add1ofsponsor_ind'])?$getrequest['add1ofsponsor_ind']:NULL;
	$checkvisadetails->phoneofsponsor_ind = !empty($getrequest['phoneofsponsor_ind'])?$getrequest['phoneofsponsor_ind']:NULL;
	$checkvisadetails->nameofsponsor_msn = !empty($getrequest['nameofsponsor_msn'])?$getrequest['nameofsponsor_msn']:NULL;
	$checkvisadetails->add1ofsponsor_msn = !empty($getrequest['add1ofsponsor_msn'])?$getrequest['add1ofsponsor_msn']:NULL;
	$checkvisadetails->phoneofsponsor_msn = !empty($getrequest['phoneofsponsor_msn'])?$getrequest['phoneofsponsor_msn']:NULL;
	$checkvisadetails->created_at = date('Y-m-d H:i:s');
	$checkvisadetails->status = "Complete Form";

	$checkvisadetails->save();
	}


	$getapplicatdata = ApplicantProfiles::query()->join('users','users.user_id','=','applicant_profiles.user_id')->where('applicant_profiles.user_id',$getpostdata['uid'])->where('applicant_profiles.profile_id',$getpostdata['applicant_id'])->get([
													'applicant_profiles.*',
													'email_id'
												])->first();
	$getorderdetails = OrderDetails::where('order_id', '=', $getpostdata['order_id'])
                     ->get()->first();
	
	$respnse="";
	$name = $getapplicatdata['username'];
	$res = $sendmail->sendotp($getapplicatdata['email_id'], $name);
	$d = json_decode($res);
	$uid = $d->uid;
	$response = $d->msg;

	UserLeads::where('order_id', $getpostdata['order_id'])
            ->update(['status'=>'Evisa-verifyemail']);

    OrderDetails::where('order_id', $getpostdata['order_id'])
            ->update(['applicant_booking_status'=>'Evisa-verifyemail']);

    if(isset($getpostdata['ccode']) && !empty($getpostdata['ccode'])){
    	OrderDetails::where('order_id', $getpostdata['order_id'])
            ->update(['typeform_token' => $getpostdata['ccode']]);
    }      

    /* setcookie ("partial_form", 'verifyemail', time()+3600*24*(2), '/', "", 0 );
    setcookie ("uid", $getpostdata['uid'], time()+3600*24*(2), '/', "", 0 );
	setcookie ("order_id", $getpostdata['order_id'], time()+3600*24*(2), '/', "", 0 ); */  
	if(!empty($getpostdata['order_id']) && !empty($getpostdata['uid'])){
		$track_data = array(
					'partial_form'=>"verifyemail",
            		'order_id'=>$getpostdata['order_id'],
            		'user_id'=>$getpostdata['uid'],
            	);
        Session::put('track_details', $track_data);	
	}
	// echo "<pre>";print_r($getorderdetails);exit;					
	return view('evisaapplication/verifyemail',compact('getpostdata', 'getapplicatdata', 'getorderdetails'));
}

public function reviewindia(Request $request){
	$getrequest = $request->all();
	$order_id = $request->route('ordid');
	$service_arr = array();
	$airport_arr = $passporttype_arr = $country_arr = array();

	$getairport = AirportDetails::where('active', 'Y')
						->orderby('airport_name', 'ASC')
                     	->get();

    $getcountry = DB::table('countries')->orderby('country_name','ASC')->get();
    $getreligion = DB::table('religions')->orderby('religion_name')->get();
    $getqualification = DB::table('tbl_qualification')->orderby('qualification', 'ASC')->get();
    $getmarital = DB::table('marital_status')->where('enabled','Y')->get();
	$getcity = DB::table('cities')->where('isactive','Y')->orderby('city_name','ASC')->get();
	$getstate = DB::table('states')->where('isactive','Y')->orderby('state_name','ASC')->get();
	$getpropfession = DB::table('tbl_occupation')->orderby('occupation_name','ASC')->get();
	$getvisatypes = VisatypeDetails::where('active', 'Y')
    					->orderby('type_name', 'ASC')
    					->get();	

    $current_year = date('Y');
	$min_year = $current_year - 3;
	for($i = $min_year; $i <= $current_year; $i++){
	    $year_array[$i] = $i;
	}
    $getsaarcyear = array_reverse($year_array,true);	

    foreach($getcountry as $key=>$val){
		$country_arr[] = $val->country_name;
	}
                   	
    foreach($getairport as $key=>$val){
        	$airport_arr[] = array(
        			'airport_id'=>$val['airport_id'],
        			'airport_name'=>$val['airport_name']
        	);
        }
	$qry = ApplicantProfiles::query()->leftjoin('order_details as od', 'od.order_id', '=', 'applicant_profiles.order_id')
	->join('product_master as pm', 'pm.product_id', '= ', 'od.product_id')
	->join('passport_types as pt', 'pt.passport_type_id', '=', 'od.passport_type')
	->leftjoin('marital_status as ms', 'ms.marital_status_id','=', 'applicant_profiles.marital_status_id')
	->leftjoin('passport_details as pd', 'pd.applicant_id', '=', 'applicant_profiles.profile_id')
	->leftjoin('application_relationdetails as ar', 'ar.applicant_id', '=', 'applicant_profiles.profile_id')
	->leftjoin('countries as c', 'c.country_id', '=',  'applicant_profiles.nationality')
	->leftjoin('countries as addr_c', 'addr_c.country_id', '=', 'ar.pres_country')
	->leftjoin('countries as c1', 'c1.country_id', '=', 'ar.father_nationality')
    ->leftjoin('countries as c2', 'c2.country_id', '=', 'ar.father_previous_nationality')
    ->leftjoin('countries as c3', 'c3.country_id', '=', 'ar.father_country_of_birth')
    ->leftjoin('countries as c4', 'c4.country_id', '=', 'ar.mother_nationality')
    ->leftjoin('countries as c5', 'c5.country_id', '=', 'ar.mother_previous_nationality')
    ->leftjoin('countries as c6', 'c6.country_id', '=', 'ar.mother_country_of_birth')
    ->leftjoin('countries as c7', 'c7.country_id', '=', 'ar.spouse_nationality')
    ->leftjoin('countries as c8', 'c8.country_id', '=', 'ar.spouse_previous_nationality')
    ->leftjoin('countries as c9', 'c9.country_id', '=', 'ar.spouse_country_of_birth')
    ->join('tbl_visa_app_details as vad', 'vad.applicant_id', '=', 'applicant_profiles.profile_id')
    ->join('airport_details as aird1', 'aird1.airport_id', '=', 'vad.airport_id')
    ->join('airport_details as aird2', 'aird2.airport_id', '=', 'vad.pres_country')
    ->join('users as users', 'users.user_id', '=', 'applicant_profiles.user_id')
	//->where('vad.order_integration_flag', 'N')
    //->where('od.is_review_updated', 'N')
    ->where('od.order_id', $order_id)
    ->select('applicant_profiles.profile_id', 'od.order_code', 'od.product_id', 'pm.product_name', 'od.applicant_booking_status','od.travel_to', 'od.arrival_date', 
                'od.citizen_to', 'od.residing_in', 'pt.passport_type_id', 'pd.pp_no', 'pd.pp_issue_date', 'pd.pp_expiry_date', 'pd.pp_issuing_govt',
               'pd.pp_place_of_issue', 'pd.pp_isactive','pd.oth_ppt', 'pd.prev_passport_country_issue', 'pd.other_ppt_no', 
                'pd.other_ppt_issue_place', 'pd.other_ppt_issue_date', 'pd.other_ppt_nationality', 'applicant_profiles.username', 'applicant_profiles.surname',
                'applicant_profiles.previous_name',  'applicant_profiles.user_id', 'applicant_profiles.previous_surname', 'od.order_id', 'applicant_profiles.dob', 'applicant_profiles.gender', 'ms.marital_status_code', 'ms.marital_status_id', 'applicant_profiles.nationality', 'applicant_profiles.place_of_birth', 'applicant_profiles.nationality_id', 'applicant_profiles.country_of_birth', 'applicant_profiles.religion', 'applicant_profiles.mobile_number', 'users.email_id',
                'applicant_profiles.refer_flag', 'applicant_profiles.prev_nationality', 'applicant_profiles.qualification', 'applicant_profiles.aquired_nation', 'applicant_profiles.visible_marks', 'applicant_profiles.citizenship_no',
                'ar.pres_add1', 'ar.pres_add2', 'addr_c.country_id as addr_country', 'ar.state_name', 'ar.pincode', 'ar.pres_phone', 
                'ar.perm_address1', 'ar.perm_address2', 'ar.perm_address3', 
                'ar.father_name', 'c1.country_id as father_nationality', 'c2.country_id as father_previous_nationality', 
                'father_place_of_birth', 'c3.country_id as father_country_of_birth', 
                'ar.mother_name', 'c4.country_id as mother_nationality', 'c5.country_id as mother_previous_nationality', 
                'mother_place_of_birth', 'c6.country_id as mother_country_of_birth', 
                'ar.spouse_name', 'c7.country_id as spouse_nationality', 'c8.country_id as spouse_previous_nationality', 
                'ar.spouse_place_of_birth', 'c9.country_id as spouse_country_of_birth', 
                'ar.grandparent_flag1', 'ar.grandparent_details', 
                'ar.pre_occupation', 'ar.occ_flag', 'ar.empname', 'empdesignation', 'ar.empaddress', 'ar.empphone', 'ar.previous_occupation', 
                'prev_org', 'previous_organization', 'previous_designation', 'previous_rank', 'previous_posting',
                'vad.type_of_visa', 'vad.visa_service', 
                'vad.service_req_form_values', 'vad.service_req_form_values2', 'vad.visa_duration', 'vad.no_entries', 'vad.airport_name',
                'vad.service_purpose_json', 'vad.airport_id', 'vad.pres_country', 'aird1.code as entry_port_code', 'aird1.airport_name as entry_port_name', 'aird2.code as exit_port_code', 'aird2.airport_name as exit_port_name', 'vad.old_visa_flag', 'vad.prv_visit_add1', 'vad.visited_city', 
                'vad.old_visa_no', 'vad.old_visa_type_id', 'vad.oldvisaissueplace', 'oldvisaissuedate', 
                'refuse_flag', 'refuse_details', 'country_visited', 'saarc_flag', 'vad.saarc_details', 
                'vad.nameofsponsor_ind', 'vad.add1ofsponsor_ind', 'vad.phoneofsponsor_ind', 
                'vad.nameofsponsor_msn', 'vad.add1ofsponsor_msn', 'vad.phoneofsponsor_msn', 'vad.status')
	->first();
	//echo "<pre>"; print_r($qry); exit;
	$getapplicantdata = DocumentDetails::query()
						->where('document_details.applicant_id',$qry['profile_id'])
						->whereIn('doc_type', array('PASSPORT_FRONT', 'PHOTO'))
						->get(['document_details.doc_id',
								'document_details.doc_type',
								'document_details.doc_url'
												]);
	$getdocdata = DocumentDetails::query()
						->where('document_details.applicant_id',$qry['profile_id'])
						->whereIn('doc_type', array('BUSINESS_CARD', 'HOSPITAL_LETTER'))
						->get(['document_details.doc_id',
								'document_details.doc_type',
								'document_details.doc_url'
												]);
	//echo "<pre>"; print_r($getapplicantdata); exit;

	$getpuroses = ApplicationserviceDetails::query()
	->join('india_evisa_purpose','india_evisa_purpose.purpose_id','=','tbl_user_service_details.purpose_id')
	->where('tbl_user_service_details.order_id', $qry['order_id'])->where('tbl_user_service_details.applicant_id', $qry['profile_id'])->get();

	if(isset($qry['saarc_details']) && !empty($qry['saarc_details'])){

		$visited_saarc = $qry['saarc_details'];
	    $saarc_array = json_decode($visited_saarc, true);

	    $a = array();
	    if(isset($saarc_array['saarcCountry'])){

		    foreach ($saarc_array['saarcCountry'] as $key => $val) {
		        $a[] = array_column($saarc_array, $key);
		    }
		    $saarc_details = array();
	    	foreach ($a as $kk => $aa) {
	        	$saarc_details[] = $aa;
				}
	    }
	}

	$getsaarccountry = DB::table('countries')->where('is_saarc','Y')->orderby('country_name', 'ASC')->get();
	
    $service_purpose = json_decode($qry['service_purpose_json']);

	//echo "<pre>"; print_r($service_purpose); exit;

	if ($request->isMethod('post')){
		//echo "<pre>"; print_r($getrequest); exit;

		$updateOrder = OrderDetails::where('order_id', $qry['order_id'])
		//->where('is_review_updated', 'N')
		->update(['is_review_updated' => 'Y', 'arrival_date' => $getrequest['arrival_date']]);

		$updateApplicant = ApplicantProfiles::where('profile_id', $qry['profile_id'])
            ->update(['username'=>$getrequest['given_name'], 
            		'surname'=> $getrequest['surname'], 
            		'previous_surname'=>$getrequest['previous_surname'], 
            		'previous_name'=>$getrequest['previous_name'],
            		'dob'=>$getrequest['dob'],
            		'gender'=>$getrequest['gender'],
            		'marital_status_id'=>$getrequest['mstatus'],
            		'country_of_birth'=>$getrequest['cob'],
            		'place_of_birth'=>$getrequest['city_birth'],
            		'nationality'=>$qry['citizen_to'],
            		'nationality_id'=>$getrequest['nationality'],
            		'religion'=>$getrequest['religion'],
            		'aquired_nation'=>$getrequest['aquired_nation'],
            		'prev_nationality'=>$getrequest['prev_nationality'],
            		'refer_flag'=>$getrequest['refer_flag'],
            		'qualification'=>$getrequest['qualification'],
            		'visible_marks'=>$getrequest['visible_marks'],
            		'citizenship_no'=>$getrequest['nation_id']
            	]);

        $updateFamilydetails = ApplicationrelationDetails::where('applicant_id', $qry['profile_id'])
        	->update(['pres_add1'=>$getrequest['pres_add1'],
        	'pres_add2'=>$getrequest['pres_add2'],
        	'pres_country'=>$getrequest['addr_country'],
        	'state_name'=>$getrequest['state_name'],
        	'pincode'=>$getrequest['pincode'],		
        	'pres_phone'=>$getrequest['pres_phone'],
        	'perm_address1'=>$getrequest['perm_addr1'],
        	'perm_address2'=>$getrequest['perm_addr2'],
        	'perm_address3'=>$getrequest['perm_addr3'],
        	'father_name'=>$getrequest['fthrname'],
        	'father_nationality'=>$getrequest['father_nationality'],
        	'father_previous_nationality'=>$getrequest['father_previous_nationality'],
        	'father_place_of_birth'=>$getrequest['father_place_of_birth'],
        	'father_country_of_birth'=>$getrequest['father_country_of_birth'],
        	'mother_name'=>$getrequest['mother_name'],
        	'mother_nationality'=>$getrequest['mother_nationality'],
        	'mother_previous_nationality'=>$getrequest['mother_previous_nationality'],
        	'mother_place_of_birth'=>$getrequest['mother_place_of_birth'],
        	'mother_country_of_birth'=>$getrequest['mother_country_of_birth'],
        	'spouse_name'=>isset($getrequest['spouse_name'])?$getrequest['spouse_name']:NULL,
        	'spouse_nationality'=>isset($getrequest['spouse_nationality'])?$getrequest['spouse_nationality']:NULL,
        	'spouse_place_of_birth'=>isset($getrequest['spouse_place_of_birth'])?$getrequest['spouse_place_of_birth']:NULL,
        	'spouse_previous_nationality'=>isset($getrequest['spouse_previous_nationality'])?$getrequest['spouse_previous_nationality']:NULL,
        	'spouse_country_of_birth'=>isset($getrequest['spouse_country_of_birth'])?$getrequest['spouse_country_of_birth']:NULL,
        	'grandparent_flag1'=>$getrequest['grandparent_flag1'],
        	'grandparent_details'=>isset($getrequest['grandparent_details'])?$getrequest['grandparent_details']:NULL,
        	'pre_occupation'=>$getrequest['pre_occupation'],
        	'if_occ_other'=>isset($getrequest['if_prof_other'])?$getrequest['if_prof_other']:NULL,
        	'occ_flag'=>isset($getrequest['occ_flag'])?$getrequest['occ_flag']:NULL,
        	'empname'=>$getrequest['empname'],
        	'empdesignation'=>$getrequest['empdesignation'],
        	'empaddress'=>$getrequest['empaddress'],
        	'empphone'=>$getrequest['empphone'],
        	'prev_org'=>$getrequest['prev_org'],
        	'previous_occupation'=> isset($getrequest['prev_occ'])?$getrequest['prev_occ']:NULL,
        	'previous_organization'=>isset($getrequest['previous_organization'])?$getrequest['previous_organization']:NULL,
        	'previous_designation'=>isset($getrequest['previous_designation'])?$getrequest['previous_designation']:NULL,
        	'previous_rank'=>isset($getrequest['previous_rank'])?$getrequest['previous_rank']:NULL,
        	'previous_posting'=>isset($getrequest['previous_posting'])?$getrequest['previous_posting']:NULL,
        ]);

        $updatePassport_details = DB::table('passport_details')->where('applicant_id', $qry['profile_id'])->update([
        	'pp_no'=>$getrequest['Passport_number'],
        	'pp_issue_date'=>$getrequest['doi'],
        	'pp_expiry_date'=>$getrequest['doe'],
        	'pp_place_of_issue'=>$getrequest['issue_place'],
        	'oth_ppt'=>$getrequest['oth_ppt'],
        	'prev_passport_country_issue'=>isset($getrequest['prev_passport_country_issue'])?$getrequest['prev_passport_country_issue']:NULL,
        	'other_ppt_no'=>isset($getrequest['other_ppt_no'])?$getrequest['other_ppt_no']:NULL,
        	'other_ppt_issue_place'=>isset($getrequest['other_ppt_issue_place'])?$getrequest['other_ppt_issue_place']:NULL,
        	'other_ppt_issue_date'=>isset($getrequest['other_ppt_issue_date'])?$getrequest['other_ppt_issue_date']:NULL,
        	'other_ppt_nationality'=>isset($getrequest['other_ppt_nationality'])?$getrequest['other_ppt_nationality']:NULL
        ]);
        $saarc_arr = array();
        if(isset($getrequest['saarc_flag']) && $getrequest['saarc_flag']=="Y"){
		// $saarc_json .= json_encode(array('saarcCountry'=>$getrequest['saarcCountry'],'saarcYear'=>$getrequest['saarcYear'],'saarcVisitNo'=>$getrequest['saarcVisitNo']));
			$saarc_arr = array(
			'saarcCountry'=>!empty($getrequest['saarcCountry'])?$getrequest['saarcCountry']:NULL,
			'saarcYear'=>!empty($getrequest['saarcYear'])?$getrequest['saarcYear']:NULL,
			'saarcVisitNo'=>!empty($getrequest['saarcVisitNo'])?$getrequest['saarcVisitNo']:NULL
		);
	}

	//	print_r($saarc_arr);echo "<pre>"; exit;

	if(isset($getrequest['service_req_meeting_frend']) && !empty($getrequest['service_req_meeting_frend']['frnd_name'])){
		// $json_encode .= json_encode(array('service_req_meeting_frend'=>$getrequest['service_req_meeting_frend']));
		$service_arr['service_req_meeting_frend'] = array(
				'frnd_name'=>$getrequest['service_req_meeting_frend']['frnd_name'],
				'frnd_address'=>$getrequest['service_req_meeting_frend']['frnd_address'],
				'frnd_state'=>$getrequest['service_req_meeting_frend']['frnd_state'],
				'frnd_district'=>$getrequest['service_req_meeting_frend']['frnd_district'],
				'frnd_phone'=>$getrequest['service_req_meeting_frend']['frnd_phone']
			);
	}

	if(isset($getrequest['service_req_con_tours']) && !empty($getrequest['service_req_con_tours']['travel_name_address'])){
		// $json_encode .= json_encode(array('service_req_con_tours'=>$getrequest['service_req_con_tours']));
		$service_arr['service_req_con_tours'] = array(
			'travel_name_address'=>$getrequest['service_req_con_tours']['travel_name_address'],
			'travel_city_name'=>$getrequest['service_req_con_tours']['travel_city_name'],
			'travel_name'=>$getrequest['service_req_con_tours']['travel_name'],
			'travel_address'=>$getrequest['service_req_con_tours']['travel_address'],
			'travel_phone_no'=>$getrequest['service_req_con_tours']['travel_phone_no']
		);
	}
	
	if(isset($getrequest['service_req_recreation'])){
		// $json_encode .= json_encode(array('service_req_recreation'));
		$service_arr['service_req_recreation'] = array(
			'service_req_recreation'=>NULL
		);
	}
	
	if(isset($getrequest['service_req_short_medical']) && !empty($getrequest['service_req_short_medical']['hospital_name'])){
		// $json_encode .= json_encode(array('service_req_short_medical'=>$getrequest['service_req_short_medical']));
		$service_arr['service_req_short_medical'] = array(
			'hospital_name'=>$getrequest['service_req_short_medical']['hospital_name'],
			'hospital_address'=>$getrequest['service_req_short_medical']['hospital_address'],
			'hospital_state'=>$getrequest['service_req_short_medical']['hospital_state'],
			'hospital_district'=>$getrequest['service_req_short_medical']['hospital_district'],
			'hospital_phone_no'=>$getrequest['service_req_short_medical']['hospital_phone_no'],
			'type_of_medical'=>$getrequest['service_req_short_medical']['type_of_medical']
		);
	}
	
	if(isset($getrequest['service_req_business_meeting']) && !empty($getrequest['service_req_business_meeting']['meet_co_name'])){
		// $json_encode .= json_encode(array('service_req_business_meeting'=>$getrequest['service_req_business_meeting']));
		$service_arr['service_req_business_meeting'] = array(
			'meet_co_name'=>$getrequest['service_req_business_meeting']['meet_co_name'],
			'meet_co_address'=>$getrequest['service_req_business_meeting']['meet_co_address'],
			'meet_co_phone_no'=>$getrequest['service_req_business_meeting']['meet_co_phone_no'],
			'meet_co_webiste'=>$getrequest['service_req_business_meeting']['meet_co_webiste'],
			'meet_firm_name'=>$getrequest['service_req_business_meeting']['meet_firm_name'],
			'meet_firm_address'=>$getrequest['service_req_business_meeting']['meet_firm_address'],
			'meet_firm_phone'=>$getrequest['service_req_business_meeting']['meet_firm_phone'],
			'meet_firm_wbsite'=>$getrequest['service_req_business_meeting']['meet_firm_wbsite']

		);
	}

	if(isset($getrequest['service_req_business_venture']) && !empty($getrequest['service_req_business_venture']['venture_name'])){
		// $json_encode .= json_encode(array('service_req_business_venture'=>$getrequest['service_req_business_venture']));
		$service_arr['service_req_business_venture'] = array(
			'venture_name'=>$getrequest['service_req_business_venture']['venture_name'],
			'venture_address'=>$getrequest['service_req_business_venture']['venture_address'],
			'venture_phone_no'=>$getrequest['service_req_business_venture']['venture_phone_no'],
			'venture_website'=>$getrequest['service_req_business_venture']['venture_website'],
			'venture_nature_business'=>$getrequest['service_req_business_venture']['venture_nature_business']

		);
	}

	if(isset($getrequest['service_req_exp_spe']) && !empty($getrequest['service_req_exp_spe']['expart_co_name'])){
		// $json_encode .= json_encode(array('service_req_exp_spe'=>$getrequest['service_req_exp_spe']));
		$service_arr['service_req_exp_spe'] = array(
			'expart_co_name'=>$getrequest['service_req_exp_spe']['expart_co_name'],
			'expert_co_address'=>$getrequest['service_req_exp_spe']['expert_co_address'],
			'expert_co_phone'=>$getrequest['service_req_exp_spe']['expert_co_phone'],
			'expert_co_website'=>$getrequest['service_req_exp_spe']['expert_co_website'],
			'firm_name'=>$getrequest['service_req_exp_spe']['firm_name'],
			'firm_address'=>$getrequest['service_req_exp_spe']['firm_address'],
			'firm_phone'=>$getrequest['service_req_exp_spe']['firm_phone'],
			'firm_website'=>$getrequest['service_req_exp_spe']['firm_website']

		);
	}

	if(isset($getrequest['service_req_part_exhi']) && !empty($getrequest['service_req_part_exhi']['exhi_name'])){
		// $json_encode .= json_encode(array('service_req_part_exhi'=>$getrequest['service_req_part_exhi']));
		$service_arr['service_req_part_exhi'] = array(
			'exhi_name'=>$getrequest['service_req_part_exhi']['exhi_name'],
			'exhi_address'=>$getrequest['service_req_part_exhi']['exhi_address'],
			'exhi_phone_no'=>$getrequest['service_req_part_exhi']['exhi_phone_no'],
			'exhi_website'=>$getrequest['service_req_part_exhi']['exhi_website'],
			'exhi_name_address'=>$getrequest['service_req_part_exhi']['exhi_name_address']

		);
	}

	if(isset($getrequest['service_req_form_purchase']) && !empty($getrequest['service_req_form_purchase']['purchase_name'])){
		// $json_encode .= json_encode(array('service_req_form_purchase'=>$getrequest['service_req_form_purchase']));
		$service_arr['service_req_form_purchase'] = array(
			'purchase_name'=>$getrequest['service_req_form_purchase']['purchase_name'],
			'purchase_address'=>$getrequest['service_req_form_purchase']['purchase_address'],
			'purchase_phone_no'=>$getrequest['service_req_form_purchase']['purchase_phone_no'],
			'purchase_website'=>$getrequest['service_req_form_purchase']['purchase_website'],
			'purchase_nature_business'=>$getrequest['service_req_form_purchase']['purchase_nature_business']

		);
	}

	if(isset($getrequest['service_req_recruit_manpower']) && !empty($getrequest['service_req_recruit_manpower']['recruit_name'])){
		// $json_encode .= json_encode(array('service_req_recruit_manpower'=>$getrequest['service_req_recruit_manpower']));
		$service_arr['service_req_recruit_manpower'] = array(
			'recruit_name'=>$getrequest['service_req_recruit_manpower']['recruit_name'],
			'recruit_address'=>$getrequest['service_req_recruit_manpower']['recruit_address'],
			'recruit_phone_no'=>$getrequest['service_req_recruit_manpower']['recruit_phone_no'],
			'recruit_website'=>$getrequest['service_req_recruit_manpower']['recruit_website'],
			'recruit_name_contact'=>$getrequest['service_req_recruit_manpower']['recruit_name_contact'],
			'recruit_nature_job'=>$getrequest['service_req_recruit_manpower']['recruit_nature_job'],
			'recruit_place'=>$getrequest['service_req_recruit_manpower']['recruit_place']

		);
	}

	if(isset($getrequest['service_req_short_yoga']) && !empty($getrequest['service_req_short_yoga']['yoga_institute_name'])){
		// $json_encode .= json_encode(array('service_req_short_yoga'=>$getrequest['service_req_short_yoga']));
		$service_arr['service_req_short_yoga'] = array(
			'yoga_institute_name'=>$getrequest['service_req_short_yoga']['yoga_institute_name'],
			'yoga_institute_address'=>$getrequest['service_req_short_yoga']['yoga_institute_address'],
			'yoga_institute_state'=>$getrequest['service_req_short_yoga']['yoga_institute_state'],
			'yoga_institute_district'=>$getrequest['service_req_short_yoga']['yoga_institute_district'],
			'yoga_institute_phone_no'=>$getrequest['service_req_short_yoga']['yoga_institute_phone_no']

		);
	}


        $updateVisadetails = EvisaAppDetails::where('applicant_id', $qry['profile_id'])->update([
        	'service_req_form_values'=>$getrequest['service_req_form_values'],
        	'service_req_form_values2'=>$getrequest['service_req_form_values2'],
        	'old_visa_flag'=>$getrequest['old_visa_flag'],
        	'airport_id'=>$getrequest['airport_code'],
        	'pres_country'=>$getrequest['pres_country'],
        	'prv_visit_add1'=>$getrequest['prv_visit_add1'],
        	'visited_city'=>$getrequest['visited_city'],
        	'old_visa_no'=>$getrequest['old_visa_no'],
        	'service_purpose_json'=>json_encode($service_arr),
        	'old_visa_type_id'=>isset($getrequest['old_visa_type_id'])?$getrequest['old_visa_type_id']:NULL,
        	'oldvisaissueplace'=>isset($getrequest['oldvisaissueplace'])?$getrequest['oldvisaissueplace']:NULL,
        	'oldvisaissuedate'=>isset($getrequest['oldvisaissuedate'])?$getrequest['oldvisaissuedate']:NULL,
        	'refuse_flag'=>$getrequest['refuse_flag'],
        	'refuse_details'=>$getrequest['refuse_details'],
        	'country_visited'=>$getrequest['country_visited'],
        	'nameofsponsor_ind'=>$getrequest['nameofsponsor_ind'],
        	'add1ofsponsor_ind'=>$getrequest['add1ofsponsor_ind'],
        	'phoneofsponsor_ind'=>$getrequest['phoneofsponsor_ind'],
        	'nameofsponsor_msn'=>$getrequest['nameofsponsor_msn'],
        	'add1ofsponsor_msn'=>$getrequest['add1ofsponsor_msn'],
        	'phoneofsponsor_msn'=>$getrequest['phoneofsponsor_msn'],
        	'saarc_flag'=>$getrequest['saarc_flag'],
        	'saarc_details'=> json_encode($saarc_arr)
        	]);

		if(!empty($getrequest['passport_front'])){


			$passport_front = $request->file('passport_front');
			$doc_type = "PASSPORT_FRONT";

			$input['imagename'] = "passport-front-".time().'.'.$passport_front->getClientOriginalExtension();
			$imgsize = $passport_front->getClientSize();
			$imgtype = $passport_front->getClientMimeType();

			$destinationPath = public_path('doc-upload/');
						    
			$request->file('passport_front')->move($destinationPath, $input['imagename']);

			$savedocdetails = DocumentDetails::firstOrCreate(['applicant_id' => $qry['profile_id'],'doc_type_id'=>1]);

			$savedocdetails->doc_type = $doc_type;
			$savedocdetails->doc_type_id = 1;
			$savedocdetails->doc_size = $imgsize;
			$savedocdetails->doc_url = "/doc-upload/".$input['imagename'];
			$savedocdetails->doc_mime_type = $imgtype;

			$savedocdetails->save();	
						}

		if(!empty($getrequest['photo'])){
						
			$photograph = $request->file('photo');
			$doc_type = "PHOTO";

			$input['imagename'] = "photograph-".time().'.'.$photograph->getClientOriginalExtension();
			$imgsize = $photograph->getClientSize();
			$imgtype = $photograph->getClientMimeType();

			$destinationPath = public_path('doc-upload/');
						    
			$request->file('photo')->move($destinationPath, $input['imagename']);

			$savedocdetails = DocumentDetails::firstOrCreate(['applicant_id' => $qry['profile_id'],'doc_type_id'=>3]);

			$savedocdetails->doc_type = $doc_type;
			$savedocdetails->doc_type_id = 3;
			$savedocdetails->doc_size = $imgsize;
			$savedocdetails->doc_url = "/doc-upload/".$input['imagename'];
			$savedocdetails->doc_mime_type = $imgtype;

			$savedocdetails->save();	

			//echo $qry['profile_id']."  ".$input['imagename']; exit;
						}

		if(isset($getrequest['business_card']) && !empty($getrequest['business_card'])){							
			$passport_front = $request->file('business_card');
			$doc_type = "BUSINESS_CARD";

			$input['imagename'] = "business-card-".time().'.'.$passport_front->getClientOriginalExtension();
			$imgsize = $passport_front->getClientSize();
			$imgtype = $passport_front->getClientMimeType();

			$destinationPath = public_path('doc-upload/');
							    
			$request->file('business_card')->move($destinationPath, $input['imagename']);

			$savedocdetails = DocumentDetails::firstOrCreate(['applicant_id' => $qry['profile_id'],'doc_type_id'=>18]);

			$savedocdetails->doc_type = $doc_type;
			$savedocdetails->doc_type_id = 1;
			$savedocdetails->doc_size = $imgsize;
			$savedocdetails->doc_url = "/doc-upload/".$input['imagename'];
			$savedocdetails->doc_mime_type = $imgtype;

			$savedocdetails->save();
		}

		if(isset($getrequest['hospital_letter']) && !empty($getrequest['hospital_letter'])){
			$passport_front = $request->file('hospital_letter');
			$doc_type = "HOSPITAL_LETTER";

			$input['imagename'] = "hospital-letter-".time().'.'.$passport_front->getClientOriginalExtension();
			$imgsize = $passport_front->getClientSize();
			$imgtype = $passport_front->getClientMimeType();

			$destinationPath = public_path('doc-upload/');
							    
			$request->file('hospital_letter')->move($destinationPath, $input['imagename']);

			$savedocdetails = DocumentDetails::firstOrCreate(['applicant_id' => $qry['profile_id'],'doc_type_id'=>19]);

			$savedocdetails->doc_type = $doc_type;
			$savedocdetails->doc_type_id = 1;
			$savedocdetails->doc_size = $imgsize;
			$savedocdetails->doc_url = "/doc-upload/".$input['imagename'];
			$savedocdetails->doc_mime_type = $imgtype;

			$savedocdetails->save();
		}

		return Redirect::back()->withErrors(['Record Successfully Updated!']);

	}
	


	return view('evisaapplication/indiareview', compact('qry', 'airport_arr', 'getcountry', 'getreligion', 'getqualification', 'getmarital', 'getstate', 'getcity', 'getpropfession', 'getvisatypes', 'getapplicantdata', 'getpuroses', 'saarc_details', 'getsaarccountry', 'service_purpose', 'getdocdata', 'getsaarcyear'));
}

public function sendabandonsmail(Request $request){
	$error = array();
	$sendmail = new ApplicationController;
	$status_arr = array();
	$getrequest = $request->all();
	// echo "<pre>";print_r($getorderdetails);exit;
	try{
		// $getorderdetails = OrderDetails::join('users','users.user_id','=','order_details.user_id')->where('payment_status', '=', '')->orWhereNull('payment_status')->get();
		$getorderdetails = OrderDetails::join('users','users.user_id','=','order_details.user_id')->where('order_id', '=', $getrequest['order_id'])->first();
		// echo "<pre>";print_r($getorderdetails);exit;
		// if($getrequest['pagename']=="evisa-type"){
		// 	$error['status'] = "warning";
		// 	$error['msg'] = "same page found";
		// } else {
		// 	if(count($getorderdetails) > 0){
		// 	if($getorderdetails->abandon_sent == "N"){
		// 			$to = $getorderdetails->email_id;
		//             $cust_name = $getorderdetails->username;
		                
		//             $content = "Dear $cust_name, <br><p>Thank you for your interest in our services. We see that you were in the process of filling your visa application and have not completed it. To ensure that you have all the support that you need, our team will get in touch with you shortly to help you through your transaction</p><p>For any assistance, please do call us at +912262538600 or email us at <a href='mailto:customercare@redcarpetassist.com?Subject=Your transaction is incomplete' target='_top'>customercare@redcarpetassist.com</a> We work Monday to Saturday, 10 am to 8pm Indian Standard Time (GMT +5.30)</p><p>Your <font color='red'>RedCarpet</font> Assist Team.</p><p><i>Add <a href='mailto:customercare@redcarpetassist.com?Subject=Your transaction is incomplete' target='_top'>support@redcarpetassist.com</a> to your address book to ensure that our mails reach your Inbox.</i></p>";

		//                 $subject ="Your transaction is incomplete";
		//                 $sendmail->sendEmail("support@redcarpetassist.com",$to,null,null, $subject, $content);

		//             // UserLeads::where('status', "Evisa-verifyemail")
		//             // ->update(['status'=>'abandons_booking']);

		//             // DB::table('user_leads')->whereIn('status',['Evisa-ApplicationDetails','Evisa-verifyemail'])->update(['status'=>'abandons_booking']);    

		// 		    OrderDetails::where('order_id', $getrequest['order_id'])->update(['abandon_sent'=>'Y']);

		// 		    // DB::table('order_details')->whereIn('applicant_booking_status',['Evisa-ApplicationDetails','Evisa-verifyemail'])->update(['applicant_booking_status'=>'abandons_booking']);         

		// 		    $error['status'] = "success";
		// 		    $error['msg'] = "Send Mail Successfully";
		// 		} else {
		// 			$error['status'] = "warning";
		// 		    $error['msg'] = "Already Send Mail";
		// 		}
		// 	} else {
		// 		$error['status'] = "Not Found";
		// 		$error['msg'] = "Record Not Found";
		// 	}
		// }
		if(count($getorderdetails) > 0){
			if($getorderdetails->abandon_sent == "Y"){
					$to = $getorderdetails->email_id;
		            $cust_name = $getorderdetails->username;
		                
		            $content = "Dear $cust_name, <br><p>Thank you for your interest in our services. We see that you were in the process of filling your visa application and have not completed it. To ensure that you have all the support that you need, our team will get in touch with you shortly to help you through your transaction</p><p>For any assistance, please do call us at +912262538600 or email us at <a href='mailto:customercare@redcarpetassist.com?Subject=Your transaction is incomplete' target='_top'>customercare@redcarpetassist.com</a> We work Monday to Saturday, 10 am to 8pm Indian Standard Time (GMT +5.30)</p><p>Your <font color='red'>RedCarpet</font> Assist Team.</p><p><i>Add <a href='mailto:customercare@redcarpetassist.com?Subject=Your transaction is incomplete' target='_top'>support@redcarpetassist.com</a> to your address book to ensure that our mails reach your Inbox.</i></p>";

		                $subject ="Your transaction is incomplete";
		                $sendmail->sendEmail("support@redcarpetassist.com",$to,null,null, $subject, $content);

		            // UserLeads::where('status', "Evisa-verifyemail")
		            // ->update(['status'=>'abandons_booking']);

		            // DB::table('user_leads')->whereIn('status',['Evisa-ApplicationDetails','Evisa-verifyemail'])->update(['status'=>'abandons_booking']);    

				    OrderDetails::where('order_id', $getrequest['order_id'])->update(['abandon_sent'=>'Y']);

				    // DB::table('order_details')->whereIn('applicant_booking_status',['Evisa-ApplicationDetails','Evisa-verifyemail'])->update(['applicant_booking_status'=>'abandons_booking']);         

				    $error['status'] = "success";
				    $error['msg'] = "Send Mail Successfully";
				} else {
					$error['status'] = "warning";
				    $error['msg'] = "Already Send Mail";
				}
			} else {
				$error['status'] = "Not Found";
				$error['msg'] = "Record Not Found";
			}
	} catch(\Illuminate\Database\QueryException $ex){
			dd($ex->getMessage());
			$error['status'] = "Failed";
			$error['msg'] = "Something Wrong";
	} catch(PDOException $ex){
			dd($ex->getMessage());
			$error['status'] = "Failed";
			$error['msg'] = "Something Wrong";
	}

	file_put_contents(public_path().'/sendmail_log/log_abandonmail_'.date("j.n.Y").'.log', json_encode($error));

	echo json_encode($error);exit;
}

// public function saveSLtypeformdata($request=NULL){
	
// 	$responseArr = $request;
// 	$responseData = array();
// 	$data_user = array();
// 	$marital_status_id = "";
// 	$purposeid = "";
// 	$serviceid = "";
// 	if(isset($responseArr) && !empty($responseArr)){

// 		 file_put_contents(public_path().'/typeform_log/log_sl_demo'.date("j.n.Y").'.log', print_r($responseArr, TRUE));
		
// 		$responseData = $responseArr;

// 		if($responseData['dropdown_miToQl3JRHSI'][0]['label']=="Tourist"){
// 				$serviceid = 5;
// 		} else if($responseData['dropdown_miToQl3JRHSI'][0]['label']=="Business"){
// 				$serviceid = 6;
// 		} else if($responseData['dropdown_miToQl3JRHSI'][0]['label']=="Transit"){
// 				$serviceid = 7;
// 		}

// 			$data_user = array(
// 					'uid'=>'',
// 					'username'=>!empty($responseData['short_text_uIkOjDNG797Z'][0])?$responseData['short_text_uIkOjDNG797Z'][0]:NULL,
// 					'email'=> !empty($responseData['email_L9m99y212FbP'][0])?$responseData['email_L9m99y212FbP'][0]:NULL,
// 					'phone'=> !empty($responseData['number_l9lD37yUtUDp'][0])?$responseData['number_l9lD37yUtUDp'][0]:NULL,
// 					'nationality'=>"India",
// 					'created_at'=> date('Y-m-d H:i:s')
// 				);
// 			$uid = $this->saveUserDetails($data_user);
// 			if($uid){
// 				$data_ord = array(
// 					'order_id'=>'',
// 					'order_code'=> $this->RandomString(15),
// 					'user_id'=> $uid,
// 					'product_id'=> 1,
// 					'adult'=> 0,
// 					'child'=> 0,
// 					'infant'=> 0,
// 					'nationality'=> "India",
// 					'total_price'=> NULL,
// 					'residing_in'=> NULL,
// 					'residing_code'=> NULL,
// 					'travel_to'=> "Sri Lanka",
// 					'citizen_to'=> "India",
// 					'passport_type'=> NULL,
// 					'airport_code'=> NULL,
// 					'arrival_date'=> NULL,
// 					'applicant_booking_status'=> "Evisa-ApplicationDetails",
// 					'created_at'=> date('Y-m-d H:i:s')
// 					);
// 			$ordid = $this->saveOrderDetails($data_ord);

// 			if($ordid){
// 				$app_data = array(
// 					'user_id' => $uid,
// 					'username' => !empty($responseData['textfield_uIkOjDNG797Z'][0])?$responseData['textfield_uIkOjDNG797Z'][0]:$responseData['textfield_P6fRxPs3m5js'][0],
// 					'surname' => !empty($responseData['textfield_yRcpfHyN0f8A'][0])?$responseData['textfield_yRcpfHyN0f8A'][0]:NULL,
		
// 					'mobile_number' => !empty($responseData['number_CB2ugxCtMgix'][0])?$responseData['number_CB2ugxCtMgix'][0]:NULL,
// 					'marital_status_id' => NULL,
//   	 				'dob' => !empty($responseData['date_mvQqx6lMz9w6'][0])?$responseData['date_mvQqx6lMz9w6'][0]:NULL,
// 					'gender' => !empty($responseData['dropdown_zR5oaSS4g0Le'][0]['label'])?$responseData['dropdown_zR5oaSS4g0Le'][0]['label']:NULL,
// 					'nationality'=> "India",
// 					'order_id' => $ordid
// 				);

// 				$this->saveApplicantProfile($app_data);

// 				$user_leads_data = array(
// 					'session_id'=> session()->getId(),
// 					'name' => !empty($responseData['short_text_uIkOjDNG797Z'][0])?$responseData['short_text_uIkOjDNG797Z'][0]:NULL,
// 					'phone_number' => !empty($responseData['number_l9lD37yUtUDp'][0])?$responseData['number_l9lD37yUtUDp'][0]:$responseData['number_nhkJhSpgDFvy'][0],
// 					'email_id'=> !empty($responseData['email_L9m99y212FbP'][0])?$responseData['email_L9m99y212FbP'][0]:$responseData['email_xn1dLxoC5BRZ'][0],
// 					'nationality' => "India",
// 					'residing_in' => NULL,
// 					'travelling_to' => "Sri Lanka",
// 					'passport_type' => NULL,
// 					'airport_code' => NULL,
// 					'arrival_date' => NULL,
// 					'product_id' => 1,
// 					'order_id' => $ordid,
// 					'created_at' => date('Y-m-d H:i:s'),
// 					'status' => "Evisa-ApplicationDetails"	
// 				);

// 				$this->saveUserLeads($user_leads_data);

// 				$applicant_id = ApplicantProfiles::select(DB::raw('max(profile_id) as profile_id'))->get()->first();

// 						$ppid = DB::table('passport_details')->insertGetId([
// 				    		'user_id'=>$uid,
// 				    		'applicant_id'=>$applicant_id->profile_id,
// 				    		'pp_no' => !empty($responseData['short_text_vKWCul3vIW7V'][0])?$responseData['short_text_vKWCul3vIW7V'][0]:NULL,
// 				    		'pp_issue_date'=> !empty($responseData['date_fHokRbU2PecV'])?$responseData['date_fHokRbU2PecV']:NULL,
// 				    		'pp_expiry_date'=> !empty($responseData['date_vezsLhBF5dCN'][0])?$responseData['date_vezsLhBF5dCN'][0]:NULL,
// 				    	]);

// 				    	$saveservicedetails = UserserviceDetails::firstOrCreate(['order_id'=>$ordid,'service_id'=>$serviceid]);
// 						$saveservicedetails->service_id = $serviceid;
// 						$saveservicedetails->purpose_id = "";
// 						$saveservicedetails->order_id = $ordid;
// 						$saveservicedetails->applicant_id = $applicant_id->profile_id;
// 						$saveservicedetails->user_id = $uid;
// 						$saveservicedetails->status = "Y";

// 					$saveservicedetails->save();	
// 					$email = !empty($responseData['email_L9m99y212FbP'][0])?$responseData['email_L9m99y212FbP'][0]:$responseData['email_xn1dLxoC5BRZ'][0];
// 					$res_arr = array(
// 						'sl_visa_type'=> !empty($responseData['dropdown_miToQl3JRHSI'])?$responseData['dropdown_miToQl3JRHSI']:NULL,
// 						'tourist_purpose' => !empty($responseData['dropdown_bDWFDPSh1fKD'][0]['label'])?$responseData['dropdown_bDWFDPSh1fKD'][0]['label']:NULL,
// 			        	'business_purpose' => !empty($responseData['dropdown_yv8pMgXKg0fC'][0]['label'])?$responseData['dropdown_yv8pMgXKg0fC'][0]['label']:NULL,
// 			        	'transit_purpose' => !empty($responseData['dropdown_aWr4xZgfTNNP'][0]['label'])?$responseData['dropdown_aWr4xZgfTNNP'][0]['label']:NULL,
// 						'applicant_company_contact_details'=>array(
// 							'company_name'=>!empty($responseData['short_text_VIOUmUA4wLJj'][0])?$responseData['short_text_VIOUmUA4wLJj'][0]:NULL,
// 							'address1'=>!empty($responseData['short_text_twJvCQ8Mxs0I'][0])?$responseData['short_text_twJvCQ8Mxs0I'][0]:NULL,
// 							'address2'=>!empty($responseData['short_text_peMfLGDKrkug'][0])?$responseData['short_text_peMfLGDKrkug'][0]:NULL,
// 							'city'=>!empty($responseData['short_text_ylNWXYEfa1B0'][0])?$responseData['short_text_ylNWXYEfa1B0'][0]:NULL,
// 							'state'=>!empty($responseData['short_text_u2siaynQNXx3'][0])?$responseData['short_text_u2siaynQNXx3'][0]:NULL,
// 							'zipcode'=>!empty($responseData['short_text_rSdq9OS46fIf'][0])?$responseData['short_text_rSdq9OS46fIf'][0]:NULL,
// 							'country'=>!empty($responseData['dropdown_MdgdexBbq0dW'][0]['label'])?$responseData['dropdown_MdgdexBbq0dW'][0]['label']:NULL,
// 							'telephone'=>!empty($responseData['number_RsbD0I9Y46ix'][0])?$responseData['number_RsbD0I9Y46ix'][0]:NULL,
// 							'mobile'=>!empty($responseData['number_nhkJhSpgDFvy'][0])?$responseData['number_nhkJhSpgDFvy'][0]:NULL,
// 							'fax'=>!empty($responseData['short_text_E4cM0t89BM4b'][0])?$responseData['short_text_E4cM0t89BM4b'][0]:NULL,
// 							'email'=>!empty($responseData['email_xn1dLxoC5BRZ'][0])?$responseData['email_xn1dLxoC5BRZ'][0]:NULL,
// 						),
// 						'srilanka_company_contact_details'=>array(
// 							'company_name'=>!empty($responseData['short_text_q5wqZeAbf2WE'][0])?$responseData['short_text_q5wqZeAbf2WE'][0]:NULL,
// 							'address1'=>!empty($responseData['short_text_uQTrz5ZLxp8v'][0])?$responseData['short_text_uQTrz5ZLxp8v'][0]:NULL,
// 							'address2'=>!empty($responseData['short_text_SZiGOeDzWk7a'][0])?$responseData['short_text_SZiGOeDzWk7a'][0]:NULL,
// 							'city'=>!empty($responseData['short_text_Djl97fg1CVD0'][0])?$responseData['short_text_Djl97fg1CVD0'][0]:NULL,
// 							'state'=>!empty($responseData['short_text_JazsSSN88cNP'][0])?$responseData['short_text_JazsSSN88cNP'][0]:NULL,
// 							'zipcode'=>!empty($responseData['short_text_VpfSHkLD97vy'][0])?$responseData['short_text_VpfSHkLD97vy'][0]:NULL,
// 							'country'=>!empty($responseData['dropdown_Vx5ikSGWDWRg'][0]['label'])?$responseData['dropdown_Vx5ikSGWDWRg'][0]['label']:NULL,
// 							'telephone'=>!empty($responseData['number_FRVAcZlAuPbu'][0])?$responseData['number_FRVAcZlAuPbu'][0]:NULL,
// 							'mobile'=>!empty($responseData['number_bMn7yWOP4b0o'][0])?$responseData['number_bMn7yWOP4b0o'][0]:NULL,
// 							'fax'=>!empty($responseData['short_text_bkLs4VKON1To'][0])?$responseData['short_text_bkLs4VKON1To'][0]:NULL,
// 							'email'=>!empty($responseData['email_xdiPEV0hbVCB'][0])?$responseData['email_xdiPEV0hbVCB'][0]:NULL,
// 						),
// 						'address1'=>!empty($responseData['long_text_HHULBNhf8dvP'][0])?$responseData['long_text_HHULBNhf8dvP'][0]:NULL,
// 						'address2'=> !empty($responseData['long_text_YzVPEG7ucZQy'][0])?$responseData['long_text_YzVPEG7ucZQy'][0]:NULL,
// 						'city'=> !empty($responseData['short_text_tRAgaZwVxCnd'][0])?$responseData['short_text_tRAgaZwVxCnd'][0]:NULL,
// 						'state'=> !empty($responseData['short_text_NzaWCIEV4mIv'][0])?$responseData['short_text_NzaWCIEV4mIv'][0]:NULL,
// 						'zipcode'=> !empty($responseData['short_text_ueBiIV37DllC'][0])?$responseData['short_text_ueBiIV37DllC'][0]:NULL,
// 						'country'=> !empty($responseData['dropdown_OE4i1amccJ66'][0]['label'])?$responseData['dropdown_OE4i1amccJ66'][0]['label']:NULL,
// 						'address_srilanka'=> !empty($responseData['long_text_pgAVgUZDwNAM'][0])?$responseData['long_text_pgAVgUZDwNAM'][0]:NULL,
// 						'email'=> !empty($responseData['email_L9m99y212FbP'][0])?$responseData['email_L9m99y212FbP'][0]:NULL,
// 						'telephone'=> !empty($responseData['number_l9lD37yUtUDp'][0])?$responseData['number_l9lD37yUtUDp'][0]:NULL,
// 						'mobile'=> !empty($responseData['number_CB2ugxCtMgix'][0])?$responseData['number_CB2ugxCtMgix'][0]:NULL,
// 						'fax'=> !empty($responseData['number_C6rFVRfdnRSa'][0])?$responseData['number_C6rFVRfdnRSa'][0]:NULL,
// 						'purpose_desc'=> !empty($responseData['long_text_uo7XKYvKSeUC'][0])?$responseData['long_text_uo7XKYvKSeUC'][0]:NULL,
// 						'intended_stay_days'=>!empty($responseData['dropdown_mUoIg3x7KHym'][0]['label'])?$responseData['dropdown_mUoIg3x7KHym'][0]['label']:NULL,
// 						'appl_givenname'=> !empty($responseData['short_text_uIkOjDNG797Z'][0])?$responseData['short_text_uIkOjDNG797Z'][0]:NULL,
// 						'appl_surname'=> !empty($responseData['short_text_yRcpfHyN0f8A'][0])?$responseData['short_text_yRcpfHyN0f8A'][0]:NULL,
// 						'appl_title'=> !empty($responseData['dropdown_mszZNVAugNQn'][0]['label'])?$responseData['dropdown_mszZNVAugNQn'][0]['label']:NULL,
// 						'appl_birthdate'=> !empty($responseData['date_mvQqx6lMz9w6'][0])?$responseData['date_mvQqx6lMz9w6'][0]:NULL,
// 						'appl_gender'=> !empty($responseData['dropdown_zR5oaSS4g0Le'][0]['label'])?$responseData['dropdown_zR5oaSS4g0Le'][0]['label']:NULL,
// 						'appl_birth_country'=> !empty($responseData['dropdown_ik1JAtPSkzzC'][0]['label'])?$responseData['dropdown_ik1JAtPSkzzC'][0]['label']:NULL,
// 						'appl_occupation'=> !empty($responseData['short_text_BzBsBkfEDUhO'][0])?$responseData['short_text_BzBsBkfEDUhO'][0]:NULL,
// 						'passport_no'=> !empty($responseData['short_text_vKWCul3vIW7V'][0])?$responseData['short_text_vKWCul3vIW7V'][0]:NULL,
// 						'pass_issuedate'=> !empty($responseData['date_fHokRbU2PecV'][0])?$responseData['date_fHokRbU2PecV'][0]:NULL,
// 						'pass_expirydate'=> !empty($responseData['date_vezsLhBF5dCN'][0])?$responseData['date_vezsLhBF5dCN'][0]:NULL,
// 						'is_child_on_pass'=> !empty($responseData['yes_no_hEdxchy2EMhx'][0])?$responseData['yes_no_hEdxchy2EMhx'][0]:NULL,
// 						'child1'=> array(
// 							'c1_surname'=> !empty($responseData['short_text_fmX7tTTdSBNG'][0])?$responseData['short_text_fmX7tTTdSBNG'][0]:NULL,
// 							'c1_name'=> !empty($responseData['short_text_ZozCU8mC4fHC'][0])?$responseData['short_text_ZozCU8mC4fHC'][0]:NULL,
// 							'c1_dob'=> !empty($responseData['date_qrFvbd0RLFXg'][0])?$responseData['date_qrFvbd0RLFXg'][0]:NULL,
// 							'c1_gender'=> !empty($responseData['dropdown_MYMIKOockHkn'][0]['label'])?$responseData['dropdown_MYMIKOockHkns'][0]['label']:NULL,
// 							'c1_relation'=> 'Child'
// 						),
// 						'child2'=> array(
// 							'c2_surname'=> !empty($responseData['short_text_vIQ7ypAWVgZk'][0])?$responseData['short_text_vIQ7ypAWVgZk'][0]:NULL,
// 							'c2_name'=> !empty($responseData['short_text_NSs3zRfSOPNa'][0])?$responseData['short_text_NSs3zRfSOPNa'][0]:NULL,
// 							'c2_dob'=> !empty($responseData['date_SwxscdJdcNB4'][0])?$responseData['date_SwxscdJdcNB4'][0]:NULL,
// 							'c2_gender'=> !empty($responseData['dropdown_zE5Do4BI4KWe'][0]['label'])?$responseData['dropdown_zE5Do4BI4KWe'][0]['label']:NULL,
// 							'c2_relation'=> 'Child'
// 						),
// 						'child3'=> array(
// 							'c3_surname'=> !empty($responseData['short_text_z3XJNcFy8md8'][0])?$responseData['short_text_z3XJNcFy8md8'][0]:NULL,
// 							'c3_name'=> !empty($responseData['short_text_iu5awHe0TubT'][0])?$responseData['short_text_iu5awHe0TubT'][0]:NULL,
// 							'c3_dob'=> !empty($responseData['date_PrdlXr38x7Sx'][0])?$responseData['date_PrdlXr38x7Sx'][0]:NULL,
// 							'c3_gender'=> !empty($responseData['dropdown_oopiaaYyjmww'][0]['label'])?$responseData['dropdown_oopiaaYyjmww'][0]['label']:NULL,
// 							'c3_relation'=> 'Child'
// 						),
// 						'arrival_date'=> !empty($responseData['date_uT5MbfD5swYy'][0])?$responseData['date_uT5MbfD5swYy'][0]:NULL,
// 						'port_of_departue'=> !empty($responseData['short_text_JnWl7w11A2Ps'][0])?$responseData['short_text_JnWl7w11A2Ps'][0]:NULL,
// 						'airline_vessel'=> !empty($responseData['short_text_jssW7SM9rfqs'][0])?$responseData['short_text_jssW7SM9rfqs'][0]:NULL,
// 						'airline_vessel_no'=> !empty($responseData['short_text_fcpegYDQJZHJ'][0])?$responseData['short_text_fcpegYDQJZHJ'][0]:NULL,
// 						'valid_resident'=> !empty($responseData['yes_no_WfwtTzeh5j1J'][0])?$responseData['yes_no_WfwtTzeh5j1J'][0]:NULL,
// 						'has_valid_eta'=> !empty($responseData['yes_no_LfqbyFuqBluz'][0])?$responseData['yes_no_LfqbyFuqBluz'][0]:NULL,
// 						'mutiple_entry_visa'=> !empty($responseData['yes_no_Ph6vWEVH3YbT'][0])?$responseData['yes_no_Ph6vWEVH3YbT'][0]:NULL
// 					);				

// 					$saverelationdetails = ApplicationrelationDetails::firstOrCreate(['applicant_id'=>$applicant_id->profile_id]);
// 					$saverelationdetails->applicant_id = $applicant_id->profile_id;
// 					$saverelationdetails->pres_add1 = !empty($responseData['long_text_HHULBNhf8dvP'][0])?$responseData['long_text_HHULBNhf8dvP'][0]:NULL;
// 					$saverelationdetails->pres_country = NULL;
// 					$saverelationdetails->state_name = !empty($responseData['short_text_NzaWCIEV4mIv'][0])?$responseData['short_text_NzaWCIEV4mIv'][0]:NULL;
// 					$saverelationdetails->pres_phone = !empty($responseData['number_l9lD37yUtUDp'][0])?$responseData['number_l9lD37yUtUDp'][0]:NULL;
// 					$saverelationdetails->application_details = !empty($res_arr)?json_encode($res_arr):NULL;
					
// 				$saverelationdetails->save();
// 						}
// 					}
// 					$getorderdetails = OrderDetails::join('users','users.user_id','=','order_details.user_id')
// 							->where('email_id','=',$email)
//                      		->first();
		
// 	}
// 	echo json_encode(array('order_id'=>$ordid,'applicant_id'=>$applicant_id->profile_id,'uid'=>$uid,'order_code'=>$getorderdetails['order_code']));
// }

// public function gettypeformresponse(Request $request){
// 	$getrequest = $request->all();
// 	// echo "<pre>";print_r($getrequest);exit;
// 	$ccode = $request->route('ccode');

// 	$getservice = PricingMaster::where('nationality', "India")
// 								->where('product_id',1)
// 								->first();
// 	if(isset($getrequest['email']) && !empty($getrequest['email'])){
		
// 		$getusers = Users::where('email_id','=',$getrequest['email'])->get()->first();

// 		$getorderdetails = OrderDetails::join('users','users.user_id','=','order_details.user_id')->where('email_id','=',$getrequest['email'])->orderby('order_id','DESC')
// 	         ->first();

// 	    $applicant_id = ApplicantProfiles::join('users','users.user_id','=','applicant_profiles.user_id')->where('users.email_id','=',$getrequest['email'])->orderby('profile_id','DESC')->get()->first();

// 	}

// 	$postData = array('order_id'=>$getorderdetails['order_id'],'applicant_id'=>$applicant_id['profile_id'],'uid'=>$getusers['user_id'],'order_code'=>$getorderdetails['order_code']);
	 
//     // echo "<pre>";print_r($postData);exit;

//     return view('evisaapplication/gettypeformresponse', compact('postData','ccode','getservice'));          		
// }

public function typeformwebhookapi(){
	$request_body = file_get_contents("php://input");
	$data = json_decode($request_body, true);
	$data_arr = array();
	$error = array();
	$fieldid = "";

    if (isset($data['form_response'])) {
    	
    	foreach($data['form_response']['answers'] as $key=>$val){
    		$fieldid = $val['field']['type']."_".$val['field']['id'];
    		$data_arr[$fieldid][] = $val[$val['type']];
    	}

    	if(isset($data['form_response']['form_id']) && $data['form_response']['form_id']=="HcDNUu"){
    		file_put_contents(public_path().'/typeform_log/log_HK_'.date("j.n.Y").'.log', print_r($data, TRUE));

			//$this->saveHKtypeformdata($data_arr);

		} else if(isset($data['form_response']['form_id']) && $data['form_response']['form_id']=="bZYeH3"){
			file_put_contents(public_path().'/typeform_log/log_SL_'.date("j.n.Y").'.log', print_r($data, TRUE));

			$this->saveSLtypeformdata($data_arr);
		}  
    }
}

public function Typeform($type,$targetUrl,$personData=NULL){
// set the Typeform API key - read About API Keys: https://www.typeform.com/help/data-api/
$tfApiKey = '602af47acad32e1b413152d6a26952a124377ada';
// set the base API URL
$tfBaseAPIUrl  = 'https://api.typeform.com/v1/form/';
// set error checking of global variables. if any are empty, die on the spot and display error message to web browser
if (!$tfApiKey || !$tfBaseAPIUrl) die('Error: Typeform API details missing.');
$apiUrl = $targetUrl;
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
//curl_setopt($ch, CURLOPT_USERPWD, "username:$mcApiKey");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,5);
curl_setopt($ch, CURLOPT_PORT, 443);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2); 
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
if($type == 'post'){
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $personData);
}
if($type == 'put'){
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($personData)));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $personData);
}
$contents = curl_exec($ch);
if (curl_errno($ch)) {
    // this would be your first hint that something went wrong
    die('Couldn\'t send request: ' . curl_error($ch));
} else {
    // check the HTTP status code of the request
    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($resultStatus != 200) {
        die('Request failed: HTTP status code: ' . $resultStatus);
    }
}
echo "<pre>";print_r($contents);exit;
if(!$contents){
$contents =  'Error: '.curl_error($ch);
}
curl_close($ch);
return $contents;
}

public function TypeformResponseURL($formid,$personData=NULL){
// set the Typeform API key - read About API Keys: https://www.typeform.com/help/data-api/
$tfApiKey = 'dfdd08b7a686792ddbb9c4ab5c696c0d81c4ca08';
$mcApiKey = "5k91uxgWha3b2ta7fozGusdf8ZrwoSjD4Ugq9nzRr5G1:44orAjgJXq94Tn7jvhLCYTQDwvgrUEjfwrLbqmuieWch";
// set the base API URL
$tfBaseAPIUrl  = 'https://api.typeform.com/forms/'.$formid.'/responses';
// set error checking of global variables. if any are empty, die on the spot and display error message to web browser
if (!$tfApiKey || !$tfBaseAPIUrl) die('Error: Typeform API details missing.');

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
// curl_setopt($ch, CURLOPT_USERPWD, "username:$mcApiKey");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,5);
curl_setopt($ch, CURLOPT_PORT, 443);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,0); 
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2); 
curl_setopt($ch, CURLOPT_URL, $tfBaseAPIUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

$headers = array();
//$headers[] = "Authorization: $mcApiKey";
$headers[] = "Content-Type: application/json";

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}

$contents = curl_exec($ch);
if (curl_errno($ch)) {
    // this would be your first hint that something went wrong
    die('Couldn\'t send request: ' . curl_error($ch));
} else {
    // check the HTTP status code of the request
    $resultStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($resultStatus != 200) {
        die('Request failed: HTTP status code: ' . $resultStatus);
    }
}
echo "<pre>";print_r($contents);exit;
if(!$contents){
$contents =  'Error: '.curl_error($ch);
}
curl_close($ch);
return $contents;
}

public function applicationtrack(Request $request){
	$getrequest = $request->all();
	$form_url = "";
	if (!empty($getrequest['order_id']) && !empty($getrequest['uid'])){
        $getorderdetails = OrderDetails::where('order_id', '=', $getrequest['order_id'])
							->where('user_id', '=', $getrequest['uid'])
                     		->first();
		    $order_data = array(
            	'order_id'=>$getrequest['order_id'],
            	'user_id'=>$getrequest['uid'],
            );
            Session::put('applicantdetails', $order_data); 
            //session(['applicantdetails'=>$order_data]);

        if($getorderdetails['applicant_booking_status']=='Evisa-Services'){
        	// Redirect::route('evisa-type',array('ccode' => $getorderdetails['residing_code']));
        	$form_url = 'evisa-type/'.$getorderdetails['residing_code'];
        }elseif ($getorderdetails['applicant_booking_status']=='Evisa-ApplicationDetails') {
        	# code...
        	$form_url = 'evisa-form/basic-details/'.$getorderdetails['residing_code'];
        }elseif ($getorderdetails['applicant_booking_status']=="Evisa-RelationDetails") {
        	# code...
        	$form_url = 'evisa-form/family-details/'.$getorderdetails['residing_code'];
        }elseif ($getorderdetails['applicant_booking_status']=='Evisa-FinalForm') {
        	# code...
        	$form_url = 'evisa/visa-details/'.$getorderdetails['residing_code'];
        }elseif ($getorderdetails['applicant_booking_status']=='Evisa-verifyemail') {
        	# code...
        	$form_url = 'evisa/verifymail';
        }elseif ($getorderdetails['applicant_booking_status']=='Evisa-evisabookingpage') {
        	# code...
        	$form_url = 'evisa/payment';
        }elseif ($getorderdetails['applicant_booking_status']=='Evisa-ExtraDocument') {
        	# code...
        	$form_url = 'evisa/service-document/'.$getorderdetails['residing_code'];
        }elseif($getorderdetails['applicant_booking_status']=='Evisa-HongKongBasicDetails'){
        	$form_url = 'basic-details/'.$getorderdetails['typeform_token'];
        }elseif($getorderdetails['applicant_booking_status']=='Evisa-HongKongApplicationDetails'){
        	$form_url = 'evisa/to/'.$getorderdetails['typeform_token'];
        }
    }
	
	echo json_encode(array('form_url'=>$form_url));exit;
	// return view('evisaapplication/evisaapplicationtrack');
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


public function ajaxsendotp(Request $request){
	$getpostdata = $request->all();
	// echo "<pre>";print_r($getpostdata);exit;
	$otp = $this->generateOtp();
	$sendmail = new ApplicationController;

	$error = array();
	$subject = 'One Time Password for your transaction for Redcarpet Assist Services';
	if(isset($getpostdata['app_track']) && !empty($getpostdata['email_id'])){
		try{
			$getorderdetails = OrderDetails::join('users','users.user_id','=','order_details.user_id')
							->where('email_id','=',$getpostdata['email_id'])
                     		->first();
            // echo "<pre>";print_r($getorderdetails);exit;         		
            if(!empty($getorderdetails['order_code']) && !empty($getorderdetails['email_id'])){
            	$to = $getorderdetails['email_id'];
			    $content = "Hello ".$getorderdetails['username'].", <br>Your OTP is ".$otp."</br>Thank you.<br>Regards,<br>Team RedCarpet Assist";
            	$sendmail->sendEmail("support@redcarpetassist.com",$to,null,null, $subject, $content);
            	$error['status'] = 'success';
            	$error['msg'] = strtoupper("Check your email for the OTP");
            	$user = Users::firstOrCreate(['email_id'=>$to]);
		        $user->otp_number = $otp;
		        $user->save();
            }else{
            	$error['status'] = 'not_match';
            	$error['msg'] = strtoupper("Your Email Address not match");
            }         		
		} catch(\Illuminate\Database\QueryException $ex){
				dd($ex->getMessage());
		} catch(PDOException $ex){
				dd($ex->getMessage());
		}             	
	}else{
		$to = $getpostdata['email_id'];
        
		$content = "Dear <font color='red'><b>".$getpostdata['username'].", </b></font>, <br>The One Time Password (OTP) for your online transaction is ".$otp.". </br></br>Enter the OTP for a secured payment process.</br></br>Your RedCarpet Assist Team.";
		$sendmail->sendEmail("support@redcarpetassist.com",$to,null,null, $subject, $content);
		$error['status'] = 'success';
        $error['msg'] = strtoupper("Check your email for the OTP");
        $user = Users::firstOrCreate(['email_id'=>$to]);
        $user->otp_number = $otp;
        $user->save();
	}
	return json_encode($error);
}

public function ajaxcheckotp(Request $request){
	$getpostdata = $request->all();
	$error = array();
	$data_arr = array();
	//print_r($getpostdata); exit;
	
	if(!empty($getpostdata['uid'])){
		try{
			
			//User Table Check OTP
			$checkotp = Users::where('user_id', '=', $getpostdata['uid'])
                     		->first();
            $data_arr = array('user_id'=>$checkotp->user_id,'otp_number'=>$checkotp->otp_number);
            if(!empty($data_arr['otp_number'])){
            	$error['status'] = 'success';
            	$error['msg'] = strtoupper("Valid OTP");
            	$error['data'] = $data_arr; 
            }else{
            	$error['status'] = 'not_match';
            	$error['msg'] = strtoupper("Invalid OTP");
            	$error['data'] = $data_arr;
            }      			        

		}catch(\Illuminate\Database\QueryException $ex){
				dd($ex->getMessage());
		} catch(PDOException $ex){
				dd($ex->getMessage());
		}
	}

	return json_encode($error);
}

public function ajaxeditotpform(Request $request){
	$getpostdata = $request->all();
	// echo "<pre>";print_r($getpostdata);exit;

	$error = array();
	
	if(!empty($getpostdata['uid']) && !empty($getpostdata['email_id'])){
		try{
			
			//User Table Update
	        $user = Users::firstOrCreate(['user_id'=>$getpostdata['uid']]);
	        $user->email_id = $getpostdata['email_id'];
	        $user->mobile_no = $getpostdata['mobile'];
	        $user->save();

	        //Userleads Table Update
	        $userlead = Userleads::firstOrCreate(['order_id'=>$getpostdata['order_id']]);
	        $userlead->email_id = $getpostdata['email_id'];
	        $userlead->phone_number = $getpostdata['mobile'];
	        $userlead->save();

	        //Applicant Profile Table Update
	        $appprofile = ApplicantProfiles::firstOrCreate(['profile_id'=>$getpostdata['profile_id'],'user_id'=>$getpostdata['uid']]);
	        $appprofile->mobile_number = $getpostdata['mobile'];
	        $appprofile->save();

	        $error['status'] = 'success';
	        $error['msg'] = strtoupper("Updated Record Successfully");
	        $error['data'] = array('email_id'=>$user->email_id,'phone_number'=>$user->mobile_no);

		}catch(\Illuminate\Database\QueryException $ex){
				dd($ex->getMessage());
		} catch(PDOException $ex){
				dd($ex->getMessage());
		}
	}

	return json_encode($error);
}

public function evisabookingpage(Request $request){
	$getrequest = $request->all();
	$getsession = Session::get('track_details');
	// echo "<pre>";print_r($getrequest);exit;

	if(isset($getrequest) && empty($getrequest)){
		$getorderdetails = 	DB::table('order_details')
						->join('users','users.user_id','=','order_details.user_id')
						->join('applicant_profiles','applicant_profiles.order_id','=','order_details.order_id')
						->join('tbl_visa_app_details','tbl_visa_app_details.order_id','=','order_details.order_id')
						->where('order_details.user_id',$getsession['user_id'])
						->where('order_details.order_id',$getsession['order_id'])
						->first();
		// echo "<pre>";print_r($getorderdetails);exit;				
		$getpostdata = array(
		'residing_in'=> !empty($getorderdetails->residing_in)?$getorderdetails->residing_in:NULL,
		'residing_code'=> !empty($getorderdetails->residing_code)?$getorderdetails->residing_code:NULL,
		'nationality'=> !empty($getorderdetails->citizen_to)?$getorderdetails->citizen_to:NULL,
		'order_id'=> !empty($getorderdetails->order_id)?$getorderdetails->order_id:NULL,
		'applicant_id'=> !empty($getorderdetails->profile_id)?$getorderdetails->profile_id:NULL,
		'applicant_number'=> !empty($getorderdetails->order_code)?$getorderdetails->order_code:NULL,
		'uid'=> !empty($getorderdetails->user_id)?$getorderdetails->user_id:NULL,
		'passport_type'=> !empty($getorderdetails->passport_type)?$getorderdetails->passport_type:NULL,
		'order_code'=> !empty($getorderdetails->order_code)?$getorderdetails->order_code:NULL,
		'visa_service'=>!empty($getorderdetails->visa_service)?$getorderdetails->visa_service:NULL,
		'user_name'=>!empty($getorderdetails->username)?$getorderdetails->username:NULL,
		'email_id'=>!empty($getorderdetails->email_id)?$getorderdetails->email_id:NULL,
		'phone_number'=>!empty($getorderdetails->mobile_number)?$getorderdetails->mobile_number:NULL,
		'terms'=>!empty($getorderdetails->terms_policy)?$getorderdetails->terms_policy:NULL,
		'ccode'=> !empty($getorderdetails->typeform_token)?$getorderdetails->typeform_token:NULL
		);
	}else {
		$getpostdata = array(
		'residing_code'=> !empty($getrequest['residing_code'])?$getrequest['residing_code']:NULL,
		'nationality'=> !empty($getrequest['from_country'])?$getrequest['from_country']:NULL,
		'order_id'=> !empty($getrequest['order_id'])?$getrequest['order_id']:NULL,
		'applicant_id'=> !empty($getrequest['applicant_id'])?$getrequest['applicant_id']:NULL,
		'uid'=> !empty($getrequest['uid'])?$getrequest['uid']:NULL,
		'applicant_number'=> !empty($getrequest['applicant_number'])?$getrequest['applicant_number']:NULL,
		'visa_service'=>!empty($getrequest['visa_service'])?$getrequest['visa_service']:NULL,
		'user_name'=>!empty($getrequest['user_name'])?$getrequest['user_name']:NULL,
		'email_id'=>!empty($getrequest['user_email'])?$getrequest['user_email']:NULL,
		'phone_number'=>!empty($getrequest['user_phone'])?$getrequest['user_phone']:NULL,
		'terms'=>!empty($getrequest['terms'])?$getrequest['terms']:NULL,
		'ccode'=> !empty($getrequest['ccode'])?$getrequest['ccode']:NULL
		);
	}


	OrderDetails::where('order_id', $getpostdata['order_id'])
            ->update(['terms_policy'=>$getpostdata['terms']]);

    /* setcookie ("partial_form", 'evisabookingpage', time()+3600*24*(2), '/', "", 0 );
    setcookie ("uid", $getpostdata['uid'], time()+3600*24*(2), '/', "", 0 );
	setcookie ("order_id", $getpostdata['order_id'], time()+3600*24*(2), '/', "", 0 ); */

	UserLeads::where('order_id', $getpostdata['order_id'])
            ->update(['status'=>'Evisa-evisabookingpage']);

    OrderDetails::where('order_id', $getpostdata['order_id'])
            ->update(['applicant_booking_status'=>'Evisa-evisabookingpage']);

	if(!empty($getpostdata['order_id']) && !empty($getpostdata['uid'])){
		$track_data = array(
					'partial_form'=>"evisabookingpage",
            		'order_id'=>$getpostdata['order_id'],
            		'user_id'=>$getpostdata['uid'],
            	);
        Session::put('track_details', $track_data);	
	}	

	$getserviceprice = array();
	$amt_arr = array();
	$total = 0;
	$calprice = 0;
	$getservicesprice = ApplicationserviceDetails::join('applicant_profiles','applicant_profiles.profile_id','=','tbl_user_service_details.applicant_id')
    ->join('order_details','order_details.order_id','=','applicant_profiles.order_id')
    ->join('pricing_master',function($join){
    	$join->on('pricing_master.service_id','=','tbl_user_service_details.service_id')
    		->on('pricing_master.nationality','=','order_details.nationality');	
    })
    ->where('tbl_user_service_details.applicant_id', $getpostdata['applicant_id'])->where('tbl_user_service_details.user_id',$getpostdata['uid'])
         ->get();

    foreach($getservicesprice as $row){
    	$amt_arr = array('amount'=>$row->total_sp_inr_with_gst,'currency'=>$row->currency);
    } 
        
	return view('evisaapplication/evisa-payment',compact('getpostdata','amt_arr'));
}

public function evisapayU(Request $request)
	{
        $getrequest = $request->all();
        // echo "<pre>";print_r($getrequest);exit;
		/*$hash = "";
		$posted['key'] = "WnvQF6Tj";
		$SALT = "CQwuLpS6QW";
		$phone = $posted['phone'] = $getrequest['phone_number'];
		$txnid = $posted['txnid'] = $getrequest['order_id'];
        $amt = $posted['amount'] = $getrequest['amount'];
        $firstname = $posted['firstname'] = $getrequest['username'];
        $email = $posted['email'] = $getrequest['email_id'];
        $productinfo = $posted['productinfo'] = $getrequest['productinfo'];

		$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
          || empty($posted['firstname'])
          || empty($posted['email'])
          || empty($posted['phone'])
          || empty($posted['productinfo'])

        ) {
            echo $formError = 1;
          } else { 
		    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
		    $hashVarsSeq = explode('|', $hashSequence); //print_r($hashVarsSeq);exit;
		    $hash_string = '';  
		    foreach($hashVarsSeq as $hash_var) {
		      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
		      $hash_string .= '|';
		    }

            $hash_string .= $SALT;
            //print_r($hash_string);

            $hash = strtolower(hash('sha512', $hash_string));
            //print_r($hash);
           
          }
//exit;

		return view('evisaapplication/payment_pu',compact('hash','txnid','amt','phone','firstname','email','productinfo'));*/
        $rnd_num = mt_rand(10,100);
		$parameters = [
           	'tid' => $rnd_num,
           	'order_id' => $getrequest['order_id'],
           	'amount' => $getrequest['amount'],
           	//'amount' => '1.00',
        	'billing_name' => $getrequest['username'],
        	'billing_address' => '',
        	'billing_city' => '',
        	'billing_state' => '',
        	'billing_zip' => '',
        	'billing_country' => '',
        	'billing_tel' => $getrequest['phone_number'],
        	'currency' => 'INR',
        	'billing_email' => $getrequest['email_id'],
        	'merchant_param1' => $getrequest['productinfo'],
        
        ];
        $order = Indipay::gateway('CCAvenue')->prepare($parameters);
      return Indipay::process($order);

}

public function paymentcancel(Request $request){
	return view('evisaapplication/payment_cancel');
}

public function paymentfail(Request $request){
	$getrequest = $request->all();
	// echo "<pre>";print_r($getrequest);exit;
	// $response = array(
	// 	'status'=> !empty($getrequest['status'])?$getrequest['status']:NULL,
	// 	'txnid'=> !empty($getrequest['txnid'])?$getrequest['txnid']:NULL,
	// 	'amount'=>!empty($getrequest['amount'])?round($getrequest['amount']):NULL
	// );

	// $orderupdate = OrderDetails::firstOrCreate(['order_id'=>$response['txnid']]);
	// $orderupdate->payment_status = $response['status'];
	// $orderupdate->total_price = $response['amount'];
	// $orderupdate->save();

	return view('evisaapplication/payment_fail');
}

public function paymentsuccess(Request $request){
	Session::flush();
	//$getrequest = $request->all();


//$response = Indipay::response($request);
        //echo "********************************************";
        // For Otherthan Default Gateway
        // $response_cca = Indipay::gateway('CCAvenue')->response($request);
//print_r(array_keys($response)); 
//$status = $response_cca['order_status'];
//print_r($response['order_id']);echo $status;
        //dd($response);



	// echo "<pre>";print_r($getrequest);exit;
	// $response = array(
	// 	'order_date'=>!empty($response_cca['trans_date'])?$response_cca['trans_date']:NULL,
	// 	'firstname'=> !empty($response_cca['billing_name'])?preg_replace("~[^a-z0-9:]~i", " ", $response_cca['billing_name']):NULL,
	// 	'productinfo'=> !empty($response_cca['merchant_param1'])?$response_cca['merchant_param1']:NULL,
	// 	'status'=> !empty($response_cca['order_status'])?$response_cca['order_status']:NULL,
	// 	'txnid'=> !empty($response_cca['order_id'])?$response_cca['order_id']:NULL,
	// 	'amount'=>!empty($response_cca['amount'])?round($response_cca['amount']):NULL
	// );

	// $sendmail = new ApplicationController;
	
	// $orderupdate = OrderDetails::firstOrCreate(['order_id'=>$response_cca['order_id']]);
	// $orderupdate->payment_status = $response_cca['order_status'];
	// $orderupdate->total_price = $response_cca['amount'];
	// $orderupdate->save();

	// $to = $orderupdate['email_id'];
	// $cust_name = $response_cca['billing_name'];
	// $trans_date = $response_cca['trans_date'];
	// $ord_id = $response_cca['order_id'];
	// $py_status = $response_cca['order_status'];
	// $amt = $response_cca['amount'];

	// $content = "Dear $cust_name, <br>Welcome to the RedCarpet Assist family. We would like to thank you for your order. Our team is already processing your details and will be in touch for any additional information required to complete the order. </br> Please find your payment receipt.<br><br><table><tr><th>Transaction date</th><td>$trans_date</td></tr><tr><th>Ref. ID</th><td>$ord_id</td></tr><tr><th>Payment Status</th><td>$py_status</td></tr><tr><th>Amount</th><td>$amt</td></tr></table><br><br>Incase you do need to get in touch with us urgently, please do call us at +91 22 6253 8600 or email us at customercare@redcarpetassist.com. We work Monday to Saturday, 10am to 8pm Indian Standard Time (GMT +5.30)<br><br>Your RedCarpet Assist Team.<br><br><i>Add support@redcarpetassist.com to your address book to ensure that our mails reach your Inbox.</i>";
    /*$content = "Dear $response_cca['billing_name'], <br>Welcome to the RedCarpet Assist family. We would like to thank you for your order. Our team is already processing your details and will be in touch for any additional information required to complete the order.</br>Please find your payment receipt.<br><table><tr><th>Transaction Date</th><td>".$response_cca['trans_date']."</td></tr><tr><th>Ref. ID</th><td>".$response_cca['order_id']."</td></tr><tr><th>Payment Status</th><td>".$response_cca['order_status']."</td></tr><tr><th>Amount</th><td>$response['amount']</td></tr></table><br>In case you do need to get in touch with us urgently, please do call us at +91 22 6253 8600 or email us at customercare@redcarpetassist.com. We work Monday to Saturday, 10 am to 8pm Indian Standard Time (GMT +5.30)<br>Your RedCarpet Assist Team.<br><i>Add support@redcarpetassist.com to your address book to ensure that our mails reach your Inbox.</i>";*/
    //$content = "Test";
 //    $subject ="We are rolling out the RedCarpet for you";
	// $sendmail->sendEmail("support@redcarpetassist.com",$to,null,null, $subject, $content);

	return view('evisaapplication/payment_success');
}

public function ajaxgetcity(Request $request){
	$getrequest = $request->all();
	// echo "<pre>";print_r($getrequest);exit;
	$data = array();
	$result = array();
	if(!empty($getrequest['state_id'])){
		$getcity = DB::table('cities')
					->join('states','states.state_code', '=', 'cities.state_code')
					->where('states.state_id',$getrequest['state_id'])
					->orderby('city_name','ASC')
					->get();
		// echo "<pre>";print_r($getcity);
		if(count($getcity)>0){
			$data['status'] = "found";
			$data['result'] = $getcity;
		}else{
			$data['status'] = "not-found";
			$data['result'] = "Cities Not Found";
		}		
	}else{
		$data['status'] = "fail";
		$data['result'] = "Select First State";
	}

	echo json_encode($data);exit;
}

public function generateOtp()
{
		return $rndno=rand(1000, 9999);
}

public function uploadToApi($target_file, $filetype){
	 $urlArr     = explode("/", $target_file);
	 $r = array();
	 // echo "<pre>";print_r($urlArr);exit;
		$target_dir = "/ocr-upload/";
	 if($filetype != 'png'){
        $pngurl = public_path().$target_dir.$this->generateRandomString().'.png';
         $imageJpg   = imagecreatefromjpeg($target_file);
        imagepng($imageJpg, $pngurl);
    }else{
        $pngurl = $target_file;
    }
    
    $im     = imagecreatefrompng($pngurl);    
    $height = imagesy($im);
    $width  = imagesx($im);
    $im2    = imagecrop($im, ['x' => 0, 'y' => (($height*80)/100) , 'width' => $width, 'height' => $height]); // Take 80% of height for MRZ Code.
    
    if ($im2 !== FALSE) {

        imagefilter($im2, IMG_FILTER_CONTRAST,-100);
        //imagefilter($im2, IMG_FILTER_NEGATE);
        imagepng($im2,$pngurl);
        $a                      = new TesseractOCR($pngurl);
        $data                   = $a->run(); // Use htmlspecialchars function in case process further.
        
        	$is_processed_deleted   = unlink($pngurl);
	        $MRZ                    = new SolidusMRZ();
	        $data                   = $MRZ->parseMRZ($data);
	        // Parse string
	        // $parser = new MrzPardataser();
	        // $travelDocument = $parser->parseString($data);
	        // echo "<pre>";print_r($data);exit;
	        // echo json_encode($data, true);exit;
	        if(isset($data['mrzisvalid']) && $data['mrzisvalid']==1){
	        	if(array_key_exists('error',$data)) {
	            e($r, $data['error']);
		        }else{
		            $country_code = "";
		            $country_id = "";
		            if(!empty($data['nationality']['abbr'])){
		               $country_res = DB::table('countries')
								->where('country_code',$data['nationality']['abbr'])
								->first();		
		               if($country_res != false){
		                 $country_id = $country_res->country_id;
		               }
		            }

		            $data['nationality']['country_id']    = $country_id;
		            $r["message"] = $data;
		            
		        }	
	        }

        return $data;

    }
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
