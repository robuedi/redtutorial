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
    <script>
        $(function () {
            $('.tab-header').on('click', function () {
                $('.tab-header').removeClass('active');
                $(this).addClass('active');
                var headIndex = $('.tab-top .tab-top-container .tab-header').index(this);
                console.log(headIndex);
                $('.tab-bottom .tab-content').removeClass('active');
                $('.tab-bottom .tab-content:nth-child('+(headIndex+1)+')').addClass('active');


            });

            var lessonNavigation = {
                init: function () {
                    this.loadDOM();
                    this.events();
                },
                loadDOM: function () {
                    this.container          = $('.lessons-list');
                    this.sections           = this.container.find('.lesson-container');
                    this.prevBtn            = this.container.find('.prev-load');
                    this.nextBtn            = this.container.find('.next-load');
                    this.nextLessonLink     = site_url + this.nextBtn.attr('data-next-lesson');
                    this.initialLoad        = true;
                },
                events: function(){
                    var that = this;

                    //next btn clicked
                    this.nextBtn.on('click', function (){
                      that.nextSection();
                    });

                    //next btn clicked
                    this.prevBtn.on('click', function (){
                      that.prevSection();
                    });
                },
                nextSection: function () {

                    //get current active
                    var currentActive = this.sections.filter('.active');
                    if(currentActive.length == 0)
                    {
                        currentActive = this.sections.eq(0);
                    }

                    //get next
                    var nextSection = null;
                    if(currentActive.length > 0)
                    {
                        currentActive.addClass('active');

                        //check if quiz
                        var quizForm = currentActive.find('.quiz-form');
                        if(quizForm.length > 0)
                        {
                            this.submitQuiz(quizForm);
                        }
                        else
                        {
                            //check any next or go to next lesson
                            this.moveToNextSectionOrLection();
                        }
                    }
                    else
                    {
                        //There was no content
                    }
                },
                prevSection: function () {

                    //check if any is active
                    var currentActive = this.sections.filter('.active');
                    if(currentActive.length > 0)
                    {
                        var prevActive = currentActive.prev('.lesson-container');

                        if(prevActive.length > 0)
                        {
                            this.sections.removeClass('active');
                            prevActive.addClass('active');
                        }
                    }
                },
                checkInitialLoad: function(){
                    if(this.initialLoad)
                    {
                        this.container.removeClass('initial-load');
                        this.initialLoad = false;

                    }
                },
                submitQuiz: function (quizForm) {
                    var checkedOptions = $(quizForm).find('input:checked');
                    var that = this;

                    if(checkedOptions.length > 0)
                    {
                        var arrValues = [];
                        checkedOptions.each(function () {
                            arrValues.push($(this).val());
                        })

                        var verification_quiz = quizForm.attr('data-quiz');

                        //clear any existing feedback
                        this.clearFeedback();

                        //check response
                        $.ajax({
                            url: '/api/v1'+window.location.pathname+window.location.search + '/' + verification_quiz,
                            method: 'POST',
                            dataType: 'json',
                            async: true,
                            data: {response: arrValues},
                            success: function (response) {
                                if(response.status == 'success')
                                {
                                    //correct response
                                    if(response.response.action == 'pass')
                                    {
                                        //show feedback
                                        that.showFeedback('success', response.response.message);

                                        //move next
                                        that.moveToNextSectionOrLection();
                                    }
                                    else //incorrect response
                                    {
                                        that.showFeedback('warning', response.response.message)
                                    }
                                }
                                else
                                {
                                    that.showFeedback('warning', 'Something went wrong.')
                                }
                            },
                            error: function () {
                                that.showFeedback('warning', 'Something went wrong.')
                            }
                        })
                    }
                    else
                    {
                        that.showFeedback('warning', 'No option selected.');
                    }
                },
                showFeedback: function (type, msg) {
                    //set message
                    var html = '<div class="ui-feedback '+type+'">\n' +
                                                    '<span>\n' +
                                                            msg +
                                                    '</span>\n' +
                                                '</div>'

                    //append to active section
                    this.clearFeedback();
                    var activeSection = this.sections.filter('.active');
                    activeSection.append(html);
                },
                clearFeedback: function () {
                    var activeSection = this.sections.filter('.active');
                    activeSection.find('.ui-feedback').remove();
                },
                moveToNextSectionOrLection: function () {
                    //check any next or go to next lesson
                    var activeSection = this.sections.filter('.active');
                    var nextSection = activeSection.next('.lesson-container');
                    if(nextSection.length > 0)
                    {
                        this.sections.removeClass('active');
                        nextSection.addClass('active');

                        //remove initial class
                        this.checkInitialLoad()

                    }
                    else
                    {
                        window.location.href = this.nextLessonLink;
                    }
                }

            };

            lessonNavigation.init();

        })
    </script>

@stop

@section('content')
    <section class="lesson-main-container">
        <section class="tutorial-name" style='background-image: url("/assets/img/php-elephant.jpg")'>
            <div class="subtitle">
                <h2>
                    <a href="/tutorial/{{$lesson->course_slag.'/'.$lesson->chapter_slag}}"><i class="fas fa-angle-left"></i> Lessons</a>
                </h2>
            </div>
            <div class="heading-inner-container">
                <h1>{{$lesson->lesson_name}}</h1>
            </div>
        </section>
        <section class="tutorial-container">
            <div class="lessons-list initial-load">
                @foreach($lesson_sections as $lesson_section)
                    <div class="lesson-container">
                        @if(!empty($lesson_section->name))<h3>{{$lesson_section->name}}</h3>@endif
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
