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
                            <li class="__current" id="group_size_max_mna"> <!-- RCAV1-60 -->
                               <a href="{{URL::to('/')}}"> 
                                    <span class="__title">MEET &amp; ASSIST</span>
                                    <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{ URL::to('/') }}">
                                    <span class="__title">LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current">
                            <div class="__round_wrapper">
                            <div class="__flight_details">
                                <h4 class="__head">{{$product_type}} <span class="thin">by</span> Flight {{$flight_1}} {{$flight_2 != '' ? ', '.$flight_2 :''}}</h4>
                                <div class="__fl_row">
                                    <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/airport.svg" alt="" width="18" /></div>
                                    <div class="__fl_row_body">
                                        <span>Airport</span>
                                        <h5>{{$dep_ap_code}} {{$departure_terminal != ''? 'T'.$departure_terminal : ""}}</h5>
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
                            </div>
                        </div>



                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="__myorder_list">
                                            <div class="_odr_dts">
                                                <div class="__fl_num">{{$flight_1}}</div>
                                                <div class="_country_type">{{$airline_departure_city}}</div>
                                                <div class="_airport_name">{{$airline_details_departure}}</div>
                                            </div>
                                            <div class="_odr_airline">
                                                <img src="{{ URL::to('/') }}/svg/plane-right.svg" alt="" width="22" class="airplane">
                                            </div>
                                            <div class="_odr_id">
                                                <span>&nbsp;</span>
                                                <span class="_odr_no">{{$airline_arrival_city}}</span>
                                                <span class="sm">{{$airline_details_arrival}}</span>
                                            </div>
                                       


                                       @if($change_flight == 'yes')
                                  
                                            <!-- Layover badge -->
                                            <div class="_layover">
                                                <div class="_title">LAYOVER</div>
                                                <div class="_time_badge">{{$layover_time_hrs}}</div>
                                                <div class="_title">{{$airline_arrival_city}}</div>
                                            </div>
                                            <!-- Layover badge End -->

                                            <div class="_odr_dts">
                                                <div class="__fl_num">{{$flight_2}}</div>
                                                <div class="_country_type">{{$airline_departure_city2}}</div>
                                                <div class="_airport_name">{{$airline_details_departure2}}</div>
                                            </div>
                                            <div class="_odr_airline">
                                                <img src="{{ URL::to('/') }}/svg/plane-right.svg" alt="" width="22" class="airplane">
                                            </div>
                                            <div class="_odr_id">
                                                <span>&nbsp;</span>
                                                <span class="_odr_no">{{$airline_arrival_city2}}</span>
                                                <span class="sm">{{$airline_details_arrival2}}</span>
                                            </div>
                                        
                                        @endif
                                        </div>
                                    </div>
                                </div>






                        <div class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading"><a href="index.html"><!--<img src="{{ URL::to('/') }}/svg/arrow-left.svg" alt="" width="15" />--> MEET &amp; ASSIST RESULTS</a></h1>
                                </div>
                            </div>
                            <div class="row __selected_service_box">
                                <div class="col-md-8">
                                    <form name="" action="/Meetnassist/confirm" method="post">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                
                                    <h4><strong>You Selected</strong></h4>
                                    <div id="mna_selected_service">
                                    <!--<p class="__selected_item">1 Standard Meet & Assist for Departure <span>Remove</span></p>
                                    <p class="__selected_item">1 Standard Meet & Assist for Transit <span>Remove</span></p>-->
                                    </div>
                                </div>
                                <div class="col-md-4 text-right">
                                    <div class="__proceed">
                                        <button type="submit" class="__btn">BOOK NOW</button>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                        
                        <div class="__round_wrapper">
                            @foreach ($services_available as $service)
                            <div class="__products_container">
                                <div class="__products_img">
                                    <img src="{{ URL::to('/') }}/images/MNA-1.png" alt="" width="150" />
                                </div>
                                <div class="__products_head">
                                    <div class="__products_head_txt">
                                        <h5>{{$service->product_name}}</h5>
                                        <h5 class="sm">{{$service->airport}} Terminal {{$service->arrival_terminal}}</h5>
                                    </div>
                                    <div class="__products_head_price">
                                        <h6 class="__price"><span>starting at</span> &nbsp;{{$service->currency}}</i> {{$service->adult_cost_price}}</h6>
                                    </div>
                                    <div class="__products_body">
                                        <p>{{$service->inclusions}}
                                            <!--<span class="more_text">
                                            askdjfb adsfkj sdf kf kjasd fsdf ksdjf kjsd f dskjf kjasd fsdf sdfkj sdfkj sdfsd fkjsad fsdfs dfkj sdfjk skf s fsd fkj sadfjk sdjkf sd fk fks fksd fksd fkj</span>
                                            <a class="more">More Details</a>-->
                                        </p>
                                    </div>
                                    <div class="__products_footer">
                                        <div class="__products_footer_icon">
                                            <ul class="__list">
                                                <li><img src="{{ URL::to('/') }}/svg/beverages.svg" alt="" width="18"> Beverages</li>
                                                <li><img src="{{ URL::to('/') }}/svg/food.svg" alt="" width="25"> Food</li>
                                                <li><img src="{{ URL::to('/') }}/svg/smoking.svg" alt="" width="25"> Smoking Zone</li>
                                            </ul>
                                        </div>
                                        <div class="__products_footer_button">
                                            <button type="button" class="__btn mna_service_btn" id="{{$service->p_id}}">SELECT</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>




                        <div id="tab-2" class="tabs_z_content">
                            <div class="__round_wrapper">
                            <div class="__products_container">
                                <div class="__products_img">
                                    <img src="images/MNA-1.png" alt="" width="150" />
                                </div>
                                <div class="__products_head">
                                    <div class="__products_head_txt">
                                        <h5>Standard Meet & Assist</h5>
                                        <h5 class="sm">Mumbai Airport Terminal 2</h5>
                                    </div>
                                    <div class="__products_head_price">
                                        <h6 class="__price"><span>starting at</span> &nbsp;<i class="fa fa-rupee"></i> 2000</h6>
                                    </div>
                                    <div class="__products_body">
                                        <p>Meet and Assist Service offer passengers and/or their loved ones to choose from an array of services which includes lounge access, dedicated <span class="more_text">askdjfb adsfkj sdf kf kjasd fsdf ksdjf kjsd f dskjf kjasd fsdf sdfkj sdfkj sdfsd fkjsad fsdfs dfkj sdfjk skf s fsd fkj sadfjk sdjkf sd fk fks fksd fksd fkj</span>
                                        <a class="more">More Details</a></p>
                                    </div>
                                    <div class="__products_footer">
                                        <div class="__products_footer_icon">
                                            <ul class="__list">
                                                <li><img src="{{ URL::to('/') }}/svg/beverages.svg" alt="" width="18"> Beverages</li>
                                                <li><img src="{{ URL::to('/') }}/svg/food.svg" alt="" width="25"> Food</li>
                                                <li><img src="{{ URL::to('/') }}/svg/smoking.svg" alt="" width="25"> Smoking Zone</li>
                                            </ul>
                                        </div>
                                        <div class="__products_footer_button">
                                            <button type="button" class="__btn">SELECT</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="__round_wrapper">
                            <div class="__products_container">
                                <div class="__products_img">
                                    <img src="images/MNA-1.png" alt="" width="150" />
                                </div>
                                <div class="__products_head">
                                    <div class="__products_head_txt">
                                        <h5>Standard Meet & Assist</h5>
                                        <h5 class="sm">Mumbai Airport Terminal 2</h5>
                                    </div>
                                    <div class="__products_head_price">
                                        <h6 class="__price"><span>starting at</span> &nbsp;<i class="fa fa-rupee"></i> 2000</h6>
                                    </div>
                                    <div class="__products_body">
                                        <p>Meet and Assist Service offer passengers and/or their loved ones to choose from an array of services which includes lounge access, dedicated askdjads f js fdsf skabsdf. asdf sdfmnds. <span class="more">More Details</span></p>
                                    </div>
                                    <div class="__products_footer">
                                        <div class="__products_footer_icon">
                                            <ul class="__list">
                                                <li><img src="svg/beverages.svg" alt="" width="18"> Beverages</li>
                                                <li><img src="svg/food.svg" alt="" width="25"> Food</li>
                                                <li><img src="svg/smoking.svg" alt="" width="25"> Smoking Zone</li>
                                            </ul>
                                        </div>
                                        <div class="__products_footer_button">
                                            <button type="button" class="__btn">SELECT</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="__round_wrapper">
                            <div class="__flight_details">
                                <h4 class="__head">Transit <span class="thin">by</span> Flight FL3445</h4>
                                <div class="__fl_row">
                                    <div class="__fl_row_img"><img src="svg/airport.svg" alt="" width="18" /></div>
                                    <div class="__fl_row_body">
                                        <span>Airport</span>
                                        <h5>Mumbai Airport (BOM) T3</h5>
                                    </div>
                                </div>
                                <div class="__fl_row">
                                    <div class="__fl_row_img"><img src="svg/calendar.svg" alt="" width="15" /></div>
                                    <div class="__fl_row_body">
                                        <span>Date</span>
                                        <h5>20 June 2018</h5>
                                    </div>
                                </div>
                                <div class="__fl_row">
                                    <div class="__fl_row_img"><img src="svg/passenger.svg" alt="" width="18" /></div>
                                    <div class="__fl_row_body">
                                        <span>No. of Passengers</span>
                                        <h5>3</h5>
                                    </div>
                                </div>
                            </div>
                        </div>-->
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
                                <img src="svg/india.svg" alt="" width="80" >
                                <span>INDIA</span>
                            </li>
                            <li>
                                <img src="svg/uk.svg" alt="" width="80" >
                                <span>UK</span>
                            </li>
                            <li>
                                <img src="svg/us.svg" alt="" width="80" >
                                <span>US</span>
                            </li>
                            <li>
                                <img src="svg/france.svg" alt="" width="80" >
                                <span>FRANCE</span>
                            </li>
                            <li>
                                <img src="svg/germany.svg" alt="" width="80" >
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