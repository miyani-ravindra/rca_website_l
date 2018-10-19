@extends('layouts.layout')

@section('content')
<div class="__bg">
    <?php //var_dump($amount);exit;?>
        <div class="container container-sm">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-md-12">
                    <div id="tab-1" class="tabs_z_content __current">
                            <div class="__round_wrapper">
                            <div class="__flight_details">
            @if($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>-->
                    <strong>Error!</strong> {{ $message }}
                </div>
            @endif
            {!! Session::forget('error') !!}
            @if($message = Session::get('success'))
                <div class="alert alert-info alert-dismissible fade in" role="alert">
                    <!--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>-->
                    <strong>Success!</strong> {{ $message }}
                </div>
            @endif
            {!! Session::forget('success') !!}
            
            <div class="_odr_dts">
                
                    @if($message == '')
                    <div class="__fl_num"><p>Hi {{$user_name}},</p></div>
                    <div class="_country_type"><p>We have verified your email id. Click 'Pay Now' to continue with your payment.</p></div>
                    @endif
                    <div class="panel-body text-center">
                    <form action="{{URL::to('/')}}/ccavenue-payment" method="POST" >
                        <input type="hidden" name="order_id" value="{{$order_id}}">
                        <input type="hidden" name="amount" value="{{$amount}}">
                        <input type="hidden" name="username" value="{{$user_name}}">
                        <input type="hidden" name="phone_number" value="{{$phone_number}}">
                        <input type="hidden" name="email_id" value="{{$email_id}}">
                        <input type="hidden" name="productinfo" value="{{$productinfo}}">
                        <input type="hidden" name="currency" value="INR">
                        <input type="hidden" name="order_code" value="{{$order_code}}">
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                        <input type="submit" name="btn_submit" class="__btn __active" value="Pay Now">
                    </form>
                </div>
                                                
            </div>               
            </div></div></div></div></div>
        </div>
    </div>
</div>
@include('layouts.middle_footer')     
@stop