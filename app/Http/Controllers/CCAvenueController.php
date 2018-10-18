<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Session\Store;
use Softon\Indipay\Facades\Indipay;
use Session;
use App\Models\OrderDetails;

class CCAvenueController extends ApplicationController
{   

    /*public function index()
    {    
        echo "hello";exit;    
        //return view('payWithRazorpay');
    } */
    public function index(Request $request)
    {   
        $getrequest = $request->all();
        // echo "<pre>";print_r($getrequest);exit;
        $order_code = isset($getrequest['order_code'])? $getrequest['order_code']:'';
        $currency = isset($getrequest['currency'])? $getrequest['currency']:'';
        $order_id = isset($getrequest['order_id'])? $getrequest['order_id']:'';
        $amount = isset($getrequest['amount'])? $getrequest['amount']:'';
        $amount = (int)$amount*100;
        $user_name = isset($getrequest['user_name'])? $getrequest['user_name']:'';
        $email_id = isset($getrequest['email_id'])? $getrequest['email_id']:'';
        $phone_number = isset($getrequest['phone_number'])? $getrequest['phone_number']:'';
        $productinfo = isset($getrequest['productinfo'])?$getrequest['productinfo']:NULL;
        $ccode = isset($getrequest['ccode'])?$getrequest['ccode']:NULL;
        //print_r($getrequest);
        //echo "<br>";
        //exit;
        //echo "hello1";exit;    
        return view('ccavenue/payWithCCAvenue',compact('order_code','currency','order_id','amount','user_name','email_id','phone_number','productinfo','ccode'));
    }

    public function ccavenuepayment(Request $request){
        $getrequest = $request->all();

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

    /*public function payment()
    {
        //Input items of form
        $input = Input::all();
        $amount = "";
        $response = array();
        Session::forget('success');
        //get API Configuration 
        $api = new Api(config('custom.razor_key'), config('custom.razor_secret'));
        //Fetch payment information by razorpay_payment_id
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        // echo "<pre>";print_r($payment);exit;
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                // $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));

                $amount = (int)$payment->amount/100;
                $response = array(
                    'order_id'=> !empty($payment->notes['order_id'])?$payment->notes['order_id']:NULL,
                    'order_code'=> !empty($payment->notes['order_code'])?$payment->notes['order_code']:NULL,
                    'order_date'=>!empty($payment->created_at)?date('d M Y', $payment->created_at):NULL,
                    'order_name'=> !empty($payment->notes['username'])?preg_replace("~[^a-z0-9:]~i", " ", $payment->notes['username']):NULL,
                    'order_status'=> !empty($payment->status)?$payment->status:NULL,
                    'txnid'=> !empty($payment->id)?$payment->id:NULL,
                    'amount'=>!empty($amount)?round($amount):NULL,
                    'email_id'=>!empty($payment->email)?$payment->email:NULL,
                    'productinfo'=> !empty($payment->notes['productinfo'])?$payment->notes['productinfo']:NULL,
                    'ccode'=> !empty($payment->notes['ccode'])?$payment->notes['ccode']:NULL,
                    'payment_timestamp'=> date('Y-m-d H:i:s')
                );
                // echo "<pre>";print_r($response);exit;
                $sendmail = new ApplicationController;
                
                $orderupdate = OrderDetails::firstOrCreate(['order_id'=>$response['order_id']]);
                $orderupdate->payment_status = $response['order_status'];
                $orderupdate->total_price = $response['amount'];
                $orderupdate->payment_timestamp = $response['payment_timestamp'];
                $orderupdate->save();

                $to = $response['email_id'];
                $cust_name = $response['order_name'];
                $trans_date = $response['order_date'];
                $ord_id = $response['order_code'];
                $py_status = $response['order_status'];
                $amt = $response['amount'];
                
                $content = "Dear $cust_name, <br>Welcome to the RedCarpet Assist family. We would like to thank you for your order. Our team is already processing your details and will be in touch for any additional information required to complete the order. </br> Please find your payment receipt.<br><br><table><tr><th>Transaction date</th><td>$trans_date</td></tr><tr><th>Ref. ID</th><td>$ord_id</td></tr><tr><th>Payment Status</th><td>$py_status</td></tr><tr><th>Amount</th><td>$amt</td></tr></table><br><br>Incase you do need to get in touch with us urgently, please do call us at +91 22 6253 8600 or email us at customercare@redcarpetassist.com. We work Monday to Saturday, 10am to 8pm Indian Standard Time (GMT +5.30)<br><br>Your RedCarpet Assist Team.<br><br><i>Add support@redcarpetassist.com to your address book to ensure that our mails reach your Inbox.</i>";

                $subject ="We are rolling out the RedCarpet for you";
                $sendmail->sendEmail("support@redcarpetassist.com",$to,null,null, $subject, $content);

                Session::flush(); 

            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }

            //return redirect()->route('payment-success');
        } else{
            //return redirect()->route('payment-fail');
        }

        return view('razorpay/payment',compact('response'));
        
        // \Session::put('success', 'Payment successful, you will receive the invoice in your email.');
        // return redirect()->back();
    }*/

    public function paymentsuccess(Request $request){
        $getrequest = $request->all();
        // $response = Indipay::response($request);
        $response = Indipay::gateway('CCAvenue')->response($request);
        echo "<pre>";print_r($response);exit;
    }

    public function paymentcancel(Request $request){
        $response = Indipay::gateway('CCAvenue')->response($request);
        echo "<pre>";print_r($response);exit;
    }
}