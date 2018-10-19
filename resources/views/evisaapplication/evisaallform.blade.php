@extends('layouts.layout')
@section('content')
<div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <ul class="tabs_z">
                            <li class="__current">
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">eVisa</span>
                                    <img src="{{ URL::to('/') }}/svg/E-visa.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_mna"> <!-- RCAV1-60 -->
                                <a href="meet-and-assist.html">
                                    <span class="__title">AIRPORT MEET &amp; GREET</span>
                                    <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="lounge.html">
                                    <span class="__title">AIRPORT LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current __width100">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading">eVisa</h1>
                                    <div class="__progress_wrapper">
                                        <ul class="__progress">
                                            <li class="active _100">Form Filling</li>
                                            <li class="">Verification</li>
                                            <li class="">Payment</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="__stylish_head">We are ready to fill the form.</h4>
                                    </div>
                                </div>
				<div id ="displaydata"></div>
                                <div class="row">
                                    <div class="__fm_box">
                                        <!-- <div class="col-md-12">
                                            <p class="__form_notes">Actually! We got you covered, we filled your information by OCR. Please check the details and confirm.</p>
                                        </div> -->
                                        <div class="col-md-12">
                                            <!--<div class="typeform-widget" data-url="https://redcarpetassist.typeform.com/to/aZCMz6" data-hide-headers=true data-hide-footer=true style="width: 100%; height: 700px;"></div> <script> (function() { var qs,js,q,s,d=document, gi=d.getElementById, ce=d.createElement, gt=d.getElementsByTagName, id="typef_orm", b="https://embed.typeform.com/"; if(!gi.call(d,id)) { js=ce.call(d,"script"); js.id=id; js.src=b+"embed.js"; q=gt.call(d,"script")[0]; q.parentNode.insertBefore(js,q) } })() </script> <div style="font-family: Sans-Serif;font-size: 12px;color: #999;opacity: 0.5; padding-top: 5px;"> <a href="https://admin.typeform.com/signup?utm_campaign=aZCMz6&utm_source=typeform.com-12293860-Pro&utm_medium=typeform&utm_content=typeform-embedded-poweredbytypeform&utm_term=EN" style="color: #999" target="_blank"></a> </div>-->
											<div class="" id="typeformframe" style="width: 100%; height: 700px;"></div>
                                            <script type="text/javascript">
                                                typeformframe("{{$typeformurl}}");
                                                function typeformframe(url){
                                                    var typeformid = "{{$formid}}";
                                                    var saveurl = "";
                                                    
                                                    window.addEventListener("DOMContentLoaded", function() {
                                                        var el = document.getElementById("typeformframe");

                                                    // if(typeformid == "HcDNUu"){
                                                    //     saveurl = "/rca_website_l/public/typeformwebhookapi";
                                                    // }else if(typeformid == "bZYeH3"){
                                                    //     saveurl = "/rca_website_l/public/typeformwebhookapi";
                                                    // }    
                                                                                                      
                                                    // When instantiating a widget embed, you must provide the DOM element
                                                    // that will contain your typeform, the URL of your typeform, and your
                                                    // desired embed settings
                                                    window.typeformEmbed.makeWidget(el, url, {
                                                        hideFooter: true,
                                                        hideHeaders: true,
                                                        opacity: 75,
                                                        onSubmit: function () {
                                                            
                                                        }
                                                        });
                                                    });
                                                }
                                                </script>
										</div>
                                    </div>
                                    <!-- <div class="col-md-12 text-center paddingtb_20">
                                        <button type="submit" class="__btn __btn_next" id="frm_next" disabled="true">NEXT STEP</button>
                                    </div> -->
                                    </form>
                                </div>
                                <!-- row end -->
                            </div>
                            <!-- Form wrapper -->
                        </div>
                        <!-- Tab Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.middle_footer')     
@stop
