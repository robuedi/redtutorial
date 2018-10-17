@extends('_partials.master')

@section('meta')
    <meta name="description" content="Contact us">
@stop

@section('title') Contact Us @parent @stop

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="/assets/css/contact_us.css">
@stop

@section('scripts')
@stop

@section('content')

    <section class="contact-us-page-content"  >
        <div class="top-section" style='background-image: url("/assets/img/contact_us.jpg")'>
            <h1>Contact Us</h1>
        </div>
        <div class="content">
            <div class="feedback">
                {!! \App\Libraries\UIMessage::get() !!}
            </div>
            <form class="contact-form" enctype="application/x-www-form-urlencoded" action="/contact-us" method="POST">
                {{ csrf_field() }}
                <section class="form-input">
                    <label>Name <span class="required-status">required</span></label>
                    <input type="text" name="name" value="{{old('name')}}">
                </section>

                <section class="form-input">
                    <label>Email <span class="required-status">required</span></label>
                    <input type="text" name="email" value="{{old('email')}}">
                </section>

                <section class="form-input">
                    <label>Subject <span class="required-status">optional</span></label>
                    <input type="text" name="subject" value="{{old('subject')}}">
                </section>

                <section class="form-input">
                    <label>Message <span class="required-status">required</span></label>
                    <textarea rows="5" name="message">{{old('message')}}</textarea>
                </section>

                <section class="form-input">
                    <label>Verification <span class="required-status">required</span></label>
                    <div class="verification-input-container">
                        <span class="verification-text">{{$verification_nr[0]}} + {{$verification_nr[1]}} = </span><input class="verification-input" type="text" name="verification" >
                    </div>
                </section>

                <section  class="form-input">
                    <button class="submit-btn">Submit</button>
                </section>
            </form>
        </div>
    </section>

@stop