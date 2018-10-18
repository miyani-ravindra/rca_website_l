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
                            <li id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="{{ URL::to('/') }}">
                                <span class="__title">MEET &amp; ASSIST</span>
                                <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                            </a>
                            </li>
                            <li class="__current" id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{ URL::to('/') }}">
                                    <span class="__title">LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                           
                        <div class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading"><a href="{{ URL::to('/') }}"><img src="svg/arrow-left.svg" alt="" width="15" /> Lounge BOOKING</a></h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="__flight_details">
                                        
                                        <!-- RCAS-2 - START -->
                                        @if(isset($search_by_city) && $search_by_city == 'city')

                                            <h4 class="__head">{{$product_type}} <span class="thin">by</span> City {{$city_one}} </h4>

                                        @else

                                            <h4 class="__head">{{$product_type}} <span class="thin">by</span> Flight {{$flight_1}} {{$flight_2 != '' ? ', '.$flight_2 :''}}</h4></h4>
                                            <div class="__fl_row">
                                                <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/airport.svg" alt="" width="18" /></div>
                                                <div class="__fl_row_body">
                                                    <span>Airport</span>
                                                    <h5>{{$dep_ap_code}} {{$departure_terminal != ''? $departure_terminal : ""}}</h5>
                                                </div>
                                            </div>

                                        @endif
                                        <!-- RCAS-2 - END -->

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
                                                <span>Adult</span>
                                                <h5>{{$lounge_adult_passengers}}</h5>
                                            </div>
                                        </div>
                                        <div class="__fl_row">
                                            <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/passenger.svg" alt="" width="18" /></div>
                                            <div class="__fl_row_body">
                                                <span>Children</span>
                                                <h5>{{$lounge_child_passengers}}</h5>
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
                                        <?php $total = $total_usd = 0;$total_a=$total_a_usd=0;$child_total =$child_total_usd= 0;?>
@foreach($price_details as $product_price)
<div class="__order_row">
    <div class="__order_lft">
{{$product_price->product_name }}
    </div>
    <div class="__order_rgt">

    </div>
</div>
<div class="__order_row">
    <div class="__order_lft">Price per Person(Adult)
    </div>
    <div class="__order_rgt">{{round($product_price->total_sp_usd_with_gst)}}
    </div>
</div>
    @if($lounge_child_passengers != 0 && $product_price->c_total_sp_usd_with_gst>0)
    <div class="__order_row">
        <div class="__order_lft">Price per Person(Child)
        </div>
        <div class="__order_rgt">{{round($product_price->c_total_sp_usd_with_gst)}}
        </div>
    </div>
    @endif
<div class="__order_row">
    <div class="__order_lft">
         Adult : {{$lounge_adult_passengers}} X  {{round($product_price->total_sp_usd_with_gst)}}
    </div>
    <div class="__order_rgt">
{{round($product_price->total_sp_usd_with_gst) * $lounge_adult_passengers}}
    </div>
    <?php $total_a_usd = (round($product_price->total_sp_usd_with_gst) * $lounge_adult_passengers); 
    $total_a = (round($product_price->total_sp_inr_with_gst) * $lounge_adult_passengers) ?>
    <?php $currency = $product_price->currency; 
          $total = (int)$total_a;
          $total_usd = (int)$total_a_usd;
          ?>
</div>
    @if($lounge_child_passengers != 0 && $product_price->c_total_sp_usd_with_gst > 0)
        <div class="__order_row">
        <div class="__order_lft">

            <?php
                
                $child_count = 0;
                if($lounge_child_passengers != 0){
                    foreach($lounge_child_ages as $age){ 
                        $age = (int)$age;
                        $min_age = (int)$product_price->child_defination_min;
                        $max_age = (int)$product_price->child_defination_max;
                        //In DB min & max values are inter changed
                        if(($age > $product_price->child_free) && ($age >= $max_age) && ($age <= $min_age)){
                            $child_total += round($product_price->c_total_sp_inr_with_gst);
                            $child_total_usd += round($product_price->c_total_sp_usd_with_gst);
                            $child_count += 1;
                        }
                                
                    }
                }                                                                   
            ?>
             Child : {{$child_count}} X {{round($product_price->c_total_sp_usd_with_gst)}}
        </div>
        <div class="__order_rgt">
    {{$child_total}}
        </div>
        @endif
        <?php $total = (int)$total_a+(int)$child_total; 
              $total_usd = (int)$total_a_usd+(int)$child_total_usd; 
        ?>
        <?php $currency = $product_price->currency; ?>
    </div>
@endforeach

                                        <div class="__order_row">
                                            <div class="__order_lft">TOTAL
                                            </div>
                                            <div class="__order_rgt"> <span class="big">{{-- $currency--}} USD {{$total_usd}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--div class="__round_wrapper __frm_gutter">
                                        <input type="checkbox" name="terms" id="terms" value="Y" required="">  I agree to the <a href='{{URL::to("/")}}/terms-and-conditions' target='_blank'>Terms & Conditions</a> and <a href='{{URL::to("/")}}/privacy-policy' target='_blank'>Privacy Policy</a>
                        </div-->
                        <form name="" method="post" action="userForm" enctype="multipart/form-data">
                           <div class="__round_wrapper __frm_gutter">
                                        <input type="checkbox" name="terms" id="terms" value="Y" required="">  I agree to the <a href='{{URL::to("/")}}/terms-and-conditions' target='_blank'>Terms & Conditions</a> and <a href='{{URL::to("/")}}/privacy-policy' target='_blank'>Privacy Policy</a>
                        </div>

			    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="amount" value="<?php echo $total; ?>">
                            <input type="hidden" name="currency" value="<?php echo $currency; ?>">
                            <input type="hidden" name="travel_date" value="{{$travel_date}}">
                            <input type="hidden" name="flight_1" value="{{$flight_1}}">
                            <input type="hidden" name="flight_2" value="{{$flight_2 != '' ? ', '.$flight_2 :''}}">
                            <input type="hidden" name="airport1" value="{{$dep_ap_code}}">
                            <input type="hidden" name="departure_airport_code1" id="departure_airport_code1" value="{{$departure_airport_code1}}">
                            <input type="hidden" name="arrival_airport_code1" id="arrival_airport_code1" value="{{$arrival_airport_code1}}">
                            <input type="hidden" name="departure_airport_code2" id="departure_airport_code2" value="{{isset($departure_airport_code2)?$departure_airport_code2:''}}">
                            <input type="hidden" name="arrival_airport_code2" id="arrival_airport_code2" value="{{isset($arrival_airport_code2) ? $arrival_airport_code2 : ''}}">
                            <input type="hidden" name="change_flight" id="change_flight" value="{{$change_flight}}">
                                    <input type="hidden" name="product_id" id="product_id" value="2">
                                    <input type="hidden" name="product_type" id="product_type" value="{{$product_type}}">
                                    <input type="hidden" name="price_id" id="price_id" value="{{$price_id}}">
                                    <input type="hidden" name="passenger" id="passenger" value="{{$no_of_passengers}}">
                                    <input type="hidden" name="arrival_terminal" id="arrival_terminal" value="{{$arrival_terminal}}">
                                    <input type="hidden" name="departure_terminal" id="departure_terminal" value="{{$departure_terminal}}">
                                    <input type="hidden" name="departure_terminal2" id="departure_terminal2" value="{{isset($departure_terminal2) ? $departure_terminal2 : ''}}">
                                    <input type="hidden" name="arrival_terminal2" id="arrival_terminal2" value="{{isset($arrival_terminal2) ? $arrival_terminal2 : ''}}">

                                    <!-- RCAS-2 - START -->
                                    <input type="hidden" name="search_by_city" id="search_by_city" value="{{isset($search_by_city) ? $search_by_city : 'no'}}">
                                    <input type="hidden" name="city_one" id="city_one" value="{{isset($city_one) ? $city_one : ''}}">
                                    <!-- RCAS-2 - END -->


                        <?php for ($x = 1; $x <= $total_passengers; $x++) { ?>
                        <div class="__round_wrapper __frm_gutter">
                            <div class="row">
                                <div class="col-md-12">
                                    @if($x == 1)
                                    <div class="__frm_grp">
                                        <div class="__label"><h4>Primary passenger details</h4></div>
                                    </div>
                                    @endif
                                </div>
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
                                                <input type="file" required="" name="ticket_<?php echo $x; ?>"> <!-- RCAV1-56 -->
                                            </span>
                                            <span class="fileinput-filename"></span>
                                            <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
                                        </div>
                                        @if($x == 1)
                                        <div class="__inline_100">
                                            <input id="all" name="same_ticket_<?php echo $x; ?>" type="checkbox" class="__checkbox same_ticket_lounge"> <!-- RCAV1-56 -->
                                            <label for="all">Use for all of the below</label>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
			                
				                        
                        <div class="paddingtb_10 text-center"><button type="submit" class="__btn __active">PROCEED</button></div>
                    </div>
                </form>
                    </div>
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
