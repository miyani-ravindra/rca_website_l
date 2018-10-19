$(document).ready(function () {
    
    $("#CustomTypeFormForSrilanka").validate({
        ignore: [],
        rules: {
            passport_given_name: {
                required: true,
                alpha:true,
                minlength: 2,
                maxlength: 50
            },
            passport_surname_name: {
                required: true,
                alpha:true,
                minlength: 2,
                maxlength: 50
            },
            passport_number: {
                required: true,
                minlength: 8,
            },
            email_id: {
                required: true
            },
            mobile_num: {
                required: true,
            },
            address: {
                required: true
            },
            gender_text: {
                required: true,
            },
            travel_type_text: { 
                required: true
            },
            occupation: {
                alpha: true
            },
            telephone_number_tourist: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                }
            },
            salutation_text: {
                required: true
            },
            nationality_dropdown_text: {
                required: true
            },
            country_of_birth_text: {
                required: true
            },
            port_of_departure: {
                alpha : function(element) {
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                }
            },
            // "child_given_name[]": {
            //     required: function(element){
            //         return $('input[name="alias_is"]').val()=="Y";
            //     },
            //     alpha: function(element){
            //         return $('input[name="alias_is"]').val()=="Y";
            //     },
            //     minlength: 2,
            // },
            // "child_surname_name[]": {
            //     required: function(element){
            //         return $('input[name="alias_is"]').val()=="Y";
            //     },
            //     alpha: function(element){
            //         return $('input[name="alias_is"]').val()=="Y";
            //     },
            //     minlength: 2,
            // },
            // "child_gender_text[]": {
            //     required: function(element){
            //         return $('input[name="alias_is"]').val()=="Y";
            //     },
            //     alpha: function(element){
            //         return $('input[name="alias_is"]').val()=="Y";
            //     },
            // },
            // "child_relation_text[]": {
            //     required: function(element){
            //         return $('input[name="alias_is"]').val()=="Y";
            //     },
            //     alpha: function(element){
            //         return $('input[name="alias_is"]').val()=="Y";
            //     },
            // },
            arrival_date: {
                required: true,
            },
            airline_vessel: {
                alphanumeric : true
            },
            purpose_of_visit_text_tourist: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="tourist";
                }
            },
            purpose_of_visit_text_business: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            purpose_of_visit_text_transit: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="transit";
                }
            },
            purpose_description: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            intended_stay_days_text: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="transit";
                }
            },
            final_destination: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="transit";
                },
                alphanumeric: function(element) {
                    return $('input[name="travel_type"]').val()=="transit";
                }
            },
            address_line_one_tourist: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                },
                alphanumeric: function(element) {
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                }
            },
            address_line_two_tourist: {
                alphanumeric: function(element) {
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                }
            },
            city_tourist: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                },
                alpha : function(element) {
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                }
            },
            state_tourist: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                },
                alpha: function(element) {
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                }
            },
            country_tourist_text: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                }
            },
            address_line_in_srilanka_tourist: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                }
            },
            zipcode_tourist: {
                alphanumeric: function(element) {
                    return $('input[name="travel_type"]').val()=="tourist" || $('input[name="travel_type"]').val()=="transit";
                }
            },
            applicant_telephone_number_business: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            applicant_email_id_business: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            applicant_company_name_business: {
                alphanumeric: function(element) {
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            applicant_address_line_one_business: {
                alphanumeric: function(element) {
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            applicant_address_line_two_business: {
                alphanumeric: function(element) {
                    return $('input[name="travel_type"]').val()=="business";
                } 
            },
            applicant_city_business: {
                alpha: function(element) {
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            applicant_state_business: {
                alpha: function(element) {
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            applicant_zipcode_business: {
                numeric: function(element) {
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            srilankan_company_name_business: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="business";
                },
                alphanumeric: function(element) {
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            srilankan_address_line_one_business: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            srilankan_city_business: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="business";
                },
                alpha: function(element) {
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            srilankan_state_business: {
                alpha: function(element) {
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            srilankan_zipcode_business: {
                alphanumeric: function(element) {
                    return $('input[name="travel_type"]').val()=="business"; 
                }
            },
            srilankan_telephone_number_business: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            is_valid_resident_visa_to_srilanka_tourist: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="tourist";
                }
            },
            is_currently_in_srilanka_with_valid_eta_tourist: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="tourist";
                }
            },
            have_multiple_entry_visa_to_srilanka_tourist: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="tourist";
                }
            },
            i_agree_terms: {
                required: true
            },
            is_valid_resident_visa_to_srilanka_business: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            have_multiple_entry_visa_to_srilanka_business: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            is_currently_in_srilanka_with_valid_eta_business: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="business";
                }
            },
            is_valid_resident_visa_to_srilanka_transit: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="transit";
                }
            },
            have_multiple_entry_visa_to_srilanka_transit: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="transit";
                }
            },
            is_currently_in_srilanka_with_valid_eta_transit: {
                required: function(element){
                    return $('input[name="travel_type"]').val()=="transit";
                }
            },  
            type_doi_srilanka: {
                required: true
            },
            type_doe_srilanka: {
                required: true,
                //expiryValidator: true           
            },
            type_dob_srilanka: {
                required: true
            },
            // "child_type_dob_srilanka[]": {
            //     required: true
            // },
            alias_is: {
                required: true
            },
            flight_vessel_number: {
                alphanumeric : true
            }
        },
        messages: {
            passport_given_name: {
                required:'Please enter your Given/Other Names',
                alpha: "Enter alphabet only"
            },
            passport_surname_name: {
                required:'Please enter your Family/Surname',
                alpha: "Enter alphabet only"
            },
            email_id: {
                required: "Please your Contact Email"
            },
            
            hk_travel_fund_text: "Please select the available funds range for the trip",
           
            passport_number: 'Please enter your valid passport number',
            gender_text: 'Please select your gender',
            address: 'Enter Your Correct Address',
            travel_type_text: "Please select the travel type", 
            telephone_number_tourist: "Please enter your telephone number", 
            salutation_text: "Please select your Title",
            nationality_dropdown_text: "Please select your nationality",
            country_of_birth_text: "Please select your country of birth",
            occupation: "Please enter only alphabets",
            port_of_departure: "Please enter only alphabets",
            airline_vessel: "Please enter alphabet or number",
            flight_vessel_number: "Please enter only alphabets or number",
            // "child_given_name[]": {
            //     required:'Please enter your child given name',
            //     alpha: "Enter alphabet only"
            // },
            // "child_surname_name[]": {
            //     required:'Please enter your child given name',
            //     alpha: "Enter alphabet only"
            // },
            // "child_gender_text[]": 'Please select your child gender',
            // "child_relation_text[]": 'Please select Relationship',
            arrival_date: 'Please enter your Intended Arrival Date',
            purpose_of_visit_text_tourist: 'Please select your purpose of visit',
            purpose_of_visit_text_business: 'Please select your purpose of visit',
            purpose_of_visit_text_transit: 'Please select your purpose of visit',
            purpose_description: 'Please enter the purpose description',
            intended_stay_days_text: 'Please select number of days in Sri Lanka',
            final_destination: {
                required: 'Please enter the final destination',
                alphanumeric: "Please enter only alphabets or number"
            },
            address_line_one_tourist: {
                required: 'Please enter first line of your address',
                alphanumeric: "Please enter only alphabets or number"
            },
            address_line_two_tourist: {
               alphanumeric: "Please enter only alphabets or number" 
            },
            city_tourist: {
                required: 'Please enter your city of residence',
                alpha: "Please enter only alpha"
            },
            state_tourist: {
                required: 'Please enter your state of residence',
                alpha: "Please enter only alphabets"
            },
            country_tourist_text: 'Please enter your country of residence',
            address_line_in_srilanka_tourist: 'Please enter address in Sri Lanka',
            applicant_company_name_business: {
                alphanumeric:"Please enter only alphabets"
            },
            applicant_address_line_one_business: {
                alphanumeric: "Please enter only alphabets and number"
            },
            applicant_address_line_two_business: {
                alphanumeric: "Please enter only alphabets and number"
            },
            applicant_city_business: {
                alpha: "Please enter only alphabets"
            },
            applicant_state_business: {
                alpha: "Please enter only alphabets"
            },
            applicant_zipcode_business: {
                numeric: "Please enter only number"
            },
            applicant_telephone_number_business: "Please Enter Your Phone Number", 
            applicant_email_id_business: "Please input a valid email address", 
            srilankan_company_name_business: {
                required: "Please Enter Company Name",
                alphanumeric: "Please enter only alphabets or number"
            },
            srilankan_address_line_one_business: 'Please Enter Company Address Line One',
            srilankan_city_business: {
                required:'Please Enter City of Company',
                alpha: "Please enter only alphabets"
            },
            srilankan_state_business: {
                alpha: "Please enter only alphabets"
            },
            srilankan_zipcode_business: {
                alphanumeric: "Please enter only alphabets or number"
            },
            srilankan_telephone_number_business: "Please Enter Company Telephone Number", 
            is_valid_resident_visa_to_srilanka_tourist: "Please answer question before continuing",
            is_currently_in_srilanka_with_valid_eta_tourist: "Please answer question before continuing",
            have_multiple_entry_visa_to_srilanka_tourist: "Please answer question before continuing",
            i_agree_terms: "Please tick on the checkbox to agree that information is correct",
            is_valid_resident_visa_to_srilanka_business: "Please answer question before continuing",
            have_multiple_entry_visa_to_srilanka_business: "Please answer question before continuing",
            is_currently_in_srilanka_with_valid_eta_business: "Please answer question before continuing",
            is_valid_resident_visa_to_srilanka_transit: "Please answer question before continuing",
            have_multiple_entry_visa_to_srilanka_transit: "Please answer question before continuing",
            is_currently_in_srilanka_with_valid_eta_transit: "Please answer question before continuing",
            type_doi_srilanka: "Please enter your passport issued date",
            type_doe_srilanka: "Please enter your passport expiry date",
            type_dob_srilanka: "Please enter your Date of Birth",
            // "child_type_dob_srilanka[]": "Please enter your date of birth",
            alias_is :"Please answer the required question",
            zipcode_tourist: {
                alphanumeric: "Please enter only alphabets or number"
            }
        },
        errorElement: 'div',
        errorClass: 'error-block',        
        errorPlacement: function (error, element) {

                // console.log('srilanka form validataion');
                console.log(element);
                if (element.prop("type") === "file") {
                    error.insertAfter(element.parent().parent());
                }else if(element.prop("type") === "radio"){
                    error.insertAfter(element.parent().parent());
                }else if(element.prop("type") === "checkbox"){
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
        }
    });


    $(".tourist").hide();
    $(".contact-div").hide();
    $(".business").hide();
    $(".transit").hide();
    $(".alias_is").hide();



    $('.travel_type_data').on('click',function(){

        var travel_type_value = $(this).attr('data-val');
        $(".tourist").hide();
        $(".contact-div").hide();
        $(".business").hide();
        $(".transit").hide();

        if(travel_type_value == "tourist"){
            $(".tourist").show();
            $(".contact-div").show();
        }else if(travel_type_value == "business"){
            $(".business").show();
        }else if(travel_type_value == "transit"){
            $(".transit").show();
            $(".contact-div").show();
        }
    });


 
    $("input[type=radio][name=is_valid_resident_visa_to_srilanka_tourist]").change(function () {        
        var value = $(this).val();
        
        $('#srilanka_submit').removeAttr('disabled');
        if(value == "Y"){
            $('#srilanka_submit').attr('disabled','');
            var validator = $( "#CustomTypeFormForSrilanka" ).validate();
            validator.showErrors({"is_valid_resident_visa_to_srilanka_tourist": "You are not eligible for Visa."});
        }
    });

    $("input[type=radio][name=is_currently_in_srilanka_with_valid_eta_tourist]").change(function () {        
        var value = $(this).val();
        
        $('#srilanka_submit').removeAttr('disabled');
        if(value == "Y"){
            $('#srilanka_submit').attr('disabled','');
            var validator = $( "#CustomTypeFormForSrilanka" ).validate();
            validator.showErrors({"is_currently_in_srilanka_with_valid_eta_tourist": "You are not eligible for Visa."});
        }
    });
    

    $("input[type=radio][name=have_multiple_entry_visa_to_srilanka_tourist]").change(function () {        
        var value = $(this).val();
        
        $('#srilanka_submit').removeAttr('disabled');
        if(value == "Y"){
            $('#srilanka_submit').attr('disabled','');
            var validator = $( "#CustomTypeFormForSrilanka" ).validate();
            validator.showErrors({"have_multiple_entry_visa_to_srilanka_tourist": "You are not eligible for Visa."});
        }
    });


    $("input[type=radio][name=is_valid_resident_visa_to_srilanka_business]").change(function () {        
        var value = $(this).val();
        
        $('#srilanka_submit').removeAttr('disabled');
        if(value == "Y"){
            $('#srilanka_submit').attr('disabled','');
            var validator = $( "#CustomTypeFormForSrilanka" ).validate();
            validator.showErrors({"is_valid_resident_visa_to_srilanka_business": "You are not eligible for Visa."});
        }
    });

    $("input[type=radio][name=have_multiple_entry_visa_to_srilanka_business]").change(function () {        
        var value = $(this).val();
        
        $('#srilanka_submit').removeAttr('disabled');
        if(value == "Y"){
            $('#srilanka_submit').attr('disabled','');
            var validator = $( "#CustomTypeFormForSrilanka" ).validate();
            validator.showErrors({"have_multiple_entry_visa_to_srilanka_business": "You are not eligible for Visa."});
        }
    });
    
    $("input[type=radio][name=is_currently_in_srilanka_with_valid_eta_business]").change(function () {        
        var value = $(this).val();
        
        $('#srilanka_submit').removeAttr('disabled');
        if(value == "Y"){
            $('#srilanka_submit').attr('disabled','');
            var validator = $( "#CustomTypeFormForSrilanka" ).validate();
            validator.showErrors({"is_currently_in_srilanka_with_valid_eta_business": "You are not eligible for Visa."});
        }
    });

    $("input[type=radio][name=is_valid_resident_visa_to_srilanka_transit]").change(function () {        
        var value = $(this).val();
        
        $('#srilanka_submit').removeAttr('disabled');
        if(value == "Y"){
            $('#srilanka_submit').attr('disabled','');
            var validator = $( "#CustomTypeFormForSrilanka" ).validate();
            validator.showErrors({"is_valid_resident_visa_to_srilanka_transit": "You are not eligible for Visa."});
        }
    });
   
    $("input[type=radio][name=have_multiple_entry_visa_to_srilanka_transit]").change(function () {        
        var value = $(this).val();
        
        $('#srilanka_submit').removeAttr('disabled');
        if(value == "Y"){
            $('#srilanka_submit').attr('disabled','');
            var validator = $( "#CustomTypeFormForSrilanka" ).validate();
            validator.showErrors({"have_multiple_entry_visa_to_srilanka_transit": "You are not eligible for Visa."});
        }
    });

    $("input[type=radio][name=is_currently_in_srilanka_with_valid_eta_transit]").change(function () {        
        var value = $(this).val();
        
        $('#srilanka_submit').removeAttr('disabled');
        if(value == "Y"){
            $('#srilanka_submit').attr('disabled','');
            var validator = $( "#CustomTypeFormForSrilanka" ).validate();
            validator.showErrors({"is_currently_in_srilanka_with_valid_eta_transit": "You are not eligible for Visa."});
        }
    });


    //This is for child information hide show. - START
    // $("input[type=radio][name=alias_is]").change(function () {      
    //     var value = $(this).val();
    //     var inputs = document.getElementsByClassName('child-input-class');
    //     $(".alias_is").hide();
    //     $(".fieldGroup").hide();
    //     $(".fieldGroup input *").prop('disabled',true);
    //     $(".fieldGroup input[name='child_given_name[]']").removeAttr('required');
    //     $(".fieldGroup input[name='child_surname_name[]']").removeAttr('required');
    //     $(".fieldGroup input[name='child_type_dob_srilanka[]']").removeAttr('required');
    //     $(".fieldGroup input[name='child_gender_text[]']").removeAttr('required');
    //     $(".fieldGroup input[name='child_relation_text[]']").removeAttr('required');
    //     var inputs = $('.fieldGroup').find('input');
    //     for(var i = 0; i < inputs.length; i++) {
    //                 inputs[i].value = "";
    //     }
    //     // $('.fieldGroup').remove();
    //     $('#child_div_msg').html("Child: <span class='badge'>"+$('body').find('.fieldGroup').length+"</span>");
    //     //console.log(inputs.length);
    //     for(var i = 0; i < inputs.length; i++) {
    //         inputs[i].disabled = true;
    //     }
    //     if(value == "Y"){
    //         $(".alias_is").show();
    //         $(".fieldGroup").show();
    //         $(".fieldGroup input[name='child_given_name[]']").attr('required','');
    //         $(".fieldGroup input[name='child_surname_name[]']").attr('required','');
    //         $(".fieldGroup input[name='child_type_dob_srilanka[]']").attr('required','');
    //         $(".fieldGroup input[name='child_gender_text[]']").attr('required','');
    //         $(".fieldGroup input[name='child_relation_text[]']").attr('required','');

    //         for(var i = 0; i < inputs.length; i++) {
    //             inputs[i].disabled = false;
    //         }                  
    //     }
    // });
    //This is for child information hide show. - END

    //$('.outerInFoc input').attr('readonly', '');

    // $('.outerInFoc input').click(function(e){
    //         // Prevent any action on the window location
    //         e.preventDefault();
    //         $(this).siblings('.hiddenul').toggle();
    //         // Cache useful selectors
    //         $li = $(this);
    //         $input = $li.parent("ul").prev("input");
    //         // Update input text with selected entry
    //         if (!$li.is(".no-matches")) {
    //             $input.val($li.text());
    //         }
    // });

    // $('.outerInFoc input').keyup( function(event){
    //     var $input = $(this);
    //     var $dropdown = $input.siblings('ul.hiddenul');
    // });

    // $('.outerInFoc input').focus( function(event){
    //     var $input = $(this);
    //     var $dropdown = $input.siblings('ul.hiddenul');
    // });


    // $('.outerInFoc li').click(function(){
    //     var dd      = $(this).text();
    //     var dval    = $(this).attr('data-val');
    //     $(this).parent('ul').hide();
    //     $(this).parent().siblings('.inputF').val(dd).focus();
    //     $(this).parent().siblings('.inputH').val(dval).focus();

    //     // If it is travel type than calling travel type's click method for showing/hiding respected elements - START
    //     var travel_type_arr = new Array("tourist","business","transit");
    //     if( travel_type_arr.includes(dval) ){
    //         $("#travel_type").click();
    //     }
    //     // If it is travel type than calling travel type's click method for showing/hiding respected elements - ENDs

    // });


    // $('.outerclick').click(function(){
    //     $('.hiddenul').hide();
    // });

    
    $("#type_doi_srilanka").flatpickr({
        altInput: true,
        altFormat: "j F, Y",
        maxDate: "today",
        dateFormat: "Y-m-d",
        disableMobile: "true",
        onChange: function(dateObj, dateStr) {
            setActiveForSrilanka();
        }
    });

    $("#type_doe_srilanka").flatpickr({
        altInput: true,
        altFormat: "j F, Y",
        minDate: "today",
        dateFormat: "Y-m-d",
        disableMobile: "true",
        onChange: function(dateObj, dateStr) {
            var val = Date.parse(dateStr);
            var valstr = dateStr;
            var validator = $( "#CustomTypeFormForSrilanka" ).validate();
            var inputname = "type_doe_srilanka";

            $('#arrival_date_text').val(valstr);
              
              if (isNaN(val))
                  return false;

              var d = new Date(val);
              var f = new Date();
              f.setMonth(f.getMonth() + 6);
              if (d < f) {
                    validator.showErrors({
                            "type_doe_srilanka": "Your passpot validity is less than 6 months"
                    });
                    $('#srilanka_submit').attr('disabled','');
                  return false;
              } else {
                validator.showErrors({
                            "type_doe_srilanka": null
                });
                $('#srilanka_submit').removeAttr('disabled');
              }

            // if ( $('div.select_block').hasClass('active') ) {
            //     $('div.select_block').removeClass('active').next().click();
            // }
            setActiveForSrilanka();

            return true;
        }
    });

    $("#arrival_date_srilanka").flatpickr({
        altInput: true,
        altFormat: "j F, Y",
        minDate: "today",
        //maxDate: "2020-01-01",
        dateFormat: "Y-m-d",
        disableMobile: "true",
        onChange: function(dateObj, dateStr) {
            var val = Date.parse(dateStr);
            var doe = Date.parse($("input[name='type_doe_srilanka']").val());
            var validator = $("#CustomTypeFormForSrilanka").validate();
            var inputname = "arrival_date";
              
              if (isNaN(val))
                  return false;

              var d = new Date(val);
              var f = addMonths(new Date(doe), -6); // six months before now;
              //f.setMonth(f.getMonth() - 6);
              //console.log(f);
              if (d > f) {
                    validator.showErrors({
                            "arrival_date": "Arrival date should be atleast 180 days prior to passport expiry date"
                    });
                    $('#srilanka_submit').attr('disabled','');
                  return false;
              } else {
                validator.showErrors({
                            "arrival_date": null
                });
                $('#srilanka_submit').removeAttr('disabled');
              }

            if ( $('div.select_block').hasClass('active') ) {
                $('div.select_block').removeClass('active').next().click();
            }

            return true;
        }
    });

    $("#type_dob_srilanka").flatpickr({
        altInput: true,
        altFormat: "j F, Y",
        maxDate: "today",
        dateFormat: "Y-m-d",
        disableMobile: "true",
        onChange: function(dateObj, dateStr) {
            setActiveForSrilanka();
        }
    });

    // $('body').find('.child_type_dob_datepicker').flatpickr({
    //     altInput: true,
    //     altFormat: "j F, Y",
    //     maxDate: "today",
    //     dateFormat: "Y-m-d",
    //     disableMobile: "true",
    //     onChange: function(dateObj, dateStr) {
    //         $('.child_type_dob_datepicker').parent().closest('.input-block').next().click();
    //     }
    // });

    $('body').find('.child_type_dob_datepicker_default').flatpickr({
        altInput: true,
        altFormat: "j F, Y",
        maxDate: "today",
        dateFormat: "Y-m-d",
        disableMobile: "true",
        onChange: function(dateObj, dateStr) {
            setActiveForSrilanka();
        }
    });

    // addgroupfield();
});

function addgroupfield(){
    //group add limit
    var maxGroup = 10;
    var fielddiv = '<a href="javascript:void(0);" class="btn child_remove_button" title="Remove field"><i class="fa fa-minus" aria-hidden="true"></i></a>\
                                <div class="input-block active alias_is">\
                                        <div class="labels">\
                                            <div class="qs_list block-counter"></div>\
                                            <div class="qs_body">Enter given name of child. <span class="strike">*</span>\
                                            </div>\
                                        </div>\
                                        <div class="input-control">\
                                            <input type="text" name="child_given_name[]" id="child_given_name" class="child-input-class" required="" />\
                                            <div class="press_enter">PRESS ENTER</div>\
                                        </div>\
                                    </div>\
                                <div class="input-block active alias_is">\
                                    <div class="labels">\
                                        <div class="qs_list block-counter"></div>\
                                        <div class="qs_body">Enter surname name of child. <span class="strike">*</span>\
                                        </div>\
                                    </div>\
                                    <div class="input-control">\
                                        <input type="text" name="child_surname_name[]" id="child_surname_name" class="child-input-class" required="" />\
                                        <div class="press_enter">PRESS ENTER</div>\
                                    </div>\
                                </div>\
                                <div class="input-block alias_is">\
                                    <div class="labels">\
                                        <div class="qs_list block-counter"></div>\
                                        <div class="qs_body">Child Date of Birth <span class="strike">*</span>\
                                        <div class="qs_sub">DD/MM/YYYY</div>\
                                        </div>\
                                    </div>\
                                    <div class="input-control">\
                                        <input type="text" name="child_type_dob_srilanka[]" id="child_type_dob_srilanka" class="datepicker child_type_dob_datepicker child-input-class" required="" />\
                                        <div class="press_enter">PRESS ENTER</div>\
                                    </div>\
                                </div>\
                                <div class="input-block alias_is">\
                                    <div class="labels block-counter"> Child Gender <span class="strike">*</span></div>\
                                    <div class="input-control outerInFoc">\
                                        <input type="text" placeholder="Select an option" name="child_gender_text[]" class="__select_drop inputF child-input-class" autocomplete="off" required="">\
                                        <ul class="hiddenul">\
                                            <li class="hidden_li" data-val="male">Male</li>\
                                            <li class="hidden_li" data-val="female">Female</li>\
                                        </ul>\
                                        <input type="hidden" id="child_gender" name="child_gender[]" class="inputH">\
                                        <div class="press_enter">PRESS TAB</div>\
                                    </div>\
                                    <div class="outerclick"></div>\
                                </div>\
                                <div class="input-block alias_is">\
                                    <div class="labels block-counter"> Relationship <span class="strike">*</span></div>\
                                    <div class="input-control outerInFoc">\
                                        <input type="text" placeholder="Select an option" name="child_relation_text[]" class="__select_drop inputF child-input-class" autocomplete="off" required="">\
                                        <ul class="hiddenul">\
                                            <li class="hidden_li" data-val="child">Child</li>\
                                        </ul>\
                                        <input type="hidden" id="child_relation" name="child_relation[]" class="inputH">\
                                        <div class="press_enter">PRESS TAB</div>\
                                    </div>\
                                    <div class="outerclick"></div>\
                                </div>';
    //add more fields group
    $("body").on('click',".child_add_button",function(){
        console.log($('body').find('.fieldGroup').length);
        if($('body').find('.fieldGroup').length < maxGroup){
            var fieldHTML = '<div class="form-group fieldGroup">'+fielddiv+'</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
            var inputs = $('.fieldGroup:last').find(".child-input-class");
            for(var i = 0; i < inputs.length; i++) {
                    inputs[i].disabled = false;
            }
            //console.log(inputs.length);
            $('#child_div_msg').html("Child: <span class='badge'>"+$('body').find('.fieldGroup').length+"</span>");
            $('body').find('.child_type_dob_datepicker').flatpickr({
                altInput: true,
                altFormat: "j F, Y",
                maxDate: "today",
                dateFormat: "Y-m-d",
                disableMobile: "true",
                onChange: function(dateObj, dateStr) {
                    setActiveForSrilanka();
                }
            });
        }else{
            alert('Maximum '+maxGroup+' groups are allowed.');
        }
    });
    
    //remove fields group
    $("body").on("click",".child_remove_button",function(){ 
        $(this).parents(".fieldGroup").remove();
        var inputs = $(this).parents('.fieldGroup').find('.child_input');
        for(var i = 0; i < inputs.length; i++) {
                    inputs[i].disabled = true;
        }
        //console.log(inputs.length);
        $('#child_div_msg').html("Child: <span class='badge'>"+$('body').find('.fieldGroup').length+"</span>");
    });
}

function getDivPositions() {
      var positions = [];

      $("div.active").each(function () {
        positions.push({
          el: $(this)
        , top: $(this).offset().top
        , bottom: $(this).offset().top + $(this).height()
        });
      });
      return positions;
}

function setActiveForSrilanka() {
      var currentPosition, divPositions;
      
      currentPosition = window.pageYOffset;
      divPositions = getDivPositions();
        
      divPositions.forEach(function (d) {
        if(d.el.hasClass("active")){
           d.el.removeClass("active").next().click(); 
        } else {
            d.el.addClass("active");
        }
      });
}

function addMonths(date, months) {
  date.setMonth(date.getMonth() + months);
  return date;
}