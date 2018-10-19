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
                <div id="save_form_msg" style="display: none;"></div>
                <!-- <div class="__ty_landing">
                    <div class="__heading">
                        <img src="{{URL::to('/')}}/images/hongkong.svg" alt="" width="100" height="100" />
                        <h2>Hong Kong eVisa.</h2>
                    </div>
                    <div class="__ty_land_body">
                        <p>Let us help you fill this easy form <br>so you can take off happily</p>
                        <img src="{{URL::to('/')}}/images/enter_plane.svg" alt="" width="80" height="80" class="plane_trigger" />
                        <input type="hidden" id="start_form" value="" />
                    </div>
                </div> -->
                <div class="upform">
                    <form method="post" name="CustomTypeForm" id="CustomTypeForm" novalidate="novalidate" action="{{URL::to('/')}}/formreview/to/{{$ccode}}">
                        <input type="hidden" name="nationality" value="{{$getpostdata['nationality']}}">
                        <input type="hidden" name="visa_type" value="HKSAR">
                        <input type="hidden" name="order_id" value="{{!empty($getpostdata['order_id'])?$getpostdata['order_id']:NULL}}">
                        <input type="hidden" name="uid" value="{{!empty($getpostdata['uid'])?$getpostdata['uid']:NULL}}">
                        <input type="hidden" name="order_code" value="{{!empty($getpostdata['order_code'])?$getpostdata['order_code']:NULL}}">
                        <input type="hidden" name="ccode" id="ccode" value="{{$ccode}}">
                        <div class="upform-header"></div>
                        <div class="upform-main parent-counter">
                            <div class="input-block active">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Enter given name as per the passport. <span class="strike">*</span>
                                    <!-- <div class="qs_sub">Also Known as Given Name.</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="passport_given_name" id="passport_given_name" required="" value="{{!empty($getpostdata['username'])?$getpostdata['username']:NULL}}" />
                                    <div class="press_enter">PRESS TAB</div>
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
                                    <input type="text" name="passport_surname_name" id="passport_surname_name" required="" value="{{!empty($getpostdata['surname'])?$getpostdata['surname']:NULL}}" />
                                    <div class="press_enter">PRESS TAB</div>
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
                                    <input type="text" name="passport_number" id="passport_number" required="" value="{{!empty($getpostdata['pp_no'])?$getpostdata['pp_no']:NULL}}">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Hey <span id="passport_mapping"></span>, enter place of issue of passport <span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="place_of_issue" id="place_of_issue" value="{{!empty($getpostdata['pp_place_of_issue'])?$getpostdata['pp_place_of_issue']:NULL}}" required="" >
                                    <div class="press_enter">PRESS TAB</div>
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
                                    <input type="text" name="type_doi" id="type_doi" class="datepicker" required="" value="{{!empty($getpostdata['pp_issue_date'])?$getpostdata['pp_issue_date']:NULL}}" />
                                    <div class="press_enter">PRESS TAB</div>
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
                                    <input type="text" name="type_doe" id="type_doe" class="datepicker" required="" value="{{!empty($getpostdata['pp_expiry_date'])?$getpostdata['pp_expiry_date']:NULL}}" />
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Is there any alias in English on your passport? <span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="alias_is" class="radio inline">
                                        <input type="radio" id="alias_is_1" name="alias_is" value="Y" {{(!empty($getpostdata['application_details']['alias_is']) && $getpostdata['application_details']['alias_is']=="Y")?"checked":NULL}} >
                                        <span> Yes </span>
                                    </label>
                                    <label for="alias_is" class="radio inline">
                                        <input type="radio" id="alias_is_2" name="alias_is" value="N" {{(!empty($getpostdata['application_details']['alias_is']) && $getpostdata['application_details']['alias_is']=="N")?"checked":NULL}} >
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['alias_is']) && ($getpostdata['application_details']['alias_is']=='Y'))?'divshow':'divhide'}}" id="div_child_1">
                                    <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Alias given name in English (as shown on passport, if any) <span class="strike">*</span>
                                    <!-- <div class="qs_sub">Also Known as Given Name.</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="alias_given_name" id="alias_given_name" value="{{!empty($getpostdata['application_details']['alias_given_name'])?$getpostdata['application_details']['alias_given_name']:NULL}}" />
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['alias_is']) && ($getpostdata['application_details']['alias_is']=='Y'))?'divshow':'divhide'}}" id="div_child_2">
                                <div class="labels">
                                        <div class="qs_list block-counter"></div>
                                        <div class="qs_body">Alias surname in English (as shown on passport, if any) <span class="strike">*</span>
                                        <!-- <div class="qs_sub">Also Known as Given Name.</div> -->
                                        </div>
                                    </div>
                                    <div class="input-control">
                                        <input type="text" name="alias_surname_name" id="alias_surname_name" value="{{!empty($getpostdata['application_details']['alias_surname_name'])?$getpostdata['application_details']['alias_surname_name']:NULL}}" />
                                        <div class="press_enter">PRESS TAB</div>
                                    </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Email Address <span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="email" name="email_id" id="email_id" required="" value="{{!empty($getpostdata['email_id'])?$getpostdata['email_id']:NULL}}" readonly="">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels block-counter"> Gender <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="gender_text" class="__select_drop inputF" value="{{!empty($getpostdata['gender'])?$getpostdata['gender']:NULL}}" autocomplete="off">
                                    <ul class="hiddenul">
                                        <li class="hidden_li" data-val="Male">Male</li>
                                        <li class="hidden_li" data-val="Female">Female</li>
                                    </ul>
                                    <input type="hidden" id="gender" name="gender" value="{{!empty($getpostdata['gender'])?$getpostdata['gender']:NULL}}" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels block-counter"> Please provide your marital status <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" name="marital_status_text" class="__select_drop inputF" value="{{!empty($getpostdata['marital_status_name'])?$getpostdata['marital_status_name']:NULL}}" autocomplete="off">
                                    <ul class="hiddenul">
                                        @if(count($getmarital)>0)
                                            @foreach($getmarital as $val)
                                        <li class="hidden_li" data-val="{{$val->marital_status_id}}">{{$val->marital_status_name}}</li>
                                        @endforeach
                                        @endif
                                    </ul>
                                    <input type="hidden" id="marital_status_id" name="marital_status_id" value="{{!empty($getpostdata['marital_status_id'])?$getpostdata['marital_status_id']:NULL}}" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Date of Birth <span class="strike">*</span>
                                    <div class="qs_sub">DD/MM/YYYY</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="date" name="type_dob" id="type_dob" class="datepicker" required="" value="{{!empty($getpostdata['dob'])?$getpostdata['dob']:NULL}}" />
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Place of birth <span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="place_of_birth" id="place_of_birth" value="{{!empty($getpostdata['place_of_birth'])?$getpostdata['place_of_birth']:NULL}}" required="">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Have you ever been known by any other names? <span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="oth_name_is" class="radio inline">
                                        <input type="radio" id="oth_name_is" name="oth_name_is" value="Y" {{(!empty($getpostdata['application_details']['oth_name_is']) && ($getpostdata['application_details']['oth_name_is']=="Y"))?"checked":NULL}} required="">
                                        <span> Yes </span>
                                    </label>
                                    <label for="oth_name_is" class="radio inline">
                                        <input type="radio" id="oth_name_is" name="oth_name_is" value="N" required="" {{(!empty($getpostdata['application_details']['oth_name_is']) && ($getpostdata['application_details']['oth_name_is']=="N"))?"checked":NULL}}>
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['oth_name_is']) && ($getpostdata['application_details']['oth_name_is']=='Y'))?'divshow':'divhide'}}" id="div_child_3">
                                    <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Given name in English <span class="strike">*</span>
                                    <!-- <div class="qs_sub">Also Known as Given Name.</div> -->
                                    </div>
                                    </div>
                                    <div class="input-control">
                                        <input type="text" name="oth_given_name" id="oth_given_name" value="{{!empty($getpostdata['previous_name'])?$getpostdata['previous_name']:NULL}}" />
                                        <div class="press_enter">PRESS TAB</div>
                                    </div>                                
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['oth_name_is']) && ($getpostdata['application_details']['oth_name_is']=='Y'))?'divshow':'divhide'}}" id="div_child_4">
                                    <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Surname in English <span class="strike">*</span>
                                    <!-- <div class="qs_sub">Also Known as Given Name.</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="oth_surname_name" id="oth_surname_name" value="{{!empty($getpostdata['previous_surname'])?$getpostdata['previous_surname']:NULL}}" />
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Is your residential address in India? <span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="res_add_is_1" class="radio inline">
                                        <input type="radio" id="res_add_is_1" name="res_add_is" value="Y" {{(!empty($getpostdata['application_details']['res_add_india']) && ($getpostdata['application_details']['res_add_india']=="Y"))?"checked":NULL}}>
                                        <span> Yes </span>
                                    </label>
                                    <label for="res_add_is_2" class="radio inline">
                                        <input type="radio" id="res_add_is_2" name="res_add_is" value="N" {{(!empty($getpostdata['application_details']['res_add_india']) && ($getpostdata['application_details']['res_add_india']=="N"))?"checked":NULL}}>
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['res_add_india']) && ($getpostdata['application_details']['res_add_india']=='Y'))?'divshow':'divhide'}}" id="res_add_ind_div_1">
                                    <div class="labels">
                                        <div class="qs_list block-counter"></div>
                                        <div class="qs_body">Residential address in India <span class="strike">*</span>
                                        <!-- <div class="qs_sub">Also Known as Given Name.</div> -->
                                        </div>
                                    </div>
                                    <div class="input-control">
                                        <input type="text" name="red_add_ind" id="red_add_ind" value="{{!empty($getpostdata['pres_add1'])?$getpostdata['pres_add1']:NULL}}" />
                                        <div class="press_enter">PRESS TAB</div>
                                    </div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['res_add_india']) && ($getpostdata['application_details']['res_add_india']=='Y'))?'divshow':'divhide'}}" id="res_add_ind_div_2">
                                    <div class="labels block-counter"> District/City <span class="strike">*</span></div>
                                    <div class="input-control outerInFoc">
                                        <input type="text" id="district_city_text" name="district_city_text" placeholder="Select an option" class="__select_drop inputF" autocomplete="off" value="{{!empty($getpostdata['state_name'])?$getpostdata['state_name']:NULL}}">
                                        <ul class="hiddenul">
                                        @if(count($data_name)>0)
                                            @foreach($data_name as $row)
                                                @foreach($row as $val)
                                        <li class="hidden_li" data-val="{{$val}}">{{$val}}</li>            
                                                @endforeach
                                            @endforeach
                                        @endif
                                    </ul>
                                    <input type="hidden" id="district_city" name="district_city" value="{{!empty($getpostdata['state_name'])?$getpostdata['state_name']:NULL}}" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                    </div>
                                    <div class="outerclick"></div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['res_add_india']) && ($getpostdata['application_details']['res_add_india']=='N'))?'divshow':'divhide'}}" id="res_add_oth_div_1">
                                    <div class="labels">
                                        <div class="qs_list block-counter"></div>
                                        <div class="qs_body">Residential address other than India <span class="strike">*</span>
                                        <!-- <div class="qs_sub">Also Known as Given Name.</div> -->
                                        </div>
                                    </div>
                                    <div class="input-control">
                                        <input type="text" name="red_add_oth" id="red_add_oth" value="{{!empty($getpostdata['oth_add'])?$getpostdata['oth_add']:NULL}}" />
                                        <div class="press_enter">PRESS TAB</div>
                                    </div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['res_add_india']) && ($getpostdata['application_details']['res_add_india']=='N'))?'divshow':'divhide'}}" id="res_add_oth_div_2">
                                    <div class="labels block-counter"> Select your District / Country other than India <span class="strike">*</span></div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" id="district_city_oth_text" name="district_city_oth_text" class="__select_drop inputF" value="{{!empty($getpostdata['oth_country'])?$getpostdata['oth_country']:NULL}}" autocomplete="off">
                                    <ul class="hiddenul">
                                        @if(count($country_arr)>0)
                                            @foreach($country_arr as $val)
                                        <li class="hidden_li" data-val="{{$val}}">{{$val}}</li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <input type="hidden" id="district_city_oth" name="district_city_oth" value="{{!empty($getpostdata['oth_country'])?$getpostdata['oth_country']:NULL}}" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Contact telephone number
 with Country Code and Area Code <span class="strike">*</span>
                                        <!-- <div class="qs_sub">+917387519269</div> -->
                                    </div>
                                </div>
                                <div class="input-control tele_plus">
                                    <input type="tel" name="phone_number" class="only_number" id="phone_number" maxlength="15" value="{{!empty($getpostdata['phone_number'])?$getpostdata['phone_number']:NULL}}" required="" readonly="">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Any previous travels to the HKSAR within the past three years ? <span class="strike">*</span>
                                        <!-- <div class="qs_sub">Lorem ipsum dolor is dummy text</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_travel_hk" class="radio inline">
                                        <input type="radio" id="is_travel_hk" name="is_travel_hk" value="Y" {{(!empty($getpostdata['application_details']['pre_travel_hk']) && ($getpostdata['application_details']['pre_travel_hk']=="Y"))?"checked":NULL}} required="">
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_travel_hk" class="radio inline">
                                        <input type="radio" id="is_travel_hk" name="is_travel_hk" value="N" {{(!empty($getpostdata['application_details']['pre_travel_hk']) && ($getpostdata['application_details']['pre_travel_hk']=="N"))?"checked":NULL}} required="">
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['pre_travel_hk']) && ($getpostdata['application_details']['pre_travel_hk']=='Y'))?'divshow':'divhide'}}" id="pre_travel_hk_div">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Please state the Indian passport number you have previously used to visit the HKSAR along with month/year. (last 3 visits) <span class="strike">*</span>
                                        <div class="qs_sub">(eg: X0000000 / Jan 2017)</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="hk_pass_number" id="hk_pass_number" value="{{!empty($getpostdata['application_details']['pre_add_hk'])?$getpostdata['application_details']['pre_add_hk']:NULL}}">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Any previous visits to foreign countries/territories within the past three years ?<span class="strike">*</span>
                                        <!-- <div class="qs_sub">Lorem ipsum dolor is dummy text</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_travel_oth" class="radio inline">
                                        <input type="radio" id="is_travel_oth" name="is_travel_oth" value="Y" required="" {{(!empty($getpostdata['application_details']['pre_travel_oth']) && ($getpostdata['application_details']['pre_travel_oth']=="Y"))?"checked":NULL}}>
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_travel_oth" class="radio inline">
                                        <input type="radio" id="is_travel_oth" name="is_travel_oth" value="N" required="" {{(!empty($getpostdata['application_details']['pre_travel_oth']) && ($getpostdata['application_details']['pre_travel_oth']=="N"))?"checked":NULL}}>
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['pre_travel_oth']) && ($getpostdata['application_details']['pre_travel_oth']=='Y'))?'divshow':'divhide'}}" id="pre_travel_oth_div">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Name them with month and year (Last 5 visits)<span class="strike">*</span>
                                    <div class="qs_sub">(eg: Australia / Jan 2017)</div>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="oth_pass_number" id="oth_pass_number" value="{{!empty($getpostdata['application_details']['pre_add_oth'])?$getpostdata['application_details']['pre_add_oth']:NULL}}">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <!--<div class="input-block">
                                <div class="input-control">
                                     <input id="file" type="file" name="file" />
                                </div>
                            </div>-->
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Please select your Employment sector <span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" class="__select_drop inputF" autocomplete="off" id="emp_sector_text" name="emp_sector_text" value="{{!empty($getpostdata['application_details']['emp_sector'])?$getoccupationname->occupation_name:NULL}}" required="">
                                    <ul class="hiddenul">
                                        @if(count($occupation_arr)>0)
                                        @foreach($occupation_arr as $val)
                                        <li class="hidden_li" data-val="{{$val['id']}}">{{$val['occupation_name']}}</li>
                                        @endforeach
                                        @endif
                                    </ul>
                                    <input type="hidden" id="emp_sector" name="emp_sector" value="{{!empty($getpostdata['application_details']['emp_sector'])?$getoccupationname->id:NULL}}" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Name of company / employer / school<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="name_of_company" id="name_of_company" required="" value="{{!empty($getpostdata['application_details']['name_of_com'])?$getpostdata['application_details']['name_of_com']:NULL}}">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Address of office / school.<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="add_of_company" id="add_of_company" value="{{!empty($getpostdata['application_details']['office_add'])?$getpostdata['application_details']['office_add']:NULL}}" required="">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block" id="resadd_city">
                                <div class="labels block-counter"> District/City of Office <span class="strike">*</span></div>
                                    <div class="input-control outerInFoc">
                                        <input type="text" placeholder="Select an option" class="__select_drop inputF" id="com_city_state_text" name="com_city_state_text" autocomplete="off" value="{{!empty($getpostdata['application_details']['office_city'])?$getpostdata['application_details']['office_city']:NULL}}" required="">
                                        <ul class="hiddenul">
                                        @if(count($data_name)>0)
                                            @foreach($data_name as $row)
                                                    @foreach($row as $val)
                                        <li class="hidden_li" data-val="{{$val}}">{{$val}}</li>
                                            @endforeach
                                        @endforeach    
                                        @endif
                                    </ul>
                                    <input type="hidden" id="com_city_state" name="com_city_state" value="{{!empty($getpostdata['application_details']['office_city'])?$getpostdata['application_details']['office_city']:NULL}}" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                    </div>
                                    <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Contact telephone number of company / employer / school with Country Code and Area Code <span class="strike">*</span>
                                        <!-- <div class="qs_sub">+917387519269</div> -->
                                    </div>
                                </div>
                                <div class="input-control tele_plus">
                                    <input type="tel" name="com_phone" class="only_number" id="com_phone" maxlength="15" value="{{!empty($getpostdata['application_details']['phone_com'])?$getpostdata['application_details']['phone_com']:NULL}}" required="">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Purpose of visit <span class="strike">*</span>
                                        <!-- <div class="qs_sub">+917387519269</div> -->
                                    </div>
                                </div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" id="purpose_visit_text" name="purpose_visit_text" class="__select_drop inputF" autocomplete="off" value="{{!empty($getpostdata['purpose_name'])?$getpostdata['purpose_name']:NULL}}" required="">
                                    <ul class="hiddenul purpose_visit_ul">
                                        <li class="hidden_li" data-val="13">Leisure Visit</li>
                                        <li class="hidden_li" data-val="14">Business Visit</li>
                                        <li class="hidden_li" data-val="15">Family Visit</li>
                                        <li class="hidden_li" data-val="16">Transit</li>
                                    </ul>
                                    <input type="hidden" id="purpose_visit" name="purpose_visit" value="{{!empty($getpostdata['purpose_id'])?$getpostdata['purpose_id']:NULL}}" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Proposed duration of stay (days) <span class="strike">*</span>
                                        <!-- <div class="qs_sub">+917387519269</div> -->
                                    </div>
                                </div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" id="purpose_day_text" name="purpose_day_text" class="__select_drop inputF" value="{{!empty($getpostdata['application_details']['proposed_duration_stay'])?$getpostdata['application_details']['proposed_duration_stay']:NULL}}" autocomplete="off">
                                    <ul class="hiddenul">
                                        <li class="hidden_li" data-val="Same Day">Same Day</li>
                                        @for($i=1;$i<=14;$i++)
                                        <li class="hidden_li" data-val="{{$i}}">{{$i}}</li>
                                        @endfor
                                    </ul>
                                    <input type="hidden" id="purpose_day" name="purpose_day" value="{{!empty($getpostdata['application_details']['proposed_duration_stay'])?$getpostdata['application_details']['proposed_duration_stay']:NULL}}" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Address of accommodation in Hong Kong, Building/Phase/Hotel Name
                                        <span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <textarea name="address_acco" id="address_acco" required="">{{!empty($getpostdata['application_details']['accommodation_add_hk'])?$getpostdata['application_details']['accommodation_add_hk']:NULL}}</textarea>
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Fund available for travel to the HKSAR in HK dollars (including cost of accommodation) <span class="strike">*</span>
                                        <!-- <div class="qs_sub">+917387519269</div> -->
                                    </div>
                                </div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" id="hk_travel_fund_text" name="hk_travel_fund_text" class="__select_drop inputF" autocomplete="off" value="{{!empty($getpostdata['application_details']['fund_travel_hksar'])?$getpostdata['application_details']['fund_travel_hksar']:NULL}}">
                                    <ul class="hiddenul">
                                        <li class="hidden_li" data-val="HK$0 - HK$4,999">HK$0 - HK$4,999</li>
                                        <li class="hidden_li" data-val="HK$5,000 - HK$9,999">HK$5,000 - HK$9,999</li>
                                        <li class="hidden_li" data-val="HK$10,000 - HK$14,999">HK$10,000 - HK$14,999</li>
                                        <li class="hidden_li" data-val="HK$15,000 - HK$19,999">HK$15,000 - HK$19,999</li>
                                        <li class="hidden_li" data-val="HK$20,000 - HK$29,999">HK$20,000 - HK$29,999</li>
                                        <li class="hidden_li" data-val="HK$30,000 - HK$39,999">HK$30,000 - HK$39,999</li>
                                        <li class="hidden_li" data-val="HK$40,000 or more">HK$40,000 or more</li>
                                    </ul>
                                    <input type="hidden" id="hk_travel_fund" name="hk_travel_fund" value="{{!empty($getpostdata['application_details']['fund_travel_hksar'])?$getpostdata['application_details']['fund_travel_hksar']:NULL}}" class="inputH">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Do you have a local connection in the HKSAR<span class="strike">*</span>
                                        <!-- <div class="qs_sub">Lorem ipsum dolor is dummy text</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_local_conn" class="radio inline">
                                        <input type="radio" id="is_local_conn" name="is_local_conn" value="Y" required="" {{(!empty($getpostdata['application_details']['local_conn_hk']) && $getpostdata['application_details']['local_conn_hk']=="Y")?"checked":NULL}}>
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_local_conn" class="radio inline">
                                        <input type="radio" id="is_local_conn" name="is_local_conn" value="N" required="" {{(!empty($getpostdata['application_details']['local_conn_hk']) && $getpostdata['application_details']['local_conn_hk']=="N")?"checked":NULL}}>
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['local_conn_hk']) && $getpostdata['application_details']['local_conn_hk']=='Y')?'divshow':'divhide'}}" id="local_conn_div">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Please enter the Name of local connection (person or company)<span class="strike">*</span>
                                    </div>
                                </div>
                                <div class="input-control">
                                    <input type="text" name="local_conn_name" id="local_conn_name" value="{{!empty($getpostdata['application_details']['local_name_hk'])?$getpostdata['application_details']['local_name_hk']:NULL}}">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['local_conn_hk']) && $getpostdata['application_details']['local_conn_hk']=='Y')?'divshow':'divhide'}}" id="local_conn_div1">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Enter the Relationship with local connection <span class="strike">*</span>
                                        <!-- <div class="qs_sub">+917387519269</div> -->
                                    </div>
                                </div>
                                <div class="input-control outerInFoc">
                                    <input type="text" placeholder="Select an option" id="local_conn_relative_text" name="local_conn_relative_text" class="__select_drop inputF" autocomplete="off" value="{{!empty($getpostdata['application_details']['local_conn_relation'])?$getpostdata['application_details']['local_conn_relation']:NULL}}">
                                    <ul class="hiddenul">
                                        <li class="hidden_li" data-val="Father/Mother">Father/Mother</li>
                                        <li class="hidden_li" data-val="Husband/Wife">Husband/Wife</li>
                                        <li class="hidden_li" data-val="Son/Daughter">Son/Daughter</li>
                                        <li class="hidden_li" data-val="Siblings">Siblings</li>
                                        <li class="hidden_li" data-val="Friend">Friend</li>
                                        <li class="hidden_li" data-val="Business Associates">Business Associates</li>
                                        <li class="hidden_li" data-val="Tour Agent">Tour Agent</li>
                                        <li class="hidden_li" data-val="Other Relatives">Other Relatives</li>
                                    </ul>
                                    <input type="hidden" id="local_conn_relative" name="local_conn_relative" class="inputH" value="{{!empty($getpostdata['application_details']['local_conn_relation'])?$getpostdata['application_details']['local_conn_relation']:NULL}}">
                                    <div class="press_enter">PRESS TAB</div>
                                </div>
                                <div class="outerclick"></div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Will you experience hardship or difficulty in or after returning to India? <span class="strike">*</span>
                                        <!-- <div class="qs_sub">Lorem ipsum dolor is dummy text</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_return_ind" class="radio inline">
                                        <input type="radio" id="is_return_ind" name="is_return_ind" value="Y" required="" {{(!empty($getpostdata['application_details']['difficulty_ret_india']) && $getpostdata['application_details']['difficulty_ret_india']=="Y")?"checked":NULL}}>
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_return_ind" class="radio inline">
                                        <input type="radio" id="is_return_ind" name="is_return_ind" value="N" required="" {{(!empty($getpostdata['application_details']['difficulty_ret_india']) && $getpostdata['application_details']['difficulty_ret_india']=="N")?"checked":NULL}}>
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Have you ever committed or been arrested for any overstaying, illegal immigration or other criminal offence in the HKSAR or any country/territory? <span class="strike">*</span>
                                        <!-- <div class="qs_sub">Lorem ipsum dolor is dummy text</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_arrested" class="radio inline">
                                        <input type="radio" id="is_arrested" name="is_arrested" value="Y" required="" {{(!empty($getpostdata['application_details']['criminal_offence']) && $getpostdata['application_details']['criminal_offence']=="Y")?"checked":NULL}}>
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_arrested" class="radio inline">
                                        <input type="radio" id="is_arrested" name="is_arrested" value="N"
                                        required="" {{(!empty($getpostdata['application_details']['criminal_offence']) && $getpostdata['application_details']['criminal_offence']=="N")?"checked":NULL}}>
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block {{(!empty($getpostdata['application_details']['criminal_offence']) && $getpostdata['application_details']['criminal_offence']=='Y')?'divshow':'divhide'}}" id="is_arrested_div">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">If yes, have you ever been convicted of the offence(s)? <span class="strike">*</span>
                                        <!-- <div class="qs_sub">Lorem ipsum dolor is dummy text</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_convicted" class="radio inline">
                                        <input type="radio" id="is_convicted" name="is_convicted" value="Y" {{(!empty($getpostdata['application_details']['convicted_offence']) && $getpostdata['application_details']['convicted_offence']=="Y")?"checked":NULL}}>
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_convicted" class="radio inline">
                                        <input type="radio" id="is_convicted" name="is_convicted" value="N" {{(!empty($getpostdata['application_details']['convicted_offence']) && $getpostdata['application_details']['convicted_offence']=="N")?"checked":NULL}}>
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Have you ever been refused a visa application by the HKSAR or any other country/territory? <span class="strike">*</span>
                                        <!-- <div class="qs_sub">Lorem ipsum dolor is dummy text</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_refused" class="radio inline">
                                        <input type="radio" id="is_refused" name="is_refused" value="Y" required="" {{(!empty($getpostdata['application_details']['refused_visa']) && $getpostdata['application_details']['refused_visa']=="Y")?"checked":NULL}}>
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_refused" class="radio inline">
                                        <input type="radio" id="is_refused" name="is_refused" value="N"
                                        required="" {{(!empty($getpostdata['application_details']['refused_visa']) && $getpostdata['application_details']['refused_visa']=="N")?"checked":NULL}}>
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Have you ever been refused permission to enter the HKSAR or any other country/territory? <span class="strike">*</span>
                                        <!-- <div class="qs_sub">Lorem ipsum dolor is dummy text</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_refused_per" class="radio inline">
                                        <input type="radio" id="is_refused_per" name="is_refused_per" value="Y" required="" {{(!empty($getpostdata['application_details']['refused_permission']) && $getpostdata['application_details']['refused_permission']=="Y")?"checked":NULL}}>
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_refused_per" class="radio inline">
                                        <input type="radio" id="is_refused_per" name="is_refused_per" value="N"
                                        required="" {{(!empty($getpostdata['application_details']['refused_permission']) && $getpostdata['application_details']['refused_permission']=="N")?"checked":NULL}}>
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Have you ever been deported/removed from the HKSAR or any other country/territory? <span class="strike">*</span>
                                        <!-- <div class="qs_sub">Lorem ipsum dolor is dummy text</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_deported" class="radio inline">
                                        <input type="radio" id="is_deported" name="is_deported" value="Y" required="" {{(!empty($getpostdata['application_details']['deported_country']) && $getpostdata['application_details']['deported_country']=="Y")?"checked":NULL}}>
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_deported" class="radio inline">
                                        <input type="radio" id="is_deported" name="is_deported" value="N"
                                        required="" {{(!empty($getpostdata['application_details']['deported_country']) && $getpostdata['application_details']['deported_country']=="N")?"checked":NULL}}>
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                            <div class="input-block">
                                <div class="labels">
                                    <div class="qs_list block-counter"></div>
                                    <div class="qs_body">Do you seek to engage in or have you ever engaged in terrorist activities? <span class="strike">*</span>
                                        <!-- <div class="qs_sub">Lorem ipsum dolor is dummy text</div> -->
                                    </div>
                                </div>
                                <div class="input-control">
                                    <label for="is_engage" class="radio inline">
                                        <input type="radio" id="is_engage" name="is_engage" value="Y" required="" {{(!empty($getpostdata['application_details']['engaged_terrorist_activities']) && $getpostdata['application_details']['engaged_terrorist_activities']=="Y")?"checked":NULL}}>
                                        <span> Yes </span>
                                    </label>
                                    <label for="is_engage" class="radio inline">
                                        <input type="radio" id="is_engage" name="is_engage" value="N"
                                        required="" {{(!empty($getpostdata['application_details']['engaged_terrorist_activities']) && $getpostdata['application_details']['engaged_terrorist_activities']=="N")?"checked":NULL}}>
                                        <span>No</span>
                                    </label>
                                    <!-- <p id="gender_error"></p> -->
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" id="hk_submit" class="__ty_submit" value="SUBMIT">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="{{URL::to('/')}}/js/dist/hk_autosaveform.js"></script>
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