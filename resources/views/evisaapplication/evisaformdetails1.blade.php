@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <form method="post" id="frmevisadetails" name="frmevisadetails" action="{{URL::to('/')}}/evisa/verifymail">
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
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                            <h5 class="paddingtb_10">Details of Visa Sought</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="__app_form">
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Type of Visa</label>
                                                    <input type="text" name="type_of_visa" value="{{!empty($visa_data['visa_type'])?$visa_data['visa_type']:NULL}}" readonly="" />
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Visa Service</label>
                                                    <input type="text" name="visa_service" value="{{!empty($visa_data['visa_services'])?$visa_data['visa_services']:NULL}}" readonly="" />
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Places to be visited *</label>
                                                    <input type="text" name="service_req_form_values" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Places to be visited line 2</label>
                                                    <input type="text" name="service_req_form_values2">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Duration of Visa</label>
                                                    <span><b>{{$visa_data['visa_duration']}} Days</b></span>
                                                    <input type="hidden" name="visa_duration" value="{{$visa_data['visa_duration']}}" readonly="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>No. of Entries</label>
                                                    <input type="text" name="name_entries" value="{{($visa_data['no_entries']==3)?'Triple':'Double'}}" readonly="">
                                                    <input type="hidden" name="no_entries" value="{{$visa_data['no_entries']}}" readonly="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__app_input">
                                                    <label>Port of Arrival in India</label>
                                                    <input type="text" name="airport_name" value="{{$visa_data['airport_name']}}" readonly="">
                                                    <input type="hidden" name="airport_id" value="{{$visa_data['airport_id']}}" readonly="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <div class="__select_box">
                                                    <label>Expected Port of Exit from India</label>
                                                    <select class="__select" name="pres_country" required="">
                                                        <option value="">Select exit point</option>
                                                        @foreach($getairport as $row)
                                                        <option value="{{$row->airport_id}}">{{$row->airport_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                            <div class="__app_form">
                                                @if(count($service_arr)>0)
                                                <?php $renderform = new RenderXMLForm();?>
                                                @foreach($service_arr as $row)
                                                    @if($row['purpose_id']===1)
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-12">
                                                    <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                                    </div>
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
                                                    <div class="clearfix"></div>
                                                    <div class="col-md-12">
                                                    <h5 class="paddingtb_10">Details of Purpose "{{$row['purpose_name']}}"</h5>
                                                    </div>
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                            <div class="__app_form">
                                                <div class="col-md-12">
                                                    <h5 class="__form_notes">Previous Visa/Currently valid Visa Details</h5>
                                                </div>
                                                <div class="__form_yes_no">
                                                <p>Have you ever visited India before?</p>
                                                <div class="__inline">
                                                    <label class="__radio">Yes
                                                        <input type="radio" name="old_visa_flag" value="Y" required="">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="__radio">No
                                                        <input type="radio" name="old_visa_flag" value="N" checked="" required="">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="pre_visit_div">
                                                <div class="group">
                                                    <div class="__app_input">
                                                        <label>Address</label>
                                                        <textarea cols="40" rows="3" name="prv_visit_add1"></textarea>
                                                    </div>
                                                </div>
                                                <div class="group">
                                                    <div class="__app_input">
                                                        <label>Cities previously visited in India</label>
                                                        <textarea cols="40" rows="3" name="visited_city"></textarea>
                                                    </div>
                                                </div>
                                                <div class="group">
                                                    <div class="__app_input">
                                                        <label>Last Indian Visa No/Currently valid Indian Visa No.</label>
                                                        <input type="text" name="old_visa_no" value="">
                                                    </div>
                                                </div>
                                                <div class="group">
                                                    <div class="__select_box">
                                                        <label>Type of Visa</label>
                                                        <select class="__select" name="old_visa_type_id">
                                                            <option value="">Select visa type</option>
                                                            @foreach($getvisatypes as $val)
                                                            <option value="{{$val->id}}">{{$val->type_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <i class="fa fa-angle-down"></i>
                                                    </div>
                                                </div>
                                                <div class="group">
                                                    <div class="__app_input">
                                                        <label>Place of Issue</label>
                                                        <input type="text" name="oldvisaissueplace" value="">
                                                    </div>
                                                </div>
                                                <div class="group">
                                                    <div class="__app_input">
                                                        <label>Date of Issue</label>
                                                        <input type="text" class="datepicker" name="oldvisaissuedate" id="oldvisaissuedate" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="__form_yes_no">
                                                <p>Has permission to visit or to extend stay in India previously been refused?</p>
                                                    <div class="__inline">
                                                        <label class="__radio">Yes
                                                            <input type="radio" name="refuse_flag" value="Y" required="">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <label class="__radio">No
                                                            <input type="radio" name="refuse_flag" value="N" checked="" required="">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                            </div>
                                            <div class="col-md-12" id="refuse_flag_div">
                                                <div class="group">
                                                    <div class="__app_input">
                                                        <label>If so, when and by whom (Mention Control No. and date also)</label>
                                                        <input type="text" class="datepicker" name="refuse_details" value="">
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                            <div class="__app_form">
                                                <div class="col-md-12">
                                                    <h5 class="__form_notes">Other Information</h5>
                                                </div>
                                                <div class="col-md-12">
                                                <div class="group">
                                                    <div class="__app_input">
                                                        <label>Countries Visited in Last 10 years</label>
                                                        <textarea cols="40" rows="3" name="country_visited"></textarea>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                            <div class="__app_form">
                                                <div class="col-md-12">
                                                <h5 class="__form_notes">SAARC Country Visit Details</h5>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="__form_yes_no">
                                                        <p>Have you visited SAARC countries (except your own country) during last 3 years?</p>
                                                            <div class="__inline">
                                                                <label class="__radio">Yes
                                                                    <input type="radio" name="saarc_flag" value="Y" required="">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                                <label class="__radio">No
                                                                    <input type="radio" name="saarc_flag" value="N" checked="" required="">
                                                                    <span class="checkmark"></span>
                                                                </label>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-12" id="saarc_form_div">
                                                <div class="col-md-12">
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
                                                            <div class="group width_100">
                                                            <div class="__select_box">
                                                                <select class="__select" name="saarcCountry[]" id="selcountry_{{$i}}">
                                                            <option>Select Country</option>
                                                            @foreach($getsaarccountry as $row)
                                                            <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <i class="fa fa-angle-down"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="group width_100">
                                                        <div class="__select_box">
                                                        <select class="__select" name="saarcYear[]" id="selyear_{{$i}}">
                                                            <option>Select Year</option>
                                                            @foreach($getsaarcyear as $val)
                                                            <option value="{{$val}}">{{$val}}</option>
                                                            @endforeach
                                                        </select>
                                                        <i class="fa fa-angle-down"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="group width_100">
                                                        <div class="__app_input">
                                                            <input type="text" name="saarcVisitNo[]" id="inputvisit_{{$i}}" placeholder="No. of visits">
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                                @else
                                                <div class="col-md-12" id="row_{{$i}}" style="display: none;">
                                                    <div class="col-md-4">
                                                    <div class="group width_100">
                                                                <div class="__select_box">
                                                                <select class="__select" name="saarcCountry[]" id="selcountry_{{$i}}" disabled="">
                                                            <option>Select Country</option>
                                                            @foreach($getsaarccountry as $row)
                                                            <option value="{{$row->country_id}}">{{$row->country_name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <i class="fa fa-angle-down"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="group width_100">
                                                        <div class="__select_box">
                                                        <select class="__select" name="saarcYear[]" id="selyear_{{$i}}" disabled="">
                                                            <option>Select Year</option>
                                                            @foreach($getsaarcyear as $val)
                                                            <option value="{{$val}}">{{$val}}</option>
                                                            @endforeach
                                                        </select>
                                                        <i class="fa fa-angle-down"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="group width_100">
                                                        <div class="__app_input">
                                                            <input type="text" name="saarcVisitNo[]" id="inputvisit_{{$i}}" placeholder="No. of visits" disabled="">
                                                        </div>
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
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                            <div class="col-md-12">
                                                <h5 class="__form_notes">Reference</h5>
                                            </div>
                                            <div class="__app_form">
                                            <div class="group">
                                                <label class="label">Reference Name in India</label>
                                                <div class="__app_input">
                                                    <input type="text" name="nameofsponsor_ind" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <label class="label">Address</label>
                                                <div class="__app_input">
                                                    <input type="text" name="add1ofsponsor_ind" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <label class="label">Phone</label>
                                                <div class="__app_input">
                                                    <input type="text" name="phoneofsponsor_ind" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <label class="label">Reference Name in {{!empty($visa_data['ref_name_in_nation'])?strtoupper($visa_data['ref_name_in_nation']):NULL}}</label>
                                                <div class="__app_input">
                                                    <input type="text" name="nameofsponsor_msn" required="">
                                                </div>
                                            </div>
                                            <div class="group">
                                                <label class="label">Address</label>
                                                <div class="__app_input">
                                                    <textarea cols="40" rows="3" name="add1ofsponsor_msn" required=""></textarea>
                                                </div>
                                            </div>
                                            <div class="group">
                                                <label class="label">Phone</label>
                                                <div class="__app_input">
                                                    <input type="text" name="phoneofsponsor_msn" required="">
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
