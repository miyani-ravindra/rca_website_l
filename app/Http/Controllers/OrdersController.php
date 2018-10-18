<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\PricingMaster;
use App\Models\Users;
use App\Models\OrderDetails;
use App\Models\ProductMaster;
use App\Models\ApplicantProfiles;
use App\Models\ApplicantTypes;
use App\Models\DocumentDetails;
use DB;
use Response;
use Session;

class OrdersController extends ApplicationController {

	public function orderReview(Request $request)
	{
        $orderId = $request->input('submit_val');
        $order_qry = OrderDetails::where('order_id', '=', $orderId)
                     ->get()->first();
        $prod_qry = ProductMaster::where('product_id', '=', $order_qry->product_id)
                     ->get()->first();
        $product_name = $prod_qry->product_name;
        $product_validity = $prod_qry->product_validity;
        $price_qry = PricingMaster::where('product_id', '=', $order_qry->product_id)
                     ->get()->first();
        $adult_price = $price_qry->price;
        $child_price = $price_qry->price;
		//$orderId = session('order', '2');
		return view('orders/review',compact('order_qry','product_name','product_validity','adult_price','child_price'));
	}

	public function generateOtp()
	{
		return $rndno=rand(1000, 9999);
	}

	public function payU(Request $request)
	{
        $orderId = $request->input('submit_val');
        $order_qry = OrderDetails::where('order_id', '=', $orderId)
                     ->get()->first();
        $user_qry = Users::where('user_id', '=', $order_qry->user_id)
                     ->get()->first();
        $prod_qry = ProductMaster::where('product_id', '=', $order_qry->product_id)
                     ->get()->first();
        $product_name = $prod_qry->product_name;
		$hash = "";
		$posted['key'] = "WnvQF6Tj";
		$SALT = "CQwuLpS6QW";
		$phone = $posted['phone'] = $user_qry->mobile_no;
		$txnid = $posted['txnid'] = $order_qry->order_id;
        $amt = $posted['amount'] = $order_qry->total_price;
        $firstname = $posted['firstname'] = $user_qry->username;
        $email = $posted['email'] = $user_qry->email_id;
        $productinfo = $posted['productinfo'] = $product_name;

		echo $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
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
            // print_r($hash_string);

            // echo "<br>".$hash = strtolower(hash('sha512', $hash_string));
            // print_r($hash);
            $hash = strtolower(hash('sha512', $hash_string));
           
          }
//exit;

		return view('orders/payment_pu',compact('hash','txnid','amt','phone','firstname','email','productinfo'));
	}

	public function receipt(Request $request)
	{
		/*$status = $request->input('status');
		$firstname = $request->input('firstname');
		$amount = $request->input('amount');
		$txnid = $request->input('txnid');
		$posted_hash = $request->input('hash');
		$key = $request->input('key');
		$productinfo = $request->input('productinfo');
		$email = $request->input('email');
		$salt = "CQwuLpS6QW";

		// Salt should be same Post Request 

		If (!empty($request->input('additionalCharges'))) {
		    $additionalCharges = $request->input('additionalCharges');
		    $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
		} else {
		    $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
        }

		$hash = hash("sha512", $retHashSeq);
        if ($hash != $posted_hash) {
	       $this->transactionFailed($request);
		} else {
          /*echo "<h3>Thank You. Your order status is ". $status .".</h3>";
          echo "<h4>Your Transaction ID for this transaction is ".$txnid.".</h4>";
          echo "<h4>We have received a payment of Rs. " . $amount . ". Your order will soon be shipped.</h4>";*/
          $otp = $this->generateOtp();
          $otp_entry = new Users;
          $otp_entry_qry = Users::where('email_id', '=', 'smitha@thewhiteboard.company')->update(['otp_number' => $otp]);
          $to = 'smitha@thewhiteboard.company';
          $subject = 'RedCarpet Assist - OTP';
          $content = "Hello Smitha, <br>Your OTP for Visa booking confirmation is $otp</br>Thank you.<br>Regards,<br>Team RedCarpet Assist";
          //$sendEmail = (new ApplicationController)->sendEmail($to, $subject, $content);
          return view('orders/receipt',compact('status', 'txnid','amount'));
		//}
	}

	public function transactionFailed(Request $request)
	{   //echo "Invalid Transaction. Please try again!!";
		$status=$request->input('status');
		$firstname=$request->input('firstname');
		$amount=$request->input('amount');
		$txnid=$request->input('txnid');

		$posted_hash=$request->input('hash');
		$key=$request->input('key');
		$productinfo=$request->input('productinfo');
		$email=$request->input('email');
		$salt="CQwuLpS6QW";

		// Salt should be same Post Request 

		If (!empty($request->input('additionalCharges'))) {
		    $additionalCharges=$request->input('additionalCharges');
		    $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
	    } else {
	        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
	    }
		$hash = hash("sha512", $retHashSeq);
	  
	    if ($hash != $posted_hash) {
	      //echo "Invalid Transaction. Please try again";
	      return view('orders/trans_failed');
	    } else {
	      /*echo "<h3>Your order status is ". $status .".</h3>";
          echo "<h4>Your transaction id for this transaction is ".$txnid.". You may try making the payment by clicking the link below.</h4>";*/
          return view('orders/trans_failed');
        } 
		
	}

	public function verifyOtp()
	{
		$otp = $this->myAccount();
	}

	public function myAccount(Request $request)
	{
		$getrequest = $request->all();
		// $uid = OrderDetails::max('user_id');
		// $uid = 140;
		$uid = session('user_id');
		// $user_id = session('user_id');
		// $email_id = session('email_id');
		// echo $uid;exit;
		try{
			$getuserbyid = DB::table('users')
						->where('user_id',$uid)
						->first();
			$getorderbyuid = DB::table('order_details')
						->join('product_master','product_master.product_id','=','order_details.product_id')
						->where('user_id',$uid)
						->orderby('order_code','created_at', 'DESC')
						->get();

			$getliveorder = DB::table('order_details')
						->join('product_master','product_master.product_id','=','order_details.product_id')
						->where('user_id',$uid)
						->where('created_at', '>=', date('Y-m-d').' 00:00:00')
						->orderby('order_code','created_at', 'DESC')
						->get();
			$getpreviousorder = DB::table('order_details')
						->join('product_master','product_master.product_id','=','order_details.product_id')
						->where('user_id',$uid)
						->where('created_at', '<=', date('Y-m-d').' 00:00:00')
						->orderby('order_code','created_at', 'DESC')
						->get();						

			$getcurrentorder = 	DB::table('order_details')
						->join('product_master','product_master.product_id','=','order_details.product_id')
						->where('user_id',$uid)
						->where('created_at', '>=', date('Y-m-d').' 00:00:00')
						->orderby('order_code','created_at', 'DESC')
						->first();

			$getapplicantstatus = ApplicantProfiles::query()
						->leftJoin('passport_details as ppd','ppd.applicant_id','=','applicant_profiles.profile_id')
						->leftJoin('document_details as docd','docd.applicant_id','=','applicant_profiles.profile_id')
						->where('applicant_profiles.user_id',$uid)
						->where('applicant_profiles.created_at', '>=', date('Y-m-d').' 00:00:00')
						->get([
							'applicant_profiles.*',
							'ppd.pp_id',
							'ppd.user_id as uid',
							'ppd.applicant_id as appid',
							'ppd.pp_no',
							'ppd.pp_type',
							'ppd.pp_issue_date',
							'ppd.pp_expiry_date',
							'ppd.pp_issuing_govt',
							'ppd.pp_place_of_issue',
							'ppd.pp_isactive',
							'ppd.created_at as created_pp',
							'ppd.updated_at as updated_pp',
							'docd.doc_id',
							'docd.user_id as doc_user_id',
							'docd.applicant_id as doc_app_id',
							'docd.doc_type'
						]);					

		} catch(\Illuminate\Database\QueryException $ex){
			dd($ex->getMessage());
		} catch(PDOException $ex){
			dd($ex->getMessage());
		}

		// echo "<pre>";print_r($getapplicantstatus);exit;

		return view('orders/my_account', ['getuser'=>$getuserbyid, 'no_of_booking'=>count($getorderbyuid), 'getliveorder'=>$getliveorder, 'getpreviousorder'=>$getpreviousorder, 'getcurrentorder'=>$getcurrentorder, 'getappstatus'=>$getapplicantstatus]);
	}

	public function travellerDocs(Request $request)
	{
		$getrequest = $request->all();
		//echo "<pre>";print_r($getrequest);exit;
		try{
			$getuserbyid = DB::table('users')
						->where('user_id',$getrequest['uid'])
						->first();
						
			$getorderdetails = 	DB::table('order_details')
						->join('product_master','product_master.product_id','=','order_details.product_id')
						->join('countries','countries.country_id','=','order_details.nationality')
						->where('user_id',$getrequest['uid'])
						->where('order_id', $getrequest['oid'])
						->first();

			$getapplicatdata = ApplicantProfiles::query()
												->leftJoin('passport_details as ppd','ppd.applicant_id','=','applicant_profiles.profile_id')
												->where('applicant_profiles.user_id',$getrequest['uid'])
												->get([
													'applicant_profiles.*',
													'ppd.pp_id',
													'ppd.user_id as uid',
													'ppd.applicant_id as appid',
													'ppd.pp_no',
													'ppd.pp_type',
													'ppd.pp_issue_date',
													'ppd.pp_expiry_date',
													'ppd.pp_issuing_govt',
													'ppd.pp_place_of_issue',
													'ppd.pp_isactive',
													'ppd.created_at as created_pp',
													'ppd.updated_at as updated_pp'
												]);

			$getpassporttype = DB::table('passport_types')->get();
			$getcountry = DB::table('countries')->get();
			$getpropfession = DB::table('professions')->get();
			$getmarital = DB::table('marital_status')->get();
			$getlang = DB::table('languages')->get();
			$getreligion = DB::table('religions')->get();

			$docdata = array();
			foreach($getapplicatdata as $key=>$val){
				$getdocdetails = DocumentDetails::where('user_id',$getrequest['uid'])->where('applicant_id',$val->profile_id)->get();
				foreach($getdocdetails as $value){
					$docdata[$value->doc_type][] = $value;	
				}
				
			}
			
			// echo "<pre>";print_r($docdata);exit;		

		} catch(\Illuminate\Database\QueryException $ex){
			dd($ex->getMessage());
		} catch(PDOException $ex){
			dd($ex->getMessage());
		}

		// echo "<pre>";print_r($getorderdetails);exit;

		return view('orders/documents',  ['getuser'=>$getuserbyid, 'getorderdetails'=>$getorderdetails, 'getapplicant'=>$getapplicatdata, 'docdata'=>$docdata, 'getpasstype'=>$getpassporttype,'getcountry'=>$getcountry,'getpropfession'=>$getpropfession,'getmarital'=>$getmarital,'getlang'=>$getlang,'getreligion'=>$getreligion]);
	}

	public function application(Request $request)
	{
		$getrequest = $request->all();
		// echo "<pre>";print_r($getrequest);exit;
		try{
			$getuserbyid = DB::table('users')
						->where('user_id',$getrequest['uid'])
						->first();
						
			$getorderdetails = 	DB::table('order_details')
						->join('product_master','product_master.product_id','=','order_details.product_id')
						->join('countries','countries.country_id','=','order_details.nationality')
						->where('user_id',$getrequest['uid'])
						->where('order_id', $getrequest['oid'])
						->first();

			// $getapplicatdata = DB::table('applicant_profiles')
			// 			// ->leftJoin('passport_details','passport_details.applicant_id','=','applicant_profiles.profile_id')
			// 			->where('applicant_profiles.user_id',$getrequest['uid'])
			// 			->get();

			$getapplicatdata = ApplicantProfiles::query()
						->leftJoin('passport_details as ppd','ppd.applicant_id','=','applicant_profiles.profile_id')
						->where('applicant_profiles.user_id',$getrequest['uid'])
						->get([
							'applicant_profiles.*',
							'ppd.pp_id',
							'ppd.user_id as uid',
							'ppd.applicant_id as appid',
							'ppd.pp_no',
							'ppd.pp_type',
							'ppd.pp_issue_date',
							'ppd.pp_expiry_date',
							'ppd.pp_issuing_govt',
							'ppd.pp_place_of_issue',
							'ppd.pp_isactive',
							'ppd.created_at as created_pp',
							'ppd.updated_at as updated_pp'
						]);
						
			$getpassporttype = DB::table('passport_types')->get();
			$getcountry = DB::table('countries')->get();
			$getpropfession = DB::table('professions')->get();
			$getmarital = DB::table('marital_status')->get();
			$getlang = DB::table('languages')->get();
			$getreligion = DB::table('religions')->get();

		} catch(\Illuminate\Database\QueryException $ex){
			dd($ex->getMessage());
		} catch(PDOException $ex){
			dd($ex->getMessage());
		}

		// echo "<pre>";print_r($getapplicatdata);exit;

		return view('orders/application',  ['getuser'=>$getuserbyid, 'getorderdetails'=>$getorderdetails, 'getapplicant'=>$getapplicatdata, 'getpasstype'=>$getpassporttype,'getcountry'=>$getcountry,'getpropfession'=>$getpropfession,'getmarital'=>$getmarital,'getlang'=>$getlang,'getreligion'=>$getreligion]);
	}

	public function ajaxgetorderdetails(Request $request){
		$getrequest = $request->all();
		// echo "<pre>";print_r($getrequest);exit;
		try{
			
			$getorderdetails = 	DB::table('order_details')
						->join('product_master','product_master.product_id','=','order_details.product_id')
						->join('countries','countries.country_id','=','order_details.nationality')
						->where('user_id',$getrequest['uid'])
						->where('order_id', $getrequest['oid'])
						->first();

			// $getapplicatdata = DB::table('applicant_profiles')
			// 			// ->leftJoin('passport_details','passport_details.applicant_id','=','applicant_profiles.profile_id')
			// 			->where('applicant_profiles.user_id',$getrequest['uid'])
			// 			->get();

			$getapplicantstatus = ApplicantProfiles::query()
						->leftJoin('passport_details as ppd','ppd.applicant_id','=','applicant_profiles.profile_id')
						->leftJoin('document_details as docd','docd.applicant_id','=','applicant_profiles.profile_id')
						->where('applicant_profiles.user_id',$getrequest['uid'])
						->where('applicant_profiles.order_id',$getrequest['oid'])
						->get([
							'applicant_profiles.*',
							'ppd.pp_id',
							'ppd.user_id as uid',
							'ppd.applicant_id as appid',
							'ppd.pp_no',
							'ppd.pp_type',
							'ppd.pp_issue_date',
							'ppd.pp_expiry_date',
							'ppd.pp_issuing_govt',
							'ppd.pp_place_of_issue',
							'ppd.pp_isactive',
							'ppd.created_at as created_pp',
							'ppd.updated_at as updated_pp',
							'docd.doc_id',
							'docd.user_id as doc_user_id',
							'docd.applicant_id as doc_app_id',
							'docd.doc_type'
						]);

		} catch(\Illuminate\Database\QueryException $ex){
			dd($ex->getMessage());
		} catch(PDOException $ex){
			dd($ex->getMessage());
		}

		// echo "<pre>";print_r($getapplicantstatus);exit;
		return Response::json(['orddetails'=>$getorderdetails,'getappstatus'=>$getapplicantstatus]);
	}

	public function ajaxeditaccount(Request $request){
		$getrequest = $request->all();
		// echo "<pre>";print_r($getrequest);exit;
		$formatdate = str_replace("/", "-", $getrequest['traveldate']);
		$traveldate = date('Y-m-d H:i:s', strtotime($formatdate));
		$error = array();

		try{
	       
	       	//Edit User Details Start
			$uid = Users::findOrFail($getrequest['uid']);
			$uid->mobile_no = $getrequest['phone'];
			$uid->save();
			//Edit User Details End

			//Edit Order Details Start
			$order = OrderDetails::findOrFail($getrequest['oid']);
			$order->travel_date = $traveldate;
			$order->save();
			//Edit Order Details End

			$error['status'] = "success";
			$error['msg'] = "Edit Record Successful";
	    }
	    catch(\Exception $e){
	       // do task when error
	       echo $e->getMessage();   // insert query
	       	
	       	$error['status'] = "fail";
			$error['msg'] = "Edit Record fail";
	    }

		return json_encode($error);	    		
	}

	public function ajaxapplicant(Request $request){
		$getrequest = $request->all();
		// echo "<pre>";print_r($getrequest);exit;
		$user = Users::findOrFail($getrequest['uid']);
		$order = OrderDetails::findOrFail($getrequest['oid']);
		
		$data_arr = array(
					'order_id'=>$order->order_id,
					'user_id'=>$order->user_id,
					'username'=>$user->username,
					'mobile_number'=>$user->mobile_no,
					'nationality'=>$user->nationality,
					'country'=>$order->nationality,
					'adult'=>$order->adult,
					'child'=>$order->child,
					'infant'=>$order->infant
		);

		$adult_arr = array();
		$child_arr = array();
		$infant_arr = array();
		$error = array();

		$existid = ApplicantProfiles::where('user_id', $getrequest['uid'])->first();
		// echo "<pre>";print_r($existid);exit;
		if(empty($existid)){
			// print_r($data_arr);exit;
			if($data_arr['adult']>0){
				$applicant_type = ApplicantTypes::where('applicant_type_desc',"ADULT")->first();
				for($i=1;$i<=$data_arr['adult'];$i++){
					$adult_arr[] = array(
						'user_id' => $data_arr['user_id'],
						'mobile_number' => NULL,
						'nationality' => $data_arr['nationality'],
						'country' => $data_arr['country'],
						'order_id' => $data_arr['order_id'],
						'applicant_type_id'=> $applicant_type->applicant_type_id

					);
				}
			}

			if($data_arr['child']>0){
				$applicant_type = ApplicantTypes::where('applicant_type_desc',"CHILD")->first();
				for($j=1;$j<=$data_arr['child'];$j++){

					$child_arr[] = array(
						'user_id' => $data_arr['user_id'],
						'mobile_number' => NULL,
						'nationality' => $data_arr['nationality'],
						'country' => $data_arr['country'],
						'order_id' => $data_arr['order_id'],
						'applicant_type_id'=> $applicant_type->applicant_type_id
					);
				}
			}

			$mergearr = array_merge($adult_arr,$child_arr);
			$i = 1;
			foreach ($mergearr as $key => $value) {
				# code...
				$saveadult = new ApplicantProfiles;

				$saveadult->user_id = $value['user_id'];
				$saveadult->username = "Applicant-".$i;
				$saveadult->mobile_number = NULL;
				$saveadult->nationality = $value['nationality'];
				$saveadult->country = $value['country'];
				$saveadult->order_id = $value['order_id'];
				$saveadult->applicant_type_id = $value['applicant_type_id'];

				$saveadult->save();
				
				$i++;		
			}
					
			$error['status'] = "success";
		}

		return json_encode($error);
		
	}

	public function ajaxapplicationsave(Request $request){
		// echo "<pre>";print_r($request->all());exit;

		$getrequest = $request->all();

		$pass_data = array(
			'user_id'=>$getrequest['user_id'],
			'applicant_id'=>$getrequest['app_id'],
			'pp_no'=>$getrequest['passport'],
			'pp_type'=>$getrequest['pass_type'],
			'pp_expiry_date'=>$getrequest['dob_exp'],
			'pp_issuing_govt'=>$getrequest['pass_issue'],
		);
		// echo "<pre>";print_r($pass_data);exit;
		$ppid = DB::table('passport_details')
    		->insertGetId(
            	['user_id'=>$pass_data['user_id'],'applicant_id'=>$pass_data['applicant_id'],'pp_no' => $pass_data['pp_no'], 'pp_type'=>$pass_data['pp_type'], 'pp_expiry_date'=> $pass_data['pp_expiry_date'], 'pp_issuing_govt'=> $pass_data['pp_issuing_govt']]
    	);

    	if($ppid){
    		ApplicantProfiles::where('profile_id', $getrequest['app_id'])
            ->where('user_id', $getrequest['user_id'])
            ->update(['surname'=>$getrequest['surname'],'passport_detail_id'=>$ppid,'nationality'=>$getrequest['nation'],'gender' => $getrequest['gender'], 'dob'=>$getrequest['dob'], 'place_of_birth'=> $getrequest['place_birth'], 'marital_status_id'=> $getrequest['marital_status'],'religion'=>$getrequest['religion'],'language'=>$getrequest['lang'],'profession'=>$getrequest['profession'],'father_name'=>$getrequest['f_name'],'mother_name'=>$getrequest['m_name'],'husband_name'=>$getrequest['h_name'],'address1'=>$getrequest['add1'],'address2'=>$getrequest['add2'],'city'=>$getrequest['city'],'country'=>$getrequest['country'],'is_submitted'=>"Y"]);
    	}

    	return 	json_encode(array('status'=>'success','msg'=>'Application Submitted'));

		
	}

	public function ajaxfileUpload(Request $request)

	{

		$getrequest = $request->all();
		// echo "<pre>";print_r($getrequest['file']);exit;
	    $validator = Validator::make($getrequest,
                [
                    'file' => 'image',
                ],
                [
                    'file.image' => 'The file must be an image (jpeg, png, bmp, gif, or svg)'
                ]);
            if ($validator->fails())
                return array(
                    'fail' => true,
                    'errors' => $validator->errors()
                );


	    $image = $request->file('file');
	    // echo "<pre>";print_r($image);exit;
	    $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
	    $imgsize = $image->getClientSize();
	    $imgtype = $image->getClientMimeType();

	    $destinationPath = public_path('doc-upload/');
	    
	    $request->file('file')->move($destinationPath, $input['imagename']);

	    $savedocdetails = DocumentDetails::firstOrNew(array('doc_id'=>''));

	    $savedocdetails->user_id = $getrequest['user_id'];
	    $savedocdetails->applicant_id = $getrequest['applicat_id'];
	    $savedocdetails->doc_type = $getrequest['doc_type'];
	    $savedocdetails->doc_size = $imgsize;
	    $savedocdetails->doc_url = "/doc-upload/".$input['imagename'];
	    $savedocdetails->doc_mime_type = $imgtype;

	    $savedocdetails->save();

	    return json_encode(array('doc_url'=>$destinationPath.$input['imagename']));

	}

}
?>