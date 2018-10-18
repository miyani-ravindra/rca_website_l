@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <ul class="tabs_z">
                            <li>
                                <a href="{{ URL::to('/') }}">
                                    <span class="__title">E-VISA</span>
                                    <img src="{{ URL::to('/') }}/svg/E-Visa.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li class="__current">
                                <span class="__title">MEET &amp; ASSIST</span>
                                <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                            </li>
                            <li>
                                <a href="{{ URL::to('/') }}">
                                    <span class="__title">LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                           
                        <div class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading"><a href="index.html"><img src="svg/arrow-left.svg" alt="" width="15" /> AIRPORT MEET & GREET BOOKING</a></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="__flight_details">
                                        <h4 class="__head">{{$product_type}} <span class="thin">by</span> Flight {{$flight_1}} {{$flight_2 != '' ? ', '.$flight_2 :''}}</h4></h4>
                                        <div class="__fl_row">
                                            <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/airport.svg" alt="" width="18" /></div>
                                            <div class="__fl_row_body">
                                                <span>Airport</span>
                                                <h5>{{$dep_ap_code}} {{$departure_terminal != ''? $departure_terminal : ""}}</h5>
                                            </div>
                                        </div>
                                        <div class="__fl_row">
                                            <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/calendar.svg" alt="" width="15" /></div>
                                            <div class="__fl_row_body">
                                                <span>Date</span>
                                                <h5>{{$travel_date}}</h5>
                                            </div>
                                        </div>
                                        <div class="__fl_row">
                                            <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/passenger.svg" alt="" width="18" /></div>
                                            <div class="__fl_row_body">
                                                <span>No. of Passengers</span>
                                                <h5>{{$no_of_passengers}}</h5>
                                            </div>
                                        </div>
                                        <!--<div class="__fl_row">
                                            <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/mna_type.svg" alt="" width="18" /></div>
                                            <div class="__fl_row_body">
                                                <span>MNA Type</span>
                                                <h5>Standard</h5>
                                            </div>
                                        </div>
                                        <div class="__fl_row">
                                            <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/price-tag.svg" alt="" width="18" /></div>
                                            <div class="__fl_row_body">
                                                <span>M&amp;A Price</span>
                                                <h5>2000 per Person</h5>
                                            </div>
                                        </div>-->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__order_summary">
                                        <h4>Order Summary</h4>
                                        <?php $total = 0;?>
@foreach($price_details as $product_price)
<div class="__order_row">
    <div class="__order_lft">
{{$product_price->product_name }}
    </div>
    <div class="__order_rgt">

    </div>
</div>
<div class="__order_row">
    <div class="__order_lft">Price
    </div>
    <div class="__order_rgt">{{$product_price->total_sp_inr_with_gst}}
    </div>
</div>
                                        
<div class="__order_row">
    <div class="__order_lft">
    <?php if ($product_price->rate_application =='Per Person'){ ?>
        
         {{$no_of_passengers}} X  {{$product_price->total_sp_inr_with_gst}}
    
         <?php }else{ ?>
        
        {{$product_price->total_sp_inr_with_gst}}
        
       <?php } ?>
        
    </div>
    <div class="__order_rgt">
{{$product_price->total_sp_inr_with_gst * $no_of_passengers}}
    </div>
    <?php $total += ($product_price->total_sp_inr_with_gst * $no_of_passengers) ?>
    <?php $currency = $product_price->currency; ?>
</div>
@endforeach

                                        <div class="__order_row">
                                            <div class="__order_lft">TOTAL
                                            </div>
                                            <div class="__order_rgt"> <span class="big">{{ $currency}} {{$total}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form name="" method="post" action="userForm" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="amount" value="<?php echo $total; ?>">
                            <input type="hidden" name="currency" value="<?php echo $currency; ?>">
                            <input type="hidden" name="change_flight" id="change_flight" value="{{$change_flight}}">
                                    <input type="hidden" name="product_id" id="product_id" value="2">
                                    <input type="hidden" name="product_type" id="product_type" value="{{$product_type}}">
                                    <input type="hidden" name="price_id" id="price_id" value="{{$price_id}}">
                                    <input type="hidden" name="passenger" id="passenger" value="{{$no_of_passengers}}">
                                    <input type="hidden" name="flight_1" id="flight_1" value="{{$flight_1}}">

                        <?php for ($x = 1; $x <= $no_of_passengers; $x++) { ?>
                        <div class="__round_wrapper __frm_gutter">
                            <div class="row">
                                <div class="col-md-12">
                                    @if($x == 1)
                                <div class="__frm_grp">
                                            <div class="__label"><h4>Primary passenger details</h4></div>
                                        </div>
                                    </div>
                                    @endif
                                <div class="col-md-7">
                                    <div class="__form_inline">
                                        
                                        
                                        <div class="__frm_grp">
                                            <div class="__label">Pas <?php echo $x; ?></div>
                                        </div>
                                        <div class="__frm_grp">
                                            <input type="text" class="__frm_input" required="" placeholder="First Name" name="f_name_<?php echo $x; ?>" value="" />
                                        </div>
                                        <div class="__frm_grp">
                                             <input type="text" class="__frm_input" required="" placeholder="Last Name" name="l_name_<?php echo $x; ?>" value="" />
                                        </div>

                                        <div class="clearfix"></div>
                                        <div class="__frm_grp">
                                            <div class="__label">Details</div>
                                        </div>
                                        <div class="__frm_grp">
                                            <input type="tel" class="__frm_input" required="" placeholder="Phone Number" name="mobile_<?php echo $x; ?>" />
                                        </div>
                                        <div class="__frm_grp">
                                            <input type="email" class="__frm_input" required="" placeholder="Email ID" name="email_<?php echo $x; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="__order_summary">
                                        <h4><strong>Upload Ticket Copy</strong></h4>
                                        <div class="fileinput fileinput-new __margin0" data-provides="fileinput">
                                            <span class="btn btn-default btn-file">
                                                <span class="fileinput-new"><i class="fa fa-upload"></i></span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" {{$x == 1 ? 'required=""' :''}} name="ticket_<?php echo $x; ?>">
                                            </span>
                                            <span class="fileinput-filename"></span>
                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                        </div>
                                        @if($x == 1)
                                        <div class="__inline_100">
                                            <input id="all" name="same_ticket_<?php echo $x; ?>" type="checkbox" class="__checkbox">
                                            <label for="all">Use for all of the below</label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                                        
                        
                        <div class="paddingtb_10 text-center"><button type="submit" class="__btn __active">PROCEED TO PAYMENT</button></div>
                    </div>
                </form>
                    </div>
                        </div>
                        <div id="tab-3" class="tabs_z_content">
                            ajsdf ajsd f ajksdf kasd Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="__countries_box">
                        <h4>We offer e-visa services to following countries</h4>
                        <ul class="__country_list">
                            <li>
                                <img src="{{ URL::to('/') }}/svg/india.svg" alt="" width="80" >
                                <span>INDIA</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/svg/uk.svg" alt="" width="80" >
                                <span>UK</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/svg/us.svg" alt="" width="80" >
                                <span>US</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/svg/france.svg" alt="" width="80" >
                                <span>FRANCE</span>
                            </li>
                            <li>
                                <img src="{{ URL::to('/') }}/svg/germany.svg" alt="" width="80" >
                                <span>GERMANY</span>
                            </li>
                        </ul>
                        <h4>We are adding more countries every month.</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top bg End -->
@include('layouts.middle_footer')     
@stop