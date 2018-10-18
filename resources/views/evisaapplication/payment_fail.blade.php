@extends('layouts.layout')

@section('content')
   <div class="clearfix"></div>
    <div class="__bg">
        <div class="container container-sm">
            <div class="row">
                <div class="col-md-12">
                    <div class="paddingtb_50">
                        <div class="tabs_z_content __current">
                            <div class="__form_wrapper">
                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="__congrats">
                                            <h2>Oh! WE ARE SORRY.</h2>
                                            <p>Oops. There seems to be a failure in the transaction and your payment has not got through. Please do try making a payment again after some time.

</p>
                                            <img src="svg/error.svg" alt="" class="paddingtb_30" width="120" />
                                            <p></p>
                                            <div class="paddingtb_20">
                                                <!-- <a class="__btn __btn_link">GO BACK TO PAYMENT</a> -->
                                                <a class="__btn __btn_link" href="{{ URL::to('/') }}">HOMEPAGE</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- row end -->
                            </div><!-- Form wrapper -->
                        </div><!-- Tab Content End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.middle_footer')     
@stop