@extends('layouts.layout')
@section('content')
 <!--  Visa Body -->
 <div class="container __order_review">
        <div class="row">
            <div class="col-md-6">
                <div class="__review_booking">
                    <div class="__media">
                        <div class="__media-left">
                            <img src="{{ URL::to('/') }}/svg/protect-refund.svg" alt="" width="50" />
                        </div>
                        <div class="__media-body">
                            <h5>Protected by best refund policy</h5>
                            <p>Sed eget erat tempor, facilisis turpis ac, ultrices augue. Nullam interdum scelerisque pulvinar.</p>
                        </div>
                    </div>
                    <div class="__media">
                        <div class="__media-left">
                            <img src="{{ URL::to('/') }}/svg/customer-support.svg" alt="" width="50" />
                        </div>
                        <div class="__media-body">
                            <h5>Support team for all your queries</h5>
                            <p>Sed eget erat tempor, facilisis turpis ac, ultrices augue. Nullam interdum scelerisque pulvinar.</p>
                        </div>
                    </div>
                    <h4 class="sm">Why Red Carpet Assist?</h4>
                    <ul class="__why_list">
                        <li>Sed eget erat tempor, facilisis turpis ac, ultrices augue. Nullam interdum scelerisque pulvinar.</li>
                        <li>Sed eget erat tempor, facilisis turpis ac, ultrices augue. Nullam interdum scelerisque pulvinar.</li>
                        <li>Sed eget erat tempor, facilisis turpis ac, ultrices augue. Nullam interdum scelerisque pulvinar.</li>
                    </ul>
                    <img src="{{ URL::to('/') }}/svg/review-graphic.svg" alt="" class="img-responsive __order_svg" />
                </div>
            </div>
            <aside class="col-md-6">
                <div class="__review_booking">
                    <h4>Review your booking</h4>
                </div>
                <div class="__order_details">
                    <div class="__order_head">
                        <h6>Order ID: <span class="hightlight">{{$order_qry->order_code}}</span></h6>
                        <div class="__order_list"><span class="bold">{{$product_name}}</span>  {{$product_validity}} validity</div>
                        <div class="__order_list"><img src="svg/fast-visa-xs.svg" alt="" width="25" /> Fast visa processing in 2-3 working days</div>
                        <div class="__order_list"><img src="svg/wallet-xs.svg" alt="" width="25" /> No hidden charges </div>
                    </div>
                    <div class="__pax">
                        <h4>{{$order_qry->adult}} Adults {{$order_qry->child}} child</h4>
                        <span class="__pax_date">
                            <img src="{{ URL::to('/') }}/svg/calendar.svg" alt="" width="12" /> &nbsp;{{date('d M Y', strtotime($order_qry->travel_date))}}
                        </span>
                        <h4 class="__pax_no">&#8377; {{$adult_price}}  x {{$order_qry->adult}} Adult <span>&#8377; {{$adult_price * $order_qry->adult}}</span></h4>
                        <h4 class="__pax_no">&#8377; {{$child_price}}  x  {{$order_qry->child}} Child <span>&#8377; {{$child_price * $order_qry->child}}</span></h4>
                        <hr class="fw sm" />
                        <div class="__total">Total charges <span>&#8377; {{$order_qry->total_price}}</span></div>
                        <form action="payment" method="post">
                          <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                          <input type="hidden" name="submit_val" id="submit_val" value="{{$order_qry->order_id}}">
                          <button type="submit" class="__btn __btn_submit __paynow __active">PAY NOW</button>
                        </form>
                        <p class="_payU">You will be redirected to PayU to complete your payment. </p>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@stop