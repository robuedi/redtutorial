
export default class LessonContent {
    
    constructor(){
        
        this.container,
        this.progressBar,
        this.lessonProgress,
        this.sections,
        this.prevBtn,
        this.nextBtn,
        this.nextLessonLink = undefined;

    }

    load(){
        let container = document.querySelector('[data-role="lessons-content"]');

        if(container !== undefined)
        {
            this.fetchDOM(container);
            this.events();
        }
    }

    fetchDOM(container)
    {
        this.lessonsList        = container.querySelector('[data-role="lessons-list"]');
        this.progressBar        = container.querySelector('[data-role="lesson-progress"]');
        this.lessonProgress     = this.progressBar.querySelectorAll(':scope > span');
        this.sections           = this.lessonsList.querySelectorAll('.lesson-container');
        this.prevBtn            = this.lessonsList.querySelector('.prev-load');
        this.nextBtn            = this.lessonsList.querySelector('.next-load');
        this.nextLessonLink     = site_url + this.nextBtn.getAttribute('data-next-lesson');
    }
    
    events(){
        let that = this;

        //next btn clicked
        this.nextBtn.addEventListener('click', () => {
            that.nextSection('right');
        });

        //next btn clicked
        this.prevBtn.addEventListener('click', () => {
            that.prevSection();
        });

        //click on top nav
        this.lessonProgress.forEach((clickedBtn) => {
            that.navigateByProgressBar(clickedBtn);
        })
    }

    navigateByProgressBar(clickedBtn)
    {

        //check if activated before
        if(clickedBtn.classList.contains('pre-active')){

            //check direction
            let activeBtn = this.progressBar.querySelector(':scope > span.active');
            let currentIndex = Array.from(this.progressBar.parentNode.children).indexOf(activeBtn);
            let nextIndex = Array.from(this.progressBar.parentNode.children).indexOf(clickedBtn);

            let direction = 'right';
            if(currentIndex > nextIndex)
            {
                direction = 'left';
            }

            //get sections
            let currentContent  = this.lessonsList.querySelector('.lesson-container.active');
            let nextContent     = this.sections[nextIndex];

            //move to content
            this.navigateTo(currentContent, nextContent, direction);
        }

    }

    navigateSections(direction)
    {
        //get current active section
        let currentActiveSection = this.getCurrentActiveSection();

        //do we have one?
        if(!currentActiveSection)
        {
            return;
        }

        //check if the current section is a quiz
        //and we need to submit it first
        let sectionType = this.getSectionType(currentActiveSection);

        if(sectionType === 'quiz')
        {
            this.submitQuiz();
        }
        else
        {
            this.navigateToRequestedSection(currentActiveSection, direction);
        }
    }

    submitQuiz()
    {

    }

    navigateToRequestedSection(currentActiveSection, direction)
    {

    }

    getCurrentActiveSection()
    {
        //get active section
        let currentActiveSectionArr = [...this.sections].filter(item => {
            if(item.classList.contains('active'))
            {
                return item;
            }
        });

        //check if the number of current section is only one
        // else something is not right
        if(currentActiveSectionArr.length <= 0)
        {
            return false;
        }

        return currentActiveSectionArr[0];
    }

    getSectionType(currentActiveSection)
    {
        let sectionType = currentActiveSection.getAttribute('data-type');
        if(sectionType === 'q')
        {
            return 'quiz';
        }
        else if (sectionType === 't')
        {
            return 'text';
        }
    }

    nextSection2()
    {
        //get current active
        let currentActive = [...this.sections].filter(item => {
            if(item.classList.contains('active'))
            {
                return item;
            }
        });

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

    submitQuiz2(quizForm) {
        let checkedOptions = $(quizForm).find('input:checked');
        let that = this;

        if(checkedOptions.length > 0)
        {
            let arrValues = [];
            checkedOptions.each((index, element) =>  {
                arrValues.push($(element).val());
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

        console.log('test');

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