@extends('_partials.master')

@section('meta')
    <meta name="description" content="User Profile">
@stop

@section('title') Profile @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <main id="user_profile_page"  >
        <section class="top-section" style='background-image: url("/images/assets/img/contact_us.jpg?w=1200&fit=contain")'>
            <h1>Profile</h1>
        </section>
        <section class="content">

            <section class="choose-action" data-role="choose-action">
                <div>
                    <h2 class="active" data-action="progress">
                        Progress
                    </h2>
                    <h2 data-action="profile-info">
                        Profile Info
                    </h2>
                </div>
            </section>

            <div class="feedback-container">
                <div class="feedback">
                    {!! \App\Libraries\UIMessage::get() !!}
                </div>
            </div>


            <section class="progress-content active" data-role="choose-action-container" data-type="progress">
                <h3>Progress</h3>
            </section>

            <form class="form-item profile-info-content" data-role="choose-action-container" data-type="profile-info" enctype="application/x-www-form-urlencoded" action="/user/update-profile" method="POST">
                {{ csrf_field() }}
                <section class="form-input">
                    <label>First name <span class="required-status"></span></label>
                    <input type="text" name="first_name"  value="{{old('first_name', $user->first_name)}}">
                </section>

                <section class="form-input">
                    <label>Last name <span class="required-status"></span></label>
                    <input type="text" name="last_name"  value="{{old('last_name', $user->last_name)}}">
                </section>

                <section class="form-input">
                    <label>Email <span class="required-status"></span></label>
                    <input type="text" name="email" value="{{old('email', $user->email)}}">
                </section>

                <h4 class="password-main-label" data-self-add-class="active" >Update password</h4>
                <section class="password-change-section">
                    <section class="form-input">
                        <label>Old password <span class="required-status"></span></label>
                        <input type="password" name="old_password" autocomplete="off">
                    </section>

                    <section class="form-input">
                        <label>New password <small>(minimum 6 characters)</small><span class="required-status"></span></label>
                        <input type="password" name="password" autocomplete="off">
                    </section>

                    <section class="form-input">
                        <label>Confirm New Password <span class="required-status"></span></label>
                        <input type="password" name="password_confirmation" autocomplete="off">
                    </section>
                </section>

                <section  class="form-input">
                    <a class="btn-s-one" href="/user/logout" style="float: left;" >Log Out</a>
                    <button class="btn-s-one">Update profile</button>
                </section>
            </form>


        </section>
    </main>

@stop