@extends('_partials.standard_page')

@section('meta')
    <meta name="description" content="Sign in, register, profile">
@stop

@section('title') Register / Sign In @parent @stop

@section('head_end')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@stop

@section('main_header') Register / Sign In @stop

@section('content_classes') text-center @stop

@section('main_content')

    <section class="choose-action" data-role="choose-action">
        <div>
            <h2 class="@if(!isset($sign_in)) active @endif" data-action="register">
                Register
            </h2>
            <h2 class="@if(isset($sign_in)) active @endif" data-action="sign-in">
                Sign In
            </h2>
        </div>
    </section>

    @include('_partials.feedback')

    <form class="section-container form-item @if(isset($sign_in)) inactive @endif" data-role="choose-action-container" data-type="register" enctype="application/x-www-form-urlencoded" action="/user/register" method="POST">
        {{ csrf_field() }}
        <section class="form-input">
            <label>First name <span class="required-status"></span></label>
            <input type="text" name="first_name"  value="{{old('first_name')}}">
        </section>

        <section class="form-input">
            <label>Last name <span class="required-status"></span></label>
            <input type="text" name="last_name"  value="{{old('last_name')}}">
        </section>

        <section class="form-input">
            <label>Email <span class="required-status"></span></label>
            <input type="text" name="email" value="{{old('email')}}">
        </section>

        <section class="form-input">
            <label>Password <small>(minimum 6 characters)</small><span class="required-status"></span></label>
            <input type="password" name="password" autocomplete="off">
        </section>

        <section class="form-input">
            <label>Confirm Password <span class="required-status"></span></label>
            <input type="password" name="password_confirmation" autocomplete="off">
        </section>

        <div class="g-recaptcha form-input" data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"></div>

        <p class="info-paragraph">
            By clicking Register, you accept our <a class="info-link" target="_blank" href="/info/terms-and-conditions">Terms and Conditions</a>.
            Find out about our <a class="info-link" target="_blank" href="/info/privacy-and-cookies-policy">Privacy and Cookies Policy</a>.
        </p>

        <section  class="form-input">
            <button class="btn-s-one float-right">Register</button>
        </section>
    </form>

    <form class="section-container form-item @if(!isset($sign_in)) inactive @endif" data-role="choose-action-container" data-type="sign-in" enctype="application/x-www-form-urlencoded" action="/user/sign-in" method="POST">
        {{ csrf_field() }}
        <section class="form-input">
            <label>Email <span class="required-status"></span></label>
            <input type="text" name="email" value="{{old('email')}}">
        </section>

        <section class="form-input">
            <label>Password <span class="required-status"></span></label>
            <input type="password" name="password" autocomplete="off">
        </section>

        <p class="info-paragraph">
            <a class="info-link" href="/user/reset-password">Forgot password?</a>
        </p>

        <section  class="form-input">
            <button class="btn-s-one float-right">Sign In</button>
        </section>
    </form>
@stop


