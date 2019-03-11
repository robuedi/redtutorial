@extends('_partials.master')

@section('meta')
    <meta name="description" content="Sign In">
@stop

@section('title') Sign In @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <section class="sign-in-page"  >
        <div class="top-section" style='background-image: url("/images/assets/img/contact_us.jpg?w=1200&fit=contain")'>
            <h1>Sign In / Register</h1>
        </div>
        <div class="content">
            <div class="feedback-container">
                <div class="feedback">
                    {!! \App\Libraries\UIMessage::get() !!}
                </div>
            </div>

            <section class="choose-action" data-role="sign-choose-action">
                <div>
                    <h2 class="active" data-action="register">
                        Register
                    </h2>
                    <h2 data-action="sign-in">
                        Sign In
                    </h2>
                </div>
            </section>

            <form class="sign-in-forms form-item active" data-role="sign-in-form" data-type="register" enctype="application/x-www-form-urlencoded" action="/register" method="POST">
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
                    <label>Password <span class="required-status"></span></label>
                    <input type="password" name="password" autocomplete="off">
                </section>

                <section class="form-input">
                    <label>Confirm Password <span class="required-status"></span></label>
                    <input type="password" name="confirm_password" autocomplete="off">
                </section>

                <section  class="form-input">
                    <button class="btn-s-one">Register</button>
                </section>
            </form>

            <form class="sign-in-forms form-item" data-role="sign-in-form" data-type="sign-in" enctype="application/x-www-form-urlencoded" action="/sign-in" method="POST">
                {{ csrf_field() }}
                <section class="form-input">
                    <label>Email <span class="required-status"></span></label>
                    <input type="text" name="email" value="{{old('email')}}">
                </section>

                <section class="form-input">
                    <label>Password <span class="required-status"></span></label>
                    <input type="password" name="password" autocomplete="off">
                </section>

                <section  class="form-input">
                    <button class="btn-s-one">Sign In</button>
                </section>
            </form>
        </div>
    </section>

@stop