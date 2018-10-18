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
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">AIRPORT MEET &amp; GREET</span>
                                    <img src="{{ URL::to('/') }}/svg/MNA.svg" alt="" width="100" />
                                </a>
                            </li>
                            <li id="group_size_max_lounge"> <!-- RCAV1-60 -->
                                <a href="{{URL::to('/')}}">
                                    <span class="__title">AIRPORT LOUNGE</span>
                                    <img src="{{ URL::to('/') }}/svg/LOUNGE.svg" alt="" width="100" />
                                </a>
                            </li>
                        </ul>
                        <div id="tab-1" class="tabs_z_content __current">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1 class="__main_heading">eVisa</h1>
                                </div>
                            </div>
                            <div class="__form_wrapper">
                                <form method="post" id="typefrm" name="typefrm" action="{{URL::to('/')}}/evisa/verifymail">
                                        <input type="hidden" name="order_id" id="order_id" value="{{$postData['order_id']}}">
                                        <input type="hidden" name="applicant_id" id="applicant_id" value="{{$postData['applicant_id']}}">
                                        <input type="hidden" name="uid" id="uid" value="{{$postData['uid']}}">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                        <input type="hidden" name="order_code" id="order_code" value="{{$postData['order_code']}}">
                                        <input type="hidden" name="ccode" id="ccode" value="{{$ccode}}">
                                        <input type="hidden" name="nationality" id="nationality" value="{{$getservice->nationality}}">
                                        <input type="hidden" name="visa_service" id="visa_service" value="{{$getservice->product_name}}">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="text-center"><strong>Thank You for submitting the application form</strong></p>
                                            <p class="text-center"><strong>Please Click Proceed to verify you email</strong></p>
                                            <div class="col-md-12 text-center paddingtb_20">
                                                <button type="submit" class="__btn __btn_next" id="frm_next">PROCEED</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div><!-- Tab Content End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="loading" id="overlay_load" style="display: none;">Loading&#8230;</div>    
<script type="text/javascript">
var orderid = "{{$postData['order_id']}}";
var applicantid = "{{$postData['applicant_id']}}";

if(orderid != '' && applicantid != ''){
    if (performance.navigation.type == 1) {
        console.info( "This page is reloaded" );
        onSubmit();
    }
    //$('overlay_load').hide();
}else{
   //$('overlay_load').show(); 
   window.setInterval('refresh()', 10000); 
}     
//check for Navigation Timing API support
// if (window.performance) {
//   console.info("window.performance works fine on this browser");
// }
// if (performance.navigation.type == 1) {
//     console.info( "This page is reloaded" );
//     onSubmit();
// } else {
//     console.info( "This page is not reloaded");
//     refresh();
// } 

function onSubmit(){
    document.typefrm.submit();
}
function refresh(){
window.location.reload();
}
</script>    
@include('layouts.middle_footer')     
@stop