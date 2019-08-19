@extends('_partials.standard_page')

@section('meta')
    <meta name="description" content="Reset password">
@stop

@section('title') Reset Password @parent @stop

@section('main_header') Reset Password @stop

@section('content_classes') text-center @stop

@section('main_content')

    @include('_partials.feedback')

    <form class="section-container form-item" data-role="choose-action-container" data-type="register" enctype="application/x-www-form-urlencoded" action="/user/reset-password/confirm" method="POST">
        {{ csrf_field() }}

        <input type="hidden" name="code_one" value="{{$user_id}}">
        <input type="hidden" name="code_two" value="{{$reset_code}}">

        <section class="form-input">
            <label>Password <small>(minimum 6 characters)</small><span class="required-status"></span></label>
            <input type="password" name="password" autocomplete="off">
        </section>

        <section class="form-input">
            <label>Confirm Password <span class="required-status"></span></label>
            <input type="password" name="password_confirmation" autocomplete="off">
        </section>

        <section  class="form-input">
            <button class="btn-s-one float-right">Reset password</button>
        </section>
    </form>

@stop


