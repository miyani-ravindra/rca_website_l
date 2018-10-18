@extends('layouts.layout')
@section('product_bg')
<div class="__account_bg">
    <!-- banner content -->
    <div class="container container-sm __bg_txt">
        <div class="row">
            <div class="col-md-12">
                <div class="__acct_body">
                    <div class="__acct_prof">
                        <img src="{{ URL::to('/') }}/svg/user-profile.svg" alt="" width="100" />
                    </div>
                    <div class="__acct_txt">
                        <div class="row">
                            <div class="col-md-12">
                                <p>My Account <i class="fa fa-cog"></i></p>
                                <p class="lg">{{!empty($getuser->username)?$getuser->username:NULL}}</p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fa fa-envelope"></i> {{!empty($getuser->email_id)?$getuser->email_id:NULL}}</p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fa fa-phone"></i> +91 {{!empty($getuser->mobile_no)?$getuser->mobile_no:NULL}}</p>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-6">
                                <p><i class="fa fa-flag"></i> {{$getuser->nationality}} National</p>
                            </div>
                            <div class="col-md-6">
                                <p><i class="fa fa-plane"></i> {{!empty($no_of_booking)?$no_of_booking:0}} Bookings done</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top bg End -->
@stop

@section('content')
<div class="container container-sm">
    <div class="row">
        <div class="col-md-8 paddingtb_20">
            @if(count($getliveorder)==0 && count($getpreviousorder)==0)
            <div class="_no_orders">
                        <img src="{{URL::to('/')}}/images/no-orders.png" alt="" width="220">
                        <h4>Your Order List is Empty</h4>
            </div>
            @endif
            @if(count($getliveorder)>0)
            <div class="__my_orders">
                <h4 class="heading">Live Orders</h4>
                @foreach($getliveorder as $key=>$value)
                <div class="__myorder_list">
                    <div class="_odr_dts">
                        <div class="_visa_type">{{$value->product_name}}</div>
                        <div class="_visa_date"><i class="fa fa-calendar"></i> {{date('d M Y', strtotime($value->created_at))}}</div>
                    </div>
                    <div class="_odr_airline">
                        <img src="{{ URL::to('/') }}/svg/airliner-right.svg" alt="" width="22" class="airplane">
                    </div>
                    <div class="_odr_id">
                        <span>Current Order</span>
                        <span class="_odr_no"><a href="javascript:void(0);" data-uid="{{$getuser->user_id}}" data-oid="{{$value->order_id}}" class="current btn_order">{{ucfirst(trans($value->order_code))}}</a></span>
                        <span>Order ID</span>
                    </div>
                </div>                    
                @endforeach
            </div>
            @endif
            @if(count($getpreviousorder)>0)
            <div class="__my_orders">
                <h4 class="heading">Completed Orders</h4>
                @foreach($getpreviousorder as $key=>$value)
                <div class="__myorder_list">
                    <div class="_odr_dts">
                        <div class="_visa_type">{{$value->product_name}}</div>
                        <div class="_visa_date"><i class="fa fa-calendar"></i> {{date('d M Y', strtotime($value->created_at))}}</div>
                    </div>
                    <div class="_odr_airline">
                        <img src="{{ URL::to('/') }}/svg/airliner-right.svg" alt="" width="22" class="airplane">
                    </div>
                    <div class="_odr_id">
                        <span>Current Order</span>
                        <span class="_odr_no"><a href="javascript:void(0);" data-uid="{{$getuser->user_id}}" data-oid="{{$value->order_id}}" class="current btn_order">{{ucfirst(trans($value->order_code))}}</a></span>
                        <span>Order ID</span>
                    </div>
                </div>                    
                @endforeach
            </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="__selected_visa">
                <p>ACTION REQUIRED</p>
                <div class="__hero_box">
                    <div class="__selected_visa_box">
                        <h2 id="prod_name">{{!empty($getcurrentorder->product_name)?$getcurrentorder->product_name:NULL}}</h2>
                        <div class="__visa_dts">
                            <img src="{{ URL::to('/') }}/svg/family.svg" alt="" width="18" /> <span id="no_adult">{{!empty($getcurrentorder->adult)?$getcurrentorder->adult:0}}</span> Adults <span id="no_child">{{!empty($getcurrentorder->child)?$getcurrentorder->child:0}}</span> Child
                        </div>
                        <div class="__visa_dts">
                            <img src="{{ URL::to('/') }}/svg/calendar.svg" alt="" width="15" /> <span id="ord_date">{{!empty($getcurrentorder->created_at)?date('d M Y', strtotime($getcurrentorder->created_at)):NULL}}</span>
                        </div>
                    </div>
                    <div class="__app_status">
                            <p class="__status">
                                <span>Status :</span> Application Not Submitted!!
                            </p>
                            @if(count($getappstatus)>0)
                            @foreach($getappstatus as $key=>$val)
                            <div class="__pax_status" id="app_status">
                                <h5>{{$val->username}}</h5>
                                <div class="__pax_docs">Document Submission  <span class="__status_badge _incompelete">{{!empty($val->doc_type)?'Complete':'Incomplete'}}</span></div>
                                <div class="__pax_docs">Application Form <span class="__status_badge">{{($val->is_submitted=='Y')?'Completed':'Incomplete'}}</span></div>
                            </div>
                            @endforeach
                            @else
                                <div class="__pax_status" id="app_status">
                                    <h5>Record Not Found</h5>
                                </div>
                            @endif
                    </div>
                </div>                
            </div>
        </div>

        <div class="col-md-12">
            <hr class="fw" />
        </div>

        <form method="post" action="{{URL::to('/')}}/orders/documents" id="frmdocument">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="uid" id="uid" value="">
            <input type="hidden" name="oid" id="oid" value=""> 
        </form>
    </div>
</div>
@stop
