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
                    <?php
                        //$amount;
                    ?>
                    <div class="panel-body text-center">
                    <form action="payment" method="POST" >
                        
                        <!-- Note that the amount is in paise = 50 INR -->
                        <!--amount need to be in paisa-->
                        <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{ Config::get('custom.razor_key') }}"
                                data-amount="{{$amount}}"
                                data-buttontext="Pay Now"
                                data-name="RedCarpet Assist"
                                data-description="Order Value"
                                data-image="{{ URL::to('/') }}/images/logo.svg"
                                data-prefill.name="{{$user_name}}"
                                data-prefill.email="{{$email_id}}"
                                data-notes.order_id = "{{$order_id}}"
                                data-notes.order_code = "{{$order_code}}"
                                data-notes.ccode =  "{{$ccode}}" 
                                data-notes.username = "{{$user_name}}"
                                data-notes.productinfo = "{{$productinfo}}"
                                data-prefill.contact = "{{$phone_number}}"
                                data-theme.color="#ff7529">
                        </script>
                        <input type="hidden" name="_token" value="{!!csrf_token()!!}">
                    </form>
                </div>
                                                
            </div>
            
            <script>
                $(document).ready(function(){
                    
                        $("input[type=submit]").addClass("__btn __active");
                    
                });
            </script>
               
            </div></div></div></div></div>
        </div>
    </div>
</div>
@include('layouts.middle_footer')     
@stop