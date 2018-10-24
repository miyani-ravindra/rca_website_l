@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <ul class="tabs_z">
                            <li class="__current" data-tab="tab-1">
                                <embed src="{{ URL::to('/') }}/svg/ic_evisa.svg" alt="" class="ShowInMobile" width="80" />
                                <span class="__title">eVisa</span>
                                <img src="{{ URL::to('/') }}/svg/E-Visa.svg" alt="" class="HideInMobile" width="80" />
                            </li>
                            <li data-tab="tab-2" id="mna_tab">
                            <embed src="{{ URL::to('/') }}/svg/ic_m&a.svg" alt="" class="ShowInMobile" width="80" />
                                <span class="__title">
                                    <i>AIRPORT </i> MEET &amp; GREET</span>
                                <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" class="HideInMobile" width="80" />
                            </li>
                            <li data-tab="tab-3" id="lounge_tab">
                            <embed src="{{ URL::to('/') }}/svg/ic_lounge.svg" alt="" class="ShowInMobile" width="80" />
                                <span class="__title">
                                    <i>AIRPORT </i> LOUNGES</span>
                                <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" class="HideInMobile" width="80" />
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current">
                            <!-- <div class="col-md-12">
                                <a href="{{URL::to('/')}}/evisa/completeform" class="btn btn-primary">Complete Partially Filled Form</a>
                            </div> -->
                            <div class="__form_wrapper text-center">
                                <h1 class="__heading_h4 paddingtb_50 text-center lg">Sorry!!</h1>
                                <p class="__sry_txt">We currently do not provide a visa for the country you are travelling to.<br />However, we are adding multiple countries to our bucket.</p>
                                <h4>Stay tuned for more information.</h4>
                                <a href="{{URL::to('/')}}" class="btn __btn">Go Back</a>
                            </div>
                        </div>
                        <div id="tab-2" class="tabs_z_content">
                            <div class="__form_wrapper">
                                <div class="row">
                                    <form name="meetAndAssistForm" id="meetAndAssistForm" method="POST" action="Meetnassist/step2">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="product_id" value="2">
                                    <div class="col-md-4">
                                        <div class="group-radio">
                                            <input id="departure" name="mna_departure" type="checkbox" class="orbit" value="Departure" />
                                            <label for="departure">Departure</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="group-radio">
                                            <input id="Transit" name="mna_transit" type="checkbox" class="orbit" value="Transit" />
                                            <label for="Transit">Transit</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="group-radio">
                                            <input id="Arrival" name="mna_arrival" type="checkbox" class="orbit" value="Arrival" />
                                            <label for="Arrival">Arrival</label>
                                        </div>
                                    </div>
                                    <!-- RCAS-2 START -->
                                    <div class="col-md-12 __mna_home">
                                        <div class="__super_select __full">
                                            <label class="label">
                                                By Flight Number | By City
                                            </label>
                                            <div class="__icon">
                                                <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                            </div>
                                             <div class="__select_input">
                                                <select name="dropdownFlightOrCity" id="dropdownFlightOrCity" required="">
                                                    <option value="flight" selected="selected" >By Flight Number</option>
                                                    <option value="city">By City</option>
                                                </select>
                                             </div>
                                        </div>
                                    </div>
                                    <!-- RCAS-2 END -->

                                    <!-- MNA input Field -->
                                    <div class="__mna_home">
                                        <!-- RCAS-2 START -->
                                        <div class="col-md-4 countryDivHideShow">
                                            <div class="__super_select __full">
                                                <label class="label">
                                                    Country
                                                </label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                 <div class="__select_input">
                                                    <select name="dropdownCountry" id="dropdownCountry">
                                                        <option value="">Please select a Country</option>
                                                    </select>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 cityDivHideShow">
                                            <div class="__super_select __full">
                                                <label class="label">
                                                    City
                                                </label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                 <div class="__select_input">
                                                    <select name="dropdownCity" id="dropdownCity">
                                                          <option value="">Please select a Country</option>
                                                    </select>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 cityDivHideShow">
                                            <div class="__super_select __full">
                                                <label class="label">
                                                    Airport
                                                </label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                 <div class="__select_input">
                                                    <select name="dropdownAirport" id="dropdownAirport">
                                                          <option value="">Please select a Airport</option>
                                                    </select>
                                                 </div>
                                            </div>
                                        </div>
                                        <!-- RCAS-2 END -->

                                        <div class="col-md-4 flight_number_hide_show"> <!-- RCAS-2 -->
                                            <div class="__super_select __full">
                                                <label class="label">Flight Number</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                <div class="__select_input">

                                                    <input type="text" id="al_code" name="al_code" required="" placeholder="Flight Number" rel="txtTooltip" title="Example: EK 505" data-toggle="tooltip" data-placement="bottom" /> <!-- RCAS-2 Added id=al_code -->
                                                    <!--<input type="text" name="al_code" placeholder="AL-Code" class="_50" maxlength="3" />
                                                    <input type="text" placeholder="Flight No" name="flight_no" class="_50" maxlength="5" />-->

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__super_select __full">
                                                <label class="label">Travel Date</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/calendar.svg" alt="" width="16" />
                                                </div>
                                                <div class="__select_input">
                                                    <input type="text" placeholder="Date" required="" class="datepicker_mna" name="mna_travel_date" />
                                                </div>
                                                <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10" />
                                            </div>
                                        </div>
                                        

                                    
                                    <div class="__mna_home flight2_div">
                                        <!-- RCAS-2 START -->
                                        <div class="col-md-4 countryDivHideShowTwo">
                                            <div class="__super_select __full">
                                                <label class="label">
                                                    Country
                                                </label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                 <div class="__select_input">
                                                    <select name="dropdownCountryTwo" id="dropdownCountryTwo">
                                                        <option value="">Please select a Country</option>
                                                    </select>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 cityDivHideShowTwo">
                                            <div class="__super_select __full">
                                                <label class="label">
                                                    City
                                                </label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                 <div class="__select_input">
                                                    <select name="dropdownCityTwo" id="dropdownCityTwo">
                                                          <option value="">Please select a Country</option>
                                                    </select>
                                                 </div>
                                            </div>
                                        </div>
                                        <!-- RCAS-2 END -->

                                        <div class="col-md-4 flight_number_hide_show" > <!-- RCAS-2 -->
                                            <div class="__super_select __full">
                                                <label class="label">Flight Number</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                <div class="__select_input">
                                                    <input type="text" name="al_code2" placeholder="Flight Number" rel="txtTooltip" title="Example: EK 505" data-toggle="tooltip" data-placement="bottom" />
                                                    <!--<input type="text" name="al_code2" placeholder="AL-Code" class="_50" maxlength="3" />
                                                    <input type="text" placeholder="Flight No" name="flight_no2" class="_50" maxlength="5" />-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 flight_number_hide_show" > <!-- RCAS-2 -->
                                            <div class="__super_select __full">
                                                <label class="label">Travel Date</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/calendar.svg" alt="" width="16" />
                                                </div>
                                                <div class="__select_input">
                                                    <input type="text" placeholder="Date" class="datepicker_mna2" name="mna_travel_date2" />
                                                </div>
                                                <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10" />
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="__mna_home">
                                        <div class="col-md-4">
                                            <div class="__super_select __full">
                                                <label class="label">How many of you are travelling?</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__super_select __full">
                                                <label class="label">Adult</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/passenger.svg" alt="" width="20">
                                                </div>
                                                <div class="__select_input">
                                                    <select name="mna_adult_passengers">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                    </select>
                                                </div>
                                                <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__super_select __full">
                                                <label class="label">Children</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/passenger.svg" alt="" width="20">
                                                </div>
                                                <div class="__select_input">
                                                    <select name="mna_child_passengers" id="mna_child_passengers" >
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                    </select>
                                                </div>
                                                <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10">
                                            </div>
                                        </div>
                                        <div class="col-md-4  mna_child_age">
                                                    
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12 text-center">
                                            <div class="__proceed">
                                                <button class="__btn">GET DETAILS</button>
                                            </div>
                                        </div>
                                  </form>
                                </div>
                            </div>
                        </div>
                    </div>
              <!--***********************Lounge************************-->
                        <div id="tab-3" class="tabs_z_content">
                            <div class="__form_wrapper">
                                <div class="row">
                                    <form name="loungeForm" id="loungeForm" method="POST" novalidate action="Lounge/step2">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                    <input type="hidden" name="product_id" value="3">
                                    <div class="col-md-4">
                                        <div class="group-radio">
                                            <input id="departure_lounge" name="lounge_departure" type="checkbox" class="orbit" value="Departure" />
                                            <label for="departure_lounge">Departure</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="group-radio">
                                            <input id="transit_lounge" name="lounge_transit" type="checkbox" class="orbit" value="Transit" />
                                            <label for="transit_lounge">Transit</label>
                                        </div>
                                    </div>
                                    <!-- RCAS-2 START -->
                                    <div class="col-md-12 __mna_home">
                                        <div class="__super_select __full">
                                            <label class="label">
                                                By Flight Number | By City
                                            </label>
                                            <div class="__icon">
                                                <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                            </div>
                                             <div class="__select_input">
                                                <select name="dropdownFlightOrCityLounge" id="dropdownFlightOrCityLounge" required="">
                                                    <option value="flight" selected="selected" >By Flight Number</option>
                                                    <option value="city">By City</option>
                                                </select>
                                             </div>
                                        </div>
                                    </div>
                                    <!-- RCAS-2 END -->

                                    <!-- MNA input Field -->
                                    <div class="__mna_home">
                                        <!-- RCAS-2 START -->
                                        <div class="col-md-4 countryDivHideShowLounge">
                                            <div class="__super_select __full">
                                                <label class="label">
                                                    Country
                                                </label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                 <div class="__select_input">
                                                    <select name="dropdownCountryLounge" id="dropdownCountryLounge">
                                                        <option value="">Please select a Country</option>
                                                    </select>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 cityDivHideShowLounge">
                                            <div class="__super_select __full">
                                                <label class="label">
                                                    City
                                                </label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                 <div class="__select_input">
                                                    <select name="dropdownCityLounge" id="dropdownCityLounge">
                                                          <option value="">Please select a Country</option>
                                                    </select>
                                                 </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 cityDivHideShowLounge">
                                            <div class="__super_select __full">
                                                <label class="label">
                                                    Airport
                                                </label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                 <div class="__select_input">
                                                    <select name="dropdownAirportLounge" id="dropdownAirportLounge">
                                                          <option value="">Please select a Airport</option>
                                                    </select>
                                                 </div>
                                            </div>
                                        </div>
                                        <!-- RCAS-2 END -->

                                        <div class="col-md-4 flight_number_hide_show_lounge" > <!-- RCAS-2 -->
                                            <div class="__super_select __full">
                                                <label class="label">Flight Number</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                <div class="__select_input">
                                                    <input type="text" id="al_code_lng" name="al_code_lng" required="" placeholder="Flight Number" rel="txtTooltip" title="Example: EK 505" data-toggle="tooltip" data-placement="bottom" /> <!-- RCAS-2 Added id=al_code_lng -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__super_select __full">
                                                <label class="label">Travel Date</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/calendar.svg" alt="" width="16" />
                                                </div>
                                                <div class="__select_input">
                                                    <input type="text" placeholder="Date" class="datepicker_lounge" name="lounge_travel_date" />
                                                </div>
                                                <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10" />
                                            </div>
                                        </div>
                                        
                                        <div class="__mna_home flight2_div_lng">
                                            <!-- RCAS-2 START -->
                                            <div class="col-md-4 countryDivHideShowLoungeTwo">
                                                <div class="__super_select __full">
                                                    <label class="label">
                                                        Country
                                                    </label>
                                                    <div class="__icon">
                                                        <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                    </div>
                                                     <div class="__select_input">
                                                        <select name="dropdownCountryLoungeTwo" id="dropdownCountryLoungeTwo">
                                                            <option value="">Please select a Country</option>
                                                        </select>
                                                     </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 cityDivHideShowLoungeTwo">
                                                <div class="__super_select __full">
                                                    <label class="label">
                                                        City
                                                    </label>
                                                    <div class="__icon">
                                                        <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                    </div>
                                                     <div class="__select_input">
                                                        <select name="dropdownCityLoungeTwo" id="dropdownCityLoungeTwo">
                                                              <option value="">Please select a Country</option>
                                                        </select>
                                                     </div>
                                                </div>
                                            </div>
                                            <!-- RCAS-2 END -->    

                                        <div class="col-md-4 flight_number_hide_show_lounge"> <!-- RCAS-2 -->
                                            <div class="__super_select __full">
                                                <label class="label">Flight Number</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="16" />
                                                </div>
                                                <div class="__select_input">
                                                    <input type="text" name="al_code2_lng" placeholder="Flight Number" rel="txtTooltip" title="Example: EK 505" data-toggle="tooltip" data-placement="bottom" required="" />
                                                    <!--<input type="text" name="al_code2" placeholder="AL-Code" class="_50" maxlength="3" />
                                                    <input type="text" placeholder="Flight No" name="flight_no2" class="_50" maxlength="5" />-->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 flight_number_hide_show_lounge"> <!-- RCAS-2 -->
                                            <div class="__super_select __full">
                                                <label class="label">Travel Date</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/calendar.svg" alt="" width="16" />
                                                </div>
                                                <div class="__select_input">
                                                    <input type="text" placeholder="Date" class="datepicker_lounge2" name="lng_travel_date2" />
                                                </div>
                                                <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10" />
                                            </div>
                                        </div>
                                        <!--<div class="col-md-4">
                                            <div class="__super_select __full">
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/passenger.svg" alt="" width="20">
                                                </div>
                                                <div class="__select_input">
                                                    <select name="mna_no_of_passengers2">
                                                        <option selected="true" disabled="disabled">No. of Passengers</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10">
                                            </div>
                                        </div>-->
                                        
                                    </div>
                                    <div class="__mna_home">
                                        <div class="col-md-4">
                                            <div class="__super_select __full">
                                                <label class="label">How many of you are travelling?</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__super_select __full">
                                                <label class="label">Adult</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/passenger.svg" alt="" width="20">
                                                </div>
                                                <div class="__select_input">
                                                    <select name="lounge_adult_passengers">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                    </select>
                                                </div>
                                                <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__super_select __full">
                                                <label class="label">Children</label>
                                                <div class="__icon">
                                                    <img src="{{ URL::to('/') }}/svg/passenger.svg" alt="" width="20">
                                                </div>
                                                <div class="__select_input">
                                                    <select name="lounge_child_passengers" id="lounge_child_passengers">
                                                        <option value="0">0</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                    </select>
                                                </div>
                                                <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10">
                                            </div>
                                        </div>
                                        <div class="col-md-4  lounge_child_age">
                                                    
                                        </div>
                                        
                                    </div>
                                        <div class="col-md-12 text-center">
                                            <div class="__proceed">
                                                <input type="submit" class="__btn" name="subit_lounge" value="GET DETAILS">
                                                <!--<button class="__btn">GET DETAILS</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="__countries_box" id="evisa-tb" style="display: block;">
                        <h4>We offer e-visa services to the following countries</h4>
                        <div class="col-md-2 col-md-offset-1">
                            <h4 class="__sm">FOR UK &amp; US CITIZENS</h4>
                            <ul class="__country_list">
                                <li>
                                    <img src="{{ URL::to('/') }}/svg/india.svg" alt="" width="70">
                                    <span>INDIA</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <h4 class="__sm">FOR INDIAN CITIZENS</h4>
                            <ul class="__country_list _bdr_left">
                                <li>
                                    <img src="{{ URL::to('/') }}/svg/cambodia.svg" alt="" width="70">
                                    <span>CAMBODIA</span>
                                </li>
                                <li>
                                    <img src="{{ URL::to('/') }}/svg/hong-kong.svg" alt="" width="70">
                                    <span>HONG KONG</span>
                                </li>
                                <li>
                                    <img src="{{ URL::to('/') }}/svg/malaysia.svg" alt="" width="70">
                                    <span>MALAYSIA</span>
                                </li>
                                <li>
                                    <img src="{{ URL::to('/') }}/svg/oman.svg" alt="" width="70">
                                    <span>OMAN</span>
                                </li>
                                <li>
                                    <img src="{{ URL::to('/') }}/svg/sri-lanka.svg" alt="" width="70">
                                    <span>SRI LANKA</span>
                                </li>
                                <li>
                                    <img src="{{ URL::to('/') }}/svg/turkey.svg" alt="" width="70">
                                    <span>TURKEY</span>
                                </li>
                                <li>
                                    <img src="{{ URL::to('/') }}/svg/vietnam.svg" alt="" width="70">
                                    <span>VIETNAM</span>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <h4>We are adding more countries every month.</h4>
                    </div>
                    <div class="__countries_box" id="mna-tb">
                        <h4>We offer Airport Meet &amp; Greet services to the following airports</h4>
                        <div class="col-md-12">
                            <ul class="__country_list">
                                <li>
                                    <h6 class="__airport_circle">BOM</h6>
                                    <span>Mumbai</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">CDG</h6>
                                    <span>Paris</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">ORY</h6>
                                    <span>Paris</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">FCO</h6>
                                    <span>Rome</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">MUC</h6>
                                    <span>Munich</span>
                                </li>
                                <!-- RCAV1-69 - START -->
                                <li>
                                    <h6 class="__airport_circle">SIN</h6>
                                    <span>Singapore</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">HKG</h6>
                                    <span>Hong Kong</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">LHR</h6>
                                    <span>London</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">KUL</h6>
                                    <span>Kuala Lumpur</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">KCH</h6>
                                    <span>Kuching</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">BKI</h6>
                                    <span>Kota Kinabalu</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">PEN</h6>
                                    <span>Penang</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">PNH</h6>
                                    <span>Phnom Penh</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">REP</h6>
                                    <span>Siem Reap</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">CGK</h6>
                                    <span>Jakarta</span>
                                </li>
                                <!-- RCAV1-69 - END -->
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <h4>We are adding more airports every month.</h4>
                    </div>
                    <div class="__countries_box" id="lounge-tb">
                        <h4>We offer Airport Lounges to the following airports</h4>
                        <div class="col-md-12">
                            <ul class="__country_list">
                                <li>
                                    <h6 class="__airport_circle">BOM</h6>
                                    <span>Mumbai</span>
                                </li>
                                 <!-- RCAV1-69 - START -->
                                 <li>
                                    <h6 class="__airport_circle">SIN</h6>
                                    <span>Singapore</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">KUL</h6>
                                    <span>Kuala Lumpur</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">KCH</h6>
                                    <span>Kuching</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">BKI</h6>
                                    <span>Kota Kinabalu</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">PEN</h6>
                                    <span>Penang</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">PNH</h6>
                                    <span>Phnom Penh</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">REP</h6>
                                    <span>Siem Reap</span>
                                </li>
                                <li>
                                    <h6 class="__airport_circle">CGK</h6>
                                    <span>Jakarta</span>
                                </li>
                                <!-- RCAV1-69 - END -->
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                        <h4>We are adding more airports every month.</h4>
                    </div>
                </div>
            </div>
        </div>
    </div></div>
    <!-- Top bg End -->
@include('layouts.middle_footer')     
@stop
