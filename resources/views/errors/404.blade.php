@extends('_partials.master')

@section('meta')
    <meta name="description" content="404 - Page not found">
@stop

@section('title') 404 Page not found @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <section class="exception-page-content" >
        <h1><span class="error-code">404</span> Page not found</h1>

        <div class="inner-container">
            <p class="error-description">
                We couldn't find the page you are looking for.
            </p>
        </div>
    </section>

@stop

