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
                           <div class="col-md-12">
                              <p class="__form_notes">Applicant's Address Details</p>
                           </div>
                           <div class="col-md-12">
                              <div class="upform">
                                 <div class="upform-main">
                                    <div class="input-block active">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             House No./Street
                                             <span class="strike">*</span>
                                             <div class="qs_sub">House No./Street</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="pres_add1" value="" required="" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Village/Town/City
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Village/Town/City</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="pres_add2" value="" required="" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Country  
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Country </div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="pres_country" required="">
                                             <option value="">Select Country</option>
                                             @foreach($getcountry as $row)
                                             <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getcountry as $row)
                                                <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                            @endforeach
                                          </ul>
                                          <input type="hidden" name="pres_country" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             State/Province/District
                                             <span class="strike">*</span>
                                             <div class="qs_sub">State/Province/District </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="state_name" required="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Postal/Zip Code 
                                             <span class="strike">*</span>
                                             <div class="qs_sub"> </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="pincode" required="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Phone No.
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Phone No. </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label></label>
                                          <input type="text" name="pres_phone">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Mobile No.
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Mobile No. </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="mobile_no" value="{{!empty($getapplicatdata->mobile_number)?$getapplicatdata['mobile_number']:NULL}}" readonly="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Email Address
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Email Address </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="email" name="email_id" value="{{!empty($getapplicatdata->email_id)?$getapplicatdata['email_id']:NULL}}" readonly="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Click here for same address
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Click here for same address </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label class="radio inline">
                                             <input type="radio" name="sameAddress_id" value="Y" required="">
                                             <span>Yes</span>
                                             </label>
                                             <label class="radio inline">
                                             <input type="radio" name="sameAddress_id" value="N" required="">
                                             <span>No</span>
                                             </label>
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             House No./Street
                                             <span class="strike">*</span>
                                             <div class="qs_sub">House No./Street </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label>  <span class="_astrik">*</span></label>
                                          <input type="text" name="perm_address1" value="" required="" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Village/Town/City
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Village/Town/City</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label> </label>
                                          <input type="text" name="perm_address2" value="" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             State/Province/District
                                             <span class="strike">*</span>
                                             <div class="qs_sub">State/Province/District </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="perm_address3">
                                       </div>
                                    </div>
                                    <!--div class="col-md-12">
                                       <h5 class="paddingtb_10">Father's Details</h5>
                                       </div-->
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Father Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Name </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label>Name  <span class="_astrik">*</span></label>
                                          <input type="text" name="fthrname" required="" value="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Father Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Nationality  </div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="father_nationality" required="">
                                             <option value="">Select Nationality</option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getcountry as $row)
                                                <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                            @endforeach
                                          </ul>
                                          <input type="hidden" name="father_nationality" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Father Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Previous Nationality </div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="father_previous_nationality">
                                             <option value="">Select Nationality</option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getcountry as $row)
                                                <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                            @endforeach
                                          </ul>
                                          <input type="hidden" name="father_previous_nationality" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Father Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Place of birth </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label>  <span class="_astrik">*</span></label>
                                          <input type="text" name="father_place_of_birth" required="" value="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Father Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Country of birth  </div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="father_country_of_birth" required="">
                                             <option value="">Select Country</option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getcountry as $row)
                                                <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                            @endforeach
                                          </ul>
                                          <input type="hidden" name="father_country_of_birth" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <!--div class="col-md-12">
                                       <h5 class="paddingtb_10">Mother's Details</h5>
                                       </div-->
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                            Mother's Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Name </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="mother_name" required="" value="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Mother's Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Nationality </div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="mother_nationality" required="">
                                             <option value="">Select Nationality</option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getcountry as $row)
                                                <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                            @endforeach
                                          </ul>
                                          <input type="hidden" name="mother_nationality" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Mother's Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Previous Nationality</div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="mother_previous_nationality">
                                             <option value="">Select Nationality</option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                             @endforeach
                                          </select-->
                                       <input type="text" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getcountry as $row)
                                                <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                            @endforeach
                                          </ul>
                                          <input type="hidden" name="mother_previous_nationality" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Mother's Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Place of birth </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label> <span class="_astrik">*</span></label>
                                          <input type="text" name="mother_place_of_birth" required="" value="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Mother's Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Country of birth </div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="mother_country_of_birth" required="">
                                             <option value="">Select Country</option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getcountry as $row)
                                                <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                            @endforeach
                                          </ul>
                                          <input type="hidden" name="mother_country_of_birth" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Applicant's Marital Status
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="marital_status" required="">
                                             <option value="">Select Marital Status</option>
                                             @foreach($getmarital as $val)
                                             <option value="{{$val->marital_status_id}}">{{$val->marital_status_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" name="mstatus" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getmarital as $val)
                                              <li data-val="{{$val->marital_status_id}}">{{$val->marital_status_name}}</li>
                                            @endforeach 
                                          </ul>
                                          <input type="hidden" name="marital_status" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <!--div class="col-md-12" id="spouse_div">
                                       <div class="col-md-12">
                                       <h5 class="paddingtb_10">Spouse's Details</h5>
                                       </div-->
                                    <div class="input-block spouse_div">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Spouse's Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Name </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label></label>
                                          <input type="text" name="spouse_name" value="">
                                       </div>
                                    </div>
                                    <div class="input-block spouse_div">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                            Spouse's Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Nationality </div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="spouse_nationality">
                                             <option value="">Select Nationality</option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getcountry as $row)
                                                <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                            @endforeach
                                          </ul>
                                          <input type="hidden" name="spouse_nationality" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block spouse_div">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                            Spouse's Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Previous Nationality </div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <label></label>
                                          <!--select class="__select_drop" name="spouse_previous_nationality">
                                             <option value="">Select Nationality</option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                             @endforeach
                                          </select-->
                                         <input type="text" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getcountry as $row)
                                                <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                            @endforeach
                                          </ul>
                                          <input type="hidden" name="spouse_previous_nationality" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block spouse_div">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Spouse's Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Place of birth </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="spouse_place_of_birth" value="">
                                       </div>
                                    </div>
                                    <div class="input-block spouse_div">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Spouse's Details
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Country of birth </div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="spouse_country_of_birth">
                                             <option value="">Select Country</option>
                                             @foreach($getcountry as $val)
                                             <option value="{{$val->country_id}}">{{$val->country_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getcountry as $row)
                                                <li data-val="{{$row->country_id}}">{{$row->country_name}}</li>
                                            @endforeach
                                          </ul>
                                          <input type="hidden" name="spouse_country_of_birth" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <!--/div-->
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Grandparents - Pakistan Nationals/ belong to pakistan held area? 
                                             <span class="strike">*</span>
                                             <div class="qs_sub"> </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                             <label class="radio inline">
                                             <input type="radio" name="grandparent_flag1" value="Y" required="">
                                             <span>Yes</span>
                                             </label>
                                             <label class="radio inline">
                                             <input type="radio" name="grandparent_flag1" value="N" checked="" required="">
                                             <span>No</span>
                                             </label>
                                          </div>
                                       </div>
                                    <div class="input-block" id="grandparent_details">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Grandparents - Pakistan Nationals/ belong to pakistan held area? 
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Give Details</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label></label>
                                          <input type="text" name="grandparent_details" value="">
                                       </div>
                                    </div>
                                    <!--div class="col-md-12">
                                       <h5 class="paddingtb_10">Profession / Occupation Details of Applicant</h5>
                                       </div-->
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                            Present Occupation
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Present Occupation</div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="pre_occupation" required="">
                                             <option value="">Select Occupation</option>
                                             @foreach($getpropfession as $val)
                                             <option value="{{$val->id}}">{{$val->occupation_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" class="__select_drop inputF" autocomplete="off" required="" />
                                          <ul class="hiddenul">
                                            @foreach($getpropfession as $val)
                                              <li data-val="{{$val->id}}">{{$val->occupation_name}}</li>
                                            @endforeach 
                                          </ul>
                                          <input type="hidden" name="pre_occupation" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block" id="if_prof_other">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Occupation (If Other)
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Occupation (If Other)</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="if_prof_other">
                                       </div>
                                    </div>
                                    <div class="input-block" id="occ_flag">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Specify below occupation details of
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Specify below occupation details of </div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="occ_flag">
                                             <option value="">Select...</option>
                                             <option value="F">Father</option>
                                             <option value="S">Spouse</option>
                                          </select-->
                                          <input type="text" class="__select_drop inputF" autocomplete="off" />
                                          <ul class="hiddenul">
                                            <li data-val="">Select...</li>
                                            <li data-val="F">Father</li>
                                            <li data-val="S">Spouse</li>
                                          </ul>
                                          <input type="hidden" name="occ_flag" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block" >
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Employer Name/business
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Employer Name/business</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="empname" value="" required="">
                                       </div>
                                    </div>
                                    <div class="input-block" >
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Designation
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Designation</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="empdesignation" value="">
                                       </div>
                                    </div>
                                    <div class="input-block" >
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Address
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Address</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="empaddress" value="" required="">
                                       </div>
                                    </div>
                                    <div class="input-block" >
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Phone
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Phone </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="empphone" value="">
                                       </div>
                                    </div>
                                    <div class="input-block" >
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Past Occupation
                                             <span class="strike">*</span>
                                             <div class="qs_sub">If any</div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="previous_occupation">
                                             <option value="">Select Occupation</option>
                                             @foreach($getpropfession as $val)
                                             <option value="{{$val->id}}">{{$val->occupation_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" class="__select_drop inputF" autocomplete="off" />
                                          <ul class="hiddenul">
                                            <li>Select Occupation</li>
                                             @foreach($getpropfession as $val)
                                             <li data-val="{{$val->id}}">{{$val->occupation_name}}</li>
                                             @endforeach
                                          </ul>
                                          <input type="hidden" name="occ_flag" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Are/were you in a Military/Semi-Military/Police/Security Organization?
                                             <span class="strike">*</span>
                                             <div class="qs_sub">State/Province/District </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                             <label class="radio inline">
                                             <input type="radio" name="prev_org" value="Y" required="">
                                             <span>Yes</span>
                                             </label>
                                             <label class="radio inline">
                                             <input type="radio" name="prev_org" value="N" checked="" required="">
                                             <span>No</span>
                                             </label>
                                       </div>
                                    </div>
                                    <!--div class="col-md-12" id="prev_org_div"-->
                                    <div class="input-block prev_org_div">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                            Are/were you in a Military/Semi-Military/Police/Security Organization? 
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Organization </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="previous_organization" value="">
                                       </div>
                                    </div>
                                    <div class="input-block prev_org_div">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Are/were you in a Military/Semi-Military/Police/Security Organization?
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Designation</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="previous_designation" value="">
                                       </div>
                                    </div>
                                    <div class="input-block prev_org_div">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Are/were you in a Military/Semi-Military/Police/Security Organization?
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Rank </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="previous_rank" value="">
                                       </div>
                                    </div>
                                    <div class="input-block prev_org_div">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Are/were you in a Military/Semi-Military/Police/Security Organization?
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Place of Posting </div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="previous_posting" value="">
                                       </div>
                                    </div>
                                    <!--/div-->
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
