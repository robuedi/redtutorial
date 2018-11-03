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

            <div class="animated-error">
                <div class="particles-container">
                    <a href="{{url('')}}" class="logo-txt">
                        <span class="red">RED</span>
                        <span class="tutorial">Tutorial</span>
                    </a>
                    <div class="particles">
                        <span class="particle particle--c"></span>
                        <span class="particle particle--a"></span>
                        <span class="particle particle--b"></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

