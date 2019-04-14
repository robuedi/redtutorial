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
        <div class="content">

            <section class="choose-action" data-role="choose-action">
                <div>
                    <h2 class="active" data-action="register">
                        Reset Password
                    </h2>
                </div>
            </section>

            <div class="feedback-container">
                <div class="feedback">
                    {!! \App\Libraries\UIMessage::get() !!}
                </div>
            </div>

            <form class="sign-in-forms form-item active " data-role="choose-action-container" data-type="register" enctype="application/x-www-form-urlencoded" action="/user/reset-password/confirm" method="POST">
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

        </div>
    </main>

@stop