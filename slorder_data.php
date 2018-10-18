<?php

   // ini_set("display_errors", "1");
    //error_reporting(E_ALL);

    $url = "http://crm.redcarpetassist.com/service/v4_1/rest.php";
    $username = "ram";
    $password = "Ram@123";

    //function to make cURL request
   function call($method, $parameters, $url)
   {
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


    $con = mysqli_connect("rca-dev.cj1mucjfpe4z.ap-south-1.rds.amazonaws.com", "rca_dev", "devrca!23", 'rca_website_new');
    mysqli_select_db($con, "rca_website_new");

    $qry = "select od.order_id, od.order_code, od.product_id, od.applicant_booking_status,od.travel_to,
        od.arrival_date, od.citizen_to, ap.username, ap.surname, ap.mobile_number, ap.marital_status_id, ap.dob,
        ap.gender, c.country_id as nationality, ap.is_child, users.email_id, ul.travelling_to, ul.phone_number, ul.email_id, 
        pd.pp_no, pd.pp_issue_date, pd.pp_expiry_date,
        ard.pres_add1, ard.pres_country, ard.pres_phone, vad.type_of_visa, vad.visa_service,
        ard.state_name, ard.application_details, asd.service_id, asd.purpose_id, ard.oth_add, ard.oth_country
        from applicant_profiles ap
        join order_details od on ap.order_id = od.order_id
        join passport_details pd on pd.applicant_id = ap.profile_id
        join user_leads ul on ul.order_id = od.order_id
        join users u on u.user_id = ap.user_id
        join application_relationdetails ard on ard.applicant_id = ap.profile_id
        join tbl_user_service_details asd on asd.applicant_id = ap.profile_id
        join tbl_visa_app_details vad on vad.order_id = od.order_id
        join users users on users.user_id = ap.user_id
        join countries c on c.country_name = ap.nationality
        where asd.service_id in(5, 6, 7)
        -- and NOW() > DATE_ADD(payment_timestamp, INTERVAL 10 MINUTE)
        and od.payment_status = 'authorized'
        and od.mna_sent='N'";

    $res = mysqli_query($con, $qry);

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

    foreach ($res as $key => $value) {
        //echo "<pre>";print_r(json_decode($value['application_details']));
        //echo "<pre>";print_r($value); exit;
        $p = json_decode($value['application_details']);
        $order_id = $value['order_id'];
        $appl_id = $value['profile_id'];

        $res = mysqli_query($con, "select * from countries where country_name = '".$p->country_of_birth."'");
        $birth_country;
        foreach ($res as $k => $v) {
            $birth_country = $v['country_id'];
        }

        $comp_country;

        $res1 = mysqli_query($con, "select * from countries where country_name = '".$p->applicant_company_contact_details->country."'");
        foreach ($res1 as $r => $s) {
            $comp_country = $s['country_id'];
        }

        $cont_country;

        $res2 = mysqli_query($con, "select * from countries where country_name = '".$p->country."'");
        foreach ($res2 as $a => $b) {
            $cont_country = $b['country_id'];
        }

        $purpose = "";

        if($p->tourist_purpose != ""){
            $purpose = $p->tourist_purpose;
        }else if($p->business_purpose != ""){
            $purpose = $p->business_purpose;
        }else{
            $purpose = $p->transit_purpose;
        }

        if($value['service_id']==5){
            $valid_resident = $p->valid_resident;
            $has_valid_eta = $p->has_valid_eta;
            $mutiple_entry_visa = $p->mutiple_entry_visa;
        }else if($value['service_id']==6){
            $valid_resident = $p->is_valid_resident_visa_to_srilanka_business;
            $has_valid_eta = $p->is_currently_in_srilanka_with_valid_eta_business;
            $mutiple_entry_visa = $p->have_multiple_entry_visa_to_srilanka_business;
        }else if($value['service_id']==7){
            $valid_resident = $p->is_valid_resident_visa_to_srilanka_transit;
            $has_valid_eta = $p->is_currently_in_srilanka_with_valid_eta_transit;
            $mutiple_entry_visa = $p->have_multiple_entry_visa_to_srilanka_transit;
        }

        $declaration = 0;
        if($p->i_agree_terms == 'yes') $declaration = 1;
        
        $services=array();
        //get session id
        $session_id = $login_result->id;

        $servername = 'localhost:3306';
        $username = "rcauser";
        $password = "v0twmbp@2016";

        $link = mysqli_connect($servername, $username, $password);
        mysqli_select_db($link, 'rcadb');
        //general applicant data      
        $arrayvar=array(
            "order_code_c" => $value['order_code'],
            "travel_type_c" => $value['service_id'],
            "purpose_c" => $purpose,
            "purpose_desc_c" => $p->purpose_description,
            "stay_in_days_c" => $p->intended_stay_days_text,
            "final_dest_c" => $p->final_destination,
            "title_c" => $p->salutation,
            "name" => $value['username']." ".$value['surname'],
            "given_name_c" => $value['username'],
            "surname_c" => $value['surname'],
            "phone_no_c" => $value['mobile_number'],
            "email_c" => $value['email_id'],
            "dob_c" => $value['dob'],
            "gender_c" => $value['gender'],
            "nationality_c" => $value['nationality'],
            "birth_country_c" => $birth_country,
            "occupation_c" => $p->occupation,
            "passport_no_c" => $value['pp_no'],
            "date_of_issue_c" => $value['pp_issue_date'],
            "date_of_expiry_c" => $value['pp_expiry_date'],
            "arrival_date_c" => $p->arrival_date,
            "dep_port_c" => $p->port_of_departue,
            "airline_vessel_c" => $p->airline_vessel,
            "flight_vessel_no_c" => $p->airline_vessel_no,

            "appl_comp_name_c" => $p->applicant_company_contact_details->company_name,
            "appl_comp_addr1_c" => $p->applicant_company_contact_details->address1,
            "appl_comp_addr2_c" => $p->applicant_company_contact_details->address2,
            "appl_comp_state_c" => $p->applicant_company_contact_details->state,
            "appl_comp_city_c" => $p->applicant_company_contact_details->city,
            "appl_comp_zip_c" => $p->applicant_company_contact_details->zipcode,
            "appl_comp_country_c" => $comp_country,
            "appl_comp_fax_c" => $p->applicant_company_contact_details->fax,
            "appl_comp_email_c" => $p->applicant_company_contact_details->email,
            "appl_comp_mobile_c" => $p->applicant_company_contact_details->mobile,
            "appl_comp_phone_c" => $p->applicant_company_contact_details->telephone,


            "sl_comp_name_c" => $p->srilanka_company_contact_details->company_name,
            "sl_comp_addr1_c" => $p->srilanka_company_contact_details->address1,
            "sl_comp_addr2_c" => $p->srilanka_company_contact_details->address2,
            "sl_comp_state_c" => $p->srilanka_company_contact_details->state,
            "sl_comp_zip_c" => $p->srilanka_company_contact_details->zipcode,
            "sl_comp_city_c" => $p->srilanka_company_contact_details->city,
            "sl_comp_mobile_c" => $p->srilanka_company_contact_details->mobile,
            "sl_comp_email_c" => $p->srilanka_company_contact_details->email,
            "sl_comp_fax_c" => $p->srilanka_company_contact_details->fax,
            "sl_comp_phone_c" => $p->srilanka_company_contact_details->telephone,

            "addr1_c" => $p->address1,
            "addr2_c" => $p->address2,
            "contact_city_c" => $p->city,
            "contact_state_c" => $p->state,
            "zip_postal_code_c" => $p->zipcode,
            "contact_country_c" => $cont_country,
            "sl_address_c" => $p->address_srilanka,
            "email_c" => $p->email,
            "phone_number_c" => $p->telephone,
            "mobile_c" => $p->mobile,
            "fax_c" => $p->fax,

            "if_currently_in_sl_c" => $has_valid_eta,
            "if_multiple_sl_visa_c" => $mutiple_entry_visa,
            "if_residence_visa_c" => $valid_resident,
            "declaration_c" => $declaration,
        );

        echo "<pre>";print_r($arrayvar);

        $set_entr_params = array(
            "session" => $session_id,
            "module_name" => "sl_slevisa",
            "name_value_list" => $arrayvar
        );

       $hk_res = call("set_entry", $set_entr_params, $url);
        if ($hk_res){
            $qry1 = 'update order_details set mna_sent = "Y" 
            where order_id = '.$order_id.' and mna_sent = "N"';
            $res1 = mysqli_query($con, $qry1) or die(mysqli_error($con));
            print_r($hk_res);
        }
    }


?>
