<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');
Route::get('/', 'PagesController@index');

Route::get('home', 'HomeController@index');

// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);

Route::get('about', 'PagesController@about');
Route::get('testimonial', 'PagesController@testimonial');
Route::get('meet-and-assist', 'PagesController@meetAndAssist');
Route::get('lounge', 'PagesController@lounge');
Route::get('faq', 'PagesController@faq');
Route::get('contact', 'PagesController@contact');
Route::get('30-days-dubai-visa', 'PagesController@visa_30_days');
Route::get('90-days-dubai-visa', 'PagesController@visa_90_days');
Route::get('96-hours-transit-dubai-visa', 'PagesController@visa_96_hrs');
Route::get('14-days-dubai-visa', 'PagesController@visa_14_days');

Route::get('terms-and-conditions', 'PagesController@termsAndConditions');
Route::get('privacy-policy', 'PagesController@privacyPolicy');
Route::get('application/counter', 'ApplicationController@counter');
Route::post('contact-submit', 'PagesController@contact_submit');

Route::get('application/email', 'ApplicationController@sendEmail');
Route::post('sendlead', 'ApplicationController@send_leadfrm_ab');
Route::match(['get', 'post'],'ajaxhandler', 'ApplicationController@ajaxhandler');

Route::post('ajaxopenproduct/{id}', 'PagesController@ajaxopenproduct');
Route::post('ajaxgetairline', 'PagesController@ajaxgetairline');
Route::post('ajaxgetcountry', 'PagesController@ajaxgetcountry');
Route::post('ajaxgetcountrybyname', 'PagesController@ajaxgetcountrybyname');
Route::post('ajaxsubmitdata', 'PagesController@ajaxsubmitdata');
Route::post('ajaxgetproductprice', 'PagesController@ajaxgetproductprice');

Route::post('orders/review', 'OrdersController@orderReview');
Route::get('generate-otp', 'OrdersController@generate_otp');

Route::post('orders/payment', 'OrdersController@payU');
Route::get('orders/receipt', 'OrdersController@receipt');
Route::get('orders/transaction-failed', 'OrdersController@transactionFailed');
Route::get('orders/my-account', 'OrdersController@myAccount');
Route::post('orders/documents', 'OrdersController@travellerDocs');
Route::post('orders/application', 'OrdersController@application');
Route::post('orders/ajaxeditaccount', 'OrdersController@ajaxeditaccount');
Route::post('orders/ajaxapplicant', 'OrdersController@ajaxapplicant');
Route::match(['get', 'post'], 'orders/ajaxfileUpload', 'OrdersController@ajaxfileUpload');
Route::match(['get', 'post'], 'orders/ajaxapplicationsave', 'OrdersController@ajaxapplicationsave');
Route::match(['get', 'post'], 'orders/ajaxgetorderdetails', 'OrdersController@ajaxgetorderdetails');
// route to show the login form
Route::get('login', array('uses' => 'PagesController@showLogin'));
Route::get('logout', array('uses' => 'PagesController@logout'));

// route to process the form
Route::post('login', array('uses' => 'PagesController@attemptLogin'));

Route::match(['get', 'post'], 'sign-up', 'PagesController@userregister');

// Password Reset Routes...
Route::get('password-reset', 'PagesController@resetformshow');
Route::post('password-reset', 'PagesController@sendPasswordResetToken');
Route::get('reset-password/{token}', 'PagesController@showPasswordResetForm');
Route::post('reset-password/{token}', 'PagesController@resetPassword');

//************************************Evisa URL***************************************//
Route::post('india-visa-application/{ccode}', 'IndiaEvisaapplicationController@visaapplication');
Route::match(['get', 'post'],'apply-online/{ccode}', 'IndiaEvisaapplicationController@applyonline');
Route::match(['get', 'post'],'evisa-type/{ccode}', 'IndiaEvisaapplicationController@saveevisaapplication');
Route::match(['get', 'post'],'evisa-form/basic-details/{ccode}', 'IndiaEvisaapplicationController@evisaapplicationform');
Route::match(['get', 'post'],'evisa-form/family-details/{ccode}', 'IndiaEvisaapplicationController@evisaapplicationfamily');
Route::match(['get', 'post'],'evisa/visa-details/{ccode}', 'IndiaEvisaapplicationController@evisaapplicationdetails');
Route::match(['get', 'post'], 'evisa/service-document/{ccode}', 'IndiaEvisaapplicationController@evisaservicedocument');
Route::match(['get', 'post'], 'ajaxgetcity', 'EvisaapplicationController@ajaxgetcity');
Route::match(['get', 'post'],'evisa/verifymail', 'IndiaEvisaapplicationController@verifymail');
Route::match(['get', 'post'], 'sendotp', 'ApplicationController@sendotp');
Route::match(['get', 'post'], 'evisa/ajaxsendotp', 'EvisaapplicationController@ajaxsendotp');
Route::match(['get', 'post'],'evisa/payment', 'IndiaEvisaapplicationController@evisabookingpage');
Route::match(['get', 'post'],'evisa/payment-pu', 'EvisaapplicationController@evisapayU');
Route::match(['get', 'post'], 'payment-fail', 'EvisaapplicationController@paymentfail');
Route::match(['get', 'post'], 'payment-cancel', 'EvisaapplicationController@paymentcancel');
Route::match(['get', 'post'], 'evisa/completeform', 'IndiaEvisaapplicationController@applicationtrack');
Route::match(['get', 'post'], 'checksession', 'EvisaapplicationController@checksession');
Route::match(['get', 'post'], 'payment-success', ['as' => 'payment_verify', 'uses'=>'EvisaapplicationController@paymentsuccess']);
Route::match(['get', 'post'], 'evisa/to/{ccode}', 'HongKongapplicationController@evisahongkongform');
Route::match(['get', 'post'], 'basic-details/{ccode}', 'HongKongapplicationController@hongkongbasicdetails');
Route::match(['get', 'post'], 'evisa/savehktypeformdata', 'EvisaapplicationController@savehktypeformdata');
Route::match(['get', 'post'], 'ajaxautosavedata', 'HongKongapplicationController@ajaxautosavedata');

Route::match(['get', 'post'], 'typeformwebhookapi', 'EvisaapplicationController@typeformwebhookapi');
Route::match(['get', 'post'], 'formreview/to/{ccode}', 'HongKongapplicationController@savetypeformdata');
Route::match(['get', 'post'], 'hongkongreview/{ordid}', 'HongKongapplicationController@hongkongreviewform');
Route::match(['get', 'post'], 'ajaxeditotpform', 'EvisaapplicationController@ajaxeditotpform');
Route::match(['get', 'post'], 'ajaxcheckotp', 'EvisaapplicationController@ajaxcheckotp');
Route::match(['get', 'post'], 'sendabandonsmail', 'EvisaapplicationController@sendabandonsmail');
Route::match(['get', 'post'],'evisa/review/ind/{ordid}', 'IndiaEvisaapplicationController@reviewindia');

//************************************Meet and Assist***************************************//
Route::post('Meetnassist/step2', 'MeetnassistController@step2');
Route::post('Meetnassist/step3', 'MeetnassistController@step3');
Route::get('Meetnassist/ajaxAddService/{service_id}', 'MeetnassistController@ajaxAddService');
Route::post('Meetnassist/confirm', 'MeetnassistController@confirm');
Route::post('Meetnassist/userForm', 'MeetnassistController@userForm');
Route::get('Meetnassist/receipt', 'MeetnassistController@receipt');
Route::post('Meetnassist/payment', 'MeetnassistController@payment');
Route::post('Meetnassist/ccavenue', 'MeetnassistController@requestCCAvenue');

//************************************Lounge***************************************//
Route::post('Lounge/step2', 'LoungeController@step2');
Route::post('Lounge/step3', 'LoungeController@step3');
Route::get('Lounge/ajaxAddService/{service_id}', 'LoungeController@ajaxAddService');
Route::post('Lounge/confirm', 'LoungeController@confirm');
Route::post('Lounge/userForm', 'LoungeController@userForm');
Route::get('Lounge/receipt', 'LoungeController@receipt');
Route::post('Lounge/ccavenue', 'LoungeController@requestCCAvenue');

//************************************Landing Pages***************************************//
Route::match(['get', 'post'], 'cambodia', 'PagesController@lpcambodia');
Route::match(['get', 'post'], 'hong-kong', 'PagesController@lphongkong');
Route::match(['get', 'post'], 'malaysia', 'PagesController@lpmalaysia');
Route::match(['get', 'post'], 'srilanka', 'PagesController@lpsrilanka');
Route::match(['get', 'post'], 'turkey', 'PagesController@lpturkey');
Route::match(['get', 'post'], 'vietnam', 'PagesController@lpvietnam');
Route::match(['get', 'post'], 'oman', 'PagesController@lpoman');
Route::match(['get', 'post'], 'uae', 'PagesController@lpuae');
Route::match(['get', 'post'], 'singapore', 'PagesController@lpsingapore');

Route::get('Meetnassist/ccavenue', 'MeetnassistController@requestCCAvenue');
Route::post('Meetnassist/res', 'MeetnassistController@responseCCAvenue');


Route::match(['get', 'post'],'Razorpay/index', 'RazorpayController@index');
//Route::get('Razorpay/paywithrazorpay', 'RazorpayController@payWithRazorpay');
Route::match(['get', 'post'],'Razorpay/payment', 'RazorpayController@payment');
Route::get('payment-link', 'RazorpayController@crm_payment_link');

/*CCAvenue Payment Getway*/
Route::match(['get', 'post'],'CCAvenue/payment', 'CCAvenueController@index');
Route::match(['get', 'post'],'ccavenue-payment', 'CCAvenueController@ccavenuepayment');
Route::match(['get', 'post'],'CCAvenue/payment-success', 'CCAvenueController@paymentsuccess');
Route::match(['get', 'post'],'CCAvenue/payment-cancel', 'CCAvenueController@paymentcancel');

Route::get('get_all_country', 'PagesController@get_all_country');//RCAS-2
Route::get('get_all_cities_by_country_code/{country_code}', 'PagesController@get_all_cities_by_country_code');//RCAS-2
Route::get('get_all_country_for_lounge', 'PagesController@get_all_country_for_lounge');//RCAS-2
Route::get('get_all_airports_by_city/{city}', 'PagesController@get_all_airports_by_city');//RCAS-2

//RCAV1-35 Mailer
Route::match(['get', 'post'],'ajaxenquirymailer', 'PagesController@ajaxenquirymailer');

/*********************************Booking Flow***********************************/
Route::get('booking/india-evisa-application', 'BookingController@IndiaVisaApplication');
Route::post('booking/india-visa-application/{ccode}', 'BookingController@visaApplication');
Route::match(['get', 'post'],'booking/apply-for-india-evisa/{ccode}', 'BookingController@applyOnline');
Route::match(['get', 'post'],'booking/evisa-type/{ccode}', 'BookingController@saveEvisaApplication');
Route::match(['get', 'post'],'booking/thankyou', 'BookingController@verifymail');
Route::match(['get', 'post'],'export', 'BookingController@exportfile');
Route::get('booking/b2b-india-evisa-application', 'BookingController@B2BIndiaVisaApplication');
Route::match(['get', 'post'],'booking/b2b-evisa-type', 'BookingController@B2BsaveEvisaApplication');
Route::match(['get', 'post'],'booking/b2b-basic-details/{ccode}', 'BookingController@B2Bevisaapplicationform');
Route::match(['get', 'post'], 'booking/b2b-service-document/{ccode}', 'BookingController@B2Bevisaservicedocument');
Route::match(['get', 'post'],'booking/b2b-family-details/{ccode}', 'BookingController@B2Bevisaapplicationfamily');
Route::match(['get', 'post'],'booking/visa-details/{ccode}', 'BookingController@evisaapplicationdetails');

/*********************************SEO Pages***********************************/
Route::get('evisa/india', 'EvisaController@india');
Route::get('evisa/srilanka', 'EvisaController@srilanka');
Route::get('evisa/hongkong', 'EvisaController@hongkong');
Route::get('evisa/turkey', 'EvisaController@turkey');
Route::get('evisa/combodia', 'EvisaController@combodia');
Route::get('evisa/vietnam', 'EvisaController@vietnam');
Route::get('evisa/malaysia', 'EvisaController@malaysia');

Route::match(['get','post'],'srilanka-visa-application/{ccode}', 'SrilankaApplicationController@visaapplication'); //RCAV1-25
Route::match(['get', 'post'], 'srilanka-evisa-application', 'SrilankaApplicationController@srilankaEvisaApplicationForm'); //RCAV1-25
Route::match(['get', 'post'], 'srilanka-form/to/{ccode}', 'SrilankaApplicationController@saveSLformdata');
Route::match(['get', 'post'], 'srilankareview/{ordid}', 'SrilankaApplicationController@srilankareviewform');

/*********************************AJAX Save Every 30 Seconds***********************************/
Route::match(['get', 'post'],'ajaxautosaveextradoc', 'IndiaEvisaapplicationController@ajaxautosaveextradoc');
Route::match(['get', 'post'],'ajaxautosavebasicform', 'IndiaEvisaapplicationController@ajaxautosavebasicform');
Route::match(['get', 'post'],'ajaxautosavefamilyform', 'IndiaEvisaapplicationController@ajaxautosavefamilyform');
Route::match(['get', 'post'],'ajaxautosavefinalform', 'IndiaEvisaapplicationController@ajaxautosavefinalform');

Route::match(['get', 'post'],'search-country/{ccode}', 'PagesController@searchservicecountry');
Route::match(['get', 'post'],'extract-services-country', 'PagesController@extractservicecountry');
Route::match(['get', 'post'], 'sorry', 'PagesController@sorrypage');//RCAV1-168