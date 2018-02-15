@extends('admin.master')

@section('title') Dashboard - @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/')}}">Home</a></li>
    <li>Dashboard</li>
@stop

@section('scripts')
@stop

@section('stylesheets')
@stop

@section('heading')
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark"><i class="fa fa-calendar fa-fw "></i>
            Dashboard
        </h1>
    </div>
@stop

@section('content')

    <div class="row">

        <div class="col-xs1"></div>

    </div>

@stop