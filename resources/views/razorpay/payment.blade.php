@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <div id="tab-1" class="tabs_z_content __current">
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="__congrats">
                                            <h2>Congratulations</h2>
                                            <p>Your payment was successful.</p>
                                            <p>Order Number : <strong>{{$response['order_code']}}</strong></p>
                                            <p>Transaction Ref# <strong>{{$response['txnid']}}</strong></p>
                                            <div class="__purchased">
                                                <div class="__purchased_detail">
                                                    <h4>You Purchased</h4>
                                                    <h4 class="bold">{{$response['productinfo']}}</h4>
                                                </div>
                                                <div class="__purchased_price">
                                                    <h4><i class="fa fa-rupee"></i> {{$response['amount']}}</h4>
                                                </div>
                                            </div>
                                            <div class="__purchased __total">
                                                <h4 class="__purchased_detail">Total</h4>
                                                <div class="__purchased_price">
                                                    <h4><i class="fa fa-rupee"></i> {{$response['amount']}}</h4>
                                                </div>
                                            </div>
                                            <p>We wish you a happy journey.</p>
                                            <div class="paddingtb_20">
                                                <a class="__btn __btn_link" href="{{URL::to('/')}}">HOMEPAGE</a>
                                                @if($response['ccode'] == "hongkong")
                                                    <a class="__btn __btn_link" href="{{URL::to('/')}}/hongkongreview/{{$response['order_id']}}">Form Review</a>
                                                @endif
                                                @if($response['ccode'] == "india")
                                                    <a class="__btn __btn_link" href="{{URL::to('/')}}/evisa/review/ind/{{$response['order_id']}}">Form Review</a>
                                                @endif
                                                @if($response['ccode'] == "lka")
                                                    <a class="__btn __btn_link" href="{{URL::to('/')}}/srilankareview/{{$response['order_id']}}">Form Review</a>
                                                @endif
                                            </div>
                                        </div>
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