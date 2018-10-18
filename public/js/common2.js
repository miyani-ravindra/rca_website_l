$(function() {
    console.log( "ready!" );
    var childprice = 0;
    var adultprice = 0;


    $(document).ready(function(){
        
        //RCAV1-51 - START
        if(!(localStorage.getItem("active_tab") === null)){
            
            if( localStorage.getItem("active_tab") == 'group_size_max_mna' ){
                $("#e_visa_tab").removeClass("__current");
                $("#lounge_tab").removeClass("__current");

                $("#tab-1").removeClass("__current");
                $("#tab-3").removeClass("__current");

                $("#mna_tab").addClass("__current");
                $("#tab-2").addClass("__current");
            }else if( localStorage.getItem("active_tab") == 'group_size_max_lounge' ){

                $("#e_visa_tab").removeClass("__current");
                $("#mna_tab").removeClass("__current");

                $("#tab-1").removeClass("__current");
                $("#tab-2").removeClass("__current");

                $("#lounge_tab").addClass("__current");
                $("#tab-3").addClass("__current");
            }

            localStorage.removeItem("active_tab");
        }
        //RCAV1-51 - END

        //RCAV1-51 - START
        if($("#errorModalForMna").length > 0){
            $('#errorModalForMna').modal('show');
        }

        if($("#errorModalForLounge").length > 0){
            $('#errorModalForLounge').modal('show');
        }
        //RCAV1-51 - END


    });



    if($('#adults').val()=="" || $('#adults').val()==0){
    	$('#count_adult').html("0");
    }

    if($('#children').val()=="" || $('#children').val()==0){
    	$('#count_child').html("0");
    }

    $('#contact-message').hide();
    $('#contact_form').submit(function(event) {
    // Stop the browser from submitting the form.
	    event.preventDefault();
	    var formData = $('#contact_form').serialize(); 
	    console.log('Form data: '+formData); 
	    //var formData = "hello";
	    $.ajax({
	    	method:"POST",
        beforeSend: function (xhr) {
            var token = $('meta[name="csrf_token"]').attr('content');

            if (token) {
                  return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
		    //url: $('#contact_form').attr('action'),
		    url: 'contact-submit',
		    //dataType:"json",
		    data: formData,
		    success : function(response){//alert(response);
		    	$('#contact-message').show();
	            $('#contact-message').text(response);
           }
		  });

    });

    // $('.__btn').on('click', function(){
    // 	$.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    // 	var id =($(this).attr("data-id"));

    //   if(id == 1){
    //     $('#airline').show();
    //     $('#travaldate').hide();
    //     $('#airportarrive').show();
    //     $('#airportleave').show();
    //     $('#airportgo').show();
    //     $('#airportcom').show();
    //   }else if(id == 3 || id == 2 || id == 4){
    //     $('#airline').hide();
    //     $('#travaldate').show();
    //     $('#airportgo').hide();
    //     $('#airportcom').hide();
    //     $('#airportarrive').hide();
    //     $('#airportleave').hide();
    //   }

    // 	$.ajax({
    //          type:"POST",
    //          url:"ajaxopenproduct/"+id,
    //          success : function(response) {
    //          	$('#visa_type').html(response.product_name)
    //             $('#product_id').attr("data-id",response.product_id);
    //             localStorage.setItem('product_id',response.product_id);
    //             console.log(response);
    //          }
    //     });
    // });

    $('#btn_save').on('click', function(){
        $('.__btn_book').removeAttr('disabled');
        $('#btn_save').prop("disabled", true);
        $('#btn_save').hide();
        var product_id = $('#product_id').attr("data-id");
        var adult = $('#adults').val();
        var child = $('#children').val();
        var infant = $('#infant').val();
        var first_name = $('#first_name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        var airline_type = $('#airline_type option:selected').val();
        var nation = $('#nation').val();
        var prod_price = $('#prod_price').val();
        var traval_date = $('#traveldate').val();
        var airport_com = $('#airport_com').val();
        var airport_go = $('#airport_go').val();
        var uid = $('#uid').val();
        //alert(localStorage.getItem('product_id'));return false;
        $.ajax({
             type:"POST",
             url:"ajaxsubmitdata",
             data:{'uid':uid,'product_id':product_id,'adult':adult,'child':child,'infant':infant,'first_name':first_name,'email':email,'phone':phone,'airline_type':airline_type,'nation':nation, 'product_price':prod_price,'traval_date':traval_date},
             success : function(response) {
                $('#submit_val').val(response);
                // console.log(response);
                // window.location.reload();
                localStorage.setItem('product_id',"");
                localStorage.setItem('childprice', "");
                localStorage.setItem('adultprice', "");
             }
        });

    });


    $('input[name="quant[1]"]').change(function() {
        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        console.log(valueCurrent);
        $('#count_adult').html(valueCurrent);
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      var prod_id = localStorage.getItem('product_id');
      
      $.ajax({
             type:"POST",
             url:"ajaxgetproductprice",
             data: {product_id:prod_id,person_type:'adult'},
             success : function(response) {
                adultprice = valueCurrent*response.price;
                if(valueCurrent > 0){
                  $('input[name="adultprice"]').val(adultprice);
                }else{
                  $('input[name="adultprice"]').val(0);
                }
                calcprice();
                console.log(adultprice);
             }
        });
      
    });

    $('input[name="quant[2]"]').change(function() {
        minValue = parseInt($(this).attr('min'));
        maxValue = parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        console.log(valueCurrent);
        $('#count_child').html(valueCurrent);
        if (valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if (valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }

      var prod_id = localStorage.getItem('product_id');
      
      $.ajax({
             type:"POST",
             url:"ajaxgetproductprice",
             data: {product_id:prod_id,person_type:'adult'},
             success : function(response) {
                childprice = valueCurrent*response.price;
                
                if(valueCurrent > 0){
                  $('input[name="childprice"]').val(childprice);
                }else{
                  $('input[name="childprice"]').val(0);
                }
                calcprice();
                console.log(childprice);
             }
        });
    });

    // $(".datepicker").flatpickr({
    //         altInput: true,
    //         altFormat: "j F, Y",
    //         //dateFormat: "Y-m-d H:i",
    //         dateFormat: "Y-m-d",
    //         minDate: "today",
    //         //dateFormat: "d-m-Y",
    //         //enableTime: true,
    //         onChange: function(dateObj, dateStr) {
    //             // console.info(dateObj);
    //             // console.info(dateStr);
    //             var mydate = new Date(dateStr);
    //             var locale = "en-us";
    //             var ordDate = mydate.getDate()+" "+mydate.toLocaleString(locale, { month: "short" })+" "+mydate.getFullYear();
    //             $('#traval_date').html(ordDate);
    //         }
    // });

    $('#arrival_date').flatpickr({
            altInput: true,
            altFormat: "j F, Y",
            //dateFormat: "Y-m-d H:i",
            dateFormat: "Y-m-d",
            minDate: new Date().fp_incr(4),
            maxDate: new Date().fp_incr(120),
            disableMobile: "true",
            //dateFormat: "d-m-Y",
            //enableTime: true,
            // "disable": [
            //     function(date) {
            //         // return true to disable
            //         return (date.getDay() === 5 || date.getDay() === 6);

            //     }
            // ],
            // "locale": {
            //     "firstDayOfWeek": 1 // start week on Monday
            // },
            onChange: function(dateObj, dateStr) {
                // console.info(dateObj);
                // console.info(dateStr);
                var mydate = new Date(dateStr);
                var locale = "en-us";
                var ordDate = mydate.getDate()+" "+mydate.toLocaleString(locale, { month: "short" })+" "+mydate.getFullYear();
                $('#traval_date').html(ordDate);
                $('.datepkr.active').removeClass('active').next().click();
            }
    });

    $('#dob').flatpickr({
            altInput: true,
            altFormat: "j F, Y",
            //dateFormat: "Y-m-d H:i",
            dateFormat: "Y-m-d",
            maxDate: "today",
            disableMobile: "true",
            onChange: function(dateObj, dateStr) {
                // console.info(dateObj);
                // console.info(dateStr);
                var mydate = new Date(dateStr);
                var locale = "en-us";
                var ordDate = mydate.getDate()+" "+mydate.toLocaleString(locale, { month: "short" })+" "+mydate.getFullYear();
                $('#traval_date').html(ordDate);
                $('.datepkr.active').removeClass('active').next().click();
            }
    });

    $('#doi').flatpickr({
            altInput: true,
            altFormat: "j F, Y",
            //dateFormat: "Y-m-d H:i",
            dateFormat: "Y-m-d",
            // minDate: new Date().fp_incr(4),
            maxDate: "today",
            disableMobile: "true",
            //dateFormat: "d-m-Y",
            //enableTime: true,
            onChange: function(dateObj, dateStr) {
                // console.info(dateObj);
                // console.info(dateStr);
                var mydate = new Date(dateStr);
                var locale = "en-us";
                var ordDate = mydate.getDate()+" "+mydate.toLocaleString(locale, { month: "short" })+" "+mydate.getFullYear();
                $('#traval_date').html(ordDate);
                $('.datepkr.active').removeClass('active').next().click();
            }
    });

    $('#doe').flatpickr({
            altInput: true,
            minDate: "j F, Y",
            altFormat: "j F, Y",
            //dateFormat: "Y-m-d H:i",
            dateFormat: "Y-m-d",
            disableMobile: "true",
            // minDate: new Date().fp_incr(4),
            // maxDate: new Date().fp_incr(120),
            //dateFormat: "d-m-Y",
            //enableTime: true,
            onChange: function(dateObj, dateStr) {
                // console.info(dateObj);
                // console.info(dateStr);
                var mydate = new Date(dateStr);
                var locale = "en-us";
                var ordDate = mydate.getDate()+" "+mydate.toLocaleString(locale, { month: "short" })+" "+mydate.getFullYear();
                $('#traval_date').html(ordDate);
                $('.datepkr.active').removeClass('active').next().click();
            }
    });

    $('#other_ppt_issue_date').flatpickr({
            altInput: true,
            altFormat: "j F, Y",
            //dateFormat: "Y-m-d H:i",
            dateFormat: "Y-m-d",
            disableMobile: "true",
            // minDate: new Date().fp_incr(4),
            // maxDate: new Date().fp_incr(120),
            //dateFormat: "d-m-Y",
            //enableTime: true,
            onChange: function(dateObj, dateStr) {
                // console.info(dateObj);
                // console.info(dateStr);
                var mydate = new Date(dateStr);
                var locale = "en-us";
                var ordDate = mydate.getDate()+" "+mydate.toLocaleString(locale, { month: "short" })+" "+mydate.getFullYear();
                $('#traval_date').html(ordDate);
                $('.datepkr.active').removeClass('active').next().click();
            }
    });

    $('#oldvisaissuedate').flatpickr({
            altInput: true,
            altFormat: "j F, Y",
            //dateFormat: "Y-m-d H:i",
            dateFormat: "Y-m-d",
            disableMobile: "true",
            // minDate: new Date().fp_incr(4),
            // maxDate: new Date().fp_incr(120),
            //dateFormat: "d-m-Y",
            //enableTime: true,
            onChange: function(dateObj, dateStr) {
                // console.info(dateObj);
                // console.info(dateStr);
                var mydate = new Date(dateStr);
                var locale = "en-us";
                var ordDate = mydate.getDate()+" "+mydate.toLocaleString(locale, { month: "short" })+" "+mydate.getFullYear();
                $('#traval_date').html(ordDate);
                $('.datepkr.active').removeClass('active').next().click();
            }
    });

    $('.btn_order').on('click', function(){
      var uid = $(this).attr('data-uid');
      var oid = $(this).attr('data-oid');
      
      $('#uid').val(uid);
      $('#oid').val(oid);

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
             type:"POST",
             url:"/orders/ajaxapplicant",
             data: {uid:uid,oid:oid},
             success : function(response) {
                console.log(response.status);
                if($('#uid').val !== '' && $('#oid').val !== ''){
                      $('#frmdocument').submit();
                }
             }
      });

      $.ajax({
             type:"POST",
             url:"/orders/ajaxgetorderdetails",
             data: {uid:uid,oid:oid},
             success : function(response) {
                console.log(response);
                var mydate = new Date(response.orddetails.created_at);
                var locale = "en-us";
                var ordDate = mydate.getDate()+" "+mydate.toLocaleString(locale, { month: "short" })+" "+mydate.getFullYear();
                
                $('#prod_name').html(response.orddetails.product_name);
                $('#no_adult').html(response.orddetails.adult);
                $('#no_child').html(response.orddetails.child);
                $('#ord_date').html(ordDate);
                $('.__app_status').empty();

                var applen = response.getappstatus.length;
                $('.__app_status').append('<p class="__status"><span>Status :</span> Application Not Submitted!!</p>')
                if(applen > 0){
                  $.each(response.getappstatus,function ( index, repo ) {
                    $('.__app_status').append('<div class="__pax_status" id="app_status"><h5>'+repo.username+'</h5><div class="__pax_docs">Application Form <span class="__status_badge">Completed</span></div><div class="__pax_docs">Document Submission  <span class="__status_badge _incompelete">Incomplete</span></div></div>');
                  });
                }else{
                    $('.__app_status').append('<div class="__pax_status" id="app_status"><h5>Record Not Found</h5></div>');
                }

             }
      });

    });

    $('#edit_info').on('click', function(){
      if($('.__travel_input').hasClass('__travel_input_edit')){
          $('#editphone').removeAttr('readonly');
          $('#editdate').removeAttr('readonly');
      }else{
        $('#editphone').attr('readonly',"");
        $('#editdate').attr('readonly', "");
      }
    });

    $('#save').on('click', function(){
        var uid = $('#edituid').val();
        var oid = $('#editoid').val();
        var phone = $('#editphone').val();
        var traveldate = $('#editdate').val();
        
        if (confirm('Are you sure?')) {
          $.ajax({
                 type:"POST",
                 url:"/orders/ajaxeditaccount",
                 data: {uid:uid,oid:oid,phone:phone,traveldate:traveldate},
                 success : function(response) {
                    console.log(response);
                    if(response.status == "success"){
                      $('#message_box').css('display','block');
                      $('#message_box').html(response.msg);  
                    }
                 }
          });
        }
    });

    $('form[name="app_frm"]').on('submit', function(e){
      e.preventDefault();
      
      var form = $(this);
      var formId = form.attr('id');
      var formName = form.attr('name');

      // console.log($("#" + formId).serialize());return false;    

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
            url: "/orders/ajaxapplicationsave",
            type: "POST",
            data: $("#" + formId).serialize(),
            cache: false,
            success: function (response) {
              console.log(response);
              if(response.status=="success"){
                $('#message-box').css('display','block');
                $('#message-box').html(response.msg);
              }
            }
          });
    });

    // var $form = $('#LP_LeadForm');
    // $form.submit(function(){
    //         $.ajaxSetup({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 }
    //         });
    //         $.ajax({
    //             type: "POST",
    //             url: "https://www.redcarpetassist.com/send_leadfrm_ab.php",
    //             data: $(this).serialize(),
    //             dataType: "json",
    //             cache: false,
    //             async: false,
    //             success: function(response) {
    //                 $('#enq_thanks').fadeOut("slow");
    //             },
    //             error: function(xhr, status, error) {
    //                 var err = eval(xhr);
    //                 console.log(err);
    //             }
    //         });
    //         return false;
    // });

    /*$('#btn_send_otp').on('click', function(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
            url: "/rca_website_l/public/evisa/ajaxsendotp",
            type: "POST",
            dataType:"json",
            data: {email_id:$('input[name="email_id"').val(),username:$('input[name="user_name"]').val()},
            success: function (response) {
              if(response.status=="success"){
                $('#message-box').css('color','green');
                $('#message-box').html(response.msg);
                setInterval(function(){
                        $("#message-box").fadeOut(1000);
                }, 5000);
                $('#btn_edit_otp').hide();
                $('#btn_send_otp').attr('disabled','');
                $('#btn_confirm').removeAttr('disabled');
                $('#terms').attr('onchange',"activateButton(this)");
              }
            }
      });
    });*/

    $('#btn_track_otp').on('click', function(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
            url: "/rca_website_l/public/evisa/ajaxsendotp",
            type: "POST",
            dataType:"json",
            data: {app_track:"Y",email_id:$('input[name="email_id"').val()},
            success: function (response) {
              if(response.status=="success"){
                $('#message-box').css('color','green');
                $('#message-box').html(response.msg);
                $('#btn_send_otp').attr('disabled','');
                $('#btn_track_confirm').removeAttr('disabled');
                $('input[name="opt_number[]"]').removeAttr('readonly');
                
                $('input[name="opt_number[]"]').on('keydown', function(){
                  stopCarret
                });

                $('input[name="opt_number[]"]').on('keyup', function(){
                  stopCarret
                });
              }else if(response.status=="not_match"){
                $('#message-box').css('color','red');
                $('#message-box').html(response.msg);
                $('input[name="opt_number[]"]').attr('readonly','');
              }
            }
      });
    });

    $('#btn_resend_track').on('click', function(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
            url: "/rca_website_l/public/evisa/ajaxsendotp",
            type: "POST",
            dataType:"json",
            data: {applicant_id:$('input[name="order_code"]').val(),email_id:$('input[name="email_id"').val()},
            success: function (response) {
              if(response.status=="success"){
                $('#message-box').css('color','green');
                $('#message-box').html(response.msg);
                setInterval(function(){
                        $("#message-box").fadeOut(1000);
                }, 5000);

                $('#btn_send_otp').attr('disabled','');
                $('#btn_track_confirm').removeAttr('disabled');
                $('input[name="opt_number[]"]').removeAttr('disabled');
              }else if(response.status=="not_match"){
                $('#message-box').css('color','red');
                $('#message-box').html(response.msg);
                $('input[name="opt_number[]"]').attr('disabled','');
              }
            }
      });
    });

    $('#btn_resend').on('click', function(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
            url: "/rca_website_l/public/evisa/ajaxsendotp",
            type: "POST",
            dataType:"json",
            data: {email_id:$('input[name="email_id"').val(),username:$('input[name="user_name"]').val()},
            success: function (response) {
              if(response.status=="success"){
                $('#message-box').css('display','block');
                $('#message-box').html(response.msg);
                setInterval(function(){
                        $("#message-box").fadeOut(1000);
                }, 5000);
                $('#btn_edit_otp').hide();
                $('#btn_send_otp').attr('disabled','');
                $('#btn_confirm').removeAttr('disabled');
              }
            }
      });
    });

    $('._close').on('click', function () {
        // do something…
        localStorage.setItem('product_id',"");
        localStorage.setItem('childprice', "");
        localStorage.setItem('adultprice', "");
    });

    $('ul.__appt_tabs li').click(function() {
            var tab_id = $(this).attr('data-tabs');

            $('ul.__appt_tabs li').removeClass('active');
            $('.__appt_tab_content').removeClass('active');

            $(this).addClass('active');
            $("#" + tab_id).addClass('active');
    });

    var acc = document.getElementsByClassName("__accord_head");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("_active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }

    $('#frmeditotp').validate({
        rules: {
            email_id:{
                required: true,
                email: true
            },
            phone_number:{
                required: true,
                numeric: true
            }
        },
        messages: {
            email_id: {
                required: "Enter Email Address",
                email: "Enter Valid Email Address"
            },
            phone_number: {
                required: "Enter Phone Number",
                numeric: "Enter only numeric"
            }

        },
        highlight: function (element, errorClass, validClass) {
            // console.log("highlight");
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            // console.log("success");
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            error.insertAfter(element);
        }
    });

    $('#frmverify').validate({
        rules: {
            opt_number: {
                required: true,
                minlength: 4
            }
        },
        messages: {
            opt_number:{
                required: "Please Enter OTP Number",
                minlength: "Enter Valid OTP Number"
            }
        },
        submitHandler: function(form) {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/rca_website_l/public/ajaxcheckotp", 
                type: "POST",             
                dataType:"json",
                data: {uid:$('#uid').val()},
                success: function(response) {
                    var opt_number = $('input[name="opt_number"]').val();
                    if(response.status == "success"){
                        if(opt_number === response.data.otp_number){
                            form.submit();
                        }else {
                            var validator = $( "#frmverify" ).validate();
                            validator.showErrors({
                              "opt_number": "Invalid OTP Number"
                            });
                            return false;
                        }
                    }
                }
            });
        //    return false;
        },
        highlight: function (element, errorClass, validClass) {
            // console.log("highlight");
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            // console.log("success");
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            error.insertAfter(element);
        }
    });

    $('#frmevisastep2').validate({
        rules: {
            user_name: {
                required: true,
                alpha: true
            },
            email_id:{
                required: true,
                email: true
            },
            phone_number:{
                required: true,
                numeric: true
            },
            arrival_date: {
                required: true
            },
            airport_code: {
                required: true
            },
            frontpage: {
                required: true,
                accept: "image/jpeg, image/jpg",
				extension: "jpeg|jpg"
                //accept: "video/mp4"
            },
            photograph: {
                required: true,
                accept: "image/jpeg, image/jpg",
				extension: "jpg,jpeg"
                //accept: "video/mp4"
            }
        },
        messages: {
                user_name:{
                    required: "Enter Full Name",
                    alpha: "Enter only alphabets"
                },
                email_id: {
                    required: "Enter Email Address",
                    email: "Enter Valid Email Address"
                },
                phone_number: {
                    required: "Enter Phone Number",
                    numeric: "Enter only numeric"
                },
                arrival_date: {
                    required: "Select Arrival Date"
                },
                airport_code: {
                    required: "Select Airport Arrival"
                },
                frontpage: {
                    required: 'Upload Front Passport Image',
					accept: "Allow Only jpeg/jpg file"
                },
                photograph: {
                    required: 'Upload Photograph Image',
					accept: "Allow Only jpeg/jpg file"
                }
        },
        highlight: function (element, errorClass, validClass) {
            // console.log("highlight");
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            // console.log("success");
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'div',
        errorClass: 'error-block',
        errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            // if element is file type, we put the error message in its grand parent
            if (element.prop("type") === "file") {
                error.insertAfter(element.parent().parent());
            } else {
                error.insertBefore($(element).parent('div.input-control'));
            }
        }
    });

    $('#evisaForm').validate({
        highlight: function (element, errorClass, validClass) {
            // console.log("highlight");
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            // console.log("success");
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            error.insertAfter(element);
        }
    });

    $('#frmevisaform').validate({
        ignore: [],
        rules: {
            given_name: {
                required: true,
                alpha: true
            },
            surname:{
                required: false,
                alpha: true
            },
            previous_surname:{
                //required: false,
                alpha: true
            },
            previous_name: {
                //required: false,
                alpha: true
            },
            refer_flag: {
                required: true
            },
            gender: {
                required: true
            },
            cob: {
                required: true
            },
            city_birth: {
                required: true,
                alpha:true,
               // min:3
            },
            nation_id: {
                required: true,
                alphanumeric: true
            },
            religion_code: {
                required:true
            },
            visible_marks: {
                required:true,
                alpha: true
            },
            qualification: {
                required: true
            },
            nationality: {
                required: true
            },
            aquired_nation: {
                required: true
            },
            Passport_number: {
                required: true,
                alphanumeric: true
            },
            issue_place: {
                required: true,
                alpha: true
            }
            // doi: {
            //     required: true
            // },
            // doe: {
            //     required: true
            // }
        },
        messages: {
                given_name:{
                    required: "Please enter your given name",
                    alpha: "Please enter alphabet or spaces only"
                },
                surname: {
                    alpha: "Please enter alphabet or spaces only"
                },
                // previous_surname: {
                //     alpha: "Please enter alphabet or spaces only",
                //     required: "Please enter your previous surname",
                // },
                // previous_name: {
                //     alpha: "Please enter alphabet or spaces only",
                //     required: "Please enter your previous name",
                // },
                refer_flag: {
                    required: "Please select an option"
                },
                gender: {
                    required: "Please select your gender"
                },
                cob: {
                    required: "Please select your country of birth"
                },
                city_birth: {
                    required: "Please mention your place of birth",
                    alpha: "Please remove special characters",
                    //min:"Please enter more than 2 characters"
                },
                nation_id: {
                    required: "Please enter your Citizenship/National Id number",
                    alphanumeric: "Please enter alphabet or numbers only"
                },
                religion_code: {
                    required: "Please select your religion"
                },
                visible_marks: {
                    required: "If no visible mark then put NA",
                    alpha: "Please enter alphabet or spaces only"
                },
                qualification: {
                    required: "Please select your educational qualification"
                },
                nationality: {
                    required: "Please select your Nationality"
                },
                aquired_nation: {
                    required: "Please select the your nationality acquisition method"
                },
                Passport_number: {
                    required: "Please enter your passport number",
                    alphanumeric: "Please enter alphabet or numeric value"
                },
                issue_place: {
                    required: "Please enter your passport issue place",
                    alpha: "Please remove special characters"
                },
                // doi: {
                //     required: "Please select your passport issue date"
                // },
                // doe: {
                //     required: "Please select your passport expiry date"
                // }
        },
        submitHandler: function(form) {
            var doe = new Date($("#doe").val());
            var date = new Date();
            var error = "";
            
            // var diff = date.getTime() - doe.getTime();
            // diff = diff / (1000 * 60 * 60 * 24 * 30);
            
            if ( doe < date ) 
            {
                var validator = $( "#frmevisaform" ).validate();
                validator.showErrors({
                    "doe": "Expiry Date Cannot be less than today"
                });
                return false;
            }else if ($("#doi").val()==""){
                var validator = $( "#frmevisaform" ).validate();
                validator.showErrors({
                    "doi": "Select Passport Issue Date"
                });
                return false;
            }else if ($("#doe").val()==""){
                var validator = $( "#frmevisaform" ).validate();
                validator.showErrors({
                    "doe": "Select Passport Expiry Date"
                });
                return false;
            }else if($('input[name="previous_name"]').prop('required')){
                var validator = $( "#frmevisaform" ).validate();
                validator.showErrors({
                    "previous_name": "Please enter Previous Name"
                });
                return false;
            }else if($('input[name="previous_surname"]').prop('required')){
                var validator = $( "#frmevisaform" ).validate();
                validator.showErrors({
                    "previous_surname": "Please enter Previous Surname"
                });
                return false;
            }else if($('input[name="prev_passport_country_issue"]').prop('required')){
                var validator = $( "#frmevisaform" ).validate();
                validator.showErrors({
                    "prev_passport_country_issue": "Please select Country of Issue"
                });
                return false;
            }else if($('input[name="other_ppt_no"]').prop('required')){
                var validator = $( "#frmevisaform" ).validate();
                validator.showErrors({
                    "other_ppt_no": "Please enter your passport number"
                });
                return false;
            }else if($('input[name="other_ppt_issue_place"]').prop('required')){
                var validator = $( "#frmevisaform" ).validate();
                validator.showErrors({
                    "other_ppt_issue_place": "Please mention your place of issue"
                });
                return false;
            }else if($('input[name="other_ppt_nationality"]').prop('required')){
                var validator = $( "#frmevisaform" ).validate();
                validator.showErrors({
                    "other_ppt_nationality": "Please select Country"
                });
                return false;
            } else{
                form.submit();
            }
            return false;
        },
        highlight: function (element, errorClass, validClass) {
            // console.log("highlight");
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            // console.log("success");
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'div',
        errorClass: 'error-block',
        errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            error.insertAfter($(element).parent('div.input-control'));
        },
    });

       $('#frmevisaform ').submit(function(e){
        
            var doe = new Date($("#doe").val());
            var date = new Date();

            if ( doe < date ) 
                {console.log("Error");
                $("#doe-error").append("Expiry Date Cannot be less than today");
                e.preventDefault();
        }
            else console.log("Done"); 



       }) ;
    $('#frmevisafamilyform').validate({
        rules: {
            pres_add1: {
                required: true
            },
            pres_add2:{
                required: true
            },
            pres_country:{
                required: false
            },
            state_name: {
                required: false
            },
            pincode: {
                required: true,
                numeric: true
            },
            pres_phone: {
                numeric: true
            },
            email_id: {
                required: true,
                email: true
            },
            perm_address1: {
                required: true
            },
            fthrname: {
                required: true,
                alpha:true,
               // min:3
            },
            father_nationality: {
                required: true
            },
            father_place_of_birth: {
                required: true,
		        alpha: true,
            },
            father_country_of_birth: {
                required: true
            },
            mother_name: {
                required: true,
                alpha: true
            },
            mother_nationality: {
                required: true
            },
            mother_nationality: {
                required: true
            },
            mother_place_of_birth: {
                required: true,
		        alpha: true,
            },
            mother_country_of_birth: {
                required: true
            },
            pre_occupation: {
                required: true
            },
            marital_status: {
                required:true
            },
            grandparent_flag1: {
                required:true
            },
            pre_occupation: {
                required: true
            },
            empname: {
                required: true
            },
            empaddress: {
                required: true
            },
            empphone: {
                numeric: true
            }
        },
        messages: {
                pres_add1:{
                    required: "Please enter your address details"
                },
                pres_add2: {
                    required: "Please enter your address details"
                },
                pres_country: {
                    required: "Please Select Country"
                },
                state_name: {
                    required: "Please Enter State Name"
                },
                pincode: {
                    required: "Please Enter Pincode",
                    numeric: "Enter Only Number"
                },
                email_id: {
                    required: "Please Enter Email Address",
                    email: "Please Enter Valid Email"
                },
                pres_phone: {
                    numeric: "Please Enter Only Number"
                },
                perm_address1: {
                    required: "Please Enter Permenent Address"
                },
                fthrname: {
                    required: "Please enter your father's name",
                    alpha: "Please remove special characters",
                    //min:"Please enter more than 2 characters"
                },
                father_nationality: {
                    required: "Please enter your father's nationality"
                },
                father_place_of_birth: {
                    required: "Please enter your father's palce of birth",
		            alpha: "Plase Enter Only Alphabet",
                },
                father_country_of_birth: {
                    required: "Please enter your father's country of birth"
                },
                mother_name: {
                    required: "Please enter your mother's name",
                    alpha: "Plase Enter Only Alphabet"
                },
                mother_nationality: {
                    required: "Please enter your mother's nationality"
                },
                mother_place_of_birth: {
                    required: "Please enter your mother's palce of birth",
		            alpha: "Plase Enter Only Alphabet",
                },
                pre_occupation: {
                    required: "Please select your current occupation"
                },
                marital_status: {
                    required: "Please select your marital status"
                },
                grandparent_flag1: {
                    required: "If no visible mark then put NA",
                    alpha: "Please enter alphabet or spaces only"
                },
                pre_occupation: {
                    required: "Please select your educational qualification"
                },
                empname: {
                    required: "Please enter your employer's name"
                },
                empaddress: {
                    required: "Please enter your employer's address"
                },
                empphone: {
                    numeric: "Please Enter Only Number"
                }
        },
        highlight: function (element, errorClass, validClass) {
            // console.log("highlight");
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            // console.log("success");
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'div',
        errorClass: 'error-block',
        errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            error.insertBefore($(element).parent('div.input-control'));
        }
    });

    $('#frmevisadetails').validate({
        rules: {
            service_req_form_values: {
                required: true
            },
            pres_country: {
                required: true
            }
        },
        messages: {
                service_req_form_values:{
                    required: "Please enter places to be visited"
                },
                pres_country: {
                    required: "Please Select Exit Airport"
                }
        },
        highlight: function (element, errorClass, validClass) {
            // console.log("highlight");
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            // console.log("success");
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            error.insertAfter(element);
        }
    });

    $('#frmextradoc').validate({
      rules: {
        business_card: {
          required: true, 
          extension: "pdf"
        },
        hospital_letter: {
          required: true, 
          extension: "pdf"
        }
      },
      messages: {
        business_card: "Upload Only PDF File",
        hospital_letter: "Upload Only PDF File"
      },
      highlight: function (element, errorClass, validClass) {
            // console.log("highlight");
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            // console.log("success");
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            error.insertAfter(element);
        }
    });

    $('#passport_code').on('change', function(){
      var type = $(this).val();
      if(type != 5){
        $('#passport_type_error').css('display','block');
        $('#passport_type_error').html('Be Process only Ordinary Passport');
        $('#btnapply').attr('disabled', 'true');
      }else{
        $('#passport_type_error').css('display','none');
        $('#passport_type_error').html('');
        $('#btnapply').removeAttr('disabled');
      }
    });

   $("#frmevisaform select[name=nationality]").change(function(){
        var nationality = $(this).val();
        console.log(nationality);

        $("select[name=prev_nationality] option[value='"+nationality+"']").remove();
    });

    $('#previous_surname').hide();
    $('#previous_name').hide();
    $('input[name="name_changed"]').on('change', function(){
      // If not, hide the fields.
      if ($(this).val()=="Y") {
        // Show the hidden fields.
        $('#previous_surname').show();
        $('#previous_name').show();
        $('input[name="previous_surname"]').attr('required',true);
        $('input[name="previous_name"]').attr('required',true);
      } else {
        // Make sure that the hidden fields are indeed
        // hidden.
        $('#previous_surname').hide();
        $('#previous_name').hide();
        $('input[name="previous_surname"').removeAttr('required');
        $('input[name="previous_name"]').removeAttr('required');
      }
    });

    $('input[name="sameAddress_id"]').on('change', function(){
      if($(this).val()=='Y'){
        var pres_add = $('input[name="pres_add1"]').val();
        var pres_add2 = $('input[name="pres_add2"]').val();
        var pres_add3 = $('input[name="state_name"]').val();

        $('input[name="perm_address1"]').val(pres_add);
        $('input[name="perm_address2"]').val(pres_add2);
        $('input[name="perm_address3"]').val(pres_add3);

        $('input[name="perm_address1"]').attr('readonly','');
        $('input[name="perm_address2"]').attr('readonly','');
        $('input[name="perm_address3"]').attr('readonly','');
      }else{
        $('input[name="perm_address1"]').val('');
        $('input[name="perm_address2"]').val('');
        $('input[name="perm_address3"]').val('');

        $('input[name="perm_address1"]').removeAttr('readonly');
        $('input[name="perm_address2"]').removeAttr('readonly');
        $('input[name="perm_address3"]').removeAttr('readonly');
      }
    });
    //tyform change id to class
    $('.spouse_div').hide();
    $('input[name="mstatus"]').on('focus', function(){
      var value = $(this).val();
      if(value=='Married'){
        $('.spouse_div').show();
        $('input[name="spouse_name"]').attr('required','');
        $('select[name="spouse_nationality"]').attr('required','');
        $('input[name="spouse_place_of_birth"]').attr('required','');
        $('select[name="spouse_country_of_birth"]').attr('required','');
      }else{
        $('.spouse_div').hide();
        $('input[name="spouse_name"]').removeAttr('required');
        $('select[name="spouse_nationality"]').removeAttr('required');
        $('input[name="spouse_place_of_birth"]').removeAttr('required');
        $('select[name="spouse_country_of_birth"]').removeAttr('required');
      }
    });

    $('#grandparent_details').hide();
    $('input[name="grandparent_flag1"]').on('change', function(){
      var value = $(this).val();
      if(value=="Y"){
        $('#grandparent_details').show();
        $('input[name="grandparent_details"]').attr('required','');
      }else{
        $('#grandparent_details').hide();
        $('input[name="grandparent_details"]').removeAttr('required');
      }
    });

    $('#prev_nationality').hide();
    $('#aquired_nation').on('focus', function(){
      var value = $(this).val();
      if(value == 'Naturalization'){
        $('#prev_nationality').show();
        $('select[name="prev_nationality"]').attr('required',true);
      }else{
        $('#prev_nationality').hide();
        $('select[name="prev_nationality"]').removeAttr('required');
      }
    });

    //Service Type Check
    $.validator.addMethod("roles", function(value, elem, param) {
      return $("input[name='visa_type[]']:checkbox:checked").length > 0;
    },"Please select atleast one visa service");

    $("#frmevisatype").validate({
      // groups: {
      //   checks: checkbox_names
      // },
      rules: {
        "visa_type[]": {
            roles: true,
        }
      },
      highlight: function (element, errorClass, validClass) {
            // console.log("highlight");
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function (element) {
            // console.log("success");
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            error.insertAfter(element);
        }
    });

    $('select[name="service_req_meeting_frend[frnd_state]"]').on('change', function(){
        var stateID = $(this).val();
        
        if(stateID){
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    url: "/ajaxgetcity",
                    type: "POST",
                    dataType:"json",
                    data: {'state_id':stateID},
                    cache: false,
                    success: function (response) { //console.log(response.result);return false;
                        if(response.status == "found"){
                            $('select[name="service_req_meeting_frend[frnd_district]"]').children('option:not(:first)').remove();
                            $.each(response.result,function(key, value)
                            {
                                $('select[name="service_req_meeting_frend[frnd_district]"]').append('<option value=' + value.city_id + '>' + value.city_name + '</option>');
                            });  
                        }else if(response.status == "not-found"){
                                $('select[name="service_req_meeting_frend[frnd_district]"]').append('<option value= "">' + response.result + '</option>');
                        }else if(response.status == "fail"){
                                $('select[name="service_req_meeting_frend[frnd_district]"]').append('<option value= "">' + response.result + '</option>');   
                        }
                      // $('select[name="service_req_meeting_frend[frnd_district]"]').html(html);
                      // 
                }
            }); 
        }else{
            $('select[name="service_req_meeting_frend[frnd_district]"]').html('<option value="">Select state first</option>'); 
        }
    });

    $('select[name="service_req_short_medical[hospital_state]"]').on('change', function(){
        var stateID = $(this).val();
        
        if(stateID){
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    url: "/ajaxgetcity",
                    type: "POST",
                    dataType:"json",
                    data: {'state_id':stateID},
                    cache: false,
                    success: function (response) { //console.log(response.result);return false;
                        if(response.status == "found"){
                            $('select[name="service_req_short_medical[hospital_district]"]').children('option:not(:first)').remove();
                            $.each(response.result,function(key, value)
                            {
                                $('select[name="service_req_short_medical[hospital_district]"]').append('<option value=' + value.city_id + '>' + value.city_name + '</option>');
                            });  
                        }else if(response.status == "not-found"){
                                $('select[name="service_req_short_medical[hospital_district]"]').append('<option value= "">' + response.result + '</option>');
                        }else if(response.status == "fail"){
                                $('select[name="service_req_short_medical[hospital_district]"]').append('<option value= "">' + response.result + '</option>');   
                        }
                      // $('select[name="service_req_meeting_frend[frnd_district]"]').html(html);
                      // 
                }
            }); 
        }else{
            $('select[name="service_req_short_medical[hospital_district]"]').html('<option value="">Select state first</option>'); 
        }
    });

    $('select[name="service_req_short_yoga[yoga_institute_state]"]').on('change', function(){
        var stateID = $(this).val();
        
        if(stateID){
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                    url: "/ajaxgetcity",
                    type: "POST",
                    dataType:"json",
                    data: {'state_id':stateID},
                    cache: false,
                    success: function (response) { //console.log(response.result);return false;
                        if(response.status == "found"){
                            $('select[name="service_req_short_yoga[yoga_institute_district]"]').children('option:not(:first)').remove();
                            $.each(response.result,function(key, value)
                            {
                                $('select[name="service_req_short_yoga[yoga_institute_district]"]').append('<option value=' + value.city_id + '>' + value.city_name + '</option>');
                            });  
                        }else if(response.status == "not-found"){
                                $('select[name="service_req_short_yoga[yoga_institute_district]"]').append('<option value= "">' + response.result + '</option>');
                        }else if(response.status == "fail"){
                                $('select[name="service_req_short_yoga[yoga_institute_district]"]').append('<option value= "">' + response.result + '</option>');   
                        }
                      // $('select[name="service_req_meeting_frend[frnd_district]"]').html(html);
                      // 
                }
            }); 
        }else{
            $('select[name="service_req_short_medical[hospital_district]"]').html('<option value="">Select state first</option>'); 
        }
    });

    // $('._selectradio').on('click', function(){
    //   var id = $(this).attr('data-id');
    //   var value = $(this).val();
    //   var nation = $('#nationality').val();
      
    //   if(id==1){
    //     $('#'+id).prop('checked', true);
    //     $('#evisa_purpose_'+value).prop('checked', true);
    //     $('button[name="btn_evisa_type"]').removeAttr('disabled');
    //     }
    //     if(id==2){
    //       $('#'+id).prop('checked', true);
    //       $('#evisa_purpose_'+value).prop('checked', true);
    //       $('button[name="btn_evisa_type"]').removeAttr('disabled');
    //     }
    //     if(id==3){
    //       $('#'+id).prop('checked', true);
    //       $('#evisa_purpose_'+value).prop('checked', true);
    //       $('button[name="btn_evisa_type"]').removeAttr('disabled');
    //     }
    //   if(id==2 || id==3){
    //     $('#frmevisatype').attr('action',$('#doc_route').val());
    //   }else{
    //     $('#frmevisatype').attr('action',$('#form_route').val());
    //   }
    // });

    // $('._groupradio').on('click', function(){
    //   var id = $(this).attr('group-id');
    //   var checked = $("#"+id+":checkbox:checked").length;
    //   var attr = $('#'+id).attr('checked');
    //   var nation = $('#nationality').val();

    // //   if(checked == 0){
    // //     $('button[name="btn_evisa_type"]').attr('disabled','');
    // // }else{
    // //     $('button[name="btn_evisa_type"]').removeAttr('disabled');
    // // }

    //   if(id==1){
    //       if(checked == 0){
    //         $('input[name="evisa_purpose['+id+']"').removeAttr('checked');
    //         $('#'+id).removeAttr('checked');
    //       }
    //       $('#frmevisatype').attr('action',$('#form_route').val());
    //     }
    //     if(id==2){
    //         if(checked == 0){
    //           $('input[name="evisa_purpose['+id+']"').removeAttr('checked');
    //           $('#'+id).removeAttr('checked');
    //           $('#frmevisatype').attr('action',$('#form_route').val());
    //         }else{
    //           $('#frmevisatype').attr('action',$('#doc_route').val());
    //         }
    //     }
    //     if(id==3){
    //         if(checked == 0){
    //           $('input[name="evisa_purpose['+id+']"').removeAttr('checked');
    //           $('#'+id).removeAttr('checked');
    //           $('#frmevisatype').attr('action',$('#form_route').val());
    //         }else{
    //           $('#frmevisatype').attr('action',$('#doc_route').val());
    //         }
    //     }
    // });

    $('#btn_evisa_type').attr('disabled','');

    $('._selectradio').on('click', function(){
      var id = $(this).attr('data-id');
      var value = $(this).val();
      var nation = $('#nationality').val();
      
      if(id==1){
        $('#'+id).attr('checked','');
        $('#'+id).removeAttr('disabled');
        $('#evisa_purpose_'+value).attr('checked','');
        $('#btn_evisa_type').removeAttr('disabled','');
        }
        if(id==2){
          $('#'+id).attr('checked','');
          $('#'+id).removeAttr('disabled');
          $('#evisa_purpose_'+value).attr('checked','');
          $('#btn_evisa_type').removeAttr('disabled','');
        }
        if(id==3){
          $('#'+id).attr('checked','');
          $('#'+id).removeAttr('disabled');
          $('#evisa_purpose_'+value).attr('checked','');
          $('#btn_evisa_type').removeAttr('disabled','');
        }
      if(id==2 || id==3){
        $('#frmevisatype').attr('action',$('#doc_route').val());
      }else{
        $('#frmevisatype').attr('action',$('#form_route').val());
      }
    });

    $('._groupradio').on('click', function(){
      var id = $(this).attr('group-id');
      var checked = $("#"+id+":checkbox:checked").length;
      var attr = $('#'+id).attr('checked');
      var nation = $('#nationality').val();

        if(checked == 0){
            $('#btn_evisa_type').attr('disabled','');
        }else{
            $('#btn_evisa_type').removeAttr('disabled');
        }
      
      if(id==1){
          if(checked == 0){
            $('input[name="evisa_purpose['+id+']"').removeAttr('checked');
            $('#'+id).attr('disabled','');
            $('#'+id).removeAttr('checked');
          }
          $('#frmevisatype').attr('action',$('#form_route').val());
        }
        if(id==2){
            if(checked == 0){
              $('input[name="evisa_purpose['+id+']"').removeAttr('checked');
              $('#'+id).attr('disabled','');
              $('#'+id).removeAttr('checked');
              $('#frmevisatype').attr('action',$('#form_route').val());
            }else{
              $('#frmevisatype').attr('action',$('#doc_route').val());
            }
        }
        if(id==3){
            if(checked == 0){
              $('input[name="evisa_purpose['+id+']"').removeAttr('checked');
              $('#'+id).attr('disabled','');
              $('#'+id).removeAttr('checked');
              $('#frmevisatype').attr('action',$('#form_route').val());
            }else{
              $('#frmevisatype').attr('action',$('#doc_route').val());
            }
        }
    });

    //Previous Passport Details
    $('#prev_passport_country_issue').hide();
    $('#other_ppt_no').hide();
    $('#other_ppt_issue_place').hide();
    $('#other_ppt_date_issue').hide();
    $('#other_ppt_nationality').hide();

    $('input[name="oth_ppt"]').on('change', function(){
      var value = $(this).val();
      console.log(value);
      // If not, hide the fields.
      if (value == "Y") {
        // Show the hidden fields.
        $('#prev_passport_country_issue').show();
        $('#other_ppt_no').show();
        $('#other_ppt_date_issue').show();
        $('#other_ppt_issue_place').show();
        $('#other_ppt_nationality').show();
        $('#prev_passport_country_issue').show();
        $('select[name="prev_passport_country_issue"]').attr('required','');
        $('input[name="other_ppt_no"]').attr('required','');
        $('input[name="other_ppt_issue_place"]').attr('required','');
        $('input[name="other_ppt_issue_date"]').attr('required','');
        $('select[name="other_ppt_nationality"]').attr('required','');
      } else {
        // Make sure that the hidden fields are indeed
        // hidden.
        $('#prev_passport_country_issue').hide();
        $('#other_ppt_no').hide();
        $('#other_ppt_issue_place').hide();
        $('#other_ppt_date_issue').hide();
        $('#other_ppt_nationality').hide();
        $('select[name="prev_passport_country_issue"]').removeAttr('required');
        $('input[name="other_ppt_no"]').removeAttr('required');
        $('input[name="other_ppt_issue_place"]').removeAttr('required');
        $('input[name="other_ppt_issue_date"]').removeAttr('required');
        $('select[name="other_ppt_nationality"]').removeAttr('required');
      }
    });

    $('#occ_flag').hide();
    $('#if_prof_other').hide();
    $('select[name="pre_occupation"]').on('change', function(){
      var value = $(this).val();
      if(value==29){
        $('#occ_flag').show();
        $('select[name="occ_flag"]').attr('required','');
      }else if(value==20){
        $('#if_prof_other').show();
        $('select[name="if_prof_other"]').attr('required','');
      }else{
        $('#occ_flag').hide();
        $('#if_prof_other').hide();
        $('select[name="occ_flag"]').removeAttr('required');
      }
    });
    //tyform change id to class
    $('.prev_org_div').hide();
    $('input[name="prev_org"]').on('change', function(){
      var value = $(this).val();
      if(value=="Y"){
        $('.prev_org_div').show();
        $('input[name="previous_organization"]').attr('required','');
        $('input[name="previous_designation"]').attr('required','');
        $('input[name="previous_rank"]').attr('required','');
        $('input[name="previous_posting"]').attr('required','');
      }else{
        $('.prev_org_div').hide();
        $('input[name="previous_organization"]').removeAttr('required');
        $('input[name="previous_designation"]').removeAttr('required');
        $('input[name="previous_rank"]').removeAttr('required');
        $('input[name="previous_posting"]').removeAttr('required');
      }
    });
    //tyform change id to class
    $('.pre_visit_div').hide();
    $('input[name="old_visa_flag"]').on('change', function(){
      var value = $(this).val();
      if(value == "Y"){
        $('.pre_visit_div').show();
        $('textarea[name="prv_visit_add1"]').attr('required','');
        $('textarea[name="visited_city"]').attr('required','');
        $('input[name="old_visa_no"]').attr('required','');
        $('select[name="old_visa_type_id"]').attr('required','');
        $('input[name="oldvisaissueplace"]').attr('required','');
        $('input[name="oldvisaissuedate"]').attr('required','');
      }else{
        $('.pre_visit_div').hide();
        $('textarea[name="prv_visit_add1"]').removeAttr('required');
        $('textarea[name="visited_city"]').removeAttr('required');
        $('input[name="old_visa_no"]').removeAttr('required');
        $('select[name="old_visa_type_id"]').removeAttr('required');
        $('input[name="oldvisaissueplace"]').removeAttr('required');
        $('input[name="oldvisaissuedate"]').removeAttr('required');
      }
    });

    $('#refuse_flag_div').hide();
    $('input[name="refuse_flag"]').on('change', function(){
      var value = $(this).val();
      if(value == "Y"){
        $('#refuse_flag_div').show();
        $('input[name="refuse_details"]').attr('required','');
      }else{
        $('#refuse_flag_div').hide();
        $('input[name="refuse_details"]').removeAttr('required');
      }
    });

    $('#saarc_form_div').hide();
    $('#div_minus').hide();
    $('input[name="saarc_flag"]').on('change', function(){
      var value = $(this).val();
      if(value=="Y"){
        $('#saarc_form_div').show();
        $('select[name="saarcCountry[]"]').removeAttr('disabled');
        $('select[name="saarcYear[]"]').removeAttr('disabled');
        $('input[name="saarcVisitNo[]"]').removeAttr('disabled');
        $('select[name="saarcCountry[]"]').attr('required', '');
        $('select[name="saarcYear[]"]').attr('required', '');
        $('input[name="saarcVisitNo[]"]').attr('required', '');
      }else{
        $('#saarc_form_div').hide();
        $('#div_minus').hide();
        $('#sel_country').attr('disabled','');
        $('#sel_year').attr('disabled','');
        $('input[name="saarcVisitNo[]"]').attr('disabled','');
        $('select[name="saarcCountry[]"]').removeAttr('required');
        $('select[name="saarcYear[]"]').removeAttr('required');
        $('input[name="saarcVisitNo[]"]').removeAttr('required');
      }
    });

    $('input[name="opt_number"]').on('keydown', function(){
        console.log("wel");
    });

    $('#citizen_to').on('change', function(){
        var text = $('#citizen_to option:selected').text();
        $('#citizen_to_text').val(text);
    });

    // Retrieve
    //var gettravel_to = localStorage.getItem("bookVisa");
    var citizen_to_india = {'UK':'United Kingdom','USA':'United States of America'};
    var citizen_to_oth = {'IND':'India'};

    // if(typeof gettravel_to !== "undefined" || gettravel_to !== ""){
    //     var value = gettravel_to;
    //     var text = $('#travel_to option:selected').text();
    //     $('#travel_to').val(gettravel_to);

    //     $('#travel_to_text').val(text);
    //     // if (value != "India") { $("#c_reside").hide(); $("#c_select").hide(); $("#c_box").show()}

    //     if(value == "India"){
    //         $('#citizen_to').children('option:not(:first)').remove();
    //         $.each(citizen_to_india, function(key, value) {
    //              $('#citizen_to')
    //                 .append($("<option></option>")
    //                 .attr("value",key)
    //                 .text(value));
    //         });
    //     }else if(value == "HongKong"){
    //         $('#citizen_to').children('option:not(:first)').remove();
    //         $.each(citizen_to_oth, function(key, value) {
    //              $('#citizen_to')
    //                 .append($("<option></option>")
    //                 .attr("value",key)
    //                 .text(value));
    //         });
    //         $('#residing_in').append($("<option></option>")
    //                 .attr("value","IND")
    //                 .text("India"));
    //     }else if(value == "Malaysia"){
    //         $('#citizen_to').attr('disabled','');
    //         $('#residing_in').attr('disabled','');
    //         $('#lp_link').css('display','inline-block');
    //         $('#lp_link').attr('href','/rca_website_l/public/malaysia');
    //         $('#btn_step1').css('display','none');
    //         $("#c_reside").hide(); $("#c_select").hide(); $("#c_box").show();
    //     }else if(value == "Cambodia"){
    //         $('#citizen_to').attr('disabled','');
    //         $('#residing_in').attr('disabled','');
    //         $('#lp_link').css('display','inline-block');
    //         $('#lp_link').attr('href','/rca_website_l/public/cambodia');
    //         $('#btn_step1').css('display','none');
    //         $("#c_reside").hide(); $("#c_select").hide(); $("#c_box").show();
    //     }else if(value == "Turkey"){
    //         $('#citizen_to').attr('disabled','');
    //         $('#residing_in').attr('disabled','');
    //         $('#lp_link').css('display','inline-block');
    //         $('#lp_link').attr('href','/rca_website_l/public/turkey');
    //         $('#btn_step1').css('display','none');
    //         $("#c_reside").hide(); $("#c_select").hide(); $("#c_box").show();
    //     }else if(value == "Vietnam"){
    //         $('#citizen_to').attr('disabled','');
    //         $('#residing_in').attr('disabled','');
    //         $('#lp_link').css('display','inline-block');
    //         $('#lp_link').attr('href','/rca_website_l/public/vietnam');
    //         $('#btn_step1').css('display','none');
    //         $("#c_reside").hide(); $("#c_select").hide(); $("#c_box").show();
    //     }else if(value == "Srilanka"){
    //         $('#citizen_to').children('option:not(:first)').remove();
    //         $.each(citizen_to_oth, function(key, value) {
    //              $('#citizen_to')
    //                 .append($("<option></option>")
    //                 .attr("value",key)
    //                 .text(value));
    //         });
    //         $('#residing_in').append($("<option></option>")
    //                 .attr("value","IND")
    //                 .text("India"));
    //     }else{
    //         $('#citizen_to').removeAttr('disabled');
    //         $('#residing_in').removeAttr('disabled');
    //         $('#lp_link').css('display','none');
    //         $('#btn_step1').css('display','inline-block');

    //         $("#c_reside").show();
    //         $("#c_select").show();

    //         $("#c_box").hide();
    //     }
    // }


    $('#travel_to').on('change', function(){
        var value = $(this).val();
        var text = $('#travel_to option:selected').text();
        
        $('#travel_to_text').val(text);
        // if (value != "India") { $("#c_reside").hide(); $("#c_select").hide(); $("#c_box").show()}

        if(value == "India"){
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_india, function(key, value) {
                 $('#citizen_to')
                    .append($("<option></option>")
                    .attr("value",key)
                    .text(value));
            });
        }else if(value == "HongKong"){
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function(key, value) {
                 $('#citizen_to')
                    .append($("<option></option>")
                    .attr("value",key)
                    .text(value));
            });
            $('#residing_in').append($("<option></option>")
                    .attr("value","IND")
                    .text("India"));
        }else if(value == "Malaysia"){
            $('#citizen_to').attr('disabled','');
            $('#residing_in').attr('disabled','');
            $('#lp_link').css('display','inline-block');
            $('#lp_link').attr('href','/rca_website_l/public/malaysia');
            $('#btn_step1').css('display','none');
            $("#c_reside").hide(); $("#c_select").hide(); $("#c_box").show();
        }else if(value == "Cambodia"){
            $('#citizen_to').attr('disabled','');
            $('#residing_in').attr('disabled','');
            $('#lp_link').css('display','inline-block');
            $('#lp_link').attr('href','/rca_website_l/public/cambodia');
            $('#btn_step1').css('display','none');
            $("#c_reside").hide(); $("#c_select").hide(); $("#c_box").show();
        }else if(value == "Turkey"){
            $('#citizen_to').attr('disabled','');
            $('#residing_in').attr('disabled','');
            $('#lp_link').css('display','inline-block');
            $('#lp_link').attr('href','/rca_website_l/public/turkey');
            $('#btn_step1').css('display','none');
            $("#c_reside").hide(); $("#c_select").hide(); $("#c_box").show();
        }else if(value == "Vietnam"){
            $('#citizen_to').attr('disabled','');
            $('#residing_in').attr('disabled','');
            $('#lp_link').css('display','inline-block');
            $('#lp_link').attr('href','/rca_website_l/public/vietnam');
            $('#btn_step1').css('display','none');
            $("#c_reside").hide(); $("#c_select").hide(); $("#c_box").show();
        }else if(value == "Srilanka"){
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function(key, value) {
                 $('#citizen_to')
                    .append($("<option></option>")
                    .attr("value",key)
                    .text(value));
            });
            $('#residing_in').append($("<option></option>")
                    .attr("value","IND")
                    .text("India"));
        }else{
            $('#citizen_to').removeAttr('disabled');
            $('#residing_in').removeAttr('disabled');
            $('#lp_link').css('display','none');
            $('#btn_step1').css('display','inline-block');

            $("#c_reside").show();
            $("#c_select").show();

            $("#c_box").hide();
        }
    });

    //checkCookie();
	
	checkSession();
});

function calcprice(){
  // var adultprice = localStorage.getItem('adultprice');
  // var childprice = localStorage.getItem('childprice');
  var childprice = 0;
  var adultprice = 0;

  if($('input[name="adultprice"').val() != ""){
    var adultprice = $('input[name="adultprice"').val();
  }

  if($('input[name="childprice"').val() != ""){
    var childprice = $('input[name="childprice"').val();
  } 
  
  console.log(adultprice+"/"+childprice);
  var total = parseInt(adultprice) + parseInt(childprice);

  $('#prodprice').html(total);
  $('#prod_price').val(total);
}

function uploadfile(fileinput,doctype, userid, applicatid){
  var input = fileinput;
  var form_data = new FormData();
  form_data.append("file", input[0].files[0]);
  form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
  form_data.append('doc_type',doctype);
  form_data.append('user_id',userid);
  form_data.append('applicat_id',applicatid);
  $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
  // console.log(form_data);return false;
      // select the form and submit
      if (confirm('Are you sure to upload this document?')) {
          $.ajax({
            url: "/orders/ajaxfileUpload",
            type: "POST",
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
              console.log(response);
            }
          });
      }
}

function add_div(val){
  var value = parseInt($('#div_number').val(), 10);
  value = isNaN(value) ? 1 : value;
  value++;
  // console.log(value);return false;
  $('#div_number').val(value);
  $('#div_minus').show();
  $('#row_'+value).css('display','inline-block');
  $('#selcountry_'+value).removeAttr('disabled');
  $('#selcountry_'+value).attr('required','');
  $('#selyear_'+value).removeAttr('disabled');
  $('#selyear_'+value).attr('required', '');
  $('#inputvisit_'+value).removeAttr('disabled');
  $('#inputvisit_'+value).attr('required', '');
}
function remove_div(val){
  var value = parseInt($('#div_number').val(), 10);
  value = isNaN(value) ? 1 : value;
  // console.log(value);return false;
  value--;
  $('#div_minus').hide();
  $('#div_number').val(value);
  $('#row_'+value).css('display','none');
  $('#selcountry_'+value).attr('disabled','');
  $('#selcountry_'+value).removeAttr('required');
  $('#selyear_'+value).attr('disabled','');
  $('#selyear_'+value).removeAttr('required');
  $('#inputvisit_'+value).attr('disabled','');
  $('#inputvisit_'+value).removeAttr('required');
}
function stopCarret() {
  if (obj.value.length > 3){
    setCaretPosition(obj, 3);
  }
}

function setCaretPosition(elem, caretPos) {
    if(elem != null) {
        if(elem.createTextRange) {
            var range = elem.createTextRange();
            range.move('character', caretPos);
            range.select();
        }
        else {
            if(elem.selectionStart) {
                elem.focus();
                elem.setSelectionRange(caretPos, caretPos);
            }
            else
                elem.focus();
        }
    }
}
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie() {
    var partial_form=getCookie("partial_form");
    var uid = getCookie("uid");
    var order_id = getCookie("order_id");
    console.log(uid);
    //console.log(window.location.protocol + "//" + window.location.hostname + "/");
    if (partial_form != "") {
        if ((window.location.protocol + "//" + window.location.hostname + "/")+"rca_website_l/public/" !== (window.location.href)) {
            $(".__notification").hide();
        }else{
            $(".__notification").show();   
        }
    } else {
       if (partial_form != "" && partial_form != null) {
           setCookie("partial_form", partial_form, 30);
           setCookie("uid", uid, 30);
           setCookie("order_id", order_id, 30);
       }
    }
}

function checkSession(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/rca_website_l/public/checksession",
        type: "GET",
		dataType:"json",
        success: function (response) {
			//console.log(response);return false;
            if(response.status == "success"){
				if (response.value.partial_form != "") {
					if ((window.location.protocol + "//" + window.location.hostname + "/")+"rca_website_l/public/" !== (window.location.href)) {
						$(".__notification").hide();
					}else{
						$(".__notification").show();   
					}
					
					$('#com_form').on('click', function(){
						var uid = response.value.user_id;
						var order_id = response.value.order_id;
						$.ajaxSetup({
							headers: {
								  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							}
						});
						$.ajax({
							url: "/rca_website_l/public/evisa/completeform",
							type: "POST",
							dataType:"json",
							data: {uid:uid,order_id:order_id},
							success: function (response) {
								//console.log(response);return false;
								window.location.href = response.form_url;
							}
						});
					});
					
				}	
			}	
        }
    });
}

function disableSubmit() {
  document.getElementById("btn_confirm").disabled = true;
}

function activateButton(element) {

      if(element.checked) {
        document.getElementById("btn_confirm").disabled = false;
       }
       else  {
        document.getElementById("btn_confirm").disabled = true;
      }

}

function removeforntthumb(){
    $('#div_front_thumb').html("<div class='doc-head'>Colored frontpage of valid passport</div>");
}

function removephotothumb(){
    $('#div_photo_thumb').html("<div class='doc-head'>Passport Size photograph</div>");
}

/* function josnform(){
	var formDetails={
                $targetCont: $('#rca-app-container'),
                formJSON: getFormJson(),
                formData: getFormData(),
                ajaxFunction: callAjax,
                columns: 2,
                defaultFieldSize:8
            };

            new RCADynamicForm(formDetails);
}

function callAjax(requestData,success,error) {
            $.ajax({
                url: '/rca_website_l/public/ajaxhandler',
                method:'POST',
                dataType:'JSON',
                data:requestData,
                success:success,
                error:error
            });
        }
        function getFormData() {
            return {
                "surname":"Paul",
                "resident":"usa",
                "mission":"uk"
            };   
        }
        function getFormJson() {
            return {
                "formName": "f1",
                "validationJsonCode": "VAL_DEFN_1",
                "desc": "some desc",
                "sections": [
                    {
                        "secName": "sec 1",
                        "secDesc": "sec  1 desc.",
                        "buttons": [
                            {
                                "code": "btn1",
                                "label": "button 1",
                                "actionAjax": "function name"
                            }
                        ],
                        "formFields": [
                            {
                                "qText": "Surname please",
                                "qHelpText": "Some gyan about surname.",
                                "required": "Y",
                                "ansFieldName": "surname",
                                "ansFieldType": "text"
                            },
                            {
                                "qText": "passport type pick list",
                                "qHelpText": "Some gyan about the passport type.",
                                "required": "Y",
                                "ansFieldName": "passport-type",
                                "ansFieldType": "list",
                                "ansFieldValuesFunction": "ajax_get_display_passport_type_list"
                            },
                            {
                                "qText": "passport issuing country question",
                                "qHelpText": "Some gyan about passport issue country.",
                                "ansFieldName": "passport-issuing-country",
                                "ansFieldType": "long-list",
                                "required": "Y",
                                "ansFieldValuesFunction": "ajax_get_display_country_list"
                            },
                            {
                                "qText": "Gender question",
                                "qHelpText": "Some gyan about gender..",
                                "ansFieldName": "gender",
                                "ansFieldType": "dropdown",
                                "required": "Y",
                                "ansFieldValues": [
                                    {
                                        "code": "M",
                                        "name": "Male"
                                    },
                                    {
                                        "code": "F",
                                        "name": "Female"
                                    }
                                ]
                            },
                            {
                                "qText": "Date of birth question",
                                "qHelpText": "this has calculation associated with dob.",
                                "ansFieldName": "dob",
                                "ansFieldType": "date",
                                "fieldSize":6,
                                "required": "Y",
                                "validation": "P",
                                "applyCalcAjax": "ajax_for_calc",
                                "passCalcValue": [
                                    "adult_child_class"
                                ]
                            },
                            {
                                "qText": "This field should prepopulate because of dob",
                                "qHelpText": "this can be any type text/drop down/etc, dob saves, calls ajax, take result, put in values json so that this field initialises",
                                "ansFieldName": "adult_child_class",
                                "ansFieldType": "dropdown",
                                "required": "Y",
                                "ansFieldValues": [
                                    {
                                        "code": "adult",
                                        "name": "Adult"
                                    },
                                    {
                                        "code": "child",
                                        "name": "Child"
                                    }
                                ]
                            },
                            {
                                "qText": "Where are you going to",
                                "qHelpText": "mission name",
                                "ansFieldName": "mission",
                                "ansFieldType": "dropdown",
                                "ansFieldValues": [
                                    {
                                        "code": "usa",
                                        "name": "U.S.A"
                                    },
                                    {
                                        "code": "uk",
                                        "name": "U.K."
                                    },
                                    {
                                        "code": "eu",
                                        "name": "Shin Chan"
                                    },
                                    {
                                        "code": "uae",
                                        "name": "Shiek Land"
                                    }
                                ]
                            },
                            {
                                "qText": "Where are from",
                                "qHelpText": "resident of..",
                                "ansFieldName": "resident",
                                "ansFieldType": "dropdown",
                                "ansFieldValues": [
                                    {
                                        "code": "india",
                                        "name": "India"
                                    },
                                    {
                                        "code": "uk",
                                        "name": "U.K."
                                    },
                                    {
                                        "code": "usa",
                                        "name": "U.S.A"
                                    }
                                ]
                            },
                            {
                                "qText": "multi select..",
                                "qHelpText": "this question is multi.",
                                "ansFieldName": "multi11",
                                "ansFieldType": "dropdown-multi",
                                "required": "Y",
                                "ansFieldValues": [
                                    {
                                        "code": "music",
                                        "name": "Music"
                                    },
                                    {
                                        "code": "movies",
                                        "name": "Movies"
                                    },
                                    {
                                        "code": "games",
                                        "name": "Games"
                                    }
                                ]
                            },
                            {
                                "qText": "radio..",
                                "qHelpText": "this question is radio.",
                                "ansFieldName": "radio1",
                                "ansFieldType": "radio",
                                "required": "Y",
                                "ansFieldValues": [
                                    {
                                        "code": "morning",
                                        "name": "Morning"
                                    },
                                    {
                                        "code": "afternoon",
                                        "name": "Afternoon"
                                    },
                                    {
                                        "code": "evening",
                                        "name": "Evening"
                                    }
                                ]
                            },
                            {
                                "qText": "visibility check..",
                                "qHelpText": "this question is dependent on other answers.",
                                "ansFieldName": "dep1",
                                "ansFieldType": "text",
                                "enablingFields": [
                                    "passport-type",
                                    "gender"
                                ],
                                "enablingValues": [
                                    "Normal#M",
                                    "Deplomatic#M"
                                ],
                                "required": "Y"
                            },
                            {
                                "qText": "visibility and dependent data check..",
                                "qHelpText": "this question and its data is dependent on other answers.",
                                "ansFieldName": "dep2",
                                "ansFieldType": "dropdown",
                                "nature": "multi-dependent",
                                "parents": [
                                    "resident",
                                    "mission"
                                ],
                                "enablingFields": [
                                    "gender"
                                ],
                                "enablingValues": [
                                    "M"
                                ],
                                "required": "Y",
                                "ansFieldValues": {
                                    "india#uae": [
                                        {
                                            "code": "14Day",
                                            "name": "14 Days Tourist"
                                        },
                                        {
                                            "code": "30Day",
                                            "name": "30 Days Tourist"
                                        },
                                        {
                                            "code": "90Day",
                                            "name": "90 Days Tourist"
                                        },
                                        {
                                            "code": "96Hr",
                                            "name": "96 Hours Transit"
                                        },
                                        {
                                            "code": "96HrReturn",
                                            "name": "96 Hours Return"
                                        }
                                    ],
                                    "india#usa": [
                                        {
                                            "code": "ind_b2",
                                            "name": "India Business/Tourism"
                                        }
                                    ],
                                    "india#uk": [
                                        {
                                            "code": "ind_uk_single",
                                            "name": "India UK Single Entry"
                                        },
                                        {
                                            "code": "ind_uk_multi",
                                            "name": "India UK Multi Entry"
                                        }
                                    ],
                                    "india#eu": [
                                        {
                                            "code": "ind_eu_1",
                                            "name": "India EU 1 Country"
                                        },
                                        {
                                            "code": "ind_eu_2",
                                            "name": "India EU All Country"
                                        }
                                    ],
                                    "uk#uae": [
                                        {
                                            "code": "uk_90Day",
                                            "name": "UK 90 Days Tourist"
                                        },
                                        {
                                            "code": "uk_96Hr",
                                            "name": "UK 96 Hours Transit"
                                        }
                                    ],
                                    "uk#usa": [
                                        {
                                            "code": "allies_b2",
                                            "name": "UK Business/Tourism"
                                        }
                                    ],
                                    "usa#uk": [
                                        {
                                            "code": "free_entry",
                                            "name": "US UK Many Entry"
                                        }
                                    ],
                                    "uk#eu": [
                                        {
                                            "code": "brexit",
                                            "name": "Brexit"
                                        }
                                    ]
                                }
                            }
                        ]
                    },
                    {

                    }
                ]
            };
    } */
