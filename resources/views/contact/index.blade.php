@extends('_partials.standard_page')

@section('meta')
    <meta name="description" content="Contact us">
@stop

@section('title') Contact Us @parent @stop

@section('head_end')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@stop

@section('main_header') Contact Us @stop

@section('content_classes') text-center @stop

@section('main_content')

    @include('_partials.feedback')

    <form class="section-container form-item" enctype="application/x-www-form-urlencoded" action="/contact-us" method="POST">
        {{ csrf_field() }}
        <section class="form-input">
            <label>Name <span class="required-status"></span></label>
            <input type="text" name="name" value="{{old('name')}}">
        </section>

        <section class="form-input">
            <label>Email <span class="required-status"></span></label>
            <input type="text" name="email" value="{{old('email')}}">
        </section>

        <section class="form-input">
            <label>Subject </label>
            <input type="text" name="subject" value="{{old('subject')}}">
        </section>

        <section class="form-input">
            <label>Message <span class="required-status"></span></label>
            <textarea rows="5" name="message">{{old('message')}}</textarea>
        </section>

        <div class="g-recaptcha form-input" data-sitekey="{{env('RECAPTCHA_SITE_KEY')}}"></div>

        <section  class="form-input">
            <button class="btn-s-one float-right">Submit</button>
        </section>
    </form>
@stop


