@extends('layouts.appAuth')
@section('title','Login')
@section('content')

<style>
    .card{
        /* background-color: black; */
    }
    a{
        text-decoration:none;
    }
</style>

<div class="col-sm-6 col-lg-4 m-auto mt-5">
    <div class="card p-3 my-5 shadow">
        <form action="{{route('login.check')}}" method="POST">
        @csrf
        <!-- <a href="index.html"
            ><img src="{{asset('public/assets/compiled/svg/logo.svg')}}" class="w-25" alt="Logo"
        /></a> -->
        <h1 class="text-center fw-bold">Al-Tawasul</h1>
        <h1 class="text-center fw-bold">Login</h1>
        <div class="form-group my-4">
            <input type="text" class="form-control" name="username" placeholder="Username" />
            {{--<div class="form-control-icon">
                <i class="bi bi-person"></i>
            </div>--}}
        </div>
        <div class="form-group">
            <input type="password" name="password" class="form-control" placeholder="Password"/>
            {{--<div class="form-control-icon">
                <i class="bi bi-shield-lock"></i>
            </div>--}}
        </div>
        <div class="form-check d-flex mb-2">
            <input class="form-check-input" type="checkbox" value=""  id="flexCheckDefault"/>
            <label class="form-check-label mx-1"
            for="flexCheckDefault"> Keep me logged in </label>
        </div>
        <button class="btn btn-primary btn-block">
            Log in
        </button>
        </form>
        <div class="text-center">
        <p class="">
            Don't have an account?
            <a href="{{route('register')}}" class="font-bold">Sign up</a>.
        </p>
        {{-- <p>
            <a class="font-bold" href="auth-forgot-password.html"
            >Forgot password?</a
            >.
        </p> --}}
        </div>
    </div>
</div>
@endsection
