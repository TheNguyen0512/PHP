@extends('Components.customer.index')
@section('title')
<title>Home</title>
@endsection
@section('Css')
@endsection
@section('Js')
<script src="{{asset('js/reset.password.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
@section('content')
<div class="container p-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Reset Password
                </div>
                <div class="card-body">
                    <div>
                        <input type="hidden" id="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input type="text" class="form-control" value="{{$email}}" id="email" disabled>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                            <div class="invalid-feedback" id="message-error-reset-password"></div>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm new password">
                            <div class="invalid-feedback" id="message-error-reset-confirm-password"></div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="resettPassowrd()">Change Password</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection