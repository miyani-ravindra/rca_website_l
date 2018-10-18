@extends('layouts.layout')
@section('product_bg')
<div class="container">
    <div class="row">
            <div class="col-md-offset-2 col-md-8 col-md-offset-2 paddingtb_20">
                <div class="__appl_box">
                    <div class="col-md-9">
                        <div class="__applicant_info">
                            <h2>{{$getorderdetails->product_name}}</h2>
                            <div class="__applicant_items">
                                <img src="{{URL::to('/')}}/svg/calendar.svg" alt="" width="15" /> {{date('d M Y', strtotime($getorderdetails->created_at))}}
                            </div>
                            <div class="__applicant_items">
                                <img src="{{URL::to('/')}}/svg/family.svg" alt="" width="20" /> {{!empty($getorderdetails->adult)?$getorderdetails->adult:0}} Adults {{!empty($getorderdetails->child)?$getorderdetails->child:0}} Child
                            </div>
                            <div class="__applicant_items">
                                Order ID: <b>{{ucfirst(trans($getorderdetails->order_code))}}</b>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="__appl_status"><span>Status </span> Application Not Submitted</h4>
                    </div>
                </div>
            </div>
    </div>
    <form method="post" action="/orders/application/" id="frmdocument">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="uid" id="uid" value="{{$getorderdetails->user_id}}">
            <input type="hidden" name="oid" id="oid" value="{{$getorderdetails->order_id}}"> 
    </form>
    <!-- Document upload section -->
        <div class="row">
            <div class="col-md-offset-2 col-md-8 col-md-offset-2">
                <div class="__accordbox">
                    @foreach($getapplicant as $key=>$val)
                    <div class="__accordrow">
                        <div class="__accord_head">
                                <div class="row">
                                <div class="col-md-4">
                                    <h2 class="__appl_name"><span>{{!empty($val->username)?$val->username:NULL}}</span></h2>
                                    <!-- checkbox -->
                                    <!-- <div class="__checkbox">
                                        <input type="checkbox" name="primary" id="adult1">
                                        <label for="adult1">I am primary applicant</label>
                                    </div> -->
                                </div>
                                <div class="col-md-4">
                                    <div class="__docs_status">
                                        <p>Document Submission</p>
                                        <p>Application Form</p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="__docs_status">
                                        <p class="{{!empty($val->doc_type)?'complete':'incomplete'}}">{{!empty($val->doc_type)?'Complete':'Incomplete'}}</p>
                                        <p class="{{($val->is_submitted=='Y')?'complete':'incomplete'}}">{{($val->is_submitted=='Y')?'Completed':'Incomplete'}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- panel body -->
                        <div class="panel">
                            <div class="panel_body">
                                <ul class="__appt_tabs">
                                    <li class="active" data-tabs="tab-1">Documents</li>
                                    <li data-tabs="tab-2">Application</li>
                                    <li data-tabs="tab-3">Download Visa</li>
                                </ul>
                                <div id="tab-1" class="__appt_tab_content active">
                                    <div><strong>Visa Documents</strong>
                                    </div>
                                    <div class="__document_upload_box">
                    <!-- passport front -->
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                            @foreach($docdata['PASSPORT_FRONT'] as $key=>$frontval)
                            @if(isset($frontval->doc_url) && isset($frontval->applicant_id) && ($frontval->applicant_id == $val->profile_id))
                                <img src="{{$frontval->doc_url}}" id="front-{{$val->profile_id}}">
                            @else
                                <div class="doc-head">Colored frontpage of valid passport</div>
                            @endif
                            @endforeach
                        </div>
                        <div>
                            <span class="btn btn-default btn-file"><span class="fileinput-new">Upload Document</span><!-- <span class="fileinput-exists">Change</span> -->
                            <input type="file" name="frontpage" onchange="uploadfile($(this),'PASSPORT_FRONT', {{$val->user_id}}, {{$val->profile_id}});">
                            </span>
                            <!-- <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> -->
                        </div>
                    </div>
                    <!-- end -->
                    <!-- passport Back -->
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                            @foreach($docdata['PASSPORT_BACK'] as $key=>$backval)
                            @if(isset($backval->doc_url) && isset($backval->applicant_id) && ($backval->applicant_id == $val->profile_id))
                                <img src="{{$backval->doc_url}}" id="back-{{$val->profile_id}}">
                            @else
                                <div class="doc-head">Colored backpage of valid passport</div>
                            @endif
                            @endforeach
                        </div>
                        <div>
                            <span class="btn btn-default btn-file"><span class="fileinput-new">Upload Document</span><!-- <span class="fileinput-exists">Change</span> -->
                            <input type="file" name="backpage" onchange="uploadfile($(this),'PASSPORT_BACK', {{$val->user_id}}, {{$val->profile_id}});">
                            </span>
                            <!-- <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> -->
                        </div>
                    </div>
                    <!-- end -->
                    <!-- passport size photograph -->
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                            @foreach($docdata['PHOTO'] as $key=>$photoval)
                            @if(isset($photoval->doc_url) && isset($photoval->applicant_id) && ($photoval->applicant_id == $val->profile_id))
                                <img src="{{$photoval->doc_url}}" id="photo-{{$val->profile_id}}">
                            @else
                                <div class="doc-head">Passport Size Photograph</div>
                            @endif
                            @endforeach
                        </div>
                        <div>
                            <span class="btn btn-default btn-file"><span class="fileinput-new">Upload Document</span><!-- <span class="fileinput-exists">Change</span> -->
                            <input type="file" name="photograph" onchange="uploadfile($(this),'PHOTO', {{$val->user_id}}, {{$val->profile_id}});">
                            </span>
                            <!-- <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> -->
                        </div>
                    </div>
                    <!-- end -->
                    <!-- Additional Document -->
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                            @if(isset($docdata[3]->doc_url) && isset($docdata[3]->applicant_id) && ($docdata[3]->applicant_id == $val->profile_id))
                                <img src="{{$docdata[3]->doc_url}}" id="doc1-{{$val->profile_id}}">
                            @else
                                <div class="doc-head">Additional Document</div>
                            @endif
                        </div>
                        <div>
                            <span class="btn btn-default btn-file"><span class="fileinput-new">Upload Document</span><!-- <span class="fileinput-exists">Change</span> -->
                            <input type="file" name="extra_doc1" onchange="uploadfile($(this),'additional doc', {{$val->user_id}}, {{$val->profile_id}});">
                            </span>
                            <!-- <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> -->
                        </div>
                    </div>
                    <!-- end -->
                    <!-- Additional Document -->
                    <div class="fileinput fileinput-new" data-provides="fileinput">
                        <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                            @if(isset($docdata[4]->doc_url) && isset($docdata[4]->applicant_id) && ($docdata[4]->applicant_id == $val->profile_id))
                                <img src="{{$docdata[4]->doc_url}}" id="doc2-{{$val->profile_id}}">
                            @else
                                <div class="doc-head">Additional Document</div>
                            @endif
                        </div>
                        <div>
                            <span class="btn btn-default btn-file"><span class="fileinput-new">Upload Document</span><!-- <span class="fileinput-exists">Change</span> -->
                            <input type="file" name="extra_doc2" onchange="uploadfile($(this),'additional doc', {{$val->user_id}}, {{$val->profile_id}});">
                            </span>
                            <!-- <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> -->
                        </div>
                    </div>
                    <!-- end -->
                </div>
                                </div>
                                <!-- Application Tab -->
                                <div id="tab-2" class="__appt_tab_content">
                                    <div class="row">
                                        <div class="col-md-5 padding0">
                                            <div class="__app_img">
                                            </div>
                                        </div>
                                        <div class="col-md-7 padding0">
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
                                <!-- Download Visa Tab -->
                                <div id="tab-3" class="__appt_tab_content">
                                    <div class="__download_visa paddingtb_20">
                                        <h4>Hurrey...</h4>
                                        <p class="__para">your visa is ready,
                                            <br>we wish you very happy and safe journey</p>
                                        <div class="download_box">
                                            <div class="download_info">
                                                <h6>30 Days dubai tourist visa</h6>
                                                <p>Valid till 04/06/2018</p>
                                                <img src="images/download-visa.png" alt="" class="visa_ticket" width="100" />
                                            </div>
                                            <button class="download_btn"><i class="fa fa-download"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
</div>
<!-- Top bg End -->
@stop