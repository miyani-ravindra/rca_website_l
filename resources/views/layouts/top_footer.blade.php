<!-- RCA Footer -->
     <footer class="__footer">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-md-offset-1 __footer_box">
                    <div class="col-md-3 HideInMobile">
                        <ul class="__ft_nav">
                            <!--<li><a href="#">eVisa</a></li>
                            <li><a href="#">Airport Meet &amp; Greet</a></li>
                            <li><a href="#">Airport Lounges</a></li>-->
                            <li><a href="{{ url('about') }}" target="_blank">About Us</a></li>
                            <li><a href="{{ url('testimonial') }}" target="_blank">Testimonials</a></li>
                            <li><a href="{{ url('faq') }}" target="_blank">FAQs</a></li>
                           
                        </ul>
                    </div>
                    <div class="col-md-3 HideInMobile">
                        <ul class="__ft_nav">
                            <li><a href="#" target="_blank">Sitemap</a></li>
                            <li><a href="{{ url('terms-and-conditions') }}" target="_blank">Terms and Conditions</a></li>
                            <li><a href="{{ url('privacy-policy') }}" target="_blank">Privacy Policy</a></li>
                            <li><a href="{{ url('contact') }}" target="_blank">Contact Us</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2 HideInMobile">
                        <ul class="__ft_nav">
                            <li><a href="https://www.facebook.com/redcarpetassist/" target="_blank">Facebook</a></li>
                            <li><a href="https://twitter.com/redcarpetassist?lang=en" target="_blank">Twitter</a></li>
                            <li><a href="https://in.linkedin.com/company/redcarpet-assist" target="_blank">Linkedin</a></li>
                            <li><a href="https://www.instagram.com/redcarpetassist/" target="_blank">Instagram</a></li>
                            <li><a href="https://www.youtube.com/channel/UCqfhRQYW5FiUXXGx7WqlZKw" target="_blank">Youtube</a></li>
                            <li><a href="http://blog.redcarpetassist.com/" target="_blank">Blog</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 ">
                        <div class="_contact_info">
                            <div class="_contact_svg HideInMobile">
                                <img src="{{URL::to('/')}}/svg/call_now.svg" alt="" width="30px" />
                            </div>
                            <div class="_contact_dt">
							<span class="HideInMobile">
                                <h5>Call Now</h5>
                                <h5 class="bold">+91 2262538600</h5>
							</span>		
                                <p>Mon - Sat 10:00 AM to 08:00 PM
                                    <br> <a href="mailto:customercare@redcarpetassist.com">customercare@redcarpetassist.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div class="row HideInMobile">
                <div class="col-md-offset-1 col-md-10 col-md-offset-1">
                    <img src="{{URL::to('/')}}/images/footer_svg.png" alt="" class="center-block img-responsive" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-md-offset-1 paddingtb_20">
                    <div class="col-md-6">
                        <p class="__copyright">Copyrights 2018 © RedCarpet Assist. All rights reserved.</p>
                    </div>
                    <div class="col-md-6">
                        <ul class="_social">
                            <li><a href="https://www.facebook.com/redcarpetassist/" target="_blank"><img src="{{URL::to('/')}}/svg/facebook.svg" alt="" width="25" /></a></li>
                            <li><a href="https://in.linkedin.com/company/redcarpet-assist" target="_blank"><img src="{{URL::to('/')}}/svg/linkedin.svg" alt="" width="25" /></a></li>
                            <li><a href="https://twitter.com/redcarpetassist?lang=en" target="_blank"><img src="{{URL::to('/')}}/svg/twitter.svg" alt="" width="25" /></a></li>
                            <li><a href="https://www.instagram.com/redcarpetassist/" target="_blank"><img src="{{URL::to('/')}}/svg/instagram.svg" alt="" width="25" /></a></li>
                            <li><a href="https://www.youtube.com/channel/UCqfhRQYW5FiUXXGx7WqlZKw" target="_blank"><img src="{{URL::to('/')}}/svg/youtube.svg" alt="" width="25" /></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
	<!-- Footer end -->
    <div class="__notification" style="display: none">
        <p>We found that you have an incomplete form <a href="javascript:void(0);" id="com_form" class="get">Get Started</a> <span class="__close" onclick="$('.__notification').css('display','none');">&times;</span></p>
    </div>