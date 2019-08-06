@extends('_partials.master')

@section('meta')
    <meta name="description" content="410 - Page removed">
    <meta name="robots" content="noindex, nofollow">
@stop

@section('title') 410 Page removed@parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <section class="exception-page-content" >
        <h1><span class="error-code">410</span> Page removed</h1>

        <div class="inner-container">
            <p class="error-description">
                The page has been removed.
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

