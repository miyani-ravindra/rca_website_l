@extends('layouts.layout')
@section('content')
<!-- Thanks Body -->
    <div class="__thanks" id="thanks">
        <div class="__thanks_body">
            <div class="_close_thnks"><a href="{{URL::to('/')}}"><img src="svg/close.svg" width="22px" height="22px" /></a></div>
            <img src="svg/thanks_icon.svg" width="90px" class="center-block" alt="" />
            <h3 class="_fancytxt lg" id="thnks3">Thanks</h3>
            <p>All good things come to those who wait 😊
                <br /> We will contact you shortly</p>
        </div>
    </div>
@stop