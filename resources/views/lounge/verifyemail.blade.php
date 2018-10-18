@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <!--<form method="post" id="frmvisa1" name="frmvisa1" action="{{URL::to('/')}}/Lounge/ccavenue">-->
                            <form method="post" id="frmverify" name="frmvisa1" action="{{URL::to('/')}}/Razorpay/index">
                           
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="order_id" id="order_id" value="{{$ordid}}">
                            <input type="hidden" name="order_code" id="order_code" value="{{$txnid}}">
                            <input type="hidden" name="currency" id="currency" value="{{$currency}}">
                            <input type="hidden" name="amount" id="amount" value="{{$amt}}">
                            <input type="hidden" name="productinfo" id="product_info" value="{{$product_info}}">
                            <input type="hidden" name="uid" id="uid" value="{{$uid}}">
                        <ul class="tabs_z">
                            <li>
                                <a href="{{ URL::to('/') }}">
                                <span class="__title">eVISA</span>
                                <img src="{{ URL::to('/') }}/svg/E-visa.svg" alt="" width="100" />
                            </a>
                            </li>
                            <li class="" id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="{{ URL::to('/') }}">
                                    <span class="__title">AIRPORT MEET &amp; GREET</span>
                                    <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li class="__current" id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{ URL::to('/') }}">
                                    <span class="__title">AIRPORT LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading">AIRPORT LOUNGE</h1>
                                    
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="__form_notes"></p>
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
                                            <div class="__val">AIRPORT LOUNGE
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <h4></h4>
                                        <p class="md" style="color:red">A One Time Password (OTP) will be emailed to you. </p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="__app_form">
                                            <div class="__app_input">
                                                <label>Email ID</label>
                                                <input type="text" name="email_id" value="{{$email}}" readonly="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="__app_form">
                                            <div class="__app_input">
                                                <label>Phone Number</label>
                                                <input type="text" name="phone_number" value="{{$phone}}" readonly="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" id="btn_send_otp1" name="btn_send_otp" class="__btn __btn_next">Send OTP</button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="__OTP_box" style="width:100%;text-align:left;position:relative;line-height: 28px; padding: 20px 0; color:darkslategrey">
                                            A One Time Password (OTP) has been emailed to you. 
Enter the OTP to proceed paying securely.
Please check you your spam message as well. Add support@redcarpetassist.com to your address book to ensure that our mails reach your Inbox.
                                            <div class="__OTP_title" id="message-box" >
</div>
                                            <div class="__OTP_input_box">
                                                <div class="__OTP_input">
                                                    <div class="divInner">
                                                        <input type="text" name="opt_number" id="" maxlength="4" autocomplete="off">
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

                                    <!-- <div class="col-md-12">
                                        <input type="checkbox" name="terms" id="terms" value="Y" required="">  I agree to the <a href='{{URL::to("/")}}/terms-and-conditions' target='_blank'>Terms & Conditions</a> and <a href='{{URL::to("/")}}/privacy-policy' target='_blank'>Privacy Policy</a>
                                    </div> -->

                                    <div class="col-md-12 text-center paddingtb_10">
                                        <button type="submit" id="btn_confirm" class="__btn __btn_next" disabled>CONFIRM &amp; PROCEED</button>
                                    </div>
                                </div><!-- row end -->
                            </div><!-- Form wrapper -->
                        </div><!-- Tab Content End -->
                        </form>
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
@include('layouts.middle_footer')     
@stop