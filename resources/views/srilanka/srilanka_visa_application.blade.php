@extends('layouts.layout')
@section('content')
<div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <ul class="tabs_z">
                            <li class="__current">
                                <span class="__title">eVisa</span>
                                <img src="{{ URL::to('/') }}/svg/E-visa.svg" alt="" width="100" />
                            </li>
                            <li>
                                <a href="meet-and-assist.html">
                                    <span class="__title">AIRPORT MEET &amp; GREET</span>
                                    <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li>
                                <a href="lounge.html">
                                    <span class="__title">AIRPORT LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current __width100">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading">eVisa</h1>
                                    <div class="__progress_wrapper">
                                        <ul class="__progress">
                                            <li class="active _100">Form Filling</li>
                                            <li class="">Verification</li>
                                            <li class="">Payment</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-12 marginb_30">
                                        <h4 class="__stylish_head text-center">We are ready to fill the form.</h4>
                                    </div>
                                </div>
                                <!-- UpForm -->
    <div class="__typ_wrapper">
        <div class="__typ_container">
            <div class="__typ_form">
                <div class="upform">
                    <form method="post" name="CustomTypeFormForSrilanka" id="CustomTypeFormForSrilanka" novalidate action="{{URL::to('/')}}/srilanka-form/to/{{$ccode}}">
                        <input type="hidden" name="nationality" value="{{$getpostdata['nationality']}}">
                        <input type="hidden" name="terms" value="{{$getpostdata['terms']}}">
                        <div class="upform-header"></div>
                        <div class="upform-main parent-counter upform-main-srilanka">
                            <div class="input-block">
                                <div class="labels block-counter"> Select travel type <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="travel_type_text" id="travel_type_text" class="__select_drop inputF" autocomplete="off">
                                    <ul class="hiddenul">
                                        <li class="hidden_li travel_type_data" data-val="tourist">Tourist</li>
                                        <li class="hidden_li travel_type_data" data-val="business">Business</li>
                                        <li class="hidden_li travel_type_data" data-val="transit">Transit</li>
                                    </ul>
                                    <input type="hidden" id="travel_type" name="travel_type" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels block-counter"> Title. <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="salutation_text" class="__select_drop inputF" autocomplete="off">
                                    <ul class="hiddenul">
                                        <li class="hidden_li" data-val="dr">DR</li>
                                        <li class="hidden_li" data-val="master">MASTER</li>
                                        <li class="hidden_li" data-val="miss">MISS</li>
                                        <li class="hidden_li" data-val="mr">MR</li>
                                        <li class="hidden_li" data-val="mrs">MRS</li>
                                        <li class="hidden_li" data-val="ms">MS</li>
                                        <li class="hidden_li" data-val="rev">REV</li>
                                    </ul>
                                    <input type="hidden" id="salutation" name="salutation" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block active">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Enter given name as per the passport. <span class="strike">*</span>
                                    <!-- <div class="qs_sub">Also Known as Given Name.</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="passport_given_name" id="passport_given_name" required="" />
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Enter surname name as per the passport. <span class="strike">*</span>
                                    <!-- <div class="qs_sub">Also Known as Given Name.</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="passport_surname_name" id="passport_surname_name" required="" />
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div> 
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Hey <span id="passport_mapping"></span>, enter your valid passport number <span class="strike">*</span>
                                    <!-- <div class="qs_sub">Something like A00000000</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="passport_number" id="passport_number" required="">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block select_block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Date of issue <span class="strike">*</span>
                                    <div class="qs_sub">DD/MM/YYYY</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="type_doi_srilanka" id="type_doi_srilanka" class="datepicker" />
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block select_block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Date of expiry <span class="strike">*</span>
                                    <div class="qs_sub">DD/MM/YYYY</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="type_doe_srilanka" id="type_doe_srilanka" class="datepicker" />
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels block-counter"> Gender <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="gender_text" class="__select_drop inputF" autocomplete="off">
                                    <ul class="hiddenul">
                                        <li class="hidden_li" data-val="male">Male</li>
                                        <li class="hidden_li" data-val="female">Female</li>
                                    </ul>
                                    <input type="hidden" id="gender" name="gender" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels block-counter"> Nationality. <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="nationality_dropdown_text" class="__select_drop inputF" autocomplete="off">
                                    <ul class="hiddenul">
                                        @if(count($country_arr)>0)
                                            @foreach($country_arr as $val)
                                                <li class="hidden_li" data-val="{{$val}}">{{$val}}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <input type="hidden" id="nationality_dropdown" name="nationality_dropdown" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels block-counter"> Country of Birth. <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="country_of_birth_text" class="__select_drop inputF" autocomplete="off">
                                    <ul class="hiddenul">
                                        @if(count($country_arr)>0)
                                            @foreach($country_arr as $val)
                                               <li class="hidden_li" data-val="{{$val}}">{{$val}}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <input type="hidden" id="country_of_birth" name="country_of_birth" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block select_block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Occupation.</div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="occupation" id="occupation">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>

                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Date of Birth <span class="strike">*</span>
                                    <div class="qs_sub">DD/MM/YYYY</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="date" name="type_dob_srilanka" id="type_dob_srilanka" class="datepicker" />
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>

                            <!-- <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Is there any child information on your passport? <span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="alias_is" class="radio inline">
                                        <input type="radio" id="alias_is" name="alias_is" value="Y">
                                        <span> Yes </span>
                                    </label>
                                    <label for="alias_is" class="radio inline">
                                        <input type="radio" id="alias_is" name="alias_is" value="N">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div> -->
                            <!-- <div class="form-group fieldGroup" style="display: none;">
                                <span id="child_div_msg"></span>
                                <a href="javascript:void(0);" class="btn child_add_button" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                <div class="input-block active alias_is">
                                        <div class="labels">
                                            <div class="qs_list block-counter"></div>
                                            <div class="qs_body">Enter given name of child. <span class="strike">*</span>
                                            </div>
                                        </div>
                                        <div class="input-control">
                                            <input type="text" name="child_given_name[]" id="child_given_name" class="child-input-class" disabled="" />
                                            <div class="press_enter">PRESS ENTER</div>
                                        </div>
                                    </div>
                                <div class="input-block active alias_is">
                                    <div class="labels">
                                        <div class="qs_list block-counter"></div>
                                        <div class="qs_body">Enter surname name of child. <span class="strike">*</span>
                                        </div>
                                    </div>
                                    <div class="input-control">
                                        <input type="text" name="child_surname_name[]" id="child_surname_name" class="child-input-class" disabled="" />
                                        <div class="press_enter">PRESS ENTER</div>
                                    </div>
                                </div>
                                <div class="input-block alias_is">
                                    <div class="labels">
                                        <div class="qs_list block-counter"></div>
                                        <div class="qs_body">Child Date of Birth <span class="strike">*</span>
                                        <div class="qs_sub">DD/MM/YYYY</div>
                                        </div>
                                    </div>
                                    <div class="input-control">
                                        <input type="text" name="child_type_dob_srilanka[]" id="child_type_dob_srilanka" class="datepicker child_type_dob_datepicker_default child-input-class" disabled="" />
                                        <div class="press_enter">PRESS ENTER</div>
                                    </div>
                                </div>
                                <div class="input-block alias_is">
                                    <div class="labels block-counter"> Child Gender <span class="strike">*</span></div>
                                    <div class="input-control outerInFoc">
                                        <input type="text" placeholder="Select an option" name="child_gender_text[]" class="__select_drop inputF child-input-class" autocomplete="off" disabled="">
                                        <ul class="hiddenul">
                                            <li class="hidden_li" data-val="male">Male</li>
                                            <li class="hidden_li" data-val="female">Female</li>
                                        </ul>
                                        <input type="hidden" id="child_gender" name="child_gender[]" class="inputH">
                                        <div class="press_enter">PRESS TAB</div>
                                    </div>
                                    <div class="outerclick"></div>
                                </div>
                                <div class="input-block alias_is">
                                    <div class="labels block-counter"> Relationship <span class="strike">*</span></div>
                                    <div class="input-control outerInFoc">
                                        <input type="text" placeholder="Select an option" name="child_relation_text[]" class="__select_drop inputF child-input-class" autocomplete="off" disabled="">
                                        <ul class="hiddenul">
                                            <li class="hidden_li" data-val="child">Child</li>
                                        </ul>
                                        <input type="hidden" id="child_relation" name="child_relation[]" class="inputH">
                                        <div class="press_enter">PRESS TAB</div>
                                    </div>
                                    <div class="outerclick"></div>
                                </div>
                            </div> -->
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Intended Arrival Date <span class="strike">*</span>
                                    <div class="qs_sub">DD/MM/YYYY</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="date" name="arrival_date" id="arrival_date_srilanka" class="datepicker" />
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Port of Departure</div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="port_of_departure" id="port_of_departure">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Airline/Vessel</div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="airline_vessel" id="airline_vessel">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Flight/Vessel Number</div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="flight_vessel_number" id="flight_vessel_number">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block tourist"> <!-- this purpose of visit is for Tourist travellers -->
                                <div class="labels block-counter"> Purpose of Visit <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="purpose_of_visit_text_tourist" class="__select_drop inputF" autocomplete="off">
                                    <ul class="hiddenul">
                                        <li class="hidden_li" data-val="medical_treatment">Medical treatment including Ayurvedic (herbal)</li>
                                        <li class="hidden_li" data-val="sport_cultural_events">Participate in sporting event, competitions and activities relating to cultural performances</li>
                                        <li class="hidden_li" data-val="sightseeing_holidaying">Sightseeing or Holidaying</li>
                                        <li class="hidden_li" data-val="visiting_friends_relatives">Visiting friends and relatives</li>
                                    </ul>
                                    <input type="hidden" id="purpose_of_visit" name="purpose_of_visit" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block business"> <!-- this purpose of visit is for Business travellers -->
                                <div class="labels block-counter"> Purpose of Visit <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="purpose_of_visit_text_business" class="__select_drop inputF" autocomplete="off">
                                    <ul class="hiddenul">
                                        <li class="hidden_li" data-val="conference_workshop_seminars">Conferences, workshop and seminars</li>
                                        <li class="hidden_li" data-val="art_music_dance_events">Participate in art, music and dance events</li>
                                        <li class="hidden_li" data-val="business_meetings_negotiations">Participate in business meetings and negotiations</li>
                                        <li class="hidden_li" data-val="religious_events">Participate in religious events</li>
                                        <li class="hidden_li" data-val="syposium">Participate in syposium</li>
                                        <li class="hidden_li" data-val="short_term_training_programs">Short term training programs</li>
                                    </ul>
                                    <input type="hidden" id="purpose_of_visit" name="purpose_of_visit" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block active business"> <!-- Purpose description is required only for Business type. -->
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Purpose Description<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="purpose_description" id="purpose_description" />
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>

                            <div class="input-block transit"> <!-- this purpose of visit is for Transit travellers -->
                                <div class="labels block-counter"> Purpose of Visit <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="purpose_of_visit_text_transit" class="__select_drop inputF" autocomplete="off">
                                    <ul class="hiddenul">
                                        <li class="hidden_li" data-val="transiting_through_srilanka">Transiting through Sri Lanka</li>
                                    </ul>
                                    <input type="hidden" id="purpose_of_visit" name="purpose_of_visit" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block transit"> <!-- Intended stay in days is only for Transit -->
                                <div class="labels block-counter"> Intended stay in days <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="intended_stay_days_text" class="__select_drop inputF" autocomplete="off">
                                    <ul class="hiddenul">
                                        <li class="hidden_li" data-val="day_one">1 Days</li>
                                        <li class="hidden_li" data-val="day_two">2 Days</li>
                                    </ul>
                                    <input type="hidden" id="intended_stay_days" name="intended_stay_days" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block active transit"> <!-- Final Destination is required only for Transit type. -->
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Final Destination<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="final_destination" id="final_destination" />
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>

                            <!-- Address details for All START -->
                            <div class="input-block contact-div"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Address Line 1<span class="strike">*</span>
                                        <!-- <div class="qs_sub">Contact Details</div> -->   
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="address_line_one_tourist" id="address_line_one_tourist" />
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block contact-div"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Address Line 2 
                                        <!-- <div class="qs_sub">Contact Details</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="address_line_two_tourist" id="address_line_two_tourist">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block contact-div"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">City<span class="strike">*</span>
                                        <!-- <div class="qs_sub">Contact Details</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="city_tourist" id="city_tourist">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block contact-div"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">State<span class="strike">*</span>
                                        <!-- <div class="qs_sub">Contact Details</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="state_tourist" id="state_tourist">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block contact-div"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Zip/Postal Code
                                        <!-- <div class="qs_sub">Contact Details</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" class="" name="zipcode_tourist" id="zipcode_tourist">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block contact-div"> 
                                <div class="labels block-counter"> Country <span class="strike">*</span>
                                    <!-- <div class="qs_sub">Contact Details</div> -->
                                </div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="country_tourist_text" class="__select_drop inputF" autocomplete="off">
                                    <ul class="hiddenul">
                                        @if(count($country_arr)>0)
                                            @foreach($country_arr as $val)
                                                <li class="hidden_li" data-val="{{$val}}">{{$val}}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <input type="hidden" id="country_tourist" name="country_tourist" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block contact-div"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Address in Sri Lanka<span class="strike">*</span><!-- <div class="qs_sub">Contact Details</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="address_line_in_srilanka_tourist" id="address_line_in_srilanka_tourist">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>                            
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Email Address <span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="email" name="email_id" id="email_id">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block contact-div">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Telephone Number<span class="strike">*</span>
                                        <!-- <div class="qs_sub">Contact Details</div> -->
                                    </div>
                                </div>
                                <div class="input-control tele_plus">
                                    <input type="tel" name="telephone_number_tourist" class="only_number" id="telephone_number_tourist" maxlength="12">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block contact-div">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Mobile Number
                                        <!-- <div class="qs_sub">Contact Details</div> -->
                                    </div>
                                </div>
                                <div class="input-control tele_plus">
                                    <input type="tel" name="mobile_number_tourist" class="only_number" id="mobile_number_tourist" maxlength="12">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block contact-div"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Fax Number
                                        <!-- <div class="qs_sub">Contact Details</div> -->
                                    </div>
                                </div>
                                <div class="input-control tele_plus">
                                    <input type="tel" class="only_number" name="fax_number_tourist" id="fax_number_tourist">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <!-- Address details for All END -->

                            <!-- Contatct details of the applicants company for Business START -->
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Company Name<div class="qs_sub">Contact Details of the Applicant's Company</div></div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="applicant_company_name_business" id="applicant_company_name_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Applicant Address Line 1<div class="qs_sub">Contact Details of the Applicant's Company</div></div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="applicant_address_line_one_business" id="applicant_address_line_one_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Applicant Address Line 2<div class="qs_sub">Contact Details of the Applicant's Company</div></div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="applicant_address_line_two_business" id="applicant_address_line_two_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">City<div class="qs_sub">Contact Details of the Applicant's Company</div></div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="applicant_city_business" id="applicant_city_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">State<div class="qs_sub">Contact Details of the Applicant's Company</div></div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="applicant_state_business" id="applicant_state_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Zip/Postal Code<div class="qs_sub">Contact Details of the Applicant's Company</div></div>
                                </div>
                                <div class="input-control">
                                    <input type="text" class="only_number" name="applicant_zipcode_business" id="applicant_zipcode_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block business">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Country<div class="qs_sub">Contact Details of the Applicant's Company</div></div>
                                </div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="applicant_country_business_text" class="__select_drop inputF" autocomplete="off">
                                    <ul class="hiddenul">
                                        @if(count($country_arr)>0)
                                            @foreach($country_arr as $val)
                                                <li class="hidden_li" data-val="{{$val}}">{{$val}}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <input type="hidden" id="applicant_country_business" name="applicant_country_business" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block business">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Telephone Number<span class="strike">*</span>
                                        <div class="qs_sub">Contact Details of the Applicant's Company</div>
                                    </div>
                                </div>
                                <div class="input-control tele_plus">
                                    <input type="tel" name="applicant_telephone_number_business" class="only_number" id="applicant_telephone_number_business" maxlength="12">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block business">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Mobile Number<div class="qs_sub">Contact Details of the Applicant's Company</div></div>
                                </div>
                                <div class="input-control tele_plus">
                                    <input type="tel" name="applicant_mobile_number_business" class="only_number" id="applicant_mobile_number_business" maxlength="12">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Fax Number<div class="qs_sub">Contact Details of the Applicant's Company</div></div>
                                </div>
                                <div class="input-control tele_plus">
                                    <input type="text" name="applicant_fax_number_business" id="applicant_fax_number_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block business">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Applicant's Company Email Address <span class="strike">*</span><div class="qs_sub">Contact Details of the Applicant's Company</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="email" name="applicant_email_id_business" id="applicant_email_id_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <!-- Contatct details of the applicants company for Business END -->
                            
                            <!-- Contatct details of the applicants Srilankan company for Business START -->
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Company Name<span class="strike">*</span><div class="qs_sub">Contact Details of the Sri Lankan Company</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="srilankan_company_name_business" id="srilankan_company_name_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Applicant Address Line 1<span class="strike">*</span><div class="qs_sub">Contact Details of the Sri Lankan Company</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="srilankan_address_line_one_business" id="srilankan_address_line_one_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Applicant Address Line 2</div><div class="qs_sub">Contact Details of the Sri Lankan Company</div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="srilankan_address_line_two_business" id="srilankan_address_line_two_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">City<span class="strike">*</span><div class="qs_sub">Contact Details of the Sri Lankan Company</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="srilankan_city_business" id="srilankan_city_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">State<div class="qs_sub">Contact Details of the Sri Lankan Company</div></div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="srilankan_state_business" id="srilankan_state_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Zip/Postal Code<div class="qs_sub">Contact Details of the Sri Lankan Company</div></div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="srilankan_zipcode_business" id="srilankan_zipcode_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block business">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Telephone Number<span class="strike">*</span>
                                        <div class="qs_sub">Contact Details of the Sri Lankan Company</div>
                                    </div>
                                </div>
                                <div class="input-control tele_plus">
                                    <input type="tel" name="srilankan_telephone_number_business" class="only_number" id="srilankan_telephone_number_business" maxlength="12">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block business">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Mobile Number<div class="qs_sub">Contact Details of the Sri Lankan Company</div></div>
                                </div>
                                <div class="input-control tele_plus">
                                    <input type="tel" name="srilankan_mobile_number_business" class="only_number" id="srilankan_mobile_number_business" maxlength="12">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block active business"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Fax Number<div class="qs_sub">Contact Details of the Sri Lankan Company</div></div>
                                </div>
                                <div class="input-control tele_plus">
                                    <input type="text" name="srilankan_fax_number_business" id="srilankan_fax_number_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <div class="input-block business">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Sri Lankan Company Email Address<div class="qs_sub">Contact Details of the Sri Lankan Company</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="email" name="srilankan_email_id_business" id="srilankan_email_id_business">
                                    <div class="press_enter">PRESS ENTER</div>
                                </div>
                            </div>
                            <!-- Contatct details of the applicants Srilankan company for Business END -->

                             <!-- Declaration details for Tourist START -->
                            <div class="input-block tourist">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Do you have a valid residence visa to Sri Lanka?<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_valid_resident_visa_to_srilanka_tourist" class="radio inline">
                                        <input type="radio" id="is_valid_resident_visa_to_srilanka_tourist" name="is_valid_resident_visa_to_srilanka_tourist" value="Y">
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_valid_resident_visa_to_srilanka_tourist" class="radio inline">
                                        <input type="radio" id="is_valid_resident_visa_to_srilanka_tourist" name="is_valid_resident_visa_to_srilanka_tourist" value="N">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                            <div class="input-block tourist">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Are you currently in Sri Lanka with a valid ETA or obtained an extension of visa?<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_currently_in_srilanka_with_valid_eta_tourist" class="radio inline">
                                        <input type="radio" id="is_currently_in_srilanka_with_valid_eta_tourist" name="is_currently_in_srilanka_with_valid_eta_tourist" value="Y">
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_currently_in_srilanka_with_valid_eta_tourist" class="radio inline">
                                        <input type="radio" id="is_currently_in_srilanka_with_valid_eta_tourist" name="is_currently_in_srilanka_with_valid_eta_tourist" value="N">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                            <div class="input-block tourist">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Do you have a multiple entry visa to Sri Lanka?<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="have_multiple_entry_visa_to_srilanka_tourist" class="radio inline">
                                        <input type="radio" id="have_multiple_entry_visa_to_srilanka_tourist" name="have_multiple_entry_visa_to_srilanka_tourist" value="Y">
                                        <span> Yes </span>
                                    </label>
                                    <label for="have_multiple_entry_visa_to_srilanka_tourist" class="radio inline">
                                        <input type="radio" id="have_multiple_entry_visa_to_srilanka_tourist" name="have_multiple_entry_visa_to_srilanka_tourist" value="N">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                            <!-- Declaration details for Business START -->
                            <div class="input-block business">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Do you have a valid residence visa to Sri Lanka?<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_valid_resident_visa_to_srilanka_business" class="radio inline">
                                        <input type="radio" id="is_valid_resident_visa_to_srilanka_business" name="is_valid_resident_visa_to_srilanka_business" value="Y">
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_valid_resident_visa_to_srilanka_business" class="radio inline">
                                        <input type="radio" id="is_valid_resident_visa_to_srilanka_business" name="is_valid_resident_visa_to_srilanka_business" value="N">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                            <div class="input-block business">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Do you have a multiple entry visa to Sri Lanka?<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="have_multiple_entry_visa_to_srilanka_business" class="radio inline">
                                        <input type="radio" id="have_multiple_entry_visa_to_srilanka_business" name="have_multiple_entry_visa_to_srilanka_business" value="Y">
                                        <span> Yes </span>
                                    </label>
                                    <label for="have_multiple_entry_visa_to_srilanka_business" class="radio inline">
                                        <input type="radio" id="have_multiple_entry_visa_to_srilanka_business" name="have_multiple_entry_visa_to_srilanka_business" value="N">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                            <div class="input-block business">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Are you currently in Sri Lanka with a valid ETA or obtained an extension of visa?<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_currently_in_srilanka_with_valid_eta_business" class="radio inline">
                                        <input type="radio" id="is_currently_in_srilanka_with_valid_eta_business" name="is_currently_in_srilanka_with_valid_eta_business" value="Y">
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_currently_in_srilanka_with_valid_eta_business" class="radio inline">
                                        <input type="radio" id="is_currently_in_srilanka_with_valid_eta_business" name="is_currently_in_srilanka_with_valid_eta_business" value="N">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- Declaration details for Transit START -->
                            <div class="input-block transit">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Do you have a valid residence visa to Sri Lanka?<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_valid_resident_visa_to_srilanka_transit" class="radio inline">
                                        <input type="radio" id="is_valid_resident_visa_to_srilanka_transit" name="is_valid_resident_visa_to_srilanka_transit" value="Y">
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_valid_resident_visa_to_srilanka_transit" class="radio inline">
                                        <input type="radio" id="is_valid_resident_visa_to_srilanka_transit" name="is_valid_resident_visa_to_srilanka_transit" value="N">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                            <div class="input-block transit">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Do you have a multiple entry visa to Sri Lanka?<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="have_multiple_entry_visa_to_srilanka_transit" class="radio inline">
                                        <input type="radio" id="have_multiple_entry_visa_to_srilanka_transit" name="have_multiple_entry_visa_to_srilanka_transit" value="Y">
                                        <span> Yes </span>
                                    </label>
                                    <label for="have_multiple_entry_visa_to_srilanka_transit" class="radio inline">
                                        <input type="radio" id="have_multiple_entry_visa_to_srilanka_transit" name="have_multiple_entry_visa_to_srilanka_transit" value="N">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                            <div class="input-block transit">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Are you currently in Sri Lanka and possess an ETA?<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_currently_in_srilanka_with_valid_eta_transit" class="radio inline">
                                        <input type="radio" id="is_currently_in_srilanka_with_valid_eta_transit" name="is_currently_in_srilanka_with_valid_eta_transit" value="Y">
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_currently_in_srilanka_with_valid_eta_transit" class="radio inline">
                                        <input type="radio" id="is_currently_in_srilanka_with_valid_eta_transit" name="is_currently_in_srilanka_with_valid_eta_transit" value="N">
                                        <span>No</span>
                                    </label>
                                </div>
                            </div>
                            <div class="input-block active"> 
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Declaration<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="col-md-12 terms_padding">
                                    <input type="checkbox" name="i_agree_terms" id="i_agree_terms" value="yes">  I would like to confirm the above information is correct.
                                </div>
                            </div>
                            <!-- Declaration details for Transit END -->
                            <input type="hidden" id="arrival_date_text" value="" class="datepicker" />
                        </div>
                        <div class="text-center paddingtb_60">
                            <input type="submit" id="srilanka_submit" class="__ty_submit" value="SUBMIT">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- UpForm End -->
                                <!-- row end -->
                            </div>
                            <!-- Form wrapper -->
                        </div>
                        <!-- Tab Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.middle_footer')     
@stop
