<!-- Header with Nav -->
<header class="__sd_header" style="{{(Request::url() === 'http://dev.redcarpetassist.com/rca_website_l/public/booking/b2b-india-evisa-application')?'display:none':'display:block'}}">
    <nav class="__sd_nav">
        <ul class="__ul">
            <li><a href="{{ url('/') }}" {{{ (Request::is('/') ? 'class=active' : '') }}}>Home</a></li>
            <li><a href="{{ url('about') }}" {{{ (Request::is('about') ? 'class=active' : '') }}}>About Us</a></li>
            <li class="__sd_user"><a>Our Products</a>
                <ul class="__dropdown">
                    <li class="__subdrop"><a href="evisa.html">eVisa</a>
                        <ul class="__sub_dropdown">
                            <li><a href="{{ url('evisa/india') }}" {{{ (Request::is('/evisa/india') ? 'class=active' : '') }}}>eVisa India</a></li>
                            <li><a href="{{ url('evisa/srilanka') }}" {{{ (Request::is('/evisa/srilanka') ? 'class=active' : '') }}}">eVisa Srilanka</a></li>
                            <li><a href="{{ url('evisa/hongkong') }}" {{{ (Request::is('/evisa/hongkong') ? 'class=active' : '') }}}">eVisa HongKong</a></li>
                            <li><a href="{{ url('evisa/turkey') }}" {{{ (Request::is('/evisa/turkey') ? 'class=active' : '') }}}">eVisa Turkey</a></li>
                            <li><a href="{{ url('evisa/combodia') }}" {{{ (Request::is('/evisa/combodia') ? 'class=active' : '') }}}">eVisa Cambodia</a></li>
                            <li><a href="{{ url('evisa/vietnam') }}" {{{ (Request::is('/evisa/vietnam') ? 'class=active' : '') }}}">eVisa Vietnam</a></li>
                        </ul>
                    </li>
                    <!--<li class="__subdrop"><a>Airport Meet &amp; Greet</a>
                        <ul class="__sub_dropdown">
                            <li><a href="#">Lorem ipsum</a></li>
                            <li><a href="#">Lorem ipsum</a></li>
                            <li><a href="#">Lorem ipsum</a></li>
                        </ul>
                    </li>
                    <li class="__subdrop"><a>Airport Lounges</a>
                        <ul class="__sub_dropdown">
                            <li><a href="#">Lorem ipsum</a></li>
                            <li><a href="#">Lorem ipsum</a></li>
                            <li><a href="#">Lorem ipsum</a></li>
                        </ul>
                    </li>-->
                </ul>
            </li>
            <!--<li><a href="{{ url('meet-and-assist') }}" {{{ (Request::is('meet-and-assist') ? 'class=active' : '') }}}>Meet &amp; Assist</a></li>
            <li><a href="{{ url('lounge') }}" {{{ (Request::is('lounge') ? 'class=active' : '') }}}>Lounge</a></li>-->
            <li><a href="{{ url('testimonial') }}" {{{ (Request::is('testimonial') ? 'class=active' : '') }}}>Testimonials</a></li>
            <li><a href="{{ url('faq') }}" {{{ (Request::is('faq') ? 'class=active' : '') }}}>FAQs</a></li>
            <li><a target="_blank" href="http://blog.redcarpetassist.com/">Blog</a></li>
			<li class="ShowInMobile">
	                <a  target="_blank"  href="{{ url('sitemap.xml') }}" {{{ (Request::is('sitemap') ? 'class=active' : '') }}}>Sitemap</a>
	            </li>
	            <li class="ShowInMobile">
 	                <a  target="_blank"  href="{{ url('terms-and-conditions') }}" {{{ (Request::is('terms-and-conditions') ? 'class=active' : '') }}}>Terms and Conditions</a>
 	            </li>
	            <li class="ShowInMobile">
	                <a  target="_blank"  href="{{ url('privacy-policy') }}" {{{ (Request::is('privacy-policy') ? 'class=active' : '') }}}>Privacy Policy</a>
	            </li>
            <li><a href="{{ url('contact') }}" {{{ (Request::is('contact') ? 'class=active' : '') }}}>Contact Us</a></li>
            <!--<li class="__sd_user _push_right">
                <a><img src="{{ URL::to('/') }}/svg/user-icon.svg" alt="" width="15" /> Zubair Shaikh <img src="{{ URL::to('/') }}/svg/caret-down.svg" alt="" width="10" /></a>
                <ul class="__dropdown">
                    <li><a href="sign-up.html">SIGN UP</a></li>
                    <li><a href="my-account.html">ACCOUNT SETTING</a></li>
                    <li><a href="#">LOGOUT</a></li>
                </ul>
            </li>
            <li class="_push_right"><a href="login.html">Login</a></li>-->
            <!-- @if(Session::has('email_id'))
                <li class="__sd_user _push_right">
                <a href="#"><img src="{{ url('/') }}/svg/user-icon.svg" alt="" width="15" /> {{Session::get('username')}} <img src="{{ url('/') }}/svg/caret-down.svg" alt="" width="10" /></a>
                <ul class="__dropdown">
                    <li><a href="#">ACCOUNT SETTING</a></li>
                    <li><a href="{{URL::to('/')}}/logout">LOGOUT</a></li>
                </ul>
                </li>
            @else
                <li class="_push_right"><a href="{{URL::to('/')}}/login">Login</a></li>  
            @endif -->
        </ul>
    </nav>
	<div class="CloseNav"></div>
</header>
<!-- header end -->
<div class="clearfix"></div>