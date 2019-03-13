$(function () {

    if($('.lesson-main-container').length > 0)
    {
        var lessonNavigation = {
            init: function () {
                this.loadDOM();
                this.events();
            },
            loadDOM: function () {
                this.container          = $('.lessons-list');
                this.progressBar        = $('.lesson-progress');
                this.lessonProgress     = this.progressBar.find('> span');
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

                //click on top nav
                this.lessonProgress.on('click', function () {
                    that.navigateByProgressBar(this);
                })
            },
            navigateByProgressBar: function(clickedBtn){

                //check if activated before
                if($(clickedBtn).hasClass('pre-active')){

                    //check direction
                    var currentIndex = this.progressBar.find('> span.active').index();
                    var nextIndex = $(clickedBtn).index();
                    console.log(currentIndex);
                    console.log(nextIndex);

                    var direction = 'right';
                    if(currentIndex > nextIndex)
                    {
                        direction = 'left';
                    }

                    //get sections
                    var currentContent  = this.container.find('.lesson-container.active');
                    var nextContent     = this.sections.eq(nextIndex);

                    //move to content
                    this.navigateTo(currentContent, nextContent, direction);
                }

            },
            nextSection: function () {

                //get current active
                var currentActive = this.sections.filter('.active');
                if(currentActive.length === 0) //something wrong if here
                {
                    return;
                }

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
            },
            prevSection: function () {

                //check if any is active
                var currentActive = this.sections.filter('.active');
                if(currentActive.length > 0)
                {
                    var prevActive = currentActive.prev('.lesson-container');

                    if(prevActive.length > 0)
                    {
                        this.navigateTo(currentActive, prevActive, 'left');
                    }
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
                        url: '/ajax/v1'+window.location.pathname+window.location.search + '/' + verification_quiz,
                        method: 'POST',
                        dataType: 'json',
                        async: true,
                        data: {response: arrValues, _token: $('meta[name="csrf-token"]').attr('content')},
                        success: function (response) {
                            if(response.status == 'success')
                            {
                                //correct response
                                if(response.response.action == 'pass')
                                {
                                    //show feedback
                                    that.showFeedback('success', response.response.message);

                                    setTimeout(function () {
                                        //move next
                                        that.moveToNextSectionOrLection();
                                    }, 1500);
                                }
                                else //incorrect response
                                {
                                    that.showFeedback('warning', response.response.message)
                                }
                            }
                            else
                            {
                                that.showFeedback('warning', 'Something went wrong')
                            }
                        },
                        error: function () {
                            that.showFeedback('warning', 'Something went wrong')
                        }
                    })
                }
                else
                {
                    that.showFeedback('warning', 'No option selected');
                }
            },
            showFeedback: function (type, msg) {
                //set message
                var html = $('<div class="ui-feedback hidden-temp '+type+'">\n' +
                                '<span>\n' +
                                    msg +
                                '</span>\n' +
                            '</div>');

                //append to active section
                this.clearFeedback();
                var activeSection = this.sections.filter('.active');
                activeSection.append(html);

                //show message
                setTimeout(function () {
                   $(html).removeClass('hidden-temp');
                }, 20);

                //hide message
                setTimeout(function () {
                   $(html).addClass('hidden-temp');
                }, 2500);

                //remove message
                setTimeout(function () {
                   $(html).remove();
                }, 3050);
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
                    this.navigateTo(activeSection, nextSection, 'right');
                }
                else
                {
                    window.location.href = this.nextLessonLink;
                }
            },
            navigateTo: function (from, to, directionTo) {

                //check movement direction
                var fromClass = 'remove-to-left';
                var toClass = 'show-from-right';
                if(directionTo === 'left')
                {
                    fromClass = 'remove-to-right';
                    toClass = 'show-from-left';
                }

                //hide the current one
                from.addClass(fromClass);
                from.removeClass('active');
                setTimeout(function () {
                    from.removeClass(fromClass);
                }, 500);

                //show the next one
                setTimeout(function () {
                    to.addClass(toClass);
                    setTimeout(function () {
                        to.addClass('active');
                        setTimeout(function () {
                            to.removeClass(toClass);
                        }, 500);
                    }, 10);
                }, 490);

                //scroll top
                setTimeout(function () {
                    //check if we should scroll
                    if($(window).scrollTop() > ($('#lessons_list').offset().top - 20))
                    {
                        $('html, body').animate({
                            scrollTop: $('#lessons_content').offset().top - 20
                        }, 500);
                    }
                }, 1000);

                //set top progress
                this.lessonProgress.filter('.active').addClass('pre-active').removeClass('active');
                this.lessonProgress.eq($(to).index()).removeClass('pre-active').addClass('active');
            }
        };

        lessonNavigation.init();
    }
});