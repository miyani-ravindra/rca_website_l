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
use App\Models\UserLeads;
use App\Models\ApplicantProfiles;
use App\Models\DocumentDetails;
use Softon\Indipay\Facades\Indipay; 
//use Illuminate\Contracts\Routing\ResponseFactory;
use DB;
use Response;
use Session;
use Carbon\Carbon;

class MeetnassistController extends ApplicationController {
	public function index()
	{	
		return view('pages/index');				
	}

	public function step2(Request $request)
	{	
		$getrequest = $request->all();
		//print_r($getrequest);exit;

		//RCAS-2 - START
		if(isset($getrequest['dropdownFlightOrCity']) && $getrequest['dropdownFlightOrCity'] == 'city'){

			$product_type 			= "Departure";
			$flight_1 				= ""; 
			$flight_2 				= "";
			$country_one 		= isset($getrequest['dropdownCountry']) && !empty($getrequest['dropdownCountry']) ? $getrequest['dropdownCountry'] : null;
			$city_one 			= isset($getrequest['dropdownCity']) && !empty($getrequest['dropdownCity']) ? $getrequest['dropdownCity'] : null;
			$country_two 		= isset($getrequest['dropdownCountryTwo']) && !empty($getrequest['dropdownCountryTwo']) ? $getrequest['dropdownCountryTwo'] : null;

			$mna_airport_code 		= isset($getrequest['dropdownAirport']) && !empty($getrequest['dropdownAirport']) ? $getrequest['dropdownAirport'] : null;
			
			//$travel_date 			= isset($getrequest['mna_travel_date']) && !empty($getrequest['mna_travel_date']) ? $getrequest['mna_travel_date'] : null;
			//$travel_date2 			= isset($getrequest['mna_travel_date2']) && !empty($getrequest['mna_travel_date2']) ? $getrequest['mna_travel_date2'] : null;

			$travel_date 			= Carbon::createFromFormat('Y-m-d', $getrequest['mna_travel_date'])->format('d/m/Y');
			$travel_date2 			= isset($getrequest['mna_travel_date2']) && $getrequest['mna_travel_date2'] !=''?Carbon::createFromFormat('Y-m-d', $getrequest['mna_travel_date2'])->format('d/m/Y'):'';

			$mna_adult_passengers 	= $getrequest['mna_adult_passengers'];
			$mna_child_passengers 	= $getrequest['mna_child_passengers'];
			$total_passengers 		= $mna_adult_passengers + $mna_child_passengers;
			$mna_child_age_array 	= isset($getrequest['children_age'])? $getrequest['children_age']: '';
			$mna_child_ages 		= array(); 
			$arrival_mna 			= 'No';
			$departure_mna 			= 'No';
			$transit_mna 			= 'No';
			$services_available 	= array();
			$change_flight 			= isset($getrequest['mna_transit']) && ($getrequest['mna_transit'] == 'Transit') ? 'yes':'no';
			$search_by_city 		= $getrequest['dropdownFlightOrCity'];

			$airline_departure_city = "";
			$dep_ap_code 			= "";
			$airline_details_departure = "";
			$airline_arrival_city   = "";
			$airline_details_arrival = "";
			$arrival_terminal = "";
			$departure_terminal = "";
			

  			//Number of pasenger counting.
	        if(!empty($mna_child_age_array) && count($mna_child_age_array)>0){
	        	foreach($mna_child_age_array as $value ){
		        	if($value > 2 ){
		        		array_push($mna_child_ages,$value);
	        		}        	
		        }
		        $no_of_passengers = $mna_adult_passengers + count($mna_child_ages);
	        } else {
	        	$no_of_passengers = $mna_adult_passengers;
	        }
        

			

			$arrivalAirportCode = $city_one; //TODO: City has taken as departure airport code. Need to correct the flow for city wise searh.
			$departureAirportCode = null; //TODO: City has taken as departure airport code. Need to correct the flow for city wise searh.


			if( isset($getrequest['mna_departure']) && !empty($getrequest['mna_departure']) ){
				$product_type = $getrequest['mna_departure'];
			}

			if( isset($getrequest['mna_transit']) && !empty($getrequest['mna_transit']) ){
				$product_type = $getrequest['mna_transit'];
			}

			if( isset($getrequest['mna_arrival']) && !empty($getrequest['mna_arrival']) ){
				$product_type = $getrequest['mna_arrival'];
			}

			
			
			$pricing_master_resultset = DB::select("SELECT pricing_master.*,CONCAT(`supplier`, ' ', `product_name`) as supplier_product FROM pricing_master where product_type = '".$product_type."' AND product_category = 'M&A' AND is_active = 'Y' AND country_code = '".$country_one."' AND city = '".$city_one."' AND airport = '".$mna_airport_code."' AND ((group_size_min <=". $no_of_passengers ." AND group_size_max >= ".$no_of_passengers.") 
	                                     	 OR (group_size_min = 0 AND group_size_max = 0) OR (group_size_min =". $no_of_passengers." AND group_size_max = ".$no_of_passengers."))");


			$pricing_master_count 	= count($pricing_master_resultset);
			$service_cnt 			= 0;
			$msg 					= "<p style='margin-left:20px;'>Oops! We currently don’t have any service to suit your travel needs.</p>";


			
			if( $pricing_master_count > 0 ){
				
				$msg 						= "";
				$service_cnt 				= $pricing_master_count;
				$min 						= 0;
				$services_available_det 	= array();
	        	$available_services 		= json_decode(json_encode($pricing_master_resultset), true);

		        function group_assoc($array, $key) {
				    $return = array();
				    foreach($array as $v) {
				        $return[$v[$key]][] = $v;
				    }
				    return $return;
				}
				
			
				$account_requests = group_assoc($available_services, 'supplier_product');


				foreach ($account_requests as $serv) {
  
	  				$domestic_service_price 				= array();
	  				$international_service_price 			= array();
	  				$domestic_international_service_price 	= array();
  				
	                if(count($serv)>1){ 
	                    foreach($serv as $grp)
	                    {	

	                    	$multiple_service_price = array();
	                    	if($grp['rate_application'] == 'Group'){
	                    		//print_r($grp);
	                    		//echo $multiple_service_price = array_column($grp, 'total_sp_usd_with_gst');
	                    		$multiple_service_price = array($grp['p_id'] => $grp['total_sp_inr_with_gst']);

	                    	} else {
	                    		$amt = $mna_adult_passengers * $grp['total_sp_inr_with_gst'];
	                    		$multiple_service_price = array($grp['p_id'] => $amt);
	                    		//array_push($multiple_service_price,$amt);

	                    	}

	                    	if($grp['travel_type'] == 'Domestic'){
	                    		array_push($domestic_service_price, $multiple_service_price);
	                    	}else if($grp['travel_type'] == 'International'){
	                    		array_push($international_service_price, $multiple_service_price);
	                    	}else{
	                    		array_push($domestic_international_service_price, $multiple_service_price);
	                    	}
	                    }


	                    
	                    if( count($domestic_service_price) > 0 ){
	                    	$min = min($domestic_service_price);
	                    	array_push($services_available_det, array_keys($min)[0]);	
	                    }

	                    if( count($international_service_price) > 0 ){
	                    	$min = min($international_service_price);
	                   	 	array_push($services_available_det, array_keys($min)[0]);
	                    }

	                    if(count($domestic_international_service_price) > 0 ){
	                    	$min = min($domestic_international_service_price);
	                    	array_push($services_available_det, array_keys($min)[0]);
	                    }

	                } else {
	                	$min_price = array_column($serv, 'total_sp_inr_with_gst');
	                	//print_r($min_price);
	                	$min = min($min_price);
	                	$min_key = array_keys($min_price,$min);
	                	array_push($services_available_det, $serv[$min_key[0]]['p_id']);
	                }
				}

				$price_details_ser 	= PricingMaster::whereIn('p_id', $services_available_det)->orderBy('total_sp_inr_with_gst', 'ASC')->get();
				$services_available = $price_details_ser;
				
				foreach ($services_available as $checkprodtype) {

					if($checkprodtype->product_type == 'Arrival'){
						$arrival_mna = 'Yes';
					}

					if($checkprodtype->product_type == 'Departure'){
						$departure_mna = 'Yes';
					}

					if($checkprodtype->product_type == 'Transit'){
						$transit_mna = 'Yes';
					}
				}
			}else{

				$pricing_master_group_size_max_resultset = DB::select("SELECT DISTINCT group_size_max FROM pricing_master where product_type = '".$product_type."' AND product_category = 'M&A' AND is_active = 'Y' AND country_code = '".$country_one."' AND city = '".$city_one."' AND airport= '".$mna_airport_code."' order by cast(group_size_max  as unsigned) DESC limit 0,1");


				$pricing_master_group_size_max_count = count($pricing_master_group_size_max_resultset);

				if( isset($pricing_master_group_size_max_resultset[0]->group_size_max) && !empty($pricing_master_group_size_max_resultset[0]->group_size_max) ){

					$msg = "<p class ='text-center' style='color:red;'>Maximum available group size is ".$pricing_master_group_size_max_resultset[0]->group_size_max.".</p> <br> <p class ='text-center'> Please click on OK to book multiple groups.</p>";
				}

			}

			


			return view('meetnassist/mna_step2_city',compact('flight_1','flight_2','product_type','no_of_passengers','travel_date','travel_date2','mna_adult_passengers','mna_child_passengers','mna_child_ages','arrival_mna','departure_mna','transit_mna','city_one','service_cnt','services_available','arrivalAirportCode','departureAirportCode','change_flight','airline_departure_city','dep_ap_code','airline_details_departure','airline_arrival_city','airline_details_arrival','arrival_terminal','departure_terminal','search_by_city','total_passengers','msg'));
		}
		//RCAS-2 - END
		
		$product_id = $getrequest['product_id'];
		$product_details = ProductMaster::find($product_id);
		$product_name = $product_details->product_name;
		//print_r($product_details);
		$mna_departure = isset($getrequest['mna_departure']) ? $getrequest['mna_departure'] . "," : '';
		$mna_transit = isset($getrequest['mna_transit']) ? $getrequest['mna_transit'] . "," : '';
		$mna_arrival = isset($getrequest['mna_arrival']) ? $getrequest['mna_arrival'] : '';
		$product_type = $mna_departure . $mna_transit . $mna_arrival;
		$product_type = rtrim($product_type, ',');
//echo $mna_transit;exit;
        //1st flight details
        $airline = explode(" ",$getrequest['al_code']);
		$al_code = $airline[0];
	    $flight_no = $airline[1];
        $travel_date = $getrequest['mna_travel_date'];
//echo "<pre>";
		//echo $travel_date->format('d/m/Y');
		//echo "<br>current".$current = Carbon::now();
		//$no_of_passengers = isset($getrequest['mna_no_of_passengers']) ? $getrequest['mna_no_of_passengers']:'';
		$mna_adult_passengers = $getrequest['mna_adult_passengers'];
		$mna_child_passengers = $getrequest['mna_child_passengers'];
		$mna_child_age_array = isset($getrequest['children_age'])? $getrequest['children_age']: '';

		
		$airports_details = $this->airlineDetails($al_code,$flight_no,$travel_date, $product_type);
//print_r($airports_details);exit;
		$airline_details_departure = $airports_details[0];
		$airline_details_arrival = $airports_details[1];
		$airline_arrival_city = $airports_details[3];
		$airline_departure_city = $airports_details[2];
		$airline_departure_time = $airports_details[4];
		$airline_arrival_time = $airports_details[5];
		$airline_arrival_time = str_replace("T", " ", $airline_arrival_time);
		$airline_arrival_time = substr($airline_arrival_time, 0, -4);
		$departureAirportCode = $airports_details[6];
        $arrivalAirportCode = $airports_details[7];
        $arrival_terminal = $airports_details[8];
        $departure_terminal = $airports_details[9];
		$change_flight = 'no';
		$travel_type = "";

		//RCAS-2 - START
		$is_airline_detail_exist = true;
		$msg = null;

		

		if(empty($arrival_terminal) || empty($departure_terminal)){
			$is_airline_detail_exist = false;
			$msg = "<p style='margin-left:20px;'>Sorry we could not find the details for the flight number please search by City.</p>";
		}else if( (!empty($arrival_terminal) && $arrival_terminal == 'd' ) || (!empty($departure_terminal) && $departure_terminal == 'a' )){

			$is_airline_detail_exist = false;
			$msg = "<p style='margin-left:20px;'>Sorry we could not find the details for the flight number please search by City.</p>";

		}
		//RCAS-2 - END

		if((isset($airports_details[10]) && isset($airports_details[11])) && ($airports_details[10]==$airports_details[11])){
			$travel_type = "Domestic";
		}else{
			$travel_type = "International";
		}
		$arrival_terminal2 = '';
		$departure_terminal2 = '';
		//print_r($airports_details);
//exit;
//echo "<br>*********************************flight 2****************************************<br>";
		if(isset($getrequest['mna_transit']) && ($getrequest['mna_transit'] == 'Transit')){
            $airline2 = explode(" ",$getrequest['al_code2']);
            $al_code2 = $airline2[0];
	        $flight_no2 = $airline2[1];
	        $travel_date2 = $getrequest['mna_travel_date2'];
	        $airports_details2 = $this->airlineDetails($al_code2,$flight_no2,$travel_date2, $product_type);
 /*print_r($airports_details);
 echo "<br>";
 print_r($airports_details2);*///exit;
			$airline_details_departure2 = $airports_details2[0];
			$airline_details_arrival2 = $airports_details2[1];
			$airline_arrival_city2 = $airports_details2[3];
			$airline_departure_city2 = $airports_details2[2];
			$airline_departure_time2 = $airports_details2[4];
			$airline_departure_time2 = substr($airline_departure_time2, 0, -4);
			$airline_departure_time2 = str_replace("T", " ", $airline_departure_time2);
			$airline_arrival_time2 = $airports_details2[5];
			$departureAirportCode2 = $airports_details2[6];
            $arrivalAirportCode2 = $airports_details2[7];
            $arrival_terminal2 = $airports_details2[8];
            $departure_terminal2 = $airports_details2[9];
            
			//$no_of_passengers2 = $getrequest['mna_no_of_passengers2'];
			$startTime = Carbon::parse($airline_arrival_time);
            $endTime = Carbon::parse($airline_departure_time2);
            //print_r($airports_details2);
			$layover_time = $endTime->diffInSeconds($startTime);
			$layover_time = gmdate('H:i:s', $layover_time);
			//echo "<br>layover Time: ".$layover_time;
			$time_format = explode(":",$layover_time);
			$layover_time_hrs = $time_format[0]."hrs ".$time_format[1]."Mins";
			$change_flight = 'yes';
//echo "<br>layover time: ".$layover_time_hrs;
			//exit;
			//echo $travel_date->format('d/m/Y');
			//echo "<br>current".$current = Carbon::now();
			
//exit;
			return view('meetnassist/mna_step2',compact('change_flight','product_type', 'al_code','flight_no','travel_date','mna_child_age_array','mna_adult_passengers','mna_child_passengers','airline_details_departure', 'airline_details_arrival', 'airline_arrival_city','airline_departure_city','al_code2','flight_no2','travel_date2', 'airline_details_departure2', 'airline_details_arrival2', 'airline_arrival_city2','airline_departure_city2','layover_time_hrs','arrivalAirportCode','departureAirportCode','arrivalAirportCode2','departureAirportCode2','arrival_terminal','departure_terminal','arrival_terminal2','departure_terminal2','children_age','travel_type','is_airline_detail_exist','msg')); //RCAS-2
		} else {
            return view('meetnassist/mna_step2',compact('change_flight','product_type', 'al_code','flight_no','travel_date','mna_child_age_array','mna_adult_passengers','mna_child_passengers', 'airline_details_departure', 'airline_details_arrival', 'airline_arrival_city','airline_departure_city','arrivalAirportCode','departureAirportCode','arrival_terminal','departure_terminal','children_age','travel_type','is_airline_detail_exist','msg')); //RCAS-2
		}
				                 
	}

	public function airlineDetails($al_code,$flight_no,$travel_date, $product_type)
	{	
		$travel_date_format = Carbon::createFromFormat('Y-m-d', $travel_date)->format('d/m/Y');
		$travel_year = Carbon::createFromFormat('Y-m-d', $travel_date)->year;
		$travel_month = Carbon::createFromFormat('Y-m-d', $travel_date)->month;
		$travel_day = Carbon::createFromFormat('Y-m-d', $travel_date)->day;


		//START- Check list for if we have airline details or not. 
		$airline_travel_detail_resultset = DB::select("SELECT airline_code,flight_number,flight_detail_json FROM airline_travel_details where airline_code = '".$al_code."' AND flight_number = '".$flight_no."'");

		$result = null;
		if(count($airline_travel_detail_resultset) > 0){
	        $result = $airline_travel_detail_resultset[0]->flight_detail_json;
		}else{

			$ch= curl_init();
			//curl_setopt($ch,CURLOPT_URL,"http://agent.redcarpetassist.com/api/flightdata.php?airline=EK&fltnumber=505&mm=07&year=2018&day=26");
			//curl_setopt($ch,CURLOPT_URL,"http://agent.redcarpetassist.com/api/flightdata.php?airline=9W&fltnumber=839&mm=09&year=2018&day=18");
			curl_setopt($ch,CURLOPT_URL,"http://agent.redcarpetassist.com/api/flightdata.php?airline=$al_code&fltnumber=$flight_no&mm=$travel_month&year=$travel_year&day=$travel_day");
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			curl_setopt($ch,CURLOPT_HEADER, false); 
			$result=curl_exec($ch);
			curl_close($ch);

			$airline_travel_details_ids = DB::table('airline_travel_details')
			->insertGetId(
			[ 'airline_code'=>$al_code,'flight_number'=>$flight_no, 'flight_detail_json' => $result, 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
			);
		}
   		//END- Check list for if we have airline details or not.

		//echo "<pre>";
		//echo $result; //exit;
		//echo "<br>*******************************************************json*******************************************************<br><pre>";
//echo "<pre>";
		$d = json_decode($result);//exit;
//$results = $this->objectToArray($d);
		$results = json_decode(json_encode($d), True);


		//exit;
		//$res = json_decode($result);
		
//print_r($results); exit;
//echo "<br>*********************Res***********<br>"; 
//print_r($results['scheduledFlights'][0]);
//echo $results['scheduledFlights'][0]['departureTerminal'];
//$results['scheduledFlights'][0]['departureTerminal'];exit;
//echo count($results);
		if(isset($results) && !empty($results)){


		//$results = json_decode($results);

		//echo "<br>*******************************************************process*******************************************************<br>";
		//print_r($results['scheduledFlights']);
		//echo count($results->scheduledFlights);
        
		//echo $departure_airport = $results->scheduledFlights[0]->departureAirportFsCode;
			//echo $results['scheduledFlights'][0]->departureTerminal;
			//exit;
		$departure_terminal = isset($results['scheduledFlights'][0]['departureTerminal'])? " Terminal ".$results['scheduledFlights'][0]['departureTerminal'] : '';

		//$dep_airport_code = $results['scheduledFlights'][0]['departureAirportFsCode'];

		//$terminal = $results->scheduledFlights[0]->departureTerminal;

		//$clauses = ['product_type' => $product_type];

    
        
        //$departure_details = $results['scheduledFlights'][0]['departureAirportFsCode'] . " (" . $results['appendix']['airports'][1]['fs'] . ") " . "Terminal ".$departure_terminal;
        $departure_details = isset($results['scheduledFlights'][0]['departureAirportFsCode'])? " Terminal ".$results['scheduledFlights'][0]['departureAirportFsCode'] : '';


        $arrival_terminal = '';

        $arrival_terminal = isset($results['scheduledFlights'][0]['arrivalTerminal']) ? " Terminal ".$results['scheduledFlights'][0]['arrivalTerminal'] : "";

        //$arrival_details = $results['appendix']['airports'][0]['name'] . " (" . $results['appendix']['airports'][0]['fs'] . ") " . $arrival_terminal;

        $arrival_details = isset($results['scheduledFlights'][0]['arrivalAirportFsCode'])? $results['scheduledFlights'][0]['arrivalAirportFsCode']. $arrival_terminal : '';

        $airports_details = array();
        $airports_details[0] = $departure_details;
        $airports_details[1] = $arrival_details;
        $airports_details[2] = isset($results['appendix']['airports'][1]['city'])?$results['appendix']['airports'][1]['city']:'';
        $airports_details[3] = isset($results['appendix']['airports'][0]['city'])?$results['appendix']['airports'][0]['city']:'';
        $airports_details[4] = isset($results['scheduledFlights'][0]['departureTime'])?$results['scheduledFlights'][0]['departureTime']:'';
        $airports_details[5] = isset($results['scheduledFlights'][0]['arrivalTime'])?$results['scheduledFlights'][0]['arrivalTime']:'';
        $airports_details[6] = isset($results['scheduledFlights'][0]['departureAirportFsCode'])?$results['scheduledFlights'][0]['departureAirportFsCode']:'';
        $airports_details[7] = isset($results['scheduledFlights'][0]['arrivalAirportFsCode'])?$results['scheduledFlights'][0]['arrivalAirportFsCode']:'';
        $airports_details[8] = $arrival_terminal;
        $airports_details[9] = $departure_terminal;
        $airports_details[10] = isset($results['appendix']['airports'][0]['countryName'])?$results['appendix']['airports'][0]['countryName']:'';
        $airports_details[11] = isset($results['appendix']['airports'][1]['countryName'])?$results['appendix']['airports'][1]['countryName']:'';
//exit;
		return $airports_details; 
		} else 
		return "Invalid data";          
	}

    public function step3(Request $request)
	{	
		$getrequest = $request->all();
		//print_r($getrequest);
		//echo "<br>";//exit;
		$product_id = $getrequest['product_id'];
		$product_type = $getrequest['product_type'];
		$mna_adult_passengers = $getrequest['mna_adult_passengers'] ? $getrequest['mna_adult_passengers']:0;
		$mna_child_passengers = $getrequest['mna_child_passengers'] ? $getrequest['mna_child_passengers']:0;
		$total_passengers = $mna_adult_passengers + $mna_child_passengers;
		$mna_child_age_array = $getrequest['mna_child_age_array'];

		$dep_ap_code = $getrequest['dep_ap_code'];
		$arr_ap_code = $getrequest['arr_ap_code'];
		$dep_ap_code2 = $getrequest['dep_ap_code2'];
		$arr_ap_code2 = $getrequest['arr_ap_code2'];
		$flight_1 = $getrequest['flight_1'];
		$flight_2 = $getrequest['flight_2']; 
		$arrival_terminal = $getrequest['arrival_terminal'];
		$departure_terminal = $getrequest['departure_terminal'];
		$departure_terminal2 = $getrequest['departure_terminal2'];
		$arrival_terminal2 = $getrequest['arrival_terminal2'];
        $change_flight = $getrequest['change_flight'];
        $layover_time_hrs = $getrequest['layover_time_hrs'];
        $airline_departure_city = $getrequest['airline_departure_city'];
        $airline_departure_city2 = $getrequest['airline_departure_city2'];
        $airline_details_departure = $getrequest['airline_details_departure'];
        $airline_details_departure2 = $getrequest['airline_details_departure2'];
        $airline_arrival_city = $getrequest['airline_arrival_city'];
        $airline_arrival_city2 = $getrequest['airline_arrival_city2'];
        $airline_details_arrival = $getrequest['airline_details_arrival'];
        $airline_details_arrival2 = $getrequest['airline_details_arrival2'];

        $departureAirportCode = $getrequest['departureAirportCode'];
        $arrivalAirportCode = $getrequest['arrivalAirportCode'];

        $departureAirportCode2 = $getrequest['departureAirportCode2'];
        $arrivalAirportCode2 = $getrequest['arrivalAirportCode2'];

		$travel_date = Carbon::createFromFormat('Y-m-d', $getrequest['travel_date'])->format('d/m/Y');
		$travel_date2 = isset($getrequest['travel_date2']) && $getrequest['travel_date2'] !=''?Carbon::createFromFormat('Y-m-d', $getrequest['travel_date2'])->format('d/m/Y'):'';

		$travel_type = !empty($getrequest['travel_type'])?$getrequest['travel_type']:NULL;
		//print_r($getrequest);//exit;
		/*if(isset($subaccountcode)) {
        $clauses = array_merge($clauses,['subaccountcode' => $subaccountcode];
    }*/

		/*$services_available = PricingMaster::where('product_id', 2)
		                      ->applyConditions($clauses);*/



        /*$travel_date = new DateTime("$travel_date");
        echo toDateTime($travel_date)->format('d-m-Y'); 
        $date = Carbon::now();
        echo $date->format('d-m-Y'); 
        echo $date->timezoneName;*/
//echo $departure_terminal;exit;

        /************************No of passengers************************/
        
        $mna_child_ages = array(); 
        $mna_child_age_array = unserialize($mna_child_age_array);
        
        if(!empty($mna_child_age_array) && count($mna_child_age_array)>0){
        	foreach($mna_child_age_array as $value ){
	        	if($value > 2){
	        		array_push($mna_child_ages,$value);
	        	}        	
	        }
	        $no_of_passengers = $mna_adult_passengers + count($mna_child_ages);
        } else {
        	$no_of_passengers = $mna_adult_passengers;
        }
       

        /************************End no of passengers************************/

        $andCondition = '';
        if ($product_type == 'Arrival'){
            $andCondition .= " AND product_type IN ('Arrival')";
            $andCondition .= " AND airport_code IN ('$arr_ap_code')";
            if($arrival_terminal != ''){
              $arrival_terminal_t = explode("Terminal ",$arrival_terminal);
              $arrival_terminal_t = trim($arrival_terminal_t[1]);
        	  $andCondition .= " AND arrival_terminal IN ('All','$arrival_terminal_t')";
            }
        } else if ($product_type == 'Departure'){
            $andCondition = " AND product_type IN ('Departure')";
            $andCondition .= " AND airport_code IN ('$dep_ap_code')";
            if($departure_terminal != ''){
            	$departure_terminal_t = explode("Terminal ",$departure_terminal);
              $departure_terminal_t = trim($departure_terminal_t[1]);
        	    $andCondition .= " AND departure_terminal IN ('All','$departure_terminal_t')";
            }
        } else {
        	if($product_type == "Departure,Arrival"){
        		$andCondition = " AND product_type IN ('Departure','Arrival')";
        	} else {
        		$andCondition = " AND product_type IN ('Transit')";
                $dep_ap_code = $dep_ap_code2;
               // $arr_ap_code = $arr_ap_code2 ;  
        	}

        	$andCondition .= " AND airport_code IN ('All','$dep_ap_code','$arr_ap_code')";
        	if(($arrival_terminal != '') || ($arrival_terminal2 != '')){
        	  $arrival_terminal_t = explode("Terminal ",$arrival_terminal);
              $arrival_terminal_t = trim(isset($arrival_terminal_t[1])?$arrival_terminal_t[1] :'');
              $arrival_terminal2_t = explode("Terminal ",$arrival_terminal2);
              $arrival_terminal2_t = (isset($arrival_terminal2_t[1])&& $arrival_terminal2_t[1]!='')? trim($arrival_terminal2_t[1]):'';
        	  $andCondition .= " AND arrival_terminal IN ('All','$arrival_terminal_t','$arrival_terminal2_t')";
            }
            if(($departure_terminal != '') || ($departure_terminal2 != '')){
            	$departure_terminal_t = explode("Terminal ",$departure_terminal);
                $departure_terminal_t = trim($departure_terminal_t[1]);
                $departure_terminal2_t = explode("Terminal ",$departure_terminal2);
                $departure_terminal2_t = (isset($departure_terminal2_t[1]) && $departure_terminal2_t[1] !='')?trim($departure_terminal2_t[1]):'';
        	    $andCondition .= " AND departure_terminal IN ('All','$departure_terminal_t','$departure_terminal2_t')";
            }
        }
        

//echo "<br>".$andCondition."<br>";exit;
        /*echo "SELECT * ,CASE WHEN (group_size_min > $no_of_passengers AND group_size_max < $no_of_passengers) THEN group_size_min
	          WHEN (group_size_min = $no_of_passengers AND group_size_max = $no_of_passengers) THEN group_size_min
              WHEN (group_size_min = 0 AND group_size_max = 0) THEN group_size_min
              ELSE group_size_min
	          END
              FROM pricing_master 
	          WHERE product_id = ". $product_id . $andCondition ;

	                                       exit;*/
/*echo "SELECT p_id, product_name, supplier, product_category,group_size_min, group_size_max, product_type,  arrival_terminal, departure_terminal, serviced_by, adult_cost_price
       	                                 FROM pricing_master 
	                                     WHERE product_id = $product_id 
	                                     AND ((group_size_min <= $no_of_passengers AND group_size_max >= $no_of_passengers) 
	                                     	 OR (group_size_min = 0 AND group_size_max = 0) OR (group_size_min = $no_of_passengers AND group_size_max = $no_of_passengers))" . $andCondition;
exit;*/




       /*$services_available = DB::select("SELECT * ,CASE WHEN (group_size_min > $no_of_passengers AND group_size_max < $no_of_passengers) THEN group_size_min
	          WHEN (group_size_min = $no_of_passengers AND group_size_max = $no_of_passengers) THEN group_size_min
              WHEN (group_size_min = 0 AND group_size_max = 0) THEN group_size_min
              ELSE group_size_min
	          END
              FROM pricing_master 
	          WHERE product_id = ". $product_id . $andCondition
                                     */
                                            //." AND departure_terminal = '".$terminal ."'"
                                           //." AND booking_cut_off = '".4 ."'"
	                                      // );
       $available_services = DB::select("SELECT pricing_master.*,CONCAT(`supplier`, ' ', `product_name`) as supplier_product FROM pricing_master 
	                                     WHERE product_id = $product_id 
	                                     AND is_active='Y'
	                                     AND ((group_size_min <= $no_of_passengers AND group_size_max >= $no_of_passengers) 
	                                         OR (group_size_min <= $no_of_passengers AND group_size_max = 'NA')
	                                     	 OR (group_size_min = 0 AND group_size_max = 0) OR (group_size_min = $no_of_passengers AND group_size_max = $no_of_passengers))" . $andCondition


       	);
       //echo "<pre>";
//echo count($available_services);
       if(count($available_services)>0){
//print_r($available_services);
	        $services_available_det = array();
	        $available_services = json_decode(json_encode($available_services), True); 
	        //print_r($available_services);
	        function group_assoc($array, $key) {
			    $return = array();
			    foreach($array as $v) {
			        $return[$v[$key]][] = $v;
			    }
			    return $return;
			}
			$min =0;
			//Group the requests by their account_id
			$account_requests = group_assoc($available_services, 'supplier_product');

			foreach ($account_requests as $serv) {
  
	  				$domestic_service_price 				= array();
	  				$international_service_price 			= array();
	  				$domestic_international_service_price 	= array();
  				
	                if(count($serv)>1){ 
	                    foreach($serv as $grp)
	                    {	

	                    	$multiple_service_price = array();
	                    	if($grp['rate_application'] == 'Group'){
	                    		//print_r($grp);
	                    		//echo $multiple_service_price = array_column($grp, 'total_sp_usd_with_gst');
	                    		$multiple_service_price = array($grp['p_id'] => $grp['total_sp_inr_with_gst']);

	                    	} else {
	                    		$amt = $mna_adult_passengers * $grp['total_sp_inr_with_gst'];
	                    		$multiple_service_price = array($grp['p_id'] => $amt);
	                    		//array_push($multiple_service_price,$amt);

	                    	}

	                    	if($grp['travel_type'] == 'Domestic'){
	                    		array_push($domestic_service_price, $multiple_service_price);
	                    	}else if($grp['travel_type'] == 'International'){
	                    		array_push($international_service_price, $multiple_service_price);
	                    	}else{
	                    		array_push($domestic_international_service_price, $multiple_service_price);
	                    	}
	                    }


	                    
	                    if( count($domestic_service_price) > 0 ){
	                    	$min = min($domestic_service_price);
	                    	array_push($services_available_det, array_keys($min)[0]);	
	                    }

	                    if( count($international_service_price) > 0 ){
	                    	$min = min($international_service_price);
	                   	 	array_push($services_available_det, array_keys($min)[0]);
	                    }

	                    if(count($domestic_international_service_price) > 0 ){
	                    	$min = min($domestic_international_service_price);
	                    	array_push($services_available_det, array_keys($min)[0]);
	                    }

	                } else {
	                	$min_price = array_column($serv, 'total_sp_inr_with_gst');
	                	//print_r($min_price);
	                	$min = min($min_price);
	                	$min_key = array_keys($min_price,$min);
	                	array_push($services_available_det, $serv[$min_key[0]]['p_id']);
	                }
				}
		
//print_r($services_available_det);
//echo $service_ids = rtrim((array)$services_available_det, ',');
			$price_details_ser = PricingMaster::whereIn('p_id', $services_available_det)->orderBy('total_sp_inr_with_gst', 'ASC')->get();
			$services_available = $price_details_ser;
//print_r($price_details);


        /*foreach($available_services as $service_mna){
            echo $services_available = $service_mna['p_id']."<br>";
            $supplier = $service_mna['supplier'];
            $product_name = $service_mna['product_name'];
            $product_price = $service_mna['adult_cost_price'];
            foreach($available_services as $service_mna_compare){
            	if(($service_mna_compare['supplier'] == $supplier)&&($service_mna_compare['product_name'] <  == $product_name)){
            		if($service_mna_compare['product_name'] < $product_price){
                        $services_available
            		} else {

            		}

            	}

            }
        }*/

		if(count($services_available)>0){
			//print_r($services_available);exit;
			$arrival_mna ='No';
			$departure_mna ='No';
			$transit_mna ='No';
			foreach ($services_available as $checkprodtype) {
				if($checkprodtype->product_type == 'Arrival'){
					$arrival_mna = 'Yes';
				}
				if($checkprodtype->product_type == 'Departure'){
					$departure_mna = 'Yes';
				}
				if($checkprodtype->product_type == 'Transit'){
					$transit_mna = 'Yes';
				}
			}
			$msg = "";
            $service_cnt =count($services_available);//exit;
            return view('meetnassist/mna_step3',compact('msg','service_cnt','services_available','product_type','no_of_passengers','mna_adult_passengers','mna_child_passengers','dep_ap_code','arr_ap_code','dep_ap_code2','arr_ap_code2','flight_1','flight_2','travel_date','travel_date2','airline_departure_city','airline_departure_city2','airline_details_departure','airline_details_departure2','airline_arrival_city','airline_arrival_city2','airline_details_arrival','airline_details_arrival2','change_flight','layover_time_hrs','departureAirportCode','arrivalAirportCode','departureAirportCode2','arrivalAirportCode2','departure_terminal','arrival_terminal','departure_terminal2','arrival_terminal2','arrival_mna','departure_mna','transit_mna','mna_child_ages','total_passengers'));

		} else {
			$msg = "<p style='margin-left:20px;'>Oops! We currently don’t have any service to suit your travel needs.
</p>";
	
			$pricing_master_group_size_max_resultset = DB::select("SELECT DISTINCT group_size_max FROM pricing_master WHERE  p_id IN (" . implode(",",$services_available_det). ") order by cast(group_size_max  as unsigned) DESC limit 0,1");

			$pricing_master_group_size_max_count 		= count($pricing_master_group_size_max_resultset);

			if( isset($pricing_master_group_size_max_resultset[0]->group_size_max) && !empty($pricing_master_group_size_max_resultset[0]->group_size_max) ){

				$msg = "<p class ='text-center' style='color:red;'>Maximum available group size is ".$pricing_master_group_size_max_resultset[0]->group_size_max.".</p> <br> <p class ='text-center'> Please click on OK to book multiple groups.</p>";
			}

			$service_cnt =0;
			return view('meetnassist/mna_step3',compact('service_cnt','msg','product_type','flight_1','flight_2','travel_date','travel_date2','no_of_passengers','mna_adult_passengers','mna_child_passengers','dep_ap_code','arr_ap_code','dep_ap_code2','arr_ap_code2','departure_terminal','airline_departure_city','airline_departure_city2','airline_details_departure','airline_details_departure2','airline_arrival_city','airline_arrival_city2','airline_details_arrival','airline_details_arrival2','change_flight','layover_time_hrs','departureAirportCode','arrivalAirportCode','departureAirportCode2','arrivalAirportCode2','departure_terminal2','arrival_terminal2','departure_terminal','arrival_terminal','mna_child_ages','total_passengers'));
		}
	} else {
			$msg = "<p style='margin-left:20px;'>Oops! We currently don’t have any service to suit your travel needs.
</p>";

			$pricing_master_group_size_max_resultset = DB::select("SELECT DISTINCT group_size_max FROM pricing_master WHERE product_id = $product_id AND is_active = 'Y' " . $andCondition. " order by cast(group_size_max  as unsigned) DESC limit 0,1");

			$pricing_master_group_size_max_count 		= count($pricing_master_group_size_max_resultset);

			if( isset($pricing_master_group_size_max_resultset[0]->group_size_max) && !empty($pricing_master_group_size_max_resultset[0]->group_size_max) ){

				$msg = "<p class ='text-center' style='color:red;'>Maximum available group size is ".$pricing_master_group_size_max_resultset[0]->group_size_max.".</p> <br> <p class ='text-center'> Please click on OK to book multiple groups.</p>";
			}

			$service_cnt =0;
			return view('meetnassist/mna_step3',compact('service_cnt','msg','product_type','flight_1','flight_2','travel_date','travel_date2','no_of_passengers','dep_ap_code','arr_ap_code','dep_ap_code2','arr_ap_code2','departure_terminal','airline_departure_city','airline_departure_city2','airline_details_departure','airline_details_departure2','airline_arrival_city','airline_arrival_city2','airline_details_arrival','airline_details_arrival2','change_flight','layover_time_hrs','departureAirportCode','arrivalAirportCode','departureAirportCode2','arrivalAirportCode2','departure_terminal2','arrival_terminal2','departure_terminal','arrival_terminal','mna_adult_passengers','mna_child_passengers'));
	}
//echo "<br><pre>";
		//print_r($services_available);   //Mumbai Airport (BOM) T2
        
    }  


	public function ajaxAddService($service_id){
		//echo $service_id; 
		$get_price_details = PricingMaster::where('p_id', $service_id)
                     ->get()->first();
                     //print_r($get_price_details);
        echo "<p class='__selected_item'>$get_price_details->product_name</p><input type='hidden' name='service_id[]' id='service_id' value='$get_price_details->p_id'>";

	}      

	public function confirm(Request $request)
	{	
		$getrequest = $request->all();
		$service_ids = '';
		$services = $getrequest['service_id'];
		$product_type = $getrequest['product_type'];
		$no_of_passengers = $getrequest['no_of_passengers'];
		$mna_adult_passengers = $getrequest['mna_adult_passengers'];
		$mna_child_passengers = $getrequest['mna_child_passengers'];
		$total_passengers = $getrequest['total_passengers'];
		$mna_child_ages = unserialize($getrequest['mna_child_ages']);
		$flight_1 = $getrequest['flight_1'];
		$flight_2 = $getrequest['flight_2'];
		//$travel_date = Carbon::createFromFormat('Y-m-d', $getrequest['travel_date'])->format('d/m/Y');
		$travel_date = $getrequest['travel_date'];
		$change_flight = $getrequest['change_flight'];
		$travel_date2 = $getrequest['travel_date2'];
		$currency = "INR";
		$dep_ap_code = $getrequest['dep_ap_code'];
		
		$departure_terminal = $getrequest['departure_terminal'];
		$arrival_terminal = $getrequest['arrival_terminal'];
		$departure_terminal2 = $getrequest['departure_terminal2'];
		$arrival_terminal2 = $getrequest['arrival_terminal2'];

		$departure_airport_code1 = $getrequest['departure_airport_code1'];
		$arrival_airport_code1 = $getrequest['arrival_airport_code1'];
		$departure_airport_code2 = $getrequest['departure_airport_code2'];
		$arrival_airport_code2 = $getrequest['arrival_airport_code2'];

		//RCAS-2 - START
		$search_by_city = isset($getrequest['search_by_city']) && !empty($getrequest['search_by_city']) ? $getrequest['search_by_city'] : null;
		$city_one 		= isset($getrequest['city_one']) && !empty($getrequest['city_one']) ? $getrequest['city_one'] : null;
		//RCAS-2 - END




		//print_r($services);
		foreach($services as $service){
			//$service_ids = array_push($service_ids, $service);
			$service_ids .= $service .",";
		}
		
		$service_ids = (array)rtrim($service_ids, ',');
		$price_details = PricingMaster::whereIn('p_id', $service_ids)->get();
		$price_id = $service_ids[0];
		//print_r($price_details);

		/*return view('meetnassist/confirm',compact('services_available','product_type','no_of_passengers','dep_ap_code','arr_ap_code','dep_ap_code2','arr_ap_code2','flight_1','flight_2','travel_date','travel_date2','departure_terminal','airline_departure_city','airline_departure_city2','airline_details_departure','airline_details_departure2','airline_arrival_city','airline_arrival_city2','airline_details_arrival','airline_details_arrival2','change_flight','layover_time_hrs','flight_1','flight_2'));*/
		return view('meetnassist/confirm',compact('price_details','product_type','no_of_passengers','flight_1','flight_2','travel_date','travel_date2','change_flight','price_id','dep_ap_code','departure_terminal','departure_airport_code1','arrival_airport_code1','departure_airport_code2','arrival_airport_code2','departure_terminal2','arrival_terminal2','departure_terminal','arrival_terminal','mna_child_ages','mna_adult_passengers','mna_child_passengers','no_of_passengers','total_passengers','search_by_city','city_one'));//RCAS-2
	}    

	public function userForm(Request $request)
	{	
		$getrequest = $request->all();
		/*echo "<pre>";
		print_r($getrequest);exit;*/


		$respnse="";
		$sendmail = new ApplicationController;
		$name = $getrequest['f_name_1']." ".$getrequest['l_name_1'];
		$res = $sendmail->sendotp($getrequest['email_1'], $name);
		$d = json_decode($res);
		$uid = $d->uid;
		$response = $d->msg;

		$travel_date = $getrequest['travel_date'];
		$travel_date = Carbon::createFromFormat('d/m/Y', $travel_date)->format('Y-m-d');
		//print_r($getrequest);exit;
		$currency = $getrequest['currency'];
		$no_of_passengers = $getrequest['passenger'];
        $username = $getrequest['f_name_1']." ".$getrequest['l_name_1'];
		/*$uid = DB::table('users')
    		->insertGetId(
            	['email_id' => $getrequest['email_1'], 'mobile_no'=>$getrequest['mobile_1'], 'username'=> $username, 'nationality'=> '', 'created_at'=>Carbon::now()]
        );*/
		//echo $uid;
    	$amt = $getrequest['amount'];
        $email = $getrequest['email_1'];
        $phone = $getrequest['mobile_1'];
        $productinfo = "Meet & Assist";

	    $ord_details = new OrderDetails;
		$ord_details->order_code = 	'RCAM'.date("ymd").rand(10000 , 99999);
		$ord_details->user_id = 	$uid;
		$ord_details->product_id = 	2;
		$ord_details->total_price = $getrequest['amount'];
		$ord_details->pricing_master_id = $getrequest['price_id'];
		$ord_details->no_of_passengers = $getrequest['passenger'];
		$ord_details->travel_date = $travel_date;

		$ord_details->departing_airport1 = $getrequest['departure_airport_code1'];
		$ord_details->departing_airport2 = $getrequest['departure_airport_code2'];
		$ord_details->arriving_airport1 = $getrequest['arrival_airport_code1'];
		$ord_details->arriving_airport2 = $getrequest['arrival_airport_code2'];
		$ord_details->arrival_terminal1 = $getrequest['arrival_terminal'];
		$ord_details->destination_terminal1 = $getrequest['departure_terminal'];
		$ord_details->destination_terminal2 = $getrequest['departure_terminal2'];
		$ord_details->arrival_terminal2 = $getrequest['arrival_terminal2'];
		$ord_details->city_one = isset($getrequest['city_one']) && !empty($getrequest['city_one']) ? $getrequest['city_one'] : null; //RCAS-2

	    $ord_details->flight_no1 = $getrequest['flight_1'];
	    $ord_details->flight_no2 = ltrim($getrequest['flight_2'], ',');
		$ord_details->total_price = $getrequest['amount'];
		$ord_details->created_at = 	Carbon::now();
		$ord_details->save();
		$order_code = $ord_details->order_code;

		$ordid = $ord_details->order_id;
		$txnid = $order_code;

	    for ($x=1; $x<=$no_of_passengers; $x++) {
	    	$saveapplicant = new ApplicantProfiles;

			$saveapplicant->user_id = $uid;
			$saveapplicant->username = $username;
			$saveapplicant->mobile_number = $getrequest["mobile_$x"];
			$saveapplicant->order_id = $ordid;
			$saveapplicant->is_submitted = "Y";

			$saveapplicant->save();
	        $applicant_id = $saveapplicant->profile_id;

			if(isset($getrequest["ticket_$x"]) && !empty($getrequest["ticket_$x"])){
				$ticket_copy = $request->file("ticket_$x");
				$doc_type = "Ticket";

				$input['imagename'] = "ticket-copy-".time().'.'.$ticket_copy->getClientOriginalExtension();
				$imgsize = $ticket_copy->getClientSize();
				$imgtype = $ticket_copy->getClientMimeType();

				$destinationPath = public_path('doc-upload/');
								    
				$request->file("ticket_$x")->move($destinationPath, $input['imagename']);

				$savedocdetails = DocumentDetails::firstOrCreate(['applicant_id' => $applicant_id,'doc_type_id'=>12]);

				$savedocdetails->user_id = $uid;
				$savedocdetails->applicant_id = $applicant_id;
				$savedocdetails->doc_type = $doc_type;
				$savedocdetails->doc_type_id = 12;
				$savedocdetails->doc_size = $imgsize;
				$savedocdetails->doc_url = "/doc-upload/".$input['imagename'];
				$savedocdetails->doc_mime_type = $imgtype;

				$savedocdetails->save();
			}
	    }

        $saveuserlead = new UserLeads;
		$saveuserlead->name = !empty($username)?$username:NULL;
		$saveuserlead->phone_number = $getrequest['mobile_1'];
		$saveuserlead->flight_no = $getrequest['flight_1'];
		$saveuserlead->product_id = 2;
		$saveuserlead->order_id = $ordid;
		$saveuserlead->created_at = Carbon::now();
		$saveuserlead->status = 'New';

		$saveuserlead->save();

//exit;
		/*$orderId = $request->input('submit_val');
        $order_qry = OrderDetails::where('order_id', '=', $orderId)
                     ->get()->first();
        $user_qry = Users::where('user_id', '=', $order_qry->user_id)
                     ->get()->first();
        $prod_qry = ProductMaster::where('product_id', '=', $order_qry->product_id)
                     ->get()->first();
        $product_name = $prod_qry->product_name;*/
		/*$hash = "";
		$posted['key'] = "WnvQF6Tj";
		$SALT = "CQwuLpS6QW";
		$phone = $posted['phone'] = $getrequest['mobile_1'];
		//$txnid = $posted['txnid'] = $order_qry->order_id;
		$txnid = $posted['txnid'] = $ordid;
        $amt = $posted['amount'] = $getrequest['amount'];
        $firstname = $posted['firstname'] = $username;
        $email = $posted['email'] = $getrequest['email_1'];
        $productinfo = $posted['productinfo'] = "Meet & Assist";

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
           
          }*/
//exit;

		//return view('orders/payment_pu',compact('hash','txnid','amt','phone','firstname','email','productinfo','currency'));
          $product_info_row = PricingMaster::where('p_id', $getrequest['price_id'])
                     ->get()->first();
                     //print_r($product_info_row->product_name);exit;


          $service = $product_info_row->serviced_by != 'NA'? ' ('.$product_info_row->serviced_by.')':"";
          $product_info = "Meet & Greet_".$product_info_row->product_name.$service;
          return view('meetnassist/verifyemail',compact('hash','txnid','ordid','amt','phone','username','email','productinfo','currency','product_info','uid'));
	} 


	public function payment(Request $request)
	{	
		$getrequest = $request->all();
		$currency = "INR";
        $username = $getrequest['user_name'];
		$ordid = $getrequest['order_id'];


//echo $uid;
    
    

//exit;
		/*$orderId = $request->input('submit_val');
        $order_qry = OrderDetails::where('order_id', '=', $orderId)
                     ->get()->first();
        $user_qry = Users::where('user_id', '=', $order_qry->user_id)
                     ->get()->first();
        $prod_qry = ProductMaster::where('product_id', '=', $order_qry->product_id)
                     ->get()->first();
        $product_name = $prod_qry->product_name;*/
		$hash = "";
		$posted['key'] = "WnvQF6Tj";
		$SALT = "CQwuLpS6QW";
		$phone = $posted['phone'] = $getrequest['phone_number'];
		//$txnid = $posted['txnid'] = $order_qry->order_id;
		$txnid = $posted['txnid'] = $ordid;
        $amt = $posted['amount'] = $getrequest['amount'];
        $firstname = $posted['firstname'] = $username;
        $email = $posted['email'] = $getrequest['email_id'];
        $productinfo = $posted['productinfo'] = "Meet & Assist";

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

		return view('orders/payment_pu',compact('hash','txnid','amt','phone','firstname','email','productinfo','currency'));
	} 

	public function receipt(Request $request)
	{
        return view('meetnassist/receipt');
	}  

	public function requestCCAvenue(Request $request){
		      /*$parameters = [
      
        'tid' => '123322137',
        
        'order_id' => '13221527',
        
        'amount' => '1.00',
        
      ];*/

        $getrequest = $request->all();
		$currency = $getrequest['currency'];
        $username = $getrequest['user_name'];
		$ordid = $getrequest['order_id'];
		$phone = $getrequest['phone_number'];
        $amt = $getrequest['amount'];
        
        $rnd_num = mt_rand(10,100);
		$parameters = [
           	'tid' => $rnd_num,
           	'order_id' => $getrequest['order_id'],
           	'amount' => $getrequest['amount'],
           	//'amount' => '1.00',
        	'billing_name' => $username,
        	'billing_address' => '',
        	'billing_city' => '',
        	'billing_state' => '',
        	'billing_zip' => '',
        	'billing_country' => '',
        	'billing_tel' => $getrequest['phone_number'],
        	'currency' => $getrequest['currency'],
        	'billing_email' => $getrequest['email_id'],
        	'merchant_param1' => 'Meet & Assist',
        
        ];
      
      // gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo / ZapakPay / Mocker
      
      $order = Indipay::gateway('CCAvenue')->prepare($parameters);
      return Indipay::process($order);
	} 

	public function responseCCAvenue(Request $request){
        // For default Gateway
        $response = Indipay::response($request);
        echo "********************************************";
        // For Otherthan Default Gateway
        $response = Indipay::gateway('CCAvenue')->response($request);
print_r(array_keys($response)); 
$status = $response['order_status'];
print_r($response['order_id']);echo $status;
        dd($response);

        




        /*$response = array(
		'order_date'=>!empty($getrequest['addedon'])?date('F j, Y H:i:s', strtotime($getrequest['addedon'])):NULL,
		'firstname'=> !empty($getrequest['firstname'])?preg_replace("~[^a-z0-9:]~i", " ", $getrequest['firstname']):NULL,
		'productinfo'=> !empty($getrequest['productinfo'])?$getrequest['productinfo']:NULL,
		'status'=> !empty($getrequest['status'])?$getrequest['status']:NULL,
		'txnid'=> !empty($getrequest['txnid'])?$getrequest['txnid']:NULL,
		'amount'=>!empty($getrequest['amount'])?round($getrequest['amount']):NULL
	);

	$sendmail = new ApplicationController;
	
	$orderupdate = OrderDetails::firstOrCreate(['order_id'=>$response['txnid']]);
	$orderupdate->payment_status = $response['status'];
	$orderupdate->total_price = $response['amount'];
	$orderupdate->save();

	$to = $orderupdate['email_id'];
    //$content = "Dear $response['firstname'], <br>Welcome to the RedCarpet Assist family. We would like to thank you for your order. Our team is already processing your details and will be in touch for any additional information required to complete the order.</br>Please find your payment receipt.<br><table><tr><th>Transaction Date</th><td>".$response['order_date']."</td></tr><tr><th>Ref. ID</th><td>".$response['txnid']."</td></tr><tr><th>Payment Status</th><td>".$response['status']."</td></tr><tr><th>Amount</th><td>$response['amount']</td></tr></table><br>In case you do need to get in touch with us urgently, please do call us at +91 22 6253 8600 or email us at customercare@redcarpetassist.com. We work Monday to Saturday, 10 am to 8pm Indian Standard Time (GMT +5.30)<br>Your RedCarpet Assist Team.<br><i>Add support@redcarpetassist.com to your address book to ensure that our mails reach your Inbox.</i>";
    $content = "Test";
    $subject ="We are rolling out the RedCarpet for you";
	$sendmail->sendEmail("support@redcarpetassist.com",$to,null,null, $subject, $content);

	return view('evisaapplication/payment_success', compact('response'));*/
    
    }  
}
