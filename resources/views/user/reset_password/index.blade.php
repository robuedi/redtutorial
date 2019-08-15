@extends('_partials.master')

@section('meta')
    <meta name="description" content="Reset password">
@stop

@section('title') Reset Password @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <main class="sign-in-page"  >
        <div class="top-section" style='background-image: url("/images/assets/img/contact_us.jpg?w=1200&fit=contain")'>
            <h1>Reset Password</h1>
        </div>
        <div class="contenta">

            <div class="feedback-container">
                <div class="feedback">
                    {!! \App\Libraries\UIMessage::get() !!}
                </div>
            </div>

            <form class="form-item" enctype="application/x-www-form-urlencoded" action="/user/reset-password" method="POST">
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

        </div>
    </main>

@stop