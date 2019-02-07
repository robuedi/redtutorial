@extends('_partials.master')

@section('meta')
    <meta name="description" content="{{$meta['description']}}">
@stop

@section('title') {{$lesson->course_name}} @parent @stop

@section('stylesheets')
    {{--<link rel="stylesheet" type="text/css" href="/assets/js/libs/prism/prism.css?v=1">--}}
    <link rel="stylesheet" type="text/css" href="/assets/js/libs/highlightjs/styles/idea.css?v=1">
@stop

@section('scripts')
    {{--<script src="/assets/js/libs/prism/prism.js?v=1"></script>--}}
    <script src="/assets/js/libs/highlightjs/highlight.pack.js?v=1"></script>

    <script>hljs.initHighlightingOnLoad();</script>
@stop

@section('content')
    <section class="lesson-main-container">
        <section class="tutorial-name" @if($course_image) style='background-image: url("/images/{{$course_image->url}}?w=1000&fit=contain&filt=greyscale")' @endif >
            <div class="subtitle">
                <h2>
                    <a href="/tutorial/{{$lesson->course_slag.'/'.$lesson->chapter_slag}}"><i class="fas fa-angle-left"></i> Lessons</a>
                </h2>
            </div>
            <div class="heading-inner-container">
                <h1>{{$lesson->lesson_name}}</h1>
            </div>
        </section>
        <section class="tutorial-container" id="lessons_content">
            <div class="lesson-progress-container"  >
                <div class="lesson-progress">
                    @foreach($lesson_sections as $index => $lesson_section)
                        @if($lesson_section->type == 'quiz')
                            <span class="@if($index == 0) active @endif quiz-sign"><i>?</i></span>
                        @elseif($lesson_section->type == 'text')
                            <span class="@if($index == 0) active @endif text-sign"><i class="fas fa-caret-right"></i></span>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="lessons-list" id="lessons_list">
                @foreach($lesson_sections as $index => $lesson_section)
                    <div class="lesson-container @if($index == 0) active @endif">
                        @if(!empty($lesson_section->name))
                            <h3>{{$lesson_section->name}}</h3>
                        @elseif($index == 0)
                            <h3>Insight</h3>
                        @endif
                        {!! $lesson_section->content !!}

                        @if($lesson_section->type == 'quiz' && isset($quiz_answers[$lesson_section->id]))
                        <div class="quiz-form" data-quiz="{{$lesson_section->id}}">
                            @foreach($quiz_answers[$lesson_section->id] as $quiz_answer)
                                <div>
                                    <label class="input-container">
                                        <input name="quiz_{{$lesson_section->id}}" type="{{$lesson_section->options_type}}" value="{{$quiz_answer->value}}">
                                        <div class="input-label">
                                            {{$quiz_answer->label}}
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                @endforeach
                <span class="prev-load"><i class="fas fa-chevron-circle-left"></i></span>
                <span data-next-lesson="/tutorial/{{$lesson->course_slag}}@if($next_slug)/{{$lesson->chapter_slag}}@endif" class="next-load"><i class="fas fa-chevron-circle-right"></i></span>
            </div>
        </section>
    </section>

@stop
