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
                                <span class="__title">AIRPORT MEET &amp; GREET</span>
                                <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{ URL::to('/') }}">
                                    <span class="__title">AIRPORT LOUNGE</span>
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
                                        <h5>{{$dep_ap_code}} {{ $departure_terminal != ''? $departure_terminal : "" }}</h5>
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
                        <?php $mna_child_age_array = isset($mna_child_ages) ? serialize($mna_child_ages):''; ?>



                        <div class="row">
                                    <div class="col-md-12">
                                        <div class="__myorder_list" style="margin-left: 15px;">
                                            <div class="_odr_dts">
                                                <div class="__fl_num">{{$flight_1}}</div>
                                                <div class="_country_type">{{$departureAirportCode}}{{-- $airline_departure_city --}}</div>
                                                <div class="_airport_name">{{$departure_terminal}}{{-- $airline_details_departure --}}</div>
                                            </div>
                                            <div class="_odr_airline">
                                                <img src="{{ URL::to('/') }}/svg/plane-right.svg" alt="" width="22" class="airplane">
                                            </div>
                                            <div class="_odr_id">
                                                <span>&nbsp;</span>
                                                <span class="_odr_no">{{$arrivalAirportCode}}{{-- $arr_ap_code --}}</span>
                                                <span class="sm">{{$arrival_terminal}}{{-- $airline_details_arrival --}}</span>
                                            </div>
                                       


                                       @if($change_flight == 'yes')
                                  
                                            <!-- Layover badge -->
                                            <div class="_layover">
                                                <div class="_title">LAYOVER</div>
                                                <div class="_time_badge">{{$layover_time_hrs}}</div>
                                                <div class="_title">{{$arr_ap_code}}</div>
                                            </div>
                                            <!-- Layover badge End -->

                                            <!--<div class="_odr_id">
                                                <div class="__fl_num">{{$flight_2}}</div>
                                                <span class="_odr_no">{{$departureAirportCode2}}</span>
                                                <span class="sm">{{$airline_details_arrival2}}</span>
                                            </div>-->
                                            <div class="_odr_dts">
                                                <div class="__fl_num">{{$flight_2}}</div>
                                                <div class="_country_type">{{isset($departureAirportCode2)?$departureAirportCode2 : ''}}{{-- $airline_departure_city --}}</div>
                                                <div class="_airport_name">{{isset($departure_terminal2)?$departure_terminal2:''}}{{-- $airline_details_departure --}}</div>
                                            </div>
                                            <div class="_odr_airline">
                                                <img src="{{ URL::to('/') }}/svg/plane-right.svg" alt="" width="22" class="airplane">
                                            </div>
                                            
                                            <!--<div class="_odr_dts">
                                                <span>&nbsp;</span>
                                                <div class="_country_type">{{$airline_departure_city2}}</div>
                                                <div class="_airport_name">{{$airline_details_departure2}}</div>
                                            </div>-->
                                            <div class="_odr_id">
                                                <span>&nbsp;</span>
                                                <span class="_odr_no">{{isset($arrivalAirportCode2)?$arrivalAirportCode2:''}}{{-- $airline_arrival_city --}}</span>
                                                <span class="sm">{{isset($arrival_terminal2)?$arrival_terminal2:''}}{{-- $airline_details_arrival --}}</span>
                                            </div>
                                        
                                        @endif
                                        </div>
                                    </div>
                                </div>
</div>

                        <div class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading"><a href="{{ URL::to('/') }}"><!--<img src="{{ URL::to('/') }}/svg/arrow-left.svg" alt="" width="15" />--> AIRPORT MEET &amp; GREET RESULTS</a></h1>
                                </div>
                            </div>

                            @if($service_cnt>0)
                            <!--<div class="row __selected_service_box">
                                <div class="col-md-8">
                                    
                                                
                                    <h4><strong>You Selected</strong></h4>
                                    <div id="mna_selected_service">
                                    <!--<p class="__selected_item">1 Standard Meet & Assist for Departure <span>Remove</span></p>
                                    <p class="__selected_item">1 Standard Meet & Assist for Transit <span>Remove</span></p>
                                    </div>
                                </div>-->

                            
                        
                        
                        <div class="__round_wrapper">
                            @if($departure_mna == 'Yes')
                            <h4 style='color: red'>DEPARTURE AIRPORT MEET &amp; GREET</h4>
                            @foreach ($services_available as $service)
                            @if($service->product_type == 'Departure')
                            <?php
                            $cal_mna_adult_passengers = $mna_adult_passengers;
                            $cal_mna_child_passengers = $mna_child_passengers;
                            ?>
                            <div class="__products_container">
                                <div class="__products_img">
                                    <img src="{{ URL::to('/') }}/images/service/{{$service->sr_no}}a.jpg" alt="" width="150" />
                                </div>
                                <div class="__products_head">
                                    <div class="__products_head_txt">
                                        <h5>{{$service->product_name}} {{($service->serviced_by != '' && $service->serviced_by != 'NA')? "(".$service->serviced_by .")":''}}</h5>
                                        <h5 class="sm">{{$service->airport}} Terminal {{$service->arrival_terminal}}</h5>
                                    </div>
                                    
                                    @if($service->rate_application == 'Per Person' )
                                    
                                        <?php
                                        
                                        $child_total = 0;
                                        if($mna_child_passengers != 0){ 
                                            foreach($mna_child_ages as $age){
                                                $age = (int)$age;
                                                $min_age = (int)$service->child_defination_min;
                                                $max_age = (int)$service->child_defination_max;
                                                //In DB min & max values are inter changed
                                                if(($age > $service->child_free) && ($age >= $max_age) && ($age <= $min_age)){
                                                    $child_total += round($service->c_total_sp_usd_with_gst);
                                                } else if($age > $min_age){
                                                    $cal_mna_adult_passengers += 1;
                                                    $cal_mna_child_passengers -= 1;
                                                }
                                                        
                                            }
                                        }
                                        
                                                                               
                                        ?>
                                        <div class="__products_head_price">
                                        <h6 class="__price">@if($mna_child_passengers != 0 && $service->c_total_sp_usd_with_gst>0)<span>Adult Price</span>@endif &nbsp;USD {{-- $service->currency --}}</i> {{$service->total_sp_usd_with_gst ? (round($service->total_sp_usd_with_gst)*$cal_mna_adult_passengers) : ''}}
                                            
                                            <?php
                                            if($child_total>0)
                                            echo "<span>Child Price</span>&nbsp;USD ".$child_total;
                                            ?>
                                        </h6>
                                    </div>
                                    @else
                                    <div class="__products_head_price">
                                        <h6 class="__price"><span>Group Price</span> &nbsp;USD {{-- $service->currency --}}</i> {{$service->total_sp_usd_with_gst ? round($service->total_sp_usd_with_gst) : ''}}</h6>
                                    </div>
                                    @endif

                                    <div class="__products_body">
                                        <ul class="__list_bullets">
                                            <div class="hide_txt_{{$service->p_id}}">
                                        <?php 
                                        echo htmlspecialchars_decode($service->service_description);
                                        ?>
                                        </div>
                                        
                                         <span class="more_text">
                                            <?php echo htmlspecialchars_decode($service->inclusions);?>
                                         </span>
                  
                                        
                                    </ul>
                                 <div class="col-md-6" style="font-weight:150"><a class="more">More Details</a></div>
                                    <div class="col-md-6" style="font-weight:150;font-size:12px"><a class="cancellation_policy" data-toggle="modal" data-target="#myModal_{{$service->p_id}}">Important Notes</a></div>
                                        <!-- More Video and IMage Container -->
                                        <div class="__more_container">
                                            <div class="tabs_master">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div id="tab-img-1-{{$service->p_id}}" class="tabs_4_mna_content __current">
                                                        <div class="__fit">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->sr_no}}a.jpg" alt="" width="600" />
                                                        </div>
                                                    </div>
                                                    <!--<div id="tab-img-2" class="tabs_4_mna_content">
                                                        <div class="__fit">
                                                            <iframe src="https://www.youtube.com/embed/3cndSOTqufU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                        </div>
                                                    </div>-->
                                                    <div id="tab-img-3-{{$service->p_id}}" class="tabs_4_mna_content">
                                                        <div class="__fit">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}b.jpg" alt="" />
                                                        </div>
                                                    </div>
                                                    <div id="tab-img-4-{{$service->p_id}}" class="tabs_4_mna_content">
                                                        <div class="__fit">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}c.jpg" alt="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <ul class="tabs_4_mna">
                                                        <li class="__current" data-tab="tab-img-1-{{$service->p_id}}">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}a.jpg" alt="" class="img-responsive" />
                                                        </li>
                                                        <!--<li data-tab="tab-img-2">
                                                            <img src="{{ URL::to('/') }}/images/video_thumb.png" alt="" />
                                                        </li>-->
                                                        <li data-tab="tab-img-3-{{$service->p_id}}">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}b.jpg" alt="" />
                                                        </li>
                                                        <li data-tab="tab-img-4-{{$service->p_id}}">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}c.jpg" alt="" />
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="__products_footer">
                                        <div class="__products_footer_icon">
                                            <ul class="__list">
                                                @if($service->buffet_meals=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/buffet.svg" alt="" width="20"> Buffet Meals</li>
                                                @endif
                                                @if($service->alcoholic_beverages=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/beverages.svg" alt="" width="20"> Alcoholic Beverages</li>
                                                @endif
                                                @if($service->non_alcoholic_beverages=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/nonalcoholic_beverages.svg" alt="" width="20"> Non Alcoholic Beverages</li>
                                                @endif
                                                @if($service->wifi=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/wifi.svg" alt="" width="20"> Wifi</li>
                                                @endif
                                                @if($service->smoking_zone=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/smoking.svg" alt="" width="20"> Smoking Zone</li>
                                                @endif
                                                @if($service->prayer_room=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/prayer_room.svg" alt="" width="20"> Prayer Room</li>
                                                @endif
                                                @if($service->sleeping_pods=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/sleeping_pods.svg" alt="" width="20"> Sleeping Pod</li>
                                                @endif
                                                @if($service->personal_assistance=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/personal_assistance.svg" alt="" width="20"> Personal Assistance</li>
                                                @endif
                                                @if($service->lounge=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/Lounge.svg" alt="" width="20"> Lounge</li>
                                                @endif
                                                @if($service->shower=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/shower.svg" alt="" width="20"> Shower</li>
                                                @endif
                                                @if($service->kids_play_area=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_area.svg" alt="" width="20"> Kids Play Area</li>
                                                @endif
                                                @if($service->porter=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/porter.svg" alt="" width="20"> Porter</li>
                                                @endif
                                                @if($service->fast_track_immigration=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/immigration.svg" alt="" width="20"> Fast track immigration</li>
                                                @endif
                                                @if($service->fast_track_security=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/fast_security.svg" alt="" width="20"> Fast track security</li>
                                                @endif
                                                @if($service->child_free_2yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_2.svg" alt="" width="20"> Child up to 2 yrs Free</li>
                                                @endif
                                                @if($service->child_free_3yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_2.svg" alt="" width="20"> Child up to 3yrs Free</li>
                                                @endif
                                                @if($service->child_free_5yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_5.svg" alt="" width="20"> Child up to 5yrs Free</li>
                                                @endif
                                                @if($service->child_free_6yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_5.svg" alt="" width="20"> Child up to 6yrs Free</li>
                                                @endif
                                            </ul>
                                        </div>
                                        
                                        <form name="" action="confirm" method="post">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type='hidden' name='service_id[]' id='service_id' value='{{$service->p_id}}'>


                                    <input type='hidden' name='departure_airport_code1' id='departure_airport_code1' value='{{$departureAirportCode}}'>
                                    <input type='hidden' name='arrival_airport_code1' id='arrival_airport_code1' value='{{$arrivalAirportCode}}'>
                                    <input type='hidden' name='departure_airport_code2' id='departure_airport_code2' value="{{isset($departureAirportCode2)?$departureAirportCode2:''}}">
                                    <input type='hidden' name='arrival_airport_code2' id='arrival_airport_code2' value="{{isset($arrivalAirportCode2)?$arrivalAirportCode2:''}}">
                                    <input type="hidden" name="change_flight" id="change_flight" value="{{$change_flight}}">
                                    <input type="hidden" name="product_id" id="product_id" value="2">
                                    <input type="hidden" name="product_type" id="product_type" value="{{$product_type}}">
                                    <input type="hidden" name="no_of_passengers" id="no_of_passengers" value="{{$no_of_passengers}}">
                                    <input type="hidden" name="mna_adult_passengers" id="mna_adult_passengers" value="{{$cal_mna_adult_passengers}}">
                                    <input type="hidden" name="mna_child_passengers" id="mna_child_passengers" value="{{$cal_mna_child_passengers}}">                                    
                                    <input type="hidden" name="mna_child_ages" id="mna_child_ages" value="{{$mna_child_age_array}}">         
                                    <input type="hidden" name="total_passengers" id="total_passengers" value="{{$total_passengers}}">                        

                                    <input type="hidden" name="flight_1" id="flight_1" value="{{$flight_1}}">
                                    <input type="hidden" name="airline_departure_city" id="airline_departure_city" value="{{$airline_departure_city}}">
                                    <input type="hidden" name="dep_ap_code" id="dep_ap_code" value="{{$dep_ap_code}}">
                                    <input type="hidden" name="travel_date" id="travel_date" value="{{$travel_date}}">
                                    <input type="hidden" name="airline_departure_city" id="airline_departure_city" value="{{$airline_departure_city}}">
                                    <input type="hidden" name="airline_details_departure" id="airline_details_departure" value="{{$airline_details_departure}}">
                                    <input type="hidden" name="airline_arrival_city" id="airline_arrival_city" value="{{$airline_arrival_city}}">
                                    <input type="hidden" name="airline_details_arrival" id="airline_details_arrival" value="{{$airline_details_arrival}}">
                                    <input type="hidden" name="layover_time_hrs" id="layover_time_hrs" value="{{isset($layover_time_hrs)?$layover_time_hrs:''}}">
                                    <input type="hidden" name="flight_2" id="flight_2" value="{{$flight_2 ? $flight_2 : ''}}">
                                    <input type="hidden" name="airline_arrival_city" id="airline_arrival_city" value="{{isset($airline_arrival_city) ? $airline_arrival_city : ''}}">
                                    <input type="hidden" name="airline_departure_city2" id="airline_departure_city2" value="{{isset($airline_departure_city2) ? $airline_departure_city2 : ''}}">
                                    <input type="hidden" name="travel_date2" id="travel_date2" value="{{$travel_date2 ? $travel_date2 : ''}}">
                                    <input type="hidden" name="airline_details_departure2" id="airline_details_departure2" value="{{isset($airline_details_departure2) ? $airline_details_departure2 : ''}}">
                                    
                                    <input type="hidden" name="airline_arrival_city2" id="airline_arrival_city2" value="{{isset($airline_arrival_city2)?$airline_arrival_city2:''}}">
                                    <input type="hidden" name="airline_details_arrival2" id="airline_details_arrival2" value="{{isset($airline_details_arrival2)?$airline_details_arrival2:''}}">
                                    <input type="hidden" name="arrival_terminal" id="arrival_terminal" value="{{$arrival_terminal}}">
                                    <input type="hidden" name="departure_terminal" id="departure_terminal" value="{{$departure_terminal}}">
                                    <input type="hidden" name="departure_terminal2" id="departure_terminal2" value="{{isset($departure_terminal2) ? $departure_terminal2 : ''}}">
                                    <input type="hidden" name="arrival_terminal2" id="arrival_terminal2" value="{{isset($arrival_terminal2) ? $arrival_terminal2 : ''}}">


                                    <div class="__products_footer_button">
                                            <button type="submit" class="__btn mna_service_btn" id="{{$service->p_id}}">BOOK</button>
                                        </div>
                            </form>
                                    </div>
                                </div>
                                    <hr class="fw" />

                            </div>
                            <div class="modal fade" id="myModal_{{$service->p_id}}" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Important Notes</h4>
        </div>
        <div class="modal-body">
          <p>{!! htmlspecialchars_decode($service->important_notes) !!}</p>
        </div>
        
      </div>
      
    </div>
  </div>
                            @endif
                            @endforeach
                            @endif



                            @if($arrival_mna == 'Yes')
                            <h4 style='color: red'>ARRIVAL AIRPORT MEET &amp; GREET</h4>
                            @foreach ($services_available as $service)
                            @if($service->product_type == 'Arrival')
                            <?php
                            $cal_mna_adult_passengers = $mna_adult_passengers;
                            $cal_mna_child_passengers = $mna_child_passengers;
                            ?>
                            <div class="__products_container">
                                <div class="__products_img">
                                    <img src="{{ URL::to('/') }}/images/service/{{$service->sr_no}}a.jpg" alt="" width="150" />
                                </div>
                                <div class="__products_head">
                                    <div class="__products_head_txt">
                                        <h5>{{$service->product_name}} {{($service->serviced_by != '' && $service->serviced_by != 'NA')? "(".$service->serviced_by .")":''}}</h5>
                                        <h5 class="sm">{{$service->airport}} Terminal {{$service->arrival_terminal}}</h5>
                                    </div>
                                    
                                    @if($service->rate_application == 'Per Person' )
                                    
                                        <?php
                                        
                                        $child_total = 0;
                                        if($mna_child_passengers != 0){ 
                                            foreach($mna_child_ages as $age){
                                                $age = (int)$age;
                                                $min_age = (int)$service->child_defination_min;
                                                $max_age = (int)$service->child_defination_max;
                                                //In DB min & max values are inter changed
                                                if(($age > $service->child_free) && ($age >= $max_age) && ($age <= $min_age)){
                                                    $child_total += round($service->c_total_sp_usd_with_gst);
                                                } else if($age > $min_age){
                                                    $cal_mna_adult_passengers += 1;
                                                    $cal_mna_child_passengers -= 1;
                                                }
                                                        
                                            }
                                        }
                                        
                                                                               
                                        ?>
                                        <div class="__products_head_price">
                                        <h6 class="__price">@if($mna_child_passengers != 0 && $service->c_total_sp_usd_with_gst>0)<span>Adult Price</span>@endif &nbsp;USD {{-- $service->currency --}}</i> {{$service->total_sp_usd_with_gst ? (round($service->total_sp_usd_with_gst)*$cal_mna_adult_passengers) : ''}}
                                            
                                            <?php
                                            if($child_total>0)
                                            echo "<span>Child Price</span>&nbsp;USD ".$child_total;
                                            ?>
                                        </h6>
                                    </div>
                                    @else
                                    <div class="__products_head_price">
                                        <h6 class="__price"><span>Group Price</span> &nbsp; USD {{-- $service->currency --}}</i> {{$service->total_sp_usd_with_gst ? round($service->total_sp_usd_with_gst) : ''}}</h6>
                                    </div>
                                    @endif
                                    <div class="__products_body">
                                        <ul class="__list_bullets">
                                            <div class="hide_txt_{{$service->p_id}}">
                                        <?php 
                                        echo htmlspecialchars_decode($service->service_description);
                                        ?>
                                        </div>
                                        
                                         <span class="more_text">
                                            <?php echo htmlspecialchars_decode($service->inclusions);?>
                                         </span>
                                        
                                    </ul>
                                        <div class="col-md-6" style="font-weight:150"><a class="more">More Details</a></div>
                                    <div class="col-md-6" style="font-weight:150;font-size:12px"><a class="cancellation_policy" data-toggle="modal" data-target="#myModal_{{$service->p_id}}">Important Notes</a></div>
                                        <!-- More Video and IMage Container -->
                                        <div class="__more_container">
                                            <div class="tabs_master">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div id="tab-img-1-{{$service->p_id}}" class="tabs_4_mna_content __current">
                                                        <div class="__fit">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->sr_no}}a.jpg" alt="" width="600" />
                                                        </div>
                                                    </div>
                                                    <!--<div id="tab-img-2" class="tabs_4_mna_content">
                                                        <div class="__fit">
                                                            <iframe src="https://www.youtube.com/embed/3cndSOTqufU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                        </div>
                                                    </div>-->
                                                    <div id="tab-img-3-{{$service->p_id}}" class="tabs_4_mna_content">
                                                        <div class="__fit">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}b.jpg" alt="" />
                                                        </div>
                                                    </div>
                                                    <div id="tab-img-4-{{$service->p_id}}" class="tabs_4_mna_content">
                                                        <div class="__fit">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}c.jpg" alt="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <ul class="tabs_4_mna">
                                                        <li class="__current" data-tab="tab-img-1-{{$service->p_id}}">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}a.jpg" alt="" class="img-responsive" />
                                                        </li>
                                                        <!--<li data-tab="tab-img-2">
                                                            <img src="{{ URL::to('/') }}/images/video_thumb.png" alt="" />
                                                        </li>-->
                                                        <li data-tab="tab-img-3-{{$service->p_id}}">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}b.jpg" alt="" />
                                                        </li>
                                                        <li data-tab="tab-img-4-{{$service->p_id}}">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}c.jpg" alt="" />
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="__products_footer">
                                        <div class="__products_footer_icon">
                                            <ul class="__list">
                                                @if($service->buffet_meals=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/buffet.svg" alt="" width="20"> Buffet Meals</li>
                                                @endif
                                                @if($service->alcoholic_beverages=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/beverages.svg" alt="" width="20"> Alcoholic Beverages</li>
                                                @endif
                                                @if($service->non_alcoholic_beverages=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/nonalcoholic_beverages.svg" alt="" width="20"> Non Alcoholic Beverages</li>
                                                @endif
                                                @if($service->wifi=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/wifi.svg" alt="" width="20"> Wifi</li>
                                                @endif
                                                @if($service->smoking_zone=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/smoking.svg" alt="" width="20"> Smoking Zone</li>
                                                @endif
                                                @if($service->prayer_room=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/prayer_room.svg" alt="" width="20"> Prayer Room</li>
                                                @endif
                                                @if($service->sleeping_pods=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/sleeping_pods.svg" alt="" width="20"> Sleeping Pod</li>
                                                @endif
                                                @if($service->personal_assistance=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/personal_assistance.svg" alt="" width="20"> Personal Assistance</li>
                                                @endif
                                                @if($service->lounge=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/Lounge.svg" alt="" width="20"> Lounge</li>
                                                @endif
                                                @if($service->shower=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/shower.svg" alt="" width="20"> Shower</li>
                                                @endif
                                                @if($service->kids_play_area=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_area.svg" alt="" width="20"> Kids Play Area</li>
                                                @endif
                                                @if($service->porter=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/porter.svg" alt="" width="20"> Porter</li>
                                                @endif
                                                @if($service->fast_track_immigration=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/immigration.svg" alt="" width="20"> Fast track immigration</li>
                                                @endif
                                                @if($service->fast_track_security=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/fast_security.svg" alt="" width="20"> Fast track security</li>
                                                @endif
                                                @if($service->child_free_2yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_2.svg" alt="" width="20"> Child up to 2 yrs Free</li>
                                                @endif
                                                @if($service->child_free_3yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_2.svg" alt="" width="20"> Child up to 3yrs Free</li>
                                                @endif
                                                @if($service->child_free_5yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_5.svg" alt="" width="20"> Child up to 5yrs Free</li>
                                                @endif
                                                @if($service->child_free_6yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_5.svg" alt="" width="20"> Child up to 6yrs Free</li>
                                                @endif
                                            </ul>
                                        </div>
                                        
                                        <form name="" action="confirm" method="post">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type='hidden' name='service_id[]' id='service_id' value='{{$service->p_id}}'>
                                    <input type='hidden' name='departure_airport_code1' id='departure_airport_code1' value='{{$departureAirportCode}}'>
                                    <input type='hidden' name='arrival_airport_code1' id='arrival_airport_code1' value='{{$arrivalAirportCode}}'>
                                    <input type='hidden' name='departure_airport_code2' id='departure_airport_code2' value="{{isset($departureAirportCode2)?$departureAirportCode2:''}}">
                                    <input type='hidden' name='arrival_airport_code2' id='arrival_airport_code2' value="{{isset($arrivalAirportCode2)?$arrivalAirportCode2:''}}">
                                    <input type="hidden" name="change_flight" id="change_flight" value="{{$change_flight}}">
                                    <input type="hidden" name="product_id" id="product_id" value="2">
                                    <input type="hidden" name="product_type" id="product_type" value="{{$product_type}}">
                                    <input type="hidden" name="no_of_passengers" id="no_of_passengers" value="{{$no_of_passengers}}">
                                    <input type="hidden" name="mna_adult_passengers" id="mna_adult_passengers" value="{{$cal_mna_adult_passengers}}">
                                    <input type="hidden" name="mna_child_passengers" id="mna_child_passengers" value="{{$cal_mna_child_passengers}}">
                                    <input type="hidden" name="mna_child_ages" id="mna_child_ages" value="{{$mna_child_age_array}}">
                                    <input type="hidden" name="total_passengers" id="total_passengers" value="{{$total_passengers}}">
                                    <input type="hidden" name="flight_1" id="flight_1" value="{{$flight_1}}">
                                    <input type="hidden" name="airline_departure_city" id="airline_departure_city" value="{{$airline_departure_city}}">
                                   
                                    <input type="hidden" name="dep_ap_code" id="dep_ap_code" value="{{$dep_ap_code}}">
                                    <input type="hidden" name="travel_date" id="travel_date" value="{{$travel_date}}">
                                    <input type="hidden" name="airline_departure_city" id="airline_departure_city" value="{{$airline_departure_city}}">
                                    <input type="hidden" name="airline_details_departure" id="airline_details_departure" value="{{$airline_details_departure}}">
                                    <input type="hidden" name="airline_arrival_city" id="airline_arrival_city" value="{{$airline_arrival_city}}">
                                    <input type="hidden" name="airline_details_arrival" id="airline_details_arrival" value="{{$airline_details_arrival}}">
                                    <input type="hidden" name="layover_time_hrs" id="layover_time_hrs" value="{{isset($layover_time_hrs)?$layover_time_hrs:''}}">
                                    <input type="hidden" name="flight_2" id="flight_2" value="{{$flight_2 ? $flight_2 : ''}}">
                                    <input type="hidden" name="airline_arrival_city" id="airline_arrival_city" value="{{isset($airline_arrival_city) ? $airline_arrival_city : ''}}">
                                    <input type="hidden" name="airline_departure_city2" id="airline_departure_city2" value="{{isset($airline_departure_city2) ? $airline_departure_city2 : ''}}">
                                    <input type="hidden" name="travel_date2" id="travel_date2" value="{{$travel_date2 ? $travel_date2 : ''}}">
                                    <input type="hidden" name="airline_details_departure2" id="airline_details_departure2" value="{{isset($airline_details_departure2) ? $airline_details_departure2 : ''}}">
                                    
                                    <input type="hidden" name="airline_arrival_city2" id="airline_arrival_city2" value="{{isset($airline_arrival_city2)?$airline_arrival_city2:''}}">
                                    <input type="hidden" name="airline_details_arrival2" id="airline_details_arrival2" value="{{isset($airline_details_arrival2)?$airline_details_arrival2:''}}">

                                    <input type="hidden" name="arrival_terminal" id="arrival_terminal" value="{{$arrival_terminal}}">
                                    <input type="hidden" name="departure_terminal" id="departure_terminal" value="{{$departure_terminal}}">
                                    <input type="hidden" name="departure_terminal2" id="departure_terminal2" value="{{isset($departure_terminal2) ? $departure_terminal2 : ''}}">
                                    <input type="hidden" name="arrival_terminal2" id="arrival_terminal2" value="{{isset($arrival_terminal2) ? $arrival_terminal2 : ''}}">

                                <div class="__products_footer_button paddingtb_20">
                                            <button type="submit" class="__btn mna_service_btn" id="{{$service->p_id}}">BOOK</button>
                                        </div>
                            </form>
                                    </div>
                                </div>
            <hr class="fw" />
            </div>
            
                            <div class="modal fade" id="myModal_{{$service->p_id}}" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Important Notes</h4>
        </div>
        <div class="modal-body">
          <p>{!! htmlspecialchars_decode($service->important_notes) !!}</p>
        </div>
        
      </div>
      
    </div>
  </div>
                            @endif
                            @endforeach
                            @endif



                            @if($transit_mna == 'Yes')
                            <h4 style='color: red'>TRANSIT AIRPORT MEET &amp; GREET</h4>
                            @foreach ($services_available as $service)
                            @if($service->product_type == 'Transit')
                            <?php
                            $cal_mna_adult_passengers = $mna_adult_passengers;
                            $cal_mna_child_passengers = $mna_child_passengers;
                            ?>
                            <div class="__products_container">
                                <div class="__products_img">
                                    <img src="{{ URL::to('/') }}/images/service/{{$service->sr_no}}a.jpg" alt="" width="150" />
                                </div>
                                <div class="__products_head">
                                    <div class="__products_head_txt">
                                        <h5>{{$service->product_name}} {{($service->serviced_by != '' && $service->serviced_by != 'NA')? "(".$service->serviced_by .")":''}}</h5>
                                        <h5 class="sm">{{$service->airport}} Terminal {{$service->arrival_terminal}}</h5>
                                    </div>
                                    
                                    @if($service->rate_application == 'Per Person' )
                                    
                                        <?php
                                        
                                        $child_total = 0;
                                        if($mna_child_passengers != 0){ 
                                            foreach($mna_child_ages as $age){
                                                $age = (int)$age;
                                                $min_age = (int)$service->child_defination_min;
                                                $max_age = (int)$service->child_defination_max;
                                                //In DB min & max values are inter changed
                                                if(($age > $service->child_free) && ($age >= $max_age) && ($age <= $min_age)){
                                                    $child_total += round($service->c_total_sp_usd_with_gst);
                                                } else if($age > $min_age){
                                                    $cal_mna_adult_passengers += 1;
                                                    $cal_mna_child_passengers -= 1;
                                                }
                                                        
                                            }
                                        }
                                        
                                                                               
                                        ?>
                                        <div class="__products_head_price">
                                        <h6 class="__price">@if($mna_child_passengers != 0 && $service->c_total_sp_usd_with_gst>0)<span>Adult Price</span>@endif &nbsp;USD {{-- $service->currency --}}</i> {{$service->total_sp_usd_with_gst ? (round($service->total_sp_usd_with_gst)*$cal_mna_adult_passengers) : ''}}
                                            
                                            <?php
                                            if($child_total>0)
                                            echo "<span>Child Price</span>&nbsp;USD ".$child_total;
                                            ?>
                                        </h6>
                                    </div>
                                    @else
                                    <div class="__products_head_price">
                                        <h6 class="__price"><span>Group Price</span> &nbsp;USD {{-- $service->currency --}}</i> {{$service->total_sp_usd_with_gst ? round($service->total_sp_usd_with_gst) : ''}}</h6>
                                    </div>
                                    @endif
                                    <div class="__products_body">
                                        <ul class="__list_bullets">
                                            <div class="hide_txt_{{$service->p_id}}">
                                        <?php 
                                        echo htmlspecialchars_decode($service->service_description);
                                        ?>
                                        </div>
                                        
                                         <span class="more_text">
                                            <?php echo htmlspecialchars_decode($service->inclusions);?>
                                         </span>
                                        
                                    </ul>
                            <div class="col-md-6" style="font-weight:150"><a class="more">More Details</a></div>
                                    <div class="col-md-6" style="font-weight:150;font-size:12px"><a class="cancellation_policy" data-toggle="modal" data-target="#myModal_{{$service->p_id}}">Important Notes</a></div>            <!-- More Video and IMage Container -->
                                        <div class="__more_container">
                                            <div class="tabs_master">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <div id="tab-img-1-{{$service->p_id}}" class="tabs_4_mna_content __current">
                                                        <div class="__fit">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->sr_no}}a.jpg" alt="" width="600" />
                                                        </div>
                                                    </div>
                                                    <!--<div id="tab-img-2" class="tabs_4_mna_content">
                                                        <div class="__fit">
                                                            <iframe src="https://www.youtube.com/embed/3cndSOTqufU" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                                        </div>
                                                    </div>-->
                                                    <div id="tab-img-3-{{$service->p_id}}" class="tabs_4_mna_content">
                                                        <div class="__fit">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}b.jpg" alt="" />
                                                        </div>
                                                    </div>
                                                    <div id="tab-img-4-{{$service->p_id}}" class="tabs_4_mna_content">
                                                        <div class="__fit">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}c.jpg" alt="" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <ul class="tabs_4_mna">
                                                        <li class="__current" data-tab="tab-img-1-{{$service->p_id}}">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}a.jpg" alt="" class="img-responsive" />
                                                        </li>
                                                        <!--<li data-tab="tab-img-2">
                                                            <img src="{{ URL::to('/') }}/images/video_thumb.png" alt="" />
                                                        </li>-->
                                                        <li data-tab="tab-img-3-{{$service->p_id}}">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}b.jpg" alt="" />
                                                        </li>
                                                        <li data-tab="tab-img-4-{{$service->p_id}}">
                                                            <img src="{{ URL::to('/') }}/images/service/{{$service->p_id}}c.jpg" alt="" />
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="__products_footer">
                                        <div class="__products_footer_icon">
                                            <ul class="__list">
                                                @if($service->buffet_meals=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/buffet.svg" alt="" width="20"> Buffet Meals</li>
                                                @endif
                                                @if($service->alcoholic_beverages=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/beverages.svg" alt="" width="20"> Alcoholic Beverages</li>
                                                @endif
                                                @if($service->non_alcoholic_beverages=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/nonalcoholic_beverages.svg" alt="" width="20"> Non Alcoholic Beverages</li>
                                                @endif
                                                @if($service->wifi=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/wifi.svg" alt="" width="20"> Wifi</li>
                                                @endif
                                                @if($service->smoking_zone=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/smoking.svg" alt="" width="20"> Smoking Zone</li>
                                                @endif
                                                @if($service->prayer_room=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/prayer_room.svg" alt="" width="20"> Prayer Room</li>
                                                @endif
                                                @if($service->sleeping_pods=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/sleeping_pods.svg" alt="" width="20"> Sleeping Pod</li>
                                                @endif
                                                @if($service->personal_assistance=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/personal_assistance.svg" alt="" width="20"> Personal Assistance</li>
                                                @endif
                                                @if($service->lounge=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/Lounge.svg" alt="" width="20"> Lounge</li>
                                                @endif
                                                @if($service->shower=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/shower.svg" alt="" width="20"> Shower</li>
                                                @endif
                                                @if($service->kids_play_area=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_area.svg" alt="" width="20"> Kids Play Area</li>
                                                @endif
                                                @if($service->porter=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/porter.svg" alt="" width="20"> Porter</li>
                                                @endif
                                                @if($service->fast_track_immigration=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/immigration.svg" alt="" width="20"> Fast track immigration</li>
                                                @endif
                                                @if($service->fast_track_security=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/fast_security.svg" alt="" width="20"> Fast track security</li>
                                                @endif
                                                @if($service->child_free_2yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_2.svg" alt="" width="20"> Child up to 2 yrs Free</li>
                                                @endif
                                                @if($service->child_free_3yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_2.svg" alt="" width="20"> Child up to 3yrs Free</li>
                                                @endif
                                                @if($service->child_free_5yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_5.svg" alt="" width="20"> Child up to 5yrs Free</li>
                                                @endif
                                                @if($service->child_free_6yrs=='Y')
                                                <li><img src="{{ URL::to('/') }}/svg/kids_under_5.svg" alt="" width="20"> Child up to 6yrs Free</li>
                                                @endif
                                            </ul>
                                        </div>
                                        <form name="" action="confirm" method="post">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type='hidden' name='service_id[]' id='service_id' value='{{$service->p_id}}'>
                                    <input type='hidden' name='departure_airport_code1' id='departure_airport_code1' value='{{$departureAirportCode}}'>
                                    <input type='hidden' name='arrival_airport_code1' id='arrival_airport_code1' value='{{$arrivalAirportCode}}'>
                                    <input type='hidden' name='departure_airport_code2' id='departure_airport_code2' value="{{isset($departureAirportCode2)?$departureAirportCode2:''}}">
                                    <input type='hidden' name='arrival_airport_code2' id='arrival_airport_code2' value="{{isset($arrivalAirportCode2)?$arrivalAirportCode2:''}}">
                                    <input type="hidden" name="change_flight" id="change_flight" value="{{$change_flight}}">
                                    <input type="hidden" name="product_id" id="product_id" value="2">
                                    <input type="hidden" name="product_type" id="product_type" value="{{$product_type}}">
                                    <input type="hidden" name="no_of_passengers" id="no_of_passengers" value="{{$no_of_passengers}}">
                                    <input type="hidden" name="mna_adult_passengers" id="mna_adult_passengers" value="{{$cal_mna_adult_passengers}}">
                                    <input type="hidden" name="mna_child_passengers" id="mna_child_passengers" value="{{$cal_mna_child_passengers}}">
                                    <input type="hidden" name="mna_child_ages" id="mna_child_ages" value="{{$mna_child_age_array}}">
                                    <input type="hidden" name="total_passengers" id="total_passengers" value="{{$total_passengers}}">
                                    <input type="hidden" name="flight_1" id="flight_1" value="{{$flight_1}}">
                                    <input type="hidden" name="airline_departure_city" id="airline_departure_city" value="{{$airline_departure_city}}">
                                    
                                    <input type="hidden" name="dep_ap_code" id="dep_ap_code" value="{{$dep_ap_code}}">
                                    <input type="hidden" name="travel_date" id="travel_date" value="{{$travel_date}}">
                                    <input type="hidden" name="airline_departure_city" id="airline_departure_city" value="{{$airline_departure_city}}">
                                    <input type="hidden" name="airline_details_departure" id="airline_details_departure" value="{{$airline_details_departure}}">
                                    <input type="hidden" name="airline_arrival_city" id="airline_arrival_city" value="{{$airline_arrival_city}}">
                                    <input type="hidden" name="airline_details_arrival" id="airline_details_arrival" value="{{$airline_details_arrival}}">
                                    <input type="hidden" name="layover_time_hrs" id="layover_time_hrs" value="{{isset($layover_time_hrs)?$layover_time_hrs:''}}">
                                    <input type="hidden" name="flight_2" id="flight_2" value="{{$flight_2 ? $flight_2 : ''}}">
                                    <input type="hidden" name="airline_arrival_city" id="airline_arrival_city" value="{{isset($airline_arrival_city) ? $airline_arrival_city : ''}}">
                                    <input type="hidden" name="airline_departure_city2" id="airline_departure_city2" value="{{isset($airline_departure_city2) ? $airline_departure_city2 : ''}}">
                                    <input type="hidden" name="travel_date2" id="travel_date2" value="{{$travel_date2 ? $travel_date2 : ''}}">
                                    <input type="hidden" name="airline_details_departure2" id="airline_details_departure2" value="{{isset($airline_details_departure2) ? $airline_details_departure2 : ''}}">
                                    
                                    <input type="hidden" name="airline_arrival_city2" id="airline_arrival_city2" value="{{isset($airline_arrival_city2)?$airline_arrival_city2:''}}">
                                    <input type="hidden" name="airline_details_arrival2" id="airline_details_arrival2" value="{{isset($airline_details_arrival2)?$airline_details_arrival2:''}}">
                                    <input type="hidden" name="arrival_terminal" id="arrival_terminal" value="{{$arrival_terminal}}">
                                    <input type="hidden" name="departure_terminal" id="departure_terminal" value="{{$departure_terminal}}">
                                    <input type="hidden" name="departure_terminal2" id="departure_terminal2" value="{{isset($departure_terminal2) ? $departure_terminal2 : ''}}">
                                    <input type="hidden" name="arrival_terminal2" id="arrival_terminal2" value="{{isset($arrival_terminal2) ? $arrival_terminal2 : ''}}">



                                <div class="__products_footer_button">
                                            <button type="submit" class="__btn mna_service_btn" id="{{$service->p_id}}">BOOK</button>
                                        </div>
                            </form>
                                    </div>
                                </div>
                    <hr class="fw" />

                            </div>
                            <div class="modal fade" id="myModal_{{$service->p_id}}" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Cancellation Policy</h4>
        </div>
        <div class="modal-body">
          <p>{!! htmlspecialchars_decode($service->important_notes) !!}</p>
        </div>
        
      </div>
      
    </div>
  </div>
                            @endif
                            @endforeach
                            @endif
                        </div>
                        @else
                            <!-- RCAV1-51 - START -->
                            <div id="errorModalForMna" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Message</h4>
                                  </div>
                                  <div class="modal-body">
                                    {!! htmlspecialchars_decode($msg) !!}
                                  </div>
                                  <div class="modal-footer">
                                    <a id="group_size_max_mna_error" class="__btn" href="{{ URL::to('/') }}">Ok</a><!-- RCAV1-53-->
                                  </div>
                                </div>
                              </div>
                            </div>
                            <!-- RCAV1-51 - END -->
                        @endif


                        
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