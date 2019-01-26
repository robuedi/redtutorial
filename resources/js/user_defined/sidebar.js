window.onload = function(){

    //Sidebar menu actions
    var sidebar_navigation = {
        init:function () {
            //fetch DOM
            this.initDOM();

            //initial page loading
            this.openParents();

            //open/close action
            this.openCloseAction();

            //show/hide other courses
            this.seeOtherCourses();

        },
        initDOM: function () {
            this.container      = $('.root-list');
            this.listItems      = this.container.find('li');
            this.listItemsSym   = this.listItems.find('.toggle-children');
            this.seeOtherourses = this.container.find('.see-other-courses');
            // this.itemsLabel     = this.container.find('.item-label');
        },
        openParents: function () {
            //get active item
            var activeItem = this.listItems.filter('.active');

            //make parents active
            if(activeItem.length > 0)
            {
                var parents = activeItem.parentsUntil('.root-list', 'li');

                parents.addClass('active');
            }
        },
        openCloseAction: function () {
            this.listItemsSym.on('click', function () {
               var parent = $(this).closest('li');

               //open/close
               if(parent.hasClass('active'))
               {
                   parent.removeClass('active');
               }
               else
               {
                   parent.addClass('active');

                   //close siblings
                   parent.siblings().removeClass('active');
               }
            });
        },
        seeOtherCourses: function () {
            this.seeOtherourses.on('click', function () {
               $(this).toggleClass('active-see');
            });
        }
    };

    sidebar_navigation.init();


    //sidebar mobile
    $('.trigger-sidebar').on('click', function () {
        $('#left_menu').toggleClass('sidebar-show');
        $(this).toggleClass('trigger-open');
        $('body').toggleClass('fixed-body');
    });


    // Show/hide menu depending on scroll direction
    showHideMenu();
    window.onresize = function() {
        showHideMenu();
    }

};

// Show/hide menu depending on scroll direction
function showHideMenu() {
    if(screen.width < 992)
    {
        $('#main_navigation').addClass('scroll-show-hide-enabled');

        var lastScrollTop = 0;
        var scrolledTop = 0;
        $(window).scroll(function()
        {
            if(screen.width < 992)
            {
                var st = $(this).scrollTop();

                //if less then 100 scroll show menu
                if(st < 100)
                {
                    $('#main_navigation').removeClass('scroll-hide');
                    return
                }

                //check scroll direction
                if (st > lastScrollTop)
                {
                    scrolledTop = 0;
                    $('#main_navigation').addClass('scroll-hide');
                }
                else
                {
                    scrolledTop++;
                    if(scrolledTop > 30)
                    {
                        $('#main_navigation').removeClass('scroll-hide');
                    }
                }
                lastScrollTop = st;
            }
        });
    }
    else
    {
        $('#main_navigation').removeClass('scroll-show-hide-enabled');
    }
}

