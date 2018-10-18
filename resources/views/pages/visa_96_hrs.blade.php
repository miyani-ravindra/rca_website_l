@extends('layouts.layout')
@section('product_bg')

<div class="__bg">
    <!-- banner content -->
    <div class="container container-sm __bg_txt">
        <div class="row">
            <div class="col-md-8 __inner_bg_txt">
                <h1 class="__bg_heading">96 Hours transit visa <span>&#8377; {{ $visa_96_hours }}</span></h1>
                <ul class="__list">
                    <li>All inclusive Price</li>
                    <li>Visa within 2-3 days</li>
                    <li>58 days validity</li>
                </ul>
                <button type="button" class="__btn" data-trigger="cart-modal" data-id="1">BOOK NOW</button>
            </div>
            <div class="col-md-4">
                <div class="_dubai_shape"><img src="{{ URL::to('/') }}/svg/dubai-shape.svg" alt="" class="img-responsive" /></div>
            </div>
        </div>
    </div>
</div>
<!-- Top bg End -->
@stop
@section('content')
<div class="container container-sm">
        <div class="row">
            <div class="col-md-12 __visa_container">
                <div class="col-md-8 padding0">
                    <ul class="tabs">
                        <li class="tab-link current" data-tab="tab-1">ABOUT VISA</li>
                        <li class="tab-link" data-tab="tab-2">DOCUMENTS REQUIRED</li>
                        <li class="tab-link" data-tab="tab-3">VISA PROCESSING TIME</li>
                        <li class="tab-link" data-tab="tab-4">IMPORTANT INFORMATION</li>
                        <li class="tab-link" data-tab="tab-5">FAQ's</li>
                    </ul>
                    <div id="tab-1" class="tab-content current">
                        <p>96 hours Dubai transit visa is a single entry visa used for passenger who would like to transit via Dubai to another country.</p>
                        <p>This visa will allow you to enter through Dubai International Airport and stay for a maximum period of 96 hours in UAE.</p>
                        <p>This type of visa is preferred by travellers visiting UAE for business meetings or catching up with family and friends taking a stopovers en route to their journey.</p>
                        <p><strong>Notes</strong></p>
                        <ul class="__list_numb">
                            <li>We do not provide work/job visas</li>
                            <li>In case of the 96-hours transit UAE Visa its mandatory that the Entry and Exit airport should be Dubai International Airport only</li>
                            <li>96 hours UAE visa are specifically applicable to applicants transiting through Dubai International Airport</li>
                            <li>Applicant should hold a confirm ticket to an onward destination and returning to point of origin</li>
                            <li>Female passenger irrespective of any age should either be accompained by her husband, adult brother, father, adult son or should be visiting an immediate relative.</li>
                        </ul>
                    </div>
                    <div id="tab-2" class="tab-content">
                        <ul class="__list">
                            <li><strong>Passport copy</strong> - Clear scanned colour copy of your passport of both first and last page.</li>
                            <p>The passport must be valid for a minimum of six months from the date of travel.</p>
                            <li><strong>Photograph </strong> - Clear scanned colour copy of your passport size photograph.</li>
                            <li><strong>Address Proof </strong>- Any one clear scanned colour copy of your recent utility bill such as electricity, gas or phone bill.</li>
                            <p>You can submit your rent / lease agreement if you stay in a rented accommodation.</p>
                            <li><strong>Employment Proof </strong>- Any one recent salary slip (change- slips ) or identity card, for business proof you may send us your business details such as visiting card, invitation letter etc.</li>
                            <li>Confirmed return air tickets.</li>
                        </ul>
                    </div>
                    <div id="tab-3" class="tab-content">
                        <p>Visa processing time is approximately 2-3  working days once the payment and all documents are received (except Friday, Saturday and any other UAE Holidays)</p>
                        <p>Visa processing time during peak seasons like Dubai Shopping Festivals (Dec - Jan) may also take longer.</p>
                    </div>
                    <div id="tab-4" class="tab-content">
                        <p>Female passengers irrespective of any age should either be accompanied by her husband, adult brother, father, adult son or should be visiting an immediate relative. In either case, name of the accompanying passenger / relative in UAE is required to be provided in the application indicating the relationship.</p>
                        <p>Ok To Board (OTB) is a mandatory requirement by the airlines flying into Dubai and UAE. The OTB is a process in addition to the Visa application process. There is an additional charge to update the OTB status for some airlines. Airlines like Emirates &amp; Jet Airways require the OTB but do not charge for the same.</p>
                    </div>
                    <div id="tab-5" class="tab-content">
                        <div class="accordion_container">
                            <div class="accordion_head"><span class="plusminus">+</span> What are the different types of UAE Visas that RedCarpet Assist offers?</div>
                            <div class="accordion_body" style="display: none;">
                                <ol>
                                    <li>96 Hours Transit Visa </li>
                                    <li>14 Days Service Visa </li>
                                    <li>30 Days Tourist Visa</li>
                                    <li>90 Days Tourist Visa </li>
                                </ol>
                            </div>
                            <div class="accordion_head"><span class="plusminus">+</span> What are the Visa rates for RedCarpet Assist?</div>
                            <div class="accordion_body">
                                <ol>
                                    <li>96 Hours - INR 3800 per visa</li>
                                    <li>14 Days - 5600 per visa</li>
                                    <li>30 Days - 5600 per visa</li>
                                    <li>90 Days - 18950 per visa</li>
                                </ol>
                            </div>
                            <div class="accordion_head"><span class="plusminus">+</span> Who can apply for a 96 Hours Transit Visa for Dubai?</div>
                            <div class="accordion_body">
                                <ol>
                                    <li>A 96 hour Transit visa is applicable only for passengers transiting Dubai. This means that the passenger cannot be returning to the same country that he or she has arrived from.</li>
                                    <li>For Example: India - Dubai – UK/ Canada/ Australia/ USA (Any 3rd country) or vice versa but not returning to the origin country</li>
                                    <li>The Transit visa is not applicable if passenger has a return ticket of the same country i.e. if the passenger is traveling from India to Dubai and back to India. </li>
                                    <li>This Visa is applicable only if the entry and exit in UAE is through any of the airports in Dubai. Passengers transiting thru Abu Dhabi or Sharjah or traveling to Dubai via road or sea are not eligible for the 96 hour visa.</li>
                                </ol>
                            </div>
                            <div class="accordion_head"><span class="plusminus">+</span> What is the UAE Visa processing time?</div>
                            <div class="accordion_body" style="">
                                <p>Visa processing time is 2 - 3 working days (Excluding Friday, Saturday and any UAE Immigration holidays).</p>
                            </div>
                            <div class="accordion_head"><span class="plusminus">+</span> Will my passport be stamped with the UAE Visa?</div>
                            <div class="accordion_body" style="">
                                <p>The UAE Visa is an E-Visa and is not stamped or pasted on your passport. The traveler is required to carry a color print out of this E-Visa copy while traveling for immigration formalities</p>
                            </div>
                            <div class="accordion_head"><span class="plusminus">+</span> Does RedCarpet Assist provide Multiple Entry Visa?</div>
                            <div class="accordion_body" style="">
                                <p>No, we currently provide only Single Entry Visa.</p>
                            </div>
                            <div class="accordion_head"><span class="plusminus">+</span>Does RedCarpet Assist provide Work/ Employment Visa?</div>
                            <div class="accordion_body" style="">
                                <p>No, we currently only provide Tourist Visa.</p>
                            </div>
                            <div class="accordion_head"><span class="plusminus">+</span> Can I get a Visa On Arrival if I have a USA Visa/ Passport?</div>
                            <div class="accordion_body" style="">
                                <ol>
                                    <li> Visa on arrival is for passengers who have a valid USA Passport or valid USA visa.</li>
                                    <li>The passport and the visa should be valid for 6 months from date of arriving into UAE.</li>
                                    <li>The charges for Visa on arrival have to be paid in Dirhams at the airport.</li>
                                </ol>
                            </div>
                            <!-- FAQS END -->
                        </div>
                    </div>
                </div>
                <!-- Aside section -->
                <aside class="col-md-4">
                    <div class="__card">
                        <div class="__card_body">
                            <div class="__assistance_wrapper">
                                <div class="__assist_icon">
                                    <img src="svg/assistance-icon.svg" alt="" class="img-responsive" />
                                </div>
                                <div class="__assist_body">
                                    <h3>Looking for an <br > Assistance ?</h3>
                                    <button type="button" class="__btn modal-popup" data-click="enquiry-popup">Send Enquiry</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="__card __fast_visa">
                        <div class="__card_body">
                            <div class="__assistance_wrapper">
                                <div class="__assist_body">
                                    <h3>Fastest way to get your Dubai Visa</h3>
                                </div>
                                <div class="__assist_icon">
                                    <img src="svg/fastest-icon.svg" alt="" class="img-responsive" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="__customer_love">
                        <h4>Our customers love us</h4>
                        <p>Take a look at our social media pages to know why our customers love us</p>
                        <a href="#"><img src="images/review_google.png" alt="" width="100"></a>
                        <a href="#"><img src="images/review_facebook.png" alt="" width="100"></a>
                    </div>
                </aside>
                <!-- Aside End -->
                <div class="clearfix"></div>
            </div>
            <div class="col-md-12">
                <h4 class="__heading_h4 paddingtb_50 text-center">Red Carpet Assist Recommends</h4>
                <div class="__recommended">
                    <div class="__recommended__grid">
                        <div class="__prod_details">
                            <h2><a href="{{url('96-hours-transit-dubai-visa')}}">96 Hours <br><span>Dubai Transit Visa</span></a></h2>
                            <h5>&#8377; {{$visa_96_hours}}</h5>
                            <ul class="__list">
                                <li>All inclusive Price</li>
                                <li>Visa within 2-3 days</li>
                                <li>58 days validity</li>
                            </ul>
                            <button type="button" class="__btn" data-trigger="cart-modal" data-id="1">BOOK NOW</button>
                        </div>
                    </div>
                    <div class="__recommended__grid">
                        <div class="__prod_details">
                            <h2><a href="{{url('14-days-dubai-visa')}}">14 Days <br><span>Dubai Tourist Visa</span></a></h2>
                            <h5>&#8377; {{$visa_14_days}}</h5>
                            <ul class="__list">
                                <li>All inclusive Price</li>
                                <li>Visa within 2-3 days</li>
                                <li>58 days validity</li>
                            </ul>
                            <button type="button" class="__btn" data-trigger="cart-modal" data-id="2">BOOK NOW</button>
                        </div>
                    </div>
                    <div class="__recommended__grid">
                        <div class="__prod_details">
                            <h2><a href="{{url('90-days-dubai-visa')}}">90 Days <br><span>Dubai Tourist Visa</span></a></h2>
                            <h5>&#8377; {{$visa_90_days}}</h5>
                            <ul class="__list">
                                <li>All inclusive Price</li>
                                <li>Visa within 2-3 days</li>
                                <li>58 days validity</li>
                            </ul>
                            <button type="button" class="__btn" data-trigger="cart-modal" data-id="3">BOOK NOW</button>
                        </div>
                    </div>
                </div>
                <hr class="fw" />
            </div>
        </div>
    </div>
@stop