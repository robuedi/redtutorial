@extends('_partials.standard_page')

@section('meta')
    <meta name="description" content="Reset password">
@stop

@section('title') Reset Password @parent @stop

@section('main_header') Reset Password @stop

@section('content_classes') text-center @stop

@section('main_content')

    @include('_partials.feedback')

    <form class="section-container form-item" enctype="application/x-www-form-urlencoded" action="/user/reset-password" method="POST">
        {{ csrf_field() }}

        <p class="info-paragraph txt-lg">
            Enter the email address you used when you joined and we’ll send you an email to reset your password.
        </p>

        <section class="form-input">
            <label>Email <span class="required-status"></span></label>
            <input type="text" name="email" value="{{old('email')}}">
        </section>

        <section  class="form-input">
            <button class="btn-s-one float-right">Send reset email</button>
        </section>
    </form>

@stop


