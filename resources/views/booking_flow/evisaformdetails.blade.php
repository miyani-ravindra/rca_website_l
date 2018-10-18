@extends('layouts.layout')
@section('content')
<div class="clearfix"></div>
<div class="__bg">
   <div class="container container-sm">
      <div class="row">
         <div class="col-md-12">
            <div class="paddingtb_50">
               <form method="post" id="frmevisadetails" name="frmevisadetails" action="{{URL::to('/')}}/booking/thankyou">
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
                                          <input type="text" name="type_of_visa" value="{{!empty($visa_data['visa_type'])?$visa_data['visa_type']:NULL}}" readonly="" />
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
                                          <input type="text" name="visa_service" value="{{!empty($visa_data['visa_services'])?$visa_data['visa_services']:NULL}}" readonly="" />
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
                                          <input type="text" name="service_req_form_values" required="">
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                            Places to be visited
                                             <span class="strike"></span>
                                             <div class="qs_sub">2</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="service_req_form_values2">
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
                                          <span><b>{{$visa_data['visa_duration']}} Days</b></span>
                                          <input type="hidden" name="visa_duration" value="{{$visa_data['visa_duration']}}" readonly="">
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
                                          <input type="text" name="name_entries" value="{{($visa_data['no_entries']==3)?'Triple':'Double'}}" readonly="">
                                          <input type="hidden" name="no_entries" value="{{$visa_data['no_entries']}}" readonly="">
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
                                          <input type="text" name="airport_name" value="{{$visa_data['airport_name']}}" readonly="">
                                          <input type="hidden" name="airport_id" value="{{$visa_data['airport_id']}}" readonly="">
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
                                          <input type="text" class="__select_drop inputF" autocomplete="off" />
                                          <ul class="hiddenul">
                                            @foreach($getairport as $row)
                                             <li data-val="{{$row->airport_id}}">{{$row->airport_name}}</li> 
                                             @endforeach
                                          </ul>
                                          <input type="hidden" name="pres_country" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                    </div>
                                    @if(count($service_arr)>0)
                                    <?php $renderform = new RenderXMLForm();?>
                                    @foreach($service_arr as $row)
                                    @if($row['purpose_id']===1)
                                    <!--div class="col-md-12">
                                       <h5>Details of Purpose "{{$row['purpose_name']}}"</h5>
                                       </div-->
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
                                    @elseif($row['purpose_id']===3)
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
                                    @elseif($row['purpose_id']===4)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
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
                                    @elseif($row['purpose_id']===5)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
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
                                    @elseif($row['purpose_id']===6)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
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
                                    @elseif($row['purpose_id']===7)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
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
                                    @elseif($row['purpose_id']===8)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
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
                                    @elseif($row['purpose_id']===9)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
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
                                    @elseif($row['purpose_id']===10)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
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
                                    @elseif($row['purpose_id']===11)
                                    <div class="clearfix"></div>
                                    <div class="col-md-12">
                                       <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                    </div>
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
                                    @endforeach
                                    @endif
                                    <div class="col-md-12">
                                       <h5 class="__form_notes"></h5>
                                    </div>
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
                                          <input type="radio" name="old_visa_flag" value="Y" required="">
                                          <span>Yes</span>
                                          </label>
                                          <label class="inline radio">
                                          <input type="radio" name="old_visa_flag" value="N" checked="" required="">
                                          <span>No</span>
                                          </label>
                                       </div>
                                    </div>
                                       <div class="input-block pre_visit_div">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Have you ever visited India before?
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Address</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <textarea cols="40" rows="3" name="prv_visit_add1"></textarea>
                                          </div>
                                       </div>
                                       <div class="input-block pre_visit_div">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                               Cities previously visited in India 
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Have you ever visited India before?</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <textarea cols="40" rows="3" name="visited_city"></textarea>
                                          </div>
                                       </div>
                                       <div class="input-block pre_visit_div">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Last Indian Visa No/Currently valid Indian Visa No.
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Have you ever visited India before?</div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" name="old_visa_no" value="">
                                          </div>
                                       </div>
                                       <div class="input-block pre_visit_div">
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
                                             <input type="text" class="__select_drop inputF" autocomplete="off" />
                                          <ul class="hiddenul">
                                            @foreach($getvisatypes as $val)
                                                <li data-val="{{$val->id}}">{{$val->type_name}}</li>
                                             @endforeach
                                          </ul>
                                          <input type="hidden" name="old_visa_type_id" class="inputH" value="">
                                        </div>
                                        <div class="outerclick"></div>
                                       </div>
                                       <div class="input-block pre_visit_div">
                                          <div class="labels">
                                             <div class="qs_list"></div>
                                             <div class="qs_body">
                                                Place of Issue
                                                <span class="strike">*</span>
                                                <div class="qs_sub">Have you ever visited India before? </div>
                                             </div>
                                          </div>
                                          <div class="input-control">
                                             <input type="text" name="oldvisaissueplace" value="">
                                          </div>
                                       </div>
                                       <div class="input-block pre_visit_div">
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
                                             <input type="text" class="datepicker" name="oldvisaissuedate" id="oldvisaissuedate" value="">
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
                                          <input type="radio" name="refuse_flag" value="Y" required="">
                                          <span>Yes</span>
                                          </label>
                                          <label class="inline radio">
                                          <input type="radio" name="refuse_flag" value="N" checked="" required="">
                                          <span>No</span>
                                          </label>
                                       </div>
                                    </div>
                                       <div class="input-block" id="refuse_flag_div">
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
                                             <input type="text" class="datepicker" name="refuse_details" value="">
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
                                          <textarea cols="40" rows="3" name="country_visited"></textarea>
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
                                          <input type="text" name="nameofsponsor_ind" required="">
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
                                          <input type="text" name="add1ofsponsor_ind" required="">
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
                                          <input type="text" name="phoneofsponsor_ind" required="">
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
                                          <input type="text" name="nameofsponsor_msn" required="">
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
                                          <textarea cols="40" rows="3" name="add1ofsponsor_msn" required=""></textarea>
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
                                          <input type="text" name="phoneofsponsor_msn" required="">
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
                                          <input type="radio" name="saarc_flag" value="Y" required="">
                                          <span>Yes</span>
                                          </label>
                                          <label class="inline radio">
                                          <input type="radio" name="saarc_flag" value="N" checked="" required="">
                                          <span>No</span>
                                          </label>
                                          <div class="col-md-12" id="saarc_form_div">
                                             <div class="col-md-12 paddingtb_20">
                                                <a href="javascript:void(0)" onclick="add_div()"><span class="__add_circle">
                                                <i class="fa fa-plus"></i>
                                                </span></a>&nbsp;&nbsp;<a href="javascript:void(0)" id="div_minus" onclick="remove_div()"><span class="__add_circle">
                                                <i class="fa fa-minus"></i>
                                                </span></a>
                                             </div>
                                             <input type="hidden" id="div_number" name="div_number" value="1">
                                             @for($i=1;$i<=7;$i++)
                                             @if($i==1)
                                             <div class="col-md-12" id="row_{{$i}}" style="display: inline-block;">
                                                <div class="col-md-4">
                                                   <div class="input-control">
                                                         <select class="__select_drop __small" name="saarcCountry[]" id="selcountry_{{$i}}">
                                                            <option>Select Country</option>
                                                            @foreach($getsaarccountry as $row)
                                                            <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                            @endforeach
                                                         </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="input-control">
                                                         <select class="__select_drop __small" name="saarcYear[]" id="selyear_{{$i}}">
                                                            <option>Select Year</option>
                                                            @foreach($getsaarcyear as $val)
                                                            <option value="{{$val}}">{{$val}}</option>
                                                            @endforeach
                                                         </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="input-control">
                                                         <input type="text" name="saarcVisitNo[]" id="inputvisit_{{$i}}" class="__small" placeholder="No. of visits">
                                                   </div>
                                                </div>
                                             </div>
                                             @else
                                             <div class="col-md-12" id="row_{{$i}}" style="display: none;">
                                                <div class="col-md-4">
                                                   <div class="input-control">
                                                         <select class="__select_drop __small" name="saarcCountry[]" id="selcountry_{{$i}}" disabled="">
                                                            <option>Select Country</option>
                                                            @foreach($getsaarccountry as $row)
                                                            <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                            @endforeach
                                                         </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="input-control">
                                                         <select class="__select_drop __small" name="saarcYear[]" id="selyear_{{$i}}" disabled="">
                                                            <option>Select Year</option>
                                                            @foreach($getsaarcyear as $val)
                                                            <option value="{{$val}}">{{$val}}</option>
                                                            @endforeach
                                                         </select>
                                                   </div>
                                                </div>
                                                <div class="col-md-4">
                                                   <div class="input-control">
                                                         <input type="text" name="saarcVisitNo[]" id="inputvisit_{{$i}}" class="__small" placeholder="No. of visits" disabled="">
                                                   </div>
                                                </div>
                                             </div>
                                             @endif
                                             @endfor
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
            </div>
         </div>
      </div>
   </div>
</div>
@include('layouts.middle_footer')     
@stop