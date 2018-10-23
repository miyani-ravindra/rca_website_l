@extends('layouts.layout')
@section('content')
<div class="clearfix"></div>
<div class="__bg">
<div class="container container-sm">
   <div class="row">
      <div class="col-md-12">
         <div class="paddingtb_50">
            <form method="post" id="frmevisaform" name="frmevisaform" action="{{URL::to('/')}}/booking/b2b-family-details/{{$getpostdata['residing_code']}}">
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
                                          <input type="text" name="given_name" value="{{isset($getocr['names']['lastName']) && !empty($getocr['names']['lastName'])?$getocr['names']['lastName']:NULL}}" required="" />
                                          <div class="press_enter"></div>
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Surname
                                             <div class="qs_sub">Surname</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="surname" value="{{isset($getocr['names']['firstName']) && !empty($getocr['names']['firstName'])?$getocr['names']['firstName']:NULL}}" />
                                          <div class="press_enter"></div>
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                I have changed my name previously
                                                <span class="strike">*</span>
                                                <div class="qs_sub"></div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <label class="radio inline">
                                             <input type="radio" name="name_changed" value="Y" id="name_changed_y">
                                             <span>Yes</span>
                                             </label>
                                             <label class="radio inline">
                                             <input type="radio" name="name_changed" value="N" id="name_changed_n">
                                             <span>No</span>
                                             </label>
                                          </div>
                                       </div>
                                       <div class="input-block" id="previous_surname">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Previous surname
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Previous surname</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="previous_surname" value="" />
                                          <div class="press_enter"></div>
                                       </div>
                                    </div>
                                    <div class="input-block" id="previous_name">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Previous name
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Previous name</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="previous_name" value="" />
                                          <div class="press_enter"></div>
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
                                          <input type="text" name="gender_text" class=" __select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                              <li data-val="M">MALE</li>
                                              <li data-val="F">FEMALE</li>
                                              <li data-val="T">TRANSGENDER</li>
                                          </ul>
                                           <input type="hidden" name="gender" class="inputH" value="">
                                           <div class="press_enter"></div>
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
                                          <input type="text" id="dob" name="dob" class="dob datepicker" value="{{isset($getocr['dob']) && !empty($getocr['dob'])?$getocr['dob']:NULL}}" required="">
                                          <div class="press_enter"></div>
                                       </div>
                                    </div>
                                       <div class="input-block">
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
                                            <input type="text" name="cob_text" class="__select_drop inputF" autocomplete="off" />
                                            <ul class="hiddenul">
                                                @foreach($getcountry as $row)
                                                  <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                                @endforeach
                                            </ul>
                                            <input type="hidden" name="cob" class="inputH" value="">
                                            <div class="press_enter"></div>
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
                                             <input type="text" name="city_birth" required="">
                                             <div class="press_enter"></div>
                                          </div>
                                       </div>
                                       <div class="input-block">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                National Id
                                                <span class="strike">*</span>
                                                <div class="qs_sub"> National Id</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" name="nation_id" required="">
                                             <div class="press_enter"></div>
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
                                             <input type="text" name="religion_code_text" class="__select_drop inputF" autocomplete="off" />
                                              <ul class="hiddenul">
                                                @foreach($getreligion as $row)
                                                  <li data-val="{{$row->religion_id}}">{{$row->religion_name}}</li>
                                                @endforeach
                                              </ul>
                                              <input type="hidden" name="religion_code" class="inputH" value="">
                                              <div class="press_enter"></div>
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
                                             <input type="text" name="visible_marks" required="">
                                             <div class="press_enter"></div>
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
                                             <input type="text" name="qualification_text" class="__select_drop inputF" autocomplete="off" />
                                              <ul class="hiddenul">
                                                @foreach($getqualification as $row)
                                                  <li data-val="{{$row->id}}">{{$row->qualification}}</li>
                                                @endforeach
                                              </ul>
                                              <input type="hidden" name="qualification" class="inputH" value="">
                                              <div class="press_enter"></div>
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
                                             <input type="text" name="nationality_text" class="__select_drop inputF" autocomplete="off" />
                                              <ul class="hiddenul">
                                                @foreach($getcountry as $val)
                                                  <li data-val="{{$val->country_id}}" {{isset($getocr['nationality']['country_id']) && ($val->country_id==$getocr['nationality']['country_id'])?'selected':NULL}}">{{$val->country_name}}</li>
                                                @endforeach
                                              </ul>
                                              <input type="hidden" name="nationality" class="inputH" value="">
                                              <div class="press_enter"></div>
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
                                             <input type="text" name="aquired_nation_text" class="__select_drop inputF" autocomplete="off" id="aquired_nation" />
                                                <ul class="hiddenul">
                                                    <li data-val="">Select...</li>
                                                    <li data-val="By Birth">By Birth</li>
                                                    <li data-val="Naturalization">Naturalization</li>
                                                </ul>
                                            <input type="hidden" name="aquired_nation" class="inputH" value="">
                                            <div class="press_enter"></div>
                                          </div>
                                          <div class="outerclick"></div>
                                       </div>
                                       <div class="input-block" id="prev_nationality">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Prev. Nationality
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Prev. Nationality</div>
                                             </div>
                                          </div>
                                          <div class="input-control outerInFoc">
                                             <input type="text" name="prev_nationality_text" class="__select_drop inputF" autocomplete="off" />
                                                <ul class="hiddenul">
                                                    @foreach($getcountry as $row)
                                                       <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                                    @endforeach
                                                </ul>
                                            <input type="hidden" name="prev_nationality" class="inputH" value="">
                                            <div class="press_enter"></div>
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
                                             <input type="radio" name="refer_flag" value="Y" required="">
                                             <span>Yes</span>
                                             </label>
                                             <label class="radio inline">
                                             <input type="radio" name="refer_flag" value="N" required="">
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
                                             <input type="text" name="Passport_number" required="" value="{{isset($getocr['documentNumber']) && !empty($getocr['documentNumber'])?$getocr['documentNumber']:NULL}}" maxlength="14" />
                                             <div class="press_enter"></div>
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
                                             <input type="text" name="issue_place" required="" value="" />
                                             <div class="press_enter"></div>
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
                                             <input type="text" id="doi" name="doi" class="dob datepicker" required="">
                                             <div class="press_enter"></div>
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
                                             <input type="text" id="doe" name="doe" class="dob datepicker" required="" value="{{isset($getocr['expiry']) && !empty($getocr['expiry'])?$getocr['expiry']:''}}">
                                             <div class="press_enter"></div>
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
                                             <input type="radio" id="oth_ppt" name="oth_ppt" value="Y" required="">
                                             <span>Yes</span>
                                             </label>
                                             <label class="radio inline">
                                             <input type="radio" id="oth_ppt" name="oth_ppt" value="N" required="">
                                             <span>No</span>
                                             </label>
                                          </div>
                                       </div>

                                          <div class="input-block" id="prev_passport_country_issue">
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
                                                <input type="text" name="prev_passport_country_issue_text" class="__select_drop inputF" autocomplete="off" />
                                                <ul class="hiddenul">
                                                    @foreach($getcountry as $row)
                                                       <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="prev_passport_country_issue" class="inputH" value="">
                                                <div class="press_enter"></div>
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
                                                <input type="text" name="other_ppt_no" value="" />
                                                <div class="press_enter"></div>
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
                                                <input type="text" name="other_ppt_issue_place" value="" />
                                                <div class="press_enter"></div>
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
                                                <input type="text" id="other_ppt_issue_date" name="other_ppt_issue_date" class="dob datepicker">
                                             </div>
                                          </div>

                                          <div class="input-block" id="other_ppt_nationality">
                                             <div class="labels">
                                                <div class="qs_list"></div>
                                                <div class="qs_body">
                                                   Nationality mentioned therein 
                                                   <span class="strike">*</span>
                                                   <div class="qs_sub"></div>
                                                </div>
                                             </div>
                                             <div class="input-control outerInFoc">
                                                <input type="text" name="other_ppt_nationality_text" class="__select_drop inputF" autocomplete="off" />
                                                <ul class="hiddenul">
                                                    @foreach($getcountry as $row)
                                                       <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                                    @endforeach
                                                </ul>
                                                <input type="hidden" name="other_ppt_nationality" class="inputH" value="">
                                                <div class="press_enter"></div>
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
         </div>
      </div>
   </div>
</div>
@include('layouts.middle_footer')     
@stop
