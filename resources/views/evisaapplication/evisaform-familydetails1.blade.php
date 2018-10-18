@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <form method="post" id="frmevisafamilyform" name="frmevisafamilyform" action="{{URL::to('/')}}/evisa/visa-details/{{$getpostdata['residing_code']}}">
                            <input type="hidden" name="residing_in" id="residing_in" value="{{$getpostdata['residing_in']}}">
                            <input type="hidden" name="residing_code" id="residing_code" value="{{$getpostdata['residing_code']}}">
                            <input type="hidden" name="nationality" id="nationality" value="{{$getpostdata['nationality']}}">
                            <input type="hidden" name="order_id" id="order_id" value="{{$getpostdata['order_id']}}">
                            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$getpostdata['applicant_id']}}">
                            <input type="hidden" name="uid" id="uid" value="{{$getpostdata['uid']}}">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
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
                        <div id="tab-1" class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading">eVisa</h1>
                                    <div class="__progress_wrapper">
                                        <ul class="__progress">
                                            <li class="active _100">Basic Info + Document Upload</li>
                                            <li class="active _50">Form Filling</li>
                                            <li class="">Verification</li>
                                            <li class="">Payment</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                            <p class="__form_notes">Applicant's Address Details</p>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="__app_form">
                                            <div class="col-md-12">
                                                <h5 class="paddingtb_10">Present Address</h5>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>House No./Street <span class="_astrik">*</span></label>
                                                    <input type="text" name="pres_add1" value="" required="" />
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Village/Town/City  <span class="_astrik">*</span></label>
                                                    <input type="text" name="pres_add2" value="" required="" />
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Country  <span class="_astrik">*</span></label>
                                                    <select class="__select" name="pres_country" required="">
                                                        <option value="">Select Country</option>
                                                        @foreach($getcountry as $row)
                                                        <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>State/Province/District  <span class="_astrik">*</span></label>
                                                    <input type="text" name="state_name" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Postal/Zip Code  <span class="_astrik">*</span></label>
                                                    <input type="text" name="pincode" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Phone No.</label>
                                                    <input type="text" name="pres_phone">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Mobile No.</label>
                                                    <input type="text" name="mobile_no" value="{{!empty($getapplicatdata->mobile_number)?$getapplicatdata['mobile_number']:NULL}}" readonly="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Email Address</label>
                                                    <input type="email" name="email_id" value="{{!empty($getapplicatdata->email_id)?$getapplicatdata['email_id']:NULL}}" readonly="">
                                                </div>
                                            </div>
                                            <div class="__app_input">
                                                <input id="sameAddress_id" name="sameAddress_id" type="checkbox" class="__checkbox" value="" />
                                                <label for="sameAddress_id">Click here for same address</label>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="paddingtb_10">Permanent Address</h5>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>House No./Street  <span class="_astrik">*</span></label>
                                                    <input type="text" name="perm_address1" value="" required="" />
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Village/Town/City </label>
                                                    <input type="text" name="perm_address2" value="" />
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>State/Province/District</label>
                                                    <input type="text" name="perm_address3">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <h5 class="paddingtb_10">Father's Details</h5>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Name  <span class="_astrik">*</span></label>
                                                    <input type="text" name="fthrname" required="" value="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Nationality  <span class="_astrik">*</span></label>
                                                    <select class="__select" name="father_nationality" required="">
                                                        <option value="">Select Nationality</option>
                                                        @foreach($getcountry as $val)
                                                        <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Previous Nationality</label>
                                                    <select class="__select" name="father_previous_nationality">
                                                        <option value="">Select Nationality</option>
                                                        @foreach($getcountry as $val)
                                                        <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Place of birth  <span class="_astrik">*</span></label>
                                                    <input type="text" name="father_place_of_birth" required="" value="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Country of birth  <span class="_astrik">*</span></label>
                                                    <select class="__select" name="father_country_of_birth" required="">
                                                        <option value="">Select Country</option>
                                                        @foreach($getcountry as $val)
                                                        <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-md-12">
                                                <h5 class="paddingtb_10">Mother's Details</h5>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Name  <span class="_astrik">*</span></label>
                                                    <input type="text" name="mother_name" required="" value="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Nationality  <span class="_astrik">*</span></label>
                                                    <select class="__select" name="mother_nationality" required="">
                                                        <option value="">Select Nationality</option>
                                                        @foreach($getcountry as $val)
                                                        <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Previous Nationality</label>
                                                    <select class="__select" name="mother_previous_nationality">
                                                        <option value="">Select Nationality</option>
                                                        @foreach($getcountry as $val)
                                                        <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Place of birth  <span class="_astrik">*</span></label>
                                                    <input type="text" name="mother_place_of_birth" required="" value="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Country of birth  <span class="_astrik">*</span></label>
                                                    <select class="__select" name="mother_country_of_birth" required="">
                                                        <option value="">Select Country</option>
                                                        @foreach($getcountry as $val)
                                                        <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Applicant's Marital Status  <span class="_astrik">*</span></label>
                                                    <select class="__select" name="marital_status" required="">
                                                        <option value="">Select Marital Status</option>
                                                        @foreach($getmarital as $val)
                                                        <option value="{{$val->marital_status_id}}">{{$val->marital_status_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="spouse_div">
                                                <div class="col-md-12">
                                                <h5 class="paddingtb_10">Spouse's Details</h5>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Name</label>
                                                    <input type="text" name="spouse_name" value="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Nationality</label>
                                                    <select class="__select" name="spouse_nationality">
                                                        <option value="">Select Nationality</option>
                                                        @foreach($getcountry as $val)
                                                        <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Previous Nationality</label>
                                                    <select class="__select" name="spouse_previous_nationality">
                                                        <option value="">Select Nationality</option>
                                                        @foreach($getcountry as $val)
                                                        <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Place of birth</label>
                                                    <input type="text" name="spouse_place_of_birth" value="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Country of birth</label>
                                                    <select class="__select" name="spouse_country_of_birth">
                                                        <option value="">Select Country</option>
                                                        @foreach($getcountry as $val)
                                                        <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="__form_yes_no">
                                                <p>Grandparents - Pakistan Nationals/ belong to pakistan held area?  <span class="_astrik">*</span></p>
                                                <div class="__inline">
                                                    <label class="__radio">Yes
                                                        <input type="radio" name="grandparent_flag1" value="Y" required="">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="__radio">No
                                                        <input type="radio" name="grandparent_flag1" value="N" checked="" required="">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="group" id="grandparent_details">
                                                <div class="__app_input">
                                                    <label>If Yes, give details</label>
                                                    <input type="text" name="grandparent_details" value="">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <h5 class="paddingtb_10">Profession / Occupation Details of Applicant</h5>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Present Occupation  <span class="_astrik">*</span></label>
                                                    <select class="__select" name="pre_occupation" required="">
                                                        <option value="">Select Occupation</option>
                                                        @foreach($getpropfession as $val)
                                                        <option value="{{$val->id}}">{{$val->occupation_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
					    <div class="group" id="if_prof_other">
                                                <div class="__app_input">
                                                    <label>Occupation (If Other)<span class="_astrik">*</span></label>
                                                    <input type="text" name="if_prof_other">
                                                </div>
                                            </div>
                                            <div class="group" id="occ_flag">
                                                <div class="__select_box">
                                                    <label>Specify below occupation details of</label>
                                                    <select class="__select" name="occ_flag">
                                                        <option value="">Select...</option>
                                                        <option value="F">Father</option>
                                                        <option value="S">Spouse</option>
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Employer Name/business</label>
                                                    <input type="text" name="empname" value="" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Designation</label>
                                                    <input type="text" name="empdesignation" value="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Address  <span class="_astrik">*</span></label>
                                                    <input type="text" name="empaddress" value="" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Phone</label>
                                                    <input type="text" name="empphone" value="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Past Occupation, if any</label>
                                                    <select class="__select" name="previous_occupation">
                                                        <option value="">Select Occupation</option>
                                                        @foreach($getpropfession as $val)
                                                        <option value="{{$val->id}}">{{$val->occupation_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                            <div class="__form_yes_no">
                                                <p>Are/were you in a Military/Semi-Military/Police/Security. Organization?  <span class="_astrik">*</span></p>
                                                <div class="__inline">
                                                    <label class="__radio">Yes
                                                        <input type="radio" name="prev_org" value="Y" required="">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="__radio">No
                                                        <input type="radio" name="prev_org" value="N" checked="" required="">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="prev_org_div">
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Organization</label>
                                                    <input type="text" name="previous_organization" value="">
                                                </div>
                                            </div>    
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Designation</label>
                                                    <input type="text" name="previous_designation" value="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Rank</label>
                                                    <input type="text" name="previous_rank" value="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Place of Posting</label>
                                                    <input type="text" name="previous_posting" value="">
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-12 text-center paddingtb_20">
                                        <button type="submit" class="__btn __btn_next" name="btn_family_details">NEXT STEP</button>
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
