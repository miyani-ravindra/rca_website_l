<!-- Javascript files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="{{ asset('js/main.js')}}"></script>
<script src="{{ asset('js/common.js')}}"></script>
<script src="{{ asset('js/mna_common.js')}}"></script>
<script src="{{ asset('js/mobileResScript.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.1/jquery.flexslider-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.5.3/js/bootstrapValidator.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.full.min.js"></script>
<script src="{{ asset('js/custom_methods.js')}}"></script>
<script src="{{ asset('js/ind_rev.js')}}"></script>
<!--Parag TypeForm JS-->
<script src="{{ asset('js/script.js')}}"></script>
<script src="{{ asset('js/evisa_for_srilanka.js')}}"></script>

<script src="{{ asset('js/dropdown.js')}}"></script>
<script src="{{ asset('js/transition.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>
<!--<script src="{{ asset('js/RCADynamicForm.js')}}" type="text/javascript"></script>-->
<!-- <script src="{{ asset('js/dist/jquery.validate.min.js')}}"></script> -->
<script src="{{ asset('js/dist/additional-methods.min.js')}}"></script>
<!-- HongKong Validation Start-->
<script src="{{asset('js/dist/autosave_form.js')}}"></script>
<script src="{{ asset('js/typeform_js/hk_validation.js') }}"></script>
<!-- HongKong Validation End-->
<script src="https://embed.typeform.com/embed.js" type="text/javascript"></script>
<script type="text/javascript">
    /*loadlink();
    function loadlink(){
        //$('#happy_customer').load('http://dev.redcarpetassist.com/customers.php',function () {
            $('#happy_customer').load("{{ url('application/counter') }}",function () {
        });
    }
    // This will run on page load
    setInterval(function(){
      loadlink() // this will run after every 5 seconds
    }, 10000);*/

$(document).ready(function() {
    var tabid = $('ul.tabs_z li').attr('data-tab');
    if(tabid == 'tab-1'){
       $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                 type:"POST",
                 url:"ajaxgetcountry",
                 success : function(response) {
                        $.each(JSON.parse(response),function(key, value)
                        {
                            $("#residing_in").append('<option value=' + value.country_code + '>' + value.country_name + '</option>');
                        });
                    }
        }); 
    }
    $('ul.tabs_z li').click(function() {
            var tab_id = $(this).attr('data-tab');
            $('ul.tabs_z li').removeClass('__current');
            $('.tabs_z_content').removeClass('__current');
            $(this).addClass('__current');
            $("#" + tab_id).addClass('__current');

            if(tab_id == 'tab-1'){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                 type:"POST",
                 url:"ajaxgetcountry",
                 success : function(response) {
                        $.each(JSON.parse(response),function(key, value)
                        {
                            $("#residing_in").append('<option value=' + value.country_code + '>' + value.country_name + '</option>');
                        });
                    }
                });
            }
    });

    // $('#residing_in').on('change', function(){
    //     var value = $(this).val();
    //     var travel_to = $('#travel_to option:selected').text(); //RCAV1-25
    //     $('#evisaForm').attr('action','india-visa-application/'+value);
        
    //     //RCAV1-25 - START
    //     if(travel_to === "Sri Lanka"){
    //         $('#evisaForm').attr('action','srilanka-visa-application/'+value);    
    //     }
    //     //RCAV1-25 - END
    // });

    $("#frmevisaform select[name=nationality] option[value='193']").remove();
    
    $(function() {
        $('.more_text').hide();
        $('a.more').click(function(event) {
            event.preventDefault(); 
            $('.hide_txt').toggle();
            $(this).parents('.__products_body').find('.more_text').toggle();
            $(this).text(($(this).text() == 'Less Details') ? 'More Details' : 'Less Details');
            $(this).parents('.__products_body').find('.__more_container').toggle();
            $(this).parents('.__products_container').find('.__products_img').toggle();
            $(this).parents('.__products_container').find('.__products_head').toggleClass('expanded');
        });
    });
    $(document).ready(function() {
        $(".tabs_master").each(function() {
            var $myTabs = $(this);
            $myTabs.find('ul.tabs_4_mna li').click(function() {
                var tab_id = $(this).attr('data-tab');
                $myTabs.find('ul.tabs_4_mna li').removeClass('__current');
                $myTabs.find('.tabs_4_mna_content').removeClass('__current');
                $(this).addClass('__current');
                $("#" + tab_id).addClass('__current');
                return false;
            });
        });
    });

    $(".select").select2();
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('ul.tabs li').click(function() {
            var tab_id = $(this).attr('data-tab');

            $('ul.tabs li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#" + tab_id).addClass('current');
        });
    });
    </script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b489b7f6d961556373db482/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

<!--Start of Tawk.to Script
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b489b7f6d961556373db482/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();

$('ul.tabs li').click(function() {
    var tab_id = $(this).attr('data-tab');

    $('ul.tabs li').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#" + tab_id).addClass('current');
});
</script-->
<!--End of Tawk.to Script-->
<script type="text/javascript">
$("#LP_LeadForm").validate({
        errorPlacement: function(error, element) {
            if (element.attr("name") == "first_name")
                error.insertAfter("#first_name");
            else if (element.attr("name") == "last_name")
                error.insertAfter("#last_name");
            else if (element.attr("name") == "phone_number")
                error.insertAfter("#phone");
            else if (element.attr("name") == "country_code")
                error.insertAfter("#phone");
            else if (element.attr("name") == "email")
                error.insertAfter("#email");
            else if (element.attr("name") == "service_type")
                error.insertAfter("#e_service");
            else if (element.attr("name") == "tnc")
                error.insertAfter("#e_terms");
            else
                error.insertAfter(element);
        },
        rules: {
            first_name: "required",
            last_name: "required",
            first_name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            },
            phone_number: {
                required: true,
                minlength: 10,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            service_type: {
                required: true,
            },
            country_code: {
              required: true,
              minlength: 3, 
              maxlength: 7,
              pattern: '^\\+[1-9]{1}[0-9]{1,5}$',
            },
            tnc: {
                required: true,
            },
        },
        messages: {
            first_name: "Enter First Name",
            last_name: "Enter Last Name",
            phone_number: "Enter Phone Number",
            email: "Enter a valid email address",
            service_type: "Select at least 1 Service",
            country_code: "Enter valid Country Code",
            tnc: "Please accept the terms and condition"
        },
        submitHandler: function() {
            //var thanks_h3_txt = $("#thanks h3").html();
            var name = $("#first_name").val();
            //var new_h3_txt = thanks_h3_txt + " " + name + "!";
            //$("#thanks h3").html(new_h3_txt);
            localStorage.setItem("name", name);

            var fd = $("#LP_LeadForm").serialize();
            console.log("Form data: " + fd);
            $.ajax({
            	url: '/rca_website_l/public/sendlead',
            	type: 'POST',
            	data: fd,
	            success: function(data) {
	                console.log('returned from ajax: ');
	                console.log(data);
	                ret_data = data;
                    if($('input[name="destination"]').val()=="Malaysia"){
                        ga('send', {
                          hitType: 'event',
                          eventCategory: 'website malaysia lead',
                          eventAction: 'submit',
                        });
                    }else if($('input[name="destination"]').val()=="Hong-Kong"){
                        ga('send', {
                          hitType: 'event',
                          eventCategory: 'website hongkong lead',
                          eventAction: 'submit',
                        });   
                    }else if($('input[name="destination"]').val()=="Cambodia"){
                        ga('send', {
                          hitType: 'event',
                          eventCategory: 'website cambodia lead',
                          eventAction: 'submit',
                        });
                    }else if($('input[name="destination"]').val()=="Oman"){
                        ga('send', {
                          hitType: 'event',
                          eventCategory: 'website oman lead',
                          eventAction: 'submit',
                        });
                    }else if($('input[name="destination"]').val()=="Sri Lanka"){
                        ga('send', {
                          hitType: 'event',
                          eventCategory: 'website srilanka lead',
                          eventAction: 'submit',
                        });
                    }else if($('input[name="destination"]').val()=="Turkey"){
                        ga('send', {
                          hitType: 'event',
                          eventCategory: 'website turkey lead',
                          eventAction: 'submit',
                        });
                    }else if($('input[name="destination"]').val()=="Vietnam"){
                        ga('send', {
                          hitType: 'event',
                          eventCategory: 'website vietnam lead',
                          eventAction: 'submit',
                        });
                    }
                    //window.location = "/thank-you";

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'POST',
                        data: fd,
                        url:"/rca_website_l/public/ajaxenquirymailer",
                        success : function(response) {
                            console.log(response);    
                        }
                    });

                    setTimeout(function() {
                        $('.__alert_success').show();
                        $('#thanks').fadeIn('slow');
                        $('form[name="LP_LeadForm"]')[0].reset();
                    }, 1500);
	            },
	            error: function(xhr, response, status) {
	                console.log(response.responsetext);
                    //alert(xhr.responseText);
	            }
        	});
        	//window.location = "thank-you.html";
        	

        	//$('#conviframe').attr('src','convert.html');
        }
    });
    $(window).scroll(function() {
        var sticky = $('.__seo_header'),
            scroll = $(window).scrollTop();
        if (scroll >= 120) sticky.addClass('fixed');
        else sticky.removeClass('fixed');
    });
</script>
<script type="text/javascript">
    $('#book_visa').on('click', function(){
        var value = $(this).attr("data-val");
        if(typeof value !== 'undefined' || value !== "")
            localStorage.setItem("bookVisa", value);
    });
</script>
</body>

</html>
