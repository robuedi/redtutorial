@extends('_admin.master')

@section('title') Edit profile - @parent @stop

@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">Home</a></li>
    <li>Theme</li>
@stop

@section('content')

    <form action="" enctype="application/x-www-form-urlencoded" method="post">

        <div class="row">
            <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
                <h1 class="page-title txt-color-blueDark">

                    <!-- PAGE HEADER -->
                    <i class="fa-fw fa fa-pencil-square-o"></i> Theme
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
                        @foreach($theme_configurations as $theme_configuration)
                        <div class="form-group">
                            <i class="icon-prepend fa fa-user"></i>
                            <label class="input">{{$theme_configuration->name}} <span class="req">*</span></label>
                            <input class="form-control" placeholder="{{$theme_configuration->name}}" type="text"  name="{{$theme_configuration->code_name}}" value="{{{old($theme_configuration->code_name,$theme_configuration->value)}}}">
                        </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </section>
    </form>

@stop