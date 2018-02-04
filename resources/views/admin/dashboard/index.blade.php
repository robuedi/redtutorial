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

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
            <h1 class="page-title txt-color-blueDark">
                <i class="fa fa-fw fa-home"></i>
                Dashboard
            </h1>
        </div>
    </div>

    <section id="widget-grid" class="">
    </section>

    <div class="row">
        <div class="col-md-6">
            {{date('Y-m-d')}}
        </div>
        <div class="col-md-6">
        </div>
    </div>

@stop