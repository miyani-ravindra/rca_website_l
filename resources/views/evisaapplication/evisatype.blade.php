@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <form method="post" id="frmevisatype" action="{{URL::to('/')}}/evisa-form/basic-details/{{$getpostdata['residing_code']}}" enctype='multipart/form-data'>
                            <input type="hidden" name="residing_in" id="residing_in" value="{{$getpostdata['residing_in']}}">
                            <input type="hidden" name="residing_code" id="residing_code" value="{{$getpostdata['residing_code']}}">
                            <input type="hidden" name="nationality" id="nationality" value="{{$getpostdata['nationality']}}">
                            <input type="hidden" name="order_id" id="order_id" value="{{$getpostdata['order_id']}}">
                            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$getpostdata['applicant_id']}}">
                            <input type="hidden" name="uid" id="uid" value="{{$getpostdata['uid']}}">
                            <input type="hidden" name="passport_type" id="passport_type" value="{{$getpostdata['passport_type']}}">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="doc_route" id="doc_route" value="{{URL::to('/')}}/evisa/service-document/{{$getpostdata['residing_code']}}">
                            <input type="hidden" name="form_route" id="form_route" value="{{URL::to('/')}}/evisa-form/basic-details/{{$getpostdata['residing_code']}}">
                            <input type="hidden" name="order_code" value="{{!empty($getpostdata['order_code'])?$getpostdata['order_code']:NULL}}">
                        <ul class="tabs_z">
                            <li class="__current">
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">eVisa</span>
                                    <img src="{{URL::to('/')}}/svg/E-visa.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">AIRPORT MEET &amp; GREET</span>
                                    <img src="{{URL::to('/')}}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">AIRPORT LOUNGE</span>
                                    <img src="{{URL::to('/')}}/svg/LOUNGE.svg" alt="" width="100" />
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
                                            <li class="active _10">Form Filling</li>
                                            <li class="">Verification</li>
                                            <li class="">Payment</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="__stylish_head">The Tough Question</h4>
                                    </div>
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                        <p class="__form_notes">Your reason for travel to India (Multiple Choice Available)</p>
                                        <span id="select_validate" class=""></span>
                                        </div>
                                        @foreach($get_service_arr as $row)
                                    <div class="col-md-4">
                                        <div class="group-radio">
                                            <input id="{{$row['service_id']}}" name="visa_type[]" type="checkbox" class="orbit _groupradio" value="{{$row['service_id']}}" group-id="{{$row['service_id']}}" disabled="" />
                                            <label for="{{$row['service_id']}}">{{$row['product_name']}}</label>
                                        </div>
                                        @foreach($row['purpose_que'][$row['product_name']] as $value)
                                        <label class="__radio">{{$value['purpose_name']}}
                                          <input type="radio" class="_selectradio" id="evisa_purpose_{{$value['purpose_id']}}" name="evisa_purpose[{{$row['service_id']}}]" value="{{$value['purpose_id']}}" data-id="{{$row['service_id']}}">
                                          <span class="checkmark"></span>
                                        </label>
                                        @endforeach
                                    </div>
                                    @endforeach
                                    </div>
                                    
                                    <!-- <div class="col-md-12">
                                        <p class="__form_notes">I’m confused and I don’t Know which ‘reasons for travel’ to apply for? <span class="__click_here">CLICK HERE</span></p>
                                        <div class="__questions_wrapper">
                                            <div class="__questions_box">
                                                <p>Question 1: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit ipsum tellus, ac facilisis mauris rhoncus at.</p>
                                                <p>Only 2 ETAs may be issued within one year.</p>
                                                <label class="__radio"> Choice 1
                                                  <input type="radio" name="question">
                                                  <span class="checkmark"></span>
                                                </label>
                                                <label class="__radio"> Choice 2
                                                  <input type="radio" name="question">
                                                  <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="__questions_box">
                                                <p>Question 1: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit ipsum tellus, ac facilisis mauris rhoncus at.</p>
                                                <p>Only 2 ETAs may be issued within one year.</p>
                                                <label class="__radio"> Choice 1
                                                  <input type="radio" name="question">
                                                  <span class="checkmark"></span>
                                                </label>
                                                <label class="__radio"> Choice 2
                                                  <input type="radio" name="question">
                                                  <span class="checkmark"></span>
                                                </label>
                                            </div>
                                            <div class="__questions_box">
                                                <p>Question 1: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec blandit ipsum tellus, ac facilisis mauris rhoncus at.</p>
                                                <p>Only 2 ETAs may be issued within one year.</p>
                                                <label class="__radio"> Choice 1
                                                  <input type="radio" name="question">
                                                  <span class="checkmark"></span>
                                                </label>
                                                <label class="__radio"> Choice 2
                                                  <input type="radio" name="question">
                                                  <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="col-md-12 text-center paddingtb_20">
                                        <button type="submit" class="__btn __btn_next" name="btn_evisa_type">SUBMIT</button>
                                    </div>
                                </div><!-- row end -->
                            </div><!-- Form wrapper -->
                        </div><!-- Tab Content End -->
                    </form>
                    <!-- <script src="{{URL::to('/')}}/js/windowunload.js" data-ordid="{{$getpostdata['order_id']}}" page-name="evisa-type" userleaving="false"></script> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.middle_footer')     
@stop