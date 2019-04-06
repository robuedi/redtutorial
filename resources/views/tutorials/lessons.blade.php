@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') {{$chapter->course_name}} @parent @stop

@section('stylesheets')
@stop

@section('scripts')
@stop

@section('content')

    <main class="chapters-section" >
        <section class="header-section" @if($course_image) style='background-image: url("/images/{{$course_image->url}}?w=1000&fit=contain&filt=greyscale")' @endif>
            <div class="subtitle">
                <h2>
                    <a href="/tutorial/{{$chapter->course_slug}}"><i class="fas fa-angle-left"></i> Chapters</a>
                </h2>
            </div>
            <div class="heading-inner-container">
                <h1>{{$chapter->chapter_name}}</h1>
            </div>
        </section>

        <section class="chapter-container">
            <div class="lesson-choosing">
                @foreach($lessons as $index => $lesson)
                    <article class="option-container">
                        <a href="/tutorial/{{$chapter->course_slug.'/'.$chapter->chapter_slug.'/'.$lesson->slug}}" class="option" >
                            <header class="top-txt" >
                                <h4>{{$lesson->name}}</h4>
                            </header>
                            <footer class="go-link" >
                                <span class="lesson-number">
                                    {{\App\Libraries\NumericLib::numberToRomanRepresentation($index+1)}}
                                    {{--{{\App\Libraries\NumericLib::numberToRomanRepresentation($index+1)}}. <small>&empty;</small>--}}
                                </span>
                                <i class="fas fa-chevron-circle-right"></i>
                            </footer>
                        </a>
                    </article>
                @endforeach
            </div>
        </section>
    </main>

@stop