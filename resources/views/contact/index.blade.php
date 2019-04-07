@extends('_partials.master')

@section('meta')
    <meta name="description" content="Contact us">
@stop

@section('title') Contact Us @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <main class="contact-us-page-content"  >
        <section class="top-section" style='background-image: url("/images/assets/img/contact_us.jpg?w=1200&fit=contain")'>
            <h1>Contact Us</h1>
        </section>
        <section class="content">
            <div class="feedback-container">
                <div class="feedback">
                    {!! \App\Libraries\UIMessage::get() !!}
                </div>
            </div>
            <form class="contact-form form-item" enctype="application/x-www-form-urlencoded" action="/contact-us" method="POST">
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

                <section class="form-input">
                    <label>Verification <span class="required-status"></span></label>
                    <div class="verification-input-container">
                        <span class="verification-text">{{$verification_nr[0]}} + {{$verification_nr[1]}} = </span><input class="verification-input" type="text" name="verification" >
                    </div>
                </section>

                <section  class="form-input">
                    <button class="btn-s-one float-right">Submit</button>
                </section>
            </form>
        </section>
    </main>

@stop