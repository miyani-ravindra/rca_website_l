@extends('layouts.layout')


@section('content')
    <div class="clearfix"></div>
<div class="__content_wrapper">
    <div class="container container-sm">
        <div class="row">
            <div class="col-md-12 __seo_header">
                <h1 class="__heading_black">Sri Lanka eVisa</h1>
                <a href="{{ url('/srilanka') }}" id="book_visa" class="__btn __btn_submit __active pull-right" data-val="Srilanka">BOOK NOW</a>
            </div>
            <div class="col-md-12">
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">About Sri Lanka eVisa</h2>
                    </div>
                    <div class="__content_col_9">
                        <p class="__ct_para">Sri Lanka eVisa, also known as Electronic Travel Authorization or ETA, permits you to travel to Sri Lanka for a specified period of time. The different types of eVisas available for Sri Lanka are tourist, business and transit visas. With Red Carpet Assist, you can book your ETA quickly.</p>
                    </div>
                </div>
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">Types of eVisas</h2>
                    </div>
                    <div class="__content_col_9">
                        <p class="__ct_para">For Sri Lanka visa for Indians, there are three types of eVisas that are available:</p>
                        <div class="__ct_list_box">
                            <ul class="__ct_decimal">
                                <li><strong>30 days Tourist eVisa- Double entry</strong></li>
                                <li><strong>30 days Business eVisa- Double Entry</strong></li>
                                <ul class="__unlist">
                                    <li>These visa types are valid for 6 months from the date of issue. The processing time is 24-48 hours. This visa type is not refundable.</li>
                                </ul>
                                <li><strong>2 days (48 hours) transit visa- Single Entry</strong></li>
                                <ul class="__unlist">
                                    <li>In order to apply for this eVisa, your passport validity should necessarily be 6 months from the date of arrival.This visa type is valid for 6 months from the date of issue.</li>
                                </ul>
                            </ul>
                            <p>These visas are extendable.</p>
                        </div>
                    </div>
                </div>
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">Documents required for <br> Sri Lanka eVisa</h2>
                    </div>
                    <div class="__content_col_9">
                        <div class="__ct_list_box">
                            <p><strong>The documents required for Sri Lanka visa of any type are-</strong></p>
                            <ul class="__ct_decimal">
                                <li>Passport copy first and last page with six months validity from the date of arrival.</li>
                                <li>Confirmed Return tickets.</li>
                                <li>Hotel Confirmations or any such supporting documents.</li>
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
                                <li> Your original passport which should have a validity of not less than six months from the date of arrival and with 3 back to back blank pages.</li>
                                <li>Confirmed Return tickets.</li>
                                <li>You should have sufficient funds for the expenditure that will be incurred during the trip.</li>
                                <li>You should have a clear copy of ETA.</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">Notes</h2>
                    </div>
                    <div class="__content_col_9">
                        <div class="__ct_list_box">
                            <p>Children under 16 years of age possessing separate passports should submit individual applications.</p>
                            <p>Exempted for ETA (Electronic Travel Authorization)</p>
                            <ul class="__ct_decimal">
                                <li>The Republic of Singapore.</li>
                                <li>The Republic of Maldives.</li>
                                <li>The Republic of Seychelles.</li>
                                <li>Children under 12 years of age.</li>
                            </ul>
                            <p>It is advisable to keep a copy of the ETA approval with you to be produced at the port of entry. In cases where the child is travelling with parents and the parents are applying for business visa,the child has to apply for tourist visa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('layouts.middle_footer')
@stop


