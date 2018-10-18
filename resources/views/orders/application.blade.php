@extends('layouts.layout')
@section('product_bg')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="__applicant_info paddingtb_10">
                <h2>{{$getorderdetails->product_name}}</h2>
                <div class="__applicant_items">
                    <img src="svg/calendar.svg" alt="" width="15" /> {{date('d M Y', strtotime($getorderdetails->created_at))}}</div>
                <div class="__applicant_items"><img src="svg/family.svg" alt="" width="20" /> {{!empty($getorderdetails->adult)?$getorderdetails->adult:0}} Adults {{!empty($getorderdetails->child)?$getorderdetails->child:0}} Child</div>
                <div class="__applicant_items"> Order ID: <b>{{ucfirst(trans($getorderdetails->order_code))}}</b> </div>
            </div>
            <hr class="fw" />
        </div>
        <div class="col-md-12">
            <div class="__travel_dts">
                <h5 class="__heading">Travel Details <span class="_edit" id="edit_info">Edit <i class="fa fa-edit"></i></span></h5>
                <div class="__travel_input">
                    <div class="col-md-3 form-group">
                        <label>Name</label>
                        <input type="text" name="" id="editusername" value="{{!empty($getuser->username)?$getuser->username:NULL}}" readonly="" />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Email</label>
                        <input type="email" name="" id="editemail" value="{{!empty($getuser->email_id)?$getuser->email_id:NULL}}" readonly="" />
                    </div>
                    <div class="col-md-4 form-group">
                        <label>Phone</label>
                        <input type="text" name="" id="editphone" value="{{!empty($getuser->mobile_no)?$getuser->mobile_no:NULL}}" readonly="" />
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-3 form-group">
                        <label>Date of Travel</label>
                        <input type="text" name="" id="editdate" value="{{!empty($getorderdetails->travel_date)?date('d/m/Y', strtotime($getorderdetails->travel_date)):NULL}}" readonly="" />
                    </div>
                    @if($getorderdetails->product_id==1)
                    <div class="col-md-4 form-group">
                        <label>Airline</label>
                        <input type="text" name="" id="editairline" value="Sharjah Airport" readonly="" />
                    </div>
                    @endif
                    <div class="col-md-4 form-group">
                        <label>Nationality</label>
                        <input type="text" name="" id="editnation" value="{{!empty($getorderdetails->nationality)?$getorderdetails->country_name:NULL}}" readonly="" />
                        <input type="hidden" name="nationality" id="nationality" value="{{!empty($getorderdetails->nationality)?$getorderdetails->nationality:0}}">
                    </div>
                    <div class="col-md-6">
                        <div class="alert __alert_success" id="message_box" style="display: none;"></div>
                        <input type="hidden" id="edituid" value="{{$getuser->user_id}}">
                        <input type="hidden" id="editoid" value="{{$getorderdetails->order_id}}">
                        <button type="button" class="__btn __btn_submit" id="save" style="display: none;">SAVE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="/orders/documents/" id="frmdocument">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="uid" id="uid" value="{{$getorderdetails->user_id}}">
            <input type="hidden" name="oid" id="oid" value="{{$getorderdetails->order_id}}"> 
    </form>
</div>
<!-- Top bg End -->
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- <div class="col-md-4 padding0">
            <div class="__checkbox">
                <input type="checkbox" name="primary" id="primary">
                <label for="primary">are you travelling?</label>
            </div>
        </div> -->
        <div class="clearfix"></div>
        <div class="col-md-12 padding0">
            <ul class="__appt_nav">
                <li>MY APPLICANTS</li>
                <li><a href="#" onclick="$('#frmdocument').submit();">DOCUMENTS</a></li>
                <li><a href="#" class="active">APPLICATION</a></li>
            </ul>
        </div>
        <div class="col-md-12 padding0">
            <ul class="__appt_tabs">
                @foreach($getapplicant as $key=>$val)
                    @if($key==0)
                        <li data-tabs="tab-{{$key}}" class="active">{{!empty($val->username)?$val->username:NULL}}</li>
                    @else
                        <li data-tabs="tab-{{$key}}" class="">{{!empty($val->username)?$val->username:NULL}}</li>
                    @endif
                @endforeach
            </ul>
            @foreach($getapplicant as $key=>$val)
                @if($key==0)
                    <div id="tab-{{$key}}" class="__appt_tab_content active">
                @else
                    <div id="tab-{{$key}}" class="__appt_tab_content">
                @endif
                <div class="paddingtb_20">
                    <div class="col-md-6">
                        <div class="__app_img">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="__app_form">
                            <div class="alert __alert_success" id="message-box" style="display: none;"></div>
                            <form method="post" name="app_frm" id="frmapplication_{{$val->profile_id}}">
                                <input type="hidden" id="user_id" name="user_id" value="{{$val->user_id}}">
                                <input type="hidden" id="app_id" name="app_id" value="{{$val->profile_id}}">
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="surname" value="{{!empty($val->surname)?$val->surname:NULL}}" required />
                                    <label>Surname*</label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="username" value="{{!empty($val->username)?$val->username:NULL}}" required />
                                    <label>Given Names*</label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="passport" value="{{!empty($val->pp_no)?$val->pp_no:NULL}}" required />
                                    <label>Passport No* </label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="__select_box">
                                    <label>Passport Type* </label>
                                    <select class="__select" name="pass_type">
                                        <option value="">Select Passport Type </option>
                                        @foreach($getpasstype as $valpp)
                                        <option value="{{$valpp->passport_type_id}}" {{($valpp->passport_type_id==$val->pp_type)?'selected':NULL}}>{{$valpp->passport_type_name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="group">
                                <div class="__select_box">
                                    <label>Passport Issuing Government*</label>
                                    <select class="__select" name="pass_issue">
                                        <option>Select Passport Issuing Govt.</option>
                                        <option value="1" {{($val->pp_issuing_govt==1)?'selected':NULL}}>Option 1</option>
                                        <option value="2" {{($val->pp_issuing_govt==2)?'selected':NULL}}>Option 2</option>
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="group">
                                <div class="__select_box">
                                    <label>Nationality*</label>
                                    <select class="__select" name="nation">
                                        <option value="">Select Nationality.</option>
                                        <option value="Indian" selected="">Indian</option>
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="group">
                                <div class="__select_box">
                                    <label>Gender*</label>
                                    <select class="__select" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{($val->gender=='male')?'selected':NULL}}>Male</option>
                                        <option value="female" {{($val->gender=='female')?'selected':NULL}}>Female</option>
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="group">
                                <div class="__dateinput">
                                    <label>Date of Birth* (DD/MM/YYYY)</label>
                                    <input type="text" name="dob" value="{{!empty($val->dob)?$val->dob:NULL}}" class="datepicker" required>
                                </div>
                            </div>
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="place_birth" value="{{!empty($val->place_of_birth)?$val->place_of_birth:NULL}}" required />
                                    <label>Place of Birth* </label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="__dateinput">
                                    <label>Date of Expiry* (DD/MM/YYYY)</label>
                                    <input type="text" name="dob_exp" value="{{!empty($val->pp_expiry_date)?$val->pp_expiry_date:NULL}}" class="datepicker" required />
                                </div>
                            </div>
                            <div class="group">
                                <div class="__select_box">
                                    <label>Marital Status*</label>
                                    <select class="__select" name="marital_status">
                                        <option>Select Marital Status</option>
                                        @foreach($getmarital as $mval)
                                        <option value="{{$mval->marital_status_id}}" {{($mval->marital_status_id==$val->marital_status_id)?'selected':NULL}}>{{$mval->marital_status_name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="group">
                                <div class="__select_box">
                                    <label>Religion*</label>
                                    <select class="__select" name="religion">
                                        <option value="">Select Religion</option>
                                        @foreach($getreligion as $rval)
                                        <option value="{{$rval->religion_id}}" {{($rval->religion_id==$val->religion)?'selected':NULL}}>{{$rval->religion_name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="group">
                                <div class="__select_box">
                                    <label>Language Spoken*</label>
                                    <select class="__select" name="lang">
                                        <option value="">Select Language Spoken</option>
                                        @foreach($getlang as $lval)
                                        <option value="{{$lval->lang_id}}" {{($lval->lang_id==$val->language)?'selected':NULL}}>{{$lval->lang_name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="group">
                                <div class="__select_box">
                                    <label>Profession*</label>
                                    <select class="__select" name="profession">
                                        <option value="">Select Profession</option>
                                        @foreach($getpropfession as $pval)
                                        <option value="{{$pval->profession_id}}" {{($pval->profession_id==$val->profession)?'selected':NULL}}>{{$pval->profession_name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="f_name" value="{{!empty($val->father_name)?$val->father_name:NULL}}" required />
                                    <label>Father’s name* </label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="m_name" value="{{!empty($val->mother_name)?$val->mother_name:NULL}}" required />
                                    <label>Mother’s name* </label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="h_name" value="{{!empty($val->husband_name)?$val->husband_name:NULL}}" required />
                                    <label>Husband’s name*</label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="add1" value="{{!empty($val->address1)?$val->address1:NULL}}" required />
                                    <label>Address Line 1*</label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="add2" value="{{!empty($val->address2)?$val->address2:NULL}}" required />
                                    <label>Address Line 2*</label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="city" value="{{!empty($val->city)?$val->city:NULL}}" required />
                                    <label>City</label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="__select_box">
                                    <label>Country*</label>
                                    <select class="__select" name="country">
                                        <option value="">Select Country</option>
                                        @foreach($getcountry as $cval)
                                        <option value="{{$cval->country_id}}" {{($cval->country_id==$val->country)?'selected':NULL}}>{{$cval->country_name}}</option>
                                        @endforeach
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="group">
                                <button type="submit" id="btn_application" class="__btn __btn_submit">SUBMIT</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@stop