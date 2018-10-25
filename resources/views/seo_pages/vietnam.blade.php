@extends('layouts.layout')


@section('content')
    <div class="clearfix"></div>
<div class="__content_wrapper">
    <div class="container container-sm">
        <div class="row">
            <div class="col-md-12 __seo_header">
                <h1 class="__heading_black">Vietnam eVisa</h1>
                <a href="{{ url('/vietnam') }}" id="book_visa" class="__btn __btn_submit __active pull-right" data-val="Vietnam">BOOK NOW</a>
            </div>
            <div class="col-md-12">
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">About Vietnam eVisa</h2>
                    </div>
                    <div class="__content_col_9">
                        <p class="__ct_para">With the Vietnam eVisa, you can travel to Vietnam hassle-free and obtain the visa on your registered e-mail id from the comforts of your home. For Indian nationals travelling to Vietnam, there is only one type of eVisa available- 30 days eVisa.</p>
                    </div>
                </div>
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">Types of eVisas</h2>
                    </div>
                    <div class="__content_col_9">
                        <p class="__ct_para">For Vietnam eVisa for Indians, there is one type of eVisa that is available:</p>
                        <div class="__ct_list_box">
                            <p><strong>30 days eVisa- Single Entry </strong></p>
                            <p>In order to apply for this eVisa, your passport should have a validity for at least 30 days from the date your visa expires. </p>
                            <p>Visa validity is 30 days from the date of arrival.</p>
                            <p>Visa processing time is 3 working days. This visa type is non-refundable.</p>
                            <p>This visa is extendable.</p>
                        </div>
                    </div>
                </div>
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">Documents required for <br> Vietnam eVisa</h2>
                    </div>
                    <div class="__content_col_9">
                        <div class="__ct_list_box">
                            <p><strong>The documents required for Vietnam visa are</strong></p>
                            <ul class="__ct_decimal">
                                <li>The photographs and passport of the applicant must be uploaded.</li>
                                <li>A Portrait photograph (4x6cm) wherein the individual is looking straight without wearing any eye gear. </li>
                                <li>The Passport front page is needed with all personal information.</li>
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
                                <li>Valid passport and eVisa</li>
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
                                <li>Please note that the information filled in the eVisa application form cannot be changed once the visa is approved.</li>
                                <li> In cases where the child is travelling with parents and the parents are applying for business visa, the child must apply for tourist visa.</li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    @include('layouts.middle_footer')
@stop


