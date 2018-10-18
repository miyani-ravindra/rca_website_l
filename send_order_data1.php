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


    $con = mysqli_connect("rca-live.cj1mucjfpe4z.ap-south-1.rds.amazonaws.com", "rca_dev", "devrca!23", 'rca_website_new');
    mysqli_select_db($con, "rca_website_new");

    $qry = "select ap.profile_id, od.order_code, od.product_id, pm.product_name, od.applicant_booking_status,od.travel_to, od.arrival_date, 
                od.citizen_to, pt.passport_type_id, pd.pp_no, pd.pp_issue_date, pd.pp_expiry_date, pd.pp_issuing_govt,
                pd.pp_place_of_issue, pd.pp_isactive, pd.oth_ppt, pd.prev_passport_country_issue, pd.other_ppt_no, 
                pd.other_ppt_issue_place, pd.other_ppt_issue_date, pd.other_ppt_nationality, ap.username, ap.surname,
                ap.previous_name, ap.previous_surname, od.order_id, ap.dob, ap.gender, ms.marital_status_code, ap.nationality, ap.place_of_birth, ap.country_of_birth, ap.religion, ap.mobile_number, 
                ap.refer_flag, ap.prev_nationality, ap.qualification, ap.aquired_nation, ap.visible_marks, ap.citizenship_no,
                ar.pres_add1, ar.pres_add2, addr_c.country_name as addr_country, ar.state_name, ar.pincode, ar.pres_phone, 
                ar.perm_address1, ar.perm_address2, ar.perm_address3, 
                ar.father_name, c1.country_id as father_nationality, c2.country_id as father_previous_nationality, 
                father_place_of_birth, c3.country_id as father_country_of_birth, 
                ar.mother_name, c4.country_id as mother_nationality, c5.country_id as mother_previous_nationality, 
                mother_place_of_birth, c6.country_id as mother_country_of_birth, 
                ar.spouse_name, c7.country_id as spouse_nationality, c8.country_id as spouse_previous_nationality, 
                ar.spouse_place_of_birth, c9.country_id as spouse_country_of_birth, 
                ar.grandparent_flag1, ar.grandparent_details, 
                ar.pre_occupation, ar.occ_flag, ar.empname, empdesignation, ar.empaddress, ar.empphone, ar.previous_occupation, 
                prev_org, previous_organization, previous_designation, previous_rank, previous_posting,
                vad.type_of_visa, vad.visa_service, 
                vad.service_req_form_values, vad.visa_duration, vad.no_entries, vad.airport_name,
                vad.service_purpose_json, vad.airport_id, aird1.code as entry_port_code,  aird2.code as exit_port_code, vad.old_visa_flag, vad.prv_visit_add1, vad.visited_city, 
                vad.old_visa_no, vad.old_visa_type_id, vad.oldvisaissueplace, oldvisaissuedate, 
                refuse_flag, refuse_details, country_visited, saarc_flag, vad.saarc_details, 
                vad.nameofsponsor_ind, vad.add1ofsponsor_ind, vad.phoneofsponsor_ind, 
                vad.nameofsponsor_msn, vad.add1ofsponsor_msn, vad.phoneofsponsor_msn, vad.status
                FROM applicant_profiles ap
                left join order_details od on ap.order_id = od.order_id
                join product_master pm on od.product_id = pm.product_id
                join passport_types pt on pt.passport_type_id = od.passport_type
                left join passport_details pd on pd.applicant_id = ap.profile_id
                left join marital_status ms on ms.marital_status_id = ap.marital_status_id
                left join application_relationdetails ar on ar.applicant_id=  ap.profile_id
                left join countries c on c.country_id =  ap.nationality
                left join countries addr_c on addr_c.country_id = ar.pres_country
                left join countries c1 on c1.country_id = ar.father_nationality
                left join countries c2 on c2.country_id = ar.father_previous_nationality
                left join countries c3 on c3.country_id = ar.father_country_of_birth
                left join countries c4 on c4.country_id = ar.mother_nationality
                left join countries c5 on c5.country_id = ar.mother_previous_nationality
                left join countries c6 on c6.country_id = ar.mother_country_of_birth
                left join countries c7 on c7.country_id = ar.spouse_nationality
                left join countries c8 on c8.country_id = ar.spouse_previous_nationality
                left join countries c9 on c9.country_id = ar.spouse_country_of_birth
                join tbl_visa_app_details vad on vad.applicant_id = ap.profile_id
                join airport_details aird1 on aird1.airport_id = vad.airport_id
                join airport_details aird2 on aird2.airport_id = vad.pres_country
                where vad.order_integration_flag = 'N' 
                and payment_status = 'success'
                and od.product_id = 1";

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
        $p = json_decode($value['service_purpose_json']);
        $order_id = $value['order_id'];
        $appl_id = $value['profile_id'];

        //get documents
        $documents = array();
        $dd = mysqli_query($con, "select doc_type, doc_url from document_details where applicant_id = $appl_id");
        while($v = mysqli_fetch_assoc($dd)) {
            $doc_type = $v['doc_type'];
            $doc_url = $v['doc_url'];
            $documents[$doc_type] = $doc_url;
        }

        $pass_front_url = "http://dev.redcarpetassist.com/rca_website_l/public".$documents['PASSPORT_FRONT'];
        $photo_url = "http://dev.redcarpetassist.com/rca_website_l/public".$documents['PHOTO'];
        $business_card_url = "http://dev.redcarpetassist.com/rca_website_l/public".$documents['BUSINESS_CARD'];
        $hospital_letter_url = "http://dev.redcarpetassist.com/rca_website_l/public".$documents['HOSPITAL_LETTER'];
        
        //get purposes
        $purposes = mysqli_query($con, "select service_id, purpose_id from tbl_user_service_details where applicant_id = $appl_id and order_id = $order_id");
        $get = array();
         while ($r = mysqli_fetch_assoc($purposes)) {
            $serv = $r['service_id'];
            $purp = $r['purpose_id'];
            $get[$serv] = $purp;
         }

        if (isset($get[1])) $tourist_purpose = $get[1];
        if (isset($get[2])) $business_purpose = $get[2];
        if (isset($get[3])) $medical_purpose = $get[3];

        //get selected visa services
        $vserv;
        if (count($value['visa_service']) == 1) { $vserv = $value['visa_service']; }
        else{
            $vs = explode(", ", $value['visa_service']);
            $vservice = array_map(function ($vserv){
                return "^".$vserv."^";
            }, $vs);
            $vserv = implode(",", $vservice);
        }
        //if acquired nationality 
        $acqire = strtolower(str_replace(" ", "_", $value['aquired_nation']));

        //saarc details
        $visited_saarc = $value['saarc_details'];
        $saarc_array = json_decode($visited_saarc, true);

        $a = array();
        foreach ($saarc_array['saarcCountry'] as $key => $val) {
            $a[] = array_column($saarc_array, $key);
        }

        $saarc_details = "";
        foreach ($a as $kk => $aa) {
            $cid = $aa[0];
            $scountry = mysqli_query($con, "select country_name from countries where country_id = $cid");
            foreach ($scountry as $cc => $rr) {
            }
            $saarc_details .= $rr['country_name']."  ".$aa[1]."  ".$aa[2]."\n\n";
        }
            
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
            "nationality_mention_another__c" => $value['other_ppt_nationality'],
            "first_name" => $value['username'],
            "last_name" => $value['surname'],
            "prev_surname_c" => $value['previous_surname'],
            "prev_givenname_c" => $value['previous_name'],
            "phone_mobile" => $value['mobile_number'],
            "birthdate" => $value['dob'],
            "birth_country_c" => $value['country_of_birth'],
            "gender_c" => $value['gender'],
            "applicant_occupation_c" => $value['pre_occupation'],
            "nationality_c" => $value['nationality'],
            "marital_status_c" => $value['marital_status_code'],
            "if_lived_two_years_c" => $value['refer_flag'],
            "religion_c" => $value['religion'],
            "educational_qualification_c" => $value['qualification'],
            "visible_identification_mark_c" => $value['visible_marks'],
            "birth_city_c" => $value['place_of_birth'],
            "national_id_c" => $value['citizenship_no'],
            //student guardian details
            "student_guardian_c " => $value['occ_flag'],
            "guardian_employer_name_c" => $value['empname'],
            "guardian_designation_c" => $value['empdesignation'],
            "guardian_employer_phone_c" => $value['empphone'],
            "guardian_employer_address_c" => $value['empaddress'],
            "applicant_prev_occupation_c" => $value['previous_occupation'],
            "is_militar_police_profession_c" => $value['prev_org'],
            "military_organisation_c" => $value['previous_organization'],
            "military_desgnation_c" => $value['previous_designation'],
            "military_rank_c" => $value['previous_rank'],
            "military_place_of_posting_c" => $value['previous_posting'],
            "primary_address_street" => $value['pres_add1'],
            "primary_address_city" => $value['pres_add2'],
            "primary_address_postalcode" => $value['pincode'],
            "primary_address_state" => $value['state_name'],
            "primary_address_country" => $value['addr_country'],
            "alt_address_street" => $value['perm_address1'],
            "alt_address_city" => $value['perm_address2'],
            "alt_address_state" => $value['perm_address3'],
            //father details
            "father_legal_guardian_c" => $value['father_name'],
            "father_nationality_c" => $value['father_nationality'],
            "father_prev_nationality_c" => $value['father_previous_nationality'],
            "father_place_of_birth_c" => $value['father_place_of_birth'],
            "father_country_of_birth_c" => $value['father_country_of_birth'],
            //mother details
            "mother_name_c" => $value['mother_name'],
            "mother_nationality_c" => $value['mother_nationality'],
            "mother_prev_nationality_c" => $value['mother_previous_nationality'],
            "mother_place_of_birth_c" => $value['mother_place_of_birth'],
            "mother_country_of_birth_c" => $value['mother_country_of_birth'],
            //spouse details
            "spouse_name_c" => $value['spouse_name'],
            "spouse_nationality_c" => $value['spouse_nationality'],
            "spouse_prev_nationality_c" => $value['spouse_previous_nationality'],
            "apouse_place_of_birth_c" => $value['spouse_place_of_birth'],
            "spouse_country_of_birth_c" => $value['spouse_country_of_birth'],
            //grandparent details
            "grandparents_from_pak_c" => $value['grandparent_flag1'],
            "grandparents_details_c" => $value['grandparent_details'],
            //passport details
            "passport_number_c" => $value['pp_no'],
            "passport_type_c" => $value['passport_type_id'],
            "issue_date_c" => $value['pp_issue_date'],
            "expiry_date_c" => $value['pp_expiry_date'],
            "place_of_issue_c" => $value['pp_place_of_issue'],
            //other passport details
            "nationality_acquire_by_c" => $acqire,
            "any_other_passport_ic_c" => $value['oth_ppt'],
            "another_passport_ic_no_c" => $value['other_ppt_no'],
            "another_country_of_issue_c" => $value['prev_passport_country_issue'],
            "place_of_issue_another_pp_ic_c" => $value['other_ppt_issue_place'],
            "date_of_issue_another_pp_ic_c" => $value['other_ppt_issue_date'],
            "nationality_mention_another__c" => $value['other_ppt_nationality'],
            //visa details
            "etourist_visa_purposes_c" => $tourist_purpose,
            "emedical_visa_purpose_c" => $medical_purpose,
            "ebusiness_visa_purpose_c" => $business_purpose,
            "service_type_c" => $vserv,
            "port_of_entry_c" => $value['entry_port_code'],
            "port_of_exit_c" => $value['exit_port_code'],
            "expected_date_arrival_c" => $value['arrival_date'],
            "visited_india_before_c" => $value['old_visa_flag'],
            "visited_before_address_1_c" => $value['prv_visit_add1'],
            "cities_visited_before_c" => $value['visited_city'],
            "countries_visited_c" => $value['country_visited'],
            "last_current_visa_no_c" => $value['old_visa_no'],
            "prev_type_of_visa_c" => $value['old_visa_type_id'],
            "prev_place_of_issue_c" => $value['oldvisaissueplace'],
            "prev_date_of_issue_c" => $value['oldvisaissuedate'],
            "permission_refused_prev_c" => $value['refuse_flag'],
            "permission_refused_prev_whom_c" => $value['refuse_details'],
            "is_visited_saarc_prev_c" => $value['saarc_flag'],
            "saarc_details_c" => $saarc_details,
            "ref_name_india_c" => $value['nameofsponsor_ind'],
            "ref_addr_india_c" => $value['add1ofsponsor_ind'],
            "ref_phone_india_c" => $value['phoneofsponsor_ind'],
            "ref_name_appl_country_c" => $value['nameofsponsor_msn'],
            "ref_addr_appl_country_c" => $value['add1ofsponsor_msn'],
            "ref_phone_appl_country_c" => $value['phoneofsponsor_msn'],
            //documents
            "document_1_c" => $pass_front_url,
            "document_2_c" => $photo_url,
            "document_3_c" => $business_card_url,
            "document_4_c" => $hospital_letter_url,
            "assigned_user_id" => "6888b579-9471-ce46-a07d-5b4dcdffa7db"    
        );
        
        //applicant purpose data
        $purparray = array(
            "name" => $value['username']." ".$value['surname'],
            "order_code_c" => $value['order_code'],
            //meeting friends relatives
            "frnd_name_c" => $p->service_req_meeting_frend->frnd_name,
            "frnd_phone_c" => $p->service_req_meeting_frend->frnd_phone,
            "frnd_address_c" => $p->service_req_meeting_frend->frnd_address,
            "frnd_district_c" => $p->service_req_meeting_frend->frnd_district,
            "frnd_state_c" => $p->service_req_meeting_frend->frnd_state,
            //short term yoga
            "yoga_institute_name_c" => $p->service_req_short_yoga->yoga_institute_name,
            "yoga_institute_phone_no_c" => $p->service_req_short_yoga->yoga_institute_phone_no,
            "yoga_institute_address_c" => $p->service_req_short_yoga->yoga_institute_address,
            "yoga_institute_district_c" => $p->service_req_short_yoga->yoga_institute_district,
            "yoga_institute_state_c" => $p->service_req_short_yoga->yoga_institute_state,
            //conducting tours
            "travel_name_address_c" => $p->service_req_con_tours->travel_name_address,
            "travel_city_name_c" => $p->service_req_con_tours->travel_city_name,
            "travel_name_c" => $p->service_req_con_tours->travel_name,
            "travel_phone_no_c" => $p->service_req_con_tours->travel_phone_no,
            "travel_address_c" => $p->service_req_con_tours->travel_address,
            //participation in exhibition
            "exhi_name_c" => $p->service_req_part_exhi->exhi_name,
            "exhi_phone_no_c" => $p->service_req_part_exhi->exhi_phone_no,
            "exhi_address_c" => $p->service_req_part_exhi->exhi_address,
            "exhi_website_c" => $p->service_req_part_exhi->exhi_website,
            "exhi_name_address_c" => $p->service_req_part_exhi->exhi_name_address,
            //expert specialist
            "expart_co_name_c" => $p->service_req_exp_spe->expart_co_name,
            "expert_co_phone_c" => $p->service_req_exp_spe->expert_co_phone,
            "expert_co_address_c" => $p->service_req_exp_spe->expert_co_address,
            "expert_co_website_c" => $p->service_req_exp_spe->expert_co_website,
            "firm_name_c" => $p->service_req_exp_spe->firm_name,
            "firm_address_c" => $p->service_req_exp_spe->firm_address,
            "firm_phone_c" => $p->service_req_exp_spe->firm_phone,
            "firm_website_c" => $p->service_req_exp_spe->firm_website,
            //purchase
            "purchase_name_c" => $p->service_req_form_purchase->purchase_name,
            "purchase_phone_no_c" => $p->service_req_form_purchase->purchase_phone_no,
            "purchase_address_c" => $p->service_req_form_purchase->purchase_address,
            "purchase_website_c" => $p->service_req_form_purchase->purchase_website,
            "purchase_nature_business_c" => $p->service_req_form_purchase->purchase_nature_business,
            //setup venture
            "venture_name_c" => $p->service_req_business_venture->venture_name,
            "venture_phone_no_c" => $p->service_req_business_venture->venture_phone_no,
            "venture_address_c" => $p->service_req_business_venture->venture_address,
            "venture_website_c" => $p->service_req_business_venture->venture_website,
            "venture_nature_business_c" => $p->service_req_business_venture->venture_nature_business,
            //meeting
            "meet_co_name_c" => $p->service_req_business_meeting->meet_co_name,
            "meet_co_phone_no_c" => $p->service_req_business_meeting->meet_co_phone_no,
            "meet_co_address_c" => $p->service_req_business_meeting->meet_co_address,
            "meet_co_webiste_c" => $p->service_req_business_meeting->meet_co_webiste,
            "meet_firm_name_c" => $p->service_req_business_meeting->meet_firm_name,
            "meet_firm_phone_c" => $p->service_req_business_meeting->meet_firm_phone,
            "meet_firm_address_c" => $p->service_req_business_meeting->meet_firm_address,
            "meet_firm_wbsite_c" => $p->service_req_business_meeting->meet_firm_wbsite,
            //recruiting manpower
            "recruit_name_c" => $p->service_req_recruit_manpower->recruit_name,
            "recruit_phone_no_c" => $p->service_req_recruit_manpower->recruit_phone_no,
            "recruit_address_c" => $p->service_req_recruit_manpower->recruit_address,
            "recruit_website_c" => $p->service_req_recruit_manpower->recruit_website,
            "recruit_nature_job_c" => $p->service_req_recruit_manpower->recruit_nature_job,
            "recruit_name_contact_c" => $p->service_req_recruit_manpower->recruit_name_contact,
            "recruit_place_c" => $p->service_req_recruit_manpower->recruit_place,
            //medical treatment
            "hospital_name_c" =>$p->service_req_short_medical->hospital_name,
            "type_of_medical_c" => $p->service_req_short_medical->type_of_medical,
            "hospital_address_c " => $p->service_req_short_medical->hospital_address,
            "hospital_phone_no_c" => $p->service_req_short_medical->hospital_phone_no,
            "hospital_district_c" => $p->service_req_short_medical->hospital_district,
            "hospital_state_c" => $p->service_req_short_medical->hospital_state
        );

        echo "<pre>";
        print_r($arrayvar);
        echo "</pre>";

        $set_entr_params = array(
            "session" => $session_id,
            "module_name" => "Contacts",
            "name_value_list" => $arrayvar
        );

        $set_entr_purp_params = array(
            "session" => $session_id,
            "module_name" => "ivp_evisa_purposes",
            "name_value_list" => $purparray
        );

       $lead_res = call("set_entry", $set_entr_params, $url);
       $purpose_res = call("set_entry", $set_entr_purp_params, $url);
        if ($lead_res && $purpose_res){
            echo "<pre>";
            var_dump($lead_res)."<br>";
            var_dump($purpose_res);
            echo "</pre>";

            $qry1 = "update tbl_visa_app_details set order_integration_flag = 'Y' where applicant_id = $appl_id and order_integration_flag = 'N'";
            $res1 = mysqli_query($con, $qry1);

        }
    }


?>
