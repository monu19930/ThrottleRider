@extends('layouts.frontLayout.front-layout')
@section('content')
<div class="row no-gutters">
    <div class="col-lg-12">
        <div class="login-block">
            <ul class="nav nav-tabs mb-4 cust-tab" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true"><span>Login</span></a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="signup-tab" data-toggle="tab" href="#signupMobile" role="tab" aria-controls="signupMobile" aria-selected="false"><span>Signup</span></a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <h2 class="login-heading">Welcome back! <small>Login using</small></h2>                    
                    <div class="social-btn mt-3">
                        <button class="outline-btn social_login" data-content="{{url('login/facebook')}}"><img src="{{ asset('public/rider/images/icons-social-fb.svg')}}"> Facebook</button>
                        <button class="outline-btn social_login" data-content="{{url('login/google')}}"><img src="{{ asset('public/rider/images/icons-social-google.svg')}}"> Google</button>
                    </div>
                    <label class="login-change-txt">or Login using email/ Mobile number</label>
                    <form action="" class="" id="loginForm">
                        <div class="alert alert-success alert-dismissible print-error-msg mt-2" style="display:none">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span></span>
                        </div>
                        <div class="login-input">
                            <div class="form-group">
                                <input type="email"  name="email" autocomplete="off" class="form-control " placeholder="Email address/ Mobile number">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Password">
                            </div>

                            <button type="button" class="btn btn-danger w-100" onclick="signinRider();">LOGIN</button>
                            <p class="mt-3 login-bottom-txt">Forgot Password? <a href="#" class="text-danger">Reset Password</a></p>
                            <p class=" mt-3 login-bottom-txt">New on Throttle Rides? <a href="#" class="text-danger">Create Your Account</a></p>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="signupMobile" role="tabpanel" aria-labelledby="signup-tab">
                    <h2 class="login-heading">Create YOUR ACCOUNT<small>Sign up using</small></h2>
                    <div class="social-btn mt-3">
                        <button class="outline-btn"><img src="{{ asset('public/rider/images/icons-social-fb.svg')}}"> Facebook</button>
                        <button class="outline-btn"><img src="{{ asset('public/rider/images/icons-social-google.svg')}}"> Google</button>
                    </div>
                    <label class="login-change-txt">or Sign up using email</label>
                    <form id="signupForm" method="post">
                        <div class="alert alert-success alert-dismissible print-error-msg mt-2" style="display:none">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <span></span>
                        </div>
                        <div class="login-input">
                            <div class="form-group">
                                <input type="text" class="form-control" autocomplete="off" name="name" placeholder="Your name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" autocomplete="off" name="email" placeholder="Email address">
                            </div>                        
                            <div class="form-group mb-0">
                                <input type="password" class="form-control" autocomplete="off" name="password" placeholder="Password">
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" autocomplete="off" name="phone" placeholder="Phone Number">
                            </div>
                            <label class="login-change-txt">By Signing up, you confirm that you accept the <a href="#">T&C</a> and
                                <a href="#">Privacy Policy</a></label>
                            <button type="button" class="btn btn-danger w-100" onclick="registerRider();">Sign up</button>
                            <p class="mt-3 login-bottom-txt">Are you a member?<a href="#" class="text-danger">Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop