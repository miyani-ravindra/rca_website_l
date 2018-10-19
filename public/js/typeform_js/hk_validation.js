$('#passport_given_name').keyup(function () {
    var pass_port = $('#passport_given_name').val();
    $('#passport_mapping').html(pass_port);
});
$('#btn_edit').on('click', function(e){
    
    $( ".__select_box select.__select.__readonly" ).each(function() {
      $(this).prop('disabled', false);
      $(this).css('color', "#000");
    });

    $( "input.__readonly" ).each(function() {
      $(this).prop('readonly', false);  
      $(this).prop('disabled', false);
      $(this).css('color', "#000");
    });

    $( "textarea.__readonly" ).each(function() {
      $(this).prop('readonly', false);  
      $(this).css('color', "#000");
    });

    $('.btn_submit').prop('disabled', false);
    $('#btn_close').removeClass('divhide');
    $(this).addClass('divhide');
});
$('#btn_close').on('click', function(e){
    
    $( ".__select_box select.__select.__readonly" ).each(function() {
      $(this).prop('disabled', true);
      $(this).css('color', "#999");
    });

    $( "input.__readonly" ).each(function() {
      $(this).prop('readonly', true);  
      $(this).prop('disabled', true);
      $(this).css('color', "#999");
    });

    $( "textarea.__readonly" ).each(function() {
      $(this).prop('readonly', true);  
      $(this).css('color', "#999");
    });

    $('.btn_submit').prop('disabled', true);
    $('#btn_edit').removeClass('divhide');
    $(this).addClass('divhide');
    // $('.__readonly').css('color','#000');
    // $('select.__readonly').css('color','#000 !important');
});
//Parag HongKong Form
$("#CustomTypeForm").validate({
    // onfocusout:function(element){           
    //     this.element(element)
    // },
    rules: {
        passport_given_name: {
            required: true,
            alpha:true,
            minlength: 2,
        },
        passport_surname_name: {
            required: true,
            alpha:true,
            minlength: 2,
        },
        passport_number: {
            required: true,
            minlength: 8,
        },
        place_of_issue: {
            required: true,
            alpha:true
        },
        type_doi: {
            required: true
        },
        type_doe: {
            required: true,
            //expiryValidator: true           
        },
        type_dob: {
            required: true
        },
        alias_is: {
            required: true
        },
        is_travel_oth: {
            required: true
        },
        is_local_conn: {
            required: true
        },
        is_arrested: {
            required: true
        },
        is_travel_hk: {
            required: true
        },
        alias_given_name: {
            required: function(element){
                return $('input[name="alias_is"]').val()=="Y";
            },
            alpha: function(element){
                return $('input[name="alias_is"]').val()=="Y";
            }
        },
        alias_surname_name: {
            required: function(element){
                return $('input[name="alias_is"]').val()=="Y";
            },
            alpha: function(element){
                return $('input[name="alias_is"]').val()=="Y";
            }
        },
        oth_name_is: {
            required: true
        },
        oth_given_name: {
            required: function(element){
                return $('input[name="oth_name_is"]').val()=="Y";
            },
            alpha: function(element){
                return $('input[name="oth_name_is"]').val()=="Y";
            }  
        },
        oth_surname_name: {
            required: function(element){
                return $('input[name="oth_name_is"]').val()=="Y";
            },
            alpha: function(element){
                return $('input[name="oth_name_is"]').val()=="Y";
            }
        },
        res_add_is: {
            required: true
        },
        red_add_ind: {
            required: function(element){
                return $('input[name="res_add_is"]').val()=="Y";
            }
        },
        district_city_text: {
            required: function(element){
                return $('input[name="res_add_is"]').val()=="Y";
            }
        },
        red_add_oth: {
            required: function(element){
                return $('input[name="res_add_is"]').val()=="N";
            }
        },
        district_city_oth_text: {
            required: function(element){
                return $('input[name="res_add_is"]').val()=="N";
            }
        },
        oth_pass_number: {
            required: function(element){
                return $('input[name="is_travel_oth"]').val()=="Y";
            }
        },
        local_conn_name: {
            required: function(element){
                return $('input[name="is_local_conn"]').val()=="Y";
            },
            alpha: function(element){
                return $('input[name="is_local_conn"]').val()=="Y";
            }
        },
        local_conn_relative_text: {
            required: function(element){
                return $('input[name="is_local_conn"]').val()=="Y";
            }
        },
        is_convicted: {
            required: function(element){
                return $('input[name="is_arrested"]').val()=="Y";
            }
        },
        email_id: {
            required: true
        },
        place_of_birth: {
            required: true,
            alpha: true
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
        marital_status_text: {
            required: true
        },
        is_return_ind: {
            required: true
        },
        is_refused: {
            required: true
        },
        is_refused_per: {
            required: true
        },
        is_deported: {
            required: true
        },
        is_engage: {
            required: true
        },
        emp_sector_text: {
            required: true
        },
        name_of_company: {
            required: true
        },
        add_of_company: {
            required: true
        },
        com_city_state: {
            required: true
        },
        com_phone: {
            required: true
        },
        purpose_visit_text: {
            required: true
        },
        purpose_day_text: {
            required: true
        },
        address_acco: {
            required: true
        },
        hk_travel_fund_text: {
            required: true
        }
    },
    messages: {
        passport_given_name: {
            required:'Please enter your given name',
            alpha: "Enter alphabet only"
        },
        passport_surname_name: {
            required:'Please enter your surname name',
            alpha: "Enter alphabet only"
        },
        place_of_issue: {
            required:'Please Enter the place of issue of passport',
            alpha: "Enter alphabet only"
        },
        place_of_birth: {
            required:'Please enter your place of birth',
            alpha: "Enter alphabet only"
        },
        is_travel_hk: "Please answer the required question",
        alias_is: "Please answer the required question",
        oth_name_is: "Please answer the required question",
        res_add_is: "Please answer the required question",
        is_travel_oth: "Please answer the required question",
        is_local_conn: {
            required : "Please select the local connection in HKSAR"
        },
        alias_given_name: {
            required: "Please enter your alias given in English",
            alpha: "Enter alphabet only"
        },
        alias_surname_name: {
            required: "Please enter your alias surname in English",
            alpha: "Enter alphabet only"
        },
        oth_given_name: {
            required: "Please enter your other given in English",
            alpha: "Enter alphabet only"
        },
        oth_surname_name: {
            required: "Please enter your other surname in English",
            alpha: "Enter alphabet only"
        },
        red_add_ind: {
            required: "Please enter your residential address"
        },
        district_city_text: {
            required: "Please select district/city"
        },
        red_add_oth: {
            required: "Please enter your residential address other than india"
        },
        district_city_oth_text: {
            required: "Please select district/city"
        },
        email_id: {
            required: "Please Enter Email Address"
        },
        marital_status_text: {
            required: "Please select your marital status"  
        },
        oth_pass_number: {
            required: "Please enter country/territory you have visited"  
        },
        local_conn_name: {
            required: "Please Enter local connection name/company",
            alpha: "Enter alphabet only"
        },
        local_conn_relative_text: {
            required: "Please select local connection relation"
        },
        is_convicted: {
            required: "Please answer the required question"
        },
        hk_travel_fund_text: "Please select the available funds range for the trip",
        address_acco: "Please enter the address of your accomodation",
        purpose_day_text: "Please select duration of stay",
        purpose_visit_text: "Please select purpose of visit",
        com_phone: "Please enter the telephone number",
        com_city_state: "Please select district/city of office/school",
        name_of_company: "Please enter the name of your company/employer/school",
        add_of_company: "Please Enter the address of office/school",
        emp_sector_text: "Please select employment sector",
        passport_number: 'Enter Correct Passport Number',
        type_doi: "Please enter your passport date of issue",
        type_doe: {
            required : "Please enter your passport date of expiry",
            //expiryValidator: "Your passpot validity is less than 6 months"
        },
        type_dob: "Please enter your date of birth",
        gender_text: 'Please select your gender',
        address: 'Enter Your Correct Address',
        is_return_ind: "Please answer the required question",
        is_arrested: "Please answer the required question",
        is_refused: "Please answer the required question",
        is_refused_per: "Please answer the required question",
        is_deported: "Please answer the required question",
        is_engage: "Please answer the required question"
    },
    errorElement: 'div',
    errorClass: 'error-block',
    submitHandler: function(form) {
        // return false;
        $('#CustomTypeForm')[0].submit();
    },
    errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            // if element is file type, we put the error message in its grand parent
            if (element.prop("type") === "file") {
                error.insertAfter(element.parent().parent());
            }else if(element.prop("type") === "radio"){
                error.insertAfter(element.parent().parent());
            } else {
                error.insertAfter(element);
            }
    }
});

// $('FORM[name="CustomTypeForm"]').find('input').prop('checked', false);



// $("#purpose_visit_text").on('change', function(){
//     var value = $(this).val();
//     if(value == 15){
//         $('#is_local_conn').prop('checked', true);
//         $('#local_conn_div').show();
//         $('#local_conn_div1').show();
//     } else{
//         $('#is_local_conn').prop('checked', false);
//         $('#local_conn_div').hide();
//         $('#local_conn_div1').hide();
//     }
// });

//Parag Jump Logic click on Yes/No
$('ul.purpose_visit_ul li').click(function (){
    var value = $('input[name="purpose_visit"]').val();
    if(value == 15){
        $('#is_local_conn').prop('checked', true);
        $('#local_conn_div').show();
        $('#local_conn_div1').show();
    } else{
        $('#is_local_conn').prop('checked', false);
        $('#local_conn_div').hide();
        $('#local_conn_div1').hide();
        $('input[name="local_conn_name"]').val('');
        $('input[name="local_conn_relative"]').val('');
        $('input[name="local_conn_relative_text"]').val('');
        $('#hk_submit').removeAttr('disabled');
        var validator = $( "#CustomTypeForm" ).validate();
        validator.showErrors({
                "is_local_conn": null
        });
    }
});

$("#purpose_visit_text_review").on('change', function(){
   var value = $(this).val();
    if (value == 15) {
        $('#is_local_conn').prop('checked', true);
        $('#local_conn_div').show();
        $('#local_conn_div1').show();
    } else {
        $('#is_local_conn').prop('checked', false);
        $('#local_conn_div').hide();
        $('#local_conn_div1').hide();
        $('input[name="local_conn_name"]').val('');
        $('input[name="local_conn_relative"]').val('');
        $('input[name="local_conn_relative_text"]').val('');
        $('#hk_submit').removeAttr('disabled');

        var validator = $( "#CustomTypeForm" ).validate();
        validator.showErrors({
                "is_local_conn": ""
        });
    }
    $('input[name="purpose_visit"]').val(value); 
});

$("#type_doi").flatpickr({
            altInput: true,
            //inline: true,
            altFormat: "j F, Y",
            maxDate: "today",
            //dateFormat: "Y-m-d H:i",
            dateFormat: "Y-m-d",
            disableMobile: "true",
            defaultDate: null,
            //dateFormat: "d-m-Y",
            //enableTime: true,
            onChange: function(dateObj, dateStr) {
                // console.info(dateObj);
                // console.info(dateStr);
                // var mydate = new Date(dateStr);
                // var locale = "en-us";
                // var ordDate = mydate.getDate()+" "+mydate.toLocaleString(locale, { month: "short" })+" "+mydate.getFullYear();
                // $('#traval_date').html(ordDate);
                // if ( $('div.select_block').hasClass('active') ) {
                //     $('.select_block').removeClass('active').next().click();
                // }
                setActive();
            }
});

$("#type_doe").flatpickr({
            altInput: true,
            //inline: true,
            altFormat: "j F, Y",
            minDate: "today",
            //dateFormat: "Y-m-d H:i",
            dateFormat: "Y-m-d",
            disableMobile: "true",
            defaultDate: null,
            //dateFormat: "d-m-Y",
            //enableTime: true,
            onChange: function(dateObj, dateStr) {
                // console.info(dateObj);
                // console.info(dateStr);
                // var mydate = new Date(dateStr);
                // var locale = "en-us";
                // var ordDate = mydate.getDate()+" "+mydate.toLocaleString(locale, { month: "short" })+" "+mydate.getFullYear();
                // $('#traval_date').html(ordDate);
                var val = Date.parse(dateStr);
                var validator = $( "#CustomTypeForm" ).validate();
                var inputname = "type_doe";
                  
                  if (isNaN(val))
                      return false;

                  var d = new Date(val);
                  var f = new Date();
                  f.setMonth(f.getMonth() + 6);
                  if (d < f) {
                        // var validation = {rules:{}, messages:{}} // fill in normal rules if there are any.

                        // validation.rules[inputname] = {required: true};
                        // validation.messages[inputname] = "Your passpot validity is less than 6 months";
                        // console.log(JSON.stringify(validation));
                        // $('#CustomTypeForm').validate(JSON.stringify(validation));
                        validator.showErrors({
                                "type_doe": "Your passpot validity is less than 6 months"
                        });
                        $('#hk_submit').attr('disabled','');
                      return false;
                  } else {
                    validator.showErrors({
                                "type_doe": null
                    });
                    $('#hk_submit').removeAttr('disabled');
                  }

                if ( $('div.select_block').hasClass('active') ) {
                    $('div.select_block').removeClass('active').next().click();
                }

                return true;
            }
});

$("#type_dob").flatpickr({
            altInput: true,
            //inline: true,
            altFormat: "j F, Y",
            maxDate: "today",
            //dateFormat: "Y-m-d H:i",
            dateFormat: "Y-m-d",
            disableMobile: "true",
            defaultDate: null,
            //dateFormat: "d-m-Y",
            //enableTime: true,
            onChange: function(dateObj, dateStr) {
                // console.info(dateObj);
                // console.info(dateStr);
                // var mydate = new Date(dateStr);
                // var locale = "en-us";
                // var ordDate = mydate.getDate()+" "+mydate.toLocaleString(locale, { month: "short" })+" "+mydate.getFullYear();
                // $('#traval_date').html(ordDate);
                // if ( $('div.select_block').hasClass('active') ) {
                //     $('.select_block').removeClass('active').next().click();
                // }
                setActive();
            }
});

//Parag Jump Logic click on Yes/No
$('input[name="alias_is"]').on('change', function(){
    var value = $(this).val();
    if(value == "Y"){
        $('#div_child_1').show();
        $('#div_child_2').show();
        $('#alias_given_name').attr("required",'');
        $('#alias_surname_name').attr("required",'');
    }else{
        $('#div_child_1').hide();
        $('#div_child_2').hide();
        // $('#div_child').removeClass("active");
        $('#alias_given_name').removeAttr("required");
        $('#alias_surname_name').removeAttr("required");
        $('input[name="alias_given_name"]').val('');
        $('input[name="alias_surname_name"]').val('');
    }
});
$('input[name="oth_name_is"]').on('change', function(){
    var value = $(this).val();
    if(value == "Y"){
        $('#div_child_3').show();
        $('#div_child_4').show();
        $('#oth_given_name').attr("required",'');
        $('#oth_surname_name').attr("required",'');
    }else{
        $('#div_child_3').hide();
        $('#div_child_4').hide();
        $('#oth_given_name').removeAttr("required");
        $('#oth_surname_name').removeAttr("required");
        $('input[name="oth_given_name"]').val('');
        $('input[name="oth_surname_name"]').val('');
    }
});
$('input[name="res_add_is"]').on('change', function(){
    var value = $(this).val();
    if(value == "Y"){
        $('#res_add_ind_div_1').show();
        $('#res_add_ind_div_2').show();
        $('#res_add_oth_div_1').hide();
        $('#res_add_oth_div_2').hide();
        $('#red_add_ind').attr('required','');
        $('input[name="district_city_tex"]').attr('required', '');
        $('#red_add_oth').removeAttr('required');
        $('#district_city_oth_text').removeAttr('required');
        $('#red_add_oth').val('');
        $('#district_city_oth').val('');
        $('#district_city_oth_text').val('');
    }else{
        $('#res_add_oth_div_1').show();
        $('#res_add_oth_div_2').show();
        $('#res_add_ind_div_1').hide();
        $('#res_add_ind_div_2').hide();
        $('#red_add_oth').attr('required', '');
        $('#district_city_oth_text').attr('required', '');
        $('#red_add_ind').removeAttr('required');
        $('input[name="red_add_ind"]').val('');
        $('input[name="district_city_text"]').removeAttr('required');
        $('input[name="district_city"]').val('');
        $('select[name="district_city"]').val('');
        $('input[name="district_city_text"]').val('');
    }
});
$('input[name="is_travel_hk"]').on('change', function(){
    var value = $(this).val();
    if(value == "Y"){
        $('#pre_travel_hk_div').show();
        $('#hk_pass_number').attr('required','');
    }else{
        $('#pre_travel_hk_div').hide();
        $('#hk_pass_number').removeAttr('required');
        $('#hk_pass_number').val('');
    }
});
$('input[name="is_travel_oth"]').on('change', function(){
    var value = $(this).val();
    if(value == "Y"){
        $('#pre_travel_oth_div').show();
        $('#oth_pass_number').attr('required','');
    }else{
        $('#pre_travel_oth_div').hide();
        $('#oth_pass_number').removeAttr('required');
        $('#oth_pass_number').val('');
    }
});
$('input[name="is_local_conn"]').on('change', function(e){
    var value = $(this).val();
    var validator = $( "#CustomTypeForm" ).validate();
    if(value == "Y"){
        $('#local_conn_div').show();
        $('#local_conn_div1').show();
        $('#local_conn_name').attr('required','');
        $('#local_conn_relative_text').attr('required','');
        $('#hk_submit').removeAttr('disabled');
        validator.showErrors({
            "is_local_conn": ""
        });
    }else{
        var visit_value = $('input[name="purpose_visit"]').val();
        $('#local_conn_div').hide();
        $('#local_conn_div1').hide();
        $('#local_conn_name').removeAttr('required');
        $('#local_conn_relative_text').removeAttr('required');
        $('#local_conn_name').val('');
        $('input[name="local_conn_relative"]').val('');
        $('input[name="local_conn_relative_text"]').val('');
        if(visit_value == 15){
            validator.showErrors({
                "is_local_conn": "Please select the local connection in HKSAR"
            });
            $('#hk_submit').attr('disabled','');
        }
    }
});
$('input[name="is_arrested"]').on('change', function(){
    var value = $(this).val();
    if(value == "Y"){
        $('#is_arrested_div').show();
        $('#is_convicted').attr('required','');
    }else{
        $('#is_arrested_div').hide();
        $('#is_convicted').removeAttr('required');
        $('input[name="is_convicted"]').prop('checked',false);
    }
});