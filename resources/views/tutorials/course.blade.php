@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') {{$course->name}} @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <section class="courses-section">
        <div class="header-section" style='background-image: url("/assets/img/php-elephant.jpg")'>
            <div class="heading-inner-container">
                <h1>{{$course->name}}</h1>
            </div>
        </div>

        <section class="tutorial-content">
            <ul>
            @foreach($chapters as $chapter)
                <li class="option">
                    <a href="/tutorial/{{$course->slug.'/'.$chapter->slug}}" class="inner-content">
                        <div class="chapter-icon">
                            <div class="chapter-icon-border">
                                <div class="chapter-icon-inner">
                                    <i class="{{$chapter->symbol_class}}"></i>
                                </div>
                            </div>
                        </div>
                        <div class="text-description">
                            <h3 >
                                {{$chapter->name}}
                            </h3>
                        </div>
                    </a>
                </li>
            @endforeach
            </ul>
        </section>

    </section>

@stop