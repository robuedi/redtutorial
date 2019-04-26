
export default class LessonContentModule {

    constructor(){

        this.container          = $('[data-role="lessons-list"]');
        this.progressBar        = $('[data-role="lesson-progress"]');
        this.lessonProgress     = this.progressBar.find('> span');
        this.sections           = this.container.find('.lesson-container');
        this.prevBtn            = this.container.find('.prev-load');
        this.nextBtn            = this.container.find('.next-load');
        this.nextLessonLink     = site_url + this.nextBtn.attr('data-next-lesson');

        this.events();
    }

    events(){
        let that = this;

        //next btn clicked
        this.nextBtn.on('click', () => {
            that.nextSection();
        });

        //next btn clicked
        this.prevBtn.on('click', () => {
            that.prevSection();
        });

        //click on top nav
        this.lessonProgress.on('click', () =>  {
            that.navigateByProgressBar(this);
        })
    }

    navigateByProgressBar(clickedBtn)
    {

        //check if activated before
        if($(clickedBtn).hasClass('pre-active')){

            //check direction
            let currentIndex = this.progressBar.find('> span.active').index();
            let nextIndex = $(clickedBtn).index();

            let direction = 'right';
            if(currentIndex > nextIndex)
            {
                direction = 'left';
            }

            //get sections
            let currentContent  = this.container.find('.lesson-container.active');
            let nextContent     = this.sections.eq(nextIndex);

            //move to content
            this.navigateTo(currentContent, nextContent, direction);
        }

    }

    nextSection()
    {

        //get current active
        let currentActive = this.sections.filter('.active');
        if(currentActive.length === 0) //something wrong if here
        {
            return;
        }

        //check if quiz
        let quizForm = currentActive.find('.quiz-form');
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

    prevSection()
    {

        //check if any is active
        let currentActive = this.sections.filter('.active');
        if(currentActive.length > 0)
        {
            let prevActive = currentActive.prev('.lesson-container');

            if(prevActive.length > 0)
            {
                this.navigateTo(currentActive, prevActive, 'left');
            }
        }
    }

    submitQuiz(quizForm) {
        let checkedOptions = $(quizForm).find('input:checked');
        let that = this;

        if(checkedOptions.length > 0)
        {
            let arrValues = [];
            checkedOptions.each((index, item) =>  {
                arrValues.push($(item).val());
            })

            let verification_quiz = quizForm.attr('data-quiz');

            //clear any existing feedback
            this.clearFeedback();

            //check response
            $.ajax({
                url: '/ajax/v1'+window.location.pathname+window.location.search + '/' + verification_quiz,
                method: 'POST',
                dataType: 'json',
                async: true,
                data: {response: arrValues, _token: $('meta[name="csrf-token"]').attr('content')},
                success: (response) => {
                    if(response.status == 'success')
                    {
                        //correct response
                        if(response.response.action == 'pass')
                        {
                            //show feedback
                            that.showFeedback('success', response.response.message);

                            setTimeout(() =>  {
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
                error: () =>  {
                    that.showFeedback('warning', 'Something went wrong')
                }
            })
        }
        else
        {
            that.showFeedback('warning', 'No option selected');
        }
    }

    showFeedback(type, msg) {
        //set message
        let html = $('<div class="ui-feedback hidden-temp '+type+'">\n' +
            '<span>\n' +
            msg +
            '</span>\n' +
            '</div>');

        //append to active section
        this.clearFeedback();
        let activeSection = this.sections.filter('.active');
        activeSection.append(html);

        //show message
        setTimeout(() =>  {
            $(html).removeClass('hidden-temp');
        }, 20);

        //hide message
        setTimeout(() =>  {
            $(html).addClass('hidden-temp');
        }, 2500);

        //remove message
        setTimeout(() =>  {
            $(html).remove();
        }, 3050);
    }

    clearFeedback() {
        let activeSection = this.sections.filter('.active');
        activeSection.find('.ui-feedback').remove();
    }

    moveToNextSectionOrLection() {
        //check any next or go to next lesson
        let activeSection = this.sections.filter('.active');
        let nextSection = activeSection.next('.lesson-container');
        if(nextSection.length > 0)
        {
            this.navigateTo(activeSection, nextSection, 'right');
        }
        else
        {
            window.location.href = this.nextLessonLink;
        }
    }

    navigateTo(from, to, directionTo) {

        //check movement direction
        let fromClass = 'remove-to-left';
        let toClass = 'show-from-right';
        if(directionTo === 'left')
        {
            fromClass = 'remove-to-right';
            toClass = 'show-from-left';
        }

        //hide the current one
        from.addClass(fromClass);
        from.removeClass('active');
        setTimeout(() =>  {
            from.removeClass(fromClass);
        }, 500);

        //show the next one
        setTimeout(() =>  {
            to.addClass(toClass);
            setTimeout(() =>  {
                to.addClass('active');
                setTimeout(() =>  {
                    to.removeClass(toClass);
                }, 500);
            }, 10);
        }, 490);

        //scroll top
        setTimeout(() =>  {
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
}
