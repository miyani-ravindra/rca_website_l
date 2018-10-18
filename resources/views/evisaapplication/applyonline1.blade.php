@extends('layouts.layout')

@section('content')
   <!-- header end -->
    <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <form method="post" action="{{URL::to('/')}}/evisa-type/{{$postData['residing_code']}}" id="frmevisastep2" name="frmevisastep2" enctype='multipart/form-data'>
                            <input type="hidden" name="residing_in" id="residing_in" value="{{$postData['residing_in']}}">
                            <input type="hidden" name="residing_code" id="residing_code" value="{{$postData['residing_code']}}">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <ul class="tabs_z">
                            <li class="__current">
                                <a href="{{URL::to('/')}}">
                                    <embed src="{{ URL::to('/') }}/svg/ic_evisa.svg" alt="" class="ShowInMobile" width="80" />
                                    <span class="__title">eVisa</span>
                                    <img src="{{URL::to('/')}}/svg/E-visa.svg" alt="" class="HideInMobile"  width="80" />
                                </a>
                            </li>
                            <li id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                <embed src="{{ URL::to('/') }}/svg/ic_m&a.svg" alt="" class="ShowInMobile" width="80" />
                           
                                    <span class="__title"><i>AIRPORT </i> MEET &amp; GREET</span>
                                    <img src="{{URL::to('/')}}/svg/MNA.svg" alt="" class="HideInMobile"  width="80" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                <embed src="{{ URL::to('/') }}/svg/ic_lounge.svg" alt="" class="ShowInMobile" width="80" />
                           
                                    <span class="__title"><i>AIRPORT </i> LOUNGE</span>
                                    <img src="{{URL::to('/')}}/svg/LOUNGE.svg" alt="" class="HideInMobile"  width="80" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading">eVisa</h1>
                                    <div class="__progress_wrapper">
                                        <ul class="__progress">
                                            <li class="active _50">Basic Info + Document Upload</li>
                                            <li class="">Form Filling</li>
                                            <li class="">Verification</li>
                                            <li class="">Payment</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="__stylish_head">Let’s Start!</h4>
                                    </div>
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                            <p class="__form_notes">We Know the following about you</p>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="__super_select __full">
                                            <label class="label">I am Traveling to</label>
                                            <div class="__icon">
                                                <img src="{{URL::to('/')}}/svg/airplane-up.svg" alt="" width="20" />
                                            </div>
                                            <div class="__select_input">
                                                <input type="text" name="travel_to" id="travel_to" value="{{$postData['travel_to']}}" readonly="">
                                            </div>
                                            <!-- <img src="svg/caret-down.svg" alt="" class="__caret" width="10" /> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="__super_select __full">
                                            <label class="label">I am Citizen of</label>
                                            <div class="__icon">
                                                <img src="{{URL::to('/')}}/svg/citizen.svg" alt="" width="16" />
                                            </div>
                                            <div class="__select_input">
                                                <input type="text" name="citizen_to" id="citizen_to" value="{{$postData['citizen_to']}}" readonly="">
                                            </div>
                                            <!-- <img src="{{URL::to('/')}}/svg/caret-down.svg" alt="" class="__caret" width="10" /> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="__super_select __full">
                                            <label class="label">My Passport Type is</label>
                                            <div class="__icon">
                                                <img src="{{URL::to('/')}}/svg/location.svg" alt="" width="14" />
                                            </div>
                                            <div class="__select_input">
                                                <select id="passport_code" name="passport_code" required="">
                                                    @foreach($passporttype_arr as $key=>$val)
                                                    <option value="{{$val['passport_type_id']}}">{{$val['passport_type_name']}}</option>
                                                    @endforeach
                                                </select>
                                                <label id="passport_type_error" class="error" style="display: none;" for="passport_code"></label>
                                            </div>
                                            <img src="{{URL::to('/')}}/svg/caret-down.svg" alt="" class="__caret" width="10" />
                                        </div>
                                    </div>
                                    </div>
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                            <p class="__form_notes">Need some more information to help us apply for your Indian eVisa ETA’s</p>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_form">
                                                <div class="group width_100">
                                                    <div class="__app_input">
                                                        <label>Full Name</label>
                                                        <input type="text" name="user_name" id="user_name" value="" placeholder="Enter Full Name" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_form">
                                                <div class="group width_100">
                                                    <div class="__app_input">
                                                        <label>Email Address</label>
                                                        <input type="text" name="email_id" id="email_id" value="" placeholder="Enter Email Address" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="__app_form">
                                                <div class="group width_100">
                                                    <div class="__app_input">
                                                        <label>Mobile Number</label>
                                                        <input type="text" name="phone_number" id="phone_number" value="" placeholder="Enter Mobile" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-4">
                                        <div class="__super_select __full">
                                            <div class="__icon">
                                                <img src="{{URL::to('/')}}/svg/calendar.svg" alt="" width="16" />
                                            </div>
                                            <div class="__select_input">
                                                <input type="text" placeholder="Expected Date of Arrival" class="datepicker" name="arrival_date" id="arrival_date"  required="" />
                                            </div>
                                            <img src="{{URL::to('/')}}/svg/caret-down.svg" alt="" class="__caret" width="10" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="__super_select __full">
                                            <div class="__icon">
                                                <img src="{{URL::to('/')}}/svg/location.svg" alt="" width="13" />
                                            </div>
                                            <div class="__select_input">
                                                <select id="airport_code" class="select" name="airport_code" required="">
                                                    <option selected="true" value="">Airport of Arrival</option>
                                                    @foreach($airport_arr as $key=>$val)
                                                    <option value="{{$val['airport_id']}}">{{$val['airport_name']}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="__fm_box">
                                        <div class="col-md-12">
                                            <p class="__form_notes">Are you ready with your documents?</p>
                                        </div>
                                        <div class="col-md-12">
                                        <div class="__document_upload_box">
                                            <!-- passport front -->
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" id="div_front_thumb">
                                                <div class="doc-head">Colored frontpage of valid passport</div>
                                            </div> 
                                            <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Upload</span><span class="fileinput-exists">Change</span>
                                                    <input type="file" name="frontpage" required="" class="required" accept="image/jpeg">
                                                    </span>
                                                    <a href="#" class="btn btn-default fileinput-exists" id="front_remove" data-dismiss="fileinput" onclick="removeforntthumb()">Remove</a> 
                                            </div> 
                                            </div>
                                            <!-- end -->
                                            <!-- passport photo -->
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-preview thumbnail" id="div_photo_thumb">
                                                    <div class="doc-head">Passport Size photograph</div>
                                                </div> 
                                            <div>
                                            <span class="btn btn-default btn-file"><span class="fileinput-new">Upload</span><span class="fileinput-exists">Change</span>
                                                    <input type="file" name="photograph" required="" class="required" accept="image/jpeg">
                                                    </span>
                                                    <a href="#" class="btn btn-default fileinput-exists" id="photo_remove" data-dismiss="fileinput" onclick="removephotothumb()">Remove</a> 
                                            </div> 
                                            </div>
                                            <!-- end -->
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-12 text-center paddingtb_20">
                                        <button type="submit" class="__btn __btn_next" id="btnapply" name="btnapply">NEXT STEP</button>
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
    <!-- Top bg End -->
@include('layouts.middle_footer')     
@stop