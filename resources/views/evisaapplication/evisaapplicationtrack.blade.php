@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <form method="post" id="frmtrackapp" name="frmtrackapp" action="">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
                                    <h1 class="__main_heading">Complete Partially Filled Form</h1>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="__app_form">
                                            <!-- <div class="__app_input">
                                                <label>Application ID</label>
                                                <input type="text" name="order_code" value="" required="" />
                                            </div> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="__app_form">
                                            <div class="__app_input">
                                                <label>Email ID</label>
                                                <input type="text" name="email_id" value="" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button type="button" id="btn_track_otp" name="btn_track_otp" class="__btn __btn_next">Send OTP</button>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="__OTP_box">
                                            <div class="__OTP_title" id="message-box">ENTER OTP YOU RECIEVED</div>
                                            <div class="__OTP_input_box">
                                                <div class="__OTP_input">
                                                    <div class="divInner">
                                                    <input type="text" name="opt_number" id="" maxlength="1" autofocus="" autocomplete="off" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p class="__resend">Not Recieved? <a href="javascript:void(0)" id="btn_resend_track">Resend OTP</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center paddingtb_10">
                                        <button type="submit" id="btn_track_confirm" name="btn_track_confirm" class="__btn __btn_next" disabled>CONFIRM &amp; PROCEED</button>
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
@include('layouts.middle_footer')     
@stop