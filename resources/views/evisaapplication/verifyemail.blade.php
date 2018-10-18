@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <ul class="tabs_z">
                            <li class="__current">
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">E-VISA</span>
                                    <img src="{{ URL::to('/') }}/svg/E-visa.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="meet-and-assist.html">
                                    <span class="__title">MEET &amp; ASSIST</span>
                                    <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="lounge.html">
                                    <span class="__title">LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading">E-Visa</h1>
                                    <div class="__progress_wrapper">
                                        <ul class="__progress">
                                            <li class="active _100">Basic Info + Document Upload</li>
                                            <li class="active _100">Form Filling</li>
                                            <li class="active _50">Verification</li>
                                            <li class="">Payment</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="__form_notes">My visa request information</p>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="__filled_info">
                                            <div class="__title">Name</div>
                                            <div class="__val">{{$getapplicatdata['username']}}&nbsp;{{$getapplicatdata['surname']}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="__filled_info">
                                            <div class="__title">From Country</div>
                                            <div class="__val">{{$getapplicatdata['nationality']}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="__filled_info">
                                            <div class="__title">Applying for </div>
                                            <div class="__val">{{$getpostdata['visa_service']}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="__filled_info">
                                            <div class="__title">Application ID </div>
                                            <div class="__val">{{$getorderdetails['order_code']}}</div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h4>A One Time Password (OTP) will be emailed to you. </h4>
                                       
                                    </div>
                                    <form method="post" id="frmeditotp" name="frmeditotp" action="{{URL::to('/')}}/evisa/payment">
                                    <div class="col-md-4">
                                        <div class="__app_form">
                                            <div class="__app_input">
                                                <label>Email ID</label>
                                                <input type="text" class="otp_text" name="email_id" value="{{$getapplicatdata['email_id']}}" required="" readonly="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="__app_form">
                                            <div class="__app_input">
                                                <label>Phone Number</label>
                                                <input type="text" name="phone_number" required="" id="mobile" value="{{$getapplicatdata['mobile_number']}}" readonly="" class="otp_text" />
                                            </div>
                                        </div>
                                    </div>
                                    </form>
                                    <div class="col-md-4">
                                        <a href="javascript:void(0);" id="btn_edit_otp" name="btn_edit_otp" title="Edit" onclick="editotpinput();"><img src="{{URL::to('/')}}/svg/pencil-edit-button.svg" alt="" height="15" class="otp_edit"></a>
                                        <a href="javascript:void(0);" id="btn_close_otp" name="btn_close_otp" title="Close" style="display: none;" onclick="closeotpinput();"><img src="{{URL::to('/')}}/svg/close.svg" alt="" height="15" class="otp_edit"></a>
                                        <button type="button" id="btn_edit_submit" name="btn_edit_submit" class="__btn __btn_next" style="display: none;" onclick="submitdata();">Submit</button>
                                        <button type="button" id="btn_send_otp" name="btn_send_otp" class="__btn __btn_next">Send OTP</button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="__OTP_title" id="edit-message-box" style="display: none;"></div>
                                    </div>
                                    <form method="post" id="frmverify" name="frmverify" action="{{URL::to('/')}}/evisa/payment">
                                    <div class="col-md-12"><br />
                                            <input type="hidden" name="residing_code" id="residing_code" value="{{$getpostdata['residing_code']}}">
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                            <input type="hidden" name="ccode" id="ccode" value="{{$getpostdata['ccode']}}">
                                            <input type="hidden" name="order_id" id="order_id" value="{{$getpostdata['order_id']}}">
                                            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$getpostdata['applicant_id']}}">
                                            <input type="hidden" name="uid" id="uid" value="{{$getpostdata['uid']}}">
                                            <input type="hidden" name="order_code" id="order_code" value="{{$getorderdetails['order_code']}}">
                                            <input type="hidden" name="user_name" value="{{$getapplicatdata['username']}}&nbsp;{{$getapplicatdata['surname']}}">
                                            <input type="hidden" id="from_country" name="from_country" value="{{$getapplicatdata['nationality']}}">
                                            <input type="hidden" id="visa_service" name="visa_service" value="{{$getpostdata['visa_service']}}">
                                            <input type="hidden" id="applicant_number" name="applicant_number" value="{{$getorderdetails['order_code']}}">
                                            <input type="hidden" name="user_email" value="{{$getapplicatdata['email_id']}}" />
                                            <input type="hidden" name="user_phone" id="user_phone" value="{{$getapplicatdata['mobile_number']}}" />
                                        <div class="__OTP_box" style="width:100%;text-align:left;line-height: 28px; padding: 10px 0; ">A One Time Password (OTP) has been emailed to you. Enter the OTP to proceed paying securely.Please check you your spam message as well. <br />Add support@redcarpetassist.com to your address book to ensure that our mails reach your Inbox.
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
                                    <script src="{{URL::to('/')}}/js/windowunload.js" data-ordid="{{$getpostdata['order_id']}}" page-name="verifymail" userleaving="true"></script>
                                </div><!-- row end -->
                            </div><!-- Form wrapper -->
                        </div><!-- Tab Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
 <script type="text/javascript">
    function submitdata(){
        var inputIsValid = $('#frmeditotp').valid(); // returns true/false
        if(inputIsValid){
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "/rca_website_l/public/ajaxeditotpform",
                type: "POST",
                dataType:"json",
                data: {uid:$('#uid').val(),order_id:$('#order_id').val(),profile_id:$('#applicant_id').val(),email_id:$('input[name="email_id"').val(),mobile:$('#mobile').val()},
                success: function (response) {
                    // console.log(response);return false;
                  if(response.status=="success"){
                    $('#edit-message-box').css('display','block');
                    $('#edit-message-box').css('color','green');
                    $('#edit-message-box').html(response.msg);
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
        $('#btn_send_otp').show();
        $('input[name="email_id"]').attr('readonly', '');
        $('input[name="email_id"]').addClass('otp_text');
        $('input[name="phone_number"]').attr('readonly', '');
        $('input[name="phone_number"]').addClass('otp_text');
    }
 </script>
@include('layouts.middle_footer')     
@stop
