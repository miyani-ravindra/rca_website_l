@extends('layouts.layout')
@section('content')
<!-- header end -->
<div class="clearfix"></div>
<div class="__bg">
   <div class="container container-sm">
      <div class="row">
         <div class="col-md-12">
            <div class="paddingtb_50">
               <form method="post" action="{{URL::to('/')}}/evisa/to/{{$ccode}}" id="frmevisastep2" name="frmevisastep2" enctype='multipart/form-data'>
                  <input type="hidden" name="residing_in" id="residing_in" value="{{(isset($getpostdata['residing_in']) && !empty($getpostdata['residing_in']))?$getpostdata['residing_in']:NULL}}">
                  <input type="hidden" name="residing_code" id="residing_code" value="{{(isset($getpostdata['residing_code']) && !empty($getpostdata['residing_code']))?$getpostdata['residing_code']:NULL}}">
                  <input type="hidden" name="order_id" id="order_id" value="{{(isset($getpostdata['order_id']) && !empty($getpostdata['order_id']))?$getpostdata['order_id']:NULL}}">
                  <input type="hidden" name="order_code" id="order_code" value="{{(isset($getpostdata['order_code']) && !empty($getpostdata['order_code']))?$getpostdata['order_code']:NULL}}">
                  <input type="hidden" name="uid" id="uid" value="{{(isset($getpostdata['user_id']) && !empty($getpostdata['user_id']))?$getpostdata['user_id']:NULL}}">
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <ul class="tabs_z">
                     <li class="__current">
                        <span class="__title">eVisa</span>
                        <img src="{{URL::to('/')}}/svg/E-visa.svg" alt="" width="100" />
                     </li>
                     <li>
                        <a href="{{URL::to('/')}}">
                        <span class="__title">AIRPORT MEET &amp; GREET</span>
                        <img src="{{URL::to('/')}}/svg/MNA.svg" alt="" width="100" />
                        </a>
                     </li>
                     <li>
                        <a href="{{URL::to('/')}}">
                        <span class="__title">AIRPORT LOUNGE</span>
                        <img src="{{URL::to('/')}}/svg/LOUNGE.svg" alt="" width="100" />
                        </a>
                     </li>
                  </ul>
                  <div id="tab-1" class="tabs_z_content __current">
                     <div class="row">
                        <div class="col-md-12">
                           <h1 class="__main_heading">eVisa</h1>
                           <div class="__progress_wrapper">
                              <ul class="__progress">
                                 <li class="active _50">Basic Info + Document Upload</li>
                                 <li class="">Form Filling</li>
                                 <li class="">Verification</li>
                                 <li class="">Payment</li>
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class="__form_wrapper">
                        <div class="row">
                           <div class="col-md-12">
                              <h4 class="__stylish_head">Let’s Start!</h4>
                           </div>
                           <div class="col-md-12">
                              <div class="upform">
                                 <div class="upform-main">
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             I am Traveling to
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Where you want to travel?</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="travel_to" id="travel_to" value="{{(isset($getpostdata['travel_to']) && !empty($getpostdata['travel_to']))?$getpostdata['travel_to']:NULL}}" readonly="">
                                          <div class="press_enter">PRESS ENTER</div>
                                       </div>
                                    </div>
                                    <div class="input-block">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             I am Citizen of
                                             <span class="strike">*</span>
                                             <div class="qs_sub">You are Citizen of?</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="citizen_to" id="citizen_to" value="{{(isset($getpostdata['nationality']) && !empty($getpostdata['nationality']))?$getpostdata['nationality']:NULL}}" readonly="">
                                          <div class="press_enter">PRESS ENTER</div>
                                       </div>
                                    </div>
                                    <div class="input-block active">
                                       <div class="labels">
                                          <div class="qs_list"></div>
                                          <div class="qs_body">
                                             Enter Full Name
                                             <span class="strike">*</span>
                                             <div class="qs_sub">Your Name?</div>
                                          </div>
                                       </div>
                                       <div class="input-control">
                                          <input type="text" name="user_name" id="user_name" value="{{(isset($getpostdata['username']) && !empty($getpostdata['username']))?$getpostdata['username']:NULL}}" placeholder="" required="">
                                          <div class="press_enter">PRESS ENTER</div>
                                       </div>
                                    </div>
                                    <div class="input-block">
                                         <div class="labels">
                                             <div class="qs_list block-counter"></div>
                                             <div class="qs_body">Email Address <span class="strike">*</span>
                                             </div>
                                         </div>
                                         <div class="input-control">
                                             <input type="email" name="email_id" id="email_id" value="{{(isset($getpostdata['email_id']) && !empty($getpostdata['email_id']))?$getpostdata['email_id']:NULL}}" required="">
                                             <div class="press_enter">PRESS TAB</div>
                                         </div>
                                    </div>
                                     <div class="input-block">
                                         <div class="labels">
                                             <div class="qs_list block-counter"></div>
                                             <div class="qs_body">Contact telephone number
          with Country Code and Area Code <span class="strike">*</span>
                                                 <!-- <div class="qs_sub">+917387519269</div> -->
                                             </div>
                                         </div>
                                         <div class="input-control tele_plus">
                                             <input type="tel" name="phone_number" class="only_number" id="phone_number" value="{{(isset($getpostdata['mobile_no']) && !empty($getpostdata['mobile_no']))?$getpostdata['mobile_no']:NULL}}" maxlength="15" required="">
                                             <div class="press_enter">PRESS TAB</div>
                                         </div>
                                     </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12 text-center paddingtb_20">
                              <input type="submit" class="__btn __btn_next" id="btnapply" name="btnapply" value="NEXT STEP">
                           </div>
                        </div>
                        <!-- row end -->
                     </div>
                     <!-- Form wrapper -->
                  </div>
                  <!-- Tab Content End -->
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Top bg End -->
@include('layouts.middle_footer')     
@stop
