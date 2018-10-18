@extends('layouts.layout')
@section('product_bg')

<div class="container">
        <div class="row">
            <div class="col-md-offset-3 col-md-6 col-md-offset-3">
                <div class="__login_container">
                    <div class="__login_head">
                        <img src="{{ URL::to('/') }}/svg/login-icon.svg" alt="" width="80" />
                        <h4>Login To Your Account</h4>
                    </div>
                    <div class="__login_form">
                    	<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="group">
                            <div class="inputs">
                                <input type="email" name="email_id" id="email_id" autocomplete="false" value="{{ old('email') }}" required>
                                <label>Your Username or Email ID</label>
                            </div>
                        </div>
                        <div class="group">
                            <div class="inputs">
                                <input type="password" name="password" id="password" autocomplete="false" required>
                                <label>Your Password</label>
                            </div>
                        </div>
                        <div>
                            <button class="__btn __btn_submit __btn_lg">LOGIN</button>
                        </div>
                        <div class="group">
                            <div class="__new_user">
                                New User <a href="{{ URL::to('/') }}/sign-up">Sign Up?</a>
                            </div>
                            <div class="__forgot">
                                <a href="{{ url('/password/email') }}">Forgot Password?</a>
                            </div>
                        </div>
                    	</form>
                    </div>
                    <!-- <p class="__alert">Enter Correct Email ID! <i class="fa fa-times"></i></p> -->
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop