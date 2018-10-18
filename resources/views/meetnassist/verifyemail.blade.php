@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <ul class="tabs_z">
                            <li class="">
                                <a href="{{URL::to('/')}}">
                                <span class="__title">E-VISA</span>
                                <img src="{{ URL::to('/') }}/svg/E-visa.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li class="__current" data-tab="tab-2" id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="javascript:void(0);">
                                    <span class="__title">MEET &amp; ASSIST</span>
                                    <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-2" class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading">Meet & Greet</h1>
                                    <!-- <div class="__progress_wrapper">
                                        <ul class="__progress">
                                            <li class="active _100">Basic Info + Document Upload</li>
                                            <li class="active _100">Form Filling</li>
                                            <li class="active _50">Verification</li>
                                            <li class="">Payment</li>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--p class="__form_notes">My visa request information</p-->
                                    </div>
                                    <div class="col-md-3">
                                        <div class="__filled_info">
                                            <div class="__title">Name</div>
                                            <div class="__val">{{$username}}
                                                <input type="hidden" name="user_name" value="{{$username}}">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="__filled_info">
                                            <div class="__title">Applying for </div>
                                            <div class="__val">Meet & Greet Service
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <!--h4>A One Time Password (OTP) will be emailed to you. </h4-->
                                       
                                    </div>
                                    <form method="post" id="frmeditotp" name="frmeditotp" action="{{URL::to('/')}}/evisa/payment">
                                    <div class="col-md-4">
                                        <div class="__app_form">
                                            <div class="__app_input">
                                                <label>Email ID</label>
                                                <input type="text" class="otp_text" name="email_id" value="{{$email}}" required="" readonly="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="__app_form">
                                            <div class="__app_input">
                                                <label>Phone Number</label>
                                                <input type="text" name="phone_number" required="" id="mobile" value="{{$phone}}" readonly="" class="otp_text" />
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    <div class="col-md-4">
                                        <a href="javascript:void(0);" id="btn_edit_otp" name="btn_edit_otp" title="Edit" onclick="editotpinput();"><img src="{{URL::to('/')}}/svg/pencil-edit-button.svg" alt="" height="15" class="otp_edit"></a>
                                        <a href="javascript:void(0);" id="btn_close_otp" name="btn_close_otp" title="Close" style="display: none;" onclick="closeotpinput();"><img src="{{URL::to('/')}}/svg/close.svg" alt="" height="15" class="otp_edit"></a>
                                        <button type="button" id="btn_edit_submit" name="btn_edit_submit" class="__btn __btn_next" style="display: none;" onclick="submitdata();">Submit</button>
                                        <button type="button" id="btn_send_otp" name="btn_send_otp" class="__btn __btn_next" style="display:none;" >Send OTP</button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="__OTP_title" id="edit-message-box" style="display: none;"></div>
                                    </div>
                                    <form method="post" id="frmverify" name="frmvisa1" action="{{URL::to('/')}}/Razorpay/index">
                                    <div class="col-md-12"><br />
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <input type="hidden" name="order_id" id="order_id" value="{{$ordid}}">
                                        <input type="hidden" name="order_code" id="order_code" value="{{$txnid}}">
                                        <input type="hidden" name="currency" id="currency" value="{{$currency}}">
                                        <input type="hidden" name="amount" id="amount" value="{{$amt}}">
                                        <input type="hidden" name="productinfo" id="product_info" value="{{$product_info}}">
                                        <input type="hidden" name="uid" id="uid" value="{{$uid}}">
                                        <div class="__OTP_box" style="width:100%;text-align:left;line-height: 28px; padding: 10px 0; "><p>Enter the OTP to proceed paying securely.</p><p>Please check you your spam message as well. Add support@redcarpetassist.com to your address book to ensure that our mails reach your Inbox.</p>
                                            <div class="__OTP_title" id="message-box">
</div>
                                            <div class="__OTP_input_box">
                                                <div class="__OTP_input">
                                                    <div class="divInner">
                                                        <input type="text" name="opt_number" id="" maxlength="4" autocomplete="off" required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="__resend">Not Recieved? <a href="javascript:void(0)" id="btn_resend">Resend OTP</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center paddingtb_10">
                                        <button type="submit" id="btn_confirm" class="__btn __btn_next" >CONFIRM &amp; PROCEED</button>
                                    </div>
                                    </form>
                                </div><!-- row end -->
                            </div><!-- Form wrapper -->
                        </div><!-- Tab Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="__thanks" id="thanks" style="display: none">
            <div class="__thanks_body">
                <div class="_close_thnks"><a href="javascript:void(0);" onclick="$('#thanks').fadeOut('slow');"><img src="{{URL::to('/')}}/svg/close-icon.svg" width="22px" height="22px" /></a></div>
                <!-- <img src="svg/thanks_icon.svg" width="90px" class="center-block" alt="" /> -->
                <p id="mail_msg"></p>
            </div>
    </div>
    <div class="loading" id="overlay_load" style="display: none;">Loading&#8230;</div>
 <script type="text/javascript">
    function submitdata(){
        var inputIsValid = $('#frmeditotp').valid(); // returns true/false
        $('#overlay_load').show();
        if(inputIsValid){
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/ajaxeditotpform",
                type: "POST",
                dataType:"json",
                data: {uid:$('#uid').val(),order_id:$('#order_id').val(),email_id:$('input[name="email_id"').val(),mobile:$('#mobile').val()},
                success: function (response) {
                    // console.log(response);return false;
                  if(response.status=="success"){
                    $('#edit-message-box').css('display','block');
                    $('#edit-message-box').css('color','green');
                    $('#edit-message-box').html(response.msg);
                    $('#overlay_load').hide();
                    setInterval(function(){
                        $("#edit-message-box").fadeOut(1000);
                    }, 5000);
                    $('input[name="email_id"]').val(response.data.email_id);
                    $('input[name="phone_number"]').val(response.data.phone_number);
                    $('#btn_send_otp').removeAttr('disabled');
                    $('#btn_edit_otp').show();
                    $('#btn_close_otp').hide();
                    $('#btn_edit_submit').hide();
                    $('#btn_send_otp').show();
                  }
                }
          });
        }
    }

    function editotpinput (){
        $('#btn_send_otp').attr('disabled','');
        $('#btn_close_otp').show();
        $('#btn_edit_otp').hide();
        $('#btn_edit_submit').show();
        $('#btn_send_otp').hide();
        $('input[name="email_id"]').removeAttr('readonly');
        $('input[name="email_id"]').removeClass('otp_text');
        $('input[name="phone_number"]').removeAttr('readonly');
        $('input[name="phone_number"]').removeClass('otp_text');
        $('#edit-message-box').css('display','none');
        $('#edit-message-box').html('');
    }

    function closeotpinput (){
        $('#btn_send_otp').removeAttr('disabled');
        $('#btn_edit_otp').show();
        $('#btn_close_otp').hide();
        $('#btn_edit_submit').hide();
        $('#btn_send_otp').hide();
        $('input[name="email_id"]').attr('readonly', '');
        $('input[name="email_id"]').addClass('otp_text');
        $('input[name="phone_number"]').attr('readonly', '');
        $('input[name="phone_number"]').addClass('otp_text');
    }
 </script>
@include('layouts.middle_footer')     
@stop