@extends('layouts.layout')
@section('product_bg')
<!--div class="__OTP_bg">
    <!-- banner content -->
    <!--div class="container container-sm __bg_txt">
        <div class="row">
            <div class="col-md-12">
                <h4 class="__heading_h4 paddingtb_50 text-center lg">About Us</h4>
            </div>
        </div>
    </div>
</div-->
<div class="clearfix"></div>
    <div class="__OTP_bg" style="height: auto;">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="__heading_h4 paddingtb_50 text-center lg">About Us</h1>
                </div>
            </div>
        </div>
    </div>
<!-- Top bg End -->
@stop

@section('content')
<div class="__why_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-md-offset-2">
                    <img src="{{ URL::to('/') }}/svg/our_values.svg" alt="" width="150" class="__why_img" />
                </div>
                <div class="col-md-7">
                    <div class="__why_choose">
                        <h2>Our Values</h2>
                        <p>To bring together a group of people who demonstrate high level of integrity and respect. To create an open and welcoming environment so people with different thoughts, interests, strengths and cultural backgrounds can come together and create a model organisation. To deliver our very best and be accountable.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- approach -->
    <div class="__why_bg __redbg">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-md-offset-1">
                    <div class="__why_choose">
                        <h2>Our Approach - Disruption</h2>
                        <p>Disruption is the way we approach our business; internally and externally. We approach this disruption through technology, process and people. We disrupt the way the product or service is bought or consumed.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="{{ URL::to('/') }}/svg/approach.svg" alt="" width="150" class="__why_img" />
                </div>
            </div>
        </div>
    </div>

    <!-- Our Culture -->
    <div class="__why_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-md-offset-2">
                    <img src="{{ URL::to('/') }}/svg/culture.svg" alt="" width="150" class="__why_img" />
                </div>
                <div class="col-md-7">
                    <div class="__why_choose">
                        <h2>Our Culture</h2>
                        <p>We want to create value. Value that is not defined by products and services but by promises we make and the experiences we deliver. We will continuously challenge status quo and seek alternative solutions, and leading to value creations for our clients and customers.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Team -->
    <div class="__why_bg __redbg">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-md-offset-1">
                    <div class="__why_choose">
                        <h2>Our Team</h2>
                        <p>A team of 53 people based across India and UAE together delivers passion though our products and services.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="{{ URL::to('/') }}/svg/our_team.svg" alt="" width="120" class="__why_img" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 paddingtb_30 flexslider">
                    <ul class="_aboutus slides">
                        <li>
                            <img src="svg/parveen.svg" alt="" width="70" />
                            <span class="_aboutxt medium">
                                <h4>Parveen Jiterwal</h4>
                                <p>Founder &amp; Chairman</p>
                                <a href="https://www.linkedin.com/in/parveenjiterwal/" target="_blank" class="__in"><img src="{{ URL::to('/') }}/svg/linkedin.svg" alt="" width="30" /></a>
                            </span>
                        </li>
                        <li>
                            <img src="{{ URL::to('/') }}/svg/radhika.svg" alt="" width="70" />
                            <span class="_aboutxt medium">
                                <h4>Radhika Butala</h4>
                                <p>Chief Executive Officer</p>
                                <a href="https://www.linkedin.com/in/radhikabutala/" target="_blank" class="__in"><img src="svg/linkedin.svg" alt="" width="30" /></a>
                            </span>
                        </li>
                        <li>
                            <img src="{{ URL::to('/') }}/svg/ram.svg" alt="" width="70" />
                            <span class="_aboutxt medium">
                                <h4>Ram Mohan KM</h4>
                                <p>Chief Technology Officer</p>
                                <a href="https://www.linkedin.com/in/kmram/" target="_blank" class="__in"><img src="svg/linkedin.svg" alt="" width="30" /></a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Culture -->
    <div class="__why_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-md-offset-2">
                    <img src="{{ URL::to('/') }}/svg/success_strory.svg" alt="" width="120" class="__why_img" />
                </div>
                <div class="col-md-7">
                    <div class="__why_choose">
                        <h2>Our Success Story</h2>
                        <p>Successfully processed UAE Visa and Dubai Airport Services - Meet &amp; Assist, Lounges, Spa and Dubai International Hotels, since Nov 2016. Serviced over 125K customers.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- approach -->
    <div class="__why_bg __redbg">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-md-offset-1">
                    <div class="__why_choose">
                        <h2>Our Location</h2>
                        <p>Office no. 101 & 102, Sea View, Next to Hinduja House, off Dr. Annie Besant Road, Worli, Mumbai, Maharashtra - 400018</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <img src="{{ URL::to('/') }}/svg/map_icon.svg" alt="" width="130" class="__why_img" />
                </div>
            </div>
        </div>
    </div>
<!--div class="container container-sm">
    <div class="row">
        <div class="col-md-12 col-xs-12 __faq_wrapper">
                <p>Travelling is one of the great pleasures of life. Few can resist the lure of new adventures and meeting interesting people. Getting from where you are to where you would like to go isn’t usually considered part of this experience. But at RedCarpet Assist we endeavour to make the act of travelling to your destination a memory that you’ll carry with you.</p>
                <h4>Why we are?</h4>
                <p>RedCarpet Assist was started with a simple objective of simplifying travel which culminated in providing E-Visas and Airport assistance services.</p>
                <h4>What we do?</h4>
                <p>Right from E-Visas to Airport Assistance Services like Meet & Greet and Airport lounges, RedCarpet Assist provides top-class hospitality for travellers around the world. With a clear focus on providing world class services, the team at RedCarpet Assist chooses its partners through a rigorous check on quality of service, hereby ensuring our customers have the best experiences. </p>
                <h4>Where we are?</h4>
                <p>RedCarpet Assist thrives to serve wherever our customer is. Even with our operations presence based out of Mumbai, India, we manage to serve customers around the world bringing a bouquet of services that is needed for better travel experiences.</p>
                <h4>How we do it?</h4>
                <p>The team at RedCarpet Assist has been built with a clear focus & commitment on providing world class service to travellers. Every team member has been part of the travel & tourism industry since years and thrive harder each day to ensure super-service to our customers.</p>
            <ul class="__team paddingtb_50">
                    <li>
                        <img src="{{ URL::to('/') }}/images/parveen_Jiterwal.png" alt="" width="80" height="80" />
                        <em>Parveen Jiterwal</em>
                        <b>Founder & CEO</b>
                    </li>
                    <li>
                        <img src="{{ URL::to('/') }}/images/parveen_Jiterwal.png" alt="" width="80" height="80" />
                        <em>Radhika Butala</em>
                        <b>Partner & Director</b>
                    </li>
                    <li>
                        <img src="{{ URL::to('/') }}/images/parveen_Jiterwal.png" alt="" width="80" height="80" />
                        <em>Ram Mohan K M</em>
                        <b>Head – Technology & <br> Innovation</b>
                    </li>
                    <li>
                        <img src="{{ URL::to('/') }}/images/parveen_Jiterwal.png" alt="" width="80" height="80" />
                        <em>Kirti Gawas</em>
                        <b>Head of Operations</b>
                    </li>
                    <li>
                        <img src="{{ URL::to('/') }}/images/parveen_Jiterwal.png" alt="" width="80" height="80" />
                        <em>Kavita D’silva</em>
                        <b>Head – Business Development</b>
                    </li>
                    <li>
                        <img src="{{ URL::to('/') }}/{{ URL::to('/') }}/images/parveen_Jiterwal.png" alt="" width="80" height="80" />
                        <em>Hardika Parekh</em>
                        <b>Sr. Manager – Global Sales</b>
                    </li>
                    <li>
                        <img src="{{ URL::to('/') }}/images/parveen_Jiterwal.png" alt="" width="80" height="80" />
                        <em>Ramesh Thapa</em>
                        <b>Business Head – Middle East</b>
                    </li>
                </ul>
                <hr class="fw" />
            </div>
    </div>
</div-->
@stop