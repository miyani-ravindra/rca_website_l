@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <form method="post" id="frmevisaform" name="frmevisaform" action="{{URL::to('/')}}/evisa-form/family-details/{{$getpostdata['residing_code']}}">
                            <input type="hidden" name="residing_in" id="residing_in" value="{{$getpostdata['residing_in']}}">
                            <input type="hidden" name="residing_code" id="residing_code" value="{{$getpostdata['residing_code']}}">
                            <input type="hidden" name="nationality" id="nationality" value="{{$getpostdata['nationality']}}">
                            <input type="hidden" name="order_id" id="order_id" value="{{$getpostdata['order_id']}}">
                            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$getpostdata['applicant_id']}}">
                            <input type="hidden" name="uid" id="uid" value="{{$getpostdata['uid']}}">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="documentCode" value="{{(isset($getocr['documentCode']) && !empty($getocr['documentCode']))?$getocr['documentCode']:NULL}}">
                            <input type="hidden" name="issue_gov" value="{{isset($getocr['issuerOrg']['abbr']) && !empty($getocr['issuerOrg']['abbr'])?$getocr['issuerOrg']['abbr']:NULL}}">
                            <input type="hidden" name="passport_type" value="{{$getpostdata['passport_type']}}">
                            <input type="hidden" name="order_code" value="{{!empty($getpostdata['order_code'])?$getpostdata['order_code']:NULL}}">
                        <ul class="tabs_z">
                            <li class="__current">
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">eVisa</span>
                                    <img src="{{ URL::to('/') }}/svg/E-visa.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="meet-and-assist.html">
                                    <span class="__title">AIRPORT MEET &amp; GREET</span>
                                    <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
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
                                            <li class="active _100">Basic Info + Document Upload</li>
                                            <li class="active _30">Form Filling</li>
                                            <li class="">Verification</li>
                                            <li class="">Payment</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="__stylish_head">We are ready to fill the form.</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                            @if(!isset($getocr['error']))
                                            <p class="__form_notes">Actually, we got you covered. We populated the form with the information available on the passport.</p>
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="__app_img">
                                                <img src="{{URL::to('/')}}/{{$getapplicatdata['doc_url']}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 padding0">
                                        <div class="__app_form">
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Given Name <span class="_astrik">*</span></label>
                                                    <input type="text" name="given_name" value="{{isset($getocr['names']['lastName']) && !empty($getocr['names']['lastName'])?$getocr['names']['lastName']:NULL}}" required="" />
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Surname Name</label>
                                                    <input type="text" name="surname" value="{{isset($getocr['names']['firstName']) && !empty($getocr['names']['firstName'])?$getocr['names']['firstName']:NULL}}" />
                                                </div>
                                            </div>
                                            <div class="__app_input">
                                                <input id="name_changed" name="name_changed" type="checkbox" class="__checkbox" value="" />
                                                <label for="name_changed">I have changed my name previously</label>
                                            </div>
                                            <div class="group" id="previous_surname">
                                                <div class="__app_input">
                                                    <label>Previous Surname</label>
                                                    <input type="text" name="previous_surname" value="" />
                                                </div>
                                            </div>
                                            <div class="group" id="previous_name">
                                                <div class="__app_input">
                                                    <label>Previous Name</label>
                                                    <input type="text" name="previous_name" value="" />
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Gender <span class="_astrik">*</span></label>
                                                    <select class="__select" name="gender" required="">
                                                        <option value="">Select Gender </option>
                                                        <option value="M" {{isset($getocr['sex']['abbr']) && ($getocr['sex']['abbr']=='M')?'selected':NULL}}>MALE</option>
                                                        <option value="F" {{isset($getocr['sex']['abbr']) && ($getocr['sex']['abbr']=='F')?'selected':NULL}}>FEMALE</option>
                                                        <option value="T" {{isset($getocr['sex']['abbr']) && ($getocr['sex']['abbr']=='T')?'selected':NULL}}>TRANSGENDER</option>
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__dateinput">
                                                    <label>Date of Birth (DD/MM/YYYY) <span class="_astrik">*</span></label>
                                                    <input type="text" id="dob" name="dob" class="dob datepicker" value="{{isset($getocr['dob']) && !empty($getocr['dob'])?$getocr['dob']:NULL}}" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Country Of Birth <span class="_astrik">*</span></label>
                                                    <select class="__select" name="cob" required="">
                                                        <option value="">Select Country of Birth</option>
                                                        @foreach($getcountry as $row)
                                                        <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>City/Town of Birth <span class="_astrik">*</span></label>
                                                    <input type="text" name="city_birth" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>National ID Number <span class="_astrik">*</span></label>
                                                    <input type="text" name="nation_id" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Religion <span class="_astrik">*</span></label>
                                                    <select class="__select" name="religion_code" required="">
                                                        <option value="">Select Religion</option>
                                                        @foreach($getreligion as $row)
                                                        <option value="{{$row->religion_id}}">{{$row->religion_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Visible Identification Marks <span class="_astrik">*</span></label>
                                                    <input type="text" name="visible_marks" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Educational Qualification <span class="_astrik">*</span></label>
                                                    <select class="__select" name="qualification" required="">
                                                        <option value="">Select Qualification</option>
                                                        @foreach($getqualification as $row)
                                                        <option value="{{$row->id}}">{{$row->qualification}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Nationality <span class="_astrik">*</span></label>
                                                    <select class="__select" name="nationality" required="">
                                                        <option value="">Select Nationality</option>
                                                        @foreach($getcountry as $val)
                                                        <option value="{{$val->country_id}}" {{isset($getocr['nationality']['country_id']) && ($val->country_id==$getocr['nationality']['country_id'])?'selected':NULL}}>{{$val->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Aquired Nationality by <span class="_astrik">*</span></label>
                                                    <select class="__select" id="aquired_nation" name="aquired_nation" required="">
                                                        <option value="">Select...</option>
                                                        <option value="By Birth">By Birth</option>
                                                        <option value="Naturalization">Naturalization</option>
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group" id="prev_nationality">
                                                <div class="__select_box">
                                                    <label>Prev. Nationality <span class="_astrik">*</span></label>
                                                    <select class="__select" name="prev_nationality">
                                                        <option value="">Select Nationality</option>
                                                        @foreach($getcountry as $row)
                                                        <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="__form_yes_no">
                                                <p>Have you lived for at least two years in the country where you are applying visa?</p>
                                                <div class="__inline">
                                                    <label class="__radio">Yes
                                                        <input type="radio" name="refer_flag" value="Y" required="">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="__radio">No
                                                        <input type="radio" name="refer_flag" value="N" required="">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="paddingtb_10">Passport Details</h5>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Passport Number</label>
                                                    <input type="text" name="Passport_number" required="" value="{{isset($getocr['documentNumber']) && !empty($getocr['documentNumber'])?$getocr['documentNumber']:NULL}}" maxlength="14" />
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Place of Issue</label>
                                                    <input type="text" name="issue_place" required="" value="" />
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__dateinput">
                                                    <label>Date of Issue</label>
                                                    <input type="text" id="doi" name="doi" class="dob datepicker" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__dateinput">
                                                    <label>Date of Expiry</label>
                                                    <input type="text" id="doe" name="doe" class="dob datepicker" required="" value="{{isset($getocr['expiry']) && !empty($getocr['expiry'])?$getocr['expiry']:''}}">
                                                </div>
                                            </div>
                                            <div class="__form_yes_no">
                                                <p>Any other valid Passport/Identity Certificate(IC) held,</p>
                                                <div class="__inline">
                                                    <label class="__radio">Yes
                                                        <input type="radio" id="oth_ppt" name="oth_ppt" value="Y" required="">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="__radio">No
                                                        <input type="radio" id="oth_ppt" name="oth_ppt" value="N" required="">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                            </div>
                                            <div class="group" id="prev_passport_country_issue">
                                                <div class="__select_box">
                                                    <label>Country of Issue</label>
                                                    <select class="__select" name="prev_passport_country_issue">
                                                        <option value="">Select Country</option>
                                                        @foreach($getcountry as $row)
                                                        <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group" id="other_ppt_no">
                                                <div class="__app_input">
                                                    <label>Passport/IC No.</label>
                                                    <input type="text" name="other_ppt_no" value="" />
                                                </div>
                                            </div>
                                            <div class="group" id="other_ppt_issue_place">
                                                <div class="__app_input">
                                                    <label>Place of Issue</label>
                                                    <input type="text" name="other_ppt_issue_place" value="" />
                                                </div>
                                            </div>
                                            <div class="group" id="other_ppt_date_issue">
                                                <div class="__dateinput">
                                                    <label>Date of Issue</label>
                                                    <input type="text" id="other_ppt_issue_date" name="other_ppt_issue_date" class="dob datepicker">
                                                </div>
                                            </div>
                                            <div class="group" id="other_ppt_nationality">
                                                <div class="__select_box">
                                                    <label>Nationality mentioned therein</label>
                                                    <select class="__select" name="other_ppt_nationality">
                                                        <option value="">Select Country</option>
                                                        @foreach($getcountry as $row)
                                                        <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-12 text-center paddingtb_20">
                                        <button type="submit" class="__btn __btn_next" name="btn_basic_form">NEXT STEP</button>
                                    </div>
                                </div>
                                <!-- row end -->
                            </div>
                            <!-- Form wrapper -->
                        </div>
                        <!-- Tab Content End -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.middle_footer')     
@stop
