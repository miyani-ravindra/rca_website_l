@extends('layouts.layout')
@section('product_bg')
<div class="__OTP_bg">
        <!-- banner content -->
        <div class="container container-sm __bg_txt">
            <div class="row">
                <div class="col-md-8">
                    <h1 class="__bg_heading">Thank you <br> Please verify your account</h1>
                    <p>We have sent <strong>OTP</strong> on your eMail ID, please submit it to proceed</p>
                </div>
                <div class="col-md-4">
                    <div class="_dubai_shape"><img src="{{ URL::to('/') }}/svg/dubai-shape.svg" alt="" class="img-responsive" /></div>
                </div>
            </div>
        </div>
    </div>
<!-- Top bg End -->
@stop

@section('content')
<div class="container container-sm">
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
                <div class="__card" style="margin-top: -130px;">
                    <div class="__card_body">
                        <div class="__OTP_box">
                            <h2 class="__OTP_email">Kumarsing@gmail.com</h2>
                            <div class="__OTP_input_box">
                                <div class="__OTP_input">
                                    <input type="text" name="" id="" maxlength="1" autofocus="">
                                </div>
                                <div class="__OTP_input">
                                    <input type="text" name="" id="" maxlength="1">
                                </div>
                                <div class="__OTP_input">
                                    <input type="text" name="" id="" maxlength="1">
                                </div>
                                <div class="__OTP_input">
                                    <input type="text" name="" id="" maxlength="1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="__btn __btn_submit __active">VERIFY</button>
                                </div>
                                <div class="col-md-6">
                                    <p class="__resend">Not Recieved? <a href="#">Resend OTP</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Aside section -->
            <aside class="col-md-offset-2 col-md-4 paddingtb_30">
                <div class="__order_details">
                    <h6>Order ID: <span class="hightlight">ABC12345667</span></h6>
                    <div class="__order_list"><span class="bold">30 Days dubai Visa</span> 58 Days validity</div>
                    <div class="__pax">
                        <h4>2 Adults 1 child</h4>
                        <span class="__pax_date"><img src="{{ URL::to('/') }}/svg/calendar.svg" alt="" width="12" /> &nbsp;6th Feb 2018  </span>
                    </div>
                    <div class="__total">Total charges <span>&#8377; 3,536</span></div>
                </div>
            </aside>
            <!-- Aside End -->
            <hr class="fw" />
        </div>
    </div>
</div>
@stop