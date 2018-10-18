@extends('layouts.layout')
@section('product_bg')
<div class="__bg">
    <!-- banner content -->
    <div class="container container-sm __lounge_box">
        <div class="row">
            <div class="col-md-8">
                <h1 class="__bg_heading">Why Opt for Lounge Services at DXB?</h1>
                <p>Leave your jet lag behind with Dubai Airport's First and Business Class lounges. Our lounges at Dubai International Airport offer a range of personalised luxury services help you relax and rejuvenate at the airport.
                </p>
            </div>
            <div class="col-md-4">
                <div class="_dubai_shape"><img src="svg/dubai-shape.svg" alt="" class="img-responsive" /></div>
            </div>
        </div>
    </div>
</div>
<!-- Top bg End -->
@stop

@section('content')
<div class="container container-sm">
    <div class="row">
        <div class="col-md-8">
            <div class="__lounge_service">
                <h2>Dubai Airport First Class Lounge - <span class="_price">₹&nbsp;2,970.00*</span></h2>
                <p>A unique lounge experience awaits you from the moment you walk into the Dubai Airport's First Class Lounge.</p>
                <div class="col-md-5 padding0">
                    <img src="images/first-class-lounge.jpg" alt="" class="img-responsive" />
                </div>
                <div class="col-md-7">
                    <ul class="__list">
                        <li>Personalized meet and greet service</li>
                        <li>Concierge assistance services on departure</li>
                        <li>International Magazines & Newspapers</li>
                        <li>Live food counter, buffet and a la carte mennu</li>
                        <li>Alcoholic & non-alcoholic drinks at the bar</li>
                        <li>High speed WIFI connectivity</li>
                        <li>Timeless Spa (optional)</li>
                        <li>Shower rooms with amenities</li>
                        <li>Prayer Room</li>
                        <li>Fully equipped Business Centre</li>
                        <li>Smoking rooms</li>
                        <li>Kiddies corner</li>
                        <li>Specially designed kiddies menu for the junior foodies</li>
                    </ul>
                </div>
                <ul class="__facility">
                    <li><img src="svg/wifi.svg" alt=""> Wifi</li>
                    <li><img src="svg/recliner.svg" alt=""> Recliner</li>
                    <li><img src="svg/live-food.svg" alt=""> Live Food</li>
                    <li><img src="svg/drinks.svg" alt=""> Drinks</li>
                    <li><img src="svg/smoking.svg" alt=""> Smoking</li>
                    <li><img src="svg/prayer.svg" alt=""> Prayer Room</li>
                    <li><img src="svg/business-center.svg" alt=""> Business Center</li>
                    <li><img src="svg/peaceful.svg" alt=""> Peaceful & Luxurious</li>
                </ul>
            </div>
            <!-- Business Class Lounge -->
            <div class="__lounge_service">
                <h2>Dubai Airport Business Class Lounge - <span class="_price">₹&nbsp;3,600.00*</span></h2>
                <p>At the Ahlan Business Class Lounge, we try to make your journey as smooth and comfortable as possible.</p>
                <div class="col-md-7">
                    <ul class="__list">
                        <li>Personalized meet and greet experience at the lounge</li>
                        <li>International Magazines & Newspapers</li>
                        <li>Live food counter, buffet and a la carte mennu</li>
                        <li>Alcoholic & non-alcoholic drinks at the bar</li>
                        <li>High speed WIFI connectivity</li>
                        <li>Timeless Spa (optional)</li>
                        <li>Shower rooms with amenities</li>
                        <li>Prayer Room</li>
                        <li>Fully equipped Business Centre</li>
                        <li>Smoking rooms</li>
                        <li>Kiddies corner</li>
                        <li>Specially designed kiddies menu for the junior foodies</li>
                    </ul>
                </div>
                <div class="col-md-5 padding0">
                    <img src="images/business-class-lounge.jpg" alt="" class="img-responsive" />
                </div>
                <ul class="__facility">
                    <li><img src="svg/wifi.svg" alt=""> Wifi</li>
                    <li><img src="svg/recliner.svg" alt=""> Recliner</li>
                    <li><img src="svg/live-food.svg" alt=""> Live Food</li>
                    <li><img src="svg/drinks.svg" alt=""> Drinks</li>
                    <li><img src="svg/smoking.svg" alt=""> Smoking</li>
                    <li><img src="svg/prayer.svg" alt=""> Prayer Room</li>
                    <li><img src="svg/business-center.svg" alt=""> Business Center</li>
                </ul>
            </div>
        </div>
        <!-- Aside section -->
        <aside class="col-md-4 __lounge_formbox">
            <div class="__card">
                <div class="__card_body">
                    <div class="__lounge_form">
                        <p class="__alert_success" id="lounge_alert">Your enquiry has been submitted.</p>
                        <legend>Send a Booking Request For Lounge</legend>
                        <form name="lounge_enquiry" id="lounge_enquiry">
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="lounge_name" id="lounge_name" required>
                                    <label>Your Name</label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="lounge_phone" id="lounge_phone" required>
                                    <label>Your Phone Number</label>
                                </div>
                            </div>
                            <div class="group">
                                <div class="inputs">
                                    <input type="text" name="lounge_email" id="lounge_email" required>
                                    <label>Your Email ID</label>
                                </div>
                            </div>
                            <p>Select Lounge Type</p>
                            <div class="__lounge_group" style="position: relative;">
                                <div class="group-radio">
                                    <input id="business_class" name="lounge_service" type="radio" class="orbit" value="Business Class Lounge">
                                    <label for="business_class">Business Class Lounge</label>
                                </div>
                                <div class="group-radio" id="lounge_error">
                                    <input id="first_class" name="lounge_service" type="radio" class="orbit" value="First Class Lounge">
                                    <label for="first_class">First Class Lounge</label>
                                </div>
                            </div>
                            <p>Choose From Our range of Services (Optional)</p>
                            <div class="__lounge_group">
                                <div class="group-radio-box">
                                    <div class="group-radio">
                                        <input id="lounge_dubai_visa" name="lounge_other_service" type="checkbox" class="orbit" value="Dubai Visa">
                                        <label for="lounge_dubai_visa">Dubai Visa</label>
                                    </div>
                                </div>
                                <div class="group-radio-box">
                                    <div class="group-radio">
                                        <input id="lounge_mna" name="lounge_other_service" type="checkbox" class="orbit" value="Airport Meet &amp; Assist Service">
                                        <label for="lounge_mna">Meet &amp; Assist</label>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div style="margin-top: 10px; text-align: center;">
                                <button type="submit" class="__btn __btn_submit __btn_lg" id="lounge_enq_btn">SUBIMT NOW</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="__card">
                <div class="__card_body">
                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/b7xItBxb9es?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen=""></iframe>
                </div>
            </div>
        </aside>
        <!-- Aside End -->
        <div class="col-md-12">
            <hr class="fw" />
        </div>
    </div>
</div>
@stop