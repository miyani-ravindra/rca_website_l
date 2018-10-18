<div class="__main_header">
    <!-- <div class="header_review">
        <a href="https://www.facebook.com/pg/redcarpetassist/reviews/" target="new"><img src="{{ URL::to('/') }}/svg/fb-review.svg" alt="" title="" width="110" /></a>
        <a href="https://search.google.com/local/writereview?placeid=ChIJa8Zsi4fO5zsR0NO-3bWTr-I" target="new"><img src="{{ URL::to('/') }}/svg/G-review.svg" alt="" title="" width="110" /></a>
    </div> -->
    <div class="__logo_box">
	<div class="Hamburger">
	<span></span>
	<span></span>
	<span></span>
	</div>
        <a href="{{ url('/') }}" class="__logo "><img src="{{ URL::to('/') }}/images/logo.svg" alt="redcarpetassist" title="redcarpetassist" width="180" /></a>
    <p class="_improved">is constantly being improved with &nbsp; <i class="fa fa-heart"></i></p>
    </div> 
    
     <div class="__top_right_navbox">
            <div class="__top_right_nav">
                <ul class="__ul">
                    <li class="_call_now"><a class="active" href="Tel:+912262538600"><img src="svg/call_now.svg" alt="" width="15px"> +91 22-62538600</a></li>
                    <!--<li><a href="#">SIGN UP</a></li>
                    <li class="__sd_user">
                        <a><img src="svg/user-icon.svg" alt="" width="15" /> Zubair Shaikh <img src="svg/caret-down.svg" alt="" width="10" /></a>
                        <ul class="__dropdown">
                            <li><a href="sign-up.html">SIGN UP</a></li>
                            <li><a href="my-account.html">ACCOUNT SETTING</a></li>
                            <li><a href="#">LOGOUT</a></li>
                        </ul>
                    </li>-->
                    <li class="__relative" id="trigger_leadForm">
                        <a class="active">NEED HELP &nbsp; <img src="{{URL::to('/')}}/svg/assistant-icon.svg" alt="" width="17" /></a>
                        <div class="__lead_dropdown">
                    <div class="row">
                        <div class="col-md-4 hidden-xs">
                            <div class="_enquiry_icon">
                                <img src="{{ URL::to('/') }}/svg/customer_support.svg" width="120" height="140">
                            </div>
                        </div>
                        <div class="col-md-8 col-xs-12">
                            <div class="_enquiry_box">
                                <h4 class="_title">Talk to Our Visa Consultant</h4>
                                <form action="https://www.redcarpetassist.com/send_leadfrm_ab.php" method="post" name="enq_form" id="enq_form" novalidate="novalidate">
                                    <input type="hidden" name="lead_source" value="direct">
                                    <!--<input type="hidden" name="lead_source" value="direct">-->
                                    <input type="hidden" name="primary_service" value="Visa">
                                    <input type="hidden" name="checkSubmit" id="checkSubmit" value="">
                                    <input type="hidden" name="lead_url_c" value="http://dev.redcarpetassist.com/RCA_2018/">
                                    <input type="hidden" name="utm_source_parameter" value="">
                                    <div class="group _50">
                                        <div class="inputs">
                                            <input type="text" name="first_name" id="f_name_frm" autocomplete="false" required="">
                                            <label>First Name</label>
                                        </div>
                                    </div>
                                    <div class="group _50">
                                        <div class="inputs">
                                            <input type="text" name="last_name" id="l_name_frm" autocomplete="false" required="" aria-required="true">
                                            <label>Last Name</label>
                                        </div>
                                    </div>
                                    <div class="group _50">
                                        <div class="inputs" style="display: inline-block;">
                                            <!--input type="tel" name="phone_number" id="phone_frm" maxlength="10" required="" aria-required="true"-->
                                           <input type="text" name="country_code" id="code_frm" maxlength="7" required="" aria-required="true" value="+" style = "width: 30%; display: inline;">
                                           <input type="tel" name="phone_number" id="phone_frm" maxlength="10" required="" aria-required="true" style="width: 65%; display: inline;">
                                            <label>Phone Number</label>
                                        </div>
                                    </div>
                                    <div class="group _50">
                                        <div class="inputs">
                                            <input type="email" name="email" id="email_frm" autocomplete="false" required="" aria-required="true">
                                            <label>Email ID</label>
                                        </div>
                                    </div>
                                    <div class="radio_wrapper">
                                        <div class="group-radio-box">
                                            <div class="group-radio">
                                                <input id="v1" name="service_type" type="checkbox" class="orbit" value="E-Visa">
                                                <label for="v1">E-Visa</label>
                                            </div>
                                        </div>
                                        <div class="group-radio-box">
                                            <div class="group-radio">
                                                <input id="v2" name="service_type" type="checkbox" class="orbit" value="Airport Meet &amp; Assist Service">
                                                <label for="v2">Meet &amp; Assist</label>
                                            </div>
                                        </div>
                                        <div class="group-radio-box">
                                            <div class="group-radio">
                                                <input id="v3" name="service_type" type="checkbox" class="orbit" value="Lounges">
                                                <label for="v3">Lounges</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="__btn __btn_submit">SUBMIT</button>
                                    </div>
                                    <div class="col-md-12">
                                        <p class="__terms_txt">By clicking here you authorise us to contact you. T&amp;C Apply.
                                            <br>
                                        </p>
                                    </div>
                                </form>
                                <!-- Enquiry box End -->
                                <div class="__enq_thanks" id="enq_thanks">
                                    <div class="__enq_thanks_body">
                                        
                                        <h3 class="_thnk_h3">Thanks</h3>
                                        <p>All good things come to those who wait :)
                                            <br> We will contact you shortly</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    </li>
                </ul>
            </div>
        </div>
    
    <!-- Happy Customer -->
    <!-- <div class="_happy_counter">
        <p>Happy Customers</p>
        <div class="count_box" id="happy_customer">
            <span class="count">1</span>
            <span class="count">2</span>
            <span class="count">8</span>
            <span class="count">1</span>
            <span class="count">2</span>
            <span class="count">6</span>
        </div>
    </div> -->

 
</div>


