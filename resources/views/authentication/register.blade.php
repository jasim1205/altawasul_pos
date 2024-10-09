@extends('layouts.appAuth')
@section('title','Login')
@section('content')
<div class="col-sm-6 col-lg-4 mx-auto">
    <div class="card p-3 my-5 shadow">
        <form action="{{route('register.store')}}" method="POST">
            @csrf
            <!-- <div class="auth-logo">
                <a href="index.html"><img src="{{asset('public/assets/compiled/svg/logo.svg')}}" alt="Logo"></a>
            </div> -->
            <h1 class="auth-title fw-bold text-center">Sign Up</h1>
            <p class="auth-subtitle fw-bold text-center">Input your data to register to our website.</p>

            <div class="form-group">
                <input type="text" class="form-control" name="FullName" id="FullName" placeholder="FullName">
                @if ($errors->has('FullName'))
                    <small class="d-block text-danger fw-bold">
                        {{ $errors->first('FullName') }}
                    </small>
                @endif
                <!-- <div class="form-control-icon">
                    <i class="bi bi-envelope"></i>
                </div> -->
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="EmailAddress" placeholder="Email" id="EmailAddress">
                @if ($errors->has('EmailAddress'))
                    <small class="d-block text-danger fw-bold">
                        {{ $errors->first('EmailAddress') }}
                    </small>
                @endif
                <!-- <div class="form-control-icon">
                    <i class="bi bi-person"></i>
                </div> -->
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="+123456789">
                @if ($errors->has('contact_no'))
                    <small class="d-block text-danger fw-bold">
                        {{ $errors->first('contact_no') }}
                    </small>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                @if ($errors->has('password'))
                    <small class="d-block text-danger fw-bold">
                        {{ $errors->first('password') }}
                    </small>
                @endif
                <!-- <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div> -->
            </div>
            <div class="form-group">
                 <input type="password" class="form-control rounded" id="password_confirmation" name="password_confirmation" placeholder="confirm password">
                <!-- <div class="form-control-icon">
                    <i class="bi bi-shield-lock"></i>
                </div> -->
            </div>
            <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
        </form>
        <div class="text-center mt-5 text-lg fs-4">
            <p class='text-gray-600'>Already have an account? <a href="{{route('login')}}" class="font-bold">Log
                    in</a>.</p>
        </div>
    </div>
</div>
@endsection