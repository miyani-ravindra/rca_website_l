@extends('layouts.layout')


@section('content')
    <div class="clearfix"></div>
<div class="__content_wrapper">
    <div class="container container-sm">
        <div class="row">
            <div class="col-md-12 __seo_header">
                <h1 class="__heading_black">Hong Kong PAR</h1>
                <a href="{{ url('/') }}" id="book_visa" class="__btn __btn_submit __active pull-right" data-val="HongKong">BOOK NOW</a>
            </div>
            <div class="col-md-12">
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">About Hong Kong PAR</h2>
                    </div>
                    <div class="__content_col_9">
                        <p class="__ct_para">For Indian nationals travelling to Hong Kong, there is a provision called "Pre-arrival Registration"(PAR). Rest assured as we help you fill the pre-arrival registration form and make your trip hassle-free.</p>
                    </div>
                </div>
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">Documents required for <br> Hong Kong PAR</h2>
                    </div>
                    <div class="__content_col_9">
                        <div class="__ct_list_box">
                            <p><strong>The documents required are-</strong></p>
                            <ul class="__ct_decimal">
                                <li>Passport with a validity of 6 months.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">Documents required for<br> Immigration</h2>
                    </div>
                    <div class="__content_col_9">
                        <div class="__ct_list_box">
                            <p><strong>The following documents are required to be presented at immigration-</strong></p>
                            <ul class="__ct_decimal">
                                <li>Current and old passport and visa copies (for recent travel in last 3 months/Previous Hong Kong travel) </li>
                                <li>Visiting card </li>
                                <li>Hotel Bookings</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('layouts.middle_footer')
@stop


