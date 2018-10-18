<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Users;
use Commonfunction;

class ApplicationController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Pages Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "admin functions" for the application.
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
	public function counter()
	{
		$n = 1500; 
	    $cur_time = time(); 
	    $orig_time = strtotime("2018-03-15 12:00:00"); 
		//New Number + difference in minutes (120 seconds for 2 mins) since start time 
		$newn = $n + round(abs($cur_time - $orig_time) / 120,0); 
		// Output New Number 
		//echo $newn; 
		$count = 90000 + round(abs(time() - strtotime("2018-3-15 12:00:00")) / 120,0); 
		//print ' <script type="text/javascript"> var carnr; carnr = "'.$newn.'" console.log(carnr); </script>'; 
		$count_array = str_split($count);
		//print_r($count_array);
		echo "<div class='count_box'>";
		foreach($count_array as $cnt){
			echo "<span class='count'>$cnt</span>";

		}
		echo "</div>";

		//return 'hello';
	}

	public function sendEmail($from, $to, $cc=null, $bcc=null, $subject=null, $bodytext=null){ 
		//echo "hoo";exit;
		$mail = new PHPMailer(true);

		try { 
		    //Server settings
		    $mail->SMTPDebug = 0;                               // Enable verbose debug output
		    $mail->isSMTP();                                    // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'support@redcarpetassist.com';                 // SMTP username
		    $mail->Password = 'Suhas@2017';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

		    //Recipients
		    $mail->setFrom($from, 'RedCarpet Assist Support Team');
		    $mail->AddAddress($to, NULL);     // Add a recipient
		   // $mail->addAddress('ellen@example.com');               // Name is optional
		   // $mail->addReplyTo('info@example.com', 'Information');
			if(!empty($cc)){
				foreach($cc as $email => $name)
				{
				   $mail->addCC($email, $name);
				}
			}
		   	
		   // $mail->addBCC('bcc@example.com');

		    //Attachments
		    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = $subject;
		    $mail->Body    = $bodytext;
		    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    $mail->send();
		    //echo 'Message has been sent';
		} catch (Exception $e) {
		    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}

	public function generateOtp()
	{
		return $rndno=rand(1000, 9999);
	}

	public function sendotp($emailid, $username=NULL, $track=NULL, $applicant_id=NULL){
		//$getpostdata = $request->all();
		//echo "<pre>";print_r($emailid);exit;
		$otp = $this->generateOtp();
		//$sendmail = new ApplicationController;

		$error = array();
		$subject = 'One Time Password for your transaction for Redcarpet Assist Services';
		if(isset($track) && !empty($emailid)){
			try{
				$getorderdetails = OrderDetails::join('users','users.user_id','=','order_details.user_id')
								->where('email_id','=',$emailid)
	                     		->first();
	            //echo "<pre>";print_r($getorderdetails);exit;         		
	            if(!empty($getorderdetails['order_code']) && !empty($emailid)){
	            	$to = $getorderdetails['email_id'];
				    $content = "Hello ".$getorderdetails['username'].", <br>Your OTP is ".$otp."</br>Thank you.<br>Regards,<br>Team RedCarpet Assist";
	            	$this->sendEmail("support@redcarpetassist.com",$to,null,null, $subject, $content);
	            	$error['status'] = 'success';
	            	$error['msg'] = strtoupper("Check your email for the OTP");
	            	$user = Users::firstOrCreate(['email_id'=>$to]);
			        $user->otp_number = $otp;
			        $user->save();
			$error['uid'] = $user->user_id;
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
			$to = $emailid;
	        
			$content = "Dear <font color='red'><b>".$username.", </b></font>, <br>The One Time Password (OTP) for your online transaction is ".$otp.". </br></br>Enter the OTP for a secured payment process.</br></br>Your RedCarpet Assist Team.";
			$this->sendEmail("support@redcarpetassist.com",$to,null,null, $subject, $content);
			$error['status'] = 'success';
	        $error['msg'] = strtoupper("Check your email for the OTP");
	        $user = Users::firstOrCreate(['email_id'=>$to]);
	        $user->otp_number = $otp;
		$user->username = $username;
	        $user->save();
		$error['uid'] = $user->user_id;
		}
		return json_encode($error);
	}

	public function ajaxhandler(Request $request){
		$getrequest = $request->all();
		$country_arr = array();
		$passtype_arr = array();
		
		if($getrequest['method'] == "ajax_get_display_country_list"){
			$getcountry = Commonfunction::ajax_get_display_country_list();
			if(!empty($getrequest)){
				foreach($getrequest as $key=>$val){
						$country_arr = array();
				}
			}
				echo "<pre>";print_r($getcountry);
		}
		
		if($getrequest['method'] == "ajax_get_display_passport_type_list"){
			$getpasstype = Commonfunction::ajax_get_display_passport_type_list();
				echo "<pre>";print_r($getpasstype);
		}
		
		exit;
	}
}
