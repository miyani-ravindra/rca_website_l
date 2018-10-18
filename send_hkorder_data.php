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
            od.arrival_date, od.citizen_to, ap.username, ap.surname, ap.previous_name, ap.previous_surname, ap.mobile_number, ap.marital_status_id, ap.dob, ap.place_of_birth, users.email_id,
            ap.gender, ap.nationality, ul.travelling_to, pd.pp_no, pd.pp_issue_date, pd.pp_expiry_date, pd.pp_place_of_issue,
            ard.pres_add1, ard.state_name, ard.application_details, asd.service_id, asd.purpose_id, ard.oth_add, ard.oth_country
            from applicant_profiles ap
            join order_details od on ap.order_id = od.order_id
            join passport_details pd on pd.applicant_id = ap.profile_id
            join user_leads ul on ul.order_id = od.order_id
            join users u on u.user_id = ap.user_id
            join application_relationdetails ard on ard.applicant_id = ap.profile_id
            join tbl_user_service_details asd on asd.applicant_id = ap.profile_id
            join users users on users.user_id = ap.user_id
            where asd.service_id =4
            -- and NOW() > DATE_ADD(payment_timestamp, INTERVAL 10 MINUTE)
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
        echo "<pre>";print_r($value);
        $p = json_decode($value['application_details']);
        $order_id = $value['order_id'];
        $appl_id = $value['profile_id'];
            
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
            "name" => $value['username']." ".$value['surname'],
            "given_name_c" => $value['username'],
            "surname_c" => $value['surname'],
            "prev_surname_c" => $value['previous_surname'],
            "prev_givenname_c" => $value['previous_name'],
            "phone_no_c" => $value['mobile_number'],
            "email_c" => $value['email_id'],
            "birthdate_c" => $value['dob'],
            "any_alias_on_pp_c" => $p->alias_is,
            "alias_surname_c" => $p->alias_surname_name,
            "alias_givenname_c" => $p->alias_given_name,
            "if_other_name_c" => $p->oth_name_is,
            "other_surname_c" => $value['previous_surname'],
            "other_givenname_c" => $value['previous_name'],
            "sex_c" => $value['gender'],
            "if_resi_addr_india_c" => $p->res_add_india,
            "resi_addr_in1_c" => $value['pres_add1'],
            "resi_addr_in2_c" => $value['state_name'],
            "marital_status_c" => $value['marital_status_id'],
            "if_lived_two_years_c" => $value['refer_flag'],
            "religion_c" => $value['religion'],
            "educational_qualification_c" => $value['qualification'],
            "visible_identification_mark_c" => $value['visible_marks'],
            "birth_city_c" => $value['place_of_birth'],
            "if_pre_travel_hk_c" => $p->pre_travel_hk,
            "passport_no_pre_c" => $p->pre_add_hk,
            "if_prev_visit_othr_country_c" => $p->pre_travel_oth,
            "prev_visit_country_c" => $p->pre_add_oth,
            "employment_sector_c" => $p->emp_sector,
            "comp_employer_school_c" => $p->name_of_com,
            "office_address_c" => $p->office_add,
            "office_address_city_c" => $p->office_city,
            "employer_contact_c" => $p->phone_com,
            "visit_purpose_c" => $value['purpose_id'],
            "duration_c" => $p->proposed_duration_stay,
            "addr_accommodatio_c" => $p->accommodation_add_hk,
            "funds_available_c" => $p->fund_travel_hksar,
            "local_connection_c" => $p->local_conn_hk,
            "local_con_name_c" => $p->local_name_hk,
            "local_con_relation_c" => $p->local_conn_relation,
            "face_difficulty_c" => $p->difficulty_ret_india,
            "ever_arrested_c" => $p->criminal_offence,
            "ever_convicted_c" => $p->convicted_offence,
            "ever_refused_visa_c" => $p->refused_visa,
            "ever_refused_entry_c" => $p->refused_permission,
            "ever_deported_c" => $p->deported_country,
            "engaged_in_terr_c" => $p->engaged_terrorist_activities, 
            "passport_no_c" => $value['pp_no'],
            "date_of_issue_c" => $value['pp_issue_date'],
            "date_of_expiry_c" => $value['pp_expiry_date'],
            "place_of_issue_c" => $value['pp_place_of_issue'],
            'resi_addr_othr1_c' => $value['oth_add'],
            'resi_addr_othr2_c' => $value['oth_country']
        );

        $set_entr_params = array(
            "session" => $session_id,
            "module_name" => "hkv_hk_evias",
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
