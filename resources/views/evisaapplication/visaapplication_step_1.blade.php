@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        @if($postData['citizen_to'] == 'IND')                            
                        <form method="post" id="frmvisa1" name="frmvisa1" action="{{ URL::to('/') }}/basic-details/{{strtolower($postData['travel_to'])}}">
                        @else
                        <form method="post" id="frmvisa1" name="frmvisa1" action="{{URL::to('/')}}/apply-online/{{$postData['residing_code']}}">
                        @endif
                        <input type="hidden" name="residing_code" id="residing_code" value="{{$postData['residing_code']}}">
                        <ul class="tabs_z">
                            <li class="__current">
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">eVisa</span>
                                    <img src="{{ URL::to('/') }}/svg/E-visa.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">AIRPORT MEET &amp; GREET</span>
                                    <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">AIRPORT LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading"><a href="{{ URL::to('/') }}"><img src="{{ URL::to('/') }}/svg/arrow-left.svg" alt="" width="15" /> eVisa</a></h1>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="__super_select __full">
                                            <label class="label">I am Traveling to</label>
                                            <div class="__icon">
                                                <img src="{{ URL::to('/') }}/svg/airplane-up.svg" alt="" width="20" />
                                            </div>
                                            <div class="__select_input">
                                                <input type="text" name="travel_to_text" id="travel_to_text" value="{{$postData['travel_to_text']}}" readonly="">
                                                <input type="hidden" name="travel_to" id="travel_to" value="{{$postData['travel_to']}}" readonly="">
                                            </div>
                                            <!-- <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10" /> -->
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="__super_select __full">
                                            <label class="label">I am Citizen of</label>
                                            <div class="__icon">
                                                <img src="{{ URL::to('/') }}/svg/citizen.svg" alt="" width="16" />
                                            </div>
                                            <div class="__select_input">
                                                <input type="text" name="citizen_to_text" id="citizen_to_text" value="{{$postData['citizen_to_text']}}" readonly="">
                                                <input type="hidden" name="citizen_to" id="citizen_to" value="{{$postData['citizen_to']}}" readonly="">
                                            </div>
                                            <!-- <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10" /> -->
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="__super_select __full">
                                            <label class="label">I am Residing in</label>
                                            <div class="__icon">
                                                <img src="{{ URL::to('/') }}/svg/location.svg" alt="" width="14" />
                                            </div>
                                            <div class="__select_input">
                                                <input type="text" name="residing_in" id="residing_in" value="{{$postData['residing_in']}}" readonly="">
                                            </div>
                                            <!-- <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" class="__caret" width="10" /> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Tab Content End -->
                        <!-- Docs body -->
                            <div class="__docs_details">
                                <div class="row">
                                    {!!$postData['evisa_summary']!!}
                                </div>
                                <div class="col-md-12">
                                    <input type="checkbox" name="terms" id="terms" required="">  I agree to the <a href='{{URL::to("/")}}/terms-and-conditions' target='_blank'>Terms & Conditions</a> and <a href='{{URL::to("/")}}/privacy-policy' target='_blank'>Privacy Policy</a>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center paddingtb_20">
                                        <button type="submit" id="btn_ready" class="__btn __active">I AM READY TO APPLY</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>           
@include('layouts.middle_footer')     
@stop