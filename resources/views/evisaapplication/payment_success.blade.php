@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__receipt_bg">
        <div class="container container-sm __bg_txt">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="__heading_h4 paddingtb_50 lg">Thanks {{!empty($response['firstname'])?$response['firstname']:NULL}}!</h1>
                    <p class="__receipt_subhead">We at Redcarpet Assist are delighted to be a part of your travel plans. Thank you for your payment. Please find your payment receipt.</p>
                </div>
            </div>
        </div>
    </div>
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                <div class="__receipt_wrapper">
                    <div class="__receipt_header">
                        <div class="col-md-6">
                            <img src="images/logo.png" alt="" width="90" />
                        </div>
                        <div class="col-md-6">
                            <h5>{{$response['order_date']}}</h5>
                        </div>
                    </div>
                    <div class="__receipt_header __receipt_body">
                        <div class="col-md-6">
                            <h5 class="lg">{{!empty($response['productinfo'])?$response['productinfo']:NULL}}</h5>
                        </div>
                        <div class="col-md-6 text-right">
                            <h5><i class="fa fa-rupee"></i> {{$response['amount']}}</h5>
                        </div>
                    </div>
                    <div class="__receipt_header __receipt_body __subtotal">
                        <div class="col-md-6">
                            <h5>Sub Total</h5>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fa fa-rupee"></i> {{$response['amount']}}</h5>
                        </div>
                        <!-- <div class="col-md-6">
                            <h5>Tax</h5>
                        </div>
                        <div class="col-md-6">
                            <h5>0.00</h5>
                        </div> -->
                    </div>
                    <div class="__receipt_header __receipt_body __total">
                        <div class="col-md-6">
                            <h5 class="lg">Total</h5>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fa fa-rupee"></i> {{$response['amount']}}</h5>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            Your RedCarpet Assist Team will proceed with your application and will keep in touch with you. In case you need to speak to us, do call us on +912262538600 or email us at customercare@redcarpetassist.com
        </div>
        <script>
    <!-- Google Code for New RCA Conversion Page -->
    <script type="text/javascript">
        /* <![CDATA[ */
        var google_conversion_id = 872561385;
        var google_conversion_label = "nG44CLOjhIYBEOn1iKAD";
        var google_remarketing_only = false;
        /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
    <div style="display:inline;">
    <img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/872561385/?label=nG44CLOjhIYBEOn1iKAD&amp;guid=ON&amp;script=0"/>
    </div>
    </noscript>
    </script>
@include('layouts.middle_footer')     
@stop
