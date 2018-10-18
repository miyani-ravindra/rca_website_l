@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <form method="post" id="frmvisa1" name="frmvisa1" action="{{URL::to('/')}}/Razorpay/index">
                            <input type="hidden" name="residing_code" id="residing_code" value="{{$getpostdata['residing_code']}}">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="order_id" id="order_id" value="{{$getpostdata['order_id']}}">
                            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$getpostdata['applicant_id']}}">
                            <input type="hidden" name="uid" id="uid" value="{{$getpostdata['uid']}}">
                            <input type="hidden" name="email_id" id="email_id" value="{{$getpostdata['email_id']}}">
                            <input type="hidden" name="phone_number" id="phone_number" value="{{$getpostdata['phone_number']}}">
                            <input type="hidden" name="ccode" id="ccode" value="{{$getpostdata['ccode']}}">
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
                                    <ul class="__progress">
                                        <li class="active _100">Basic Info + Document Upload</li>
                                        <li class="active _100">Form Filling</li>
                                        <li class="active _100">Verification</li>
                                        <li class="active">Payment</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="__form_notes">My visa request information</p>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="col-md-6">
                                            <div class="__filled_info">
                                                <div class="__title">Name</div>
                                                <div class="__val">{{$getpostdata['user_name']}}</div>
                                                <input type="hidden" name="user_name" value="{{$getpostdata['user_name']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="__filled_info">
                                                <div class="__title">From Country</div>
                                                <div class="__val">{{$getpostdata['nationality']}}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="__filled_info">
                                                <div class="__title">Applying for </div>
                                                <div class="__val">{{$getpostdata['visa_service']}}</div>
                                                <input type="hidden" name="productinfo" value="{{$getpostdata['visa_service']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="__filled_info">
                                                <div class="__title">Application ID </div>
                                                <div class="__val">{{$getpostdata['applicant_number']}}</div>
                                                <input type="hidden" name="order_code" value="{{$getpostdata['applicant_number']}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 _bdr_left">
                                        <p class="__ur_pay">You Pay <span>{{!empty($amt_arr['currency'])?$amt_arr['currency']:NULL}} {{!empty($amt_arr['amount'])?round($amt_arr['amount']):0}}</span></p>
                                        <button type="submit" class="__btn __active">GO TO PAYMENT</button>
                                        <input type="hidden" name="amount" id="amount" value="{{!empty($amt_arr['amount'])?round($amt_arr['amount']):0}}">
                                    </div>
                                </div><!-- row end -->
                            </div><!-- Form wrapper -->
                        </div><!-- Tab Content End -->
                        </form>
                        <script src="{{URL::to('/')}}/js/windowunload.js" data-ordid="{{$getpostdata['order_id']}}" page-name="evisa-payment" userleaving="true"></script>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.middle_footer')     
@stop