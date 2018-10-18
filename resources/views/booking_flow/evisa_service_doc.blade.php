@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <form method="post" id="frmextradoc" action="{{URL::to('/')}}/booking/b2b-basic-details/{{$getpostdata['residing_code']}}" enctype='multipart/form-data'>
                            <input type="hidden" name="residing_in" id="residing_in" value="{{$getpostdata['residing_in']}}">
                            <input type="hidden" name="residing_code" id="residing_code" value="{{$getpostdata['residing_code']}}">
                            <input type="hidden" name="nationality" id="nationality" value="{{$getpostdata['nationality']}}">
                            <input type="hidden" name="order_id" id="order_id" value="{{$getpostdata['order_id']}}">
                            <input type="hidden" name="applicant_id" id="applicant_id" value="{{$getpostdata['applicant_id']}}">
                            <input type="hidden" name="uid" id="uid" value="{{$getpostdata['uid']}}">
                            <input type="hidden" name="passport_type" id="passport_type" value="{{$getpostdata['passport_type']}}">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                            <input type="hidden" name="order_code" value="{{!empty($getpostdata['order_code'])?$getpostdata['order_code']:NULL}}">
                        <ul class="tabs_z">
                            <li class="__current" data-tab="tab-1">
                                <a href="{{URL::to('/')}}">
                                    <embed src="{{ URL::to('/') }}/svg/ic_evisa.svg" alt="" class="ShowInMobile" width="80" /> 
                                    <span class="__title">eVisa</span>
                                    <img src="{{ URL::to('/') }}/svg/E-visa.svg" class="HideInMobile" alt="" width="80" />
                                </a>
                            </li>
                            <li id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <embed src="{{ URL::to('/') }}/svg/ic_m&a.svg" alt="" class="ShowInMobile" width="80" /> <span class="__title"> <i>AIRPORT </i> MEET & GREET</span> 
                                    <img src="{{URL::to('/')}}/svg/MNA.svg" alt="" class="HideInMobile" width="80"/>
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <embed src="{{ URL::to('/') }}/svg/ic_lounge.svg" alt="" class="ShowInMobile" width="80" /> 
                                    <span class="__title"> <i>AIRPORT </i> LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" class="HideInMobile" alt="" width="80" />
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
                                        <p class="__form_notes">Are you ready with your documents?</p>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="group">
                                            <div class="__app_input">
                                            @if(isset($serviceid[2]))
                                            <!-- passport front -->
                                            <label class="label">Business Card <span class="_astrik">*</span></label>
                                            <input type="file" name="business_card" required="" class="required" accept="application/pdf">
                                            @endif
                                            <!-- end -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="group">
                                            <div class="__app_input">
                                            @if(isset($serviceid[3]))
                                            <!-- passport photo -->
                                            <label class="label">Hospital Letter <span class="_astrik">*</span></label>
                                            <input type="file" name="hospital_letter" required="" class="required" accept="application/pdf">
                                            @endif
                                            <!-- end -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="__btn __btn_next" name="btn_evisa_doc">Next Step</button>
                                    </div>
                                </div><!-- row end -->
                            </div><!-- Form wrapper -->
                        </div><!-- Tab Content End -->
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.middle_footer')     
@stop