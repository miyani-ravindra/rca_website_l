$(function () {
    console.log("ready!");
    var childprice = 0;
    var adultprice = 0;


    $(document).ready(function () {

        //RCAV1-51 - START
        if (!(localStorage.getItem("active_tab") === null)) {

            if (localStorage.getItem("active_tab") == 'group_size_max_mna') {
                $("#e_visa_tab").removeClass("__current");
                $("#lounge_tab").removeClass("__current");

                $("#tab-1").removeClass("__current");
                $("#tab-3").removeClass("__current");

                $("#mna_tab").addClass("__current");
                $("#tab-2").addClass("__current");
            } else if (localStorage.getItem("active_tab") == 'group_size_max_lounge') {

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
        if ($("#errorModalForMna").length > 0) {
            $('#errorModalForMna').modal('show');
        }

        if ($("#errorModalForLounge").length > 0) {
            $('#errorModalForLounge').modal('show');
        }
        //RCAV1-51 - END


        //RCAV1-85 - START
        if ($("#previous_surname").length > 0) {
            $('#previous_surname').addClass('divhide');
            $('#previous_surname').removeClass('divshow');
            $('input[name="previous_surname"').removeAttr('required');
        }

        if ($("#previous_name").length > 0) {
            $('#previous_name').addClass('divhide');
            $('#previous_name').removeClass('divshow');
            $('input[name="previous_name"]').removeAttr('required');
        }


        if ($("#grandparent_details").length > 0) {
            $('#grandparent_details').hide();
            $('input[name="grandparent_details"]').removeAttr('required');
        }



            

        //RCAV1-85 - END


            




    });


    if ($('#adults').val() == "" || $('#adults').val() == 0) {
        $('#count_adult').html("0");
    }

    if ($('#children').val() == "" || $('#children').val() == 0) {
        $('#count_child').html("0");
    }

    $('#contact-message').hide();
    $('#contact_form').submit(function (event) {
        // Stop the browser from submitting the form.
        event.preventDefault();
        var formData = $('#contact_form').serialize();
        console.log('Form data: ' + formData);
        //var formData = "hello";
        $.ajax({
            method: "POST",
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
            success: function (response) { //alert(response);
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

    $('#btn_save').on('click', function () {
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
            type: "POST",
            url: "ajaxsubmitdata",
            data: {
                'uid': uid,
                'product_id': product_id,
                'adult': adult,
                'child': child,
                'infant': infant,
                'first_name': first_name,
                'email': email,
                'phone': phone,
                'airline_type': airline_type,
                'nation': nation,
                'product_price': prod_price,
                'traval_date': traval_date
            },
            success: function (response) {
                $('#submit_val').val(response);
                // console.log(response);
                // window.location.reload();
                localStorage.setItem('product_id', "");
                localStorage.setItem('childprice', "");
                localStorage.setItem('adultprice', "");
            }
        });

    });


    $('input[name="quant[1]"]').change(function () {
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
            type: "POST",
            url: "ajaxgetproductprice",
            data: {
                product_id: prod_id,
                person_type: 'adult'
            },
            success: function (response) {
                adultprice = valueCurrent * response.price;
                if (valueCurrent > 0) {
                    $('input[name="adultprice"]').val(adultprice);
                } else {
                    $('input[name="adultprice"]').val(0);
                }
                calcprice();
                console.log(adultprice);
            }
        });

    });

    $('input[name="quant[2]"]').change(function () {
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
            type: "POST",
            url: "ajaxgetproductprice",
            data: {
                product_id: prod_id,
                person_type: 'adult'
            },
            success: function (response) {
                childprice = valueCurrent * response.price;

                if (valueCurrent > 0) {
                    $('input[name="childprice"]').val(childprice);
                } else {
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
        onChange: function (dateObj, dateStr) {
            // console.info(dateObj);
            // console.info(dateStr);
            var mydate = new Date(dateStr);
            var locale = "en-us";
            var ordDate = mydate.getDate() + " " + mydate.toLocaleString(locale, {
                month: "short"
            }) + " " + mydate.getFullYear();
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
        onChange: function (dateObj, dateStr) {
            // console.info(dateObj);
            // console.info(dateStr);
            var mydate = new Date(dateStr);
            var locale = "en-us";
            var ordDate = mydate.getDate() + " " + mydate.toLocaleString(locale, {
                month: "short"
            }) + " " + mydate.getFullYear();
            $('#traval_date').html(ordDate);
            $('.datepkr.active').removeClass('active').next().click();

        }
    });

    $('.dob.flatpickr-input').on('keydown', function (e) {
        if (e.keyCode == 9) {
            // alert("hii");
            if ($(this).val() != '') {
                console.log("hitesting");
                setActive();
                // $(".input-block.datepkr").removeClass("active");
                // $("#contry_of_birth").addClass("active");
            } else {
                console.log("bye");
            }
        }
    });

    $('.grandparent_chekbx').on('keydown', function (e) {
        if (e.keyCode == 9) {
            if ($('#no-gr-pak').attr('checked')) {
                // alert("hi");
                $(".input-block.active").removeClass("active").next().click();
                $("#grandparent_dtls").addClass("active");
                // setActive();
            } else {}
        } else {}
    });
    // $('.grandparent_chekbx').on('keydown', function (e) {
    //     if (e.keyCode == 9) {
    //         setActive();
    //     } else {
    //         console.log("bye");
    //     }
    // });

    $('#doi').flatpickr({
        altInput: true,
        altFormat: "j F, Y",
        //dateFormat: "Y-m-d H:i",
        dateFormat: "Y-m-d",
        // minDate: new Date().fp_incr(4),
        maxDate: "today",
        //dateFormat: "d-m-Y",
        //enableTime: true,
        altInput: true,
        altFormat: "j F, Y",
        //dateFormat: "Y-m-d H:i",
        dateFormat: "Y-m-d",
        // minDate: new Date().fp_incr(4),
        maxDate: "today",
        //dateFormat: "d-m-Y",
        //enableTime: true,
        onChange: function (dateObj, dateStr) {
            // console.info(dateObj);
            // console.info(dateStr);
            var mydate = new Date(dateStr);
            var locale = "en-us";
            var ordDate = mydate.getDate() + " " + mydate.toLocaleString(locale, {
                month: "short"
            }) + " " + mydate.getFullYear();
            $('#traval_date').html(ordDate);
            $('.datepkr.active').removeClass('active').next().click();
        }
    });

    $('#doe').flatpickr({
        altInput: true,
        //minDate: "j F, Y",
        altFormat: "j F, Y",
        //dateFormat: "Y-m-d H:i",
        dateFormat: "Y-m-d",
        disableMobile: "true",
        minDate: "today",
        // minDate: new Date().fp_incr(4),
        // maxDate: new Date().fp_incr(120),
        //dateFormat: "d-m-Y",
        //enableTime: true,
        onChange: function (dateObj, dateStr) {
            // console.info(dateObj);
            // console.info(dateStr);
            var mydate = new Date(dateStr);
            var locale = "en-us";
            var ordDate = mydate.getDate() + " " + mydate.toLocaleString(locale, {
                month: "short"
            }) + " " + mydate.getFullYear();
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
        maxDate: "today",
        // minDate: new Date().fp_incr(4),
        // maxDate: new Date().fp_incr(120),
        //dateFormat: "d-m-Y",
        //enableTime: true,
        onChange: function (dateObj, dateStr) {
            // console.info(dateObj);
            // console.info(dateStr);
            var mydate = new Date(dateStr);
            var locale = "en-us";
            var ordDate = mydate.getDate() + " " + mydate.toLocaleString(locale, {
                month: "short"
            }) + " " + mydate.getFullYear();
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
        maxDate: "today",
        // minDate: new Date().fp_incr(4),
        // maxDate: new Date().fp_incr(120),
        //dateFormat: "d-m-Y",
        //enableTime: true,
        onChange: function (dateObj, dateStr) {
            // console.info(dateObj);
            // console.info(dateStr);
            var mydate = new Date(dateStr);
            var locale = "en-us";
            var ordDate = mydate.getDate() + " " + mydate.toLocaleString(locale, {
                month: "short"
            }) + " " + mydate.getFullYear();
            $('#traval_date').html(ordDate);
            $('.datepkr.active').removeClass('active').next().click();
        }
    });

    $('.btn_order').on('click', function () {
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
            type: "POST",
            url: "/orders/ajaxapplicant",
            data: {
                uid: uid,
                oid: oid
            },
            success: function (response) {
                console.log(response.status);
                if ($('#uid').val !== '' && $('#oid').val !== '') {
                    $('#frmdocument').submit();
                }
            }
        });

        $.ajax({
            type: "POST",
            url: "/orders/ajaxgetorderdetails",
            data: {
                uid: uid,
                oid: oid
            },
            success: function (response) {
                console.log(response);
                var mydate = new Date(response.orddetails.created_at);
                var locale = "en-us";
                var ordDate = mydate.getDate() + " " + mydate.toLocaleString(locale, {
                    month: "short"
                }) + " " + mydate.getFullYear();

                $('#prod_name').html(response.orddetails.product_name);
                $('#no_adult').html(response.orddetails.adult);
                $('#no_child').html(response.orddetails.child);
                $('#ord_date').html(ordDate);
                $('.__app_status').empty();

                var applen = response.getappstatus.length;
                $('.__app_status').append('<p class="__status"><span>Status :</span> Application Not Submitted!!</p>')
                if (applen > 0) {
                    $.each(response.getappstatus, function (index, repo) {
                        $('.__app_status').append('<div class="__pax_status" id="app_status"><h5>' + repo.username + '</h5><div class="__pax_docs">Application Form <span class="__status_badge">Completed</span></div><div class="__pax_docs">Document Submission  <span class="__status_badge _incompelete">Incomplete</span></div></div>');
                    });
                } else {
                    $('.__app_status').append('<div class="__pax_status" id="app_status"><h5>Record Not Found</h5></div>');
                }

            }
        });

    });

    $('#edit_info').on('click', function () {
        if ($('.__travel_input').hasClass('__travel_input_edit')) {
            $('#editphone').removeAttr('readonly');
            $('#editdate').removeAttr('readonly');
        } else {
            $('#editphone').attr('readonly', "");
            $('#editdate').attr('readonly', "");
        }
    });

    $('#save').on('click', function () {
        var uid = $('#edituid').val();
        var oid = $('#editoid').val();
        var phone = $('#editphone').val();
        var traveldate = $('#editdate').val();

        if (confirm('Are you sure?')) {
            $.ajax({
                type: "POST",
                url: "/orders/ajaxeditaccount",
                data: {
                    uid: uid,
                    oid: oid,
                    phone: phone,
                    traveldate: traveldate
                },
                success: function (response) {
                    console.log(response);
                    if (response.status == "success") {
                        $('#message_box').css('display', 'block');
                        $('#message_box').html(response.msg);
                    }
                }
            });
        }
    });

    $('form[name="app_frm"]').on('submit', function (e) {
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
                if (response.status == "success") {
                    $('#message-box').css('display', 'block');
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

    $('#btn_track_otp').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/rca_website_l/public/evisa/ajaxsendotp",
            type: "POST",
            dataType: "json",
            data: {
                app_track: "Y",
                email_id: $('input[name="email_id"').val()
            },
            success: function (response) {
                if (response.status == "success") {
                    $('#message-box').css('color', 'green');
                    $('#message-box').html(response.msg);
                    $('#btn_send_otp').attr('disabled', '');
                    $('#btn_track_confirm').removeAttr('disabled');
                    $('input[name="opt_number[]"]').removeAttr('readonly');

                    $('input[name="opt_number[]"]').on('keydown', function () {
                        stopCarret
                    });

                    $('input[name="opt_number[]"]').on('keyup', function () {
                        stopCarret
                    });
                } else if (response.status == "not_match") {
                    $('#message-box').css('color', 'red');
                    $('#message-box').html(response.msg);
                    $('input[name="opt_number[]"]').attr('readonly', '');
                }
            }
        });
    });

    $('#btn_resend_track').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/rca_website_l/public/evisa/ajaxsendotp",
            type: "POST",
            dataType: "json",
            data: {
                applicant_id: $('input[name="order_code"]').val(),
                email_id: $('input[name="email_id"').val()
            },
            success: function (response) {
                if (response.status == "success") {
                    $('#message-box').css('color', 'green');
                    $('#message-box').html(response.msg);
                    setInterval(function () {
                        $("#message-box").fadeOut(1000);
                    }, 5000);

                    $('#btn_send_otp').attr('disabled', '');
                    $('#btn_track_confirm').removeAttr('disabled');
                    $('input[name="opt_number[]"]').removeAttr('disabled');
                } else if (response.status == "not_match") {
                    $('#message-box').css('color', 'red');
                    $('#message-box').html(response.msg);
                    $('input[name="opt_number[]"]').attr('disabled', '');
                }
            }
        });
    });

    $('#btn_resend').on('click', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/rca_website_l/public/evisa/ajaxsendotp",
            type: "POST",
            dataType: "json",
            data: {
                email_id: $('input[name="email_id"').val(),
                username: $('input[name="user_name"]').val()
            },
            success: function (response) {
                if (response.status == "success") {
                    $('#message-box').css('display', 'block');
                    $('#message-box').html(response.msg);
                    setInterval(function () {
                        $("#message-box").fadeOut(1000);
                    }, 5000);
                    $('#btn_edit_otp').hide();
                    $('#btn_send_otp').attr('disabled', '');
                    $('#btn_confirm').removeAttr('disabled');
                }
            }
        });
    });

    $('._close').on('click', function () {
        // do something…
        localStorage.setItem('product_id', "");
        localStorage.setItem('childprice', "");
        localStorage.setItem('adultprice', "");
    });

    $('ul.__appt_tabs li').click(function () {
        var tab_id = $(this).attr('data-tabs');

        $('ul.__appt_tabs li').removeClass('active');
        $('.__appt_tab_content').removeClass('active');

        $(this).addClass('active');
        $("#" + tab_id).addClass('active');
    });

    var acc = document.getElementsByClassName("__accord_head");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
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
            email_id: {
                required: true,
                email: true
            },
            phone_number: {
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
            opt_number: {
                required: "Please Enter OTP Number",
                minlength: "Enter Valid OTP Number"
            }
        },
        submitHandler: function (form) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/rca_website_l/public/ajaxcheckotp",
                type: "POST",
                dataType: "json",
                data: {
                    uid: $('#uid').val()
                },
                success: function (response) {
                    var opt_number = $('input[name="opt_number"]').val();
                    if (response.status == "success") {
                        if (opt_number === response.data.otp_number) {
                            form.submit();
                        } else {
                            var validator = $("#frmverify").validate();
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
        ignore: [],
        rules: {
            user_name: {
                required: true,
                alpha: true
            },
            email_id: {
                required: true,
                email: true
            },
            phone_number: {
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
            },
            residing_code: {
                required: true
            }
        },
        messages: {
            user_name: {
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
                required: "Select port of arrival"
            },
            frontpage: {
                required: 'Upload Front Passport Image',
                accept: "Allow Only jpeg/jpg file"
            },
            photograph: {
                required: 'Upload Photograph Image',
                accept: "Allow Only jpeg/jpg file"
            },
            residing_code: {
                required: "Select residing in"
            },
            
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
                // required: true,
                alpha: true
            },
            surname: {
                required: false,
                alpha: true
            },
            name_changed: {
                required: true
            },
            previous_surname: {
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
                alpha: true,
                // min:3
            },
            nation_id: {
                required: true,
                alphanumeric: true
            },
            religion_code: {
                required: true
            },
            visible_marks: {
                required: true,
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
            },
            dob: {
                required: true
            },
            doi: {
                required: true
            },
            doe: {
                required: true
            }
        },
        messages: {
            given_name: {
                required: "Please enter your given name",
                alpha: "Please enter alphabet or spaces only"
            },
            surname: {
                alpha: "Please enter alphabet or spaces only"
            },
            previous_surname: {
                alpha: "Please enter alphabet or spaces only",
                required: "Please enter your previous surname",
            },
            name_changed: {
                required: "Please select an option"
            },
            previous_name: {
                alpha: "Please enter alphabet or spaces only",
                required: "Please enter your previous name",
            },
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
            dob: {
                required: "Please select date of birth"
            },
            doi: {
                required: "Please select your passport issue date"
            },
            doe: {
                required: "Please select your passport expiry date"
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
            error.insertBefore($(element).parent());
        },
    });

    $('#frmevisaform ').submit(function (e) {

        var doe = new Date($("#doe").val());
        var date = new Date();

        if (doe < date) {
            console.log("Error");
            $("#doe-error").append("Expiry Date Cannot be less than today");
            e.preventDefault();
        } else console.log("Done");



    });
    $('#frmevisafamilyform').validate({
        rules: {
            pres_add1: {
                required: true
            },
            pres_add2: {
                required: true
            },
            pres_country: {
                required: false
            },
            state_name: {
                required: false
            },
            pincode: {
                required: true,
                alphanumeric: true
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
                alpha: true,
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
                required: true
            },
            grandparent_flag1: {
                required: true
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
            pres_add1: {
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
                alphanumeric: "Please enter alphabet or numbers only"
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
                required: "Please select Yes or No",
                // alpha: "Please enter alphabet or spaces only"
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
            // error.insertBefore($(element).parent('div.input-control'));
            error.insertBefore($(element).parent());

        }
    });

    $('#frmevisadetails').validate({
        rules: {
            service_req_form_values: {
                required: true
            },
            pres_country: {
                required: true
            },
            phoneofsponsor_msn: {
                numeric: true
            },
            phoneofsponsor_ind: {
                numeric: true
            }
        },
        messages: {
            service_req_form_values: {
                required: "Please enter places to be visited"
            },
            phoneofsponsor_ind: {
                numeric: "Enter Numbers only"
            },
            phoneofsponsor_msn: {
                numeric: "Enter Numbers only"
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
        // errorElement: 'span',
        // errorClass: 'help-block',
        // errorPlacement: function (error, element) {
        //     // console.log("errorPlacement");
        //     error.insertAfter(element);
        // }
        errorElement: 'div',
        errorClass: 'error-block',
        errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            // error.insertBefore($(element).parent('div.input-control'));
            error.insertBefore($(element).parent());
        }
    });

    $('#frmextradoc').validate({
        rules: {
            business_card: {
                required: function (element) {
                    return $('input[name="business_file"]').val() == "";
                },
                extension: "pdf"
            },
            hospital_letter: {
                required: function (element) {
                    return $('input[name="hospital_file"]').val() == "";
                },
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

    $('#passport_code').on('change', function () {
        var type = $(this).val();
        if (type != 5) {
            $('#passport_type_error').css('display', 'block');
            $('#passport_type_error').html('Be Process only Ordinary Passport');
            $('#btnapply').attr('disabled', 'true');
        } else {
            $('#passport_type_error').css('display', 'none');
            $('#passport_type_error').html('');
            $('#btnapply').removeAttr('disabled');
        }
    });

    $("#frmevisaform select[name=nationality]").change(function () {
        var nationality = $(this).val();
        console.log(nationality);

        $("select[name=prev_nationality] option[value='" + nationality + "']").remove();
    });

    $('input[name="name_changed"]').on('change', function () {
        // If not, hide the fields.
        if ($(this).val() == "Y") {
            // Show the hidden fields.
            //$('#previous_surname').show();
            //$('#previous_name').show();
            $('#previous_name').addClass('divshow');
            $('#previous_name').removeClass('divhide');
            $('#previous_surname').addClass('divshow');
            $('#previous_surname').removeClass('divhide');
            $('input[name="previous_surname"]').attr('required', true);
            $('input[name="previous_name"]').attr('required', true);
        } else {
            // Make sure that the hidden fields are indeed
            // hidden.
            //$('#previous_surname').hide();
            //$('#previous_name').hide();
            $('#previous_name').addClass('divhide');
            $('#previous_name').removeClass('divshow');
            $('#previous_surname').addClass('divhide');
            $('#previous_surname').removeClass('divshow');
            $('input[name="previous_surname"').removeAttr('required');
            $('input[name="previous_name"]').removeAttr('required');
        }
    });

    $('.perm_addr').removeAttr('hidden');

    $('input[name="sameAddress_id"]').on('change', function () {
        if ($(this).val() == 'Y') {
            var pres_add = $('input[name="pres_add1"]').val();
            var pres_add2 = $('input[name="pres_add2"]').val();
            var pres_add3 = $('input[name="state_name"]').val();

            $('input[name="perm_address1"]').val(pres_add);
            $('input[name="perm_address2"]').val(pres_add2);
            $('input[name="perm_address3"]').val(pres_add3);

            // $('.perm_addr').attr('hidden', '');
            $('.perm_addr').addClass('divhide');
            $('.perm_addr').removeClass('divshow');

        } else {
            // $('.perm_addr').removeAttr('hidden');
            $('.perm_addr').removeClass('divhide');
            $('.perm_addr').addClass('divshow');
            $('input[name="perm_address1"]').val("");
            $('input[name="perm_address2"]').val("");
            $('input[name="perm_address3"]').val("");
        }
    });
    //tyform change id to class
    $('.spouse_div').hide();
    $('input[name="mstatus"]').on('focus', function () {
        var value = $(this).val();
        if (value == 'Married') {
            $('.spouse_div').show();
            $('input[name="spouse_name"]').attr('required', '');
            $('select[name="spouse_nationality"]').attr('required', '');
            $('input[name="spouse_place_of_birth"]').attr('required', '');
            $('select[name="spouse_country_of_birth"]').attr('required', '');
        } else {
            $('.spouse_div').hide();
            $('input[name="spouse_name"]').removeAttr('required');
            $('select[name="spouse_nationality"]').removeAttr('required');
            $('input[name="spouse_place_of_birth"]').removeAttr('required');
            $('select[name="spouse_country_of_birth"]').removeAttr('required');
            $('input[name="spouse_name"]').val('');
            $('select[name="spouse_nationality"] option:selected').removeAttr('selected');
            $('input[name="spouse_place_of_birth"]').val('');
            $('select[name="spouse_country_of_birth"] option:selected').removeAttr('selected');
            $('select[name="spouse_previous_nationality"] option:selected').removeAttr('selected');
        }
    });

    var mstatus = $('select[name="mstatus"]').val();
    if (mstatus == 2) {
        $('.spouse_dtl').show();
        $('input[name="spouse_name"]').attr('required', '');
        $('select[name="spouse_nationality"]').attr('required', '');
        $('input[name="spouse_place_of_birth"]').attr('required', '');
        $('select[name="spouse_country_of_birth"]').attr('required', '');
    } else {
        $('.spouse_dtl').hide();
        $('input[name="spouse_name"]').removeAttr('required');
        $('select[name="spouse_nationality"]').removeAttr('required');
        $('input[name="spouse_place_of_birth"]').removeAttr('required');
        $('select[name="spouse_country_of_birth"]').removeAttr('required');
    }
    $('select[name="mstatus"]').on('change', function () {
        var value = $(this).val();
        if (value == 2) {
            $('.spouse_dtl').show();
            $('input[name="spouse_name"]').attr('required', '');
            $('select[name="spouse_nationality"]').attr('required', '');
            $('input[name="spouse_place_of_birth"]').attr('required', '');
            $('select[name="spouse_country_of_birth"]').attr('required', '');
        } else {
            $('.spouse_dtl').hide();
            $('input[name="spouse_name"]').removeAttr('required');
            $('select[name="spouse_nationality"]').removeAttr('required');
            $('input[name="spouse_place_of_birth"]').removeAttr('required');
            $('select[name="spouse_country_of_birth"]').removeAttr('required');
            $('input[name="spouse_name"]').val('');
            $('select[name="spouse_nationality"] option:selected').removeAttr('selected');
            $('input[name="spouse_place_of_birth"]').val('');
            $('select[name="spouse_country_of_birth"] option:selected').removeAttr('selected');
            $('select[name="spouse_previous_nationality"] option:selected').removeAttr('selected');
        }
    });


    //$('#grandparent_details').hide();
    $('input[name="grandparent_flag1"]').on('change', function () {
        var value = $(this).val();
        if (value == "Y") {
            $('#grandparent_details').show();
            $('input[name="grandparent_details"]').attr('required', '');
        } else {
            $('#grandparent_details').hide();
            $('input[name="grandparent_details"]').removeAttr('required');
            $('#frmreviewind input[name="grandparent_details"]').val('');
        }
    });

    $('#frmreviewind input[name="grandparent_flag1"]').on('change', function () {
        var value = $(this).val();
        if (value == "Y") {
            $('#frmreviewind #grandparent_details').show();
            $('#frmreviewind input[name="grandparent_details"]').attr('required', '');
        } else {
            $('#frmreviewind #grandparent_details').hide();
            $('#frmreviewind input[name="grandparent_details"]').removeAttr('required');
            $('#frmreviewind input[name="grandparent_details"]').val('');
        }
    });

    // if($('#frmreviewind input[name="grandparent_flag1"]').val()=="Y"){
    //     $('#frmreviewind #grandparent_details').show();
    //     $('#frmreviewind input[name="grandparent_details"]').attr('required','');
    //   }else{
    //     $('#frmreviewind #grandparent_details').hide();
    //     $('#frmreviewind input[name="grandparent_details"]').removeAttr('required');
    //     $('#frmreviewind input[name="grandparent_details"]').val('');
    //   }

    $('#prev_nationality').hide();
    $('#aquired_nation').on('focus', function () {
        var value = $(this).val();
        if (value == 'Naturalization') {
            $('#prev_nationality').show();
            $('input[name="prev_nationality"]').attr('required', true);
        } else {
            $('#prev_nationality').hide();
            $('input[name="prev_nationality"]').removeAttr('required');
        }
    });

    $('#frmreviewind #aquired_nation').on('change', function () {
        var value = $(this).val();
        if (value == 'Naturalization') {
            $('#prev_nationality').show();
            $('select[name="prev_nationality"]').attr('required', true);
        } else {
            $('#prev_nationality').hide();
            $('select[name="prev_nationality"]').removeAttr('required');
            $('select[name="prev_nationality"] option:selected').removeAttr('selected');
        }
    });

    if ($('#frmreviewind #aquired_nation option:selected').val() == "Naturalization") {
        $('#frmreviewind #prev_nationality').show();
        $('#frmreviewind select[name="prev_nationality"]').attr('required', true);
    } else {
        $('#frmreviewind #prev_nationality option:selected').hide();
        $('#frmreviewind select[name="prev_nationality"]').removeAttr('required');
        $('#frmreviewind select[name="prev_nationality"] option:selected').removeAttr('selected');
    }

    //Service Type Check
    $.validator.addMethod("roles", function (value, elem, param) {
        return $("input[name='visa_type[]']:checkbox:checked").length > 0;
    }, "Please select atleast one visa service");

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

    $('select[name="service_req_meeting_frend[frnd_state]"]').on('change', function () {
        var stateID = $(this).val();

        if (stateID) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/ajaxgetcity",
                type: "POST",
                dataType: "json",
                data: {
                    'state_id': stateID
                },
                cache: false,
                success: function (response) { //console.log(response.result);return false;
                    if (response.status == "found") {
                        $('select[name="service_req_meeting_frend[frnd_district]"]').children('option:not(:first)').remove();
                        $.each(response.result, function (key, value) {
                            $('select[name="service_req_meeting_frend[frnd_district]"]').append('<option value=' + value.city_id + '>' + value.city_name + '</option>');
                        });
                    } else if (response.status == "not-found") {
                        $('select[name="service_req_meeting_frend[frnd_district]"]').append('<option value= "">' + response.result + '</option>');
                    } else if (response.status == "fail") {
                        $('select[name="service_req_meeting_frend[frnd_district]"]').append('<option value= "">' + response.result + '</option>');
                    }
                    // $('select[name="service_req_meeting_frend[frnd_district]"]').html(html);
                    // 
                }
            });
        } else {
            $('select[name="service_req_meeting_frend[frnd_district]"]').html('<option value="">Select state first</option>');
        }
    });

    $('select[name="service_req_short_medical[hospital_state]"]').on('change', function () {
        var stateID = $(this).val();

        if (stateID) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/ajaxgetcity",
                type: "POST",
                dataType: "json",
                data: {
                    'state_id': stateID
                },
                cache: false,
                success: function (response) { //console.log(response.result);return false;
                    if (response.status == "found") {
                        $('select[name="service_req_short_medical[hospital_district]"]').children('option:not(:first)').remove();
                        $.each(response.result, function (key, value) {
                            $('select[name="service_req_short_medical[hospital_district]"]').append('<option value=' + value.city_id + '>' + value.city_name + '</option>');
                        });
                    } else if (response.status == "not-found") {
                        $('select[name="service_req_short_medical[hospital_district]"]').append('<option value= "">' + response.result + '</option>');
                    } else if (response.status == "fail") {
                        $('select[name="service_req_short_medical[hospital_district]"]').append('<option value= "">' + response.result + '</option>');
                    }
                    // $('select[name="service_req_meeting_frend[frnd_district]"]').html(html);
                    // 
                }
            });
        } else {
            $('select[name="service_req_short_medical[hospital_district]"]').html('<option value="">Select state first</option>');
        }
    });

    $('select[name="service_req_short_yoga[yoga_institute_state]"]').on('change', function () {
        var stateID = $(this).val();

        if (stateID) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/ajaxgetcity",
                type: "POST",
                dataType: "json",
                data: {
                    'state_id': stateID
                },
                cache: false,
                success: function (response) { //console.log(response.result);return false;
                    if (response.status == "found") {
                        $('select[name="service_req_short_yoga[yoga_institute_district]"]').children('option:not(:first)').remove();
                        $.each(response.result, function (key, value) {
                            $('select[name="service_req_short_yoga[yoga_institute_district]"]').append('<option value=' + value.city_id + '>' + value.city_name + '</option>');
                        });
                    } else if (response.status == "not-found") {
                        $('select[name="service_req_short_yoga[yoga_institute_district]"]').append('<option value= "">' + response.result + '</option>');
                    } else if (response.status == "fail") {
                        $('select[name="service_req_short_yoga[yoga_institute_district]"]').append('<option value= "">' + response.result + '</option>');
                    }
                    // $('select[name="service_req_meeting_frend[frnd_district]"]').html(html);
                    // 
                }
            });
        } else {
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

    $('#btn_evisa_type').attr('disabled', '');

    $('._selectradio').on('click', function () {
        var id = $(this).attr('data-id');
        var value = $(this).val();
        var nation = $('#nationality').val();

        if (id == 1) {
            $('#' + id).attr('checked', '');
            $('#' + id).removeAttr('disabled');
            $('#evisa_purpose_' + value).attr('checked', '');
            $('#btn_evisa_type').removeAttr('disabled', '');
        }
        if (id == 2) {
            $('#' + id).attr('checked', '');
            $('#' + id).removeAttr('disabled');
            $('#evisa_purpose_' + value).attr('checked', '');
            $('#btn_evisa_type').removeAttr('disabled', '');
        }
        if (id == 3) {
            $('#' + id).attr('checked', '');
            $('#' + id).removeAttr('disabled');
            $('#evisa_purpose_' + value).attr('checked', '');
            $('#btn_evisa_type').removeAttr('disabled', '');
        }
        if (id == 2 || id == 3) {
            $('#frmevisatype').attr('action', $('#doc_route').val());
        } else {
            $('#frmevisatype').attr('action', $('#form_route').val());
        }
    });

    $('._groupradio').on('click', function () {
        var id = $(this).attr('group-id');
        var checked = $("#" + id + ":checkbox:checked").length;
        var attr = $('#' + id).attr('checked');
        var nation = $('#nationality').val();

        if (checked == 0) {
            $('#btn_evisa_type').attr('disabled', '');
        } else {
            $('#btn_evisa_type').removeAttr('disabled');
        }

        if (id == 1) {
            if (checked == 0) {
                $('input[name="evisa_purpose[' + id + ']"').removeAttr('checked');
                $('#' + id).attr('disabled', '');
                $('#' + id).removeAttr('checked');
            }
            $('#frmevisatype').attr('action', $('#form_route').val());
        }
        if (id == 2) {
            if (checked == 0) {
                $('input[name="evisa_purpose[' + id + ']"').removeAttr('checked');
                $('#' + id).attr('disabled', '');
                $('#' + id).removeAttr('checked');
                $('#frmevisatype').attr('action', $('#form_route').val());
            } else {
                $('#frmevisatype').attr('action', $('#doc_route').val());
            }
        }
        if (id == 3) {
            if (checked == 0) {
                $('input[name="evisa_purpose[' + id + ']"').removeAttr('checked');
                $('#' + id).attr('disabled', '');
                $('#' + id).removeAttr('checked');
                $('#frmevisatype').attr('action', $('#form_route').val());
            } else {
                $('#frmevisatype').attr('action', $('#doc_route').val());
            }
        }
    });

    //Previous Passport Details
    $('#prev_passport_country_issue').hide();
    $('#other_ppt_no').hide();
    $('#other_ppt_issue_place').hide();
    $('#other_ppt_date_issue').hide();
    $('#other_ppt_nationality').hide();

    $('input[name="oth_ppt"]').on('change', function () {
        var value = $(this).val();
        if (value == "Y") {
            // Show the hidden fields.
            $('#prev_passport_country_issue').show();
            $('#other_ppt_no').show();
            $('#other_ppt_date_issue').show();
            $('#other_ppt_issue_place').show();
            $('#other_ppt_nationality').show();
            $('#prev_passport_country_issue').show();
            $('input[name="prev_passport_country_issue"]').attr('required', '');
            $('input[name="other_ppt_no"]').attr('required', '');
            $('input[name="other_ppt_issue_place"]').attr('required', '');
            $('input[name="other_ppt_issue_date"]').attr('required', '');
            $('input[name="other_ppt_nationality"]').attr('required', '');
            $('select[name="prev_passport_country_issue"]').attr('required', '');
            $('select[name="other_ppt_nationality"]').attr('required', '');
        } else {
            // Make sure that the hidden fields are indeed
            // hidden.
            $('#prev_passport_country_issue').hide();
            $('#other_ppt_no').hide();
            $('#other_ppt_issue_place').hide();
            $('#other_ppt_date_issue').hide();
            $('#other_ppt_nationality').hide();
            $('input[name="prev_passport_country_issue"]').removeAttr('required');
            $('input[name="other_ppt_no"]').removeAttr('required');
            $('input[name="other_ppt_issue_place"]').removeAttr('required');
            $('input[name="other_ppt_issue_date"]').removeAttr('required');
            $('input[name="other_ppt_nationality"]').removeAttr('required');
            $('input[name="prev_passport_country_issue"]').val('');
            $('select[name="prev_passport_country_issue"] option:selected').removeAttr('selected');
            $('input[name="other_ppt_no"]').val("");
            $('input[name="other_ppt_issue_place"]').val("");
            $('input[name="other_ppt_issue_date"]').val("");
            $('input[name="other_ppt_nationality"]').val('');
            $('select[name="other_ppt_nationality"] option:selected').removeAttr('selected');
        }
    });

    /*if($('#frmreviewind input[name="oth_ppt"]').val()=="Y"){
        $('#frmreviewind #prev_passport_country_issue').show();
        $('#frmreviewind #other_ppt_no').show();
        $('#frmreviewind #other_ppt_date_issue').show();
        $('#frmreviewind #other_ppt_issue_place').show();
        $('#frmreviewind #other_ppt_nationality').show();
        $('#frmreviewind #prev_passport_country_issue').show();
        $('#frmreviewind select[name="prev_passport_country_issue"]').attr('required','');
        $('#frmreviewind input[name="other_ppt_no"]').attr('required','');
        $('#frmreviewind input[name="other_ppt_issue_place"]').attr('required','');
        $('#frmreviewind input[name="other_ppt_issue_date"]').attr('required','');
        $('#frmreviewind select[name="other_ppt_nationality"]').attr('required','');
      } */

    var prof = $('#frmreviewind select[name="pre_occupation"]').val();
    if (prof == 29) {
        $('#frmreviewind #occ_flag').show();
        $('#frmreviewind #if_prof_other').hide();
        $('select[name="occ_flag"]').attr('required', '');
        $('input[name="if_prof_other"]').removeAttr('required', '');
        $('input[name="if_prof_other"]').val('');
    } else if (prof == 20) {
        $('#frmreviewind #if_prof_other').show();
        $('#frmreviewind #occ_flag').hide();
        $('input[name="if_prof_other"]').attr('required', '');
        $('select[name="occ_flag"]').removeAttr('required', '');
        $('select[name="occ_flag"] option:selected').removeAttr('selected');
    } else if (prof !== 29 || prof !== 20) {
        $('#frmreviewind #occ_flag').hide();
        $('#frmreviewind #if_prof_other').hide();
        $('#frmreviewind select[name="occ_flag"]').removeAttr('required', '');
        $('#frmreviewind input[name="if_prof_other"]').removeAttr('required', '');
        $('#frmreviewind select[name="occ_flag"] option:selected').removeAttr('selected');
        $('#frmreviewind input[name="if_prof_other"]').val('');
    }

    $('#frmreviewind select[name="pre_occupation"]').on('change', function () {
        var value = $(this).val();
        if (value == 29) {
            $('#frmreviewind #occ_flag').show();
            $('#frmreviewind #if_prof_other').hide();
            $('#frmreviewind select[name="occ_flag"]').attr('required', '');
            $('#frmreviewind input[name="if_prof_other"]').removeAttr('required', '');
            $('#frmreviewind input[name="if_prof_other"]').val('');
        } else if (value == 20) {
            $('#frmreviewind #if_prof_other').show();
            $('#frmreviewind #occ_flag').hide();
            $('#frmreviewind input[name="if_prof_other"]').attr('required', '');
            $('#frmreviewind select[name="occ_flag"]').removeAttr('required', '');
            $('#frmreviewind select[name="occ_flag"] option:selected').removeAttr('selected');
        } else {
            $('#occ_flag').hide();
            $('#if_prof_other').hide();
            $('#frmreviewind select[name="occ_flag"]').removeAttr('required', '');
            $('#frmreviewind input[name="if_prof_other"]').removeAttr('required', '');
            $('#frmreviewind select[name="occ_flag"] option:selected').removeAttr('selected');
            $('#frmreviewind input[name="if_prof_other"]').val('');
        }
    });


    //$('#occ_flag').hide();
    //$('#if_prof_other').hide();
    $('ul.pre_occupation_ul li').on('click', function () {
        var value = $(this).attr('data-val');
        if (value == 29) {
            $('#occ_flag').addClass('divshow');
            $('#occ_flag').removeClass('divhide');
            $('#if_prof_other').addClass('divhide');
            $('#if_prof_other').removeClass('divshow');
            $('select[name="occ_flag"]').attr('required', '');
        } else if (value == 20) {
            $('#if_prof_other').addClass('divshow');
            $('#if_prof_other').removeClass('divhide');
            $('#occ_flag').addClass('divhide');
            $('#occ_flag').removeClass('divshow');
            $('select[name="if_prof_other"]').attr('required', '');
        } else {
            $('#occ_flag').addClass('divhide');
            $('#occ_flag').removeClass('divshow');
            $('#if_prof_other').addClass('divhide');
            $('#if_prof_other').removeClass('divshow');
            $('select[name="occ_flag"]').removeAttr('required');
        }
    });
    //tyform change id to class
    $('.prev_org_div').hide();
    $('input[name="prev_org"]').on('change', function () {
        var value = $(this).val();
        if (value == "Y") {
            $('.prev_org_div').show();
            $('input[name="previous_organization"]').attr('required', '');
            $('input[name="previous_designation"]').attr('required', '');
            $('input[name="previous_rank"]').attr('required', '');
            $('input[name="previous_posting"]').attr('required', '');
        } else {
            $('.prev_org_div').hide();
            $('input[name="previous_organization"]').removeAttr('required');
            $('input[name="previous_designation"]').removeAttr('required');
            $('input[name="previous_rank"]').removeAttr('required');
            $('input[name="previous_posting"]').removeAttr('required');
            $('input[name="previous_organization"]').val('');
            $('input[name="previous_designation"]').val('');
            $('input[name="previous_rank"]').val('');
            $('input[name="previous_posting"]').val('');
        }
    });

    /*if($('#frmreviewind input[name="prev_org"]').val()=="Y"){
        $('#frmreviewind .prev_org_div').show();
        $('#frmreviewind input[name="previous_organization"]').attr('required','');
        $('#frmreviewind input[name="previous_designation"]').attr('required','');
        $('#frmreviewindinput[name="previous_rank"]').attr('required','');
        $('#frmreviewind input[name="previous_posting"]').attr('required','');
      }else if($('#frmreviewind input[name="prev_org"]').val()=="N"){
        $('.prev_org_div').hide();
        $('input[name="previous_organization"]').removeAttr('required');
        $('input[name="previous_designation"]').removeAttr('required');
        $('input[name="previous_rank"]').removeAttr('required');
        $('input[name="previous_posting"]').removeAttr('required');

        $('input[name="previous_organization"]').val('');
        $('input[name="previous_designation"]').val('');
        $('input[name="previous_rank"]').val('');
        $('input[name="previous_posting"]').val('');
      }*/
    //tyform change id to class
    $('.pre_visit_div').hide();
    $('input[name="old_visa_flag"]').on('change', function () {
        var value = $(this).val();
        if (value == "Y") {
            $('.pre_visit_div').show();
            $('textarea[name="prv_visit_add1"]').attr('required', '');
            $('textarea[name="visited_city"]').attr('required', '');
            $('input[name="old_visa_no"]').attr('required', '');
            $('select[name="old_visa_type_id"]').attr('required', '');
            $('input[name="oldvisaissueplace"]').attr('required', '');
            $('input[name="oldvisaissuedate"]').attr('required', '');
        } else {
            $('.pre_visit_div').hide();
            $('textarea[name="prv_visit_add1"]').removeAttr('required');
            $('textarea[name="visited_city"]').removeAttr('required');
            $('input[name="old_visa_no"]').removeAttr('required');
            $('select[name="old_visa_type_id"]').removeAttr('required');
            $('input[name="oldvisaissueplace"]').removeAttr('required');
            $('input[name="oldvisaissuedate"]').removeAttr('required');

            $('textarea[name="prv_visit_add1"]').val('');
            $('textarea[name="visited_city"]').val('');
            $('input[name="old_visa_no"]').val('');
            $('select[name="old_visa_type_id option:selected"]').removeAttr('selected');
            $('input[name="oldvisaissueplace"]').val('');
            $('input[name="oldvisaissuedate"]').val('');
        }
    });

    $('#frmreviewind input[name="old_visa_flag"]').on('change', function () {
        var value = $(this).val();
        if (value == "Y") {
            $('.pre_visit_div').show();
            $('#frmreviewind input[name="prv_visit_add1"]').attr('required', '');
            $('#frmreviewind input[name="visited_city"]').attr('required', '');
            $('#frmreviewind input[name="old_visa_no"]').attr('required', '');
            $('#frmreviewind select[name="old_visa_type_id"]').attr('required', '');
            $('#frmreviewind input[name="oldvisaissueplace"]').attr('required', '');
            $('#frmreviewind input[name="oldvisaissuedate"]').attr('required', '');
        } else {
            $('.pre_visit_div').hide();
            $('#frmreviewind input[name="prv_visit_add1"]').removeAttr('required');
            $('#frmreviewind input[name="visited_city"]').removeAttr('required');
            $('#frmreviewind input[name="old_visa_no"]').removeAttr('required');
            $('#frmreviewind select[name="old_visa_type_id"]').removeAttr('required');
            $('#frmreviewind input[name="oldvisaissueplace"]').removeAttr('required');
            $('#frmreviewind input[name="oldvisaissuedate"]').removeAttr('required');

            $('#frmreviewind input[name="prv_visit_add1"]').val('');
            $('#frmreviewind input[name="visited_city"]').val('');
            $('#frmreviewind input[name="old_visa_no"]').val('');
            $('#frmreviewind select[name="old_visa_type_id"]').val('');
            $('#frmreviewind input[name="oldvisaissueplace"]').val('');
            $('#frmreviewind input[name="oldvisaissuedate"]').val('');
        }
    });

    /*if($('#frmreviewind input[name="old_visa_flag"]').val()=="Y"){
        $('#frmreviewind .pre_visit_div').show();
        $('#frmreviewind textarea[name="prv_visit_add1"]').attr('required','');
        $('#frmreviewind textarea[name="visited_city"]').attr('required','');
        $('#frmreviewind input[name="old_visa_no"]').attr('required','');
        $('#frmreviewind select[name="old_visa_type_id"]').attr('required','');
        $('#frmreviewind input[name="oldvisaissueplace"]').attr('required','');
        $('#frmreviewind input[name="oldvisaissuedate"]').attr('required','');
      }else if($('#frmreviewind input[name="old_visa_flag"]').val()=="N"){
        $('.pre_visit_div').hide();
        $('textarea[name="prv_visit_add1"]').removeAttr('required');
        $('textarea[name="visited_city"]').removeAttr('required');
        $('input[name="old_visa_no"]').removeAttr('required');
        $('select[name="old_visa_type_id"]').removeAttr('required');
        $('input[name="oldvisaissueplace"]').removeAttr('required');
        $('input[name="oldvisaissuedate"]').removeAttr('required');

        $('textarea[name="prv_visit_add1"]').val('');
        $('textarea[name="visited_city"]').val('');
        $('input[name="old_visa_no"]').val('');
        $('select[name="old_visa_type_id option:selected"]').removeAttr('selected');
        $('input[name="oldvisaissueplace"]').val('');
        $('input[name="oldvisaissuedate"]').val('');
      }*/

    $('#refuse_flag_div').hide();
    $('input[name="refuse_flag"]').on('change', function () {
        var value = $(this).val();
        if (value == "Y") {
            $('#refuse_flag_div').show();
            $('input[name="refuse_details"]').attr('required', '');
        } else {
            $('#refuse_flag_div').hide();
            $('input[name="refuse_details"]').removeAttr('required');
            $('input[name="refuse_details"]').val('');
        }
    });

    $('#saarc_form_div').hide();
    $('input[name="saarc_flag"]').on('change', function () {
        var value = $(this).val();
        if (value == "Y") {
            $('#saarc_form_div').show();
            $('#saarcCountry').removeAttr('disabled');
            $('#saarcYear').removeAttr('disabled');
            $('#saarcVisitNo').removeAttr('disabled');
            $('#saarcCountry').attr('required', '');
            $('#saarcYear').attr('required', '');
            $('#saarcVisitNo').attr('required', '');
        } else {
            $('#saarc_form_div').hide();
            // $('#div_minus').hide();
            $('#sel_country').attr('disabled', '');
            $('#sel_country').val('');
            $('#sel_year').attr('disabled', '');
            $('#sel_year').val('');
            $('#saarcVisitNo').attr('disabled', '');
            $('#saarcVisitNo').val('');
            $('#saarcCountry').removeAttr('required');
            $('#saarcCountry').attr('disabled', '');
            $('#saarcCountry').val('');
            $('#saarcYear').removeAttr('required');
            $('#saarcYear').attr('disabled', '');
            $('#saarcYear').val('');
            $('#saarcVisitNo').removeAttr('required');
            $('#saarcVisitNo').val('');
        }
    });

    // $('#frmreviewind #div_minus').hide();
    $('#frmreviewind input[name="saarc_flag"]').on('change', function () {
        var value = $(this).val();
        if (value == "Y") {
            $('#frmreviewind #saarc_form_div').show();
            $('#frmreviewind .fieldGroup select[name="saarcCountry[]"]').removeAttr('disabled');
            $('#frmreviewind .fieldGroup select[name="saarcYear[]"]').removeAttr('disabled');
            $('#frmreviewind .fieldGroup input[name="saarcVisitNo[]"]').removeAttr('disabled');
            $('#frmreviewind .fieldGroup select[name="saarcCountry[]"]').attr('required', '');
            $('#frmreviewind .fieldGroup select[name="saarcYear[]"]').attr('required', '');
            $('#frmreviewind .fieldGroup input[name="saarcVisitNo[]"]').attr('required', '');
        } else {
            $('#frmreviewind #saarc_form_div').hide();
            $('#frmreviewind #div_minus').hide();
            $('#frmreviewind #sel_country').attr('disabled', '');
            $('#frmreviewind #sel_year').attr('disabled', '');
            $('#frmreviewind .fieldGroup input[name="saarcVisitNo[]"]').attr('disabled', '');
            $('#frmreviewind .fieldGroup select[name="saarcCountry[]"]').removeAttr('required');
            $('#frmreviewind .fieldGroup select[name="saarcYear[]"]').removeAttr('required');
            $('#frmreviewind .fieldGroup input[name="saarcVisitNo[]"]').val('');
            $('#frmreviewind .fieldGroup select[name="saarcCountry[]"] option:selected').removeAttr('selected');
            $('#frmreviewind .fieldGroup select[name="saarcYear[]"] option:selected').removeAttr('selected');

        }
    });

    $('input[name="opt_number"]').on('keydown', function () {
        console.log("wel");
    });

    $('#citizen_to').on('change', function () {
        var text = $('#citizen_to option:selected').text();
        $('#citizen_to_text').val(text);
    });

    // Retrieve
    //var gettravel_to = localStorage.getItem("bookVisa");
    var citizen_to_india = {
        'UK': 'United Kingdom',
        'USA': 'United States of America'
    };
    var citizen_to_oth = {
        'IND': 'India'
    };

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

    $('#frmreviewind').find('input, select').attr('disabled', 'disabled');
    $('#frmreviewind').find('.input_hide').hide();
    $('#frmreviewind #btn_confirm').attr('disabled', 'disabled');
    $('#frmreviewind #btn_cancel').hide();
    $('#frmreviewind #btn_edit').click(function () {
        $(this).closest('#frmreviewind').find('input, select').not('.no_edit').removeAttr('disabled');
        $('#frmreviewind').find('.input_hide').show();
        $('#frmreviewind #btn_cancel').show();
        $('#frmreviewind #btn_edit').hide();
        $('#frmreviewind').find('.link_hide').hide();
        $('#btn_confirm').removeAttr('disabled');
        $('.saarc_add_button').show();
        $('.saarc_remove_exit').show();
    });
    $('#frmreviewind #btn_cancel').click(function () {
        $(this).closest('#frmreviewind').find('input, select').attr('disabled', 'disabled');
        $('#frmreviewind').find('.input_hide').hide();
        $('#frmreviewind #btn_cancel').hide();
        $('#frmreviewind #btn_edit').show();
        $('#frmreviewind').find('.link_hide').show();
        $('#btn_confirm').attr('disabled', 'disabled');
        $('.saarc_add_button').hide();
        $('.saarc_remove_exit').hide();
    });

    $("#frmreviewind").validate({
        ignore: [],
        rules: {
            given_name: {
                // required: true,
                alpha: true
            },
            surname: {
                required: true,
                alpha: true
            },
            previous_surname: {
                //required: false,
                alpha: true
            },
            previous_name: {
                //required: false,
                alpha: true
            },
            gender: {
                required: true
            },
            cob: {
                required: true
            },
            city_birth: {
                required: true,
                alpha: true
            },
            nation_id: {
                required: true,
            },
            aquired_nation: {
                required: true
            },
            religion: {
                required: true,
            },
            visible_marks: {
                required: true,
            },
            qualification: {
                required: true
            },
            nationality: {
                required: true
            },
            refer_flag: {
                required: true
            },
            Passport_number: {
                required: true,
                alphanumeric: true
            },
            issue_place: {
                required: true,
                alpha: true
            },
            oth_ppt: {
                required: true
            },
            other_ppt_no : {
                alphanumeric: true 
            },
            pres_add1: {
                required: true
            },
            pres_add2: {
                required: true
            },
            pres_country: {
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
                alpha: true,
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
            mstatus: {
                required: true
            },
            grandparent_flag1: {
                required: true
            },
            pre_occupation: {
                required: true
            },
            empname: {
                required: true,
                alpha: true
            },
            empaddress: {
                required: true
            },
            empphone: {
                numeric: true
            },
            service_req_form_values: {
                required: "Please enter places to be visited"
            },
            pres_country: {
                required: "Please Select Exit Airport"
            },
            other_ppt_issue_place: {
                alpha: true
            },
            previous_organization: {
                alpha: true
            },
            phoneofsponsor_ind: {
                numeric: true
            },
            phoneofsponsor_msn: {
                numeric: true
            }
        },
        messages : {
            given_name: {
                required: "Please enter your given name",
                alpha: "Please enter alphabet or spaces only"
            },
            surname: {
                alpha: "Please enter alphabet or spaces only"
            },
            previous_surname: {
                alpha: "Please enter alphabet or spaces only",
                required: "Please enter your previous surname",
            },
            name_changed: {
                required: "Please select an option"
            },
            previous_name: {
                alpha: "Please enter alphabet or spaces only",
                required: "Please enter your previous name",
            },
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
            religion_code_text: {
                required: "Please select your religion"
            },
            visible_marks: {
                required: "If no visible mark then put NA",
                alpha: "Please enter alphabet or spaces only"
            },
            qualification_text: {
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
                alpha: "Please Eneter Only Alphabet"
            },
            dob: {
                required: "Please select date of birth"
            },
            doi: {
                required: "Please select your passport issue date"
            },
            doe: {
                required: "Please select your passport expiry date"
            },
            other_ppt_no: {
                required: "Please enter passport/IC No.",
                alphanumeric: "Please enter alphabet or numbers only"
            },
            other_ppt_issue_place: {
                alpha: "Please enter only alphabet"
            },
            pincode:{
                required: "Please enter pincode",
                numeric: "Please enter only numbers"
            },
            pres_phone: {
                required: "Please enter phone number",
                numeric: "Please enter only number"
            },
            fthrname: {
                required: "Please enter father name",
                alpha: "Please enter only alphabet"
            },
            father_place_of_birth: {
                required: "Please enter father place of birth",
                alpha: "Please enter only alphabets"
            },
            mother_name: {
                required: "Please enter mother name",
                alpha: "Please enter only alphabets"
            },
            mother_place_of_birth: {
                required: "Please enter mother place of birth",
                alpha: "Please enter only alphabets"
            },
            empname: {
                required: "Please enter employer name",
                alpha: "Please enter only alphabets"
            },
            empphone: {
                required: "Please enter employer phone number",
                numeric: "Please enter only number"
            },
            previous_organization: {
                alpha: "Please enter only alphabets"
            },
            phoneofsponsor_ind: {
                numeric: "Please enter only number"
            },
            phoneofsponsor_msn: {
                numeric: "Please enter only number"
            }
        },
        highlight: function (element, errorClass, validClass) {
            // console.log("highlight");
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        submitHandler: function(form) {
            if($('input[name="previous_name"]').prop('required')){
                var validator = $( "#frmreviewind" ).validate();
                validator.showErrors({
                    "previous_name": "Please enter Previous Name"
                });
                return false;
            }else if($('input[name="previous_surname"]').prop('required')){
                var validator = $( "#frmreviewind" ).validate();
                validator.showErrors({
                    "previous_surname": "Please enter Previous Surname"
                });
                return false;
            }else if($('input[name="other_ppt_no"]').prop('required')){
                var validator = $( "#frmreviewind" ).validate();
                validator.showErrors({
                    "other_ppt_no": "Please enter your passport number"
                });
                return false;
            }else if($('input[name="other_ppt_issue_place"]').prop('required')){
                var validator = $( "#frmreviewind" ).validate();
                validator.showErrors({
                    "other_ppt_issue_place": "Please mention your place of issue"
                });
                return false;
            }else if($('select[name="other_ppt_nationality"]').prop('required')){
                var validator = $( "#frmreviewind" ).validate();
                validator.showErrors({
                    "other_ppt_nationality": "Please select Country"
                });
                return false;
            }else if($('input[name="other_ppt_issue_date"]').prop('required')) {
                var validator = $( "#frmreviewind" ).validate();
                validator.showErrors({
                    "other_ppt_issue_date": "Please select passport issue date"
                });
                return false;
            }else if($('select[name="prev_passport_country_issue"]').prop('required')) {
                var validator = $( "#frmreviewind" ).validate();
                validator.showErrors({
                    "prev_passport_country_issue": "Please select country"
                });
                return false;
            } else{
                form.submit();
            }
        },
        success: function (element) {
            // console.log("success");
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorElement: 'div',
        errorClass: 'error-block',
        errorPlacement: function (error, element) {
            // console.log("errorPlacement");
            error.insertAfter(element);
        }

    });

    if ($("#travel_to option:selected").attr('countrycode') == "IND") {
        $('#evisaForm').attr('action','india-visa-application/India');
    }

    $('#travel_to').on('change', function () {
        var value = $(this).val();
        var text = $('#travel_to option:selected').text();
        var country_code = $("#travel_to option:selected").attr('countrycode');
        $('#travel_to_text').val(text);
        $('input[name="country_code"]').val(country_code);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "ajaxgetcountrybyname",
            data: {
                country_code: country_code
            },
            beforeSend: function (xhr) {
                var select = $('#residing_in');
                select.empty();
            },
            success: function (response) {
                // console.log(response);return false;
                $("#residing_in").append('<option selected="true" value= "">Select Residing in</option>');
                $.each(JSON.parse(response), function (key, value) {
                    $("#selectBox option[value=" + value.country_code + "]").remove();
                    $("#residing_in").append('<option value=' + value.country_code + '>' + value.country_name + '</option>');
                });
            }
        });

        if (country_code == "IND") {
            $('#evisaForm').attr('action','india-visa-application/'+value);
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_india, function (key, value) {
                $('#citizen_to')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
        } else if (country_code == "HKG") {
            $('#evisaForm').attr('action','india-visa-application/'+value);
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function (key, value) {
                $('#citizen_to')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
        } else if (country_code == "MYS") {
            //$('#citizen_to').attr('disabled', '');
            //$('#lp_link').css('display', 'inline-block');
           // localStorage.setItem("lp_links", '/rca_website_l/public/malaysia');
           // $('#lp_link').attr('href', '/rca_website_l/public/malaysia');
            //$('#btn_step1').css('display', 'none');

            $('#evisaForm').attr('action','malaysia');
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function (key, value) {
                $('#citizen_to')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            //$("#c_select").hide();
            //$("#c_box").show();
        } else if (country_code == "KHM") {
            //$('#citizen_to').attr('disabled', '');
            //$('#lp_link').css('display', 'inline-block');
            //$('#lp_link').attr('href', '/rca_website_l/public/cambodia');
            //$('#btn_step1').css('display', 'none');
            $('#evisaForm').attr('action','cambodia');
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function (key, value) {
                $('#citizen_to')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            //$("#c_select").hide();
            //$("#c_box").show();
        } else if (country_code == "OMN") {
            //$('#citizen_to').attr('disabled', '');
            //$('#lp_link').css('display', 'inline-block');
            //$('#lp_link').attr('href', '/rca_website_l/public/oman');
            //$('#btn_step1').css('display', 'none');
            $('#evisaForm').attr('action','oman');
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function (key, value) {
                $('#citizen_to')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            //$("#c_select").hide();
            //$("#c_box").show();
        } else if (country_code == "TUR") {
            //$('#citizen_to').attr('disabled', '');
            //$('#lp_link').css('display', 'inline-block');
            //$('#lp_link').attr('href', '/rca_website_l/public/turkey');
            //$('#btn_step1').css('display', 'none');
            $('#evisaForm').attr('action','turkey');
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function (key, value) {
                $('#citizen_to')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            //$("#c_select").hide();
            //$("#c_box").show();
        } else if (country_code == "VNM") {
            //$('#citizen_to').attr('disabled', '');
            //$('#lp_link').css('display', 'inline-block');
            //$('#lp_link').attr('href', '/rca_website_l/public/vietnam');
            //$('#btn_step1').css('display', 'none');
            $('#evisaForm').attr('action','vietnam');
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function (key, value) {
                $('#citizen_to')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            //$("#c_select").hide();
            //$("#c_box").show();
        } else if (country_code == "LKA") {
            $('#evisaForm').attr('action','srilanka-visa-application/'+country_code);
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function (key, value) {
                $('#citizen_to')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });

        }else if (country_code == "ARE") {
            //$('#citizen_to').attr('disabled', '');
            //$('#lp_link').css('display', 'inline-block');
            //$('#lp_link').attr('href', '/rca_website_l/public/vietnam');
            //$('#btn_step1').css('display', 'none');
            $('#evisaForm').attr('action','uae');
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function (key, value) {
                $('#citizen_to')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            //$("#c_select").hide();
            //$("#c_box").show();
        }else if (country_code == "SGP") {
            $('#evisaForm').attr('action','singapore');
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function (key, value) {
                $('#citizen_to')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
        }
        else {
            $('#citizen_to').children('option:not(:first)').remove();
            $.each(citizen_to_oth, function (key, value) {
                $('#citizen_to')
                    .append($("<option></option>")
                        .attr("value", key)
                        .text(value));
            });
            $('#evisaForm').attr('action','search-country/'+country_code);
            $('#citizen_to').removeAttr('disabled');
            $('#lp_link').css('display', 'none');
            $('#btn_step1').css('display', 'inline-block');
            $("#c_select").show();
        }

    });


    

    $("#evisaForm").submit(function(e){
        
        var  travel_to                          = $("#travel_to").val();
        var  citizen_to                         = $("#citizen_to").val();
        var  residing_in                        = $("#residing_in").val();
        var malaysia_allowed_countries_arr      = ['IND','MYS'];
        var hongkong_allowed_countries_arr      = ['IND','HKG'];
        var cambodia_allowed_countries_arr      = ['IND','KHM'];
        var oman_allowed_countries_arr          = ['IND','OMN'];
        var turkey_allowed_countries_arr        = ['IND','TUR'];
        var vietnam_allowed_countries_arr       = ['IND','VNM'];
        var srilanka_allowed_countries_arr      = ['IND','LKA'];
        var uae_allowed_countries_arr           = ['IND','ARE'];
        var india_allowed_countries_arr         = ['IND'];
        var singapore_allowed_countries_arr     = ['IND','SGP'];
        var travel_to_allowed_countries_arr     = ['Malaysia','China- Sar Hongkong','Cambodia','Oman','Turkey','Vietnam','Sri Lanka','United Arab Emirates','India','Singapore'];
        var residing_in_allowed_countries_arr   = ['MYS','HKG','KHM','OMN','TUR','VNM','LKA','ARE','SGP'];

        var not_eligible_error                  = 'Travelling To and Residing In destinations should not be the same.';
        var sorry_message                       = 'Sorry! <br> We currently do not service for the combination that you have selected. <br> However, we are adding multiple countries and combinations to our website. Stay tuned for more information.';



        if( travel_to == "Malaysia" && citizen_to == "IND" &&  residing_in == "MYS" ){
            $("#errorMessageForEvisaSearch").html(not_eligible_error);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();
        }else if( travel_to == "Malaysia" && citizen_to == "IND" &&  residing_in == "IND" ){
            return;
        }else if( travel_to == "Malaysia" && citizen_to == "IND" &&  malaysia_allowed_countries_arr.indexOf(residing_in) === -1 ){
           
            $('#evisaForm').attr('action','sorry');
            return;
            /*$("#errorMessageForEvisaSearch").html(sorry_message);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();*/
        }else if( travel_to == "China- Sar Hongkong" && citizen_to == "IND" && residing_in == "HKG" ){
            $("#errorMessageForEvisaSearch").html(not_eligible_error);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();
        }else if( travel_to == "China- Sar Hongkong" && citizen_to == "IND" && residing_in == "IND" ){
            return;
        }else if( travel_to == "China- Sar Hongkong" && citizen_to == "IND" && hongkong_allowed_countries_arr.indexOf(residing_in) === -1 ){
            return;
        }else if( travel_to == "Cambodia" && citizen_to == "IND" &&  residing_in == "KHM" ){
            $("#errorMessageForEvisaSearch").html(not_eligible_error);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();
        }else if( travel_to == "Cambodia" && citizen_to == "IND" &&  residing_in == "IND" ){
            return;
        }else if( travel_to == "Cambodia" && citizen_to == "IND" && cambodia_allowed_countries_arr.indexOf(residing_in) === -1 ){
            return;
        }else if( travel_to == "Oman" && citizen_to == "IND" &&  residing_in == "OMN" ){
            $("#errorMessageForEvisaSearch").html(not_eligible_error);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();
        }else if( travel_to == "Oman" && citizen_to == "IND" &&  oman_allowed_countries_arr.indexOf(residing_in) === -1 ){
            return;
        }else if( travel_to == "Turkey" && citizen_to == "IND" &&  residing_in == "TUR" ){
            $("#errorMessageForEvisaSearch").html(not_eligible_error);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();
        }else if( travel_to == "Turkey" && citizen_to == "IND" &&  residing_in == "IND" ){
            return;
        }else if( travel_to == "Turkey" && citizen_to == "IND" &&  turkey_allowed_countries_arr.indexOf(residing_in) === -1 ){
            return;
        }else if( travel_to == "Vietnam" && citizen_to == "IND" &&  residing_in == "VNM" ){
            $("#errorMessageForEvisaSearch").html(not_eligible_error);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();
        }else if( travel_to == "Vietnam" && citizen_to == "IND" &&  residing_in == "IND" ){
           return;
        }else if( travel_to == "Vietnam" && citizen_to == "IND" &&  vietnam_allowed_countries_arr.indexOf(residing_in) === -1 ){
           return;
        }else if( travel_to == "Sri Lanka" && citizen_to == "IND" &&  residing_in == "LKA" ){
            $("#errorMessageForEvisaSearch").html(not_eligible_error);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();
        }else if( travel_to == "Sri Lanka" && citizen_to == "IND" &&  residing_in == "IND" ){
            return;
        }else if( travel_to == "Sri Lanka" && citizen_to == "IND" &&  srilanka_allowed_countries_arr.indexOf(residing_in) === -1 ){
            return;
        }else if( travel_to == "United Arab Emirates" && citizen_to == "IND" &&  residing_in == "ARE" ){
            $("#errorMessageForEvisaSearch").html(not_eligible_error);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();
        }else if( travel_to == "United Arab Emirates" && citizen_to == "IND" &&  residing_in == "IND" ){
            return;
        }else if( travel_to == "United Arab Emirates" && citizen_to == "IND" &&  uae_allowed_countries_arr.indexOf(residing_in) === -1 ){
            /*$("#errorMessageForEvisaSearch").html(sorry_message);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();*/
            $('#evisaForm').attr('action','sorry');
            return;
        }else if( travel_to == "India" && citizen_to == "UK" &&  residing_in == "IND" ){
            $("#errorMessageForEvisaSearch").html(not_eligible_error);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();
        }else if( travel_to == "India" && citizen_to == "UK" &&  india_allowed_countries_arr.indexOf(residing_in) === -1 ){
            return;
        }else if( travel_to == "India" && citizen_to == "USA" &&  residing_in == "IND" ){
            $("#errorMessageForEvisaSearch").html(not_eligible_error);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();
        }else if( travel_to == "India" && citizen_to == "USA" &&  india_allowed_countries_arr.indexOf(residing_in) === -1 ){
            return;
        }else if( travel_to_allowed_countries_arr.indexOf(travel_to) === -1  && citizen_to == "IND" &&  residing_in_allowed_countries_arr.indexOf(residing_in) === -1 ){
            /*$("#errorMessageForEvisaSearch").html(sorry_message);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();*/
            $('#evisaForm').attr('action','sorry');
            return;
        }else if( travel_to == "Singapore" && citizen_to == "IND" &&  residing_in == "SGP" ){
            $("#errorMessageForEvisaSearch").html(not_eligible_error);
            $('#errorModalForEvisaSearchEngine').modal('show');
            e.preventDefault();
        }
        else if( travel_to == "Singapore" && citizen_to == "IND" &&  residing_in == "IND" ){
            return;
        }else if( travel_to == "Singapore" && citizen_to == "IND" &&  singapore_allowed_countries_arr.indexOf(residing_in) === -1 ){
            $('#evisaForm').attr('action','sorry');
            return;
        }




    });


    //checkCookie();

    //Add Saarc Details
    //group add limit
    var maxGroup = 7;
    //add more fields group
    $("body").on('click', ".saarc_add_button", function () {
        console.log($('body').find('.fieldGroup').length);
        if ($('body').find('.fieldGroup').length < maxGroup) {
            var fieldHTML = '<div class="col-md-12 form-group fieldGroup">' + $('.fieldGroupcopy').html() + '</div>';
            $('body').find('.fieldGroup:last').after(fieldHTML);
            var inputs = $('.fieldGroup:last').find(".child-input-class");
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].disabled = false;
                inputs[i].required = "required";
            }
            //console.log(inputs.length);
        } else {
            alert('Maximum ' + maxGroup + ' groups are allowed.');
        }
    });

    //remove fields group
    $("body").on("click", ".saarc_remove_button", function () {
        $(this).parents(".fieldGroup").remove();
        var inputs = $(this).parents('.fieldGroup').find('.child_input');
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].disabled = true;
        }
        //console.log(inputs.length);
    });

    checkSession();
});

function calcprice() {
    // var adultprice = localStorage.getItem('adultprice');
    // var childprice = localStorage.getItem('childprice');
    var childprice = 0;
    var adultprice = 0;

    if ($('input[name="adultprice"').val() != "") {
        var adultprice = $('input[name="adultprice"').val();
    }

    if ($('input[name="childprice"').val() != "") {
        var childprice = $('input[name="childprice"').val();
    }

    console.log(adultprice + "/" + childprice);
    var total = parseInt(adultprice) + parseInt(childprice);

    $('#prodprice').html(total);
    $('#prod_price').val(total);
}

function uploadfile(fileinput, doctype, userid, applicatid) {
    var input = fileinput;
    var form_data = new FormData();
    form_data.append("file", input[0].files[0]);
    form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
    form_data.append('doc_type', doctype);
    form_data.append('user_id', userid);
    form_data.append('applicat_id', applicatid);
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

// function addgroupfield(){
//     //group add limit
//     var maxGroup = 7;
//     //add more fields group
//     $("body").on('click',".saarc_add_button",function(){
//         console.log($('body').find('.fieldGroup').length);
//         if($('body').find('.fieldGroup').length < maxGroup){
//             var fieldHTML = '<div class="form-group fieldGroup">'+$('.fieldGroupcopy').html()+'</div>';
//             $('body').find('.fieldGroup:last').after(fieldHTML);
//             var inputs = $('.fieldGroup:last').find(".child-input-class");
//             for(var i = 0; i < inputs.length; i++) {
//                     inputs[i].disabled = false;
//             }
//             //console.log(inputs.length);
//         } else{
//             alert('Maximum '+maxGroup+' groups are allowed.');
//         }
//     });

//     //remove fields group
//     $("body").on("click",".saarc_remove_button",function(){
//         $(this).parents(".fieldGroup").remove();
//         var inputs = $(this).parents('.fieldGroup').find('.child_input');
//         for(var i = 0; i < inputs.length; i++) {
//                     inputs[i].disabled = true;
//         }
//         //console.log(inputs.length);
//     });
// }

function add_div(val) {
    var value = parseInt($('#div_number').val(), 10);
    value = isNaN(value) ? 1 : value;
    value++;
    // console.log(value);return false;
    $('#div_number').val(value);
    $('#div_minus').show();
    $('#row_' + value).css('display', 'inline-block');
    $('#selcountry_' + value).removeAttr('disabled');
    $('#selcountry_' + value).attr('required', '');
    $('#selyear_' + value).removeAttr('disabled');
    $('#selyear_' + value).attr('required', '');
    $('#inputvisit_' + value).removeAttr('disabled');
    $('#inputvisit_' + value).attr('required', '');
}

function remove_div(val) {
    var value = parseInt($('#div_number').val(), 10);
    value = isNaN(value) ? 1 : value;
    // console.log(value);return false;
    value--;
    //$('#div_minus').hide();
    $('#div_number').val(value);
    $('#row_' + value).css('display', 'none');
    $('#selcountry_' + value).attr('disabled', '');
    $('#selcountry_' + value).removeAttr('required');
    $('#selyear_' + value).attr('disabled', '');
    $('#selyear_' + value).removeAttr('required');
    $('#inputvisit_' + value).attr('disabled', '');
    $('#inputvisit_' + value).removeAttr('required');
}

function removediv(val) {
    var value = val;
    $('.child_input_' + value).remove();
    var inputs = $(this).parents('.fieldGroup').find('.child_input_' + value);
    for (var i = 0; i < inputs.length; i++) {
        inputs[i].disabled = true;
    }
}

function stopCarret() {
    if (obj.value.length > 3) {
        setCaretPosition(obj, 3);
    }
}

function setCaretPosition(elem, caretPos) {
    if (elem != null) {
        if (elem.createTextRange) {
            var range = elem.createTextRange();
            range.move('character', caretPos);
            range.select();
        } else {
            if (elem.selectionStart) {
                elem.focus();
                elem.setSelectionRange(caretPos, caretPos);
            } else
                elem.focus();
        }
    }
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
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
    var partial_form = getCookie("partial_form");
    var uid = getCookie("uid");
    var order_id = getCookie("order_id");
    console.log(uid);
    //console.log(window.location.protocol + "//" + window.location.hostname + "/");
    if (partial_form != "") {
        if ((window.location.protocol + "//" + window.location.hostname + "/") + "rca_website_l/public/" !== (window.location.href)) {
            $(".__notification").hide();
        } else {
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

function checkSession() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/rca_website_l/public/checksession",
        type: "GET",
        dataType: "json",
        success: function (response) {
            //console.log(response);return false;
            if (response.status == "success") {
                if (response.value.partial_form != "") {
                    if ((window.location.protocol + "//" + window.location.hostname + "/") + "rca_website_l/public/" !== (window.location.href)) {
                        $(".__notification").hide();
                    } else {
                        $(".__notification").show();
                    }

                    $('#com_form').on('click', function () {
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
                            dataType: "json",
                            data: {
                                uid: uid,
                                order_id: order_id
                            },
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

    if (element.checked) {
        document.getElementById("btn_confirm").disabled = false;
    } else {
        document.getElementById("btn_confirm").disabled = true;
    }

}

function removeforntthumb() {
    $('#div_front_thumb').html("<div class='doc-head'>Colored frontpage of valid passport</div>");
}

function removephotothumb() {
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

function getDivPositions() {
    var positions = [];

    $("div.active").each(function () {
        positions.push({
            el: $(this),
            top: $(this).offset().top,
            bottom: $(this).offset().top + $(this).height()
        });
    });
    return positions;
}

function setActive() {
    var currentPosition, divPositions;

    currentPosition = window.pageYOffset;
    divPositions = getDivPositions();

    divPositions.forEach(function (d) {
        if (d.el.hasClass("active")) {
            d.el.removeClass("active").next().click();
        } else {
            d.el.addClass("active");
        }
    });
}