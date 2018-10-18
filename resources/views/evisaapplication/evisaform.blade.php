@extends('layouts.layout')
@section('content')
<div class="clearfix"></div>
<div class="__bg">
<div class="container container-sm">
   <div class="row">
      <div class="col-md-12">
         <div class="paddingtb_50">
            <div id="save_form_msg" style="display: none;"></div>
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
               <input type="hidden" name = "pp_id" value="{{!empty($getpostdata['pp_id'])?$getpostdata['pp_id']:NULL}}">
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
                           <div class="col-md-12 padding0">
			                     <div class="__app_img stikcy" style="min-height: 150px;">
                                 <img src="{{URL::to('/')}}/{{$getapplicatdata['doc_url']}}">
                              </div>
                              <div class="upform stikcy_form">
                                 <div class="upform-main">
                                    <div class="input-block active">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Given Name
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Given Name?</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="given_name" value="{{isset($ocrlastname) && !empty($ocrlastname)?$ocrlastname:NULL}}"  required=""  />
                                          <div class="press_enter">PRESS TAB</div>
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Surname
                                             <!-- <span class="strike">*</span> -->
                                             <div class="qs_sub">Surname</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="surname" value="{{isset($ocrfristname) && !empty($ocrfristname)?$ocrfristname:NULL}}"/>
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                I have changed my name previously
                                                <!-- <span class="strike">*</span> -->
                                                <div class="qs_sub"></div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <label class="radio inline">
                                             <input type="radio" name="name_changed" value="Y" required="" id="name_changed_y" {{(!empty($getpostdata['is_changed_name']) && $getpostdata['is_changed_name']=="Y")?"checked":NULL}}>
                                             <span>Yes</span>
                                             </label>
                                             <label class="radio inline">
                                             <input type="radio" name="name_changed" value="N" required="" id="name_changed_n" {{(!empty($getpostdata['is_changed_name']) && $getpostdata['is_changed_name']=="N")?"checked":NULL}}>
                                             <span>No</span>
                                             </label>
                                          </div>
                                       </div>
                                       <div class="input-block {{(!empty($getpostdata['is_changed_name']) && $getpostdata['is_changed_name']=='Y')?'divshow':'divhide'}}" id="previous_name">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Previous name
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Previous name</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="previous_name" value="{{isset($getpostdata['previous_name']) && !empty($getpostdata['previous_name'])?$getpostdata['previous_name']:NULL}}" />
                                       </div>
                                       </div>
                                       <div class="input-block {{(!empty($getpostdata['is_changed_name']) && $getpostdata['is_changed_name']=='Y')?'divshow':'divhide'}}" id="previous_surname">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Previous surname
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Previous surname</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="previous_surname" value="{{isset($getpostdata['previous_surname']) && !empty($getpostdata['previous_surname'])?$getpostdata['previous_surname']:NULL}}" />
                                       </div>
                                       </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Gender
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Gender</div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="gender" required="">
                                             <option value="">Select Gender </option>
                                             <option value="M" {{isset($getocr['sex']['abbr']) && ($getocr['sex']['abbr']=='M')?'selected':NULL}}>MALE</option>
                                             <option value="F" {{isset($getocr['sex']['abbr']) && ($getocr['sex']['abbr']=='F')?'selected':NULL}}>FEMALE</option>
                                             <option value="T" {{isset($getocr['sex']['abbr']) && ($getocr['sex']['abbr']=='T')?'selected':NULL}}>TRANSGENDER</option>
                                          </select-->
                                          <input type="text" name="gender_text" class=" __select_drop inputF" autocomplete="off" value="{{isset($getpostdata['gendername']) && !empty($getpostdata['gendername'])?$getpostdata['gendername']:NULL}}" required="" />
                                          <ul class="hiddenul">
                                              <li data-val="M">MALE</li>
                                              <li data-val="F">FEMALE</li>
                                              <li data-val="T">TRANSGENDER</li>
                                          </ul>
                                           <input type="hidden" name="gender" class="inputH" value="{{isset($getpostdata['gender']) && !empty($getpostdata['gender'])?$getpostdata['gender']:NULL}}">
                                       </div>
                                       <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block datepkr">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Date of Birth 
                                             <span class="strike">*</span>
                                             <div class="qs_sub">(DD/MM/YYYY)</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" id="dob" name="dob" class="dob datepicker" value="{{isset($ocrdob) && !empty($ocrdob)?$ocrdob:NULL}}" required="">
                                       </div>
                                    </div>
                                       <div class="input-block" id="contry_of_birth">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Country of Birth
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Country of Birth</div>
                                             </div>
                                          </div>
                                          <div class="input-control outerInFoc">
                                             <!--select class="__select_drop" name="cob" required="">
                                                <option value="">Select Country of Birth</option>
                                                @foreach($getcountry as $row)
                                                <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                @endforeach
                                             </select-->
                                            <input type="text" name="cob_text" required="" class="__select_drop inputF" autocomplete="off" value="{{!empty($getpostdata['country_of_name'])?$getpostdata['country_of_name']:NULL}}" />      
                                            <ul class="hiddenul">
                                                @foreach($getcountry as $row)
                                                  <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="cob" class="inputH" value="{{isset($getpostdata['country_of_birth']) && !empty($getpostdata['country_of_birth'])?$getpostdata['country_of_birth']:NULL}}">
                                          </div>
                                          <div class="outerclick"></div>
                                       </div>
                                       <div class="input-block">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Place of Birth
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Place of Birth</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" name="city_birth" value="{{isset($getpostdata['place_of_birth']) && !empty($getpostdata['place_of_birth'])?$getpostdata['place_of_birth']:NULL}}" required="">
                                          </div>
                                       </div>
                                       <div class="input-block">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                National Id
                                                <span class="strike">*</span>
                                                <div class="qs_sub">National Id</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" name="nation_id" value="{{isset($getpostdata['citizenship_no']) && !empty($getpostdata['citizenship_no'])?$getpostdata['citizenship_no']:NULL}}" required="">
                                          </div>
                                       </div>
                                       <div class="input-block outerInFoc">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Religion
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Religion</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <!--select class="__select_drop" name="religion_code" required="">
                                                <option value="">Select Religion</option>
                                                @foreach($getreligion as $row)
                                                <option value="{{$row->religion_id}}">{{$row->religion_name}}</option>
                                                @endforeach
                                             </select-->
                                              <input type="hidden" name="" class="inputH" value="{{isset($getpostdata['religion']) && !empty($getpostdata['religion'])?$getpostdata['religion']:NULL}}">
                                             <input type="text" name="religion_code_text" class="__select_drop inputF" autocomplete="off" value="{{isset($getpostdata['religionname']) && !empty($getpostdata['religionname'])?$getpostdata['religionname']:NULL}}" required=""/>
                                              <ul class="hiddenul">
                                                @foreach($getreligion as $row)
                                                  <li data-val="{{$row->religion_id}}">{{$row->religion_name}}</li>
                                                @endforeach
                                              </ul>
                                              <input type="hidden" name="religion_code" class="inputH" value="{{isset($getpostdata['religion']) && !empty($getpostdata['religion'])?$getpostdata['religion']:NULL}}">
                                          </div>
                                          <div class="outerclick"></div>
                                       </div>
                                       <div class="input-block">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Visible Identification Mark
                                                <span class="strike">*</span>
                                                <div class="qs_sub">If None Enter 'NA'</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" name="visible_marks" value="{{isset($getpostdata['visible_marks']) && !empty($getpostdata['visible_marks'])?$getpostdata['visible_marks']:NULL}}" required="">
                                          </div>
                                       </div>
                                       <div class="input-block outerInFoc">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Educational Qualification
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Educational Qualification</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <!--select class="__select_drop" name="qualification" required="">
                                                <option value="">Select Qualification</option>
                                                @foreach($getqualification as $row)
                                                <option value="{{$row->id}}">{{$row->qualification}}</option>
                                                @endforeach
                                             </select-->
                                             <input type="text" name="" class="__select_drop inputF" autocomplete="off" required="" value="{{isset($getpostdata['qualiname']) && !empty($getpostdata['qualiname'])?$getpostdata['qualiname']:NULL}}" />
                                              <ul class="hiddenul">
                                                @foreach($getqualification as $row)
                                                  <li data-val="{{$row->id}}">{{$row->qualification}}</li>
                                                @endforeach
                                              </ul>
                                              <input type="hidden" name="qualification" class="inputH" value="{{isset($getpostdata['qualification']) && !empty($getpostdata['qualification'])?$getpostdata['qualification']:NULL}}">
                                          </div>
                                          <div class="outerclick"></div>
                                       </div>
                                       <div class="input-block">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Nationality
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Nationality</div>
                                             </div>
                                          </div>
                                          <div class="input-control outerInFoc">
                                             <!--select class="__select_drop" name="nationality" required="">
                                                <option value="">Select Nationality</option>
                                                @foreach($getcountry as $val)
                                                <option value="{{$val->country_id}}" {{isset($getocr['nationality']['country_id']) && ($val->country_id==$getocr['nationality']['country_id'])?'selected':NULL}}>{{$val->country_name}}</option>
                                                @endforeach
                                             </select-->
                                             <input type="text" name="" class="__select_drop inputF" autocomplete="off" value="{{isset($getpostdata['nationname']) && !empty($getpostdata['nationname'])?$getpostdata['nationname']:NULL}}"  required=""/>
                                              <ul class="hiddenul">
                                                @foreach($getcountry as $val)
                                                  <li data-val="{{$val->country_id}}" {{isset($getocr['nationality']['country_id']) && ($val->country_id==$getocr['nationality']['country_id'])?'selected':NULL}}">{{$val->country_name}}</li>
                                                @endforeach
                                              </ul>
                                              <input type="hidden" name="nationality" class="inputH" value="{{isset($getpostdata['nationality']) && !empty($getpostdata['nationality'])?$getpostdata['nationality']:NULL}}">
                                          </div>
                                          <div class="outerclick"></div>
                                       </div>
                                       <div class="input-block">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Aquired Nationality by
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Aquired Nationality by</div>
                                             </div>
                                          </div>
                                          <div class="input-control outerInFoc">
                                             <!--select class="__select_drop" id="aquired_nation" name="aquired_nation" required="">
                                                <option value="">Select...</option>
                                                <option value="By Birth">By Birth</option>
                                                <option value="Naturalization">Naturalization</option>
                                             </select-->
                                             <input type="text" name="" class="__select_drop inputF" autocomplete="off"  required="" id="aquired_nation" value="{{isset($getpostdata['aquired_nation']) && !empty($getpostdata['aquired_nation'])?$getpostdata['aquired_nation']:NULL}}" />
                                                <ul class="hiddenul">
                                                    <li data-val="">Select...</li>
                                                    <li data-val="By Birth">By Birth</li>
                                                    <li data-val="Naturalization">Naturalization</li>
                                                </ul>
                                            <input type="hidden" name="aquired_nation" class="inputH" value="{{isset($getpostdata['aquired_nation']) && !empty($getpostdata['aquired_nation'])?$getpostdata['aquired_nation']:NULL}}">
                                          </div>
                                          <div class="outerclick"></div>
                                       </div>
                                       <div class="input-block {{(!empty($getpostdata['aquired_nation']) && $getpostdata['aquired_nation']=='Naturalization')?'showdiv':'hidediv'}}" id="prev_nationality">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Prev. Nationality
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Prev. Nationality</div>
                                             </div>
                                          </div>
                                          <div class="input-control outerInFoc">
                                             <!--select class="__select_drop" name="prev_nationality">
                                                <option value="">Select Nationality</option>
                                                @foreach($getcountry as $row)
                                                <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                @endforeach
                                             </select-->
                                             <input type="text" name="" class="__select_drop inputF" autocomplete="off" value="{{isset($getpostdata['prev_nation_name']) && !empty($getpostdata['prev_nation_name'])?$getpostdata['prev_nation_name']:NULL}}" />
                                                <ul class="hiddenul">
                                                    @foreach($getcountry as $row)
                                                       <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                                    @endforeach
                                                </ul>
                                            <input type="hidden" name="prev_nationality" class="inputH" value="{{isset($getpostdata['prev_nationality']) && !empty($getpostdata['prev_nationality'])?$getpostdata['prev_nationality']:NULL}}">
                                          </div>
                                          <div class="outerclick"></div>
                                       </div>
                                       <div class="input-block">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Have you lived for at least two years in the country where you are applying visa?
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Have you lived for at least two years in the country where you are applying visa?</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <label class="radio inline">
                                             <input type="radio" name="refer_flag" value="Y" required="" {{(!empty($getpostdata['refer_flag']) && $getpostdata['refer_flag']=="Y")?'checked':NULL}}>
                                             <span>Yes</span>
                                             </label>
                                             <label class="radio inline">
                                             <input type="radio" name="refer_flag" value="N" required="" {{(!empty($getpostdata['refer_flag']) && $getpostdata['refer_flag']=="N")?'checked':NULL}}>
                                             <span>No</span>
                                             </label>
                                          </div>
                                       </div>
                                       <div class="input-block">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                My Passport Number is
                                                <span class="strike">*</span>
                                                <div class="qs_sub"></div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" name="Passport_number" required="" value="{{isset($ocrpp_number) && !empty($ocrpp_number)?$ocrpp_number:NULL}}" maxlength="14" />
                                          </div>
                                       </div>
                                       <div class="input-block">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                My Passport Issue Place is
                                                <span class="strike">*</span>
                                                <div class="qs_sub"></div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" name="issue_place" required="" value="{{isset($getpostdata['pp_place_of_issue']) && !empty($getpostdata['pp_place_of_issue'])?$getpostdata['pp_place_of_issue']:NULL}}" />
                                          </div>
                                       </div>
                                       <div class="input-block datepkr">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                My Passport Date of Issue is
                                                <span class="strike">*</span>
                                                <div class="qs_sub"></div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" id="doi" name="doi" class="dob datepicker" required="" value="{{isset($getpostdata['pp_issue_date']) && !empty($getpostdata['pp_issue_date'])?$getpostdata['pp_issue_date']:NULL}}">
                                          </div>
                                       </div>
                                       <div class="input-block datepkr">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                My Passport Date of Expiry is
                                                <span class="strike">*</span>
                                                <div class="qs_sub"></div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" id="doe" name="doe" class="dob datepicker" required="" value="{{isset($ocrexpiry) && !empty($ocrexpiry)?$ocrexpiry:''}}">
                                          </div>
                                       </div>
                                       <div class="input-block">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Any other valid Passport/Identity Certificate(IC) held,
                                                <span class="strike">*</span>
                                                <div class="qs_sub"></div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <label class="radio inline">
                                             <input type="radio" id="oth_ppt" name="oth_ppt" value="Y" required="" {{(!empty($getpostdata['oth_ppt']) && $getpostdata['oth_ppt']=="Y")?'checked':NULL}}>
                                             <span>Yes</span>
                                             </label>
                                             <label class="radio inline">
                                             <input type="radio" id="oth_ppt" name="oth_ppt" value="N" required="" {{(!empty($getpostdata['oth_ppt']) && $getpostdata['oth_ppt']=="N")?'checked':NULL}}>
                                             <span>No</span>
                                             </label>
                                          </div>
                                       </div>

                                          <div class="input-block {{(!empty($getpostdata['oth_ppt']) && $getpostdata['oth_ppt']=='Y')?'showdiv':'hidediv'}}" id="prev_passport_country_issue">
                                             <div class="labels">
                                                <div class="qs_list"></div>
                                                <div class="qs_body">
                                                   Country of Issue
                                                   <span class="strike">*</span>
                                                   <div class="qs_sub">Country of Issue</div>
                                                </div>
                                             </div>
                                             <div class="input-control outerInFoc">
                                                <!--select class="__select_drop" name="prev_passport_country_issue">
                                                   <option value="">Select Country</option>
                                                   @foreach($getcountry as $row)
                                                   <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                   @endforeach
                                                </select-->
                                                <input type="text" name="" class="__select_drop inputF" autocomplete="off" value="{{isset($getpostdata['prev_passport_country_name']) && !empty($getpostdata['prev_passport_country_name'])?$getpostdata['prev_passport_country_name']:NULL}}" />
                                                <ul class="hiddenul">
                                                    @foreach($getcountry as $row)
                                                       <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="prev_passport_country_issue" class="inputH" value="{{isset($getpostdata['prev_passport_country_issue']) && !empty($getpostdata['prev_passport_country_issue'])?$getpostdata['prev_passport_country_issue']:NULL}}">
                                             </div>
                                             <div class="outerclick"></div>
                                          </div>
                                          <div class="input-block" id="other_ppt_no">
                                             <div class="labels">
                                                <div class="qs_list"></div>
                                                <div class="qs_body">
                                                   Passport/IC No.
                                                   <span class="strike">*</span>
                                                   <div class="qs_sub"></div>
                                                </div>
                                             </div>
                                             <div class="input-control">
                                                <input type="text" name="other_ppt_no" value="{{isset($getpostdata['other_ppt_no']) && !empty($getpostdata['other_ppt_no'])?$getpostdata['other_ppt_no']:NULL}}"  />
                                             </div>
                                          </div>
                                          <div class="input-block" id="other_ppt_issue_place">
                                             <div class="labels">
                                                <div class="qs_list"></div>
                                                <div class="qs_body">
                                                   Place of Issue
                                                   <span class="strike">*</span>
                                                   <div class="qs_sub"></div>
                                                </div>
                                             </div>
                                             <div class="input-control">
                                                <input type="text" name="other_ppt_issue_place" value="{{isset($getpostdata['other_ppt_issue_place']) && !empty($getpostdata['other_ppt_issue_place'])?$getpostdata['other_ppt_issue_place']:NULL}}"  />
                                             </div>
                                          </div>
                                          <div class="input-block datepkr" id="other_ppt_date_issue">
                                             <div class="labels">
                                                <div class="qs_list"></div>
                                                <div class="qs_body">
                                                   Date of Issue
                                                   <span class="strike">*</span>
                                                   <div class="qs_sub"></div>
                                                </div>
                                             </div>
                                             <div class="input-control">
                                                <input type="text" id="other_ppt_issue_date" name="other_ppt_issue_date" class="dob datepicker" value="{{isset($getpostdata['other_ppt_issue_date']) && !empty($getpostdata['other_ppt_issue_date'])?$getpostdata['other_ppt_issue_date']:NULL}}" />
                                             </div>
                                          </div>
                                          <div class="input-block outerInFoc" id="other_ppt_nationality">
                                             <div class="labels">
                                                <div class="qs_list"></div>
                                                <div class="qs_body">
                                                   Nationality mentioned therein 
                                                   <span class="strike">*</span>
                                                   <div class="qs_sub"></div>
                                                </div>
                                             </div>
                                             <div class="input-control">
                                                <!--select class="__select_drop" name="other_ppt_nationality">
                                                   <option value="">Select Country</option>
                                                   @foreach($getcountry as $row)
                                                   <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                   @endforeach
                                                </select-->
                                                <input type="text" name="" class="__select_drop inputF" autocomplete="off" value="{{isset($getpostdata['other_ppt_nationality_name']) && !empty($getpostdata['other_ppt_nationality_name'])?$getpostdata['other_ppt_nationality_name']:NULL}}" />
                                                <ul class="hiddenul">
                                                    @foreach($getcountry as $row)
                                                       <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="other_ppt_nationality" class="inputH" value="{{isset($getpostdata['other_ppt_nationality']) && !empty($getpostdata['other_ppt_nationality'])?$getpostdata['other_ppt_nationality']:NULL}}">
                                             </div>
                                             <div class="outerclick"></div>
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
            <!-- <script src="{{URL::to('/')}}/js/windowunload.js" data-ordid="{{$getpostdata['order_id']}}" page-name="evisa-basicform" userleaving="false"></script> -->
            <script src="{{URL::to('/')}}/js/dist/indiaevisa_autosaveform.js" form-id="frmevisaform" ajax-url="ajaxautosavebasicform"></script>
         </div>
      </div>
   </div>
</div>
@include('layouts.middle_footer')     
@stop
