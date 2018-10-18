@extends('layouts.layout')
@section('product_bg')

<div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6 col-md-offset-3">
                <div class="__login_container">
                    <div class="__login_head">
                        <img src="svg/login-icon.svg" alt="" width="80" />
                        <h4>Sign up to book your Visa</h4>
                    </div>
                    <div class="__login_form">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/sign-up') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="group">
                            <div class="inputs">
                                <input type="text" name="full_name" id="full_name" autocomplete="false" required>
                                <label>Name</label>
                            </div>
                        </div>
                        <div class="group">
                            <div class="inputs">
                                <input type="email" name="email_id" id="email_id" autocomplete="false" required>
                                <label>Your Email ID</label>
                            </div>
                        </div>
                        <div class="group">
                            <div class="inputs">
                                <input type="password" name="password" id="password" autocomplete="false" required>
                                <label>Your desired Password</label>
                            </div>
                        </div>
                        <div class="group">
                            <div class="inputs">
                                <input type="password" name="repassword" id="repassword" autocomplete="false" required>
                                <label>Retype Password</label>
                            </div>
                        </div>
                        <div>
                            <button class="__btn __btn_submit __btn_lg">SIGN UP</button>
                        </div>
                        <div class="group">
                            <div class="__already_acc">
                                Already have an account <a href="{{ URL::to('/') }}/login">Login?</a>
                            </div>
                        </div>
                        </form>
                    </div>
                    <p class="__alert">Enter Correct Email ID! <i class="fa fa-times"></i></p>
                </div>
            </div>
        </div>
</div>

@stop