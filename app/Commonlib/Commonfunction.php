<?php
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
use DB;
use Response;
use Session;
class Commonfunction {
  public static function ajax_get_display_country_list()
  {
    $getcountry = DB::table('countries')->where('enabled',"Y")->orderby('country_name', 'ASC')->get();
	
	return $getcountry;
  }
  
  public static function ajax_get_display_passport_type_list()
  {
    $getpassporttype = DB::table('passport_types')->get();
	
	return $getpassporttype;
  }
  
  public static function ajax_get_display_marital_status_list()
  {
    $getmarital = DB::table('marital_status')->get();
	
	return $getmarital;
  }
  
  function ajax_get_display_profession_list() {
	$getqualification = DB::table('tbl_qualification')->orderby('qualification', 'ASC')->get();
	
	return $getqualification;
  }
}