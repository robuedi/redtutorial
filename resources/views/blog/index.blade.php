@extends('_partials.master')

@section('meta')
    <meta name="description" content=''>
@stop

@section('title') Articles @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <main class="courses-section" >
        <section class="header-section" style='background-image: url("/images/test.png?w=1000&fit=contain&filt=greyscale")' >
            <div class="heading-inner-container">
                <h1>Articles</h1>
            </div>
            <div class="course-description">
                Get latest news
            </div>
        </section>

        <section class="tutorial-content" >

            <div class="list-container">

                <ol class="list-items">
                    @foreach($articles as $article)
                        <li >
                            <a href='/articles/{{$article->slug}}' class="option" >
                                <div class="top-level" >
                                    <h2>{{$article->title}}</h2>
                                    <span class="line-completion-indicator" style="width: {{$chapter->completion_percentage ?? 0}}%;"></span>
                                    <span class="dot-completion-indicator" style="left: {{$chapter->completion_percentage ?? 0}}%;"></span>
                                    <span class="route">
                                        <span class="inner-route"></span>
                                    </span>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ol>
            </div>

        </section>

    </main>

@stop