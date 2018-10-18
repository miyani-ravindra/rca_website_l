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
                                <a href="{{ URL::to('/') }}">
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
                            @if($is_airline_detail_exist == true)
                            <div class="__round_wrapper">
                            <div class="__flight_details">
                                <h4 class="__head">{{$product_type}} <span class="thin">by</span> Flight {{$al_code}} {{$flight_no}}</h4>
                                <div class="__fl_row">
                                    <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/airport.svg" alt="" width="18" /></div>
                                    <div class="__fl_row_body">
                                        <span>Airport</span>
                                        <h5>{{$airline_details_departure}}</h5>
                                    </div>
                                </div>
                                <div class="__fl_row">
                                    <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/calendar.svg" alt="" width="15" /></div>
                                    <div class="__fl_row_body">
                                        <span>Date</span>
                                        <h5>{{carbon\Carbon::createFromFormat('Y-m-d', $travel_date)->format('d M Y')}}</h5>
                                    </div>
                                </div>
                                <div class="__fl_row">
                                    <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/passenger.svg" alt="" width="18" /></div>
                                    <div class="__fl_row_body">
                                        <span>Adult</span>
                                        <h5>{{$mna_adult_passengers}}</h5>
                                    </div>
                                </div>
                                <div class="__fl_row">
                                    <div class="__fl_row_img"><img src="{{ URL::to('/') }}/svg/passenger.svg" alt="" width="18" /></div>
                                    <div class="__fl_row_body">
                                        <span>Children</span>
                                        <h5>{{$mna_child_passengers}}</h5>
                                    </div>
                                </div>
                            </div>
                        
                        
                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="__myorder_list" style="margin-left: 15px;">
                                            <div class="_odr_dts">
                                                <div class="__fl_num">{{$al_code}} {{$flight_no}}</div>
                                                <div class="_country_type">{{$departureAirportCode}}{{-- $airline_departure_city --}}</div>
                                                <div class="_airport_name">{{$departure_terminal}}{{-- $airline_details_departure --}}</div>
                                            </div>
                                            <div class="_odr_airline">
                                                <img src="{{ URL::to('/') }}/svg/plane-right.svg" alt="" width="22" class="airplane">
                                            </div>
                                            <div class="_odr_id">
                                                <span>&nbsp;</span>
                                                <span class="_odr_no">{{$arrivalAirportCode}}{{-- $airline_arrival_city --}}</span>
                                                <span class="sm">{{$arrival_terminal}}{{-- $airline_details_arrival --}}</span>
                                            </div>
                                       


                                       @if($change_flight == 'yes')
                                  
                                            <!-- Layover badge -->
                                            <div class="_layover">
                                                <div class="_title">LAYOVER</div>
                                                <div class="_time_badge">{{$layover_time_hrs}}</div>
                                                <div class="_title">{{$airline_arrival_city}}</div>
                                            </div>
                                            <!-- Layover badge End -->
                                            <div class="_odr_id">
                                                <div class="__fl_num">{{$al_code2}} {{$flight_no2}}</div>
                                                
                                                <span class="_odr_no">{{$departureAirportCode2}}{{-- $airline_arrival_city2 --}}</span>
                                                <span class="sm">{{$departure_terminal2}}{{-- $airline_details_arrival2 --}}</span>
                                            </div>
                                            
                                            <div class="_odr_airline">
                                                <img src="{{ URL::to('/') }}/svg/plane-right.svg" alt="" width="22" class="airplane">
                                            </div>
                                            <div class="_odr_dts">
                                                <span>&nbsp;</span>
                                                <div class="_country_type">{{$arrivalAirportCode2}}{{-- $airline_departure_city2 --}}</div>
                                                <div class="_airport_name">{{$arrival_terminal2}}{{-- $airline_details_departure2 --}}</div>
                                            </div>
                                        
                                        @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="__proceed">
                                            <form name="mna_service_form" id="mna_service_form" action="step3" method="post">
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                                <input type="hidden" name="change_flight" id="change_flight" value="{{$change_flight}}">
                                                <input type="hidden" name="product_id" id="product_id" value="2">
                                                <input type="hidden" name="product_type" id="product_type" value="{{$product_type}}">

                                                <input type="hidden" name="mna_adult_passengers" id="mna_adult_passengers" value="{{$mna_adult_passengers}}">
                                                <input type="hidden" name="mna_child_passengers" id="mna_child_passengers" value="{{$mna_child_passengers}}">
                                                <input type="hidden" name="mna_child_age_array" id="mna_child_age_array" value="{{serialize($mna_child_age_array)}}">
                                                <input type="hidden" name="flight_1" id="flight_1" value="{{$al_code}} {{$flight_no}}">
                                                <input type="hidden" name="arrival_terminal" id="arrival_terminal" value="{{$arrival_terminal}}">
                                                <input type="hidden" name="departure_terminal" id="departure_terminal" value="{{$departure_terminal}}">
                                                <input type="hidden" name="dep_ap_code" id="dep_ap_code" value="{{$departureAirportCode}}">
                                                <input type="hidden" name="arr_ap_code" id="arr_ap_code" value="{{$arrivalAirportCode}}">
                                                <input type="hidden" name="travel_date" id="travel_date" value="{{$travel_date}}">
                                                <input type="hidden" name="airline_departure_city" id="airline_departure_city" value="{{$airline_departure_city}}">
                                                <input type="hidden" name="airline_details_departure" id="airline_details_departure" value="{{$airline_details_departure}}">
                                                <input type="hidden" name="airline_arrival_city" id="airline_arrival_city" value="{{$airline_arrival_city}}">
                                                <input type="hidden" name="airline_details_arrival" id="airline_details_arrival" value="{{$airline_details_arrival}}">
                                                <input type="hidden" name="departureAirportCode" id="departureAirportCode" value="{{$departureAirportCode}}">
                                                
                                                <input type="hidden" name="arrivalAirportCode" id="arrivalAirportCode" value="{{$arrivalAirportCode}}">
                                                
                                                <input type="hidden" name="layover_time_hrs" id="layover_time_hrs" value="{{isset($layover_time_hrs) ? $layover_time_hrs :''}}">



                                                <input type="hidden" name="dep_ap_code2" id="dep_ap_code2" value="{{isset($departureAirportCode2) ? $departureAirportCode2 : ''}}">
                                                <input type="hidden" name="arr_ap_code2" id="arr_ap_code2" value="{{isset($arrivalAirportCode2) ? $arrivalAirportCode2 : ''}}">
                                                <input type="hidden" name="flight_2" id="flight_2" value="{{isset($al_code2) ? $al_code2 : ''}} {{isset($flight_no2) ? $flight_no2 : ''}}">
                                                <input type="hidden" name="departure_terminal2" id="departure_terminal2" value="{{isset($departure_terminal2) ? $departure_terminal2 : ''}}">
                                                <input type="hidden" name="arrival_terminal2" id="arrival_terminal2" value="{{isset($arrival_terminal2) ? $arrival_terminal2 : ''}}">
                                                <input type="hidden" name="travel_date2" id="travel_date2" value="{{isset($travel_date2) ? $travel_date2 : ''}}">
                                                <input type="hidden" name="airline_departure_city2" id="airline_departure_city2" value="{{isset($airline_departure_city2) ? $airline_departure_city2 :''}}">
                                                <input type="hidden" name="airline_details_departure2" id="airline_details_departure2" value="{{isset($airline_details_departure2) ? $airline_details_departure2 :''}}">
                                                <input type="hidden" name="airline_arrival_city2" id="airline_arrival_city2" value="{{isset($airline_arrival_city2)?$airline_arrival_city2:''}}">
                                                <input type="hidden" name="airline_details_arrival2" id="airline_details_arrival2" value="{{isset($airline_details_arrival2)?$airline_details_arrival2:''}}">
                                                <input type="hidden" name="departureAirportCode2" id="departureAirportCode2" value="{{isset($departureAirportCode2)?$departureAirportCode2:''}}">
                                                <input type="hidden" name="arrivalAirportCode2" id="arrivalAirportCode2" value="{{isset($arrivalAirportCode2)?$arrivalAirportCode2:''}}">
                                                <input type="hidden" name="travel_type" value="{{$travel_type}}">
                                                
                                            <button type="submit" class="__btn __active">PROCEED</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @else
                                <p>{!! htmlspecialchars_decode($msg) !!}</p>
                            @endif
                              
                        </div>
                        
                        
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