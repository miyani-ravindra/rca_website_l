<?php
//$url = "http://ec2-13-127-58-60.ap-south-1.compute.amazonaws.com/service/v4_1/rest.php";
//$username = "user";
//$password = "PxGkOItHjwa6";
$url = "http://crm.redcarpetassist.com/service/v4_1/rest.php";
$username = "ram";
$password = "Ram@123";
$lead_id = $_REQUEST['lead_id'];
date_default_timezone_set('Asia/Kolkata');

//function to make cURL request
function call($method, $parameters, $url) {
    ob_start();
    $curl_request = curl_init();
    curl_setopt($curl_request, CURLOPT_URL, $url);
    curl_setopt($curl_request, CURLOPT_POST, 1);
    curl_setopt($curl_request, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
    curl_setopt($curl_request, CURLOPT_HEADER, 1);
    curl_setopt($curl_request, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl_request, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_request, CURLOPT_FOLLOWLOCATION, 0);

    $jsonEncodedData = json_encode($parameters);

    $post = array(
        "method" => $method,
        "input_type" => "JSON",
        "response_type" => "JSON",
        "rest_data" => $jsonEncodedData
    );

    curl_setopt($curl_request, CURLOPT_POSTFIELDS, $post);
    $result = curl_exec($curl_request);
    curl_close($curl_request);

    $result = explode("\r\n\r\n", $result, 2);
    $response = json_decode($result[1]);
    ob_end_flush();

    return $response;
}

//login --------------------------------------------- 

$login_parameters = array(
        "user_auth" => array(
        "user_name" => $username,
        "password" => md5($password),
        "version" => "1"
    ),
    "application_name" => "RestTest",
    "name_value_list" => array(),
);

$login_result = call("login", $login_parameters, $url);

//get session id
$session_id = $login_result->id;

//get list of records --------------------------------   
$get_entry_list_parameters = array(
    //session id
    'session' => $session_id,
    //The name of the module from which to retrieve records
    'module_name' => 'Leads',
    //The SQL WHERE clause without the word "where".
    'query' => "leads.id = '".$lead_id."'",
    //The SQL ORDER BY clause without the phrase "order by". 
    'order_by' => "",
    //The record offset from which to start.
    'offset' => '0',
    //Optional. A list of fields to include in the results.
    'select_fields' => array(
        'id', 'first_name', 'last_name', 'phone_mobile', 'tncaccepted_c', 'acceptance_date_c', 'ipaddress_c' , 'phone_work', 'acceptance_date_c', 'ipaddress_c', 'tnc_accepted_c', 'date_modified', 'travel_date_c', 'service_type_c', 'no_pax_c', 'payu_url_c', 'emaillink_c', 'email_link_c', 'email_addresses', 'price_c',
    ),
    /*
      A list of link names and the fields to be returned for each link name.
      Example: 'link_name_to_fields_array' => array(array('name' => 'email_addresses', 'value' => array('id', 'email_address', 'opt_out', 'primary_address')))
     */
    'link_name_to_fields_array' => array(
        array('name' => 'email_addresses', 'value' => array('email_address'))
    ),
    //The maximum number of results to return.
    'max_results' => '1000',
    //To exclude deleted records
    'deleted' => '0',
    //If only records marked as favorites should be returned.
    'favorites' => false,
);
$get_entry_list_result = call('get_entry_list', $get_entry_list_parameters, $url);
print_r($get_entry_list_result);
$entry = $get_entry_list_result->entry_list[0]->name_value_list;
$email = $get_entry_list_result->relationship_list[0]->link_list[0]->records[0]->link_value->email_address->value;

$acceptance_date_c = $entry->acceptance_date_c->value;
$tnc_accepted_c = $entry->tnc_accepted_c->value;
$ipaddress_c = $entry->ipaddress_c->value;

$fname = $entry->first_name->value;
$lname = $entry->last_name->value;
$mobile = $entry->phone_mobile->value;
$phone = $entry->phone_work->value;
$visa_type = $entry->service_type_c->value;
$booking_date = date('d M Y | H:i',strtotime($entry->date_modified->value));
$travel_date = date('d M Y',strtotime($entry->travel_date_c->value));
$quantity = $entry->no_pax_c->value;
$payurl = $entry->payu_url_c->value;
$price = $entry->price_c->value;
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$agentname = str_replace("+"," ",$_REQUEST['user']);

$servername = 'rca-live.cj1mucjfpe4z.ap-south-1.rds.amazonaws.com';
$username = "rca_dev";
$password = "devrca!23";

$link = mysql_connect($servername, $username, $password);
//mysql_select_db('n48d3693542711', $link);
mysql_select_db('rca_v3', $link);

$sql = "select agent_email from crm_agents_emails where agent_name = '".$agentname."'";
$row = mysql_fetch_assoc(mysql_query($sql));
$agentemail = $row['agent_email'];

if(isset($_REQUEST) && ($_REQUEST['user'] <> '')){
    if(($price == '') || ($payurl == '')){
        echo "Price and PayU url cant be blank";
    }else{
        $current_url = explode("?", $actual_link);
        
        $msg  = "<html><head>";
        $msg .= "<meta http-equiv='Content-Type' content='text/html;charset=ISO-8859-1'>";
        $msg .= "<meta http-equiv='Content-Type'  content='text/html charset=UTF-8' />";
        $msg .= "</head><body>";
        $msg .= "Dear $fname $lname,";
        $msg .= "<br/><br/>";
        $msg .= "Greetings from RedCarpet Assist!";
        $msg .= "<br/><br/>";
        $msg .= "Further to our conversation, the visa charge for <b>$visa_type (Single Entry) for $quantity passengers is INR $price/-</b>. Please see below the payment link for your reference.";
        $msg .= "<br/><br/>";
        $msg .= "Payment Link:";
        $msg .= "<br/>";
        $msg .= "<a href='".$current_url[0]."?lead_id=".$_REQUEST['lead_id']."'>".$current_url[0]."?lead_id=".$_REQUEST['lead_id']."</a>";
        $msg .= "<br/><br/>";
        $msg .= "Below is the list of documents required for processing visa:";
        $msg .= "<ul style='list-style-type:decimal;'>
                   <li>Coloured Passport copies, confirmed departure and return tickets and passport size colour photograph</li>
                   <li>Address Proof (Any 1: recent bill- Electricity, Gas, Phone bill). Rent / Lease agreement if rented accommodation</li>
                   <li>Employment details such as recent salary slips or identity card. For business proof you may send us your business details such as visiting card (Not applicable if family is traveling)</li>
                </ul>";
        $msg .= "Feel free to revert for any further clarifications";
        $msg .= "<br/><br/>";
        $msg .= "At your service";
        $msg .= "<br/><br/>";
        $msg .= "Regards,";
        $msg .= "<br/><br/>";
        $msg .= "$agentname Sales <span style='color:red'>Executive </span>RedCarpet<span style='color:red'> Assist</span>";
        $msg .= "<br/>";
        $msg .= "India <span style='color:red'>+91 222 4815901 / WhatsApp - 9920991360</span>  (Monday to Saturday &#45; 10am to 8pm)";
        $msg .= "<br/>";
        $msg .= $agentemail. "  <a href='http://redcarpetassist.com/'>www.RedCarpet<span style='color:red'>Assist.com</span></a>";
        $msg .= "<br/>";
        $msg .= "UAE <span style='color:red'>Visas</span>. Ahlan Meet <span style='color:red'>& Greet</span>. Ahlan <span style='color:red'>Lounges</span>. Dubai International <span style='color:red'>Hotels</span>. Timeless <span style='color:red'>Spa</span>";
        $msg .= "<br/>";
        $msg .= "<span style='color:red; text-decoration: underline;'>UAE Visa starting &#8377;3700 only.</span>";
        $msg .= "</boby></html>";

        $to = $email;
        
        $body = $msg;
        
        require 'PHPMailer/class.phpmailer.php';

       /* try {
                $mail = new PHPMailer(true); //New instance, with exceptions enabled
                $mail->charSet = "UTF-8";
                $body = $msg;

                $mail->IsSMTP();                        // tell the class to use SMTP
                $mail->SMTPAuth   = true;                  // enable SMTP authentication
                $mail->Port       = 25;                 // set the SMTP server port
                
                $mail->Host = "smtp.sendgrid.net";
                $mail->Username = "apikey";
                $mail->Password = "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";
                $mail->IsSendmail();  // tell the class to use Sendmail
                $mail->setFrom('support@redcarpetassist.com', 'RedCarpetAssist');
                
                $mail->AddReplyTo("$agentemail","$agentname");

                $mail->From       = "support@redcarpetassist.com";
                $mail->FromName   = "RedCarpetAssist";
                
                $mail->AddAddress("$email","$fname");
                $mail->AddCC("$agentemail","$agentname");
                $mail->AddCC("suhas@redcarpetassist.com","Suhas");
                // $mail->AddBCC("archana@redcarpetassist.com","Archana");
                $mail->AddBCC("parinaz@redcarpetassist.com","Parinaz");
 		$mail->AddBCC("ram@redcarpetassist.com","Ram");
                //$mail->AddBCC("dipali@thewhiteboard.company","Dipali");
               // $mail->AddBCC("dipali912@gmail.com","Dipali Gmail");
//                $mail->AddBCC("ram@thewhiteboard.company","Ram");

                $mail->Subject  = "Payment Link for Visa Charges";

//                $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                $mail->WordWrap   = 80; // set word wrap
                
                $mail->IsHTML(true); // send as HTML

                $mail->MsgHTML($body);

                if($mail->Send()){
                    $myfile = fopen("crmemaillog.txt", "a") or die("Unable to open file!");
                    $txt = "Email has been sent to $fname".", "."$email - date ". date('Y-m-d H:i:s').";";
                    fwrite($myfile, $txt);
                    fclose($myfile);
                    header('Location:thankupage.php'); 
                }                              
        } catch (phpmailerException $e) {
                echo $e->errorMessage();
        }*/
    }
}else{
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="img/favicon.ico" type="image/png" sizes="16x16">
    <title>Dubai Visa | Dubai Airport Meet and Assist, Lounge and Spa Services - RedCarpet Assist</title>
    <meta name="description" content="Now with RedCarpet Assist, applying for UAE Visa online is so easy. Booking Dubai airport's Spa Lounge or Meet and Assist service is under your fingertip. Visit Now!" />
    <meta name="keywords" content="" />
    <meta name="author" content="RedCarpetAssist" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/order.css">
    <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
   <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->
    <link rel="canonical" href="http://www.redcarpetassist.com/" />
    <script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-86924453-1', 'auto');
    ga('send', 'pageview');
    </script>
    <!-- Hotjar Tracking Code for www.RedCarpetAssist.com -->
    <script>
    (function(h, o, t, j, a, r) {
        h.hj = h.hj || function() {
            (h.hj.q = h.hj.q || []).push(arguments)
        };
        h._hjSettings = { hjid: 684189, hjsv: 6 };
        a = o.getElementsByTagName('head')[0];
        r = o.createElement('script');
        r.async = 1;
        r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
        a.appendChild(r);
    })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
</head>
<body>
    <div class="body">
        <div class="order_bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="_topbar">
                            <img src="img/logo.png" alt="RedCarpet Assist – Dubai Visa and Airport Services" width="110" class="_logo_bg" title="" />
                            <span><img src="img/phone.svg" class="hidden-xs" alt="Call RedCarpet Assist for Dubai Visa" /> +91 22 2481 5901</span>
                            <span><img src="img/env.svg" class="hidden-xs" alt="Email to RedCarpet Assist for Dubai Visa" /> &nbsp;customercare@redcarpetassist.com</span>
                        </div>
                        <div class="_toptext">
                            <h2>Order Review</h2>
                            <p>Please review your order once before proceeding to payment.</p>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="order-summary">
                            <span class="circle-left"></span>
                            <span class="circle-right"></span>
                            <h3 class="order_heading">India to Dubai Visa</h3>
                            <div class="row padding_auto">
                                <div class="col-md-4 col-xs-12">
                                    <div class="customer_info">
                                        <p>NAME</p>
                                        <p class="md"><?php echo $fname." ".$lname; ?></p>
                                    </div>
                                    <div class="customer_info">
                                        <p>EMAIL</p>
                                        <p class="md"><?php echo $email; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xs-6">
                                    <div class="customer_info">
                                        <p>MOBILE NUMBER</p>
                                        <p class="md"><?php echo $phone; ?></p>
                                    </div>
                                    <div class="customer_info">
                                        <p>VISA TYPE</p>
                                        <p class="md"><?php echo $visa_type; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="_price">
                                        <p>PRICE</p>
                                        <h3><i class="fa fa-rupee"></i><?php echo $price; ?></h3>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-12">
                                    <hr class="hr" />
                                </div>
                                <div class="col-md-4">
                                    <div class="customer_info">
                                        <p>TRAVEL DATE</p>
                                        <p class="md"><?php echo $travel_date; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="customer_info">
                                        <p>BOOKING DATE</p>
                                        <p class="md"><?php echo $booking_date; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="customer_info">
                                        <p>QUANTITY</p>
                                        <p class="md"><?php echo $quantity ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action="" method="POST">
            <div class="container marginb50">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8 col-md-offset-2">
                        <div class="terms_check">
                            <input type="checkbox" name="agree" id="agree" class="checkbox">
                            <label for="agree">I agree to the RedCarpet Terms &amp; Conditions</label>
                        </div>
                        <div class="_proceed">
                            <button id="proceed" type="button" onclick="proceedpayment('<?php echo $payurl; ?>','<?php echo $lead_id ?>');" class="_btn btn_disable" disabled="disabled">PROCEED TO PAYMENT</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>    
        <div class="container">
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <hr class="fw" />
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <h6>ABOUT REDCARPET ASSIST</h6>
                            <p>Travelling is one of the great pleasures of life. Few can resist the lure of new experiences and interesting new people to meet. Getting from where you are to where you’d like to go isn’t usually considered part of this experience. But at RedCarpet Assist we endeavour to make the act of travelling to your destination a memory that you’ll carry with you.</p>
                        </div>
                        <div class="col-md-3 col-md-offset-1 col-sm-4">
                            <div class="row">
                                <div class="col-md-3"><img src="img/headphones.svg" width="66" height="76" class="headset" alt="Call RedCarpet Assist for Dubai Visa" title="" /></div>
                                <div class="col-md-9">
                                    <h6>CALL NOW</h6>
                                    <h2>+91 22 2481 5901</h2>
                                    <p>Mon - Sat 10:00AM to 08:00PM
                                    <br /> customercare@redcarpetassist.com</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-md-offset-1 col-sm-4">
                            <div class="row">
                                <div class="col-md-11 col-md-offset-1">
                                    <h6>COMPANY</h6>
                                    <ul class="footer-element">
                                        <li><a href="#dubai_visa" title="Dubai Visas">Dubai Visas</a></li>
                                        <li><a href="#mna">Meet &amp; Assist</a></li>
                                        <li><a href="#lounge">Lounges</a></li>
                                        <li><a href="#timeless_spa">Timeless Spa</a></li>
                                        <li><a href="http://blog.redcarpetassist.com/" target="new">Blog</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <hr class="fw" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Copyright 2017 &copy; RedCarpet Assist. All rights reserved.</p>
                        </div>
                        <div class="col-md-6">
                            <div class="_social">
                                <a href="https://search.google.com/local/writereview?placeid=ChIJa8Zsi4fO5zsR0NO-3bWTr-I" target="new"><img src="img/review_google.png" alt="" width="100"></a>
                                <a href="https://www.facebook.com/pg/redcarpetassist/reviews/" target="new"><img src="img/review_facebook.png" alt="" width="100"></a>
                                <span class="clear"></span>
                                <a href="https://www.facebook.com/redcarpetassist" target="new"><img src="img/facebook.svg" alt="RedCarpet Assist on Facebook" width="30"></a>
                                <a href="https://twitter.com/redcarpetassist" target="new"><img src="img/tweeter.svg" alt=" RedCarpet Assist on Twitter" width="30"></a>
                                <a href="https://plus.google.com/101055084440227648223"><img src="img/G+plus.svg" alt="RedCarpet Assist on Google Plus" width="30"></a>
                                <a href="https://in.linkedin.com/company/redcarpet-assist" target="new"><img src="img/linkedin.svg" alt="RedCarpet Assist on linkedin" width="30"></a>
                                <a href="https://www.instagram.com/redcarpetassist" target="new"><img src="img/instagram.svg" alt="RedCarpet Assist on instagram" width="30"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- body -->
    <div class="modal fade" id="terms_modal" tabindex="-1" role="dialog" aria-hidden="false" data-backdrop="static">
        <div class="modal-dialog terms_body">
            <div class="modal-content">
                <div class="modal-body">
                    <a href="#" class="_close" data-dismiss="modal">
                        <img src="img/close-icon.svg" alt="" width="15" />
                    </a>
                    <div style="margin-bottom: 50px;">
                        <h2 class="text-center">TERMS &amp; CONDITIONS</h2>
                        <ul class="_terms_body">
                            <strong>Visa Disclaimer</strong>
                            <li>Issuance and approval of a visa is solely regulated by Government of Dubai / and governed by Their rules and regulations that are applicable from time to time. Subject to the applicant/passenger fulfilling the eligibility conditions, RCA will sponsor the applicant to Dubai.</li>
                            <li>The Visa fees as levied to the applicants are non-refundable under any circumstances whatsoever.</li>
                            <li>96hrs visas are specifically applicable to applicants transiting through Dubai Airport. Applicant should hold a confirmed ticket to an onward destination and not returning to point of origin.</li>
                            <li>Ok To Board (OTB) is an airline requirement. Few airline charge fees for updating OTB on PNR. These charges are in addition to VISA fee. There is no certificate provided for okay to board as it is updated on your Airline PNR. Customer can further call their respective Airline and get the confirmation from them. Okay to board take approximately 24 to 48 working hours to get updated on your airline PNR.</li>
                            <li> RCA’s role is confined to collecting and forwarding the visa application and required documentation from the applicants and forward the same along with the application to the Government of Dubai / DNRD for their consideration regarding the issuance of visa and thereafter communicating the Government of Dubai’s / DNRD’s Decision pertaining to the application in respect of the visa to the applicants.</li>
                            <li>The Applicant/passenger will be required to submit valid passport and necessary documentation requested by the RCA along with the applicable visa fees. Applicants must hold valid travel documents and comply with the requirements of Government of Dubai / DNRD and requirements specified on the Visa Application Form.</li>
                            <li> The decision to grant or refuse a visa is the sole prerogative of the Government of Dubai / DNRD. RCA merely collects and forwards the applications to the Government of Dubai / DNRD for their decision. The issuance or pendency or refusal of the visa applications is the prerogative of the Government of Dubai / DNRD. The decision of the Government of Dubai / DNRD is final. In case of rejection of visa application, no correspondence will be entertained and no visa fees will be refunded and no reasons will be required to be given by RCA. It is clarified that if the processing of the visa application is prevented, delayed, restricted or interfered with for any reasons whatsoever resulting in delay/ Government of Dubai / DNRD being unable to process the applicants visa application, then RCA shall not be liable to the applicant for any loss or damage which may be suffered as result of such causes and RCA will not be liable for the same and shall be discharged of all its obligations hereunder.</li>
                            <li>Issuance of a visa or approval on the visa application does not in any way give the applicant/passenger a right to enter Dubai. The entry is at the sole discretion of the Immigration officer at Dubai Airport who is a representative of Government of Dubai / DNRD. In case of denial of visa or entry into Dubai by the Government of Dubai / DNRD, RCA or its Fulfilment Partner will in no way be liable to the applicant in any manner whatsoever.</li>
                            <li> When the Visa application of the Applicants is approved by the Government of Dubai / DNRD ,it is the applicants sole responsibility to take the hard copy of the approved visa at the time of travel as it is to be submitted to Dubai authorities at the time of arrival in Dubai</li>
                            <li>The visa is required to be valid as per the Government of Dubai / DNRD rules and regulations as amended from time to time. The visa in order to be considered as valid must be availed within its period of validity.</li>
                            <li>Applicants will be solely responsible to ensure that they fulfil their own/residing country Governments and Dubai Government’s eligibility criteria/ requirements for travel which may include Police clearances etc.</li>
                            <li>RCA shall take all reasonable measures to ensure that information provided by the Applicants in its application form shall remain confidential. However, RCA shall not be liable for any unauthorized access by any means to that information.</li>
                            <li> The Applicant agrees to indemnify and hold RCA and its Fulfilment Partner, its officers, directors,agents, subsidiaries, clients, joint venture partners and employees, harmless from any claim, expense, loss, damages or demand, including reasonable attorney’s fees, incurred or sustained by RCA and / or its officers, directors, agents, subsidiaries, clients, joint venture partners and employees arising out of the breach of these terms and conditions by the Applicant and / or any act of omission or commission attributable to the Applicant (or) violation by the Applicant of any law of any country or the rights of a third party.</li>
                            <li>In no event and under no circumstances shall RCA, its Fulfilment Partner and/or its representatives be liable for any direct, indirect, punitive, incidental, special, consequential damages or any damages whatsoever to anyone.</li>
                            <li>RCA reserves the right to add, alter or vary these terms and conditions at any time without notice or liability and all applicants availing of this facility shall be bound by the same.</li>
                            <li>Security Deposit refundable on return (hereinafter referred to as “Security deposit”) in the form of a Demand draft / Pay Order shall be paid by the Applicants applying for Visa in certain cases. The Security deposit is returned to the Applicants upon their return to India, once they show the entry and exit stamp of Dubai. However, in the event the Applicant does not collect the security deposit within a period of 30 days from the date of expiry of his/her visa, the said security deposit will be banked.</li>
                            <li>Visa processing time is 24 - 48 workings hours. In case the travel date is beyond 10 days, the application will be processed 7 days prior to the travel date. </li>
                            <li>If you have not opted out of receiving marketing materials, we may also use your personal information to identify other products and services that might be of interest to you and to market additional goods, services and special offers from us, our affiliates or our third-party business associates. You can choose not to allow RCA to use or disclose your personal information for marketing purposes by indicating your preference on the visa application form.</li>
                            <li>We are required to ask for a copy of the Aadhar card/MTNL bill/Electricity bill/ OR office visiting card as an additional verification document to avoid any absconding cases.</li>
                            <li> In case of a group (2 or more passengers), the person enquiring for visa should be one of the travelling passengers</li>
                            <strong>Terms and Conditions</strong>
                            <p>The following Terms and Conditions govern the provision of services by Red Carpet Assist (from here on will be referred to as RCA) and its Fulfilment Partner form an integral part of the contract between the individual initiating the booking, the Passenger, RCA and its Fulfilment Partner.</p>
                            <li>RCA Meet and Assist Service is available only to passengers that are arriving at the Dubai International Airport through Immigration in Terminal 1 and Terminal 3 only. It is not available for:
                                <ul class="__inner">
                                    <li>Passengers arriving at Terminal 2</li>
                                    <li>Passengers arriving in Dubai World Central (DWC)</li>
                                    <li>Passengers departing Dubai</li>
                                </ul>
                            </li>
                            <li>The request for the provision of Meet and Greet Service is processed exclusively for the benefit of the Passenger/s for whom it has been booked and under no circumstances can be transferred or endorsed to another Passenger/s.</li>
                            <li>The request for the provision of services is valid only in respect of the date and flight number shown on the reservation form and subsequent booking confirmation. Any changes in the date and flight information should be advised to RCA not less than 4 working hours prior to the commencement of the services required.</li>
                            <li>Reservations for the provision of RCA service except for visas and Spa should be made at least 4 working hours in advance. Spa reservations should be made at least 8 working hours in advance</li>
                            <li> RCA will not accept any liabilities for refunds and/or claims that are not made within 21 days from the date of the service provision.</li>
                            <li>5% VAT is applicable and will be collected on Visa charges, Meet and Greet Services, Lounge Services and Spa Services</li>
                            <li> All requests for refunds and/or claims should be made via email to email ID customercare@redcarpetassist.com</li>
                            <li> Spa service is available only to passengers on transit to Dubai International Airport.</li>
                            <li>To guarantee a spa treatment, reservation should be made at least 8 working hours in advance. We suggest that you book a treatment at least 30 minutes after you land to allow for delays and walking time.</li>
                            <li> RCA or its SPA Fulfilment Partner will not be held liable for guests who miss their onward flights. It is the responsibility of all passengers to ensure they board their flights within the specified time. Please note that boarding gate closes 25 min prior to departure time.</li>
                            <li> It is imperative that you advise us of your outbound flight details so that the reservation is made to the spa closest to your boarding gate.</li>
                            <li>We encourage you to arrive in the spa at least 15 minutes prior to your appointment time to start off a relaxing journey. Late arrival may result to shortening of treatment time.</li>
                            <li>Upon your arrival at the Spa, Receptionist will confirm your spa treatment request. You will then be completing a medical consultation form for health and safety reasons. Kindly note that guests who had undergone medical surgery in last six months, guests under the influence of alcohol and pregnant women are not allowed to have a massage therapy.</li>
                            <li>Your privacy is protected at all times; therefore, your spa therapist leaves you to change in private, and throughout the treatment, you are draped with towels, covering untreated areas.</li>
                            <li>To ensure that all guests can enjoy the serene atmosphere within the spa, we request that guests keep noise level to minimum, and refrain from carrying mobile phones and other electronic devices.</li>
                            <li>RCA or its SPA Fulfilment Partner cannot accept responsibility for any lost or stolen items. We recommend not wearing any valuables whilst enjoying the spa services.</li>
                            <li>RCA or its Fulfilment Partner is in no way liable nor responsible for any loss suffered by the Passenger as a result of its actions in an effort to provide the service required and/or any third parties, including without limitation, the Customs or Immigration authorities at the Dubai International Airport. Passengers availing of the services unconditionally agree to release RCA and its Fulfilment Partner from any liability or responsibility as a result on any delay whilst the services requested are being delivered</li>
                            <li>RCA or its Fulfilment Partner is in no way liable or responsible if the Passenger fails to comply with government regulations upon entry to Dubai. It is the Passenger’s sole responsibility to ensure that all documentation required for entry in to Dubai is in order and that any conditions to which such documents are subject to, are complied with.</li>
                            <li>RCA’s Fulfilment Partner will retrieve the Passenger’s baggage from the baggage carousels but in no way be held liable or responsible for wrong items of baggage being retrieved. It is the passenger’s sole responsibility to identify and confirm to the Fulfilment Partner’s representative that the pieces of baggage retrieved belongs to him/her and no baggage has been missed prior to completing customs formalities and exiting Dubai International Airport.</li>
                            <li>All payments will be processed in AED only and the INR price is just an indicative price. Actual prices may vary.</li>
                            <li> RedCarpet Assist may ask for additional documents for further verification and have the right to reject the application even after the payment is successful. In a scenario where an application is rejected during the RedCarpet Assist verification process, a cancellation charge of INR 250/- per applicant will be applicable. Remaining amount will be refunded to the applicant within 5 to 7 working days to the original method of payment</li>
                            <strong>Cancellation &amp; Amendment Policy</strong>
                            <p>Should you wish to cancel any of our services (except Visa), the request should be made via calling our Contact Centre or via email to customercare@redcarpetassist.com. Please note a nominal fee of INR 250 per person will be applicable for each change or cancellation.</p>
                            <strong>Document Verification</strong>
                            <p>If customer is unable to provide additional required documentation for visa application, RCA will be unable to process the application to the UAE Immigration’s. In such a situation, there will be a cancellation penalty of INR 250/- per passenger and the remaining amount will be refunded to the original method of payment. Refund will be credited to your account within 5 to 7 working days.</p>
                            <strong>Express Visa</strong>
                            <li>Express Visa service helps the client to acquire the Visa in 2 to 24 working hours of time, by making an additional payment of AED 100 (approximately INR 1800/-). This payment will be collected from the customer once RCA receives the copy from the UAE Immigrations. Once the client makes the additional payment of AED 100 (approximately INR 1800/-), RCA will release the visa copy to the client. Friday and Saturday are non-working day for UAE Immigration’s.</li>
                            <li>The express visa if applied for will be processed within 2 to 24 working hours, subject to the application being complete, documentation in order, successful payment, Terms and conditions acceptance and all other requisite information correctly and provided accurately is provided by the client.</li>
                            <strong>Meet &amp; Assist and Lounge</strong>
                            <li>Amendment can be made 4 working hours before the commencement of the service.</li>
                            <li>Customer can cancel the service up to 8 working hours before the service at ZERO charge. Within 8 working hours it will be considered as ‘No Show’ and there will be no refund.</li>
                            <strong>Spa</strong>
                            <li>To cancel or reschedule your appointment at the Spa, please allow 48 working hours’ notice.</li>
                            <p>Reservations cancelled within 48 hours will be refunded to the credit card used for the booking. Cancellation within 6 hours will incur a 40% charge. No Show and will be charged in full.</p>
                            <strong>Visa</strong>
                            <li> Visa once applied cannot be cancelled.</li>
                            <strong>Privacy Policy</strong>
                            <p>Red Carpet Assist is committed to respecting your privacy and protecting your personal information. We recognize our obligation to keep sensitive information secure and have created this statement to share and explain the current information management practices on our websites.</p>
                            <p>Handling of all personal information by RCA is governed by the UAE and Dubai privacy and security acts. We are committed to protecting your privacy whether you are browsing for information or conducting business electronically.</p>
                            <p>Purpose of collection, use, disclosure etc. of Personal Information</p>
                            <p>Applicants may be required to provide certain information pertaining to them such as name, photograph, address, date of birth, telephone number, passport information, birth certificate, income, citizenship status, marital status, employment details, criminal and educational background information etc. This information is collected as per the requirement mandated by the UAE Mission</p>
                            <p>Such personal information may be collected, used or disclosed in order to facilitate the processing of visa application(s) and/or request(s) including but not limited to for the following purposes:</p>
                            <li>Process visa applications, permits and travel documents etc. and perform various tasks/ functions related thereto.</li>
                            <li>Respond to various inquiries on the visa application submission process in general.</li>
                            <li>Respond to various inquiries regarding status of application made with RCA</li>
                            <li>Provide/ offer any other services as per requirements of the UAE Mission</li>
                            <p>For the quality control purposes the interaction/s with user/s may be recorded. In such cases the user/s will be informed of this practice and purpose at the start of any such interaction.</p>
                            <strong>Changes to This Privacy Policy</strong>
                            <p>Please be advised that the Privacy Policy may be updated from time to time and Users/ Applicants to regularly visit RCA website to access the latest policy statement.</p>
                            <strong>Disclosures of Personal Information</strong>
                            <p>RCA will not trade, rent or sell personal information of the Applicants. Personal Information will be used only for the purposes of providing services and performing its various obligations.<br>However RCA may need to disclose and share Personal Information when it is necessary to comply with a court order, any on-going judicial proceeding or other legal, statutory or regulatory process served on RCA or to exercise the legal rights or defend against legal claims, criminal investigations, judicial matters or in prevention, investigation, detection, prosecution of criminal activities or matters related to national security.</p>
                            <strong>Cookies</strong>
                            <p>Cookies are files or pieces of information that may be stored on system or internet enabled devices of the User, when the User visits the website/s of Red Carpet Assist. RCA uses cookies to make the website simpler to use. RCA cannot identify the User personally from this information.</p>
                            <p>RCA website offers certain features that are only available through the use of cookies. The cookies help website users and maintain their signed-in status.</p>
                            <p>Most cookies are “session cookies,” meaning that they are automatically deleted from website user’s hard drive at the end of a session when the applicant/user exits the website. However "Persistent cookies" remain in place across multiple visits to our websites.</p>
                            <p>Applicant/ website user may encounter cookies from any links of third parties on certain pages of the website that RCA does not control.</p>
                            <p>Once a User accesses RCA website, User consents to use of cookies by RCA. If User does not agree to use of cookies, User should not use the RCA website. If the cookies are disabled, it may impact the User experience on the RCA website.</p>
                            <strong>Spam</strong>
                            <li>RCA website or communication tools shall not be used to send spam or otherwise send content that would violate the terms and conditions of RCA user agreement.</li>
                            <li>RCA filters and automatically scans messages for viruses and other illegal or prohibited content before they are sent.</li>
                            <li>RCA does not permanently store email messages sent to or by it through various formats. RCA does not rent or sell any email addresses to third parties.</li>
                            <li>A user/users is/are not licensed, permitted, expected to add, modify, deface, hack, misuse or abuse RCA website or the contents therein.</li>
                            <span>Security</span>
                            <p>RCA has implemented measures designed to help protect personal information in its custody and control. RCA maintains reasonable administrative, technical, physical and organizational safeguards in an effort to protect personal information in its custody and control. However RCA shall not be liable for unlawful access, use, modification, destruction, destruction or interceptions by unauthorized persons.</p>
                            <strong>Retention and Destruction of Personal Information</strong>
                            <p>For the purposes of assisting the Applicants should they contact RCA with follow-up queries, Applicant personal information may be retained in electronic form. RCA performs secure disposal or destruction of personal information on the equipment or devices used for storing personal information. When disposing of equipment or devices used for storing personal information (such as filing cabinets, computers, diskettes, and audio tapes), RCA takes appropriate measures such as to removal or deletion of any stored information to prevent access by unauthorized parties.</p>
                            <strong>Legal</strong>
                            <p>RCA and its Fulfilment Partner/s may provide personal information in response to a search warrant or other legally valid inquiry pursuant to contravention of law / order or to an investigative body or as otherwise required or permitted by applicable law RCA may also disclose personal information where necessary for the establishment, exercise or a defence of legal claims, or as otherwise permitted by law.</p>
                            <strong>Third Party Links</strong>
                            <p>RCA website may contain links to other/ third party sites promoting various products and/or services that RCA does not own or operate. These links to websites are in nature of paid advertising are not verified by RCA. These links are provided for convenience access to these links is voluntary and does not indicate that RCA endorses or is associated with any of these other third party websites. Users are requested to use their own discretion which dealing with these websites and neither RCA nor its officers, employees, agents shall have any responsibility or liability of any nature whatsoever for these other third party websites or any information contained in them. These linked websites have their own separate and independent privacy statements, notices and terms of use, which Users are recommended to carefully review the same. RCA does not have any control over such third party websites, and therefore shall have no liability or responsibility their personal information practices.</p>
                            <strong>To Personal Information</strong>
                            <p>Please note that disclosure of personal information is voluntary. The Applicants / Users disclosing personal information shall be deemed to have read and understood this Privacy Policy and consents to use and disclosure of the personal information as provided in this Privacy Policy. The Applicants / Users have right to withdraw their consent prior to further disclosure of the personal information by RCA to the Diplomatic Missions / Governments and/ or relevant Visa Offices or other third parties.</p>
                            <p>RCA shall not be responsible to ascertain authenticity or accuracy of the information provided by the Applicant. It shall be the duty of the Applicant to ensure that the information provided to RCA is accurate, complete and up to date.</p>
                            <strong>Payment Security</strong>
                            <p>All payments that happen on RCA site are secure. Our Website is secure using 128-bit secure socket layer (SSL) encryption provided by network solutions. We do not capture any data pertaining to credit or debit card details on our site. The clients for all online payments are taken to the acquiring bank’s payment gateway site for completion of the transaction. The credit card or debit card information is not stored in any retrieval system or storage system of RCA.</p>
                        </ul>
                        <div class="agree_stack">
                            <button type="button" class="_btn _btn_active center-block" data-dismiss="modal">I AGREE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="http://www.redcarpetassist.com/rca-cdn/js/jquery-library.js"></script>
    <script src="js/bootstrap.js"></script>
    <script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 872561385;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
    <noscript>
        <div style="display:inline;">
            <img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/872561385/?guid=ON&amp;script=0" />
        </div>
    </noscript>
    <script type="text/javascript">
    $(document).ready(function($) {
        $(function() {
            function reposition() {
                var modal = $(this),
                    dialog = modal.find('.modal-dialog');
                modal.css('display', 'block');
                // Dividing by two centers the modal exactly, but dividing by three 
                // or four works better for larger screens.
                dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
            }
            // Reposition when a modal is shown
            $('.modal').on('show.bs.modal', reposition);
            // Reposition when the window is resized
            $(window).on('resize', function() {
                $('.modal:visible').each(reposition);
            });
        });
        $('.terms_check input[type="checkbox"]').on('change', function(e) {
            if (e.target.checked) {
                $('#terms_modal').modal();
                $('#proceed').addClass("_btn_active");
                $('#proceed').prop('disabled', false);
            } else {
                $('#proceed').removeClass("_btn_active");
                $('#proceed').prop('disabled', true);
            }
        });
        $("._close").click(function() {
            $('.terms_check input[type="checkbox"]').prop('checked', false);
            $('#proceed').removeClass("_btn_active");
            $('#proceed').prop('disabled', true);
        });
    });
    
    function proceedpayment(url,lead_id){
        $.ajax({ url: 'ajaxtncaccept.php',
            data: {lead_id: lead_id},
            type: 'post',
            success: function(output) {
                window.location.href = url;
            }
        });
    }
    </script>
</body>
</html>    
<?php } ?>
