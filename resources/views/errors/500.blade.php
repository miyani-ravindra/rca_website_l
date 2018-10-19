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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="__congrats">
                                            <h1>Oops!</h1>
                                            <h2>500</h2>
											<p>Nothing you can do at the moment. If you need immediate assistance, please send us an email instead. We apologize for any inconvenience.</p>
                                            <div class="paddingtb_20">
                                                <a href="{{URL::to('/')}}" class="__btn __btn_link">HOMEPAGE</a>
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