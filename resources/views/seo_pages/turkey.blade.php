@extends('layouts.layout')


@section('content')
    <div class="clearfix"></div>
<div class="__content_wrapper">
    <div class="container container-sm">
        <div class="row">
            <div class="col-md-12 __seo_header">
                <h1 class="__heading_black">Turkey eVisa</h1>
                <a href="{{ url('/turkey') }}" id="book_visa" class="__btn __btn_submit __active pull-right" data-val="Turkey">BOOK NOW</a>
            </div>
            <div class="col-md-12">
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">About Turkey eVisa</h2>
                    </div>
                    <div class="__content_col_9">
                        <p class="__ct_para">With Turkey eVisa, you can travel to Turkey and obtain the visa via e-mail, making the process smoother and time-saving. There is one type of Turkey eVisa for Indian nationals visiting Turkey- 30 days tourist or business eVisa.</p>
                    </div>
                </div>
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">Types of eVisas</h2>
                    </div>
                    <div class="__content_col_9">
                        <p class="__ct_para">For, Turkey eVisa for Indians, there is one type of eVisa that is available-</p>
                        <div class="__ct_list_box">
                            <p><strong>30 days Tourist and Business Visa- Single Entry</strong><br> The processing time is 48 hours.</p>
                            <p>In order to apply for this eVisa, your passport validity should necessarily be 6 months from the date of arrival.</p>
                            <p>This visa type is valid for 180 days.</p>
                            <p>For refund, the money is deducted only once the visa is approved. Incase of any rejection,money will not be deducted.</p>
                            <p>This visa is non-extendable.</p>
                        </div>
                    </div>
                </div>
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">Documents required for <br> Turkey eVisa</h2>
                    </div>
                    <div class="__content_col_9">
                        <div class="__ct_list_box">
                            <p><strong>The documents required for Turkey visa are-</strong>
                            </p>
                            <ul class="__ct_decimal">
                                <li>Passport copy </li>
                                <li>Hotel Reservation </li>
                                <li>Return ticket copy</li>
                                <li>Funds of up to USD 50</li>
                                <li>Valid supporting document (Valid visa or valid residence permit from one of the Schengen countries- USA, UK or Ireland. Please note that eVisas are not accepted as supporting documents.</li>
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
                            <p><strong>The following documents are to be presented on arrival in Turkey:</strong></p>
                            <ul class="__ct_decimal">
                                <li>Passport</li>
                                <li>Flight Tickets</li>
                                <li>Hotel Reservation</li>
                                <li>Proof of sufficient funds (USD 50 per day)</li>
                                <li>Visa/Residence Permit from Schengen Area, Ireland, U.K. or U.S. (No eVisas)</li>
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
                            <ul class="__ct_decimal">
                                <li>eVisa applications can be created for an individual, for a family (2 to 10 people) or for a group (10 to 300 people).</li>
                                <li>eVisa fee can be made only in US Dollars.</li>
                                <li>eVisa application has no connection with Turkish Embassies or Consulate General.</li>
                                <li> If you overstay your visa, you might be asked to pay fines, deported or banned future travel to Turkey for a specified period of time.</li>
                                <li>In case notified by the system that your eVisa application cannot be processed, visit the nearest Turkish Embassy or Consulate.</li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    @include('layouts.middle_footer')
@stop


