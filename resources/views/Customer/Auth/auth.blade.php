@extends('Components.customer.index')
@section('title')
<title>Home</title>
@endsection
@section('Css')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
<link rel="stylesheet" href="{{asset('css/snippet.css')}}">
@endsection
@section('Js')
<script src="{{asset('js/auth.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('content')
<section class="login-block">
    <div class="container login-back">
        <div class="row">
            <div class="col-md-4 login-sec" id="sgin-in">
                <h2 class="text-center">Sgin In</h2>
                <form>
                    @csrf
                    <div class="message-error" id="message-login-error"></div>
                    <div class="form-group">
                        <div class="input-group mb-3 has-validation">
                            <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" class="form-control" id="email-login" name="email-login" placeholder="Enter email">
                            <div class="invalid-feedback" id="message-error-email-login"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" id="password-login" name="password-login" placeholder="Enter passowrd">
                            <div class="invalid-feedback" id="message-error-password-login"></div>
                        </div>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input">
                            <small>Remember Me</small>
                        </label>
                        <button type="button" class="btn btn-login float-right" onclick="checkLogin()">Login</button>
                    </div>
                </form>
                <div class="copy-text">
                    You don't have an account yet? <a href="javascript:void(0);" onclick="moveSginUp()">Sign up</a><br>
                    <a href="{{route('forget-password')}}">You forgot your password?</a>
                </div>
            </div>
            <div class="col-md-4 login-sec" id="sgin-up">
                <h2 class="text-center">Sgin Up</h2>
                <form>
                    @csrf
                    <div class="message-error" id="message-sgin-up-error"></div>
                    <div class="form-group">
                        <div class="input-group mb-3 has-validation">
                            <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" class="form-control" id="name-register" name="name-register" placeholder="Enter name">
                            <div class="invalid-feedback" id="message-error-name-register"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3 has-validation">
                            <span class="input-group-text"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <input type="email" class="form-control" id="email-register" name="email-register" placeholder="Enter email">
                            <div class="invalid-feedback" id="message-error-email-register"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" id="password-register" name="password-register" placeholder="Enter passowrd">
                            <div class="invalid-feedback" id="message-error-password-register"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" id="confirm-password-register" name="confirm-password-register" placeholder="Enter confirm passowrd">
                            <div class="invalid-feedback" id="message-error-confirm-password-register"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-register" onclick="checkRegsiter()">Register</button>
                    </div>
                </form>
                <div class="copy-text">You already have a login account? <a href="javascript:void(0);" onclick="moveSginIn()">Sign in</a></div>
            </div>
            <div class="col-md-4 login-sec " id="otp">
                <h2 class="text-center">Otp</h2>
                <div class="message-error" id="otp-message"></div>
                <form>
                    @csrf
                    <div class="message-error" id="message-otp-error"></div>
                    <div class="form-group">
                        <div class="input-group has-validation">
                            <span class="input-group-text"><i class="fa fa-commenting-o" aria-hidden="true"></i></span>
                            <input type="number" id="otp-input" class="form-control" id="otp" placeholder="Enter otp">
                        </div>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <a href="javascript:void(0);">Sent otp again ?</a>
                        </label>
                        <button type="button" class="btn btn-login float-right" onclick="verify()">Confirm</button>
                    </div>
                </form>
                <a href="javascript:void(0);"><- Back</a>
            </div>
            <div class="col-md-4 snippet-sec" id="snippet">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="loader6">
                                <span class="loader-inner"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 banner-sec" style="padding: 0;">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="d-block img-login" src="{{asset('img/login/anh10.png')}}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-login" src="{{asset('img/login/linh-kien-may-tinh.png')}}" alt="First slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block img-login" src="{{asset('img/login/tin-tuc-981.png')}}" alt="First slide">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('sweetalert::alert')
@endsection