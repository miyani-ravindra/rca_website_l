@extends('layouts.layout')


@section('content')
    <div class="clearfix"></div>
<div class="__content_wrapper">
    <div class="container container-sm">
        <div class="row">
            <div class="col-md-12 __seo_header">
                <h1 class="__heading_black">Cambodia eVisa</h1>
                <a href="{{ url('/cambodia') }}" id="book_visa" class="__btn __btn_submit __active pull-right" data-val="Cambodia">BOOK NOW</a>
            </div>
            <div class="col-md-12">
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">About Cambodia eVisa</h2>
                    </div>
                    <div class="__content_col_9">
                        <p class="__ct_para">Want to travel to Cambodia and worried about the visa process. Fret not, with RedCarpet Assist, you can obtain a Cambodia eVisa quickly and efficiently via e-mail. The only type of Cambodia eVisa available for Indian nationals is 30 days eVisa.</p>
                    </div>
                </div>
                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">Types of eVisas</h2>
                    </div>
                    <div class="__content_col_9">
                        <p class="__ct_para">For Cambodia eVisa for Indians, there is one type of eVisa that is available:</p>
                        <div class="__ct_list_box">
                            <p><strong>30 days eVisa-Single Entry </strong></p>
                            <p>In order to apply for this eVisa, your passport validity should necessarily be 6 months from the date of arrival.</p>
                            <p>The processing time is 3 working days. </p>
                            <p>The visa validity is 3 months.</p>
                            <p>If your application is rejected, then you will get a full refund of the visa fees.</p>
                            <p>This visa is extendable.</p>
                        </div>
                    </div>
                </div>

                <div class="__content_row">
                    <div class="__content_col_3">
                        <h2 class="__ct_title">Documents required for <br> Cambodia eVisa</h2>
                    </div>
                    <div class="__content_col_9">
                        <div class="__ct_list_box">
                            <p><strong>The documents required for Cambodia visa are-</strong></p>
                            <ul class="__ct_decimal">
                                <li>A passport which should be valid for more than six months at the time of entry with 3 back to back blank pages.</li>
                                <li>A recent passport size photo in digital format (JPEG or PNG format).</li>
                                <li>A valid credit card.(Visa/MasterCard)</li>
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
                            <p>Not all border checkpoints support eVisa. Travellers with eVisas can enter only via the following entry points:</p>
                            <ul class="__ct_decimal">
                                <li>Phnom Penh International Airport</li>
                                <li>Siem Reap International Airport</li>
                                <li>Sihanoukville International Airport</li>
                                <li>Cham Yeam (Koh Kong Province) (from Thailand)</li>
                                <li>Poipet (Banteay Meanchey Province) (from Thailand)</li>
                                <li>Bavet (Svay Rieng Province) (from Vietnam)</li>
                                <li>Tropaeng Kreal Border Post (Stung Treng)</li>
                            </ul>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    @include('layouts.middle_footer')
@stop


