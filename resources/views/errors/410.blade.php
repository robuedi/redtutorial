@extends('_partials.master')

@section('meta')
    <meta name="description" content="410 - Page not found">
    <meta name="robots" content="noindex, follow">
@stop

@section('title') 410 Page not found @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <section class="exception-page-content" >
        <h1><span class="error-code">410</span> Page not found</h1>

        <div class="inner-container">
            <p class="error-description">
                We couldn't find the page you are looking for.
            </p>
            <p class="error-description">
                <small>
                    Try something else below here?
                </small>
            </p>
            <br/>
            <section class="propose-pages">
                <a class="btn-s-one" href="/">Home</a>
                @foreach(\App\Course::getPageNotFoundActiveCourses() as $course)
                    <a class="btn-s-one" href="/{{$course->slug}}">{{$course->name}}</a>
                @endforeach
            </section>
        </div>
    </section>

@stop

