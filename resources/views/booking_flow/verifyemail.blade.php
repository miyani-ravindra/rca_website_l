@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_60">
                        <ul class="tabs_z">
                            <li class="__current">
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">E-VISA</span>
                                    <img src="{{ URL::to('/') }}/svg/E-visa.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="meet-and-assist.html">
                                    <span class="__title">MEET &amp; ASSIST</span>
                                    <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="lounge.html">
                                    <span class="__title">LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading">E-Visa</h1>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="__form_notes">My visa request information</p>
                                    </div>
                                    <div class="col-md-12">
                                        <h4>Thank you for completing the form filling process.</h4>
                                       
                                    </div>
                                    <div class="col-md-12 text-center paddingtb_10"><a href="{{URL::to('/')}}/booking/b2b-india-evisa-application" class="__btn __btn_next">Home</a>
                                    </div>
                                </div><!-- row end -->
                            </div><!-- Form wrapper -->
                        </div><!-- Tab Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.middle_footer')     
@stop
