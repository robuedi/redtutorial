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
            <h1 class="page-title txt-color-blueDark"><i class="fa fa-calendar fa-fw "></i>
                Dashboard
            </h1>
        </div>
        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
            <ul id="sparks" class="">
                <li class="sparks-info">
                    <h5> My Income <span class="txt-color-blue">$1</span></h5>
                    <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
                        1
                    </div>
                </li>
                <li class="sparks-info">
                    <h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;100%</span></h5>
                    <div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
                        100
                    </div>
                </li>
                <li class="sparks-info">
                    <h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;3</span></h5>
                    <div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
                        1, 2, 3
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">

        <div class="col-xs1"></div>

    </div>

@stop