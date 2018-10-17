@extends('_admin.master')

@section('title') @lang('admin_users_management.users_management') @parent @stop


@section('breadcrumbs')
    <li><a href="{{URL::to('/'.config('app.admin_route'))}}">@lang('admin_general.home')</a></li>
    <li>@lang('admin_users_management.users_management')</li>
@stop

@section('scripts')
@stop

@section('stylesheets')
@stop

@section('content')
@stop