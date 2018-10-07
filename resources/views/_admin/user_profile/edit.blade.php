@extends('_admin.master')

@section('title') Edit profile - @parent @stop

@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">Home</a></li>
    <li>Your profile</li>
@stop

@section('content')

    <form action="" enctype="application/x-www-form-urlencoded" method="post">

        <div class="row">
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <h1 class="page-title txt-color-blueDark">

                    <!-- PAGE HEADER -->
                    <i class="fa-fw fa fa-pencil-square-o"></i> Profile
                </h1>

            </div>

            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                <button class="btn btn-primary btn-lg pull-right" type="submit">Save</button>

            </div>
        </div>

        {!! \App\Libraries\UIMessage::get() !!}
        <section id="widget-grid" class="">
            <div class="row profile-page">

                <div class="col-sm-9">
                    <div class="well">
                        <div class="form-group">
                            <i class="icon-prepend fa fa-user"></i>
                            <label class="input">First name <span class="req">*</span></label>
                            <input class="form-control" placeholder="First name" type="text"  name="first_name" value="{{{old('first_name',$user->first_name)}}}">
                        </div>
                        <div class="form-group">
                            <i class="icon-prepend fa fa-user"></i>
                            <label>Last name <span class="req">*</span></label>
                            <input class="form-control" placeholder="Last name" type="text" name="last_name" value="{{{old('last_name',$user->last_name)}}}">
                        </div>
                        <div class="form-group">
                            <i class="icon-prepend fa fa-envelope-o"></i>
                            <label>Email <span class="req">*</span></label>
                            <input class="form-control" placeholder="Email" type="text" name="email" value="{{{old('email',$user->email)}}}">
                        </div>
                        <div class="form-group">
                            <i class="icon-prepend fa fa-phone"></i>
                            <label>Phone <span class="req">*</span></label>
                            <input class="form-control phone-number-mask" placeholder="Phone" type="text" name="phone" value="{{{old('phone',$user->phone)}}}">
                        </div>
                        <div class="form-group">
                            <i class="icon-append fa fa-lock"></i>
                            <label>Password</label>
                            <input class="form-control" placeholder="Password" type="password" name="password" value="">
                        </div>
                        <div class="form-group">
                            <i class="icon-append fa fa-lock"></i>
                            <label> Confirm Password</label>
                            <input class="form-control" placeholder=" Confirm Password" type="password" name="password_confirmation" value="">
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </form>

@stop