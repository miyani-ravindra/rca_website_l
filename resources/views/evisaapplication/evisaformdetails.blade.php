@extends('layouts.layout')
@section('content')
<div class="clearfix"></div>
<div class="__bg">
   <div class="container container-sm">
      <div class="row">
         <div class="col-md-12">
            <div class="paddingtb_50">
              <div id="save_form_msg" style="display: none;"></div>
               <form method="post" id="frmevisadetails" name="frmevisadetails" action="{{URL::to('/')}}/evisa/verifymail">
                  <input type="hidden" name="residing_in" id="residing_in" value="{{$getpostdata['residing_in']}}">
                  <input type="hidden" name="residing_code" id="residing_code" value="{{$getpostdata['residing_code']}}">
                  <input type="hidden" name="nationality" id="nationality" value="{{$getpostdata['nationality']}}">
                  <input type="hidden" name="order_id" id="order_id" value="{{$getpostdata['order_id']}}">
                  <input type="hidden" name="applicant_id" id="applicant_id" value="{{$getpostdata['applicant_id']}}">
                  <input type="hidden" name="uid" id="uid" value="{{$getpostdata['uid']}}">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <input type="hidden" name="ccode" value="india">
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
                           <ul class="__progress">
                              <li class="active _100">Basic Info + Document Upload</li>
                              <li class="active _70">Form Filling</li>
                              <li class="">Verification</li>
                              <li class="">Payment</li>
                           </ul>
                        </div>
                     </div>
                     <div class="__form_wrapper">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="upform">
                                 <div class="upform-main">
                                    <div class="input-block active">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Type of Visa
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="type_of_visa" value="{{!empty($getpostdata['type_of_visa'])?$getpostdata['type_of_visa']:NULL}}" readonly="" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Visa Service
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="visa_service" value="{{!empty($getpostdata['visa_service'])?$getpostdata['visa_service']:NULL}}" readonly="" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                            Places to be visited 
                                             <span class="strike">*</span>
                                             <div class="qs_sub">1</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="service_req_form_values" value="{{!empty($getpostdata['service_req_form_values'])?$getpostdata['service_req_form_values']:NULL}}" required="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                            Places to be visited 2
                                             
                                             <div class="qs_sub">2</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="service_req_form_values2" value="{{!empty($getpostdata['service_req_form_values2'])?$getpostdata['service_req_form_values2']:NULL}}">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Duration of Visa
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Duration of Visa</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <span><b class="duration_Days">{{!empty($getpostdata['visa_duration'])?$getpostdata['visa_duration']:NULL}} Days</b></span>
                                          <input type="hidden" name="visa_duration" value="{{!empty($getpostdata['visa_duration'])?$getpostdata['visa_duration']:NULL}}" readonly="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             No. of Entries
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="name_entries" value="{{!empty($getpostdata['no_entries']) && ($getpostdata['no_entries']==3)?'Triple':'Double'}}" readonly="">
                                          <input type="hidden" name="no_entries" value="{{!empty($getpostdata['no_entries'])?$getpostdata['no_entries']:NULL}}" readonly="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Port of Arrival in India
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="airport_name" value="{{!empty($getpostdata['airport_name'])?$getpostdata['airport_name']:NULL}}" readonly="">
                                          <input type="hidden" name="airport_id" value="{{!empty($getpostdata['airport_id'])?$getpostdata['airport_id']:NULL}}" readonly="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Expected Port of Exit from India
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control outerInFoc">
                                          <!--select class="__select_drop" name="pres_country" required="">
                                             <option value="">Select exit point</option>
                                             @foreach($getairport as $row)
                                             <option value="{{$row->airport_id}}">{{$row->airport_name}}</option>
                                             @endforeach
                                          </select-->
                                          <input type="text" class="__select_drop inputF" value="{{$getpostdata['exit_port_name']?$getpostdata['exit_port_name']:NULL}}" required="" autocomplete="off" />
                                          <ul class="hiddenul">
                                            @foreach($getairport as $row)
                                             <li data-val="{{$row->airport_id}}">{{$row->airport_name}}</li> 
                                             @endforeach
                                          </ul>
                                          <input type="hidden" name="pres_country" class="inputH" value="{{!empty($getpostdata['pres_country'])?$getpostdata['pres_country']:NULL}}">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    @if(count($service_arr)>0)
                                    <?php $renderform = new RenderXMLForm();?>
                                    @foreach($service_arr as $row)
                                    @if($row['purpose_id']===1)
                                    @if(!empty($getpostdata['service_purpose_json']->service_req_short_medical))
                                      <div class="col-md-12">
                                        <p class="__form_notes">Short term Medical treatment of self</p>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Hospital Name
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_short_medical[hospital_name]" value="{{!empty($getpostdata['service_purpose_json']->service_req_short_medical->hospital_name)?$getpostdata['service_purpose_json']->service_req_short_medical->hospital_name:NULL}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Hospital Address
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_short_medical[hospital_address]" value="{{$getpostdata['service_purpose_json']->service_req_short_medical->hospital_address}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                        State<span class="strike">*</span><div class="qs_sub"></div></div></div>
                                        <div class="input-control outerInFoc">
                                          <input class="__select_drop inputF" name="service_req_short_medical[hospital_state_name]" value="{{!empty($getpostdata['service_purpose_json']->service_req_short_medical->hospital_state_name)?$getpostdata['service_purpose_json']->service_req_short_medical->hospital_state_name:NULL}}" autocomplete="off" required="" aria-required="true">
                                        <ul class="hiddenul" style="display: none;">
                                        <li data-val="">Select State</li>
                                        @foreach($getstate as $v)
                                          <li data-val="{{$v->state_id}}">{{$v->state_name}}</li>
                                        @endforeach
                                        </ul>
                                        <input type="hidden" name="service_req_short_medical[hospital_state]" required="" class="inputH" value="{{!empty($getpostdata['service_purpose_json']->service_req_short_medical->hospital_state)?$getpostdata['service_purpose_json']->service_req_short_medical->hospital_state:NULL}}" aria-required="true">
                                        <div class="press_enter"></div>
                                        </div>
                                        <div class="outerclick"></div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Hospital District
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_short_medical[hospital_district]" value="{{$getpostdata['service_purpose_json']->service_req_short_medical->hospital_district}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Hospital Phone No
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_short_medical[hospital_phone_no]" class="only_number" value="{{$getpostdata['service_purpose_json']->service_req_short_medical->hospital_phone_no}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Type of Medical Treatment
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_short_medical[type_of_medical]" value="{{$getpostdata['service_purpose_json']->service_req_short_medical->type_of_medical}}" />
                                           </div>
                                      </div>
                                    @else
                                      <?php
                                       try {
                                               $formpath = public_path() . '/serviceForm/short_term_medical.xml';
                                       
                                               //echo "step 2";
                                               $renderform->renderform($formpath);
                                               //echo "step done";
                                           } catch (PDOException $ex) {
                                               echo "error in sql..";
                                               echo " Message: ", $ex->getMessage();
                                           }
                                       ?>
                                    @endif
                                    <!--div class="col-md-12">
                                       <h5>Details of Purpose "{{$row['purpose_name']}}"</h5>
                                       </div-->                                    
                                    @elseif($row['purpose_id']===3)
                                    @if(!empty($getpostdata['service_purpose_json']->service_req_meeting_frend))
                                    <div class="col-md-12">
                                    <p class="__form_notes">Meeting friends/relatives</p>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Details of the Friend/Relative
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_meeting_frend[frnd_name]" value="{{$getpostdata['service_purpose_json']->service_req_meeting_frend->frnd_name}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Address
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_meeting_frend[frnd_address]" value="{{$getpostdata['service_purpose_json']->service_req_meeting_frend->frnd_address}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                        State<span class="strike">*</span><div class="qs_sub"></div></div></div>
                                        <div class="input-control outerInFoc">
                                          <input class="__select_drop inputF" autocomplete="off" name="service_req_meeting_frend[frnd_state_name]" required="" value="{{!empty($getpostdata['service_purpose_json']->service_req_meeting_frend->frnd_state_name)?$getpostdata['service_purpose_json']->service_req_meeting_frend->frnd_state_name:NULL}}" aria-required="true">
                                        <ul class="hiddenul" style="display: none;">
                                        <li data-val="">Select State</li>
                                        @foreach($getstate as $v)
                                          <li data-val="{{$v->state_id}}">{{$v->state_name}}</li>
                                        @endforeach 
                                        </ul>
                                        <input type="hidden" name="service_req_meeting_frend[frnd_state]" required="" class="inputH" value="{{!empty($getpostdata['service_purpose_json']->service_req_meeting_frend->frnd_state)?$getpostdata['service_purpose_json']->service_req_meeting_frend->frnd_state:NULL}}" aria-required="true">
                                        <div class="press_enter"></div>
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 District
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_meeting_frend[frnd_district]" value="{{$getpostdata['service_purpose_json']->service_req_meeting_frend->frnd_district}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Phone
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_meeting_frend[frnd_phone]" value="{{$getpostdata['service_purpose_json']->service_req_meeting_frend->frnd_phone}}" />
                                           </div>
                                    </div>
                                    @else
                                      <?php
                                       try {
                                               $formpath = public_path() . '/serviceForm/meeting_friends.xml';
                                       
                                               //echo "step 2";
                                               $renderform->renderform($formpath);
                                               //echo "step done";
                                           } catch (PDOException $ex) {
                                               echo "error in sql..";
                                               echo " Message: ", $ex->getMessage();
                                           }
                                       ?>
                                    @endif
                                    @elseif($row['purpose_id']===4)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
                                    @if(!empty($getpostdata['service_purpose_json']->service_req_short_yoga))
                                    <div class="input-block">
                                      <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Name of the Institute in India
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_short_yoga[yoga_institute_name]" value="{{$getpostdata['service_purpose_json']->service_req_short_yoga->yoga_institute_name}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Yoga Institute Address
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_short_yoga[yoga_institute_address]" value="{{$getpostdata['service_purpose_json']->service_req_short_yoga->yoga_institute_address}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                        State<span class="strike">*</span><div class="qs_sub"></div></div></div>
                                        <div class="input-control outerInFoc">
                                          <input class="__select_drop inputF" name="service_req_short_yoga[yoga_institute_state_name]" autocomplete="off" value="{{!empty($getpostdata['service_purpose_json']->service_req_short_yoga->yoga_institute_state_name)?$getpostdata['service_purpose_json']->service_req_short_yoga->yoga_institute_state_name:NULL}}" required="" aria-required="true">
                                        <ul class="hiddenul" style="display: none;">
                                        <li data-val="">Select State</li>
                                        @foreach($getstate as $v)
                                          <li data-val="{{$v->state_id}}">{{$v->state_name}}</li>
                                        @endforeach 
                                        </ul>
                                        <input type="hidden" name="service_req_short_yoga[yoga_institute_state]" required="" class="inputH" value="{{!empty($getpostdata['service_purpose_json']->service_req_short_yoga->yoga_institute_state)?$getpostdata['service_purpose_json']->service_req_short_yoga->yoga_institute_state:NULL}}" aria-required="true">
                                        <div class="press_enter"></div>
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 District
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_short_yoga[yoga_institute_district]" value="{{$getpostdata['service_purpose_json']->service_req_short_yoga->yoga_institute_district}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Phone
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" class="only_number" name="service_req_short_yoga[yoga_institute_phone_no]" value="{{$getpostdata['service_purpose_json']->service_req_short_yoga->yoga_institute_phone_no}}" />
                                           </div>
                                    </div>
                                    @else
                                    <?php
                                       try {
                                               $formpath = public_path() . '/serviceForm/short_term_yoga.xml';
                                       
                                               //echo "step 2";
                                               $renderform->renderform($formpath);
                                               //echo "step done";
                                           } catch (PDOException $ex) {
                                               echo "error in sql..";
                                               echo " Message: ", $ex->getMessage();
                                           }
                                       ?>
                                    @endif   
                                    @elseif($row['purpose_id']===5)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
                                    @if(!empty($getpostdata['service_purpose_json']->service_req_business_venture))
                                    <div class="input-block">
                                      <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Name
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_venture[venture_name]" value="{{$getpostdata['service_purpose_json']->service_req_business_venture->venture_name}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Address
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_venture[venture_address]" value="{{$getpostdata['service_purpose_json']->service_req_business_venture->venture_address}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Phone no
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_venture[venture_phone_no]" class="only_number" value="{{$getpostdata['service_purpose_json']->service_req_business_venture->venture_phone_no}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Website
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_venture[venture_website]" value="{{$getpostdata['service_purpose_json']->service_req_business_venture->venture_website}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Nature of Business/Product
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_venture[venture_nature_business]" value="{{$getpostdata['service_purpose_json']->service_req_business_venture->venture_nature_business}}" />
                                           </div>
                                    </div>
                                    @else
                                    <?php
                                       try {
                                               $formpath = public_path() . '/serviceForm/BUSINESS_VENTURE.xml';
                                       
                                               //echo "step 2";
                                               $renderform->renderform($formpath);
                                               //echo "step done";
                                           } catch (PDOException $ex) {
                                               echo "error in sql..";
                                               echo " Message: ", $ex->getMessage();
                                           }
                                       ?>
                                    @endif   
                                    @elseif($row['purpose_id']===6)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
                                    @if(!empty($getpostdata['service_purpose_json']->service_req_business_venture))
                                    <div class="input-block">
                                      <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Name
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_form_purchase[purchase_name]" value="{{$getpostdata['service_purpose_json']->service_req_business_venture->purchase_name}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Address
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_form_purchase[purchase_address]" value="{{$getpostdata['service_purpose_json']->service_req_business_venture->purchase_address}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Phone No
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_form_purchase[purchase_phone_no]" class="only_number" value="{{$getpostdata['service_purpose_json']->service_req_business_venture->purchase_phone_no}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 District
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_form_purchase[purchase_website]" value="{{$getpostdata['service_purpose_json']->service_req_business_venture->purchase_website}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Phone
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_form_purchase[purchase_nature_business]" class="only_number" value="{{$getpostdata['service_purpose_json']->service_req_business_venture->purchase_nature_business}}" />
                                           </div>
                                    </div>
                                    @else
                                    <?php
                                       try {
                                               $formpath = public_path() . '/serviceForm/PURCHASE_Form.xml';
                                       
                                               //echo "step 2";
                                               $renderform->renderform($formpath);
                                               //echo "step done";
                                           } catch (PDOException $ex) {
                                               echo "error in sql..";
                                               echo " Message: ", $ex->getMessage();
                                           }
                                       ?>
                                    @endif
                                    @elseif($row['purpose_id']===7)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
                                    @if(!empty($getpostdata['service_purpose_json']->service_req_business_meeting))
                                      <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Name
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_meeting[meet_co_name]" value="{{$getpostdata['service_purpose_json']->service_req_business_meeting->meet_co_name}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Address
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_meeting[meet_co_address]" value="{{$getpostdata['service_purpose_json']->service_req_business_meeting->meet_co_address}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Phone no
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_meeting[meet_co_phone_no]" class="only_number" value="{{$getpostdata['service_purpose_json']->service_req_business_meeting->meet_co_phone_no}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Website
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_meeting[meet_co_webiste]" value="{{$getpostdata['service_purpose_json']->service_req_business_meeting->meet_co_webiste}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Name
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_meeting[meet_firm_name]" value="{{$getpostdata['service_purpose_json']->service_req_business_meeting->meet_firm_name}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Address
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_meeting[meet_firm_address]" value="{{$getpostdata['service_purpose_json']->service_req_business_meeting->meet_firm_address}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Phone
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_meeting[meet_firm_phone]" class="only_number" value="{{$getpostdata['service_purpose_json']->service_req_business_meeting->meet_firm_phone}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Website
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_business_meeting[meet_firm_wbsite]" value="{{$getpostdata['service_purpose_json']->service_req_business_meeting->meet_firm_wbsite}}" />
                                           </div>
                                      </div>
                                    @else
                                      <?php
                                       try {
                                               $formpath = public_path() . '/serviceForm/BUSINESS_MEETINGS.xml';
                                       
                                               //echo "step 2";
                                               $renderform->renderform($formpath);
                                               //echo "step done";
                                           } catch (PDOException $ex) {
                                               echo "error in sql..";
                                               echo " Message: ", $ex->getMessage();
                                           }
                                       ?>
                                    @endif
                                    @elseif($row['purpose_id']===8)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
                                    @if(!empty($getpostdata['service_purpose_json']->service_req_recruit_manpower))
                                      <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Name
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_recruit_manpower[recruit_name]" value="{{$getpostdata['service_purpose_json']->service_req_recruit_manpower->recruit_name}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Address
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_recruit_manpower[recruit_address]" value="{{$getpostdata['service_purpose_json']->service_req_recruit_manpower->recruit_address}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Phone no
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_recruit_manpower[recruit_phone_no]" class="only_number" value="{{$getpostdata['service_purpose_json']->service_req_recruit_manpower->recruit_phone_no}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Website
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_recruit_manpower[recruit_website]" value="{{$getpostdata['service_purpose_json']->service_req_recruit_manpower->recruit_website}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Name and contact number of the company representative in India
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_recruit_manpower[recruit_name_contact]" value="{{$getpostdata['service_purpose_json']->service_req_recruit_manpower->recruit_name_contact}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Nature of Job for which recruiting
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_recruit_manpower[recruit_nature_job]" value="{{$getpostdata['service_purpose_json']->service_req_recruit_manpower->recruit_nature_job}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Places where recruitment is to be conducted
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_recruit_manpower[recruit_place]" value="{{$getpostdata['service_purpose_json']->service_req_recruit_manpower->recruit_place}}" />
                                           </div>
                                      </div>
                                    @else
                                      <?php
                                       try {
                                               $formpath = public_path() . '/serviceForm/TO_RECRUIT_MANPOWER.xml';
                                       
                                               //echo "step 2";
                                               $renderform->renderform($formpath);
                                               //echo "step done";
                                           } catch (PDOException $ex) {
                                               echo "error in sql..";
                                               echo " Message: ", $ex->getMessage();
                                           }
                                       ?>
                                    @endif
                                    @elseif($row['purpose_id']===9)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
                                    @if(!empty($getpostdata['service_purpose_json']->service_req_part_exhi))
                                      <div class="input-block">
                                        <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Name
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_part_exhi[exhi_name]" value="{{$getpostdata['service_purpose_json']->service_req_part_exhi->exhi_name}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Address
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_part_exhi[exhi_address]" value="{{$getpostdata['service_purpose_json']->service_req_part_exhi->exhi_address}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Phone
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_part_exhi[exhi_phone_no]" class="only_number" value="{{$getpostdata['service_purpose_json']->service_req_part_exhi->exhi_phone_no}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Website
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_part_exhi[exhi_website]" value="{{$getpostdata['service_purpose_json']->service_req_part_exhi->exhi_website}}" />
                                           </div>
                                      </div>
                                      <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Name and address of the Exhibition/trade fair
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_part_exhi[exhi_name_address]" value="{{$getpostdata['service_purpose_json']->service_req_part_exhi->exhi_name_address}}" />
                                           </div>
                                      </div>
                                    @else
                                      <?php
                                       try {
                                               $formpath = public_path() . '/serviceForm/PARTICIPATION_IN_EXHIBITIONS.xml';
                                       
                                               //echo "step 2";
                                               $renderform->renderform($formpath);
                                               //echo "step done";
                                           } catch (PDOException $ex) {
                                               echo "error in sql..";
                                               echo " Message: ", $ex->getMessage();
                                           }
                                       ?>
                                    @endif
                                    @elseif($row['purpose_id']===10)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
                                    @if(!empty($getpostdata['service_purpose_json']->service_req_exp_spe))
                                    <div class="input-block">
                                          <div class="labels">
                                              <div class="qs_list"></div>
                                              <div class="qs_body">
                                                 Name
                                                 <span class="strike">*</span>
                                                 <div class="qs_sub"></div>
                                              </div>
                                           </div>
                                           <div class="input-control">
                                              <input type="text" name="service_req_exp_spe[expart_co_name]" value="{{$getpostdata['service_purpose_json']->service_req_exp_spe->expart_co_name}}" />
                                           </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Address
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="service_req_exp_spe[expert_co_address]" value="{{$getpostdata['service_purpose_json']->service_req_exp_spe->expert_co_address}}" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Phone
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                        </div>
                                         <div class="input-control">
                                            <input type="text" class="only_number" name="service_req_exp_spe[expert_co_phone]" value="{{$getpostdata['service_purpose_json']->service_req_exp_spe->expert_co_phone}}" />
                                         </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Website
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="service_req_exp_spe[expert_co_website]" value="{{$getpostdata['service_purpose_json']->service_req_exp_spe->expert_co_website}}" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Firm Name
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="service_req_exp_spe[firm_name]" value="{{$getpostdata['service_purpose_json']->service_req_exp_spe->firm_name}}" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Address
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="service_req_exp_spe[firm_address]" value="{{$getpostdata['service_purpose_json']->service_req_exp_spe->firm_address}}" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Phone
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" class="only_number" name="service_req_exp_spe[firm_phone]" value="{{$getpostdata['service_purpose_json']->service_req_exp_spe->firm_phone}}" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Website
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="service_req_exp_spe[firm_website]" value="{{$getpostdata['service_purpose_json']->service_req_exp_spe->firm_website}}" />
                                       </div>
                                    </div>
                                    @else
                                        <?php
                                       try {
                                               $formpath = public_path() . '/serviceForm/EXPERT_SPECIALIST_Form.xml';
                                       
                                               //echo "step 2";
                                               $renderform->renderform($formpath);
                                               //echo "step done";
                                           } catch (PDOException $ex) {
                                               echo "error in sql..";
                                               echo " Message: ", $ex->getMessage();
                                           }
                                       ?>
                                    @endif
                                    @elseif($row['purpose_id']===11)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
                                    @if(!empty($getpostdata['service_purpose_json']->service_req_con_tours))
                                    <div class="input-block">
                                      <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Name and address of the Travel Agency in native country
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="service_req_con_tours[travel_name_address]" value="{{$getpostdata['service_purpose_json']->service_req_con_tours->travel_name_address}}" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Cities to be visited during the tour
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="service_req_con_tours[travel_city_name]" value="{{$getpostdata['service_purpose_json']->service_req_con_tours->travel_city_name}}" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Name
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="service_req_con_tours[travel_name]" value="{{$getpostdata['service_purpose_json']->service_req_con_tours->travel_name}}" />
                                       </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Address
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                        </div>
                                        <div class="input-control">
                                          <input type="text" name="service_req_con_tours[travel_address]" value="{{$getpostdata['service_purpose_json']->service_req_con_tours->travel_address}}" />
                                        </div>
                                    </div>
                                    <div class="input-block">
                                        <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Phone
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" class="only_number" name="service_req_con_tours[travel_phone_no]" value="{{$getpostdata['service_purpose_json']->service_req_con_tours->travel_phone_no}}" />
                                       </div>
                                    </div>
                                    @else
                                    <?php
                                       try {
                                               $formpath = public_path() . '/serviceForm/CONDUCTING_TOURS.xml';
                                       
                                               //echo "step 2";
                                               $renderform->renderform($formpath);
                                               //echo "step done";
                                           } catch (PDOException $ex) {
                                               echo "error in sql..";
                                               echo " Message: ", $ex->getMessage();
                                           }
                                       ?>
                                    @endif   
                                    @endif
                                    @endforeach
                                    @endif
                                    <!-- <div class="col-md-12">
                                       <h5 class="__form_notes"></h5>
                                    </div> -->
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Have you ever visited India before?
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label class="inline radio">
                                          <input type="radio" name="old_visa_flag" value="Y" {{!empty($getpostdata['old_visa_flag']) && $getpostdata['old_visa_flag']=="Y"?"checked":NULL}} required="">
                                          <span>Yes</span>
                                          </label>
                                          <label class="inline radio">
                                          <input type="radio" name="old_visa_flag" value="N" {{!empty($getpostdata['old_visa_flag']) && $getpostdata['old_visa_flag']=="N"?"checked":NULL}} required="">
                                          <span>No</span>
                                          </label>
                                       </div>
                                    </div>
                                       <div class="input-block pre_visit_div {{!empty($getpostdata['old_visa_flag']) && $getpostdata['old_visa_flag']=='Y'?'divshow':'divhide'}}">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Have you ever visited India before?
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Address</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <textarea cols="40" rows="3" name="prv_visit_add1">{{!empty($getpostdata['prv_visit_add1'])?$getpostdata['prv_visit_add1']:NULL}}</textarea>
                                          </div>
                                       </div>
                                       <div class="input-block pre_visit_div {{!empty($getpostdata['old_visa_flag']) && $getpostdata['old_visa_flag']=='Y'?'divshow':'divhide'}}">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                               Cities previously visited in India 
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Have you ever visited India before?</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <textarea cols="40" rows="3" name="visited_city">{{!empty($getpostdata['visited_city'])?$getpostdata['visited_city']:NULL}}</textarea>
                                          </div>
                                       </div>
                                       <div class="input-block pre_visit_div {{!empty($getpostdata['old_visa_flag']) && $getpostdata['old_visa_flag']=='Y'?'divshow':'divhide'}}">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Last Indian Visa No/Currently valid Indian Visa No.
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Have you ever visited India before?</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" name="old_visa_no" value="{{!empty($getpostdata['old_visa_no'])?$getpostdata['old_visa_no']:NULL}}">
                                          </div>
                                       </div>
                                       <div class="input-block pre_visit_div {{!empty($getpostdata['old_visa_flag']) && $getpostdata['old_visa_flag']=='Y'?'divshow':'divhide'}}">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Type of Visa
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Have you ever visited India before? </div>
                                             </div>
                                          </div>
                                          <div class="input-control outerInFoc">
                                             <!--select class="__select_drop" name="old_visa_type_id">
                                                <option value="">Select visa type</option>
                                                @foreach($getvisatypes as $val)
                                                <option value="{{$val->id}}">{{$val->type_name}}</option>
                                                @endforeach
                                             </select-->
                                             <input type="text" class="__select_drop inputF" value="{{!empty($getpostdata['old_visa_type_name'])?$getpostdata['old_visa_type_name']:NULL}}" autocomplete="off" />
                                          <ul class="hiddenul">
                                            @foreach($getvisatypes as $val)
                                                <li data-val="{{$val->id}}">{{$val->type_name}}</li>
                                             @endforeach
                                          </ul>
                                          <input type="hidden" name="old_visa_type_id" class="inputH" value="{{!empty($getpostdata['old_visa_type_id'])?$getpostdata['old_visa_type_id']:NULL}}">
                                        </div>
                                        <div class="outerclick"></div>
                                       </div>
                                       <div class="input-block pre_visit_div {{!empty($getpostdata['old_visa_flag']) && $getpostdata['old_visa_flag']=='Y'?'divshow':'divhide'}}">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Place of Issue
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Have you ever visited India before? </div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" name="oldvisaissueplace" value="{{!empty($getpostdata['oldvisaissueplace'])?$getpostdata['oldvisaissueplace']:NULL}}">
                                          </div>
                                       </div>
                                       <div class="input-block pre_visit_div {{!empty($getpostdata['old_visa_flag']) && $getpostdata['old_visa_flag']=='Y'?'divshow':'divhide'}}">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                 Date of Issue
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Have you ever visited India before?</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <label></label>
                                             <input type="text" class="datepicker" name="oldvisaissuedate" id="oldvisaissuedate" value="{{!empty($getpostdata['oldvisaissuedate'])?$getpostdata['oldvisaissuedate']:NULL}}">
                                          </div>
                                       </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Has permission to visit or to extend stay in India previously been refused?
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label class="inline radio">
                                          <input type="radio" name="refuse_flag" value="Y" {{!empty($getpostdata['refuse_flag']) && $getpostdata['refuse_flag']=="Y"?'checked':NULL}} required="">
                                          <span>Yes</span>
                                          </label>
                                          <label class="inline radio">
                                          <input type="radio" name="refuse_flag" value="N" {{!empty($getpostdata['refuse_flag']) && $getpostdata['refuse_flag']=="N"?'checked':NULL}} required="">
                                          <span>No</span>
                                          </label>
                                       </div>
                                    </div>
                                       <div class="input-block {{!empty($getpostdata['refuse_flag']) && $getpostdata['refuse_flag']=='Y'?'divshow':'divhide'}}" id="refuse_flag_div">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Has permission to visit or to extend stay in India previously been refused?
                                                <span class="strike">*</span>
                                                <div class="qs_sub"></div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <label>If so, when and by whom (Mention Control No. and date also)</label>
                                             <input type="text" class="datepicker" name="refuse_details" value="{{!empty($getpostdata['refuse_details'])?$getpostdata['refuse_details']:NULL}}">
                                          </div>
                                       </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Countries Visited in Last 10 years
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <textarea cols="40" rows="3" name="country_visited" required="">{{!empty($getpostdata['country_visited'])?$getpostdata['country_visited']:NULL}}</textarea>
                                       </div>
                                    </div>
                                    
                                    <!--div class="input-block" id="saarc_form_div">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Saarc Counties
                                             <span class="strike">*</span>
                                             <div class="qs_sub"> Please Select Countries</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                            @foreach($getsaarccountry as $row)
                                            <div class="ty_group_checkbox">
                                                <input type="checkbox" value="{{$row->country_id}}" style="width: 20%;" class="_ty_orbit" id="check_{{$row->country_id}}">
                                                <label for="check_{{$row->country_id}}">{{$row->country_name}}</label>
                                            </div>
                                            @endforeach
                                       </div>
                                    </div-->
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             India Reference Name
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="nameofsponsor_ind" required="" value="{{!empty($getpostdata['nameofsponsor_ind'])?$getpostdata['nameofsponsor_ind']:NULL}}">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             India Reference Address
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="add1ofsponsor_ind" required="" value="{{!empty($getpostdata['add1ofsponsor_ind'])?$getpostdata['add1ofsponsor_ind']:NULL}}">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             India Reference Phone No
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="phoneofsponsor_ind" class="only_number" required="" value="{{!empty($getpostdata['phoneofsponsor_ind'])?$getpostdata['phoneofsponsor_ind']:NULL}}">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Reference Name in {{!empty($visa_data['ref_name_in_nation'])?strtoupper($visa_data['ref_name_in_nation']):NULL}}
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="nameofsponsor_msn" required="" value="{{!empty($getpostdata['nameofsponsor_msn'])?$getpostdata['nameofsponsor_msn']:NULL}}">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Address in {{!empty($visa_data['ref_name_in_nation'])?strtoupper($visa_data['ref_name_in_nation']):NULL}}
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <textarea cols="40" rows="3" name="add1ofsponsor_msn" required="">{{!empty($getpostdata['add1ofsponsor_msn'])?$getpostdata['add1ofsponsor_msn']:NULL}}</textarea>
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Phone No in {{!empty($visa_data['ref_name_in_nation'])?strtoupper($visa_data['ref_name_in_nation']):NULL}}
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" class="only_number" name="phoneofsponsor_msn" required="" value="{{!empty($getpostdata['phoneofsponsor_msn'])?$getpostdata['phoneofsponsor_msn']:NULL}}">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Have you visited SAARC countries (except your own country) during last 3 years?
                                             <span class="strike">*</span>
                                             <div class="qs_sub"></div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <label class="inline radio">
                                          <input type="radio" name="saarc_flag" value="Y" {{!empty($getpostdata['saarc_flag']) && $getpostdata['saarc_flag']=="Y"?'checked':NULL}} required="">
                                          <span>Yes</span>
                                          </label>
                                          <label class="inline radio">
                                          <input type="radio" name="saarc_flag" value="N" {{!empty($getpostdata['saarc_flag']) && $getpostdata['saarc_flag']=="N"?'checked':NULL}} required="">
                                          <span>No</span>
                                          </label>
                                          <div class="col-md-12 fieldGroup {{!empty($getpostdata['saarc_flag']) && $getpostdata['saarc_flag']=='Y'?'divshow':'divhide'}}" id="saarc_form_div">
                                             <div class="col-md-12 paddingtb_20">
                                                <a href="javascript:void(0)" class="saarc_add_button"><span class="__add_circle">
                                                <i class="fa fa-plus"></i>
                                                </span></a>
                                             </div>
                                             <input type="hidden" id="div_number" name="div_number" value="1">
                                             <div class="col-md-12">
                                                @if(!empty($getpostdata['saarc_details']))
                                                  @foreach($getpostdata['saarc_details'] as $saarcrow)
                                                    <div class="col-md-4">
                                                       <div class="input-control">
                                                             <select class="__select_drop __small" name="saarcCountry[]" id="saarcCountry" required="">
                                                                <option>Select Country</option>
                                                                @foreach($getsaarccountry as $row)
                                                                <option value="{{$row->country_id}}" {{!empty($saarcrow[0]) && ($row->country_id==$saarcrow[0])?"selected":NULL}}>{{$row->country_name}}</option>
                                                                @endforeach
                                                             </select>
                                                       </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                     <div class="input-control">
                                                           <select class="__select_drop __small" name="saarcYear[]" id="saarcYear"  required="">
                                                              <option>Select Year</option>
                                                              @foreach($getsaarcyear as $val)
                                                              <option value="{{$val}}" {{!empty($saarcrow[1]) && $val==$saarcrow[1]?"selected":NULL}}>{{$val}}</option>
                                                              @endforeach
                                                           </select>
                                                     </div>
                                                  </div>
                                                  <div class="col-md-2">
                                                       <div class="input-control">
                                                             <input type="text" name="saarcVisitNo[]" id="saarcVisitNo"  required="" class="__small" placeholder="No. of visits" value="{{!empty($saarcrow[2])?$saarcrow[2]:NULL}}">
                                                       </div>
                                                  </div>
                                                  @endforeach
                                                @else
                                                  <div class="col-md-4">
                                                     <div class="input-control">
                                                           <select class="__select_drop __small" name="saarcCountry[]" id="saarcCountry" disabled="">
                                                              <option>Select Country</option>
                                                              @foreach($getsaarccountry as $row)
                                                              <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                              @endforeach
                                                           </select>
                                                     </div>
                                                  </div>
                                                  <div class="col-md-4">
                                                     <div class="input-control">
                                                           <select class="__select_drop __small" name="saarcYear[]" id="saarcYear" disabled="">
                                                              <option>Select Year</option>
                                                              @foreach($getsaarcyear as $val)
                                                              <option value="{{$val}}">{{$val}}</option>
                                                              @endforeach
                                                           </select>
                                                     </div>
                                                  </div>
                                                  <div class="col-md-2">
                                                     <div class="input-control">
                                                           <input type="text" name="saarcVisitNo[]" id="saarcVisitNo" class="__small" placeholder="No. of visits" disabled="">
                                                     </div>
                                                  </div>
                                                @endif
                                                <div class="col-md-2"></div>
                                             </div>
                                          </div>
                                          <div class="col-md-12 fieldGroupcopy divhide">
                                            <div class="col-md-4">
                                                <div class="input-control">
                                                    <select class="__select_drop __small child-input-class" name="saarcCountry[]" id="saarcCountry_copy" disabled="">
                                                        <option>Select Country</option>
                                                            @foreach($getsaarccountry as $row)
                                                        <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-control">
                                                    <select class="__select_drop __small child-input-class" name="saarcYear[]" id="saarcYear_copy" disabled="">
                                                        <option>Select Year</option>
                                                            @foreach($getsaarcyear as $val)
                                                        <option value="{{$val}}">{{$val}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-control">
                                                    <input type="text" name="saarcVisitNo[]" id="saarcVisitNo_copy" class="__small child-input-class" placeholder="No. of visits" disabled="">
                                                </div>
                                            </div>
                                            <div class="col-md-2"><a href="javascript:void(0)" class="saarc_remove_button" id="div_minus"><span class="__add_circle"><i class="fa fa-minus"></i></span></a>
                                            </div>
                                            </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12 text-center paddingtb_20">
                              <button type="submit" class="__btn __btn_next">NEXT STEP</button>
                           </div>
                        </div>
                        <!-- row end -->
                     </div>
                     <!-- Form wrapper -->
                  </div>
                  <!-- Tab Content End -->
               </form>
              <!--  <script src="{{URL::to('/')}}/js/windowunload.js" data-ordid="{{$getpostdata['order_id']}}"></script> -->
              <script src="{{URL::to('/')}}/js/dist/indiaevisa_autosaveform.js" form-id="frmevisadetails" ajax-url="ajaxautosavefinalform"></script>
            </div>
         </div>
      </div>
   </div>
</div>
@include('layouts.middle_footer')     
@stop