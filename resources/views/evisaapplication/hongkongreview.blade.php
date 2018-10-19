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
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">eVisa</span>
                                    <img src="{{ URL::to('/') }}/svg/E-visa.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">AIRPORT MEET &amp; GREET</span>
                                    <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">AIRPORT LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current __width100">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading">
                                        eVisa
                                        @if($extractdata['is_review_updated']=="N")
                                        <div class="__hgk_rev_header">
                                            <button type="button" id="btn_edit" class="__btn">EDIT</button>
                                            <button type="button" id="btn_close" class="__btn divhide">Cancel</button>
                                        </div>
                                        @endif
                                    </h1>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <form method="post" name="CustomTypeForm" id="CustomTypeForm" novalidate="novalidate">
                                <input type="hidden" name="order_id" id="order_id" value="{{$extractdata['order_id']}}">
                                <input type="hidden" name="order_code" id="order_code" value="{{$extractdata['order_code']}}">
                                <input type="hidden" name="user_id" id="user_id" value="{{$extractdata['user_id']}}">
                                <input type="hidden" name="product_id" id="product_id" value="{{$extractdata['product_id']}}">
                                <input type="hidden" name="profile_id" id="profile_id" value="{{$extractdata['profile_id']}}">
                                <input type="hidden" name="nationality" id="nationality" value="{{$extractdata['nationality']}}">
                                <input type="hidden" name="citizen_to" id="citizen_to" value="{{$extractdata['citizen_to']}}">
                                <input type="hidden" name="travel_to" id="travel_to" value="{{$extractdata['travel_to']}}">
                                <input type="hidden" name="service_id" id="service_id" value="{{$extractdata['service_id']}}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="__stylish_head">Review Form Details</h4>
                                    </div>
                                    @if($errors->any())
                                    <div class="__thanks" id="thanks">
                                            <div class="__thanks_body">
                                                <div class="_close_thnks"><a href="javascript:void(0);" onclick="$('#thanks').fadeOut('slow');"><img src="{{URL::to('/')}}/svg/close-icon.svg" width="22px" height="22px" /></a></div>
                                                <!-- <img src="svg/thanks_icon.svg" width="90px" class="center-block" alt="" /> -->
                                                <div class="alert alert-success">
                                                  <p>{{$errors->first()}}</p>
                                                </div>
                                                <div class="clearfix"></div>
                                                <a href="{{URL::to('/')}}" class="__btn" title="Go Home">Home</a>
                                            </div>
                                    </div>
                                    @endif
                                    <div class="__fm_box __app_form">
                                        <!-- <div class="col-md-12">
                                            <p class="__form_notes">Passenger Name</p>
                                        </div> -->
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Given name as per the passport.<span class="strike">*</span></label>
                                                <input type="text" name="passport_given_name" id="passport_given_name" value="{{$extractdata['username']}}" required="" class="__readonly" readonly="" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Surname name as per the passport.<span class="strike">*</span></label>
                                                <input type="text" name="passport_surname_name" id="passport_surname_name" value="{{$extractdata['surname']}}" required="" class="__readonly" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Your valid passport number<span class="strike">*</span></label>
                                                <input type="text" name="passport_number" id="passport_number" value="{{$extractdata['pp_no']}}" class="__readonly" required="" readonly="">
                                            </div>
                                        </div>
                                        <!-- clearfix -->
                                        <div class="clearfix"></div>
                                        <!-- clearfix end -->
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Place of issue of passport<span class="strike">*</span></label>
                                                <input type="text" name="place_of_issue" id="place_of_issue" required="" value="{{$extractdata['pp_place_of_issue']}}" class="__readonly" readonly="" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Date of issue<span class="strike">*</span></label>
                                                <input type="text" name="type_doi" id="type_doi" class="datepicker __readonly" placeholder="select Date" value="{{$extractdata['pp_issue_date']}}" readonly="" disabled="true" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Date of expiry<span class="strike">*</span></label>
                                                <input type="text" name="type_doe" id="type_doe" class="datepicker __readonly" placeholder="select Date" value="{{$extractdata['pp_expiry_date']}}" readonly="" disabled="true" />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- grey box end -->
                                    <div class="__fm_box __app_form">
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Is there any alias in English on your passport?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="alias_is">
                                                      <input type="radio" name="alias_is" id="alias_is" class="__readonly" value="Y" {{($extractdata['application_details']['alias_is']=="Y")?"checked":NULL}} disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="alias_is">
                                                      <input type="radio" name="alias_is" id="alias_is" class="__readonly" value="N" {{($extractdata['application_details']['alias_is']=="N")?"checked":NULL}} disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- clearfix -->
                                        <div class="clearfix"></div>
                                        <!-- clearfix end -->
                                        <div id="div_child_2" class='{{($extractdata["application_details"]["alias_is"]=="Y")?"divshow":"divhide"}}'>
                                            <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Alias given name in English (as shown on passport, if any)<span class="strike">*</span></label>
                                                <input type="text" name="alias_given_name" id="alias_given_name" class="__readonly" value="{{$extractdata['application_details']['alias_given_name']}}" {{($extractdata["application_details"]["alias_is"]=="Y")?"required":NULL}} readonly="" />
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="__app_input">
                                                    <label>Alias surname in English (as shown on passport, if any)<span class="strike">*</span></label>
                                                    <input type="text" name="alias_surname_name" id="alias_surname_name" class="__readonly" value="{{$extractdata['application_details']['alias_surname_name']}}" {{($extractdata["application_details"]["alias_is"]=="Y")?"required":NULL}} readonly="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="__fm_box __app_form">
                                        <!-- <div class="col-md-12">
                                            <p class="__form_notes">Passenger Name</p>
                                        </div> -->
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Email Address<span class="strike">*</span></label>
                                                <input type="email" name="email_id" id="email_id" value="{{$extractdata['email_id']}}" required="" readonly="" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__select_box">
                                                <label>Gender<span class="strike">*</span></label>
                                                <select class="__select __readonly" id="gender" name="gender" required="" disabled="true">
                                                    <option value="Male" {{($extractdata['gender']=="Male")?"selected":NULL}}>Male</option>
                                                    <option value="Female" {{($extractdata['gender']=="Female")?"selected":NULL}}>Female</option>
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__select_box">
                                                <label>Please provide your marital status<span class="strike">*</span></label>
                                                <select class="__select __readonly" id="marital_status_id" name="marital_status_id" required="" disabled="true">
                                                <option value="">Select Marital Status</option>
                                                @if(count($getmarital)>0)
                                            @foreach($getmarital as $val)       
                                                    <option value="{{$val->marital_status_id}}" {{($val->marital_status_id==$extractdata['marital_status_id'])?"selected":NULL}}>{{$val->marital_status_name}}</option>
                                            @endforeach
                                            @endif
                                                </select>
                                                <i class="fa fa-angle-down"></i>  
                                            </div>
                                        </div>
                                        <!-- clearfix -->
                                        <div class="clearfix"></div>
                                        <!-- clearfix end -->
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Date of Birth<span class="strike">*</span></label>
                                                <input type="text" name="type_dob" id="type_dob" class="datepicker __readonly" placeholder="select Date" value="{{$extractdata['dob']}}" required="" disabled="true" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Place of birth<span class="strike">*</span></label>
                                                <input type="text" name="place_of_birth" id="place_of_birth" value="{{$extractdata['place_of_birth']}}" required="" class="__readonly" readonly="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="__fm_box __app_form">
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Have you ever been known by any other names?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="oth_name_is">
                                                      <input type="radio" name="oth_name_is" id="oth_name_is" value="Y" class="__readonly" {{($extractdata['application_details']['oth_name_is']=="Y")?"checked":NULL}} disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="oth_name_is">
                                                      <input type="radio" name="oth_name_is" class="__readonly" id="oth_name_is" value="N" {{($extractdata['application_details']['oth_name_is']=="N")?"checked":NULL}} disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- clearfix -->
                                        <div class="clearfix"></div>
                                        <!-- clearfix end -->
                                            <div class='col-md-4 {{($extractdata["application_details"]["oth_name_is"]=="Y")?"divshow":"divhide"}}' id="div_child_3">
                                            <div class="__app_input">
                                                <label>Given name in English<span class="strike">*</span></label>
                                                <input type="text" name="oth_given_name" id="oth_given_name" class="__readonly" value="{{$extractdata['previous_name']}}" {{($extractdata["application_details"]["oth_name_is"]=="Y")?"required":NULL}} readonly="" />
                                            </div>
                                            </div>
                                            <div class='col-md-4 {{($extractdata["application_details"]["oth_name_is"]=="Y")?"divshow":"divhide"}}' id="div_child_4">
                                                <div class="__app_input">
                                                    <label>Surname in English<span class="strike">*</span></label>
                                                    <input type="text" name="oth_surname_name" id="oth_surname_name" class="__readonly" value="{{$extractdata['previous_surname']}}" {{($extractdata["application_details"]["oth_name_is"]=="Y")?"required":NULL}} readonly="">
                                                </div>
                                            </div>
                                    </div>
                                    <div class="__fm_box __app_form">
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Is your residential address in India?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="res_add_is_1">
                                                      <input type="radio" name="res_add_is" id="res_add_is_1" value="Y" class="__readonly" {{($extractdata['application_details']['res_add_india']=="Y")?"checked":NULL}} disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="res_add_is_2">
                                                      <input type="radio" name="res_add_is" id="res_add_is_2" value="N" class="__readonly" {{($extractdata['application_details']['res_add_india']=="N")?"checked":NULL}} disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- clearfix -->
                                        <div class="clearfix"></div>
                                        <!-- clearfix end -->
                                            <div class='col-md-4 {{($extractdata["application_details"]["res_add_india"]=="Y")?"divshow":"divhide"}}' id="res_add_ind_div_1">
                                            <div class="__app_input">
                                                <label>Residential address in India<span class="strike">*</span></label>
                                                <input type="text" name="red_add_ind" id="red_add_ind" class="__readonly" value="{{$extractdata['pres_add1']}}" {{($extractdata["application_details"]["res_add_india"]=="Y")?"required":NULL}} readonly="" />
                                            </div>
                                            </div>
                                            <div class='col-md-4 {{($extractdata["application_details"]["res_add_india"]=="Y")?"divshow":"divhide"}}' id="res_add_ind_div_2">
                                                <div class="__select_box">
                                                    <label>District/City<span class="strike">*</span></label>
                                                <select class="__select __readonly" id="district_city" name="district_city" {{($extractdata["application_details"]["res_add_india"]=="Y")?"required":NULL}} disabled="true">
                                                <option value="">Select District/City</option>
                                                @if(count($data_name)>0)
                                            @foreach($data_name as $row)
                                                @foreach($row as $val)      
                                                    <option value="{{$val}}" {{($val==$extractdata['state_name'])?"selected":NULL}}>{{$val}}</option>
                                            @endforeach
                                            @endforeach
                                            @endif
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                        <!-- clearfix -->
                                        <div class="clearfix"></div>
                                        <!-- clearfix end -->
                                        <div class='col-md-4 {{($extractdata["application_details"]["res_add_india"]=="N")?"divshow":"divhide"}}' id="res_add_oth_div_1">
                                            <div class="__app_input">
                                                <label>Residential address other than India<span class="strike">*</span></label>
                                                <input type="text" name="red_add_oth" id="red_add_oth" class="__readonly" value="{{$extractdata['oth_add']}}" {{($extractdata["application_details"]["res_add_india"]=="N")?"required":NULL}} readonly="" />
                                            </div>
                                        </div>
                                        <div class='col-md-4 {{($extractdata["application_details"]["res_add_india"]=="N")?"divshow":"divhide"}}' id="res_add_oth_div_2">
                                                <div class="__select_box">
                                                    <label>Select your country other than India<span class="strike">*</span></label>
                                                <select class="__select __readonly" id="district_city_oth" name="district_city_oth" {{($extractdata["application_details"]["res_add_india"]=="N")?"required":NULL}} disabled="true">
                                                <option value="">Select Country</option>
                                                @if(count($country_arr)>0)
                                                @foreach($country_arr as $val)      
                                                    <option value="{{$val}}" {{($val==$extractdata['oth_country'])?"selected":NULL}}>{{$val}}</option>
                                                @endforeach
                                                @endif
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                                </div>
                                        </div>  
                                    </div>
                                    <div class="__fm_box __app_form">
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Contact telephone number
 with Country Code and Area Code<span class="strike">*</span></label>
                                                <input type="tel" name="phone_number" id="phone_number" class="only_number __readonly" maxlength="15" value="{{$extractdata['mobile_no']}}" required="" readonly="" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Any previous travels to the HKSAR within the past three years ?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="is_travel_hk">
                                                      <input type="radio" name="is_travel_hk" id="is_travel_hk" class="__readonly" value="Y" {{($extractdata['application_details']['pre_travel_hk']=="Y")?"checked":NULL}} disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="is_travel_hk">
                                                      <input type="radio" name="is_travel_hk" id="is_travel_hk" class="__readonly" value="N" {{($extractdata['application_details']['pre_travel_hk']=="N")?"checked":NULL}} disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 {{($extractdata['application_details']['pre_travel_hk']=='Y')?'divshow':'divhide'}}" id="pre_travel_hk_div">
                                            <div class="__app_input">
                                                <label>Please state the Indian passport number you have previously used to visit the HKSAR along with month/year. (last 3 visits)<span class="strike">*</span></label>
                                                <input type="text" name="hk_pass_number" id="hk_pass_number" value="{{$extractdata['application_details']['pre_add_hk']}}" class="__readonly" {{($extractdata['application_details']['pre_travel_hk']=="Y")?"required":NULL}} readonly="" />
                                            </div>
                                        </div>
                                        <!-- clearfix -->
                                        <div class="clearfix"></div>
                                        <!-- clearfix end -->
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Any previous visits to foreign countries/territories within the past three years?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="is_travel_oth">
                                                      <input type="radio" name="is_travel_oth" id="is_travel_oth" class="__readonly" value="Y" {{($extractdata['application_details']['pre_travel_oth']=="Y")?"checked":NULL}} required="" disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="is_travel_oth">
                                                      <input type="radio" name="is_travel_oth" id="is_travel_oth" class="__readonly" value="N" {{($extractdata['application_details']['pre_travel_oth']=="N")?"checked":NULL}} required="" disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 {{($extractdata['application_details']['pre_travel_oth']=='Y')?'divshow':'divhide'}}" id="pre_travel_oth_div">
                                            <div class="__app_input">
                                                <label>Name them with month and year (Last 5 visits)<span class="strike">*</span></label>
                                                <input type="text" name="oth_pass_number" id="oth_pass_number" class="__readonly" value="{{$extractdata['application_details']['pre_add_oth']}}" {{($extractdata['application_details']['pre_travel_oth']=="Y")?"required":NULL}} readonly="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="__fm_box __app_form">
                                        <div class='col-md-4'>
                                            <div class="__select_box">
                                                <label>Please select your Employment sector<span class="strike">*</span></label>
                                                <select class="__select __readonly" id="emp_sector" name="emp_sector" required="" disabled="true">
                                                <option value="">Select an option</option>
                                                @if(count($occupation_arr)>0)
                                                @foreach($occupation_arr as $val)      
                                                    <option value="{{$val['id']}}" {{($val['id']==$extractdata['application_details']['emp_sector'])?"selected":NULL}}>{{$val['occupation_name']}}</option>
                                                @endforeach
                                                @endif
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Name of company / employer / school<span class="strike">*</span></label>
                                                <input type="text" name="name_of_company" id="name_of_company" class="__readonly" value="{{$extractdata['application_details']['name_of_com']}}" required="" readonly="" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Address of office / school.<span class="strike">*</span></label>
                                                <input type="text" class="__readonly" name="add_of_company" id="add_of_company" value="{{$extractdata['application_details']['office_add']}}" required="" readonly="" />
                                            </div>
                                        </div>
                                        <!-- clearfix -->
                                        <div class="clearfix"></div>
                                        <!-- clearfix end -->
                                        <div class='col-md-4'>
                                            <div class="__select_box">
                                                <label>District/City of Office<span class="strike">*</span></label>
                                                <select class="__select __readonly" id="com_city_state" name="com_city_state" required="" disabled="true">
                                                <option value="">Select an option</option>
                                                @if(count($data_name)>0)
                                            @foreach($data_name as $row)
                                                    @foreach($row as $val)      
                                                    <option value="{{$val}}" {{($val==$extractdata['application_details']['office_city'])?"selected":NULL}}>{{$val}}</option>
                                                @endforeach
                                        @endforeach    
                                        @endif
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Contact telephone number of company / employer / school with Country Code and Area Code<span class="strike">*</span></label>
                                                <input type="tel" name="com_phone" id="com_phone" class="only_number __readonly" maxlength="15" value="{{$extractdata['application_details']['phone_com']}}" required="" readonly="" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__select_box">
                                                <label>Purpose of visit<span class="strike">*</span></label>
                                                <select class="__select __readonly" id="purpose_visit_text_review" name="purpose_visit_text" required="" disabled="true">
                                                    <option value="">Select an option</option>
                                                    <option value="13" {{$extractdata['purpose_id']==13?"selected":NULL}}>Leisure Visit</option>
                                                    <option value="14" {{$extractdata['purpose_id']==14?"selected":NULL}}>Business Visit</option>
                                                    <option value="15" {{$extractdata['purpose_id']==15?"selected":NULL}}>Family Visit</option>
                                                    <option value="16" {{$extractdata['purpose_id']==16?"selected":NULL}}>Transit</option>
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                            <input type="hidden" name="purpose_visit" id="purpose_visit" value="{{$extractdata['purpose_id']}}" required="">
                                        </div>
                                    </div>
                                    <div class="__fm_box __app_form">
                                        <div class="col-md-4">
                                            <div class="__select_box">
                                                <label>Proposed duration of stay (days)<span class="strike">*</span></label>
                                                <select class="__select __readonly" id="purpose_day" name="purpose_day" required="" disabled="true">
                                                    <option value="">Select an option</option>
                                                    <option value="Same Day" {{($extractdata['application_details']['proposed_duration_stay']=="Same Day")?"selected":NULL}}>Same Day</option>
                                                    @for($i=1;$i<=14;$i++)
                                                    <option value="{{$i}}" {{($extractdata['application_details']['proposed_duration_stay']==$i)?"selected":NULL}}>{{$i}}</option>
                                                    @endfor
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_input">
                                                <label>Address of accommodation in Hong Kong, Building/Phase/Hotel Name<span class="strike">*</span></label>
                                                <textarea name="address_acco" id="address_acco" rows="5" class="__readonly" required="" readonly="">{{$extractdata['application_details']['accommodation_add_hk']}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__select_box">
                                                <label>Fund available for travel to the HKSAR in HK dollars (including cost of accommodation)<span class="strike">*</span></label>
                                                <select class="__select __readonly" id="hk_travel_fund" name="hk_travel_fund" required="" disabled="true">
                                                    <option value="">Select an option</option>
                                                    <option value="HK$0 - HK$4,999" {{($extractdata['application_details']['fund_travel_hksar']=="HK$0 - HK$4,999")?"selected":NULL}}>HK$0 - HK$4,999</option>
                                                    <option value="HK$5,000 - HK$9,999" {{($extractdata['application_details']['fund_travel_hksar']=="HK$5,000 - HK$9,999")?"selected":NULL}}>HK$5,000 - HK$9,999</option>
                                                    <option value="HK$10,000 - HK$14,999" {{($extractdata['application_details']['fund_travel_hksar']=="HK$10,000 - HK$14,999")?"selected":NULL}}>HK$10,000 - HK$14,999</option>
                                                    <option value="HK$15,000 - HK$19,999" {{($extractdata['application_details']['fund_travel_hksar']=="HK$15,000 - HK$19,999")?"selected":NULL}}>HK$15,000 - HK$19,999</option>
                                                    <option value="HK$20,000 - HK$29,999" {{($extractdata['application_details']['fund_travel_hksar']=="HK$20,000 - HK$29,999")?"selected":NULL}}>HK$20,000 - HK$29,999</option>
                                                    <option value="HK$30,000 - HK$39,999" {{($extractdata['application_details']['fund_travel_hksar']=="HK$30,000 - HK$39,999")?"selected":NULL}}>HK$30,000 - HK$39,999</option>
                                                    <option value="HK$40,000 or more" {{($extractdata['application_details']['fund_travel_hksar']=="HK$40,000 or more")?"selected":NULL}}>HK$40,000 or more</option>
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="__fm_box __app_form">
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Do you have a local connection in the HKSAR<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="is_local_conn">
                                                      <input type="radio" name="is_local_conn" id="is_local_conn" class="__readonly" value="Y" {{($extractdata['application_details']['local_conn_hk']=="Y")?"checked":NULL}} disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="is_local_conn">
                                                      <input type="radio" name="is_local_conn" id="is_local_conn" class="__readonly" value="N" {{($extractdata['application_details']['local_conn_hk']=="N")?"checked":NULL}} disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-md-4 {{($extractdata["application_details"]["local_conn_hk"]=="Y")?"divshow":"divhide"}}' id="local_conn_div">
                                            <div class="__app_input">
                                                <label>Please enter the Name of local connection (person or company)<span class="strike">*</span></label>
                                                <input type="text" name="local_conn_name" id="local_conn_name" class="__readonly" value="{{$extractdata['application_details']['local_name_hk']}}" {{($extractdata["application_details"]["local_conn_hk"]=="Y")?"required":NULL}} readonly="" />
                                            </div>
                                            </div>
                                            <div class='col-md-4 {{($extractdata["application_details"]["local_conn_hk"]=="Y")?"divshow":"divhide"}}' id="local_conn_div1">
                                                <div class="__select_box">
                                                <label>Enter the Relationship with local connection<span class="strike">*</span></label>
                                                <select class="__select __readonly" id="local_conn_relative" name="local_conn_relative" {{($extractdata["application_details"]["local_conn_hk"]=="Y")?"required":NULL}} disabled="true">
                                                    <option value="">Select an option</option>
                                                    <option value="Father/Mother" {{($extractdata["application_details"]["local_conn_relation"]=="Father/Mother")?"selected":NULL}}>Father/Mother</option>
                                                    <option value="Husband/Wife" {{($extractdata["application_details"]["local_conn_relation"]=="Husband/Wife")?"selected":NULL}}>Husband/Wife</option>
                                                    <option value="Son/Daughter" {{($extractdata["application_details"]["local_conn_relation"]=="Son/Daughter")?"selected":NULL}}>Son/Daughter</option>
                                                    <option value="Siblings" {{($extractdata["application_details"]["local_conn_relation"]=="Siblings")?"selected":NULL}}>Siblings</option>
                                                    <option value="Friend" {{($extractdata["application_details"]["local_conn_relation"]=="Friend")?"selected":NULL}}>Friend</option>
                                                    <option value="Business Associates" {{($extractdata["application_details"]["local_conn_relation"]=="Business Associates")?"selected":NULL}}>Business Associates</option>
                                                    <option value="Tour Agent" {{($extractdata["application_details"]["local_conn_relation"]=="Tour Agent")?"selected":NULL}}>Tour Agent</option>
                                                    <option value="Other Relatives" {{($extractdata["application_details"]["local_conn_relation"]=="Other Relatives")?"selected":NULL}}>Other Relatives</option>
                                                </select>
                                                <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>                             
                                    </div>
                                    <div class="__fm_box __app_form">
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Will you experience hardship or difficulty in or after returning to India?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="is_return_ind">
                                                      <input type="radio" name="is_return_ind" id="is_return_ind" class="__readonly" value="Y" {{($extractdata['application_details']['difficulty_ret_india']=="Y")?"checked":NULL}} required="" disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="is_return_ind">
                                                      <input type="radio" name="is_return_ind" id="is_return_ind" class="__readonly" value="N" {{($extractdata['application_details']['difficulty_ret_india']=="N")?"checked":NULL}} required="" disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Have you ever committed or been arrested for any overstaying, illegal immigration or other criminal offence in the HKSAR or any country/territory?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="is_arrested">
                                                      <input type="radio" class="__readonly" name="is_arrested" id="is_arrested" value="Y" {{($extractdata['application_details']['criminal_offence']=="Y")?"checked":NULL}} required="" disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="is_arrested">
                                                      <input type="radio" name="is_arrested" id="is_arrested" value="N" {{($extractdata['application_details']['criminal_offence']=="N")?"checked":NULL}} required="" class="__readonly" disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 {{($extractdata['application_details']['criminal_offence']=='Y')?'divshow':'divhide'}}" id="is_arrested_div">
                                            <div class="__review_radio">
                                                <p>If yes, have you ever been convicted of the offence(s)?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="is_convicted">
                                                      <input type="radio" class="__readonly" name="is_convicted" id="is_convicted" value="Y" {{($extractdata['application_details']['convicted_offence']=="Y")?"checked":NULL}} {{($extractdata['application_details']['criminal_offence']=="Y")?"required":NULL}} disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="is_convicted">
                                                      <input type="radio" class="__readonly" name="is_convicted" id="is_convicted" value="N" {{($extractdata['application_details']['convicted_offence']=="N")?"checked":NULL}} {{($extractdata['application_details']['criminal_offence']=="Y")?"required":NULL}} disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- clearfix -->
                                        <div class="clearfix"></div>
                                        <!-- clearfix end -->
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Have you ever been refused a visa application by the HKSAR or any other country/territory?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="is_refused">
                                                      <input type="radio" class="__readonly" name="is_refused" id="is_refused" value="Y" {{($extractdata['application_details']['refused_visa']=="Y")?"checked":NULL}} required="" disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="is_refused">
                                                      <input type="radio" class="__readonly" name="is_refused" id="is_refused" value="N" {{($extractdata['application_details']['refused_visa']=="N")?"checked":NULL}} required="" disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Have you ever been refused permission to enter the HKSAR or any other country/territory?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="is_refused_per">
                                                      <input type="radio" class="__readonly" name="is_refused_per" id="is_refused_per" value="Y" {{($extractdata['application_details']['refused_permission']=="Y")?"checked":NULL}} required="" disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="is_refused_per">
                                                      <input type="radio" class="__readonly" name="is_refused_per" id="is_refused_per" value="N" {{($extractdata['application_details']['refused_permission']=="N")?"checked":NULL}} required="" disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Have you ever been deported/removed from the HKSAR or any other country/territory?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="is_deported">
                                                      <input type="radio" class="__readonly" name="is_deported" id="is_deported" value="Y" {{($extractdata['application_details']['deported_country']=="Y")?"checked":NULL}} required="" disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="is_deported">
                                                      <input type="radio" class="__readonly" name="is_deported" id="is_deported" value="N" {{($extractdata['application_details']['deported_country']=="N")?"checked":NULL}} required="" disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- clearfix -->
                                        <div class="clearfix"></div>
                                        <!-- clearfix end -->
                                        <div class="col-md-4">
                                            <div class="__review_radio">
                                                <p>Do you seek to engage in or have you ever engaged in terrorist activities?<span class="strike">*</span></p>
                                                <div class="__prtyradio_box">
                                                    <label class="__review_radioinput" for="is_engage">
                                                      <input type="radio" class="__readonly" name="is_engage" id="is_engage" value="Y" {{($extractdata['application_details']['engaged_terrorist_activities']=="Y")?"checked":NULL}} required="" disabled="true">
                                                      <span>Yes</span>
                                                    </label>
                                                    <label class="__review_radioinput" for="is_engage">
                                                      <input type="radio" class="__readonly" name="is_engage" id="is_engage" value="N" {{($extractdata['application_details']['engaged_terrorist_activities']=="N")?"checked":NULL}} required="" disabled="true">
                                                      <span>NO</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- grey box end -->
                                    @if($extractdata['is_review_updated']=="N")
                                    <div class="col-md-12 text-center paddingtb_20">
                                        <button type="submit" class="__btn __btn_next btn_submit" id="hk_submit" disabled="">SUBMIT</button>
                                    </div>
                                    @endif
                                </div><!-- row end -->
                            <!-- Form wrapper -->
                            </form>
                            </div>
                        <!-- Tab Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
    close[i].onclick = function(){
        var div = this.parentElement;
        div.style.opacity = "0";
        setTimeout(function(){ div.style.display = "none"; }, 600);
    }
}
</script>    
@include('layouts.middle_footer')     
@stop